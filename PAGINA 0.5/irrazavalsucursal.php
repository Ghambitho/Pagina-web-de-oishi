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
    <title>Menú Irarrázaval - Oishi Sushi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 font-inter page-menu-irarra" data-sucursal="irarra">

    <div id="notificationModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none" style="display:none;">
        <div class="bg-white p-6 rounded-lg shadow-xl text-center">
            <h3 id="notificationTitle" class="text-lg font-medium text-gray-900 mb-2">Notificación</h3>
            <p id="notificationMessage" class="text-sm text-gray-600 mb-4">Este es un mensaje de notificación.</p>
            <button id="closeNotificationModal" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Cerrar</button>
        </div>
    </div>

    <?php include 'includes/navbar.php'; ?>

    <!-- Contenedor para el botón Cambiar Sucursal y su desplegable alineado a la izquierda -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative mt-4 mb-6">
      <div style="display: inline-block; position: relative;">
        <div id="cambiar-sucursal-btn-logo" class="bg-red-500 text-white text-lg font-semibold cursor-pointer hover:bg-red-600 px-4 py-2 rounded-md">Cambiar Sucursal</div>
        <div id="sucursal-dropdown-menu" class="absolute z-30 w-56 rounded-md shadow-lg bg-orange-500 ring-1 ring-black ring-opacity-5 hidden mt-2" style="left: 0;">
          <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            <a href="irrazavalsucursal.php" class="block px-4 py-2 text-white text-base hover:bg-orange-600 text-center border-b border-orange-400 last:border-b-0">Sucursal Irarrázaval</a>
            <a href="vallesucursal.php" class="block px-4 py-2 text-white text-base hover:bg-orange-600 text-center">Sucursal Ciudad de los Valles</a>
          </div>
        </div>
      </div>
    </div>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Barra de Categorías -->
        <div id="category-filter-bar" class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="category-btn px-4 py-2 rounded-md text-sm font-medium bg-red-500 text-white hover:bg-red-600 transition-colors" data-category="Carta">Carta</button>
            <button class="category-btn px-4 py-2 rounded-md text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors" data-category="Promociones">Promociones</button>
            
            <button class="category-btn px-4 py-2 rounded-md text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors" data-category="Bebidas">Bebidas</button>
        </div>

        <h1 class="text-3xl font-bold font-poppins text-gray-800 mb-8 text-center">Menú Sucursal Irarrázaval</h1>

        <!-- Sección para listar los productos del menú -->
        <section id="menu-productos"></section>

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

    <footer class="bg-gray-800 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="font-poppins text-xl mb-2">OISHI SUSHI</p>
            <p class="mb-4">&copy; <span id="currentYear"></span> Oishi Sushi. Todos los derechos reservados.</p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="hover:text-red-400 transition-colors">Facebook</a>
                <a href="#" class="hover:text-red-400 transition-colors">Instagram</a>
                <a href="#" class="hover:text-red-400 transition-colors">Twitter</a>
            </div>
        </div>
    </footer>

    <script src="js/products.js"></script>
    <script src="js/main.js"></script>

    <!-- Modal de Detalles del Producto -->
    <div id="productDetailsModalContainer" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-lg mx-auto relative">
            <button id="closeProductDetailsModalBtn" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl p-1 bg-gray-200 rounded-full hover:bg-gray-300 transition-colors">&times;</button>
            <img id="productDetailsModalImage" src="img/oishi sushi-1.jpg" alt="Imagen del Producto" class="w-full h-48 object-cover rounded-md mb-4">
            <h3 id="productDetailsModalTitle" class="text-2xl font-bold font-poppins text-gray-800 mb-2"></h3>
            <p id="productDetailsModalDescription" class="text-gray-700 text-base mb-4"></p>
            <p id="productDetailsModalPrice" class="text-2xl font-bold text-red-600 mb-4"></p>
            <button id="productDetailsModalAddToCartBtn" class="w-full px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 transition-colors">Añadir al Carrito</button>
        </div>
    </div>

    <!-- Carrito Lateral (Sidebar) -->
    <!-- INICIO NUEVO CARRITO LATERAL -->
    <div id="carrito-lateral" class="fixed top-0 right-0 h-full w-80 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tu Carrito</h2>
                <button onclick="cerrarCarroLateral()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="cart-items" class="overflow-y-auto max-h-[calc(100vh-200px)]">
                <!-- Los items del carrito se renderizarán aquí -->
            </div>
            <div class="border-t mt-4 pt-4">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-semibold">Total:</span>
                    <span id="cart-total" class="font-bold text-red-600">$0</span>
                </div>
                <button onclick="finalizarPedido()" class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition-colors">
                    Finalizar Pedido
                </button>
            </div>
        </div>
    </div>
    <!-- FIN NUEVO CARRITO LATERAL -->

    <!-- Modal Especial para Reservas (Tortas) -->
    <div id="reservaModalContainer" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-lg mx-auto relative">
            <button id="closeReservaModalBtn" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl p-1 bg-gray-200 rounded-full hover:bg-gray-300 transition-colors">&times;</button>
            <img id="reservaModalImage" src="img/torta1.jpg" alt="Imagen del Producto" class="w-full h-48 object-cover rounded-md mb-4">
            <h3 id="reservaModalTitle" class="text-2xl font-bold mb-2"></h3>
            <p id="reservaModalDescription" class="text-gray-700 mb-4"></p>
            <div id="reservaModalPrice" class="text-lg font-semibold text-green-700 mb-6"></div>
            <button id="reservaWhatsappBtn" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg text-lg transition-colors flex items-center justify-center gap-2">
                <span>👉 Reservar por WhatsApp</span>
            </button>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOpenIcon = document.getElementById('menu-open-icon');
        const menuCloseIcon = document.getElementById('menu-close-icon');

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
        
        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                // Solo hacer scroll si el href es un ancla interna y no solo '#' (que usamos para abrir la modal)
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
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Notification Modal - Unificada función de notificación/modal
        const notificationModal = document.getElementById('notificationModal');
        const notificationTitle = document.getElementById('notificationTitle');
        const notificationMessage = document.getElementById('notificationMessage');
        const closeNotificationModalButton = document.getElementById('closeNotificationModal');

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

        document.addEventListener('DOMContentLoaded', function() {
            if (closeNotificationModalButton) {
                closeNotificationModalButton.addEventListener('click', function(event) {
                    event.stopPropagation();
                    closeNotification();
                });
            }
            if (notificationModal) {
                notificationModal.addEventListener('click', function(event) {
                    if (event.target === notificationModal) {
                        closeNotification();
                    }
                });
            }
        });

        // Función específica para mostrar detalles del producto (reutiliza showNotification)
        function showProductDetails(title, description) {
            showNotification(title, description);
        }

        // Nueva función para mostrar la modal de detalles del producto
        function showProductDetailsModal(productId) {
            console.log('showProductDetailsModal: Llamada con productId', productId);
            const product = productsForBranch.find(p => p.id === productId);
            console.log('showProductDetailsModal: Producto encontrado', product);

            if (!product) {
                console.error('showProductDetailsModal: Producto no encontrado para modal:', productId);
                return;
            }

            const modal = document.getElementById('productDetailsModalContainer');
            const modalImage = document.getElementById('productDetailsModalImage');
            const modalTitle = document.getElementById('productDetailsModalTitle');
            const modalDescription = document.getElementById('productDetailsModalDescription');
            const modalPrice = document.getElementById('productDetailsModalPrice');
            const modalAddToCartBtn = document.getElementById('productDetailsModalAddToCartBtn');
            // No necesitamos el closeModalBtn aquí ya que el listener se adjuntará una vez fuera de esta función

            if (!modal || !modalImage || !modalTitle || !modalDescription || !modalPrice || !modalAddToCartBtn) {
                console.error('showProductDetailsModal: Elementos de la modal de producto no encontrados!');
                return;
            }

            // Llenar la modal con los detalles del producto
            modalImage.src = 'img/oishi sushi-1.jpg'; // Usar la imagen genérica (o product.imagen si estuviera disponible)
            modalImage.alt = product.nombre;
            modalTitle.textContent = product.nombre;
            modalDescription.textContent = product.descripcion;
            modalPrice.textContent = `$${product.precio.toLocaleString('es-CL')}`;

            // Actualizar el data attribute con el ID del producto para el listener del botón "Añadir al Carrito"
            modalAddToCartBtn.dataset.productId = product.id;

            // --- Mostrar la modal ---
            // Remover clases de ocultación
            modal.classList.remove('hidden', 'pointer-events-none', 'opacity-0');
            // Asegurar que se muestre como flex (ya que la modal tiene display flex en su definición)
            modal.style.display = 'flex';

            // Añadir clase de opacidad para la transición
            setTimeout(() => {
                modal.classList.add('opacity-100');
            }, 10); // Pequeño retraso para asegurar que el display se aplique antes de la transición de opacidad
        }

        // Nueva función para cerrar la modal de detalles del producto
        function closeProductDetailsModal() {
            const modal = document.getElementById('productDetailsModalContainer');
            if (modal) {
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                // Esperar a que termine la transición de opacidad antes de ocultar completamente
                modal.addEventListener('transitionend', function handler() {
                    modal.classList.add('hidden', 'pointer-events-none');
                    modal.removeEventListener('transitionend', handler); // Remover el listener después de ejecutarse
                });
            }
        }

        // --- Event Listeners adjuntados una vez al cargar el DOM ---
        document.addEventListener('DOMContentLoaded', function() {
            // ... existing code for other listeners (mobile menu, smooth scroll, notification modal) ...

            // Event listeners para la modal de detalles del producto
            const productDetailsModal = document.getElementById('productDetailsModalContainer');
            const closeModalBtn = document.getElementById('closeProductDetailsModalBtn');
            const modalAddToCartBtn = document.getElementById('productDetailsModalAddToCartBtn');

            if (productDetailsModal && closeModalBtn && modalAddToCartBtn) {
                // Listener para el botón de cerrar la modal
                closeModalBtn.addEventListener('click', closeProductDetailsModal);

                // Listener para cerrar la modal haciendo clic fuera de su contenido principal
                productDetailsModal.addEventListener('click', (event) => {
                    // Asegurarse de que el clic fue directamente en el fondo de la modal, no en el contenido
                    const modalContent = productDetailsModal.querySelector('.bg-white.rounded-lg'); // Ajusta el selector si la clase del contenido principal cambia
                    if (modalContent && !modalContent.contains(event.target)) {
                         closeProductDetailsModal();
                    } else if (event.target === productDetailsModal) { // Si no se encontró el contenido o el clic fue directamente en la modal (respaldo)
                         closeProductDetailsModal();
                    }
                });
            } else {
                console.error('DOMContentLoaded: No se encontraron todos los elementos de la modal de detalles del producto.');
            }

            // ... existing code for other logic (branch selection, etc.) ...

        }); // Cierre correcto del listener DOMContentLoaded

        document.addEventListener('DOMContentLoaded', function() {
            const reservaModal = document.getElementById('reservaModalContainer');
            const closeReservaModalBtn = document.getElementById('closeReservaModalBtn');
            if (reservaModal && closeReservaModalBtn) {
                closeReservaModalBtn.addEventListener('click', function() {
                    reservaModal.classList.remove('opacity-100');
                    reservaModal.classList.add('opacity-0');
                    reservaModal.addEventListener('transitionend', function handler() {
                        reservaModal.classList.add('hidden', 'pointer-events-none');
                        reservaModal.removeEventListener('transitionend', handler);
                    });
                });
                // Cerrar la modal haciendo clic fuera del contenido
                reservaModal.addEventListener('click', function(event) {
                    const modalContent = reservaModal.querySelector('.bg-white.rounded-lg');
                    if (modalContent && !modalContent.contains(event.target)) {
                        reservaModal.classList.remove('opacity-100');
                        reservaModal.classList.add('opacity-0');
                        reservaModal.addEventListener('transitionend', function handler() {
                            reservaModal.classList.add('hidden', 'pointer-events-none');
                            reservaModal.removeEventListener('transitionend', handler);
                        });
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('cambiar-sucursal-btn-logo');
            const menu = document.getElementById('sucursal-dropdown-menu');
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });

    </script>

</body>
</html> 