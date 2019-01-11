<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div class="section section--cart">
    <div class="i-content section__inner tabsCart">
    	<div class="cartTop">
            <nav class="pageNav">
              <ul class="menu tabsList">
                <li class="menu__item">
                  <a href="/cart" data-redirect="true">Your cart</a>
                </li>
                <li class="menu__item">
                  <a href="#" class="tab2 is-active">Customer information</a>
                </li>
                <li class="menu__item">
                  <a href="#" class="tab3">Shipping method</a>
                </li>
                <li class="menu__item">
                  <a href="#" class="tab4">payment method</a>
                </li>
              </ul>
            </nav>
            <div class="slogan">
              <span class="hidden-mobile">Free shipping worldwide</span>
              <span class="hidden-desktop"> beautiful accessories for&nbsp;beautiful people </span>
            </div>
        </div>
        <div class="section__title hidden-desktop">YOur cart</div>
		<form name="checkout" method="post" class="form form--order checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<div class="tabsBox">

				<div class="tabs__con tabs__con_tab2 is-active">
					<div class="cart cart--mobileReverse">
						<div class="form form--cart">
							<div class="form__payments hidden-mobile">
		                        <ul>
		                          <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/apple_pay.jpg" alt="" class="apple-pay"></li>
		                          <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/paypal.jpg" alt="" class="paypal"></li>
		                          <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/visa_mc.jpg" alt="" class="visa-mc"></li>
		                          <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/ae.jpg" alt="" class="ae"></li>
		                        </ul>
                      		</div>
                      		<div class="form__row">
                      			<div class="form__title"> Contact information </div>
                      			<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                      				<div class="form__field">
									<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
									</div>
								<?php endforeach; ?>
		                        <?php do_action('mailchimp_checkbox'); ?>
                      		</div>
                      		<div class="form__row">
                      			<div class="form__title"> Shipping address </div>
								<?php do_action( 'woocommerce_checkout_billing' ); ?>
								<div class="form__payments hidden-desktop">
		                          <ul>
		                            <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/apple_pay.jpg" alt="" class="apple-pay"></li>
		                            <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/paypal.jpg" alt="" class="paypal"></li>
		                            <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/visa_mc.jpg" alt="" class="visa-mc"></li>
		                            <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/ae.jpg" alt="" class="ae"></li>
		                          </ul>
		                        </div>
		                        <div class="totalBox hidden-desktop">
		                          <div class="totalBox__info">
						            <ul class="totalbox_list">
										<?php wc_get_template_part('cart/totalbox') ?>
						            </ul>
		                          </div>
		                        </div>
		                        <div class="form__bottom">
		                          <div class="form__button">
		                            <button class="btn btn--primary js-tab-next">Continue to shipping method</button>
		                            <a href="/cart" class="btn btn--back">
		                              <svg class="icon icon-arrow-left">
		                                <use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/img/sprite.svg#icon-arrow-left"></use>
		                              </svg>
		                              <span>Return to cart</span>
		                            </a>
		                          </div>
		                        </div>
							</div>
							<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
						</div>
					</div>
				</div>

				<div class="tabs__con tabs__con_tab3">
					<div class="cart cart--mobileReverse">
                  		<div class="cart__left">
							<div class="form form--cart">
								<div class="formInfo">
			                        <div class="formInfo__item">
			                          <div class="formInfo__title"> Contact: </div>
			                          <div class="formInfo__value add-value-contact">Not filled</div>
			                          <div class="formInfo__change">
			                            <a href="/checkout#tab2" class="js-tab-prev">Change</a>
			                          </div>
			                        </div>
			                        <div class="formInfo__item">
			                          <div class="formInfo__title"> Ship to: </div>
			                          <div class="formInfo__value add-value-address">Not filled</div>
			                          <div class="formInfo__change">
			                            <a href="/checkout#tab2" class="js-tab-prev">Change</a>
			                          </div>
			                        </div>
			                    </div>
			                    <div class="form__row">
			                      	<div class="form__title"> Shipping method </div>
			                      		<div class="form__field form__field--radio">
			                      			<?php wc_get_template_part('checkout/shipping-methods') ?>
											<?php //do_action( 'woocommerce_checkout_order_review' ); ?>
										</div>
										<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
							       		<div class="totalBox hidden-desktop">
				                        <div class="totalBox__info">
								            <ul class="totalbox_list">
												<?php wc_get_template_part('cart/totalbox') ?>
								            </ul>
				                        </div>
				                    </div>
				                    <div class="form__bottom">
				                        <div class="form__button">
				                            <button class="btn btn--primary js-tab-next">continue to payment method</button>
				                            <a href="#" class="btn btn--back js-tab-prev">
				                              <svg class="icon icon-arrow-left">
				                                <use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/img/sprite.svg#icon-arrow-left"></use>
				                              </svg>
				                              <span>Return to customer information</span>
				                            </a>
				                        </div>
				                    </div>
			                    </div>
							</div>
						</div>
					</div>
				</div>
				<div class="tabs__con tabs__con_tab4">
					<div class="cart cart--mobileReverse">
						<div class="cart__left">
							<div class="form form--cart form--cart-payment">
								<div class="formInfo">
			                        <div class="formInfo__item">
			                          <div class="formInfo__title"> Contact: </div>
			                          <div class="formInfo__value add-value-contact">Not filled</div>
			                          <div class="formInfo__change">
			                            <a href="/checkout#tab3" class="js-tab-prev">Change</a>
			                          </div>
			                        </div>
			                        <div class="formInfo__item">
			                          <div class="formInfo__title"> Ship to: </div>
			                          <div class="formInfo__value add-value-address">Not filled</div>
			                          <div class="formInfo__change">
			                            <a href="/checkout#tab3" class="js-tab-prev">Change</a>
			                          </div>
			                        </div>
			                        <div class="formInfo__item">
			                          <div class="formInfo__title formInfo__title--xs"> Shipping: </div>
			                          <div class="formInfo__value add-value-shipping">Not filled</div>
			                          <div class="formInfo__change">
			                            <a href="/checkout#tab3" class="js-tab-prev">Change</a>
			                          </div>
			                        </div>
			                    </div>
								<div class="form__row">
									<div class="form__title"> Payment method </div>
									<div class="form__field form__field--radio">
										<?php do_action( 'woocommerce_checkout_payment' ); ?>
									</div>
								</div>
								<div class="form__row">
									<div class="form__title"> Billing address </div>
									<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			                        <div class="form__payments hidden-desktop">
			                          <ul>
			                            <li>
			                              <img src="<?php echo get_stylesheet_directory_uri() ?>/img/payments/apple_pay.jpg" alt="" class="apple-pay">
			                            </li>
			                            <li><img src="<?php echo get_stylesheet_directory_uri() ?>/img/payments/paypal.jpg" alt="" class="paypal">
			                            </li>
			                            <li><img src="<?php echo get_stylesheet_directory_uri() ?>/img/payments/visa_mc.jpg" alt="" class="visa-mc">
			                            </li>
			                            <li><img src="<?php echo get_stylesheet_directory_uri() ?>/img/payments/ae.jpg" alt="" class="ae"></li>
			                          </ul>
			                        </div>
			                        <div class="totalBox hidden-desktop">
			                          <div class="totalBox__info">
								        <ul class="totalbox_list">
											<?php wc_get_template_part('cart/totalbox') ?>
								        </ul>
			                          </div>
			                        </div>


			                        <div class="form__bottom">
										<div class="form__apply-pay">
											<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
										</div>
			                            <div class="form__button">

											  <?php //wc_get_template( 'checkout/terms.php' ); ?>

											  <?php do_action( 'woocommerce_review_order_before_submit' ); ?>
											  <!-- <button class="btn btn--primary" type="submit"> Complete order </button> -->
											<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="btn btn--primary button alt" name="woocommerce_checkout_place_order" id="place_order" value="Complete order"   data-value="Complete order">Complete order</button>' ); // @codingStandardsIgnoreLine ?>

											  <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

											  <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
			                              <!-- <button class="btn btn--primary" type="submit"> Complete order </button> -->
			                              <a href="#" class="btn btn--back js-tab-prev">
			                                <svg class="icon icon-arrow-left">
			                                  <use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/img/sprite.svg#icon-arrow-left"></use>
			                                </svg>
			                                <span>Return to shipping method</span>
			                              </a>
			                            </div>
			                        </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
				<div class="cart__right">
					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
		</form>
		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	</div>
</div>
