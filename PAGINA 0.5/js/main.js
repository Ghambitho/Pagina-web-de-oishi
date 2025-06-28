let currentBranch = null;
let productsForBranch = [];

// Definir el orden deseado de las categorías (Necesario para renderizar y filtrar)
const categoryOrder = [
    "Entradas",
    "Entradas calientes",
    "hand rolls",
    "Rolls california",
    "Rolls tradicionales",
    "Rolls de la casa oishi",
    "Hot roll",
    "Rolls sin arroz",
    "Hot vegetarianos",
    "Rolls vegetarianos",
    "Ceviches y platos frios oishi",
    "Colaciones",
    "Gohan",
    "Platos calientes especiales",
    "Ramen",
    "Bebidas y jugos",
    "Promociones",
    "Salsas",
    "Tortas"
];

// Mapeo de las nuevas categorías de filtro a las categorías de products.js
const categoryFilterMapping = {
    "Carta": ["Entradas", "Entradas calientes", "hand rolls", "Rolls california", "Rolls tradicionales", "Rolls de la casa oishi", "Hot roll", "Rolls sin arroz", "Hot vegetarianos", "Rolls vegetarianos", "Ceviches y platos frios oishi", "Salsas"],
    "Promociones": ["Promociones", "Tortas"],
    "Platos Calientes y Ramen": ["Platos calientes especiales", "Colaciones", "Ramen"],
    "Bebidas": ["Bebidas y jugos"]
};

// Función mejorada para obtener el carrito
function getCart() {
    if (!currentBranch) {
        return [];
    }
    try {
        const cart = localStorage.getItem(`carro_${currentBranch}`);
        return cart ? JSON.parse(cart) : [];
    } catch (error) {
        return [];
    }
}

// Función mejorada para guardar el carrito
function saveCart(cart) {
    if (!currentBranch) {
        console.error('No se ha establecido la sucursal actual');
        return;
    }
    try {
        localStorage.setItem(`carro_${currentBranch}`, JSON.stringify(cart));
    } catch (error) {
        console.error('Error al guardar el carrito:', error);
    }
}

// Función mejorada para agregar al carrito
function agregarAlCarro(id) {
    if (!currentBranch) {
        alert('Por favor, selecciona una sucursal primero');
        return;
    }

    const cart = getCart();
    const product = productsForBranch.find(p => p.id === id);
    
    if (!product) {
        console.error('Producto no encontrado:', id);
        return;
    }

    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        existingItem.cantidad += 1;
    } else {
        cart.push({
            id: product.id,
            nombre: product.nombre,
            precio: product.precio,
            cantidad: 1
        });
    }

    saveCart(cart);
    renderCart();
    mostrarCarroLateral();
}

// Función mejorada para quitar del carrito
function quitarDelCarro(id) {
    if (!currentBranch) {
        console.error('No se ha establecido la sucursal actual');
        return;
    }

    const cart = getCart();
    const itemIndex = cart.findIndex(item => item.id === id);
    
    if (itemIndex === -1) {
        console.error('Producto no encontrado en el carrito:', id);
        return;
    }

    if (cart[itemIndex].cantidad > 1) {
        cart[itemIndex].cantidad -= 1;
    } else {
        cart.splice(itemIndex, 1);
    }

    saveCart(cart);
    renderCart();
}

