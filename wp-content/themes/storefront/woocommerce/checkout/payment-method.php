<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="form__radio wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<span class="form__label form__label--sm">
		<?php if ($gateway->get_title() == 'PayPal')  { ?>
	 		<img src="<?php echo get_template_directory_uri() ?>/img/payments/paypal.jpg" alt="" class="paypal">
	 	<?php } elseif ($gateway->get_title() == 'Credit Card') { ?>
	 		Credit card
	 		<div class="creditList">
                                <ul>
                                  <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/visa_mc.jpg" alt="" class="visa-mc"></li>
                                  <li><img src="<?php echo get_template_directory_uri() ?>/img/payments/ae.jpg" alt="" class="ae"></li>
                                </ul>
                              </div>
		<?php }else { ?>
			<?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?> 
			<?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
		<?php } ?>
	</span>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="form__toggle flex-wrap">
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</div>
<!-- <style>
	.form__label img{
		width: 50px;
		display: inline;
	}


</style> -->