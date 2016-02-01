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

$(function responsiveImg() {

  var winwidth = $(window).width();
  var winheight = $(window).height();
  var Imgwidth = $('.care-bg > img').width();
  var Imgheight = $('.care-bg > img').height();


if (Imgheight < winheight){
    $('.care-bg > img').css('height','100vh');
    $('.care-bg > img').css('width','auto');
    $('.care-bg > img').css('min-height','100%');
  }
// else if (Imgwidth < winwidth){
//     $('.care-bg > img').css('width','100vw');
//     $('.care-bg > img').css('height','auto');
//   }

  console.log(winwidth,winheight,Imgwidth,Imgheight);
});

// function bigImg(x) {
//     x.style.height = "64px";
//     x.style.width = "64px";
//     $('.svg-landing').css('background-color','red');
//     $('#XMLID_36_').addClass("hoverNode ");
// }
//
// function normalImg(x) {
//     x.style.height = "32px";
//     x.style.width = "32px";
// }

//node js. change color and opacity.
$(function() {
$('.st3').mouseover(function(){
  var colors = ["#36a172", "#438bb3", "#e1a646", "#999c9d", "#a55454","#8c62a5"];
                  var pick = Math.floor(Math.random()*6);
                  var color = colors[pick];
                  $(this).css('fill',color);
                  $('.maphead1').addClass("maphead");
                  $('.nodeline').css('opacity','0.5');
                });
$('.st3').mouseout(function(){
  $('.nodeline').css('opacity','0');
})
});

var nodeLeft = null;
var nodeTop = null;

if ($('#XMLID_36_').offset()) {
  nodeLeft = $('#XMLID_36_').offset().left;
  nodeTop = $('#XMLID_36_').offset().top;
}

$('.svg-modal'). css ('margin-top',nodeTop);
$(function() {
      $('a').mouseenter(function() {
                  $('circle', this).attr('fill', '#000');
            }).mouseleave(function() {
                  $('circle', this).attr('fill', '#000');
            });
});

$(document).ready(function(){
    // $("#DropDown_division").click(function(){
    //
    // });
    responsiveImg();
});
