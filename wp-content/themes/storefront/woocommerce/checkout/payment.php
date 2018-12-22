<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

if (!is_ajax()) {
	do_action('woocommerce_review_order_before_payment');
}
?>

<?php if (WC()->cart->needs_payment()) : ?>
	<?php
	if (!empty($available_gateways)) {
		foreach ($available_gateways as $gateway) { ?>
			<?php //print_r($available_gateways); ?>
			<?php wc_get_template('checkout/payment-method.php', array('gateway' => $gateway)); ?>
		<?php } ?>
		<?php //echo '<pre>'; print_r($available_gateways); echo '</pre>';  ?>
		<!-- HARD CODE KUES -->
		<div class="form__radio applePay">
			<input type="radio" name="payment_method" value="applePayMethod"/>
			<span class="form__label form__label--sm">
                              <img src="<?php echo get_template_directory_uri() ?>/img/payments/apple_pay.jpg"
								   alt="" class="apple-pay">
                            </span>
			<div class="form__toggle flex-wrap">
				<div class="form__text">After clicking "Complete order", you will be redirected to
					Apple Pay to complete your purchase securely.
				</div>

			</div>

		</div>
		<!-- END HARD CODE -->
	<?php } else {
		echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) . '</li>'; // @codingStandardsIgnoreLine
	}
	?>
<?php endif; ?>


<?php
if (!is_ajax()) {
	do_action('woocommerce_review_order_after_payment');
}
