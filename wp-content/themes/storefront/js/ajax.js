let ajaxFlag = true;

// if ($('.section--blog .grid').length) {

  $(window).scroll(function () {
    console.log($('.section--blog .grid').offset().top + $('.section--blog .grid').outerHeight() - 1000);
    if ($(window).scrollTop() >= ($('.section--blog .grid').offset().top + $('.section--blog .grid').outerHeight() - 1000) && ajaxFlag === true) {

      var data = {
        'action': 'loadmore',
        'query': tab[id]['true_posts'],
        'page': tab[id]['current_page'],
        'post_type': tab[id]['post_type'],
        'post_per_page': tab[id]['post_per_page'],
      };
      console.log('load');

      $('.preloader').addClass('is-active');

      ajaxFlag = false;

      $.ajax({
        // url: ajaxurl, // обработчик
        // data: data, // данные
        // type: 'POST', // тип запроса
        // success: function (data) {
        //   $('.preloader').removeClass('is-active');
        //   if (data) {
        //     that.text('Загрузить ещё').before(data); // вставляем новые посты
        //     tab[id]['current_page']++; // увеличиваем номер страницы на единицу
        //     ajaxFlag = true;
        //     if (tab[id]['current_page'] == max_pages) {
        //       that.remove(); // если последняя страница, удаляем кнопку
        //       ajaxFlag = false;
        //     }
        //   } else {
        //     $(this).remove(); // если мы дошли до последней страницы постов, скроем кнопку
        //     ajaxFlag = false;
        //   }
        // }
      });
    }
  });
// }

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
