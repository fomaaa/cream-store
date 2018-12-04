$(document).ready(function(){
  let ajaxFlag = true;
  var current_tab = 1;

  if ($('.section--blog .grid').length) {

    $(window).scroll(function () {
      if ($(window).scrollTop() >= ($('.section--blog .grid').offset().top + $('.section--blog .grid').outerHeight() - 1000) && ajaxFlag === true) {
        

        var data = {
          'action': 'loadmore_blog',
          'current' : current_tab,
        };


        $.post( ajax_url, data, function(response) {
              if (response) {
                ajaxFlag = false;
                console.log(response);
                $(response).appendTo('.grid');
                ajaxFlag = true;
              } 

        });
        current_tab  += 1;
      }
    });
  }

  Share = {
          facebook: function(purl, ptitle, pimg, text) {
            url  = 'http://www.facebook.com/sharer.php?s=100';
            url += '&p[title]='     + encodeURIComponent(ptitle);
            url += '&p[summary]='   + encodeURIComponent(text);
            url += '&p[url]='       + encodeURIComponent(purl);
            url += '&p[images][0]=' + pimg;
            Share.popup(url);
          },

          twitter: function(purl, ptitle) {
            url  = 'http://twitter.com/share?';
            url += 'text='      + encodeURIComponent(ptitle);
            url += '&url='      + encodeURIComponent(purl);
            url += '&counturl=' + encodeURIComponent(purl);
            Share.popup(url);
          },
          popup: function(url) {
            window.open(url,'','toolbar=0,status=0,width=626,height=436');
          }
  };

  $('.shipping_method').on('change', function(){
    var label = $(this).siblings('.form__label').find('strong').html();
    var text =  $(this).siblings('.form__label').text();
    
    $('.add-value-shipping').html(label);


    var shipping = $('[name="shipping_method[0]"]:checked').val();

    if (shipping == 'flat_rate:4') {
        $('[data-shipping]').html('$28.99 USD');
        subtotal = parseInt($('[data-subtotal]').data('subtotal'));
        total = subtotal + 28.99;
        $('[data-total').html('$' + total + ' USD');
    } else if (shipping == 'free_shipping:3') {
      $('[data-shipping]').html('Free');
      $('[data-total').html($('.totalbox_list [data-subtotal]').html());
    }
    // console.log(shipping);
    // var data = {
    //       'action': 'set_shipping',
    //       'shipping' : shipping,
    //     };


    //     $.post( ajax_url, data, function(response) {
    //           if (response) {
    //             $('.totalbox_list').html(response);
    //             console.log(response);
    //           } 

    //     });

  });

  $('[name="additional_email"]').on('change', function(){
     var val = $(this).val();
     $('.add-value-contact').html(val);
  })
  $('[name="billing_address_1"], [name="billing_city"], [name="billing_custom_country"], [name="billing_postcode"]').on('change', function(){
      var address = $('[name="billing_address_1"]').val();
      var city = $('[name="billing_city"]').val();
      var country = $('[name="billing_custom_country"]').val();
      var postcode = $('[name="billing_postcode"]').val();

      var res = address + ', ' + city + ', ' + postcode + ', ' + country;
      $('.add-value-address').html(res);
  })
  
})

  
        
      
// $('.true_loadmore').click(function () {
//   var that = $(this);
//   var id = that.data('id');

//   that.text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
//   var ajaxurl = tab[id]['ajaxurl'];
//   var max_pages = tab[id]['max_pages'];

//   var data = {
//     'action': 'loadmore',
//     'query': tab[id]['true_posts'],
//     'page': tab[id]['current_page'],
//     'post_type': tab[id]['post_type'],
//     'post_per_page': tab[id]['post_per_page'],
//   };

//   $.ajax({
//     url: ajaxurl, // обработчик
//     data: data, // данные
//     type: 'POST', // тип запроса
//     success: function (data) {
//       if (data) {
//         that.text('Загрузить ещё').before(data); // вставляем новые посты
//         tab[id]['current_page']++; // увеличиваем номер страницы на единицу
//         if (tab[id]['current_page'] == max_pages) that.remove(); // если последняя страница, удаляем кнопку
//       } else {
//         $(this).remove(); // если мы дошли до последней страницы постов, скроем кнопку
//       }
//     }
//   });
// });
