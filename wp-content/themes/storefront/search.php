<?php
/**
 * The template for displaying search results pages.
 *
 * @package storefront
 */

get_header(); ?>

      <div class="section section--search">
        <div class="container section__inner">
          <div class="search__title"> <?php echo  get_search_query() ; ?> </div>
          <?php if (get_search_query()) : ?>
            <?php if ( have_posts() ) : ?>
              <div class="searchResult">
                <div class="searchResult__title">search results</div>
                    <ul class="searchResult__list">
              						<?php while ( have_posts() ) {
              							  the_post(); 
              								wc_get_template_part( 'content', 'product' ); 
              						} 

              				?>  			
                   </ul>
              </div>
            <?php else : ?>
              <div class="error__subtitle"> nothing found :(. Try a new search. </div>
            <?php endif; ?> 
          <?php endif; ?>
          <div class="searchForm">
            <form action="/" class="form form--search">
              <div class="form__field">
                <input type="text" name="s" placeholder="NEW SEARCH" />
                <button class="btn btn--search" type="submit">
                  <svg class="icon icon-search">
                    <use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/img/sprite.svg#icon-search"></use>
                  </svg>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>


                  <?
get_footer();
