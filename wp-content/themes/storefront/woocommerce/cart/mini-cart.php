<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
<div class="js-sticky">
	<ul class="goodsList woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<li class="goodsList__item woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
						<div class="card card--good card--good-sm">

							<div class="card__photo" style="background-image: url('<?php echo get_the_post_thumbnail_url($product_id) ?>')">
                        		<span class="badge badge--xs"><?php echo $cart_item['quantity'] ?></span>
                      		</div>
                      		<div class="card__body">
		                        <div class="card__head">
		                          <div class="card__category">iphone <?php echo $cart_item['variation']['attribute_pa_model'] ?></div>
			                      <div class="card__title"><?php 
										           echo $_product->get_name();
			                       ?></div>
			                      <div class="card__price">
			                      	<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); 
									?>
									</div>
		                        </div>
		                        <div class="card__info">
		                          <ul>
					                        <?php if (!empty($cart_item['initials'])) : ?>
						                          <li> Initials for the monogram: <strong><?php echo $cart_item['initials']; ?></strong>
						                          </li>
						                          <li> Monogram colour: <span class="color" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/<?php echo $cart_item['variation']['attribute_pa_text-color'] ?>.png');"></span>
						                          </li>
						                      	<?php endif; ?>
		                            <li> Complementary Gift Wrapping: <?php echo $cart_item['gift_wrapper'] ?> </li>
		                          </ul>
		                        </div>
		                     </div>
						</div>
					</li>
					<?php
				}
			}

			do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<div class="totalBox hidden-mobile">
        <div class="totalBox__info">
            <ul class="totalbox_list">
				<?php wc_get_template_part('cart/totalbox') ?>
            </ul>
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
     </div>
</div>

<?php endif; ?>