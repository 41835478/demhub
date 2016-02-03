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

function responsiveImg() {

  var winwidth = $(window).width();
  var winheight = $(window).height();
  var Imgwidth = $('.care-bg > img').width();
  var Imgheight = $('.care-bg > img').height();

if (Imgwidth <= winwidth && Imgheight >= winheight){
    $('.care-bg > img').css('width','100vw');
    $('.care-bg > img').css('height','auto');
  }

else if (Imgheight <= winheight && Imgwidth >= winwidth){
      $('.care-bg > img').css('width','auto');
      $('.care-bg > img').css('height','100vh');
  }

  else if (Imgheight < winheight && Imgwidth < winwidth){
    H = winheight - Imgheight;
    W = winwidth - Imgwidth;
    if (H > W){
      $('.care-bg > img').css('width','auto');
      $('.care-bg > img').css('height','100vh');
    }
    else {
      $('.care-bg > img').css('width','100vw');
      $('.care-bg > img').css('height','auto');
    }
    }
  // console.log(winwidth,winheight,Imgwidth,Imgheight);
}
//find the position of the node;
$(function(){
  $('.st3').click(function(){
    var nodePosition = $(this).offset();
    var nodeTop = nodePosition.top;
    var nodeLeft = nodePosition.left;
    var leftOffset = $(window).width()/2;
    var modaloffset = $('.table-modal').width()/2;
    var topwidth = $('#welcome_home').height();

    var modalPosition = $('.table-modal');
    modalPosition.css({
      top:300,
      top:nodeTop - topwidth,
      left:nodeLeft - leftOffset + modaloffset
    });
    var svgID = $(this).attr('id');
    console.log(svgID);
    if(svgID === "XMLID_8"){
      $('#map-img').attr("src").replace('images/landing-avatars/torrin.jpg');
      $('#map-user').replaceWith('<li>Torrin Hona</li>');
      $('#map-place').replaceWith('<li>new Zealand</li>');
      $('#map-profession').replaceWith('<li>volunteer community Ambassador Disabilities strategy</li>');
      $('#map-division').replaceWith('<li>EM Practitioner & Response</li>');
    }
    else if(svgID === "XMLID_1"){
      $('#map-user').replaceWith('<li>Aldo Ruiz</li>');
      $('#map-place').replaceWith('<li>Canada</li>');
      $('#map-profession').replaceWith('<li>Programmer</li>');
      $('#map-division').replaceWith('<li>Science & Environment</li>');
    }
    else if(svgID === "XMLID_15"){
      $('#map-user').replaceWith('<li>Diana Wong</li>');
      $('#map-place').replaceWith('<li>Australia</li>');
      $('#map-profession').replaceWith('<li>Disaster Health Evaluation Consultant</li>');
      $('#map-division').replaceWith('<li>Health & Epidemics</li>');
    }
    else if(svgID === "XMLID_13"){
      $('#map-user').replaceWith('<li>Matt Feryan</li>');
      $('#map-place').replaceWith('<li>USA</li>');
      $('#map-profession').replaceWith('<li>Sr. Emergency Management Specialist</li>');
      $('#map-division').replaceWith('<li>Em Practitioner & Response</li>');
    }
    else if(svgID === "XMLID_5"){
      $('#map-user').replaceWith('<li>Deb Borsos</li>');
      $('#map-place').replaceWith('<li>Canada</li>');
      $('#map-profession').replaceWith('<li>ESS Director, rural Recovery work</li>');
      $('#map-division').replaceWith('<li>Science & Environment</li>');
    }
    else{
        $('#map-img').attr("src").replace('images/avatars/thumb/missing.png');
        $('#map-user').replaceWith('<li>Your Profile</li>');
        $('#map-place').replaceWith('<li></li>');
        $('#map-profession').replaceWith('<li></li>');
        $('#map-division').replaceWith('<li></li>');
    }
  });
});
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
  });
});


$(document).ready(function(){
    responsiveImg();
});
