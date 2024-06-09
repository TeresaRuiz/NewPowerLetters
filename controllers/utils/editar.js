/*
*   Controlador de uso general en las páginas web del sitio privado.
*   Sirve para manejar la plantilla del encabezado y pie del documento.
*/

// Constante para completar la ruta de la API.
const USER_API = 'services/public/usuario.php';
// Constante para establecer el elemento del contenido principal.
const MAIN = document.querySelector('main');
MAIN.style.paddingTop = '75px';
MAIN.style.paddingBottom = '100px';
MAIN.classList.add('container');
// Se establece el título de la página web.
document.querySelector('title').textContent = 'PowerLetters - Inicio_admin';
// Constante para establecer el elemento del título principal.
const MAIN_TITLE = document.getElementById('mainTitle');
MAIN_TITLE.classList.add('text-center', 'py-3');

/*  Función asíncrona para cargar el encabezado y pie del documento.
*   Parámetros: ninguno
*   Retorno: ninguno
*/
const loadTemplate = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal
            MAIN.insertAdjacentHTML('beforebegin', `
            
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
            </li>
                <!-- Carrito button  -->
                <a href="carrito.html"><i class="ri-shopping-cart-fill carrito-button" id="carrito-button"></i></a>
                <!-- theme button  -->
                <i class="ri-moon-line change-theme" id="theme-button"></i>
                <li class="nav__item nav__item-dropdown">
                <a href="#" class="nav__link nav__link-dropdown">
                    <i class="ri-book-3-line"></i>
                    Cuenta:<b>${DATA.username}</b>
                    <i class="ri-arrow-down-s-line dropdown-icon"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="../public/editarPerfil.html">Editar perfil</a></li>
                </ul>
                <!-- logout button -->
                <a href="#" onclick="logOut()"><i class="ri-logout-box-line"></i>Cerrar sesión</a>
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
    
             
            `);
            // Se agrega el pie de la página web después del contenido principal.
            MAIN.insertAdjacentHTML('afterend', `
                
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    } else {
        // Se comprueba si la página web es la principal, de lo contrario se direcciona a iniciar sesión.
        if (location.pathname.endsWith('index.html')) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                
            `);
            // Se agrega el pie de la página web después del contenido principal.
            MAIN.insertAdjacentHTML('afterend', `
                
            `);
        } else {
            location.href = 'index.html';
        }
    }
      // Configurar el cambio de tema.
      const themeButton = document.getElementById('theme-button');
      const darkTheme = 'dark-theme';
      const iconTheme = 'ri-sun-line';
  
      // Obtiene el tema e icono seleccionados previamente
      const selectedTheme = localStorage.getItem('selected-theme');
      const selectedIcon = localStorage.getItem('selected-icon');
  
      // Obtiene el tema e icono actuales
      const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light';
      const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'ri-moon-line' : 'ri-sun-line';
  
      // Valida si el usuario eligió un tema previamente
      if (selectedTheme) {
          document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme);
          themeButton.classList[selectedIcon === 'ri-moon-line' ? 'add' : 'remove'](iconTheme);
      }
  
      // Activa/desactiva el tema con el botón
      themeButton.addEventListener('click', () => {
          document.body.classList.toggle(darkTheme);
          themeButton.classList.toggle(iconTheme);
          localStorage.setItem('selected-theme', getCurrentTheme());
          localStorage.setItem('selected-icon', getCurrentIcon());
      });
}