// Función mejorada para renderizar el carrito
function renderCart() {
    const cartContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    if (!cartContainer || !cartTotal) return;

    const cart = getCart();
    
    if (cart.length === 0) {
        cartContainer.innerHTML = '<p class="text-gray-500 text-center py-4">El carrito está vacío</p>';
        cartTotal.textContent = '$0';
        return;
    }

    let total = 0;
    cartContainer.innerHTML = cart.map(item => {
        const subtotal = item.precio * item.cantidad;
        total += subtotal;
        return `
            <div class="flex items-center justify-between py-2 border-b">
                <div class="flex-1">
                    <h4 class="text-sm font-medium">${item.nombre}</h4>
                    <p class="text-xs text-gray-500">$${item.precio.toLocaleString('es-CL')} x ${item.cantidad}</p>
                </div>
                <div class="flex items-center">
                    <button onclick="quitarDelCarro(${item.id})" class="text-red-500 hover:text-red-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                    <span class="mx-2 text-sm">${item.cantidad}</span>
                    <button onclick="agregarAlCarro(${item.id})" class="text-green-500 hover:text-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
    }).join('');

    cartTotal.textContent = `$${total.toLocaleString('es-CL')}`;
}

// Función optimizada para crear elementos de producto
function createProductElement(prod) {
    const productCard = document.createElement('div');
    productCard.className = "bg-white rounded-lg shadow-md flex flex-col items-center justify-between cursor-pointer transition-transform hover:scale-105";
    productCard.style.cssText = "width: 170px; height: 170px;";
    productCard.dataset.productId = prod.id;

    // Determinar la imagen a usar
    let imageSrc = 'img/oishi sushi-1.jpg'; // Imagen por defecto
    if (prod.categoria === 'Tortas') {
        imageSrc = 'torta1.jpg';
    } else if (prod.categoria === 'Promociones') {
        imageSrc = 'promo1.jpg';
    }

    const innerCardHTML = `
        <img src="${imageSrc}" alt="${prod.nombre}" class="w-20 h-20 object-cover mt-3 rounded" />
        <div class="flex flex-col items-center justify-center flex-grow px-2 py-1 w-full">
            <h3 class="text-[15px] sm:text-base font-semibold text-gray-800 text-center mb-1 truncate w-full" title="${prod.nombre}">${prod.nombre}</h3>
            <p class="text-[17px] sm:text-lg font-bold text-red-600 mt-1">$${prod.precio.toLocaleString('es-CL')}</p>
            ${prod.categoria === 'Tortas' ? '<p class="text-xs text-gray-500 mt-1 text-center w-full truncate" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></p>' : ''}
        </div>
    `;

    productCard.innerHTML = innerCardHTML;

    // Agregar event listener
    productCard.addEventListener('click', (event) => {
        const productId = productCard.dataset.productId;
        if (productId) {
            const isTorta = (window.reservasProductos && window.reservasProductos.some(r => r.id === Number(productId))) || 
                           (prod.categoria && prod.categoria.trim().toLowerCase().replace(/\s+/g, '') === 'tortas');
            if (isTorta) {
                showReservaModal(Number(productId));
            } else {
                showProductDetailsModal(Number(productId), event);
            }
        }
    });

    return productCard;
}

// Función optimizada para renderizar el menú
function renderMenu(productsToDisplay, filterCategory = null) {
    const menu = document.getElementById('menu-productos');
    if (!menu) return;

    // Agrupar productos por categoría
    const productsByCategory = productsToDisplay.reduce((acc, product) => {
        const category = product.categoria || 'Otros';
        if (!acc[category]) acc[category] = [];
        acc[category].push(product);
        return acc;
    }, {});

    // Agregar tortas si estamos en la categoría Promociones
    if (filterCategory === 'Promociones' && window.reservasProductos) {
        if (!productsByCategory['Tortas']) productsByCategory['Tortas'] = [];
        productsByCategory['Tortas'] = [...window.reservasProductos];
    }

    // Limpiar el menú actual
    menu.innerHTML = '';
    const containerDiv = document.createElement('div');
    containerDiv.className = "max-w-6xl mx-auto px-2 py-8";
    menu.appendChild(containerDiv);

    // Definir categorías a renderizar
    const categoriesToRender = filterCategory && categoryFilterMapping[filterCategory]
        ? categoryOrder.filter(cat => categoryFilterMapping[filterCategory].includes(cat))
        : categoryOrder;

    // Renderizar cada categoría
    categoriesToRender.forEach(category => {
        if (productsByCategory[category] && productsByCategory[category].length > 0) {
            const section = document.createElement('section');
            section.className = "mb-16";
            section.innerHTML = `<h2 class="text-3xl sm:text-4xl font-extrabold font-poppins text-gray-700 mb-8 capitalize">${category}</h2>`;

            const productsDiv = document.createElement('div');
            productsDiv.className = "flex flex-wrap gap-6 sm:gap-8 justify-start";

            // Ordenar productos por precio si es necesario
            let productsList = productsByCategory[category];
            if (category === 'Promociones' || category === 'Tortas') {
                productsList = [...productsList].sort((a, b) => a.precio - b.precio);
            }

            // Renderizar cada producto
            productsList.forEach(prod => {
                if (prod.precio > 0) {
                    const productCard = createProductElement(prod);
                    productsDiv.appendChild(productCard);
                }
            });

            section.appendChild(productsDiv);
            containerDiv.appendChild(section);
        }
    });
}

// Nueva función para filtrar productos por la categoría seleccionada y renderizar
function filterAndRenderMenu(selectedCategory) {
    console.log('Filtering menu for category:', selectedCategory);

    const categoriesToInclude = categoryFilterMapping[selectedCategory];

    if (!categoriesToInclude) {
        console.error('Category filter mapping not found for:', selectedCategory);
        return;
    }

    // Filtrar los productos que están en las categorías a incluir para la sucursal actual
    const filteredProducts = productsForBranch.filter(product =>
        categoriesToInclude.includes(product.categoria)
    );

    console.log(`Found ${filteredProducts.length} products for category ${selectedCategory}.`);
    renderMenu(filteredProducts, selectedCategory); // Pasar la categoría de filtro para el manejo especial de Tortas

    // Actualizar el estilo del botón activo
    const categoryButtons = document.querySelectorAll('#category-filter-bar .category-btn');
    categoryButtons.forEach(button => {
        if (button.dataset.category === selectedCategory) {
            button.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
            button.classList.add('bg-red-500', 'text-white', 'hover:bg-red-600');
        } else {
            button.classList.remove('bg-red-500', 'text-white', 'hover:bg-red-600');
            button.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
        }
    });

}

// Función optimizada para mostrar la modal de detalles del producto
function showProductDetailsModal(productId, event) {
    const product = productsForBranch.find(p => p.id === Number(productId));
    if (!product) return;

    // Solo aplicar la lógica de reservas en promociones.html y si la categoría es 'Tortas'
    const isPromocionesPage = document.body.classList.contains('page-promociones');
    let esReserva = false;
    if (isPromocionesPage && product.categoria && product.categoria.trim().toLowerCase().replace(/\s+/g, '') === 'tortas') {
        esReserva = true;
    }

    if (esReserva) {
        // --- MODAL ESPECIAL DE RESERVA ---
        const reservaModal = document.getElementById('reservaModalContainer');
        const reservaImage = document.getElementById('reservaModalImage');
        const reservaTitle = document.getElementById('reservaModalTitle');
        const reservaDescription = document.getElementById('reservaModalDescription');
        const reservaPrice = document.getElementById('reservaModalPrice');
        const reservaWhatsappBtn = document.getElementById('reservaModalWhatsappBtn');
        const closeReservaModalBtn = document.getElementById('closeReservaModalBtn');

        if (!reservaModal || !reservaImage || !reservaTitle || !reservaDescription || !reservaPrice || !reservaWhatsappBtn || !closeReservaModalBtn) {
            console.error('No se encontraron elementos de la modal de reserva');
            return;
        }

        reservaImage.src = 'img/oishi sushi-1.jpg';
        reservaImage.alt = product.nombre;
        reservaTitle.textContent = product.nombre;
        reservaDescription.textContent = product.descripcion;
        reservaPrice.textContent = `$${product.precio.toLocaleString('es-CL')}`;

        reservaWhatsappBtn.onclick = function() {
            const mensaje = encodeURIComponent('Hola, quiero reservar una torta de sushi 🥢🎂');
            window.open(`https://wa.me/56926138846?text=${mensaje}`, '_blank');
        };

        // Mostrar la modal de reserva y ocultar la normal
        reservaModal.classList.remove('hidden', 'pointer-events-none', 'opacity-0');
        reservaModal.style.display = 'flex';
        setTimeout(() => {
            reservaModal.classList.add('opacity-100');
        }, 10);

        // Cerrar la modal de reserva
        closeReservaModalBtn.onclick = function() {
            reservaModal.classList.remove('opacity-100');
            reservaModal.classList.add('opacity-0');
            reservaModal.addEventListener('transitionend', function handler() {
                reservaModal.classList.add('hidden', 'pointer-events-none');
                reservaModal.removeEventListener('transitionend', handler);
            });
        };

        // Asegurarse de que la modal normal esté oculta
        const modal = document.getElementById('productDetailsModalContainer');
        if (modal) {
            modal.classList.add('hidden', 'pointer-events-none', 'opacity-0');
            modal.style.display = 'none';
        }
        return;
    }

    // --- MODAL NORMAL PARA EL RESTO DE PRODUCTOS ---
    const modal = document.getElementById('productDetailsModalContainer');
    const modalImage = document.getElementById('productDetailsModalImage');
    const modalTitle = document.getElementById('productDetailsModalTitle');
    const modalDescription = document.getElementById('productDetailsModalDescription');
    const modalPrice = document.getElementById('productDetailsModalPrice');
    const modalAddToCartBtn = document.getElementById('productDetailsModalAddToCartBtn');
    let modalWhatsappBtn = document.getElementById('productDetailsModalWhatsappBtn');

    if (!modal || !modalImage || !modalTitle || !modalDescription || !modalPrice || !modalAddToCartBtn) {
        console.error('showProductDetailsModal: Elementos de la modal de producto no encontrados (ver logs anteriores)!');
        return;
    }

    // Llenar la modal con los detalles del producto
    modalImage.src = 'img/oishi sushi-1.jpg';
    modalImage.alt = product.nombre;
    modalTitle.textContent = product.nombre;
    modalDescription.textContent = product.descripcion;
    modalPrice.textContent = `$${product.precio.toLocaleString('es-CL')}`;
    modalAddToCartBtn.dataset.productId = product.id;

    // Mostrar botón de añadir al carrito y ocultar el de WhatsApp
    modalAddToCartBtn.style.display = 'block';
    if (modalWhatsappBtn) modalWhatsappBtn.style.display = 'none';
    // Restaurar funcionalidad normal
    modalAddToCartBtn.onclick = function() {
        window.agregarAlCarro(Number(product.id));
        closeProductDetailsModal();
    };

    // Mostrar la modal normal
    modal.classList.remove('hidden', 'pointer-events-none', 'opacity-0');
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.add('opacity-100');
    }, 10);

    // Asegurarse de que la modal de reserva esté oculta
    const reservaModal = document.getElementById('reservaModalContainer');
    if (reservaModal) {
        reservaModal.classList.add('hidden', 'pointer-events-none', 'opacity-0');
        reservaModal.style.display = 'none';
    }
}

