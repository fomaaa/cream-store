  <?php
/* Template Name: Front Page */
  get_header();
?>
      <div class="section section--banner section--first" style="background-color: #eaecf0;">
        <div class="bannerSlider swiper-container">
          <div class="swiper-wrapper">
          	<?php
          	$block = get_field("main_slider");
          	if ($block):
          		foreach($block as $item) :
          	?>
	            <div class="swiper-slide">
	              <div class="banner">
	                <div class="banner__photo" style="background-image: url('<?php echo $item['image'] ?>');"></div>
	                <div class="banner__body">
	                  <a href="<?php echo $item['button_link'] ?>" class="banner__subtitle"><?php echo $item['subtitle'] ?></a>
	                  <a href="<?php echo $item['button_link'] ?>" class="banner__title"><?php echo $item['title'] ?></a>
	                  <div class="banner__button">
	                    <a href="<?php echo $item['button_link'] ?>" class="btn btn--link btn--md"><?php echo $item['button_text'] ?></a>
	                  </div>
	                </div>
	              </div>
	            </div>

          	<?php endforeach; endif; ?>
          </div>
          <div class="swiper-button swiper-button-next">
            <span class="arrow"></span>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
      <div class="section section--advantages">
        <div class="container section__inner">
          <div class="advantages">
          	<?php
          	$block = get_field("advantages");
          	if ($block):
          		foreach($block as $key => $item) :
          	?>
	            <div class="advantages__item">
	              <div class="advantages__icon">
	                <img src="<?php echo $item['icon'] ?>" alt="<?php echo $item['text'] ?>" class="icon-advantages<?php echo $key +1 ?>">
	              </div>
	              <div class="advantages__title"><?php echo $item['text'] ?></div>
	            </div>
          	<?php endforeach; endif; ?>
          </div>
        </div>
      </div>
      <div class="section section--preview">
        <div class="preview">
          <div class="preview__photo" style="background-image: url(' <?php the_field("fb_image"); ?>');"></div>
          <div class="container section__inner">
            <div class="preview__body">
              <div class="page__title">  <?php the_field("fb_title"); ?> </div>
              <div class="page__subtitle"> <?php the_field("fb_subtitle"); ?></div>
              <div class="preview__bottom">
                <a href="<?php the_field("fb_btn_link"); ?>" class="btn btn--link btn--sm"><?php the_field("fb_btn_text"); ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section section--case" style="background-color: #383838;">
        <div class="container section__inner">
          <div class="case color-white">
            <div class="case__left">
              <div class="page__title">  <?php the_field("sb_title"); ?> </div>
              <div class="case__bottom">
                <a href="<?php the_field("sb_btn_link"); ?>" class="btn btn--link btn--sm btn--white"><?php the_field("sb_btn_text"); ?></a>
              </div>
            </div>
            <div class="case__right">
              <ul class="caseList">
              	<?php
              	$block = get_field("sb_images");
              	if ($block):
              		foreach($block as $item) :
              	?>
	                <li>
	                  <div class="case__item" style="background-image: url('<?php echo $item['url'] ?>');"></div>
	                </li>
              	<?php endforeach; endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="section section--preview section--reverse">
        <div class="preview">
          <div class="preview__photo" style="background-image: url('<?php the_field("tb_image"); ?>');"></div>
          <div class="container section__inner">
            <div class="preview__body">
              <div class="page__title"> <?php the_field("tb_title"); ?> </div>
              <div class="page__subtitle"><?php the_field("tb_subtitle"); ?></div>
              <div class="preview__bottom">
                <a href="<?php the_field("tb_btn_link"); ?>" class="btn btn--link btn--sm"><?php the_field("tb_btn_text"); ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section section--text text-center">
        <div class="container section__inner">
          <div class="page__title"> <?php the_field("fo_title"); ?></div>
          <div class="text__bottom">
            <a href="<?php the_field("fo_btn_link"); ?>" class="btn btn--link btn--sm"><?php the_field("fo_btn_text"); ?></a>
          </div>
        </div>
      </div>
      <div class="section section--share text-center">
        <div class="container section__inner">
          <div class="page__title">  <?php the_field("i_title"); ?> </div>
          <div class="page__subtitle"> <?php the_field("i_hashtag"); ?> </div>
          <?php get_sidebar(); ?>
        </div>
      </div>
<?php get_footer() ?>
