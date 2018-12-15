<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$next_post = get_next_post();
?>
<div class="section section--good" id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="btn btn--next"><span class="arrow"></span></a>
	<?php
			$next_post = get_next_post();
			if (!empty($next_post)):
				?>
				<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="btn btn--next"><span class="arrow"></span></a>
			<?php else:
				$posts = query_posts(array(
						'post_type' => 'product',
						'posts_per_page'  => 1,
						'orderby' => 'date_add',
						'order' => 'ASC' )
					);
				?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
					<a href="<?php echo get_permalink(); ?>" class="btn btn--next"><span class="arrow"></span></a>
				<?php endwhile; endif ?>
				<?php wp_reset_query(); ?>
				

			<?php endif; ?>
	<div class="container section__inner">
		<div class="good">
		 	<div class="good__left">
		 		<div class="goodGallery">
				<?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
				?>

				</div>
			</div>
			<div class="good__right">
				<div class="good__body">
							<?php
								/**
								 * Hook: woocommerce_single_product_summary.
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50
								 * @hooked WC_Structured_Data::generate_product_data() - 60
								 */
								do_action( 'woocommerce_single_product_summary' );
							?>


						<?php
							/**
							 * Hook: woocommerce_after_single_product_summary.
							 *
							 * @hooked woocommerce_output_product_data_tabs - 10
							 * @hooked woocommerce_upsell_display - 15
							 * @hooked woocommerce_output_related_products - 20
							 */
							//do_action( 'woocommerce_after_single_product_summary' );
						?>
				</div>
			</div>
			<div class="good__bottom">
              	<div class="goodInfo">
	                <article>
						<?php the_content(); ?>
	                </article>
             	</div>
            </div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
>>>>>>> 2ea74192df6ef401c2f507099baeaa623e295248
