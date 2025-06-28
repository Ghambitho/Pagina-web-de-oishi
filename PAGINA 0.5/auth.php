<?php
// Cargar variables de entorno
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

class Auth {
    private $pdo;
    
    public function __construct() {
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'oishi_restaurant';
        $username = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD');
        
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
    
    public function login($email, $password) {
        try {
            // Buscar usuario por email (usamos email en lugar de username)
            $stmt = $this->pdo->prepare("SELECT id, email, password, first_name, last_name, role FROM users WHERE email = :email LIMIT 1");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si el usuario existe y la contraseña es correcta
            if ($user && password_verify($password, $user['password'])) {
                // Contraseña correcta. Crear una sesión.
                // Generar un token de sesión seguro
                $session_token = bin2hex(random_bytes(32));
                
                // Calcular tiempo de expiración (ej. 1 día)
                $expires_at = date('Y-m-d H:i:s', strtotime('+1 day'));
                
                // Obtener IP y User Agent
                $ip_address = $_SERVER['REMOTE_ADDR'] ?? null;
                $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;

                // Eliminar sesiones antiguas del mismo usuario (opcional pero recomendado)
                $delete_old_sessions_stmt = $this->pdo->prepare("DELETE FROM user_sessions WHERE user_id = :user_id");
                $delete_old_sessions_stmt->execute([':user_id' => $user['id']]);

                // Insertar nueva sesión
                $insert_session_stmt = $this->pdo->prepare("INSERT INTO user_sessions (user_id, session_token, ip_address, user_agent, expires_at) VALUES (:user_id, :session_token, :ip_address, :user_agent, :expires_at)");
                $insert_session_stmt->execute([
                    ':user_id' => $user['id'],
                    ':session_token' => $session_token,
                    ':ip_address' => $ip_address,
                    ':user_agent' => $user_agent,
                    ':expires_at' => $expires_at
                ]);
                
                // Iniciar sesión de PHP y guardar el token
                session_regenerate_id(true); // Regenerar ID de sesión para prevenir fijación
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['session_token'] = $session_token;
                $_SESSION['user_role'] = $user['role']; // Guardar el rol del usuario en la sesión
                
                // Opcional: Actualizar last_login si existiera la columna, pero como no está la ignoramos
                // $update_last_login_stmt = $this->pdo->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = :user_id");
                // $update_last_login_stmt->execute([':user_id' => $user['id']]);
                
                return true; // Login exitoso
            } else {
                // Usuario o contraseña incorrectos
                return false;
            }
        } catch (PDOException $e) {
            // Log de error: echo "Error de login: " . $e->getMessage();
            return false;
        }
    }
    
    // Cambiamos los parámetros para recibir email, first_name y last_name
    public function register($email, $password, $first_name, $last_name) {
        try {
            // Verificar si el email ya existe
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            
            if ($stmt->fetchColumn() > 0) {
                return false; // El email ya existe
            }
            
            // Cifrar la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insertar nuevo usuario (ajustado a las columnas existentes)
            $stmt = $this->pdo->prepare("INSERT INTO users (email, password, first_name, last_name, role) VALUES (:email, :password, :first_name, :last_name, :role)");
            
            return $stmt->execute([
                ':email' => $email,
                ':password' => $hashed_password,
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':role' => 'user' // Asignar el rol de 'user' por defecto
            ]);
            
        } catch (PDOException $e) {
            // Log de error: echo "Error de registro: " . $e->getMessage();
            return false;
        }
    }
    
    public function isLoggedIn() {
        if (!isset($_SESSION['user_id'], $_SESSION['session_token'])) {
            return false;
        }
        
        $user_id = $_SESSION['user_id'];
        $session_token = $_SESSION['session_token'];
        
        try {
            // Verificar que el token de sesión existe y no ha expirado
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user_sessions WHERE user_id = :user_id AND session_token = :session_token AND expires_at > NOW() LIMIT 1");
            $stmt->execute([':user_id' => $user_id, ':session_token' => $session_token]);
            
            return $stmt->fetchColumn() > 0;
            
        } catch (PDOException $e) {
            // Log de error
            return false;
        }
    }
    
    public function logout() {
        if (isset($_SESSION['session_token'])) {
            try {
                // Eliminar el token de sesión de la base de datos
                $stmt = $this->pdo->prepare("DELETE FROM user_sessions WHERE session_token = :session_token");
                $stmt->execute([':session_token' => $_SESSION['session_token']]);
            } catch (PDOException $e) {
                // Log de error
            }
        }
        
        // Destruir la sesión de PHP
        $_SESSION = [];
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/'); // Eliminar cookie de sesión
    }
    
    public function getCurrentUser() {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        $user_id = $_SESSION['user_id'];
        
        try {
            // Obtener información del usuario (ajustado a las columnas existentes)
            $stmt = $this->pdo->prepare("SELECT id, email, first_name, last_name, phone, address, olaclick_customer_id, created_at, updated_at FROM users WHERE id = :user_id LIMIT 1");
            $stmt->execute([':user_id' => $user_id]);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            // Log de error
            return null;
        }
    }

    public function getPDO() {
        return $this->pdo;
    }

    public function updateUserProfile($userId, $firstName, $lastName, $phone, $address) {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, phone = :phone, address = :address, updated_at = CURRENT_TIMESTAMP WHERE id = :user_id");
            return $stmt->execute([
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':phone' => $phone,
                ':address' => $address,
                ':user_id' => $userId
            ]);
        } catch (PDOException $e) {
            // Log de error: echo "Error al actualizar perfil: " . $e->getMessage();
            return false;
        }
    }
}
?> 
