import { ACTIVE } from '../_const.js';

class ShowMore {

  constructor(item) {
  	this.container = item;
  	this.link = $(this.container).find('.js-show-more-link');
  	this.showItems = $(this.container).data().items;
  	this.items = $(this.container).find('.js-show-more-item');
  	this.init();
  }

  hideItems() {

  	const itemsLength = this.items.length;

  	$(this.items).each((index, item) => {

  		if((index < this.showItems) || (index === itemsLength)) return;
      $(item).addClass('is-hidden');

  	});

  }

  showMore() {

  	$(this.items).each((index, item) => {

      $(item).removeClass('is-hidden');

  	});

  }

  events() {
  	this.link.on('click', (e) => {
  		
  		e.preventDefault();

  		if($(this.container).hasClass(ACTIVE)) {
  			$(this.container).removeClass(ACTIVE);
  			this.hideItems();
  			return;
  		}

  		$(this.container).addClass(ACTIVE);
  		this.showMore();
  	});
  }

  init() {

  	this.hideItems();
  	this.events();

  }

}

$('.js-show-more').each((index, item) => {
  new ShowMore(item);
});
