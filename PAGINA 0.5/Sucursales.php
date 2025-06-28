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
  <meta charset="UTF-8" />
  <title>Sucursales - Oishi Sushi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 font-inter page-sucursales">
    <div id="notificationModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none">
        <div class="bg-white p-6 rounded-lg shadow-xl text-center">
            <h3 id="notificationTitle" class="text-lg font-medium text-gray-900 mb-2">Notificación</h3>
            <p id="notificationMessage" class="text-sm text-gray-600 mb-4">Este es un mensaje de notificación.</p>
            <button id="closeNotificationModal" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Cerrar</button>
        </div>
    </div>

    <?php include 'includes/navbar.php'; ?>

    <main style="max-width:1100px; margin:0 auto; padding:0 24px;">
        <h1 style="color:var(--rojo-logo); margin:32px 0 24px 0;">Nuestras Sucursales</h1>
        <div class="sucursales-list">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold font-poppins text-red-600 mb-2">Oishi Sushi Ciudad de los Valles</h3>
                <p class="text-gray-700 mb-1"><span class="font-semibold">Dirección:</span> Av. Trans. Uno 905, Pudahuel</p>
                <p class="text-gray-700 mb-1"><span class="font-semibold">Teléfono:</span> +56 9 1234 5678</p>
                <p class="text-gray-700 mb-3"><span class="font-semibold">Horario:</span> Lun-Dom: 12:00 - 23:00</p>
                <a href="https://maps.google.com/?q=Av.+Trans.+Uno+905,+Pudahuel" target="_blank" class="inline-block px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-300 transition-colors">Ver en Mapa</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold font-poppins text-red-600 mb-2">Oishi Sushi Irarrázaval</h3>
                <p class="text-gray-700 mb-1"><span class="font-semibold">Dirección:</span> Av. Irarrázaval 5678, Ñuñoa</p>
                <p class="text-gray-700 mb-1"><span class="font-semibold">Teléfono:</span> +56 9 8765 4321</p>
                <p class="text-gray-700 mb-3"><span class="font-semibold">Horario:</span> Lun-Sáb: 12:30 - 22:30</p>
                <a href="https://maps.google.com/?q=Av.+Irarrázaval+5678,+Ñuñoa" target="_blank" class="inline-block px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-300 transition-colors">Ver en Mapa</a>
            </div>
        </div>
    </main>

    <!-- MODAL SUCURSAL MODERNA -->
    <div id="sucursal-modal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none hidden">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md mx-auto relative flex flex-col items-center">
            <button id="close-modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-900 text-2xl font-bold">&times;</button>
            <h2 class="text-2xl font-bold mb-8 text-center">Escoge tu Sucursal</h2>
            <button class="modal-select-branch bg-red-500 hover:bg-red-600 text-white font-semibold py-4 px-6 rounded-lg w-full mb-4 text-lg transition-colors" data-sucursal="irarra">Sucursal Irarrázaval</button>
            <button class="modal-select-branch bg-red-500 hover:bg-red-600 text-white font-semibold py-4 px-6 rounded-lg w-full text-lg transition-colors" data-sucursal="valle">Sucursal Ciudad de los Valles</button>
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

    <!-- Ícono de carrito flotante -->
    
    
    

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

        // Notification Modal - Unificada función de notificación/modal: solo showNotification y closeNotification, igual que promociones.html
        const notificationModal = document.getElementById('notificationModal');
        const notificationTitle = document.getElementById('notificationTitle');
        const notificationMessage = document.getElementById('notificationMessage');
        const closeNotificationModalButton = document.getElementById('closeNotificationModal');

        // MODAL SUCURSAL MODERNA functionality
        const sucursalModal = document.getElementById('sucursal-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const pedirOnlineLinks = document.querySelectorAll('#pedir-online-link, #pedir-online-link-mobile');
        const branchSelectButtons = document.querySelectorAll('.modal-select-branch');

        // Generic function to show a modal
        function showModal(modalElement) {
            modalElement.classList.remove('hidden'); // Remove Tailwind's hidden class first
            modalElement.style.display = 'flex'; // Explicitly set display to flex
            modalElement.classList.remove('opacity-0', 'pointer-events-none');
            modalElement.classList.add('opacity-100');
        }

        // Generic function to hide a modal
        function hideModal(modalElement) {
            modalElement.classList.add('opacity-0');
            setTimeout(() => {
                modalElement.classList.add('hidden'); // Add Tailwind's hidden class back
                modalElement.style.display = 'none'; // Explicitly set display to none
                modalElement.classList.add('pointer-events-none');
            }, 300);
        }

        // Notification Modal Specific Logic
        function showNotification(title, message) {
            notificationTitle.textContent = title;
            notificationMessage.textContent = message;
            showModal(notificationModal);
        }

        function closeNotification() {
            hideModal(notificationModal);
        }

        closeNotificationModalButton.addEventListener('click', closeNotification);
        // Close modal if clicked outside the content
        notificationModal.addEventListener('click', (event) => {
            if (event.target === notificationModal) {
                closeNotification();
            }
        });

        // Branch Selection Modal Specific Logic

        // Open modal when clicking Pedir Online
        pedirOnlineLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Pedir Online link clicked!');
                showModal(sucursalModal);
            });
        });

        // Close modal
        closeModalBtn.addEventListener('click', () => {
            hideModal(sucursalModal);
        });

        // Handle branch selection
        branchSelectButtons.forEach(button => {
            button.addEventListener('click', () => {
                const sucursal = button.getAttribute('data-sucursal');
                if (sucursal === 'irarra') {
                    window.location.href = 'irrazavalsucursal.php';
                } else if (sucursal === 'valle') {
                    window.location.href = 'vallesucursal.php';
                }
                hideModal(sucursalModal); // Hide modal after selection
            });
        });

        // Close modal when clicking outside
        sucursalModal.addEventListener('click', (e) => {
            if (e.target === sucursalModal) {
                hideModal(sucursalModal);
            }
        });

        // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
    <script src="js/main.js"></script>
    <script src="js/products.js"></script>
    <script src="js/reservas.js"></script>
</body>
</html> 