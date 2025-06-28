<?php
require_once 'auth.php';
session_start();

$auth = new Auth();

// Verificar si el usuario está logueado
if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Verificar si el usuario tiene el rol de usuario normal
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    // Si no es un usuario normal (es admin o no tiene rol), redirigir a su dashboard correspondiente o a login
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
        header('Location: dashboard.php'); // Redirigir a admin dashboard
        exit;
    } else {
        header('Location: login.php'); // Redirigir a login si no tiene rol o es desconocido
        exit;
    }
}

// Obtener información del usuario actual
$user = $auth->getCurrentUser();

// Combinar first_name y last_name para mostrar el nombre completo
$display_name = htmlspecialchars($user['first_name']) . (isset($user['last_name']) && !empty($user['last_name']) ? ' ' . htmlspecialchars($user['last_name']) : '');

// Lógica para actualizar perfil
$update_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_profile') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if ($auth->updateUserProfile($user['id'], $firstName, $lastName, $phone, $address)) {
        $update_message = 'Perfil actualizado correctamente.';
        // Recargar datos del usuario para mostrar los cambios inmediatamente
        $user = $auth->getCurrentUser();
        $display_name = htmlspecialchars($user['first_name']) . (isset($user['last_name']) && !empty($user['last_name']) ? ' ' . htmlspecialchars($user['last_name']) : '');
    } else {
        $update_message = 'Error al actualizar el perfil.';
    }
}

