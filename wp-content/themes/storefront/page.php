<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */
	if (is_cart() || is_checkout()) {
		get_template_part( 'templates/cart-header');
	} else {
		get_header(); 
	}
?>

			<?php while ( have_posts() ) : the_post();



				get_template_part( 'content', 'page' );


			endwhile; // End of the loop. ?>

<?php
get_footer();
