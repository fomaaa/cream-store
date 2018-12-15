<?php 
/* Template Name: Content */
  get_header(); 
?>
      <div class="section section--hero section--first" style=" background-image: url(<?php the_field("background"); ?>)">
        <div class="container section__inner">
          <div class="hero__title"><?php the_title() ?></div>
        </div>
      </div>
      <div class="section section--content">
        <div class="container section__inner">
          <article>
			<?php echo apply_filters('the_content', get_post_field('post_content')); ?>
          </article>
        </div>
      </div>
<?php get_footer() ?>