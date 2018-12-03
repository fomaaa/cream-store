
      <footer class="footer">
        <!-- <?php //if ((!is_home() && !is_single() && !is_archive() || is_shop() || single_cat_title('', 0)) || !get_page_template_slug() == "template-pages/content-page.php"): ?> -->
        <?php if ( is_front_page() || is_product() || is_shop() || is_archive() || is_cart() || is_checkout() ) : ?>
          <div class="footer__top">
            <div class="container">
              <div class="callback">
                <div class="page__title"> Get updates </div>
                <div class="callback__form">
                  <form action="/" class="form form--callback">
                    <div class="form__field form__field--icon">
                      <div class="form__icon">
                        <i class="icon-envelope"></i>
                      </div>
                      <input type="text" class="input input--white" name="email" placeholder="Enter Your e-mail" />
                    </div>
                    <div class="form__button">
                      <button class="btn btn--link btn--md" type="submit">subscribe</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="container-fluid footer__inner">
          <div class="footer__left">
            <div class="copyright">  <?php the_field("coopyright_text", 'option'); ?> © <?php echo date('Y') ?> </div>
          </div>
          <div class="footer__center">
          	<?php 
                  wp_nav_menu( array(
                    'menu'            => 'footer_links', 
                    'menu_class'      => 'footerLinks', 
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                  ) );
              ?>
            <div class="footer__logo">
              <a <?php if(!is_front_page()) echo 'href="/"' ?>>
                <img src="<?php the_field("logo", 'option'); ?>" alt="logotype">
              </a>
            </div>
            <div class="footerSocial">
              <a href=" <?php the_field("instagram_link", 'option'); ?>" target="_blank">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/img/inst.png" alt="">
              </a>
            </div>
              <?php 
                  wp_nav_menu( array(
                    'menu'            => 'footer_links2', 
                    'menu_class'      => 'footerLinks footerLinks--secondary', 
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                  ) );
              ?>
          </div>
          <div class="footer__right">
            <div class="dev">
              <a href="http://www.creayou.com/" target="_blank">
                <svg width="67.229px" height="67.399px" viewBox="188.348 135.44 67.229 67.399">
                  <path d="M189.838,165.856c-1.255-7.266,1.354-15.158,6.69-20.932c9.938-10.751,27.556-12.284,39.616-4.992
	c-21.414-9.839-36.149,19.667-17.058,30.905c-3.035,6.293-11.013,9.593-17.329,8.012
	C190.826,176.113,189.838,165.856,189.838,165.856z" />
                  <path d="M234.213,197.35c-5.622,4.776-13.747,6.541-21.428,4.88c-14.312-3.094-24.589-17.488-24.436-31.584
	c2.411,23.443,35.312,21.14,35.291-1.015c6.961-0.583,13.858,4.612,15.708,10.853C242.547,191.292,234.213,197.35,234.213,197.35z" />
                  <path d="M239.696,143.614c6.908,2.588,12.402,8.82,14.688,16.348c4.258,14.008-3.326,29.981-15.704,36.708
	c19.313-13.507,1.293-41.133-18.058-30.333c-3.895-5.799-2.713-14.349,1.843-19C230.352,139.28,239.696,143.614,239.696,143.614z" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- END content -->
    <script>
      var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/js/app.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/ajax.js"></script>
	<?php wp_footer(); ?>

  </body>

</html>
