<!doctype html>
<html>

  <head>
    <meta charset="utf-8" />
    <title>Your cart</title>
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
        <header class="header">
          <div class="container-fluid header__inner">
            <div class="header__left">
              <div class="header__logo">
                <a href="/">
                  <img src="<?php the_field("logo", 'option'); ?>" alt="logotype">
                </a>
              </div>
              <nav class="nav nav--secondary">
                <div class="page__current">your cart</div>
                <a href="/shop" class="btn btn--return"> Return to catalogue </a>
              </nav>
            </div>
            <div class="header__center i-content">
              <div class="slogan">
                <span class="hidden-desktop"> <?php the_field("left_slogan", 'option'); ?> </span>
              </div>
            </div>
            <div class="header__right">
              <button class="btn btn--burger hidden-desktop">
                <span class="bar"></span>
                <span class="bar"></span>
              </button>
              <a href="<?php echo wc_get_cart_url(); ?>" class="btn btn--cart">
                <?php if (count(WC()->cart->get_cart())) : ?>
                    <span class="badge"><?php echo  count(WC()->cart->get_cart()) ?></span>
                  <?php endif; ?>
                 <img src="<?php the_field("cart_logo", 'option'); ?>" alt="">
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