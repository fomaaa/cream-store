  <?php 
/* Template Name: Contact */
  get_header(); 
?>
      <div class="section section--contacts">
        <div class="container section__inner">
          <div class="contacts__title"> <?php the_title(); ?> </div>
          <div class="container-sm">
            <div class="contacts">
              <div class="contacts__column">
                <ul class="contactsList">
                  <li class="contactsList__item">
                    <div class="contactsList__icon">
                      <i class="icon-phone"></i>
                    </div>
                    <div class="contactsList__title">
                      <a href="tel:<?php the_field("phone_number", 'option'); ?>" target="_blank"> <?php the_field("phone_number", 'option'); ?></a>
                    </div>
                  </li>
                  <li class="contactsList__item">
                    <div class="contactsList__icon">
                      <i class="icon-world"></i>
                    </div>
                    <div class="contactsList__title"><?php the_field("address", 'option'); ?></div>
                  </li>
                </ul>
              </div>
              <div class="contacts__column">
                <ul class="contactsList">
                  <li class="contactsList__item">
                    <div class="contactsList__icon">
                      <i class="icon-phone"></i>
                    </div>
                    <div class="contactsList__title">
                      <a href="whatsapp://send?phone=<?php the_field("phone_number", 'option'); ?>" target="_blank">Whatsapp: <?php the_field("phone_number", 'option'); ?></a>
                    </div>
                  </li>
                  <li class="contactsList__item">
                    <div class="contactsList__icon">
                      <i class="icon-mail"></i>
                    </div>
                    <div class="contactsList__title">
                      <a href="mailto:hello@creamandbutter.com" target="_blank"><?php the_field("email", 'option'); ?></a>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="contacts__column">
                <ul class="socials">
                	<?php 
                	$block = get_field("socials");
                	if ($block):
                		foreach($block as $item) :
                	?>
	                  <li>
	                    <a href="<?php echo $item['link'] ?>" target="_blank">
	                      <img src="<?php echo $item['icon'] ?>" alt="" class="social__whatsapp">
	                    </a>
	                  </li>
                		
                	<?php endforeach; endif; ?>
                </ul>
              </div>
            </div>
            <div class="faq">
              <ul class="faqList">
              	<?php 
              	$block = get_field("faq");
              	if ($block):
              		foreach($block as $item) :
              	?>
	                <li class="faqList__item">
	                  <div class="accordion js-accordion">
	                    <div class="accordion__head js-accordion-head">
	                      <span><?php echo $item['question'] ?></span>
	                    </div>
	                    <div class="accordion__body js-accordion-body">
	                      <article>
							 <?php echo $item['answer'] ?>
	                      </article>
	                    </div>
	                  </div>
	                </li>
              	<?php endforeach; endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
<?php get_footer() ?>