<?php
require_once 'auth.php';
session_start();

$auth = new Auth();

// Verificar si el usuario está logueado
if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php'); // Redirigir a la página de login si no es admin
    exit;
}

// Obtener información del usuario actual
$user = $auth->getCurrentUser();

// Combinar first_name y last_name para mostrar el nombre completo
$display_name = htmlspecialchars($user['first_name']) . (isset($user['last_name']) && !empty($user['last_name']) ? ' ' . htmlspecialchars($user['last_name']) : '');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Oishi Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
            padding: 1rem;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,.2);
        }
        .main-content {
            padding: 2rem;
        }
        .welcome-card {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            color: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="p-3 text-center">
                    <img src="img/Logo index 2.png" alt="Oishi Restaurant" class="img-fluid mb-3" style="max-width: 150px;">
                    <h5 class="text-white">Panel de Control</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-home me-2"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-utensils me-2"></i> Menú
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-store me-2"></i> Sucursales
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-tags me-2"></i> Promociones
                        </a>
                    </li>
                    <?php /* if ($user['role'] === 'admin'): */ ?>
                    <!-- Secciones de Admin comentadas ya que la tabla no tiene columna 'role' -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-2"></i> Usuarios
                        </a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog me-2"></i> Configuración
                        </a>
                    </li> -->
                    <?php /* endif; */ ?>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard</h2>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i><?php echo $display_name; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i>Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Welcome Card -->
                <div class="welcome-card">
                    <h3>Bienvenido, <?php echo $display_name; ?>!</h3>
                    <p class="mb-0">Panel de control de Oishi Restaurant</p>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h5><i class="fas fa-utensils me-2"></i>Productos</h5>
                            <h3>150+</h3>
                            <p class="text-muted mb-0">Productos en el menú</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h5><i class="fas fa-store me-2"></i>Sucursales</h5>
                            <h3>3</h3>
                            <p class="text-muted mb-0">Sucursales activas</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h5><i class="fas fa-tags me-2"></i>Promociones</h5>
                            <h3>10+</h5>
                            <p class="text-muted mb-0">Promociones activas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 