// Nueva función para cerrar la modal de detalles del producto
function closeProductDetailsModal() {
    console.log('closeProductDetailsModal: Llamada a cerrar modal.');
    const modalContainer = document.getElementById('productDetailsModalContainer'); // Correct ID
    if (modalContainer) {
        modalContainer.classList.remove('opacity-100');
        modalContainer.classList.add('opacity-0');
        // Esperar a que termine la transición de opacidad antes de ocultar completamente y resetear estilos
        modalContainer.addEventListener('transitionend', function handler() {
            modalContainer.classList.add('hidden', 'pointer-events-none');
            // Opcional: resetear display y z-index si no se confía completamente en las clases de utilidad
            // modalContainer.style.display = '';
            // modalContainer.style.zIndex = '';
            modalContainer.removeEventListener('transitionend', handler); // Remover el listener después de ejecutarse
        });
    } else {
        console.warn('closeProductDetailsModal: No se encontró #productDetailsModalContainer para cerrar.');
        // Si no se encuentra el contenedor, intentar cerrar la modal vieja si existiera (fallback)
        if (modal) { // Check if the old modal ID exists
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            modal.addEventListener('transitionend', function handler() {
                modal.classList.add('hidden', 'pointer-events-none');
                modal.removeEventListener('transitionend', handler); // Remover el listener después de ejecutarse
            });
        }
    }
}

// Mostrar el carrito lateral
function mostrarCarroLateral() {
    const carritoLateral = document.getElementById('carrito-lateral');
    if (carritoLateral) {
        carritoLateral.classList.remove('translate-x-full');
        carritoLateral.classList.add('translate-x-0');
    }
}

// Cerrar el carrito lateral
function cerrarCarroLateral() {
    const carritoLateral = document.getElementById('carrito-lateral');
    if (carritoLateral) {
        carritoLateral.classList.remove('translate-x-0');
        carritoLateral.classList.add('translate-x-full');
    }
}

function finalizarPedido() {
  const cart = getCart();
  if (cart.length > 0) {
    if(currentBranch) {
         localStorage.setItem('currentBranchForCheckout', currentBranch);
    } else {
         const lastBranch = localStorage.getItem('currentBranch');
         if(lastBranch) localStorage.setItem('currentBranchForCheckout', lastBranch);
    }

    window.location.href = 'index.php';
  } else {
    alert('Tu carrito está vacío.');
  }
}

