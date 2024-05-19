// Constante para completar la ruta de la API.
const USER_API = 'services/admin/administrador.php';

// Crea el elemento header
const header = document.createElement('header');
header.classList.add('header');
header.id = 'header';

// Agrega el contenido del header
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
                    <a href="../Private/libros.html"  class="nav__link">
                        <i class="ri-book-3-line"></i>
                        <span>Libros</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="../Private/generos.html" class="nav__link">
                        <i class="ri-book-3-line"></i>
                        <span>Géneros</span>
                    </a>
                </li>
               
                <li class="nav__item">
                    <a href="../Private/pedidos.html"  class="nav__link">
                        <i class="ri-book-3-line"></i>
                        <span>Pedidos</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="../Private/comentarios.html"  class="nav__link">
                        <i class="ri-message-3-line"></i>
                        <span>Comentarios</span>
                    </a>
                </li>

                <li class="nav__item">
                <a href="../Private/usuarios.html"  class="nav__link">
                    <i class="ri-message-3-line"></i>
                    <span>Usuarios</span>
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
                
                <!-- login button  -->

                <i class="ri-user-line login-button" id="login-button"></i>
    
                  <!-- theame button  -->
    
                  <i class="ri-moon-line change-theme" id="theme-button"></i>
            </ul>
        </div>
    </nav>
`;




// Inserta el header al principio del body
document.body.insertBefore(header, document.body.firstChild);


// Función para mostrar u ocultar el menú desplegable al hacer clic en el enlace "Autores"
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

