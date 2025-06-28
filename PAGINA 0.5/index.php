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
    <title>Oishi Sushi - Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 font-inter">
    <?php include 'includes/navbar.php'; ?>

    <!-- HERO -->
    <section class="relative h-[60vh] md:h-[70vh] flex items-center justify-center bg-cover bg-center" style="background-image: url('img/hero-sushi.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="relative z-10 text-center text-white max-w-2xl mx-auto">
            <img src="img/Logo index 2.png" alt="Oishi Sushi Logo" class="mx-auto mb-6 h-20 w-auto">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">El mejor sushi a domicilio</h1>
            <p class="text-lg md:text-xl mb-6">Frescura, sabor y calidad en cada pieza. ¡Haz tu pedido y disfruta en casa!</p>
            <a href="#" id="hero-order-button" class="inline-block px-8 py-3 bg-red-600 text-white font-bold rounded-lg text-lg shadow-lg hover:bg-red-700 transition-colors">Haz tu Pedido Ahora</a>
        </div>
    </section>

    <!-- PROMOCIONES DESTACADAS -->
    <section id="promos" class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-red-600 mb-10">Promociones Destacadas</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="promo-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row items-center" 
                     data-img="img/promo1.jpg" 
                     data-title="Promo 50 piezas" 
                     data-desc="50 piezas surtidas para compartir" 
                     data-price="$22.000">
                    <img src="img/promo1.jpg" alt="Promo 1" class="w-full md:w-1/2 h-48 object-cover">
                    <div class="p-6 flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Promo 50 piezas</h3>
                        <p class="text-gray-600 mb-4">50 piezas surtidas para compartir</p>
                        <p class="text-2xl font-bold text-red-600 mb-4">$22.000</p>
                        <button class="promo-ver-mas-btn block w-full bg-red-500 text-white py-2 rounded-md text-center font-semibold hover:bg-red-600 transition-colors"
                            data-img="img/promo1.jpg" 
                            data-title="Promo 50 piezas" 
                            data-desc="50 piezas surtidas para compartir" 
                            data-price="$22.000">
                            Ver más
                        </button>
                    </div>
                </div>
                <div class="promo-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row items-center" 
                     data-img="img/promo2.jpg" 
                     data-title="Promo fútbol" 
                     data-desc="60 piezas para ver el partido" 
                     data-price="$21.000">
                    <img src="img/promo2.jpg" alt="Promo 2" class="w-full md:w-1/2 h-48 object-cover">
                    <div class="p-6 flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Promo fútbol</h3>
                        <p class="text-gray-600 mb-4">60 piezas para ver el partido</p>
                        <p class="text-2xl font-bold text-red-600 mb-4">$21.000</p>
                        <button class="promo-ver-mas-btn block w-full bg-red-500 text-white py-2 rounded-md text-center font-semibold hover:bg-red-600 transition-colors"
                            data-img="img/promo2.jpg" 
                            data-title="Promo fútbol" 
                            data-desc="60 piezas para ver el partido" 
                            data-price="$21.000">
                            Ver más
                        </button>
                    </div>
                </div>
                <div class="promo-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row items-center" 
                     data-img="img/promo3.jpg" 
                     data-title="Promo 20 piezas" 
                     data-desc="Ideal para una comida rápida" 
                     data-price="$8.500">
                    <img src="img/promo3.jpg" alt="Promo 3" class="w-full md:w-1/2 h-48 object-cover">
                    <div class="p-6 flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Promo 20 piezas</h3>
                        <p class="text-gray-600 mb-4">Ideal para una comida rápida</p>
                        <p class="text-2xl font-bold text-red-600 mb-4">$8.500</p>
                        <button class="promo-ver-mas-btn block w-full bg-red-500 text-white py-2 rounded-md text-center font-semibold hover:bg-red-600 transition-colors"
                            data-img="img/promo3.jpg" 
                            data-title="Promo 20 piezas" 
                            data-desc="Ideal para una comida rápida" 
                            data-price="$8.500">
                            Ver más
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TORTAS DE SUSHI -->
    <section id="tortas" class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-green-600 mb-10">Tortas de Sushi</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gray-50 rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row items-center">
                    <img src="img/torta1.jpg" alt="Torta de sushi 100 piezas" class="w-full md:w-1/2 h-48 object-cover">
                    <div class="p-6 flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Torta de sushi 100 piezas</h3>
                        <p class="text-gray-600 mb-4">Sushi surtidos, ideal para celebraciones</p>
                        <p class="text-2xl font-bold text-green-700 mb-4">$50.000</p>
                        <a href="https://wa.me/56926138846?text=Hola,%20quiero%20reservar%20una%20torta%20de%20sushi%20🥢🎂" target="_blank" class="block w-full bg-green-600 text-white py-2 rounded-md text-center font-semibold hover:bg-green-700 transition-colors">👉 Reservar por WhatsApp</a>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row items-center">
                    <img src="img/torta2.jpg" alt="Torta de sushi 60 piezas" class="w-full md:w-1/2 h-48 object-cover">
                    <div class="p-6 flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Torta de sushi 60 piezas</h3>
                        <p class="text-gray-600 mb-4">La promo de 60 piezas surtidas</p>
                        <p class="text-2xl font-bold text-green-700 mb-4">$35.000</p>
                        <a href="https://wa.me/56926138846?text=Hola,%20quiero%20reservar%20una%20torta%20de%20sushi%20🥢🎂" target="_blank" class="block w-full bg-green-600 text-white py-2 rounded-md text-center font-semibold hover:bg-green-700 transition-colors">👉 Reservar por WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BOTÓN FLOTANTE DE WHATSAPP -->
    <a href="https://wa.me/56926138846?text=Hola,%20quiero%20hacer%20un%20pedido%20de%20sushi!" target="_blank" class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg p-4 flex items-center justify-center text-3xl">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- FOOTER -->
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

    <!-- MODAL DE DETALLES DE PROMOCIÓN -->
    <div id="promoModalContainer" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-lg mx-auto relative">
            <button id="closePromoModalBtn" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl p-1 bg-gray-200 rounded-full hover:bg-gray-300 transition-colors">&times;</button>
            <img id="promoModalImage" src="" alt="Imagen de la Promoción" class="w-full h-48 object-cover rounded-md mb-4">
            <h3 id="promoModalTitle" class="text-2xl font-bold mb-2"></h3>
            <p id="promoModalDescription" class="text-gray-700 mb-4"></p>
            <div id="promoModalPrice" class="text-lg font-semibold text-red-700 mb-6"></div>
        </div>
    </div>

    <!-- MODAL DE SELECCIÓN DE SUCURSAL -->
    <div id="sucursal-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm w-full text-center relative">
            <button id="close-modal" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800">&times;</button>
            <h2 class="text-2xl font-bold mb-4">Escoge tu Sucursal</h2>
            <button data-sucursal="irarra" class="modal-select-branch bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg block w-full mb-4 transition-colors">Sucursal Irarrázaval</button>
            <button data-sucursal="valle" class="modal-select-branch bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg block w-full transition-colors">Sucursal Ciudad de los Valles</button>
        </div>
    </div>

    <!-- Notification Modal - Unificada función de notificación/modal -->
    <div id="notificationModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-lg mx-auto relative">
            <button id="closeNotificationModal" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl p-1 bg-gray-200 rounded-full hover:bg-gray-300 transition-colors">&times;</button>
            <h2 id="notificationTitle" class="text-2xl font-bold mb-2"></h2>
            <p id="notificationMessage" class="text-gray-700 mb-4"></p>
        </div>
    </div>

    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        document.addEventListener('DOMContentLoaded', function() {
            // Modal de detalles de promoción
            const promoModal = document.getElementById('promoModalContainer');
            const closePromoModalBtn = document.getElementById('closePromoModalBtn');
            const sucursalModal = document.getElementById('sucursal-modal');
            const modalSelectBranches = document.querySelectorAll('.modal-select-branch');
            const closeModalBtnSucursal = document.getElementById('close-modal');
            const pedirOnlineLink = document.getElementById('pedir-online-link');
            const pedirOnlineLinkMobile = document.getElementById('pedir-online-link-mobile');
            const heroOrderButton = document.getElementById('hero-order-button'); // Botón del Hero

            if (promoModal && closePromoModalBtn) {
                closePromoModalBtn.addEventListener('click', function() {
                    promoModal.classList.remove('opacity-100');
                    promoModal.classList.add('opacity-0');
                    promoModal.addEventListener('transitionend', function handler() {
                        promoModal.classList.add('hidden', 'pointer-events-none');
                        promoModal.removeEventListener('transitionend', handler);
                    });
                });
                promoModal.addEventListener('click', function(event) {
                    const modalContent = promoModal.querySelector('.bg-white.rounded-lg');
                    if (modalContent && !modalContent.contains(event.target)) {
                        promoModal.classList.remove('opacity-100');
                        promoModal.classList.add('opacity-0');
                        promoModal.addEventListener('transitionend', function handler() {
                            promoModal.classList.add('hidden', 'pointer-events-none');
                            promoModal.removeEventListener('transitionend', handler);
                        });
                    }
                });
            }
            // Listeners para los botones 'Ver más' de promociones
            document.querySelectorAll('.promo-ver-mas-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const card = btn.closest('.promo-card');
                    if (!card) return;
                    document.getElementById('promoModalImage').src = card.dataset.img || '';
                    document.getElementById('promoModalTitle').textContent = card.dataset.title || '';
                    document.getElementById('promoModalDescription').textContent = card.dataset.desc || '';
                    document.getElementById('promoModalPrice').textContent = card.dataset.price || '';
                    promoModal.classList.remove('hidden', 'pointer-events-none', 'opacity-0');
                    promoModal.style.display = 'flex';
                    setTimeout(() => { promoModal.classList.add('opacity-100'); }, 10);
                });
            });

            // Función para mostrar la modal de sucursal
            function showSucursalModal(e) {
                e.preventDefault(); // Evita la acción por defecto del enlace o botón
                sucursalModal.classList.remove('hidden', 'pointer-events-none', 'opacity-0');
                sucursalModal.style.display = 'flex';
                setTimeout(() => { sucursalModal.classList.add('opacity-100'); }, 10);
            }

            // Listeners para abrir la modal de sucursal con los botones "Pedir Online" y "Haz tu Pedido Ahora"
            if (pedirOnlineLink) {
                pedirOnlineLink.addEventListener('click', showSucursalModal);
            }
            if (pedirOnlineLinkMobile) {
                pedirOnlineLinkMobile.addEventListener('click', showSucursalModal);
            }
            // Uso de querySelector para el botón "Haz tu Pedido Ahora" si no tiene ID, aunque la edición lo añadirá.
            // Es más robusto usar el ID que se añadirá.
            const hazPedidoButtonCheck = document.getElementById('hero-order-button');
             if (hazPedidoButtonCheck) {
                hazPedidoButtonCheck.addEventListener('click', showSucursalModal);
            }

            // Listeners para los botones de selección de sucursal
            modalSelectBranches.forEach(function(button) {
                button.addEventListener('click', function() {
                    const selectedBranch = this.dataset.sucursal;
                    localStorage.setItem('currentBranch', selectedBranch);
                    localStorage.setItem('currentBranchForCheckout', selectedBranch);
                    if (selectedBranch === 'irarra') {
                        window.location.href = 'irrazavalsucursal.php';
                    } else if (selectedBranch === 'valle') {
                        window.location.href = 'vallesucursal.php';
                    }
                });
            });

            // Cerrar modal de sucursal
            if (closeModalBtnSucursal) {
                closeModalBtnSucursal.addEventListener('click', function() {
                    sucursalModal.classList.remove('opacity-100');
                    sucursalModal.classList.add('opacity-0');
                    sucursalModal.addEventListener('transitionend', function handler() {
                        sucursalModal.classList.add('hidden', 'pointer-events-none');
                        sucursalModal.removeEventListener('transitionend', handler);
                    });
                });
            }

            // Cerrar modal de sucursal al hacer clic fuera
            sucursalModal.addEventListener('click', function(event) {
                const modalContent = sucursalModal.querySelector('.bg-white');
                if (modalContent && !modalContent.contains(event.target)) {
                    sucursalModal.classList.remove('opacity-100');
                    sucursalModal.classList.add('opacity-0');
                    sucursalModal.addEventListener('transitionend', function handler() {
                        sucursalModal.classList.add('hidden', 'pointer-events-none');
                        sucursalModal.removeEventListener('transitionend', handler);
                    });
                }
            });

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
    </script>
</body>
</html>
