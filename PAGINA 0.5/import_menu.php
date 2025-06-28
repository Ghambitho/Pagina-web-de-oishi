<?php
class MenuImporter {
    private $pdo;
    private $stats = [
        'categories' => 0,
        'products' => 0,
        'errors' => []
    ];
    
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
            die("Error de conexión: " . $e->getMessage() . "\n");
        }
    }
    
    public function importFromCSV($filename) {
        if (!file_exists($filename)) {
            die("Error: El archivo $filename no existe\n");
        }
        
        $file = fopen($filename, 'r');
        if (!$file) {
            die("Error: No se pudo abrir el archivo $filename\n");
        }
        
        // Saltar la fila de encabezados
        fgetcsv($file);
        
        // Preparar statements
        $categoryStmt = $this->pdo->prepare("
            INSERT INTO categories (name) 
            VALUES (?) 
            ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)
        ");
        
        $productStmt = $this->pdo->prepare("
            INSERT INTO products (category_id, name, description, price) 
            VALUES (?, ?, ?, ?)
        ");
        
        // Iniciar transacción
        $this->pdo->beginTransaction();
        
        try {
            $lineNumber = 2; // Empezamos en 2 porque la línea 1 es el encabezado
            while (($row = fgetcsv($file)) !== FALSE) {
                try {
                    // Validar datos
                    if (count($row) < 4) {
                        throw new Exception("Fila incompleta");
                    }
                    
                    $category = trim($row[0]);
                    $name = trim($row[1]);
                    $description = trim($row[2]);
                    $price = $this->formatPrice($row[3]);
                    
                    if (empty($category) || empty($name) || empty($price)) {
                        throw new Exception("Datos requeridos faltantes");
                    }
                    
                    // Insertar categoría
                    $categoryStmt->execute([$category]);
                    $categoryId = $this->pdo->lastInsertId();
                    $this->stats['categories']++;
                    
                    // Insertar producto
                    $productStmt->execute([$categoryId, $name, $description, $price]);
                    $this->stats['products']++;
                    
                } catch (Exception $e) {
                    $this->stats['errors'][] = "Error en línea $lineNumber: " . $e->getMessage();
                }
                $lineNumber++;
            }
            
            // Confirmar transacción
            $this->pdo->commit();
            
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->pdo->rollBack();
            die("Error en la importación: " . $e->getMessage() . "\n");
        }
        
        fclose($file);
        $this->showStats();
    }
    
    private function formatPrice($price) {
        // Eliminar caracteres no numéricos excepto el punto decimal
        $price = preg_replace('/[^0-9.]/', '', $price);
        return floatval($price);
    }
    
    private function showStats() {
        echo "\nResumen de la importación:\n";
        echo "-------------------------\n";
        echo "Categorías importadas: " . $this->stats['categories'] . "\n";
        echo "Productos importados: " . $this->stats['products'] . "\n";
        
        if (!empty($this->stats['errors'])) {
            echo "\nErrores encontrados:\n";
            foreach ($this->stats['errors'] as $error) {
                echo "- $error\n";
            }
        }
    }
}

// Ejecutar la importación
$importer = new MenuImporter();
$importer->importFromCSV('PRODUCTOS DE OISHI.csv');
?> 