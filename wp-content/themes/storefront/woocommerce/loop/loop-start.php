<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php 
    $args_cat = array(
    	'taxonomy'  => 'product_cat',
        'orderby' => 'name',
        'order' => 'ASC',
        'parent' => 0,
        'hide_empty' => true,
    );
    $cats = get_categories($args_cat); 
?>
      <div class="section section--catalog section--first">
        <div class="container section__inner">
          <div class="catalog__title"><?php if (single_cat_title('', 0)) : single_cat_title(); else : ?> Case<br> collection <?php endif; ?></div>
          <div class="category category--black">
            <div class="category__head"> show categories </div>
            <div class="category__body">
              <a href="javascript:void(0);" class="close"></a>
              <ul>
              	<?php foreach ($cats as $cat) : ?>
		           <li><a href="<?php echo get_category_link($cat) ?>" <?php if (single_cat_title('', 0) == $cat->name) echo 'class="is-active"' ?>><?php echo $cat->name ?></a></li>
				<?php endforeach ?>
              </ul>
            </div>
          </div>
          <ul class="goodList">