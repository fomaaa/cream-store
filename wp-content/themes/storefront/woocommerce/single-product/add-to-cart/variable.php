<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<div class="good__form variations_form cart">
<form  action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ); // WPCS: XSS ok. ?>">
	<div class="form__title--xs">Persionalize your case:</div>
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>

				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					
							<?php
								if ($attribute_name == 'pa_model') { ?>
									<div class="form__type">
										<label>Choose your iphone:</label>
										<?php wc_dropdown_variation_attribute_model( array(
											'options'   => $options,
											'attribute' => $attribute_name,
											'product'   => $product,
										) ); ?>
									</div>
								<?php } else { ?>
									<div class="form__body">
										<div class="form__field">
											<input maxlength="4" type="text" id="initials" name="initials" class="input input--white input--sm js-enter-text" placeholder="Enter you initials">
											<!-- <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?> -->
										</div>
										<div class="form__colors">
                      						<label>Text colour:</label>
										<?php 

							 				 wc_dropdown_variation_attribute_color( array(
											 	'options'   => $options,
											 	'attribute' => $attribute_name,
											 	'product'   => $product,
											 ) );	 

										 ?>
										</div>
									</div>
								<?php }
								//echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
							?>
				<?php endforeach; ?>
									<div class="form__field form__field--checkbox">
										<div class="form__checkbox">
											<input type="checkbox" id="gift_wrapper" name="gift_wrapper" />
											<span class="form__label"> Complementary Gift Wrapping </span>
										</div>
									</div>
		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>
</div>
<?php
do_action( 'woocommerce_after_add_to_cart_form' );
?>


			                 
<!-- 			                  <div class="form__type">
			                    <label>Choose your iphone:</label>
			                    <div class="typeItem">
			                      <input type="radio" name="typePhone" value="" />
			                      <span>X</span>
			                    </div>
			                    <div class="typeItem">
			                      <input type="radio" name="typePhone" value="" checked />
			                      <span>XS</span>
			                    </div>
			                    <div class="typeItem">
			                      <input type="radio" name="typePhone" value="" />
			                      <span>XR</span>
			                    </div>
			                  </div>
			                  <div class="form__body">
			                    <div class="form__field">
			                    	
			                      <input type="text" class="input input--white input--sm" placeholder="Enter you initials">
			                    </div>
			                    <div class="form__colors">
			                      <label>Text colour:</label>
			                      <div class="colorItem">
			                        <input type="radio" name="colorText" value="gold" checked>
			                        <span style="background-image: url('img/gold.png');"></span>
			                      </div>
			                      <div class="colorItem">
			                        <input type="radio" name="colorText" value="gold">
			                        <span style="background-image: url('img/serebro.png');"></span>
			                      </div>
			                    </div>
			                  </div>
			                  <div class="form__field form__field--checkbox">
			                    <div class="form__checkbox">
			                      <input type="checkbox" name="gift" checked />
			                      <span class="form__label"> Complementary Gift Wrapping </span>
			                    </div>
			                  </div>
			                  <div class="form__button">
			                    <button class="btn btn--secondary" type="button">buy now</button>
			                  </div>
			                  <ul class="totalBox__advantages">
			                    <li>
			                      <div class="advantage">
			                        <div class="advantage__icon">
			                          <img src="<?php echo get_stylesheet_directory_uri() ?>/img/icons/advantage1.svg" alt="" class="icon-advantage1">
			                        </div>
			                        <div class="advantage__text"> Free US<br /> delivery </div>
			                      </div>
			                    </li>
			                    <li>
			                      <div class="advantage">
			                        <div class="advantage__icon">
			                          <img src="<?php echo get_stylesheet_directory_uri() ?>/img/icons/advantage2.svg" alt="" class="icon-advantage2">
			                        </div>
			                        <div class="advantage__text"> Easy<br /> Returns </div>
			                      </div>
			                    </li>
			                  </ul>
			 -->