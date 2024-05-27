// Constante para completar la ruta de la API.
const USER_API = 'services/admin/administrador.php';

// Función asíncrona para cargar el encabezado y pie del documento.
const loadTemplate = async () => {
    try {
        // Petición para obtener el nombre del usuario que ha iniciado sesión.
        const DATA = await fetchData(USER_API, 'getUser');
        // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
        if (DATA.session) {
            // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
            if (DATA.status) {
                // Crear y agregar el encabezado de la página web antes del contenido principal.
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
                                    <a href="../Private/inicio_admin.html" class="nav__link active-link">
                                        <i class="ri-home-line"></i>
                                        <span>Inicio</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a href="../Private/libros.html" class="nav__link">
                                        <i class="ri-book-3-line"></i>
                                        <span>Libros</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a href="../Private/generos.html" class="nav__link">
                                        <i class="ri-book-mark-line"></i>
                                        <span>Géneros</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a href="../Private/pedidos.html" class="nav__link">
                                        <i class="ri-shopping-cart-line"></i>
                                        <span>Pedidos</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a href="../Private/comentarios.html" class="nav__link">
                                        <i class="ri-message-3-line"></i>
                                        <span>Comentarios</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a href="../Private/usuarios.html" class="nav__link">
                                        <i class="ri-user-line"></i>
                                        <span>Clientes</span>
                                    </a>
                                </li>
                                <li class="nav__item nav__item-dropdown">
                                    <a href="#" class="nav__link nav__link-dropdown">
                                        <i class="ri-book-3-line"></i>
                                        <span>Más...</span>
                                        <i class="ri-arrow-down-s-line dropdown-icon"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../Private/autores.html">Autores</a></li>
                                        <li><a href="../Private/clasificacion.html">Clasificaciones</a></li>
                                        <li><a href="../Private/editoriales.html">Editoriales</a></li>
                                    </ul>
                                </li>
                                <i class="ri-user-line login-button" id="login-button"></i>
                                <i class="ri-moon-line change-theme" id="theme-button"></i>
                            </ul>
                        </div>
                    </nav>
                `;
                document.body.insertBefore(header, document.body.firstChild);

                // Se agrega el pie de la página web después del contenido principal.
                // Aquí puedes agregar el código HTML del pie de página.

                // Añadir funcionalidad para el menú desplegable
                document.addEventListener("DOMContentLoaded", function () {
                    const dropdownLinks = document.querySelectorAll('.nav__link-dropdown');
                    dropdownLinks.forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const dropdownMenu = this.nextElementSibling;
                            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                        });
                    });
                });
                // Configurar el cambio de tema
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
            } else {
                sweetAlert(3, DATA.error, false, 'index.html');
            }
        } else {
            // Redirigir a la página de inicio de sesión si no está autenticado
            location.href = 'index.html';
        }
    } catch (error) {
        console.error('Error loading template:', error);
    }
};

// Llamar a la función para cargar la plantilla cuando el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', loadTemplate);
