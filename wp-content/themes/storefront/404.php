<?php get_header() ?>
      <div class="section section--error">
        <div class="container section__inner">
          <div class="error__title"> oops... </div>
          <div class="error__subtitle"> 404 / this page doesn’t exist </div>
          <div class="searchForm">
            <form action="/" method="s" class="form form--search">
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
<?php get_footer(); ?>