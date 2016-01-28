//1) For all pages that have division navigation, this fix the position of the bar when scrolling.

// $(window).on('scroll', function() {
//     var y_scroll_pos = window.pageYOffset;
//     var scroll_pos_test = 450;             // set to whatever you want it to be
//
//
//     if(y_scroll_pos > scroll_pos_test) {
//       $('#welcome-division-bar').addClass('fix-division-bar ');
//       $('.divisions-page-item').addClass('float-top');
//     }
//
//     else {
//       $('#welcome-division-bar').removeClass('fix-division-bar ');
//       $('.divisions-page-item').removeClass('float-top');
//     }
// });
//

function bigImg(x) {
    x.style.height = "64px";
    x.style.width = "64px";
    $('.svg-landing').css('background-color','red');
    $('#XMLID_36_').addClass("hoverNode ");
}

function normalImg(x) {
    x.style.height = "32px";
    x.style.width = "32px";
}
$(function() {
$('.st3').click(function(){
  var colors = ["#6F216C", "#F34B0D", "#C50102", "#5DA537", "#F1D81B"];
                  var pick = Math.floor(Math.random()*5);
                  var color = colors[pick];
                  $(this).css('fill',color);
                  $('.maphead1').addClass("maphead");
                  })
      //  .mouseout(function() {
      //            $(this).css('fill','black');
// });
});

$(function() {
      $('a').mouseenter(function() {
                  $('circle', this).attr('fill', '#000');
            }).mouseleave(function() {
                  $('circle', this).attr('fill', '#000');
            });
});

function carouselRes() {
  var caroLength = $('.carousel-inner').height();
  var windowLength = $(document).height();
  var difference = caroLength - windowLength;

  if (difference < 0) {
    $('.carousel-inner').children('img').css('min-height','100vh');
    $('.carousel-inner').children('img').css('min-width','auto');
  }
  else if(difference > 0) {
    $('.carousel-inner').children('img').css('min-height','auto');
    $('.carousel-inner').children('img').css('min-width','100vw');
  }
  //console.log (difference);
};

$(document).ready(function(){
    $("#DropDown_division").click(function(){

    });
    carouselRes();
});
