// Crea el elemento header
const footer = document.createElement('footer');
footer.classList.add('footer');
footer.id = 'footer';

// Agrega el contenido del header
header.innerHTML = `
<footer class="footer">
         
         <div class="footer__container container grid">

            <div>

               <a href="#" class="footer__logo">
                  <i class="ri-book-3-line"></i> E-Book
               </a>

               <p class="footer__description">
                  Find and explore the best <br>
                  eBooks from all your <br>
                  favorite writers.
               </p>

            </div>

            <div class="footer__data grid">

               <div>

                  <h3 class="footer__title">About</h3>

                  <ul class="footer__links">
                     
                     <li class="footer__links">
                        <a href="" class="footer__link">Awards</a>
                     </li>

                     <li class="footer__links">
                        <a href="" class="footer__link">FAQs</a>
                     </li>

                     <li class="footer__links">
                        <a href="" class="footer__link">Privacy policy</a>
                     </li>
                     
                     <li class="footer__links">
                        <a href="" class="footer__link">Terms of services</a>
                     </li>


                  </ul>

               </div>


               <div>

                  <h3 class="footer__title">Company</h3>

                  <ul class="footer__links">
                     
                     <li class="footer__links">
                        <a href="" class="footer__link">Blogs</a>
                     </li>

                     <li class="footer__links">
                        <a href="" class="footer__link">Community</a>
                     </li>

                     <li class="footer__links">
                        <a href="" class="footer__link"> Our team</a>
                     </li>

                     <li class="footer__links">
                        <a href="" class="footer__link">Help center</a>
                     </li>


                  </ul>

               </div>


               <div>

                  <h3 class="footer__title">Contact</h3>

                  <ul class="footer__links">
                     
                     <li class="footer__links">
                        <address class="footer__info">
                           Av. Lokhandwala <br>
                           Lima 41,Mumbai-86 
                        </address>
                     </li>


                     <li class="footer__links">
                        <address class="footer__info">
                            ebook@gmail.com <br>
                            0987-654-321 
                        </address>
                     </li>


                  </ul>

               </div>

               <div>

                  <h3 class="footer__title">Social</h3>

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
            &#169; All Rights Reserved By Aniket Gawade
         </span>

      </footer>

      <!--========== SCROLL UP ==========-->
      
      <a href="#" class="scrollup" id="scroll-up">

         <i class="ri-arrow-up-line"></i>
      </a>
      `;

      // Inserta el header al principio del body
      document.body.insertBefore(header, document.body.firstChild);