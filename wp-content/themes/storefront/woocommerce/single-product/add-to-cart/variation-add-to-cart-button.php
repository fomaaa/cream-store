<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<!-- <div class="woocommerce-variation-add-to-cart variations_button"> -->


	<?php
	//sdo_action( 'woocommerce_before_add_to_cart_quantity' );

	// woocommerce_quantity_input( array(
	// 	'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
	// 	'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
	// 	'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
	// ) );

	//do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
	<div class="form__button">
		<button type="submit" class="btn btn--secondary single_add_to_cart_button button alt">buy now</button>
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
	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
<!-- </div> -->
