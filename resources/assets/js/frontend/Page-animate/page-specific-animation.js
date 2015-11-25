//1) For all pages that have division navigation, this fix the position of the bar when scrolling.

<<<<<<< HEAD
$(window).on('scroll', function() {
    var y_scroll_pos = window.pageYOffset;
    var scroll_pos_test = 450;             // set to whatever you want it to be


    if(y_scroll_pos > scroll_pos_test) {
      $('#welcome-division-bar').addClass('fix-division-bar ');
      $('.divisions-page-item').addClass('float-top');
    }

    else {
      $('#welcome-division-bar').removeClass('fix-division-bar ');
      $('.divisions-page-item').removeClass('float-top');
    }
});
=======
// $(window).on('scroll', function() {
//     var y_scroll_pos = window.pageYOffset;
//     var scroll_pos_test = 450;             // set to whatever you want it to be
//
//     if(y_scroll_pos > scroll_pos_test) {
//       $('#welcome-division-bar').addClass('fix-division-bar ');
//       $('.divisions-page-item').addClass('float-top');
//     }
//     else {
//       $('#welcome-division-bar').removeClass('fix-division-bar ');
//       $('.divisions-page-item').removeClass('float-top');
//     }
// });
>>>>>>> 7c4479eadf4161768e4c8e9b591e0b4f54f9c0e8

//2)
