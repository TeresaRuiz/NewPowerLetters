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
                        <!-- serach button  -->
                        <i class="ri-search-line search-button" id="search-button"></i>
                        <!-- login button  -->
                        <i class="ri-user-line login-button" id="login-button"></i>
                        <!-- Carrito button  -->
                        <a href="carrito.html"><i class="ri-shopping-cart-fill carrito-button" id="carrito-button"></i></a>
                        <!-- theame button  -->
                        <i class="ri-moon-line change-theme" id="theme-button"></i>
                        <!-- logout button -->
                        <a href="#" onclick="logOut()"><i class="ri-logout-box-line"></i> Cerrar sesión</a>
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
                        <li class="nav__item">
                            <a href="../Public/comentarios.html" class="nav__link">
                                <i class="ri-message-3-line"></i>
                                <span>Comentarios</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nav__actions">
                    <!-- serach button  -->
                    <i class="ri-search-line search-button" id="search-button"></i>
                    <!-- login button  -->
                    <i class="ri-user-line login-button" id="login-button"></i>
                    <!-- Carrito button  -->
                    <a href="carrito.html"><i class="ri-shopping-cart-fill carrito-button" id="carrito-button"></i></a>
                    <!-- theame button  -->
                    <i class="ri-moon-line change-theme" id="theme-button"></i>
                    <!-- login link -->
                    <a href="login.html" class="nav__link"><i class="ri-login-box-line"></i> Iniciar sesión</a>
                </div>
            </nav>
        `;
        document.body.insertBefore(header, document.body.firstChild);
    }

    // Se agrega el pie de la página web después del último hijo del body.
    const footer = document.createElement('footer');
    footer.classList.add('footer');
    document.body.appendChild(footer);
}



