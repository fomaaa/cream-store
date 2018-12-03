<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
global $woocommerce;
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<div class="section section--cart">
	<div class="i-content section__inner tabsCart">
		<div class="cartTop">
            <nav class="pageNav">
              <ul class="menu tabsList">
                <li class="menu__item">
                  <a href="/cart" data-redirect="true" class="is-active">Your cart</a>
                </li>
                <li class="menu__item">
                  <a href="/checkout#tab2" data-redirect="true" class="tab2">Customer information</a>
                </li>
                <li class="menu__item">
                  <a href="/checkout#tab3" data-redirect="true" class="tab3">Shipping method</a>
                </li>
                <li class="menu__item">
                  <a href="/checkout#tab4" data-redirect="true">payment method</a>
                </li>
              </ul>
            </nav>
            <div class="slogan">
              <span class="hidden-mobile"><?php the_field("right_slogan", 'option'); ?></span>
              <span class="hidden-desktop"> <?php the_field("left_slogan", 'option'); ?> </span>
            </div>
          </div>
        <div class="section__title hidden-desktop">YOur cart</div>
		<form class="form form--order woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<div class="tabsBox">
            	<div class="tabs__con tabs__con_tab1 is-active">
            		<div class="cart">
            			<div class="cart__left">
							<ul class="goodsList">
								<?php do_action( 'woocommerce_before_cart_table' ); ?>

								<?php do_action( 'woocommerce_before_cart_contents' ); ?>
								<?php
								foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
									$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

									if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
										$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
										?>
									<li class="goodsList__item">
				                  		<div class="card card--good card--good-md">
				                  		<div class="card__photo" style="background-image: url('<?php echo get_the_post_thumbnail_url($product_id) ?>')">
				                     		<span class="badge"><?php echo $cart_item['quantity'] ?></span>
				                    	</div>
				                    	<div class="card__body">
						                    <div class="card__category">iphone <?php echo $cart_item['variation']['attribute_pa_model'] ?></div>
						                      <div class="card__title"><?php 
													           echo $_product->get_name();
						                       ?></div>
						                      <div class="card__price">
						                      	<?php
													echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); 
												?> USD</div>
						                      <div class="card__info">
						                        <ul>
						                        <?php if (!empty($cart_item['alg_wc_pif_local'][0]['_value'])) : ?>
						                          <li> Initials for the monogram: <strong><?php echo $cart_item['alg_wc_pif_local'][0]['_value']; ?></strong>
						                          </li>
						                          <li> Monogram colour: <span class="color" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/<?php echo $cart_item['variation']['attribute_pa_text-color'] ?>.png');"></span>
						                          </li>
						                      <?php endif; ?>
						                          <li> Complementary Gift Wrapping: <?php echo $cart_item['gift_wrapper'] ?> </li>
						                        </ul>
						                      </div>
				                    	</div>
												<?php
											}
										}
										?>
									</div>
								</li>
							</ul>
						</div>
						<div class="cart__right">
						  	<div class="js-sticky">
						    	<div class="totalBox">
								<?php
									/**
									 * Cart collaterals hook.
									 *
									 * @hooked woocommerce_cross_sell_display
									 * @hooked woocommerce_cart_totals - 10
									 */
									do_action( 'woocommerce_cart_collaterals' );
								?>
							    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>


<?php do_action( 'woocommerce_after_cart' ); ?>
	</div>
</div>