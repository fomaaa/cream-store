<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
$attachment_ids = $product->get_gallery_image_ids();
?>
<div class="goodSlider goodSlider--thumbs">
  	<div class="swiper-button swiper-button-prev"></div>
  	<div class="swiper-container">
    	<div class="swiper-wrapper">
				<?php 
					echo ' <div class="swiper-slide" style="background-image: url(' . wc_get_gallery_image_html_small( get_field('image_for_initials') )  . ');"></div>';
					if ( $attachment_ids && $product->get_image_id() ) {
						foreach ( $attachment_ids as $attachment_id ) {
							echo ' <div class="swiper-slide" style="background-image: url(' . wc_get_gallery_image_html_small( $attachment_id )  . ');"></div>';
						}
					}
				?>
    	</div>
  	</div>
  	<div class="swiper-button swiper-button-next"></div>
</div>


 <div class="goodSlider goodSlider--main">
 	<div class="swiper-container">
        <div class="swiper-wrapper">
			<?php 
				if ( $attachment_ids && $product->get_image_id() ) {
					echo '<div class="swiper-slide" style="background-image: url(' . wc_get_gallery_image_html_big( get_field('image_for_initials') ) . ');"><div class="js-area-text" style="background: -webkit-linear-gradient(top, transparent, transparent), url(' . get_stylesheet_directory_uri() . '/img/gold_text.png) repeat;"></div></div>';
					foreach ( $attachment_ids as $attachment_id ) {
						echo '<div class="swiper-slide" style="background-image: url(' . wc_get_gallery_image_html_big( $attachment_id ) . ');"></div>';
					}
				}
			?>
		</div>
 	</div>
 </div>

