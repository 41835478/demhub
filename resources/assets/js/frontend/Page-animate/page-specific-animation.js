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

$(document).ready(function(){
    $("#DropDown_division").click(function(){
        $(".table-details").fadeIn(slow);
    });
});


//2)Landing page animations
var divisionsArray = [];
var $divisionDropDown = $("#DropDown_division");
var $container = $(".table-details");

// adding unique divisions to divisionsArray
$.ajaxSetup({ cache: false });

$.getJSON( "ajax/result1.json", function( index ) {
  var jasondata = [];
  $.each(index, function( i, val ) {
    $container.append( "<div><ul>" + val.profileImage + "</ul><ul><li>"+ val.name + "</li><li>" + val.occupation +"</li><li>"  + val.location + "</li><li>" + val.division + "</li></ul>" + "<ul><li> <button> FOLLOW </button> </li>" + "<li>" + val.followers + "</li><li>followers</li><ul></div>");
  });

  $( ".table-details" ).children( ".button" ).click(function() {
    window.location.href = '#DEMHUBModal';
    return false;
});

  $( "<ul/>", {
    "class": "my-new-list",
    html: jasondata.join( "" )
  }).appendTo( "body" );
});


$.getJSON( "ajax/result1.json", function( index ) {
  var jasondata = [];
  $.each(index, function( i, val ) {

    var division = index[i].division;
    if ($.inArray(division, divisionsArray) == -1) {
        divisionsArray.push(division);
    }
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
  $container.empty();
    for (var i = 0; i < collaction.length; i++) {
        $container.append("<div><ul>" + collaction[i].profileImage + "</ul><ul><li>"+ collaction[i].name + "</li><li>" + collaction[i].occupation +"</li><li>"  + collaction[i].location + "</li><li>" + collaction[i].division + "</li></ul>" + "<ul><li> <button> FOLLOW </button> </li>" + "<li>" + collaction[i].followers + "</li><li>followers</li><ul></div>");
    }
  }
});
