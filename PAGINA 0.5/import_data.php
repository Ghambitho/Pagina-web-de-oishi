<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'oishi_restaurant';
$username = 'root';
$password = ''; // Aquí irá la contraseña que configures

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Leer archivo CSV
    $file = fopen('PRODUCTOS DE OISHI.csv', 'r');
    
    // Saltar la fila de encabezados
    fgetcsv($file);
    
    // Preparar statements
    $categoryStmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
    $productStmt = $pdo->prepare("INSERT INTO products (category_id, name, description, price) VALUES (?, ?, ?, ?)");
    
    // Procesar cada fila
    while (($row = fgetcsv($file)) !== FALSE) {
        $category = $row[0];
        $name = $row[1];
        $description = $row[2];
        $price = str_replace(',', '', $row[3]); // Eliminar comas del precio
        
        // Insertar categoría y obtener su ID
        $categoryStmt->execute([$category]);
        $categoryId = $pdo->lastInsertId();
        
        // Insertar producto
        $productStmt->execute([$categoryId, $name, $description, $price]);
    }
    
    fclose($file);
    echo "¡Datos importados exitosamente!\n";
    
    // Mostrar resumen
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM products");
    $totalProducts = $stmt->fetch()['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM categories");
    $totalCategories = $stmt->fetch()['total'];
    
    echo "\nResumen de la importación:\n";
    echo "Total de categorías: $totalCategories\n";
    echo "Total de productos: $totalProducts\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 