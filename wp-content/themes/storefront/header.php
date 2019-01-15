<!doctype html>
<html>

  <head>
    <meta charset="utf-8" />
    <title><?php getCorrectTitle() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#fff" />
    <meta name="format-detection" content="telephone=no" />
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/app.css">
  </head>

  <body class="">
    <!-- BEGIN content -->
    <div class="out">
      <header class="header <?php if (is_home() || (is_single() && !is_product()) || (is_archive() && !is_shop()  && !is_product_category())  || get_page_template_slug() == "template-pages/content-page.php") echo 'header--white' ?>">
        <div class="container-fluid header__inner">
          <div class="header__left">
            <div class="header__logo">
              <a <?php if (!is_front_page()) echo 'href="/"' ?>>
                <img src="<?php
                 if (is_home() || (is_single() && !is_product()) || (is_archive() && !is_shop()   && !is_product_category())  || get_page_template_slug() == "template-pages/content-page.php") {
                  the_field("light_logo", 'option');
                 } else {
                  the_field("logo", 'option');
                 }
                ?>" alt="logotype">
              </a>
            </div>
          </div>
          <div class="header__center i-content">
            <div class="slogan"> <?php the_field("left_slogan", 'option'); ?> </div>
            <div class="sloganSecondary"> <?php the_field("right_slogan", 'option'); ?> </div>
          </div>
          <div class="header__right">
<!--            <a href="/?s=" class="btn btn--search">-->
            <a href="javascript:void(0);" class="btn btn--search" data-popup="#searchBox">
              <svg class="icon icon-search">
                <use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/img/sprite.svg#icon-search"></use>
              </svg>
            </a>
            <button class="btn btn--burger hidden-desktop">
              <span class="bar"></span>
              <span class="bar"></span>
            </button>
            <a href="<?php echo wc_get_cart_url(); ?>" class="btn btn--cart">
            	<?php if (count(WC()->cart->get_cart())) : ?>
              		<span class="badge"><?php echo  count(WC()->cart->get_cart()) ?></span>
                <?php endif; ?>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="131.4px" height="104.4px" viewBox="0 0 131.4 104.4" style="enable-background:new 0 0 131.4 104.4;" xml:space="preserve">
                <style type="text/css">
                  .basket-st0 {
                    fill: none;
                    stroke: #010101;
                    stroke-width: 3;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                    stroke-miterlimit: 10;
                  }

                  .basket-st1 {
                    fill: none;
                    stroke: #010101;
                    stroke-width: 3;
                    stroke-linejoin: round;
                    stroke-miterlimit: 10;
                  }

                </style>
                <defs>
                </defs>
                <g>
                  <path class="basket-st0" d="M99.4,31.3H126c2.1,0,3.9,1.7,3.9,3.9v11c0,2.1-1.7,3.9-3.9,3.9H5.4c-2.1,0-3.9-1.7-3.9-3.9v-11
    c0-2.1,1.7-3.9,3.9-3.9h26.6" />
                  <line class="basket-st0" x1="42.5" y1="31.3" x2="88.9" y2="31.3" />
                  <polyline class="basket-st1" points="124.8,50.1 118.5,102.9 65.7,102.9 12.9,102.9 6.6,50.1  " />
                  <g>
                    <line class="basket-st1" x1="33.8" y1="50.1" x2="33.8" y2="102.9" />
                    <line class="basket-st1" x1="55.1" y1="50.1" x2="55.1" y2="102.9" />
                    <line class="basket-st1" x1="76.3" y1="50.1" x2="76.3" y2="102.9" />
                    <line class="basket-st1" x1="97.6" y1="50.1" x2="97.6" y2="102.9" />
                  </g>
                  <g>
                    <line class="basket-st1" x1="8.6" y1="67.3" x2="122.7" y2="67.3" />
                    <line class="basket-st1" x1="10.8" y1="85.7" x2="120.6" y2="85.7" />
                  </g>
                  <line class="basket-st0" x1="103.9" y1="38.8" x2="81.9" y2="1.5" />
                  <line class="basket-st0" x1="27.5" y1="38.8" x2="49.5" y2="1.5" />
                </g>
              </svg>
            </a>
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
          </div>
        </div>
      </header>
