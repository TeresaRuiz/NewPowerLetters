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

// Crea el elemento header
const footer = document.createElement('footer');
footer.classList.add('footer');
footer.id = 'footer';

// Agrega el contenido del header
footer.innerHTML = `
<footer class="footer">
         
         <div class="footer__container container grid">

            <div>

               <a href="#" class="footer__logo">
                  <i class="ri-book-3-line"></i> Power Letters
               </a>

               <p class="footer__description">
                  Encuentra y explora lo mejor <br>
                  de Power Letters de todos tus <br>
                  escritores favoritos.
               </p>

            </div>

            <div class="footer__data grid">

               <div>

                  <h3 class="footer__title">Sobre</h3>

                  <ul class="footer__links">
                     
                     <li class="footer__links">
                        <a href="" class="footer__link">Politica de privacidad</a>
                     </li>
                     
                     <li class="footer__links">
                        <a href="" class="footer__link">Equipo de servicios</a>
                     </li>


                  </ul>

               </div>


               <div>

                  <h3 class="footer__title">Compañia</h3>

                  <ul class="footer__links">
                     
                     <li class="footer__links">
                        <a href="" class="footer__link">Blogs</a>
                     </li>

                     <li class="footer__links">
                        <a href="" class="footer__link">Comunidad</a>
                     </li>

                     <li class="footer__links">
                        <a href="" class="footer__link"> Nuestro equipo</a>
                     </li>

                     <li class="footer__links">
                        <a href="" class="footer__link">Centro de ayuda</a>
                     </li>


                  </ul>

               </div>


               <div>

                  <h3 class="footer__title">Contacto</h3>

                  <ul class="footer__links">
                     
                     <li class="footer__links">
                        <address class="footer__info">
                           San Salvador <br>
                           Mejicanos, ITR
                        </address>
                     </li>


                     <li class="footer__links">
                        <address class="footer__info">
                            powerletters@gmail.com <br>
                            503 7884
                        </address>
                     </li>


                  </ul>

               </div>

               <div>

                  <h3 class="footer__title">Redes</h3>

                  <div class="footer__social">

                     <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                        <i class="ri-facebook-circle-line"></i>
                     </a>

                     <a href=" https://www.instagram.com/
                     " target="_blank" class="footer__social-link">
                        <i class="ri-instagram-line"></i>
                     </a>

                     <a href=" https://twitter.com/
                     " target="_blank" class="footer__social-link">
                        <i class="ri-twitter-x-line"></i>
                     </a>

                  </div>

               </div>

            </div>

         </div>

         <span class="footer__copy">
            &; Todos los derechos reservados a Teresa Ruiz y  Aniket Gawade
         </span>

      </footer>

      <!--========== SCROLL UP ==========-->
      
      <a href="#" class="scrollup" id="scroll-up">

         <i class="ri-arrow-up-line"></i>
      </a>
      `;

// Inserta el header al principio del body
document.body.appendChild(footer);


var modal = document.getElementById("myModal");
var btn = document.querySelector(".add-button");

// Ocultar el modal al cargar la página
modal.style.display = "none";

// Abrir el modal al hacer clic en el botón de añadir
btn.onclick = function () {
    modal.style.display = "block";
};

// Cerrar el modal de añadir al hacer clic en el botón de cierre
function closeModal() {
    modal.style.display = "none";
}


