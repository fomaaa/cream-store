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
          <div class="searchResult">
            <div class="searchResult__title">search results</div>
            <ul class="searchResult__list">
				<?php if ( have_posts() ) { 
						while ( have_posts() ) {
							  the_post(); 
								wc_get_template_part( 'content', 'product' ); 
						} 
					} else {
							get_template_part( 'content', 'none' );
							
						}
					
				?>
				
			</ul>
          </div>
          <div class="searchForm">
            <form action="/" method="get" class="form form--search">
              <div class="form__field">
                <input type="text"  name="s" placeholder="NEW SEARCH" />
                <button class="btn btn--search" type="submit">
                  <!-- Generator: Adobe Illustrator 22.0.1, SVG Export Plug-In  -->
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="110.1px" height="110.1px" viewBox="0 0 110.1 110.1" style="enable-background:new 0 0 110.1 110.1;" xml:space="preserve">
                    <style type="text/css">
                      .st0 {
                        fill: none;
                        stroke: #010101;
                        stroke-width: 3;
                        stroke-linecap: round;
                        stroke-miterlimit: 10;
                      }

                    </style>
                    <defs>
                    </defs>
                    <g>
                      <path class="st0" d="M87.3,44.4c0-23.7-19.2-42.9-42.9-42.9C20.7,1.5,1.5,20.7,1.5,44.4c0,23.7,19.2,42.9,42.9,42.9
		C68.1,87.3,87.3,68.1,87.3,44.4z" />
                      <path class="st0" d="M79,71l27.9,27.9c2.2,2.2,2.2,5.8,0,8l0,0c-2.2,2.2-5.8,2.2-8,0L71,79" />
                    </g>
                  </svg> </button>
              	</div>
            </form>
          </div>
        </div>
      </div>

                  <?
get_footer();
