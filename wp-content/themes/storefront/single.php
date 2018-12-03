<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>


		<?php while ( have_posts() ) : the_post();


			get_template_part( 'content', 'single' );



		endwhile; // End of the loop. ?>


<?php
get_footer();