// Función de búsqueda
function filterProducts(searchTerm) {
    const searchTermLower = searchTerm.toLowerCase();
    if (typeof window.menuProductsData === 'undefined' || !Array.isArray(window.menuProductsData)) {
        console.error('menuProductsData no está disponible globalmente o no es un array.');
        return;
    }

    const productsToFilter = window.menuProductsData;

    const filteredProducts = productsToFilter.filter(prod => {
      const nombreMatch = prod.nombre ? prod.nombre.toLowerCase().includes(searchTermLower) : false;
      const descMatch = prod.descripcion ? prod.descripcion.toLowerCase().includes(searchTermLower) : false;
      const categoriaMatch = prod.categoria ? prod.categoria.toLowerCase().includes(searchTermLower) : false;

      return nombreMatch || descMatch || categoriaMatch;
    });
    renderMenu(filteredProducts);
}

// Función para renderizar el resumen del pedido en la página de Checkout
function renderResumenPedidoCheckout() {
    const resumenContainer = document.getElementById('resumen-pedido');
    if (!resumenContainer) return;

    const cart = getCart();
    if (cart.length === 0) {
        resumenContainer.innerHTML = '<p class="text-gray-500 text-center py-4">No hay productos en el carrito</p>';
        return;
    }

    let listaHTML = '';
    let total = 0;

    cart.forEach(item => {
        const subtotal = item.precio * item.cantidad;
        total += subtotal;
        listaHTML += `
            <div class="flex justify-between items-center border-b pb-2 mb-2 last:border-b-0 last:pb-0 last:mb-0 item-checkout" data-product-id="${item.id}">
                <div class="flex-1">
                    <span class="text-gray-700 text-sm">${item.nombre} x${item.cantidad}</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-900 font-semibold mr-4">$${subtotal.toLocaleString('es-CL')}</span>
                    <button class="text-red-600 hover:text-red-800 transition-colors delete-item-btn" aria-label="Eliminar producto" data-product-id="${item.id}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
    });

    resumenContainer.innerHTML = `
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-lg font-semibold mb-4">Resumen del Pedido</h3>
            <div class="space-y-2">
                ${listaHTML}
            </div>
            <div class="mt-4 pt-4 border-t">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">Total:</span>
                    <span class="text-xl font-bold text-red-600">$${total.toLocaleString('es-CL')}</span>
                </div>
            </div>
        </div>
    `;

    // Agregar event listeners para los botones de eliminar
    attachDeleteEventListeners();
}

// Nueva función para eliminar un producto del carrito en Checkout
function removeItemFromCheckout(productId) {
    const currentBranchForCheckout = localStorage.getItem('currentBranchForCheckout');
    if (!currentBranchForCheckout) return;

    let cart = getCart();

    const itemIndex = cart.findIndex(item => item.id === productId);

    if (itemIndex > -1) {
        cart.splice(itemIndex, 1);

        saveCart(cart);

        renderResumenPedidoCheckout();

         const carroCantidad = document.getElementById('carro-cantidad');
         if (carroCantidad) {
             const totalCantidad = cart.reduce((acc, item) => acc + item.cantidad, 0);
             carroCantidad.textContent = totalCantidad;
         }
    }
}

// Función para adjuntar event listeners a los botones de eliminar
function attachDeleteEventListeners() {
    const deleteButtons = document.querySelectorAll('.delete-item-btn');
    deleteButtons.forEach(button => {
        if (!button.dataset.listenerAttached) {
            button.addEventListener('click', () => {
                const productId = parseInt(button.dataset.productId);
                removeItemFromCheckout(productId);
            });
            button.dataset.listenerAttached = 'true';
        }
    });
}

// Función mejorada para manejar el envío del formulario de checkout
function handleCheckoutFormSubmit(event) {
    event.preventDefault();
    
    if (!currentBranchForCheckout) {
        alert('Por favor, selecciona una sucursal primero');
        return;
    }

    const form = event.target;
    const formData = new FormData(form);
    const cart = getCart();

    if (cart.length === 0) {
        alert('El carrito está vacío');
        return;
    }

    // Validar campos requeridos
    const requiredFields = ['nombre', 'telefono', 'direccion'];
    const missingFields = requiredFields.filter(field => !formData.get(field));
    
    if (missingFields.length > 0) {
        alert(`Por favor completa los siguientes campos: ${missingFields.join(', ')}`);
        return;
    }

    // Validar formato de teléfono
    const telefono = formData.get('telefono');
    if (!/^\+?[0-9]{8,12}$/.test(telefono)) {
        alert('Por favor ingresa un número de teléfono válido');
        return;
    }

    // Validar formato de email si se proporciona
    const email = formData.get('email');
    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert('Por favor ingresa un email válido');
        return;
    }

    // Validar tipo de entrega y método de pago
    const tipoEntrega = formData.get('tipo_entrega');
    const metodoPago = formData.get('metodo_pago');
    if (!tipoEntrega || !metodoPago) {
        alert('Por favor selecciona tipo de entrega y método de pago');
        return;
    }
    if (tipoEntrega === 'delivery' && metodoPago === 'efectivo') {
        alert('El pago en efectivo solo está disponible para retiro en local.');
        return;
    }

    // Calcular total
    const total = cart.reduce((acc, item) => acc + item.precio * item.cantidad, 0);

    // Preparar datos del pedido
    const orderData = {
        sucursal: currentBranchForCheckout,
        fecha: new Date().toISOString(),
        cliente: {
            nombre: formData.get('nombre'),
            telefono: formData.get('telefono'),
            email: formData.get('email') || '',
            direccion: formData.get('direccion'),
            instrucciones: formData.get('instrucciones') || ''
        },
        items: cart.map(item => ({
            id: item.id,
            nombre: item.nombre,
            cantidad: item.cantidad,
            precioUnitario: item.precio
        })),
        total: total,
        estado: 'pendiente',
        tipo_entrega: tipoEntrega,
        metodo_pago: metodoPago
    };

    // Enviar el pedido al backend
    fetch('procesar_pedido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            saveCart([]); // Limpiar carrito solo si fue exitoso
            // Mostrar confirmación visual
            document.body.innerHTML = `<div class='min-h-screen flex flex-col items-center justify-center bg-green-50'><div class='bg-white p-8 rounded-xl shadow-lg text-center'><h2 class='text-2xl font-bold text-green-700 mb-4'>¡Pedido realizado con éxito!</h2><p class='mb-4'>Gracias por tu compra. Te contactaremos pronto para coordinar la entrega.</p><a href='user_dashboard.php' class='inline-block mt-4 px-6 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition'>Ir a mi panel</a></div></div>`;
        } else {
            alert('Error al registrar el pedido: ' + (data.message || 'Intenta nuevamente.'));
        }
    })
    .catch(error => {
        console.error('Error al enviar el pedido:', error);
        alert('Hubo un error al procesar tu pedido. Por favor, intenta nuevamente.');
    });
}

// Función para deshabilitar el enlace de la página actual en la barra de navegación
function disableCurrentPageLink() {
    console.log('disableCurrentPageLink function executed');
    const currentPage = document.body.classList;
    const navLinks = document.querySelectorAll('nav a');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href !== '#') { // Excluir enlaces ancla y la modal de sucursal si usa #
            const linkPage = href.split('/').pop().split('.')[0]; // Obtiene el nombre del archivo sin extensión

            let shouldDisable = false;
            if (linkPage === 'index' && currentPage.contains('page-index')) shouldDisable = true;
            if (linkPage === 'promociones' && currentPage.contains('page-promociones')) shouldDisable = true;
            if (linkPage === 'Sucursales' && currentPage.contains('page-sucursales')) shouldDisable = true;
            // Las páginas de menú (irarra y valle) se consideran la misma 'página de menú' lógicamente
            if (linkPage.startsWith('menu-') && (currentPage.contains('page-menu-irarra') || currentPage.contains('page-menu-valle'))) shouldDisable = true;
            if (linkPage === 'checkout' && currentPage.contains('page-checkout')) shouldDisable = true;

            // Excluir explícitamente el enlace de "Pedir Online" si su href no es la página actual
            // En index.php, el link de Pedir Online es '#'. En las páginas de menú, no hay un link directo de Pedir Online en la nav bar.
            // En promociones y sucursales, hay un link a '#' con id #pedir-online-link
            // En checkout, hay un link a '#' para el carrito
            // Identificaremos los enlaces por su href y potencialmente por su ID para mayor precisión

            // Deshabilitar si es la página actual Y NO es el enlace de Pedir Online (identificado por ID)
            const isPedirOnlineLink = link.id === 'pedir-online-link' || link.id === 'pedir-online-link-mobile';
             // En checkout, el enlace del carrito no debe deshabilitarse de esta forma
            const isCarritoLinkInCheckout = currentPage.contains('page-checkout') && href === '#' && link.textContent.trim() === 'Carrito';

            if (shouldDisable && !isPedirOnlineLink && !isCarritoLinkInCheckout) {
                link.classList.add('nav-link-disabled');
                link.setAttribute('aria-disabled', 'true');
                link.setAttribute('tabindex', '-1');
            }
        }
         // Deshabilitar el botón de carrito en las páginas de menú si es la página de menú (redundante, ya no hay link directo en nav)
        // if ((currentPage.contains('page-menu-irarra') || currentPage.contains('page-menu-valle')) && (link.id === 'carrito-btn' || link.id === 'carrito-btn-mobile')) {
        //      // No deshabilitar el ícono flotante, solo los de la nav bar si existieran
        // }
    });
}

// Añadir estilos CSS para la clase nav-link-disabled (esto debería ir en styles.css idealmente, pero lo añado aquí temporalmente para probar)
// const style = document.createElement('style');
// style.textContent = `
// .nav-link-disabled {
//     color: #9ca3af !important; /* Tailwind gray-400 */
//     pointer-events: none;
//     text-decoration: none !important;
//     cursor: default;
// }
// `;
// document.head.appendChild(style);

// Inicialización
window.addEventListener('DOMContentLoaded', () => {
  console.log('DOMContentLoaded event fired - Consolidated');

  const body = document.body;
  const isMenuPage = body.classList.contains('page-menu-irarra') || body.classList.contains('page-menu-valle');
  const isCheckoutPage = body.classList.contains('page-checkout');
  const isSucursalesPage = body.classList.contains('page-sucursales');
  const isIndexPage = body.classList.contains('page-index');
  const isPromocionesPage = body.classList.contains('page-promociones');

  // Lógica para la modal de selección de sucursal (solo en páginas que no son de menú)
  const sucursalModal = document.getElementById('sucursal-modal');
  const modalSelectBranches = document.querySelectorAll('.modal-select-branch');
  const closeModalBtnSucursal = document.getElementById('close-modal');
  const pedirOnlineLink = document.getElementById('pedir-online-link');
  const pedirOnlineLinkMobile = document.getElementById('pedir-online-link-mobile');
  const hazPedidoButton = document.getElementById('haz-pedido-button');

  if (sucursalModal && modalSelectBranches.length > 0 && closeModalBtnSucursal && !isMenuPage) {
      const pideButtons = [];
      if (pedirOnlineLink) pideButtons.push(pedirOnlineLink);
      if (pedirOnlineLinkMobile) pideButtons.push(pedirOnlineLinkMobile);
      if (hazPedidoButton) pideButtons.push(hazPedidoButton);

      pideButtons.forEach(button => {
          button.addEventListener('click', (event) => {
              event.preventDefault();
              sucursalModal.classList.remove('opacity-0', 'pointer-events-none');
              sucursalModal.classList.add('opacity-100');
          });
      });

      modalSelectBranches.forEach(button => {
          button.addEventListener('click', () => {
              const selectedBranch = button.dataset.sucursal;
              localStorage.setItem('currentBranch', selectedBranch);
              localStorage.setItem('currentBranchForCheckout', selectedBranch);
              if (selectedBranch === 'irarra') {
                  window.location.href = 'irrazavalsucursal.php';
              } else if (selectedBranch === 'valle') {
                  window.location.href = 'vallesucursal.php';
              }
          });
      });

      closeModalBtnSucursal.addEventListener('click', () => {
          sucursalModal.classList.remove('opacity-100');
          sucursalModal.classList.add('opacity-0');
          setTimeout(() => {
               sucursalModal.classList.add('pointer-events-none');
          }, 300);
      });

      sucursalModal.addEventListener('click', (event) => {
          if (event.target === sucursalModal) {
               sucursalModal.classList.remove('opacity-100');
               sucursalModal.classList.add('opacity-0');
               setTimeout(() => {
                    sucursalModal.classList.add('pointer-events-none');
               }, 300);
          }
      });
  }

  // Lógica específica para las páginas de menú
  if (isMenuPage) {
      console.log('Página de menú detectada. Sucursal:', currentBranch);

      if (body.dataset.sucursal) {
          currentBranch = body.dataset.sucursal;
           console.log('Sucursal actual desde data-sucursal:', currentBranch);
      }

      // Inicialización de elementos del carrito (solo en páginas de menú)
      const carritoBtnDesktop = document.getElementById('carrito-btn');
      const carritoBtnMobile = document.getElementById('carrito-btn-mobile');
      const carritoFlotanteBtn = document.getElementById('carrito-flotante-btn');
      const cerrarCarroBtn = document.getElementById('cerrar-carro');
      const finalizarPedidoBtn = document.querySelector('#carro-lateral .carro-boton');

      if (carritoBtnDesktop) carritoBtnDesktop.addEventListener('click', window.mostrarCarroLateral);
      if (carritoBtnMobile) carritoBtnMobile.addEventListener('click', window.mostrarCarroLateral);
      if (carritoFlotanteBtn) carritoFlotanteBtn.addEventListener('click', window.mostrarCarroLateral);
      if (cerrarCarroBtn) cerrarCarroBtn.addEventListener('click', window.cerrarCarroLateral);
      if (finalizarPedidoBtn) finalizarPedidoBtn.addEventListener('click', window.finalizarPedido);

      // Inicializar carrito y renderizar (solo en páginas de menú)
      window.renderCart();

      // Inicializar la búsqueda (solo en páginas de menú)
      const searchInput = document.getElementById('search-input');
      if (searchInput) {
          searchInput.addEventListener('input', (event) => {
              const searchTerm = event.target.value;
              window.filterProducts(searchTerm);
          });
      }

      // Inicializar el dropdown de sucursales en la nav (solo en páginas de menú)
      const menuDropdownBtn = document.getElementById('dropdown-btn');
      const menuDropdown = document.getElementById('sucursal-dropdown');
      const menuDireccionActual = document.getElementById('direccion-actual');
      const menuDropdownItems = document.querySelectorAll('#sucursal-dropdown .dropdown-item');

      if (menuDropdownBtn && menuDropdown && menuDireccionActual && menuDropdownItems.length > 0) {
          // Mostrar el nombre de la sucursal actual en la nav
          const sucursalNombre = currentBranch === 'irarra' ? 'Av. Irarrázaval' : 'Av. Trans. Uno';
          menuDireccionActual.textContent = sucursalNombre;
          // Listener para abrir/cerrar dropdown
          menuDropdownBtn.addEventListener('click', () => {
              menuDropdown.classList.toggle('hidden');
          });
          // Listeners para seleccionar sucursal desde dropdown
          menuDropdownItems.forEach(item => {
              item.addEventListener('click', (event) => {
                  event.preventDefault();
                  const selectedBranch = item.dataset.sucursal;
                  if (selectedBranch !== currentBranch) {
                      localStorage.setItem('currentBranch', selectedBranch);
                      localStorage.setItem('currentBranchForCheckout', selectedBranch);
                      window.location.href = `menu-${selectedBranch}.php`;
                  } else {
                      menuDropdown.classList.add('hidden'); // Ocultar si se selecciona la misma sucursal
                  }
              });
          });
          // Cerrar dropdown si se clica fuera
          document.addEventListener('click', (event) => {
              if (!menuDropdownBtn.contains(event.target) && !menuDropdown.contains(event.target)) {
                  menuDropdown.classList.add('hidden');
              }
          });
      }

      // Cargar y renderizar productos al cargar la página (solo en páginas de menú)
      if (typeof window.allProductsData !== 'undefined' && Array.isArray(window.allProductsData)) {
          // Filtrar productos por sucursal al cargar
          productsForBranch = window.allProductsData.filter(product => {
              const isDelivery = product.categoria === 'Delivery';
              const isIrarrarra = currentBranch === 'irarra';
              const isValle = currentBranch === 'valle';

              // Determinar si el producto debería incluirse basado en la sucursal y las categorías de filtro
              let shouldInclude = false;

              if (isDelivery) return false; // Excluir siempre la categoría Delivery

              // Lógica de inclusión basada en las categorías de filtro disponibles por sucursal
              if (isIrarrarra) {
                  // En Irarrázaval, incluir si la categoría del producto está en el mapeo de las categorías de filtro disponibles (Carta, Promociones, Bebidas)
                  shouldInclude = Object.entries(categoryFilterMapping).some(([filterName, categories]) =>
                      ['Carta', 'Promociones', 'Bebidas'].includes(filterName) && categories.includes(product.categoria)
                  );
              } else if (isValle) {
                  // En Ciudad de los Valles, incluir si la categoría del producto está en el mapeo de CUALQUIERA de las categorías de filtro (Carta, Promociones, Platos Calientes y Ramen, Bebidas)
                  shouldInclude = Object.values(categoryFilterMapping).some(categories =>
                      categories.includes(product.categoria)
                  );
              }

              // Asegurarse de que el producto tenga precio > 0 para ser incluido en el menú visual
              return shouldInclude && product.precio > 0;
          });
          console.log(`Productos cargados y filtrados por sucursal para ${currentBranch}:`, productsForBranch.length);

          // Filtrar y renderizar la categoría "Carta" por defecto
          filterAndRenderMenu('Carta');

          // Listeners para los botones de filtro de categoría (solo en páginas de menú)
          document.querySelectorAll('#category-filter-bar .category-btn').forEach(button => {
              button.addEventListener('click', () => {
                  const category = button.dataset.category;
                  window.filterAndRenderMenu(category);
              });
          });
      }

      // Inicializar la modal de detalles del producto (solo en páginas de menú)
      const productDetailsModal = document.getElementById('productDetailsModalContainer');
      const closeModalBtn = document.getElementById('closeProductDetailsModalBtn');

      if (productDetailsModal && closeModalBtn) {
          console.log('DOMContentLoaded (Menu Page): Elementos de la modal de detalles del producto encontrados para adjuntar listeners.');
          // Listener para el botón de cerrar la modal
          closeModalBtn.addEventListener('click', window.closeProductDetailsModal);

          // Listener para cerrar la modal haciendo clic fuera de su contenido principal
          productDetailsModal.addEventListener('click', (event) => {
              const modalContent = productDetailsModal.querySelector('.bg-white.rounded-lg');
              if (modalContent && !modalContent.contains(event.target)) {
                   window.closeProductDetailsModal();
              } else if (event.target === productDetailsModal) {
                   window.closeProductDetailsModal();
              }
          });

          // Delegación de eventos para el botón "Añadir al Carrito" dentro de la modal
          productDetailsModal.addEventListener('click', (event) => {
              if (productDetailsModal.classList.contains('opacity-100')) {
                  const modalAddToCartBtn = event.target.closest('#productDetailsModalAddToCartBtn');
                  if (modalAddToCartBtn) {
                      console.log('Clic detectado en el botón Añadir al Carrito (delegación).');
                      const productId = modalAddToCartBtn.dataset.productId;
                      if (productId) {
                          console.log('Añadiendo producto con ID:', productId);
                          window.agregarAlCarro(parseInt(productId));
                          window.closeProductDetailsModal();
                      } else {
                          console.error('modalAddToCartBtn (delegado): No se encontró el ID del producto en el data attribute.');
                      }
                  }
              }
          });
      } else {
          console.warn('DOMContentLoaded (Menu Page): No se encontraron elementos para la modal de detalles del producto.');
      }

      // Inicializar la modal de reserva (solo en páginas de menú)
       const reservaModal = document.getElementById('reservaModalContainer');
       const closeReservaModalBtn = document.getElementById('closeReservaModalBtn');

       if (reservaModal && closeReservaModalBtn) {
            console.log('DOMContentLoaded (Menu Page): Elementos de la modal de reserva encontrados.');
            // Listener para cerrar la modal de reserva
            closeReservaModalBtn.addEventListener('click', window.closeReservaModal);

            // Listener para cerrar la modal de reserva haciendo clic fuera
            reservaModal.addEventListener('click', (event) => {
                const modalContent = reservaModal.querySelector('.bg-white.rounded-lg');
                 if (modalContent && !modalContent.contains(event.target)) {
                     window.closeReservaModal();
                } else if (event.target === reservaModal) {
                    window.closeReservaModal();
                }
            });
       } else {
           console.warn('DOMContentLoaded (Menu Page): No se encontraron elementos para la modal de reserva.');
       }

  }

  // Lógica específica para la página de checkout
  if (isCheckoutPage) {
      console.log('Página de checkout detectada.');
      window.renderResumenPedidoCheckout();
      window.attachDeleteEventListeners();
      const checkoutForm = document.getElementById('checkout-form');
      if (checkoutForm) {
           checkoutForm.addEventListener('submit', window.handleCheckoutFormSubmit);
      }
  }

  // Lógica específica para la página de sucursales
  if (isSucursalesPage) {
       console.log('Página de sucursales detectada.');
       // Lógica específica de sucursales si la hay...
  }

  // Lógica que se ejecuta en todas las páginas
  window.disableCurrentPageLink();

  // Event listeners para la modal de notificaciones (global)
  const notificationModal = document.getElementById('notificationModal');
  const closeNotificationBtn = document.getElementById('closeNotificationModalBtn');

  if (notificationModal && closeNotificationBtn) {
      console.log('DOMContentLoaded: Elementos de la modal de notificación encontrados.');
       closeNotificationBtn.addEventListener('click', window.closeNotification);
       notificationModal.addEventListener('click', (event) => {
           const modalContent = notificationModal.querySelector('.bg-white.p-6.rounded-lg');
            if (modalContent && !modalContent.contains(event.target)) {
                window.closeNotification();
           }
       });
  } else {
      console.warn('DOMContentLoaded: Elementos de la modal de notificación no encontrados. La función showNotification() no funcionará.');
  }

}); // Fin DOMContentLoaded

// Asegurarse de que window.showNotification esté asignado a la función correcta si existe
// La función showNotification debe estar definida en algún lugar antes de esta línea si se usa.
// Si showModal no está definida, esto causará un ReferenceError. Usaremos showNotification si existe.
// window.showNotification = showModal; // Eliminar esta línea problemática

// Asumiendo que showNotification es la función correcta para la modal genérica
window.showNotification = typeof showNotification === 'function' ? showNotification : function(title, message) { console.warn('showNotification is not defined.'); alert(title + '\n' + message); };

// Asegurarse de que showProductDetailsModal esté disponible globalmente
window.showProductDetailsModal = showProductDetailsModal;

window.finalizarPedido = finalizarPedido;
window.filterAndRenderMenu = filterAndRenderMenu; // Exponer la función si es necesario llamarla globalmente

// Inicializar la sucursal actual basada en el atributo data-sucursal del body
document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    if (body) {
        currentBranch = body.getAttribute('data-sucursal');
        console.log('Sucursal actual:', currentBranch);
        
        // Inicializar productos para la sucursal actual
        if (window.allProductsData) {
            productsForBranch = window.allProductsData;
            console.log('Productos cargados para la sucursal:', productsForBranch.length);
        }
        
        // Renderizar el menú inicial
        renderMenu(productsForBranch);
        
        // Inicializar el carrito
        const cart = getCart();
        console.log('Carrito inicial:', cart);
        
        // Agregar event listeners para el carrito
        const carritoBtn = document.getElementById('carrito-btn');
        const carritoBtnMobile = document.getElementById('carrito-btn-mobile');
        
        if (carritoBtn) {
            carritoBtn.addEventListener('click', mostrarCarroLateral);
        }
        
        if (carritoBtnMobile) {
            carritoBtnMobile.addEventListener('click', mostrarCarroLateral);
        }
    }
});

// Exponer las funciones necesarias globalmente
window.agregarAlCarro = agregarAlCarro;
window.quitarDelCarro = quitarDelCarro;
window.mostrarCarroLateral = mostrarCarroLateral;
window.cerrarCarroLateral = cerrarCarroLateral;
window.finalizarPedido = finalizarPedido;

// Nueva función para mostrar la modal especial de reservas
function showReservaModal(productId) {
  const productoReserva = (window.reservasProductos || []).find(r => r.id === Number(productId));
  if (!productoReserva) return;
  const reservaModal = document.getElementById('reservaModalContainer');
  const reservaImage = document.getElementById('reservaModalImage');
  const reservaTitle = document.getElementById('reservaModalTitle');
  const reservaDesc = document.getElementById('reservaModalDescription');
  const reservaPrecio = document.getElementById('reservaModalPrice');
  const reservaBtn = document.getElementById('reservaWhatsappBtn');
  if (reservaModal && reservaImage && reservaTitle && reservaDesc && reservaPrecio && reservaBtn) {
    reservaImage.src = productoReserva.imagen;
    reservaTitle.textContent = productoReserva.nombre;
    reservaDesc.textContent = productoReserva.descripcion;
    reservaPrecio.textContent = '$' + productoReserva.precio.toLocaleString('es-CL');
    reservaBtn.onclick = function() {
      const mensaje = encodeURIComponent(productoReserva.mensaje || 'Hola, quiero reservar una torta de sushi 🥢🎂');
      window.open(`https://wa.me/56926138846?text=${mensaje}`, '_blank');
    };
    reservaModal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
    reservaModal.classList.add('flex');
  }
}

// Autocompletar el formulario con los datos del usuario logueado
window.addEventListener('DOMContentLoaded', function() {
    if (window.loggedUser) {
        const nombre = document.getElementById('nombre');
        const direccion = document.getElementById('direccion');
        const telefono = document.getElementById('telefono');
        const email = document.getElementById('email');
        if (nombre && window.loggedUser.nombre) nombre.value = window.loggedUser.nombre;
        if (direccion && window.loggedUser.direccion) direccion.value = window.loggedUser.direccion;
        if (telefono && window.loggedUser.telefono) telefono.value = window.loggedUser.telefono;
        if (email && window.loggedUser.email) email.value = window.loggedUser.email;
    }
    renderResumenPedidoCheckout();
});

// Verificar sucursal seleccionada al cargar la página
window.addEventListener('DOMContentLoaded', function() {
    if (!localStorage.getItem('currentBranch')) {
        // Si no hay sucursal, redirigir a index.php para forzar selección
        window.location.href = 'index.php';
        return;
    }
    // ... resto de tu código ...
});

// Funciones de notificación seguras
function showNotification(title, message) {
    const notificationModal = document.getElementById('notificationModal');
    const notificationTitle = document.getElementById('notificationTitle');
    const notificationMessage = document.getElementById('notificationMessage');
    if (!notificationModal || !notificationTitle || !notificationMessage) return;
    notificationTitle.textContent = title;
    notificationMessage.textContent = message;
    notificationModal.style.display = 'flex';
    notificationModal.classList.remove('opacity-0', 'pointer-events-none');
    notificationModal.classList.add('opacity-100');
}
function closeNotification() {
    const notificationModal = document.getElementById('notificationModal');
    if (!notificationModal) return;
    notificationModal.classList.add('opacity-0');
    setTimeout(() => {
        notificationModal.classList.add('pointer-events-none');
        notificationModal.style.display = 'none';
    }, 300);
}