// Lógica para obtener pedidos
$total_orders = 0;
$orders = [];
$pdo = $auth->getPDO();
if ($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT id, order_date, total_amount, status, delivery_type, payment_method FROM orders WHERE user_id = :user_id ORDER BY order_date DESC");
        $stmt->execute([':user_id' => $user['id']]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_orders = count($orders);
    } catch (PDOException $e) {
        // Manejar error de base de datos
        $orders_error = 'Error al cargar pedidos: ' . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario - Oishi Restaurant</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .tab-button.active {
            border-bottom: 3px solid #dc2626; /* red-600 */
            color: #dc2626; /* red-600 */
            font-weight: 600;
        }
        /* Estilos para el scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <?php include 'includes/navbar.php'; ?>

    <!-- Main Content -->
    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg flex-grow">
        <!-- Tabs Navigation -->
        <div class="flex border-b border-gray-200">
            <button class="tab-button py-3 px-6 text-gray-600 focus:outline-none active" data-tab="profile">
                <i class="fas fa-user-circle mr-2"></i> Configuración de Cuenta
            </button>
            <button class="tab-button py-3 px-6 text-gray-600 focus:outline-none" data-tab="orders">
                <i class="fas fa-history mr-2"></i> Pedidos
            </button>
            <button class="tab-button py-3 px-6 text-gray-600 focus:outline-none" data-tab="goals">
                <i class="fas fa-trophy mr-2"></i> Metas de Fidelización
            </button>
        </div>

        <!-- Tabs Content -->
        <div id="tab-content" class="mt-6">
            <!-- Account Settings Tab -->
            <div id="profile" class="tab-pane active">
                <h2 class="text-xl font-semibold mb-4">Configuración de Cuenta</h2>
                <?php if ($update_message): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <?php echo $update_message; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="user_dashboard.php">
                    <input type="hidden" name="action" value="update_profile">
                    <div class="mb-4">
                        <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Número de Teléfono:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-6">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Dirección de Entrega:</label>
                        <textarea id="address" name="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Actualizar Perfil
                        </button>
                    </div>
                </form>
            </div>

            <!-- Orders Tab -->
            <div id="orders" class="tab-pane hidden">
                <h2 class="text-xl font-semibold mb-4">Mis Pedidos</h2>
                <?php if (isset($orders_error)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <?php echo $orders_error; ?>
                    </div>
                <?php else: ?>
                    <p class="mb-4">Has realizado <span class="font-bold text-red-600 text-lg"><?php echo $total_orders; ?></span> pedidos hasta ahora.</p>
                    <?php if ($total_orders > 0): ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pedido</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrega</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pago</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td class="py-3 px-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($order['id']); ?></td>
                                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-700"><?php echo (new DateTime($order['order_date']))->format('d/m/Y H:i'); ?></td>
                                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-700">$<?php echo number_format($order['total_amount'], 0, ',', '.'); ?></td>
                                            <td class="py-3 px-4 whitespace-nowrap text-sm">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php
                                                    if ($order['status'] === 'completed') echo 'bg-green-100 text-green-800';
                                                    else if ($order['status'] === 'pending') echo 'bg-yellow-100 text-yellow-800';
                                                    else if ($order['status'] === 'cancelled') echo 'bg-red-100 text-red-800';
                                                    else echo 'bg-gray-100 text-gray-800';
                                                ?>">
                                                    <?php echo htmlspecialchars(ucfirst($order['status'])); ?>
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-700">
                                                <?php echo $order['delivery_type'] === 'delivery' ? 'Delivery' : 'Retiro en local'; ?>
                                            </td>
                                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-700">
                                                <?php
                                                if ($order['payment_method'] === 'efectivo') echo 'Efectivo';
                                                else if ($order['payment_method'] === 'tarjeta') echo 'Tarjeta';
                                                else if ($order['payment_method'] === 'transferencia') echo 'Transferencia';
                                                else echo htmlspecialchars($order['payment_method']);
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500">Aún no has realizado ningún pedido.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- Goals Tab -->
            <div id="goals" class="tab-pane hidden">
                <h2 class="text-xl font-semibold mb-4">Metas de Fidelización</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Meta de Pedidos -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Meta de Pedidos</h3>
                        <div class="mb-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Progreso</span>
                                <span class="text-sm font-medium text-gray-700"><?php echo $total_orders; ?>/10 pedidos</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-red-600 h-2.5 rounded-full" style="width: <?php echo min(($total_orders / 10) * 100, 100); ?>%"></div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">
                            <?php if ($total_orders >= 10): ?>
                                ¡Felicidades! Has alcanzado la meta de pedidos.
                            <?php else: ?>
                                Te faltan <?php echo 10 - $total_orders; ?> pedidos para alcanzar la meta.
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- Meta de Gasto -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Meta de Gasto</h3>
                        <?php
                        $total_spent = 0;
                        foreach ($orders as $order) {
                            if ($order['status'] === 'completed') {
                                $total_spent += $order['total_amount'];
                            }
                        }
                        $spending_goal = 100000; // $100,000
                        $progress = min(($total_spent / $spending_goal) * 100, 100);
                        ?>
                        <div class="mb-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Progreso</span>
                                <span class="text-sm font-medium text-gray-700">$<?php echo number_format($total_spent, 0, ',', '.'); ?>/$<?php echo number_format($spending_goal, 0, ',', '.'); ?></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-red-600 h-2.5 rounded-full" style="width: <?php echo $progress; ?>%"></div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">
                            <?php if ($total_spent >= $spending_goal): ?>
                                ¡Felicidades! Has alcanzado la meta de gasto.
                            <?php else: ?>
                                Te faltan $<?php echo number_format($spending_goal - $total_spent, 0, ',', '.'); ?> para alcanzar la meta.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="notificationModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none" style="display:none;">
        <div class="bg-white p-6 rounded-lg shadow-xl text-center">
            <h3 id="notificationTitle" class="text-lg font-medium text-gray-900 mb-2">Notificación</h3>
            <p id="notificationMessage" class="text-sm text-gray-600 mb-4">Este es un mensaje de notificación.</p>
            <button id="closeNotificationModal" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Cerrar</button>
        </div>
    </div>

    <script>
        // Función para manejar las pestañas
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remover clase active de todos los botones y paneles
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabPanes.forEach(pane => pane.classList.add('hidden'));

                    // Agregar clase active al botón clickeado
                    button.classList.add('active');

                    // Mostrar el panel correspondiente
                    const tabId = button.getAttribute('data-tab');
                    document.getElementById(tabId).classList.remove('hidden');
                });
            });
        });
    </script>
</body>
</html> 