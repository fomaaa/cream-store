
      <footer class="footer">
        <!-- <?php //if ((!is_home() && !is_single() && !is_archive() || is_shop() || single_cat_title('', 0)) || !get_page_template_slug() == "template-pages/content-page.php"): ?> -->
        <?php if ( is_front_page() || is_product() || is_shop() || is_archive() || is_cart() || is_checkout() ) : ?>
          <div class="footer__top">
            <div class="container">
              <div class="callback">
                <div class="page__title"> Get updates </div>
                <div class="callback__form">
                  <?php echo do_shortcode('[contact-form-7 id="213" title="Subscribe" html_class="form form--callback"]') ?>
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
				  <svg version="1.1"
					   xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
					   x="0px" y="0px" width="40.4px" height="67.7px" viewBox="0 0 40.4 67.7"
					   xml:space="preserve">
					  <g>
						  <path class="st0" d="M0,43.6c4.3,14,17.3,24.1,32.7,24.1c2.7,0,5.2-0.3,7.7-0.9L26.9,43.6H0z"/>
						  <path class="st0" d="M40.4,0.9C26.2-2.4,10.9,3.7,3.2,17.1c-1.3,2.3-2.3,4.7-3.1,7.1l26.8,0L40.4,0.9z"/>
					  </g>
</svg>
              </a>
            </div>
          </div>
        </div>
      </footer>
      <div class="menuBox">
              <?php
                  wp_nav_menu( array(
                    'menu'            => 'right_nav',
                    'container'       => 'nav',
                    'container_class' => 'nav',
                    'menu_class'      => 'menu',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                  ) );
              ?>
        <a href="/?s=" class="btn btn--search">
          <svg class="icon icon-search">
            <use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/img/sprite.svg#icon-search"></use>
          </svg>
        </a>
      </div>


	  <div class="modal" id="searchBox">
		  <div class="modal-container">
			  <a href="javascript:void(0);" class="modal-close">
				  <svg class="icon icon-search">
					  <use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/img/sprite.svg#icon-cross"></use>
				  </svg>
			  </a>
			  <div class="searchBox">
				  <form action="/" class="form form--search">
					  <div class="form__field">
						  <input type="text" name="s" placeholder="type something" />
						  <button class="btn btn--search" type="submit">
							  <svg class="icon icon-search">
								  <use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/img/sprite.svg#icon-search"></use>
							  </svg>
						  </button>
					  </div>
				  </form>
			  </div>
		  </div>
	  </div>

    </div>
    <!-- END content -->
    <script>
      var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/js/app.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js_custom/ajax.js"></script>
	<?php wp_footer(); ?>
  </body>

</html>
