<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>
<?php 
    $args_cat = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'parent' => 0,
        'hide_empty' => false,
    );
    $cats = get_categories($args_cat); 
?>
      <div class="section section--hero section--first" style="background-image: url(<?php echo the_field('background', 119);  ?>);">
        <div class="container section__inner">
          <div class="hero__title"><?php echo  single_cat_title(); ?></div>
        </div>
        <div class="hero__bottom">
          <div class="category">
            <div class="category__head"> categories </div>
            <div class="category__body">
              <a href="javascript:void(0);" class="close"></a>
              <ul>
				<?php foreach ($cats as $cat) : ?>
		           <li><a href="<?php echo get_category_link($cat) ?>"><?php echo $cat->name ?></a></li>
				<?php endforeach ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="section section--blog">
        <div class="container section__inner">
          <div class="grid grid--3">
          	<?php 	               
          		 ?>
          	<?php while ( have_posts() ) : the_post(); ?>
	            <div class="grid__item">
	              <div class="card card--article">
	                <a href="<?php the_permalink(); ?>" class="card__link"></a>
	                <div class="card__photo" style="background-image: url(<?php echo get_the_post_thumbnail_url('', 'medium_large') ?>);"></div>
	                <div class="card__body">
	                  <div class="card__title"> <?php the_title(); ?> </div>
	                  <div class="card__text"> <?php the_field('short_desciption') ?> </div>
	                  <div class="card__button">
	                    <a href="<?php the_permalink(); ?>" class="btn btn--link">read</a>
	                  </div>
	                </div>
	              </div>
	            </div>
			<?php endwhile; ?>
          </div>
        </div>
      </div>



<?php

get_footer();
