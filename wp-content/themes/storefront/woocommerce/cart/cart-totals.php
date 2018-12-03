<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
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
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
                  <div class="totalBox__price"> SUBTOtal: <span><?php wc_cart_totals_subtotal_html(); ?> USD</span>
                  </div>
                  <div class="totalBox__button">
                  	 <a href="/checkout" class="btn btn--primary">checkout</a>
                  </div>
                  <ul class="totalBox__advantages">
                    <li>
                      <div class="advantage">
                        <div class="advantage__icon">
                          <img src="<?php echo get_template_directory_uri() ?>/img/icons/advantage1.svg" alt="" class="icon-advantage1">
                        </div>
                        <div class="advantage__text"> Free US<br /> delivery </div>
                      </div>
                    </li>
                    <li>
                      <div class="advantage">
                        <div class="advantage__icon">
                          <img src="<?php echo get_template_directory_uri() ?>/img/icons/advantage2.svg" alt="" class="icon-advantage2">
                        </div>
                        <div class="advantage__text"> Easy<br /> Returns </div>
                      </div>
                    </li>
                  </ul>
                  <div class="totalBox__bottom">
                    <a href="/shop" class="btn btn--link">continue shopping</a>
                  </div>
