<?php
require_once 'auth.php';
session_start();

$auth = new Auth();
$user = $auth->getCurrentUser();
$display_name = '';
if ($user) {
    $display_name = htmlspecialchars($user['first_name']) . (isset($user['last_name']) && !empty($user['last_name']) ? ' ' . htmlspecialchars($user['last_name']) : '');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido - Oishi Sushi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 font-inter page-checkout">

    <div id="notificationModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none" style="display:none;">
        <div class="bg-white p-6 rounded-lg shadow-xl text-center">
            <h3 id="notificationTitle" class="text-lg font-medium text-gray-900 mb-2">Notificación</h3>
            <p id="notificationMessage" class="text-sm text-gray-600 mb-4">Este es un mensaje de notificación.</p>
            <button id="closeNotificationModal" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Cerrar</button>
        </div>
    </div>

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
                    <a href="#" id="pedir-online-link" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Pedir Online</a>
                    <a href="Sucursales.php" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Sucursales</a>
                    <?php if ($auth->isLoggedIn()): ?>
                        <!-- Si el usuario está logueado, mostrar nombre y botón de logout -->
                        <span class="ml-4 px-4 py-2 text-gray-700 font-semibold text-sm">Bienvenido, <?php echo $display_name; ?></span>
                        <a href="logout.php" class="ml-2 px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 transition-colors text-sm">Cerrar Sesión</a>
                    <?php else: ?>
                        <!-- Si el usuario no está logueado, mostrar botón de Login -->
                        <a href="login.php" class="ml-4 px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 transition-colors text-sm">Login</a>
                    <?php endif; ?>
                     <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-red-600 font-bold">Carrito</a>
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
                <a href="#" id="pedir-online-link-mobile" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Pedir Online</a>
                <a href="Sucursales.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-500 hover:text-white transition-colors">Sucursales</a>
                <button onclick="showNotification('Iniciar Sesión', 'Funcionalidad de Login no implementada aún.')" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-500 text-white hover:bg-red-700">Login</button>
                 <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-red-600 font-bold">Carrito</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold font-poppins text-gray-800 mb-8 text-center">Finalizar Pedido</h1>

        <div id="resumen-pedido" class="bg-white rounded-xl shadow-lg p-6 mb-8">
          <!-- El resumen del pedido se llenará dinámicamente con JS -->
        </div>

        <div id="formulario-pago" class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-semibold font-poppins text-gray-800 mb-6">Datos de Contacto y Entrega</h2>
            <form id="checkout-form">
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                <div class="mb-4">
                    <label for="direccion" class="block text-gray-700 font-semibold mb-2">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                <div class="mb-4">
                    <label for="telefono" class="block text-gray-700 font-semibold mb-2">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Tipo de entrega:</label>
                    <select id="tipo_entrega" name="tipo_entrega" class="w-full border rounded px-3 py-2" required>
                        <option value="retiro">Retiro en local</option>
                        <option value="delivery">Delivery</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Método de pago:</label>
                    <select id="metodo_pago" name="metodo_pago" class="w-full border rounded px-3 py-2" required>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="instrucciones" class="block text-gray-700 font-semibold mb-2">Instrucciones adicionales:</label>
                    <textarea id="instrucciones" name="instrucciones" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                </div>
                <button type="submit" class="w-full px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition-colors transform hover:scale-105 text-lg">
                    Confirmar Pedido
                </button>
            </form>
        </div>
    </main>

    <div id="sucursal-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none">
      <div class="bg-white p-6 rounded-lg shadow-xl text-center">
        <h3>Selecciona tu Sucursal</h3>
        <div id="modal-sucursal-options">
          <button class="modal-select-branch px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 m-2" data-sucursal="irarra">Sucursal Irarrázaval</button>
          <button class="modal-select-branch px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 m-2" data-sucursal="valle">Sucursal Ciudad de los Valles</button>
        </div>
         <button id="close-modal" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Cerrar</button>
      </div>
    </div>

    <footer class="bg-gray-800 text-white py-10 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="font-poppins text-xl mb-2">OISHI SUSHI</p>
            <p class="mb-4">&copy; <span id="currentYear"></span> Oishi Sushi. Todos los derechos reservados.</p>
            <div class="flex justify-center space-x-4 mb-4">
                <a href="#" class="hover:text-red-400 transition-colors text-2xl"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-red-400 transition-colors text-2xl"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-red-400 transition-colors text-2xl"><i class="fab fa-twitter"></i></a>
            </div>
            <p class="text-sm">Av. Irarrázaval 5678, Ñuñoa | Av. Trans. Uno 905, Pudahuel | +56 9 2613 8846</p>
        </div>
    </footer>

    <script src="js/products.js"></script>
    <script src="js/main.js"></script>
    <script src="js/reservas.js"></script>

    <script>
        // Mobile menu toggle
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOpenIcon = document.getElementById('menu-open-icon');
        const menuCloseIcon = document.getElementById('menu-close-icon');

        if(menuButton && mobileMenu && menuOpenIcon && menuCloseIcon) {
             menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                menuOpenIcon.classList.toggle('hidden');
                menuOpenIcon.classList.toggle('block');
                menuCloseIcon.classList.toggle('hidden');
                menuCloseIcon.classList.toggle('block');
            });

            // Close mobile menu when a link is clicked
            document.querySelectorAll('#mobile-menu a, #mobile-menu button').forEach(item => {
                item.addEventListener('click', () => {
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        menuOpenIcon.classList.remove('hidden');
                        menuOpenIcon.classList.add('block');
                        menuCloseIcon.classList.remove('block');
                        menuCloseIcon.classList.add('hidden');
                    }
                });
            });
        }

       // Smooth scroll for navigation links (may not be needed for checkout but keeping for consistency)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#') {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Set current year in footer
        document.addEventListener('DOMContentLoaded', function() {
             const currentYearSpan = document.getElementById('currentYear');
             if(currentYearSpan) {
                currentYearSpan.textContent = new Date().getFullYear();
             }

            // Notification Modal - Unificada función de notificación/modal
            const notificationModal = document.getElementById('notificationModal');
            const notificationTitle = document.getElementById('notificationTitle');
            const notificationMessage = document.getElementById('notificationMessage');
            const closeNotificationModalButton = document.getElementById('closeNotificationModal');
             const sucursalModal = document.getElementById('sucursal-modal'); // Assuming this modal exists
             const closeModalButton = document.getElementById('close-modal'); // Assuming this button exists

            function showNotification(title, message) {
                notificationTitle.textContent = title;
                notificationMessage.textContent = message;
                notificationModal.classList.remove('opacity-0', 'pointer-events-none');
                notificationModal.classList.add('opacity-100');
            }

            function closeNotification() {
                notificationModal.classList.add('opacity-0');
                setTimeout(() => {
                    notificationModal.classList.add('hidden', 'pointer-events-none');
                }, 300);
            }

            // Event listeners for closing the notification modal
            if (closeNotificationModalButton) {
                closeNotificationModalButton.addEventListener('click', function(event) {
                    event.stopPropagation();
                    closeNotification();
                });
            }
            // Close modal if clicked outside the content
            if (notificationModal) {
                notificationModal.addEventListener('click', function(event) {
                    if (event.target === notificationModal) {
                        closeNotification();
                    }
                });
            }
             // Function to show the sucursal modal (if needed)
             function showSucursalModal() {
                 if (sucursalModal) {
                     sucursalModal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
                     sucursalModal.classList.add('opacity-100');
                 }
             }

             // Function to close the sucursal modal
             function closeSucursalModal() {
                 if (sucursalModal) {
                     sucursalModal.classList.add('opacity-0');
                     sucursalModal.addEventListener('transitionend', function handler() {
                         sucursalModal.classList.add('hidden', 'pointer-events-none');
                         sucursalModal.removeEventListener('transitionend', handler);
                     });
                 }
             }

             // Event listener for closing the sucursal modal
             if (closeModalButton) {
                 closeModalButton.addEventListener('click', function(event) {
                     event.stopPropagation();
                     closeSucursalModal();
                 });
             }
              if (sucursalModal) {
                 sucursalModal.addEventListener('click', function(event) {
                     if (event.target === sucursalModal) {
                         closeSucursalModal();
                     }
                 });
             }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const tipoEntrega = document.getElementById('tipo_entrega');
            const metodoPago = document.getElementById('metodo_pago');

            function actualizarOpcionesPago() {
                if (tipoEntrega.value === 'retiro') {
                    // Todas las opciones disponibles
                    for (let opt of metodoPago.options) opt.disabled = false;
                } else if (tipoEntrega.value === 'delivery') {
                    // Solo tarjeta y transferencia
                    for (let opt of metodoPago.options) {
                        if (opt.value === 'efectivo') {
                            opt.disabled = true;
                        } else {
                            opt.disabled = false;
                        }
                    }
                    // Si estaba seleccionado efectivo, cambiar a tarjeta
                    if (metodoPago.value === 'efectivo') metodoPago.value = 'tarjeta';
                }
            }

            tipoEntrega.addEventListener('change', actualizarOpcionesPago);
            actualizarOpcionesPago();
        });

        // Pasar datos del usuario logueado a JS para autocompletar
        window.loggedUser = <?php echo json_encode([
            'nombre' => $user ? trim($user['first_name'] . ' ' . $user['last_name']) : '',
            'direccion' => $user['address'] ?? '',
            'telefono' => $user['phone'] ?? '',
            'email' => $user['email'] ?? ''
        ]); ?>;

    </script>

</body>
</html> 