// Selecciona el botón del carrito y el contenedor de productos en el carrito
const btnCart = document.querySelector('.container-cart-icon');
const containerCartProducts = document.querySelector('.container-cart-products');

// Agrega un evento de clic al botón del carrito para mostrar/ocultar el contenedor de productos en el carrito
btnCart.addEventListener('click', () => {
	containerCartProducts.classList.toggle('hidden-cart');
});

/* ========================= */

// Selecciona elementos relevantes del carrito de compras
const cartInfo = document.querySelector('.cart-product');
const rowProduct = document.querySelector('.row-product');

// Lista de todos los contenedores de productos disponibles
const productsList = document.querySelector('.container-items');

// Arreglo que almacenará los productos seleccionados
let allProducts = [];

// Selecciona elementos adicionales del carrito de compras
const valorTotal = document.querySelector('.total-pagar');
const countProducts = document.querySelector('#contador-productos');
const cartEmpty = document.querySelector('.cart-empty');
const cartTotal = document.querySelector('.cart-total');

// Agrega un evento de clic a la lista de productos disponibles para añadir productos al carrito
productsList.addEventListener('click', e => {
	if (e.target.classList.contains('btn-add-cart')) {
		const product = e.target.parentElement;

		// Obtiene la información del producto seleccionado
		const infoProduct = {
			quantity: 1,
			title: product.querySelector('h2').textContent,
			price: product.querySelector('p').textContent,
		};

		// Verifica si el producto ya está en el carrito
		const exists = allProducts.some(
			product => product.title === infoProduct.title
		);

		if (exists) {
			// Si el producto ya está en el carrito, actualiza la cantidad
			const products = allProducts.map(product => {
				if (product.title === infoProduct.title) {
					product.quantity++;
					return product;
				} else {
					return product;
				}
			});
			allProducts = [...products];
		} else {
			// Si el producto no está en el carrito, lo agrega
			allProducts = [...allProducts, infoProduct];
		}

		// Muestra los productos en el carrito
		showHTML();
	}
});

// Agrega un evento de clic a los botones de eliminación de productos en el carrito
rowProduct.addEventListener('click', e => {
	if (e.target.classList.contains('icon-close')) {
		const product = e.target.parentElement;
		const title = product.querySelector('p').textContent;

		// Filtra el producto que se va a eliminar del carrito
		allProducts = allProducts.filter(
			product => product.title !== title
		);

		// Actualiza la vista del carrito
		showHTML();
	}
});

// Función para mostrar los productos en el carrito
const showHTML = () => {
	if (!allProducts.length) {
		// Si no hay productos en el carrito, muestra un mensaje de carrito vacío
		cartEmpty.classList.remove('hidden');
		rowProduct.classList.add('hidden');
		cartTotal.classList.add('hidden');
	} else {
		// Si hay productos en el carrito, muestra los productos y el total a pagar
		cartEmpty.classList.add('hidden');
		rowProduct.classList.remove('hidden');
		cartTotal.classList.remove('hidden');
	}

	// Limpiar el contenido anterior del carrito
	rowProduct.innerHTML = '';

	let total = 0;
	let totalOfProducts = 0;

	// Itera sobre todos los productos en el carrito y los muestra en la vista
	allProducts.forEach(product => {
		const containerProduct = document.createElement('div');
		containerProduct.classList.add('cart-product');

		containerProduct.innerHTML = `
            <div class="info-cart-product">
                <span class="cantidad-producto-carrito">${product.quantity}</span>
                <p class="titulo-producto-carrito">${product.title}</p>
                <span class="precio-producto-carrito">${product.price}</span>
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="icon-close"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        `;

		rowProduct.append(containerProduct);

		// Calcula el total a pagar y el número total de productos en el carrito
		total += parseInt(product.quantity * product.price.slice(1));
		totalOfProducts += product.quantity;
	});

	// Actualiza el total a pagar y el número total de productos en el carrito
	valorTotal.innerText = `$${total}`;
	countProducts.innerText = totalOfProducts;
};
