// Crea el elemento header
const header = document.createElement('header');
header.classList.add('header');
header.id = 'header';

// Agrega el contenido del header
header.innerHTML = `

<header class="header" id="header">
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
                  <a href="../Public/libros_recomendados.html" class="nav__link">
                     <i class="ri-book-3-line"></i>
                     <span>Libros</span>
                  </a>
               </li>

               <li class="nav__item">
                  <a href="../Public/libros_recomendados.html" class="nav__link">
                     <i class="ri-book-3-line"></i>
                     <span>Generos</span>
                  </a>
               </li>
               <li class="nav__item">
                  <a href="../Public/libros_recomendados.html" class="nav__link">
                     <i class="ri-book-3-line"></i>
                     <span>Categorias</span>
                  </a>
               </li>

               <li class="nav__item">
                  <a href="../Public/comentarios.html" class="nav__link">
                     <i class="ri-message-3-line"></i>
                     <span>Descuento</span>
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

               <!-- login button  -->

            <i class="ri-user-line login-button" id="login-button"></i>

              <!-- theame button  -->

              <i class="ri-moon-line change-theme" id="theme-button"></i>
               



         </div>

      </nav>
</header>
`;



// Inserta el header al principio del body
document.body.insertBefore(header, document.body.firstChild);


// Función para manejar el clic en el enlace con la clase "dropdown-toggle"
document.addEventListener("DOMContentLoaded", function() {
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener("click", function(e) {
            e.preventDefault(); // Evita que el enlace se siga al hacer clic
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });
    });
});
