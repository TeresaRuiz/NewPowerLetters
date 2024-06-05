/*
*   Controlador es de uso general en las páginas web del sitio público.
*   Sirve para manejar las plantillas del encabezado y pie del documento.
*/

// Constante para completar la ruta de la API.
const USER_API = 'services/public/usuario.php';

const loadTemplate = async () => {
    // Petición para obtener el nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
    if (DATA.session) {
        // Se verifica si la página web no es el inicio de sesión, de lo contrario se direcciona a la página web principal.
        if (!location.pathname.endsWith('login.html')) {
            // Se crea el encabezado y se agrega antes del primer hijo del body.
            const header = document.createElement('header');
            header.classList.add('header');
            header.innerHTML = `
                <nav class="nav container">
                    <a href="#" class="nav__logo">
                        <i class="ri-book-3-line"></i> Power Letters
                    </a>
                    <div class="nav__menu">
                        <ul class="nav__list">
                            <li class="nav__item">
                                <a href="../Public/index.html" class="nav__link active-link">
                                    <i class="ri-home-line"></i>
                                    <span>Inicio</span>
                                </a>
                            </li>
                            <li class="nav__item">
                                <a href="../Public/descuento.html" class="nav__link">
                                    <i class="ri-bookmark-line"></i>
                                    <span>Libros nuevos</span>
                                </a>
                            </li>
                            <li class="nav__item">
                                <a href="../Public/libros_recomendados.html" class="nav__link">
                                    <i class="ri-book-3-line"></i>
                                    <span>Recomendados</span>
                                </a>
                            </li>
                            <li class="nav__item">
                                <a href="../Public/comentarios.html" class="nav__link">
                                    <i class="ri-message-3-line"></i>
                                    <span>Comentarios</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav__actions">
                        <!-- search button  -->
                        <i class="ri-search-line search-button" id="search-button"></i>
                        <!-- login button  -->
                        <i class="ri-user-line login-button" id="login-button"></i>
                        <!-- Carrito button  -->
                        <a href="carrito.html"><i class="ri-shopping-cart-fill carrito-button" id="carrito-button"></i></a>
                        <!-- theme button  -->
                        <i class="ri-moon-line change-theme" id="theme-button"></i>
                        <!-- logout button -->
                        <a href="#" onclick="logOut()"><i class="ri-logout-box-line"></i> Cerrar sesión</a>
                    </div>

                    <!--==================== SEARCH ====================-->
                    <div class="search" id="search-content">
                        <form action="" class="search__form">
                            <i class="ri-search-line search__icon"></i>
                            <input type="search" placeholder="What are you looking for?" class="search__input">
                        </form>
                        <i class="ri-close-line search__close" id="search-close"></i>
                    </div>

                    <!--==================== LOGIN ====================-->
                    <div class="login grid" id="login-content">
                        <form action="" class="login__form grid">
                            <h3 class="login__title">Log In</h3>
                            <div class="login__group grid">
                                <div>
                                    <label for="login-email" class="login__label">Email</label>
                                    <input type="email" placeholder="Write your email" id="login-email" class="login__input">
                                </div>
                                <div>
                                    <label for="login-pass" class="login__label">Password</label>
                                    <input type="password" placeholder="Enter your password" id="login-pass" class="login__input">
                                </div>
                            </div>
                            <div>
                                <span class="login__signup">You do not have an account? <a href="#">Sign up</a></span>
                                <a href="#" class="login__forget">You forgot your password</a>
                                <button type="submit" class="login__button button">Log In</button>
                            </div>
                        </form>
                        <i class="ri-close-line login__close" id="login-close"></i>
                    </div>
                </nav>
            `;
            document.body.insertBefore(header, document.body.firstChild);
        } else {
            location.href = 'index.html';
        }
    } else {
        // Se crea el encabezado de sesión no autenticada y se agrega antes del primer hijo del body.
        const header = document.createElement('header');
        header.classList.add('header');
        header.innerHTML = `
            <nav class="nav container">
                <a href="#" class="nav__logo">
                    <i class="ri-book-3-line"></i> Power Letters
                </a>
                <div class="nav__menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="../Public/index.html" class="nav__link active-link">
                                <i class="ri-home-line"></i>
                                <span>Inicio</span>
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="../Public/descuento.html" class="nav__link">
                                <i class="ri-bookmark-line"></i>
                                <span>Libros nuevos</span>
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="../Public/libros_recomendados.html" class="nav__link">
                                <i class="ri-book-3-line"></i>
                                <span>Recomendados</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nav__actions">
                <!-- search button  -->
                <i class="ri-search-line search-button" id="search-button"></i>
                <!-- theme button  -->
                <i class="ri-moon-line change-theme" id="theme-button"></i>
                <!-- login link -->
                <a href="index.html" class="nav__link"><i class="ri-user-line login-button" id="login-button"></i> Iniciar sesión</a>
            </div>
                <!--==================== SEARCH ====================-->
                <div class="search" id="search-content">
                    <form action="search-button" class="search__form">
                        <i class="ri-search-line search__icon"></i>
                        <input type="search" placeholder="What are you looking for?" class="search__input">
                    </form>
                    <i class="ri-close-line search__close" id="search-close"></i>
                </div>
                <!--==================== LOGIN ====================-->
                <div class="login grid" id="login-content">
                    <form action="" class="login__form grid">
                        <h3 class="login__title">Log In</h3>
                        <div class="login__group grid">
                            <div>
                                <label for="login-email" class="login__label">Email</label>
                                <input type="email" placeholder="Write your email" id="login-email" class="login__input">
                            </div>
                            <div>
                                <label for="login-pass" class="login__label">Password</label>
                                <input type="password" placeholder="Enter your password" id="login-pass" class="login__input">
                            </div>
                        </div>
                        <div>
                            <span class="login__signup">You do not have an account? <a href="#">Sign up</a></span>
                            <a href="#" class="login__forget">You forgot your password</a>
                            <button type="submit" class="login__button button">Log In</button>
                        </div>
                    </form>
                    <i class="ri-close-line login__close" id="login-close"></i>
                </div>
            </nav>
        `;
        document.body.insertBefore(header, document.body.firstChild);
    }

    const searchButton = document.getElementById('search-button');
    const searchClose = document.getElementById('search-close');
    const searchContent = document.getElementById('search-content');

    /* Mostrar formulario de búsqueda */
    if (searchButton && searchContent) {
        searchButton.addEventListener('click', () => {
            searchContent.classList.add('active');
        });
    }

    /* Ocultar formulario de búsqueda */
    if (searchClose && searchContent) {
        searchClose.addEventListener('click', () => {
            searchContent.classList.remove('active');
        });
    }

};
