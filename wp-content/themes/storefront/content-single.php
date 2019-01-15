<?php get_header(); ?>

<div class="section section--hero section--first section--darken" style="background-image: url(<?php the_field("background") ?>);">
        <div class="container section__inner">
          <div class="hero__title"><?php the_title() ?></div>
        </div>
      </div>
      <div class="section section--gallery">
        <ul class="gallery">
          <?php
          $block = get_field("gallery");
          if ($block):
            foreach($block as $item) :
          ?>
            <li class="gallery__item">
              <a href="<?php echo $item['url'] ?>" data-fancybox="gallery1" style="background-image: url(<?php echo $item['sizes']['medium_large'] ?>);"></a>
            </li>

          <?php endforeach; endif; ?>
        </ul>
        <div class="container-custom">
          <div class="postBox">
            <div class="share">
              <div class="share__title">Like this post? Share:</div>
              <ul class="shareSocials">
                <li>
                  <a href="#" onclick="
                  Share.facebook(
                  '<?php the_permalink() ?>',
                  '<?php get_field('sharing_title') ? the_field('sharing_title') : the_title(); ?>',
                  '<?php get_field('sharing_image') ? the_field('sharing_image') : the_field("background") ?>',
                  '<?php get_field('sharing_text') ? the_field('sharing_text') : "" ?>');
                  return false;
                  " style="background-image: url('<?php echo get_stylesheet_directory_uri() ?>/img/fb.png');"></a>
                </li>
                <li>
                  <a onclick="
                  Share.twitter(
                  '<?php the_permalink() ?>',
                  '<?php get_field('sharing_text') ? the_field('sharing_text') : "" ?>');
                  return false;
                  " href="#" style="background-image: url('<?php echo get_stylesheet_directory_uri() ?>/img/twitter.png');"></a>
                </li>
              </ul>
            </div>
            <?php $next_post = get_next_post();
            	if (!empty( $next_post )):
             ?>
	            <div class="nextPage">
	              <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
	                <span>Next post</span>
	                <span class="arrow"></span>
	              </a>
	            </div>
            <?php endif ?>
          </div>
        </div>
      </div>
<?php get_footer(); ?>
