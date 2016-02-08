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
// Get the modal
var modal = document.getElementById('mymodal');

// Get the button that opens the modal
var btn = $(".st3");

//find the position of the node;
$(function(){
  $('.st3').click(function(){
    modal.style.display = "block";

    var nodePosition = $(this).offset();
    var nodeTop = nodePosition.top;
    var nodeLeft = nodePosition.left;
    var leftOffset = $(window).width()/2;

    var modaloffset = $(modal).outerWidth(true)/2;
    var topwidth = $('#welcome_home').height();
    $('.modal').removeClass('modal-backdrop');

    // console.log(nodeTop, nodeLeft);
    var modalPosition = $('.landingmodal');
    modalPosition.css({
      top:nodeTop - 46,
      left:nodeLeft - 370
    });
    var svgID = $(this).attr('id');

    // console.log(svgID);
    var mapImg = $('#map-img');
    if(svgID === "XMLID_8"){
      $(mapImg).attr('src','images/landing-avatars/torrin.jpg');
      $('#map-user').html('<li>Torrin Hona</li>');
      $('#map-place').html('<li>new Zealand</li>');
      $('#map-profession').html('<li>volunteer community Ambassador Disabilities strategy</li>');
      $('#map-division').html('<li>EM Practitioner & Response</li>');
      $('#map-follow').html('<li><button>FOLLOW</button></li>');
    }
    else if(svgID === "XMLID_1"){
      $(mapImg).attr('src','images/landing-avatars/aldo.png');
      $('#map-user').html('<li>Aldo Ruiz</li>');
      $('#map-place').html('<li>Canada</li>');
      $('#map-profession').html('<li>Programmer</li>');
      $('#map-division').html('<li>Science & Environment</li>');
      $('#map-follow').html('<li><button>FOLLOW</button></li>');
    }
    else if(svgID === "XMLID_15"){
      $('#map-user').html('<li>Diana Wong</li>');
      $('#map-place').html('<li>Australia</li>');
      $('#map-profession').html('<li>Disaster Health Evaluation Consultant</li>');
      $('#map-division').html('<li>Health & Epidemics</li>');
      $('#map-follow').html('<li><button>FOLLOW</button></li>');
    }
    else if(svgID === "XMLID_13"){
      $('#map-user').html('<li>Matt Feryan</li>');
      $('#map-place').html('<li>USA</li>');
      $('#map-profession').html('<li>Sr. Emergency Management Specialist</li>');
      $('#map-division').html('<li>Em Practitioner & Response</li>');
      $('#map-follow').html('<li><button>FOLLOW</button></li>');
    }
    else if(svgID === "XMLID_5"){
      $('#map-user').html('<li>Deb Borsos</li>');
      $('#map-place').html('<li>Canada</li>');
      $('#map-profession').html('<li>ESS Director, rural Recovery work</li>');
      $('#map-division').html('<li>Science & Environment</li>');
      $('#map-follow').html('<li><button>FOLLOW</button></li>');
    }
    else{
        $(mapImg).attr('src','images/landing-avatars/missing.png');
        $('#map-user').html('<li>This location awaits your input </li>');
        $('#map-place').html('<li></li>');
        $('#map-profession').html('<li>Connect to Disaster Management professionals worldwide</li>');
        $('#map-division').html('<li></li>');
        $('#map-follow').html('<li><button>JOIN NOW </button></li>');
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

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
