// Crea el elemento footer
const footer = document.createElement('footer');
footer.classList.add('footer');
footer.id = 'footer';

// Agrega el contenido del footer
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
                        <a href="url_privacidad" class="footer__link">Politica de privacidad</a>
                     </li>
                     
                     <li class="footer__links">
                        <a href="url_servicios" class="footer__link">Equipo de servicios</a>
                     </li>


                  </ul>

               </div>


               <div>

                  <h3 class="footer__title">Compañia</h3>

                  <ul class="footer__links">
                     
                     <li class="footer__links">
                        <a href="url_blogs" class="footer__link">Blogs</a>
                     </li>

                     <li class="footer__links">
                        <a href="url_comunidad" class="footer__link">Comunidad</a>
                     </li>

                     <li class="footer__links">
                        <a href="url_equipo" class="footer__link"> Nuestro equipo</a>
                     </li>

                     <li class="footer__links">
                        <a href="url_ayuda" class="footer__link">Centro de ayuda</a>
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

                     <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                        <i class="ri-instagram-line"></i>
                     </a>

                     <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                        <i class="ri-twitter-x-line"></i>
                     </a>

                  </div>

               </div>

            </div>

         </div>

         <span class="footer__copy">
            &copy; Todos los derechos reservados a Teresa Ruiz y  Aniket Gawade
         </span>

      </footer>

      <!--========== SCROLL UP ==========-->
      
      <a href="#" class="scrollup" id="scroll-up">
         <i class="ri-arrow-up-line"></i>
      </a>
`;

// Inserta el footer al final del body
document.body.appendChild(footer);
