<?php
// procesar_pedido.php
header('Content-Type: application/json');

require_once 'auth.php';
require_once 'includes/db.php'; // Asegúrate de tener aquí la conexión PDO ($pdo)
session_start();

// Solo aceptar POST y JSON
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos JSON inválidos']);
    exit;
}

// Validar campos requeridos
$required = ['sucursal', 'cliente', 'items', 'total'];
foreach ($required as $field) {
    if (empty($input[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Falta el campo: $field"]);
        exit;
    }
}

$cliente = $input['cliente'];
$items = $input['items'];
$total = $input['total'];
$sucursal = $input['sucursal'];
$estado = $input['estado'] ?? 'pendiente';
$tipo_entrega = $input['tipo_entrega'] ?? 'retiro';
$metodo_pago = $input['metodo_pago'] ?? 'efectivo';

// Validar cliente
if (empty($cliente['nombre']) || empty($cliente['telefono']) || empty($cliente['direccion'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Faltan datos del cliente']);
    exit;
}

// Validar items
if (!is_array($items) || count($items) === 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No hay productos en el pedido']);
    exit;
}

// Validar coherencia
if ($tipo_entrega === 'delivery' && $metodo_pago === 'efectivo') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'El pago en efectivo solo está disponible para retiro en local.']);
    exit;
}

// Obtener ID de usuario si está logueado
$user_id = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

try {
    // Insertar en orders
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, branch, customer_name, customer_phone, customer_email, customer_address, customer_instructions, total_amount, status, order_date, delivery_type, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
    $stmt->execute([
        $user_id,
        $sucursal,
        $cliente['nombre'],
        $cliente['telefono'],
        $cliente['email'] ?? '',
        $cliente['direccion'],
        $cliente['instrucciones'] ?? '',
        $total,
        $estado,
        $tipo_entrega,
        $metodo_pago
    ]);
    $order_id = $pdo->lastInsertId();

    // Insertar productos en order_items
    $stmt_item = $pdo->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, unit_price) VALUES (?, ?, ?, ?, ?)");
    foreach ($items as $item) {
        if (empty($item['id']) || empty($item['nombre']) || empty($item['cantidad']) || empty($item['precioUnitario'])) {
            continue; // Saltar productos incompletos
        }
        $stmt_item->execute([
            $order_id,
            $item['id'],
            $item['nombre'],
            $item['cantidad'],
            $item['precioUnitario']
        ]);
    }

    echo json_encode(['success' => true, 'message' => 'Pedido registrado correctamente']);
} catch (PDOException $e) {
    error_log('Error al guardar pedido: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al guardar el pedido']);
} 