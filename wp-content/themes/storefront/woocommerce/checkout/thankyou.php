<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

      <div class="section section--cart">
        <div class="i-content section__inner tabsCart">
          <div class="section__title hidden-desktop">YOur cart</div>
          <div class="cartEmpty">
            <div class="cartEmpty__title">order successfully placed</div>
            <div class="cartEmpty__button">
              <a href="/shop" class="btn btn--primary">to shop</a>
            </div>
          </div>
        </div>
      </div>