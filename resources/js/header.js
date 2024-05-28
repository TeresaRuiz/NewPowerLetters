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
                  <a href="../Public/descuento.html" class="nav__link">
                     <i class="ri-bookmark-line"></i>
                     <span>Nuevos Libros</span>
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
               
            <i class="ri-shopping-cart-fill carrito-button" id="carrito-button"></i>

              <!-- theame button  -->

              <i class="ri-moon-line change-theme" id="theme-button"></i>
               



         </div>

      </nav>
</header>







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
               <input type="password" placeholder="Enter your password
               " id="login-pass" class="login__input">
            </div>


         </div>

         <div>

            <span class="login__signup">
               ¿No tienes una cuenta? <a href="registro_c.html"> Registraté acá</a>
            </span>

            <a href="#" class="login__forget">

               Recupera tu contraseña
            </a> 


            <button type="submit" class="login__button button">Inicia sesión</button>
            
           
         </div>

      </form>   

      <i class="ri-close-line login__close" id="login-close"></i>

</div>
`;

// Inserta el header al principio del body
document.body.insertBefore(header, document.body.firstChild);
