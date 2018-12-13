<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version' => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce = require 'inc/woocommerce/class-storefront-woocommerce.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
		require 'inc/nux/class-storefront-nux-starter-content.php';
	}
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' => 'Global settings',
		'menu_title' => 'Global settings',
		'menu_slug' => 'theme-global-settings',
		'capability' => 'edit_posts',
		'redirect' => false,
		'icon_url' => 'dashicons-networking',
	));
	acf_add_options_page(array(
		'page_title' => 'Contact settings',
		'menu_title' => 'Contact settings',
		'menu_slug' => 'theme-contact-settings',
		'capability' => 'edit_posts',
		'redirect' => false,
		'icon_url' => 'dashicons-phone',
	));

}

function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function wc_get_gallery_image_html_big( $attachment_id, $main_image = false ) {

	return wp_get_attachment_image_url( $attachment_id, 'full' );
}

function wc_get_gallery_image_html_small( $attachment_id, $main_image = false ) {
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', 'thumbnail' );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );

	return $thumbnail_src[0];
}



/**
 * Display the custom text field
 * @since 1.0.0
 */
function cfwc_create_custom_field() {
	 $args = array(
	 'id' => 'gift_wrapper',
	 'label' => 'Complementary Gift Wrapping',
	 'class' => 'cfwc-custom-field',
	 );
	 woocommerce_wp_checkbox( $args );
}
add_action( 'woocommerce_product_options_general_product_data', 'cfwc_create_custom_field' );

function cfwc_create_initials() {
	 $args = array(
	 'id' => 'initials',
	 'label' => 'Initials',
	 'class' => 'cfwc-initials',
	 );
	 woocommerce_wp_text_input( $args );
}
add_action( 'woocommerce_product_options_general_product_data', 'cfwc_create_initials' );

/**
 * Save the custom field
 * @since 1.0.0
 */
function cfwc_save_custom_field( $post_id ) {
 $product = wc_get_product( $post_id );
 $title = isset( $_POST['gift_wrapper'] ) ? $_POST['gift_wrapper'] : '';
 $product->update_meta_data( 'gift_wrapper', sanitize_text_field( $title ) );
 $product->save();
}
add_action( 'woocommerce_process_product_meta', 'cfwc_save_custom_field' );

function cfwc_save_initials( $post_id ) {
 $product = wc_get_product( $post_id );
 $title = isset( $_POST['initials'] ) ? $_POST['initials'] : '';
 $product->update_meta_data( 'initials', sanitize_text_field( $title ) );
 $product->save();
}
add_action( 'woocommerce_process_product_meta', 'cfwc_save_initials' );


function cfwc_add_custom_field_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {
 if( ! empty( $_POST['gift_wrapper'] ) ) {
 // Add the item data
 	$cart_item_data['gift_wrapper'] = 'Yes';
 } else{
 	$cart_item_data['gift_wrapper'] = 'No';
 }
 return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'cfwc_add_custom_field_item_data', 10, 4 );


function cfwc_initials_field_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {
 if( ! empty( $_POST['initials'] ) ) {
 // Add the item data
 	$cart_item_data['initials'] = $_POST['initials'];
 }
 return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'cfwc_initials_field_item_data', 10, 4 );

/**
 * Display the custom field value in the cart
 * @since 1.0.0
 */
function cfwc_cart_item_name( $name, $cart_item, $cart_item_key ) {
 if( isset( $cart_item['gift_wrapper'] ) ) {
 $name .= sprintf(
 '<p>%s</p>',
 esc_html( $cart_item['gift_wrapper'] )
 );
 }
 return $name;
}
add_filter( 'woocommerce_cart_item_name', 'cfwc_cart_item_name', 10, 3 );

// function cfwc_display_initials() {
//  global $post;
//  // Check for the custom field value
//  $product = wc_get_product( $post->ID );
//  $title = $product->get_meta( 'custom_text_field_title' );
//  if( $title ) {
//  // Only display our field if we've got a value for the field title
//  printf(
//  '<div class="cfwc-custom-field-wrapper"><label for="cfwc-title-field">%s</label><input type="text" id="cfwc-title-field" name="cfwc-title-field" value=""></div>',
//  esc_html( $title )
//  );
//  }
// }
// add_action( 'woocommerce_before_add_to_cart_button', 'cfwc_display_initials' );

function cfwc_cart_item_name_initials( $name, $cart_item, $cart_item_key ) {
 if( isset( $cart_item['initials'] ) ) {
 $name .= sprintf(
 '<p>%s</p>',
 esc_html( $cart_item['initials'] )
 );
 }
 return $name;
}
add_filter( 'woocommerce_cart_item_name', 'cfwc_cart_item_name_initials', 10, 3 );
/**
 * Add custom field to order object
 */
