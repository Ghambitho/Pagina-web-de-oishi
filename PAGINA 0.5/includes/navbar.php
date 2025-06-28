<?php
// Barra de navegación estándar para todo el sitio
if (!isset($auth)) {
    require_once __DIR__ . '/../auth.php';
    if (session_status() === PHP_SESSION_NONE) session_start();
    $auth = new Auth();
    $user = $auth->getCurrentUser();
    $display_name = $user ? htmlspecialchars($user['first_name']) . (isset($user['last_name']) && !empty($user['last_name']) ? ' ' . htmlspecialchars($user['last_name']) : '') : '';
}
// Detectar página actual para ocultar el botón de pedir online en login y registro
$current_page = basename($_SERVER['PHP_SELF']);
$hide_pedir_online = in_array($current_page, ['login.php', 'register.php']);
// Determinar el dashboard según el rol
$dashboard_url = 'user_dashboard.php';
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === 'admin') {
        $dashboard_url = 'dashboard.php';
    } else if ($_SESSION['user_role'] === 'user') {
        $dashboard_url = 'user_dashboard.php';
    }
}
?>
<nav class="bg-white shadow-lg sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex-shrink-0">
                <a href="index.php" class="font-poppins font-bold text-4xl text-red-500 shadow-sm h-full flex items-center">
                    <img src="img/Logo index 2.png" alt="Oishi Sushi Logo" class="h-16 w-auto object-contain">
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="index.php" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Inicio</a>
                <?php if (!$hide_pedir_online): ?>
                    <a href="#" id="pedir-online-link" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Pedir Online</a>
                <?php endif; ?>
                <a href="Sucursales.php" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Sucursales</a>
                
                <?php if ($auth->isLoggedIn()): ?>
                    <a href="<?php echo $dashboard_url; ?>" class="ml-4 px-4 py-2 text-gray-700 font-semibold text-sm bg-white border-2 border-red-500 rounded-md hover:bg-red-50 transition-colors"><?php echo $display_name; ?></a>
                    <a href="logout.php" class="ml-2 px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 transition-colors text-sm">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php" class="ml-4 px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 transition-colors text-sm">Login</a>
                <?php endif; ?>
            </div>
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-500">
                    <span class="sr-only">Abrir menú principal</span>
                    <svg id="menu-open-icon" class="h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg id="menu-close-icon" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Inicio</a>
            <?php if (!$hide_pedir_online): ?>
                <a href="#" id="pedir-online-link-mobile" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Pedir Online</a>
            <?php endif; ?>
            <a href="Sucursales.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Sucursales</a>
            <?php if ($auth->isLoggedIn()): ?>
                <a href="<?php echo $dashboard_url; ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors"><?php echo $display_name; ?></a>
                <a href="logout.php" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOpenIcon = document.getElementById('menu-open-icon');
    const menuCloseIcon = document.getElementById('menu-close-icon');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            menuOpenIcon.classList.toggle('hidden');
            menuCloseIcon.classList.toggle('hidden');
        });
    }
});
</script> 