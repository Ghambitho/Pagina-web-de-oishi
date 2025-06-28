<?php
require_once 'auth.php';

$auth = new Auth();

try {
    $pdo = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), 
                   getenv('DB_USER'), 
                   getenv('DB_PASSWORD'));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT id, email, first_name, last_name, created_at FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n=== Lista de Usuarios ===\n";
    echo str_repeat("-", 80) . "\n";
    echo sprintf("%-5s | %-30s | %-15s | %-15s | %-20s\n", 
                "ID", "Email", "Nombre", "Apellido", "Fecha de Registro");
    echo str_repeat("-", 80) . "\n";
    
    foreach ($users as $user) {
        echo sprintf("%-5s | %-30s | %-15s | %-15s | %-20s\n",
                    $user['id'],
                    $user['email'],
                    $user['first_name'],
                    $user['last_name'],
                    $user['created_at']);
    }
    echo str_repeat("-", 80) . "\n";
    echo "Total de usuarios: " . count($users) . "\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 