function cfwc_add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {
 foreach( $item as $cart_item_key=>$values ) {
 if( isset( $values['gift_wrapper'] ) ) {
 $item->add_meta_data('Complementary Gift Wrapping', $values['gift_wrapper'], true );
 }
 }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'cfwc_add_custom_data_to_order', 10, 4 );

function cfwc_add_initials_data_to_order( $item, $cart_item_key, $values, $order ) {
 foreach( $item as $cart_item_key=>$values ) {
 if( isset( $values['initials'] ) ) {
 $item->add_meta_data('Initials', $values['initials'], true );
 }
 }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'cfwc_add_initials_data_to_order', 10, 4 );


add_action( 'wp_ajax_nopriv_loadmore_blog', 'load_items');
add_action( 'wp_ajax_loadmore_blog', 'load_items');

function load_items() {
	$current = $_POST['current'];
	$posts = query_posts(
		array(
	        'post_type' => 'post',
	        'posts_per_page'  => 6,
	        'orderby' => 'date_add',
	        'order' => 'DESC',
	        'offset' => $current * 6,
			'paged' => $current + 1,
		)
	);
	$html ='';

	if ( have_posts() ) : while ( have_posts() ) :
		the_post();
		$html .= '<div class="grid__item">';
			$html .= '<div class="card card--article">';
				$html .= ' <a href="' . get_the_permalink() .'" class="card__link"></a>';
				$html .= '<div class="card__photo" style="background-image: url('. get_the_post_thumbnail_url('', 'medium_large')  .');"></div>';
				$html .= '<div class="card__body">';
					$html .= ' <div class="card__title">'.  get_the_title() .'</div>';
					$html .= '<div class="card__text">'.  get_field('short_desciption').'</div>';
					$html .= '<div class="card__button">';
						$html .= '<a href="'. get_the_permalink() .'" class="btn btn--link">read</a>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
	endwhile; endif;
	wp_reset_query();

	exit($html);
}

add_filter('widget_title','my_widget_title');
function my_widget_title($t)
{

    return null;
}

add_filter('wpcf7_form_elements', function($content) {
	$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

	return $content;
});

function getCorrectTitle(){
	  if (is_product_category() ) {
        single_cat_title();
      } else if (is_archive()){
        if (is_shop()) {
          echo get_the_title(5);
        } else {
          single_term_title();
        }
      } else if (is_home()) {
          echo get_the_title(119);
      } else if (is_search()) {
        echo "Search : "  . get_search_query();
      } else {
        echo get_the_title(get_the_ID());
      }
}

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {

  $cols = 6;
  return $cols;
}


add_action( 'wp_ajax_nopriv_load_product', 'load_product');
add_action( 'wp_ajax_load_product', 'load_product');

function load_product() {

	$current = $_POST['current'];

	$category = $_POST['category'];
    $args = array(
	    'post_type'             => 'product',
	    'posts_per_page'  		=> 6,
	    'orderby' 				=> 'date_add',
	    'order' 				=> 'DESC',
	    'offset' 				=> $current * 6,
	    'paged' 				=> $current + 1,
	);

	if ($category != 'all') {
		$args['tax_query'] = array(
	        array(
	            'taxonomy'      => 'product_cat',
	            'field' => 'term_id',
	            'terms'         => $category,
	            'operator'      => 'IN'
	        ),
	    );
	}

	$posts = query_posts($args);

	$html ='';

	if ( have_posts() ) : while ( have_posts() ) :
		the_post();
		$terms = get_the_terms( get_the_ID(), 'product_cat' );
		global $product;
		$html .= '<li class="goodList__item">';
			$html .= '<a href="'. get_the_permalink() .'" class="card card--good-lg">';
				$html .= '<div class="card__photo" style="background-image: url('.  get_the_post_thumbnail_url() .');"></div>';
				$html .= '<div class="card__body">';
					$html .= ' <div class="card__category">'. $terms[0]->name . '</div>';
					$html .= '<div class="card__title">'. get_the_title() .'</div>';
					$html .= ' <div class="card__price">';
						$html .= '$'. number_format($product->get_price(), '2', ',', ' ') .' USD';
					$html .= ' </div>';
				$html .= '</div>';
			$html .= '</a>';
		$html .= '</li>';
	endwhile; endif;
	wp_reset_query();

	exit($html);
}

add_filter( 'wc_stripe_show_payment_request_on_checkout', '__return_true' );
