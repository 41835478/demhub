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

//2)Landing page animations
var divisionsArray = [];
var $divisionDropDown = $("#DropDown_division");
var $container1 = $(".table-details1");
var $container2 = $(".table-details2");
var containerH = $(".table-details1").height();
var feedNumber = containerH / 95 ;
var feedwhole = Math.round(feedNumber);

// adding unique divisions to divisionsArray
$.ajaxSetup({ cache: false });

$.when(

).then(function(){

});

$.getJSON( "ajax/result1-people.json", function( index ) {
  var jasondata = [];
  $.each(index, function( i, val ) {
    $container1.append( "<div><ul>" + val.profileImage + "</ul><ul><li>"+ val.name + "</li><li>" + val.occupation +"</li><li>"  + val.location + "</li><li>" + val.division + "</li></ul>" + "<ul><li> <button> FOLLOW </button> </li>" + "<li>" + val.followers + "</li><li>followers</li><ul></div>");
  });
});

//get json data for the connections
$.getJSON( "ajax/result1-people.json", function( index ) {
  var jasondata = [];
  $.each(index, function( i, val ) {

    var division = index[i].division;
    if ($.inArray(division, divisionsArray) == -1) {
        divisionsArray.push(division);
    }
});
//get json data for the newsfeed
$.getJSON("ajax/result1-news.json", function(index){
var jasondata = [];
});

//sorting the division
divisionsArray.sort();


// append the divisions to select
$.each(divisionsArray, function (i) {
    $divisionDropDown.append('<option value="' + divisionsArray[i] + '">' + divisionsArray[i] + '</option>');
});

$divisionDropDown.change(function () {
    var seleceddivision = this.value;
    //filter based on  selected division.
    makesArray = jQuery.grep(index, function (product, i) {
        return product.division == seleceddivision;
    });
    updateTable(makesArray);
});

//To update the table element with selected items
updateTable = function (collaction) {
  $container1.empty().hide(0).delay(200).fadeIn(700);
    for (var i = 0; i < 2; i++) {
        // original was i < collaction.length
        $container1.append("<div><ul>" + collaction[i].profileImage + "</ul><ul><li>"+ collaction[i].name + "</li><li>" + collaction[i].occupation +"</li><li>"  + collaction[i].location + "</li><li>" + collaction[i].division + "</li></ul>" + "<ul><li> <button> FOLLOW </button> </li>" + "<li>" + collaction[i].followers + "</li><li>followers</li><ul></div>");
    }
  }
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
