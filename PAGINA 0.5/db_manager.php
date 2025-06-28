<?php
class DatabaseManager {
    private $pdo;
    
    public function __construct() {
        $host = 'localhost';
        $dbname = 'oishi_restaurant';
        $username = 'root';
        $password = '';
        
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa a la base de datos\n";
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage() . "\n";
            exit;
        }
    }
    
    public function createTables() {
        try {
            // Crear tabla de categorías
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                description TEXT,
                is_active BOOLEAN DEFAULT TRUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            
            // Crear tabla de productos
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                category_id INT NOT NULL,
                name VARCHAR(200) NOT NULL,
                description TEXT,
                price DECIMAL(10,2) NOT NULL,
                is_available BOOLEAN DEFAULT TRUE,
                is_special BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (category_id) REFERENCES categories(id)
            )");
            
            echo "Tablas creadas exitosamente\n";
        } catch(PDOException $e) {
            echo "Error al crear tablas: " . $e->getMessage() . "\n";
        }
    }
    
    public function importFromCSV($filename) {
        try {
            $file = fopen($filename, 'r');
            if (!$file) {
                throw new Exception("No se pudo abrir el archivo CSV");
            }
            
            // Saltar la fila de encabezados
            fgetcsv($file);
            
            // Preparar statements
            $categoryStmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
            $productStmt = $this->pdo->prepare("INSERT INTO products (category_id, name, description, price) VALUES (?, ?, ?, ?)");
            
            $totalProducts = 0;
            $totalCategories = 0;
            
            // Procesar cada fila
            while (($row = fgetcsv($file)) !== FALSE) {
                $category = $row[0];
                $name = $row[1];
                $description = $row[2];
                $price = str_replace(',', '', $row[3]);
                
                // Insertar categoría
                $categoryStmt->execute([$category]);
                $categoryId = $this->pdo->lastInsertId();
                $totalCategories++;
                
                // Insertar producto
                $productStmt->execute([$categoryId, $name, $description, $price]);
                $totalProducts++;
            }
            
            fclose($file);
            echo "Importación completada:\n";
            echo "Total de categorías: $totalCategories\n";
            echo "Total de productos: $totalProducts\n";
            
        } catch(Exception $e) {
            echo "Error en la importación: " . $e->getMessage() . "\n";
        }
    }
    
    public function showStats() {
        try {
            $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM products");
            $totalProducts = $stmt->fetch()['total'];
            
            $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM categories");
            $totalCategories = $stmt->fetch()['total'];
            
            echo "\nEstadísticas de la base de datos:\n";
            echo "Total de categorías: $totalCategories\n";
            echo "Total de productos: $totalProducts\n";
            
        } catch(PDOException $e) {
            echo "Error al obtener estadísticas: " . $e->getMessage() . "\n";
        }
    }
}

// Uso del script
$db = new DatabaseManager();

// Crear tablas si no existen
$db->createTables();

// Importar datos del CSV
$db->importFromCSV('PRODUCTOS DE OISHI.csv');

// Mostrar estadísticas
$db->showStats();
?> 