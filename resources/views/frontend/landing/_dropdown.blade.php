<script>
  var divisionsArray = [];
  var $divisionDropDown = $("#DropDown_division");
  var $container1 = $(".table-details1");
  var $container2 = $(".table-details2");
  var containerH = $(".table-details1").height();
  var feedNumber = containerH / 95 ;
  var feedwhole = Math.round(feedNumber);

  $.ajaxSetup({ cache: false });

  $.when(

  ).then(function(){
  });

  var landingDataAPI = "{{Request::root() . '/getLandingData'}}";
  // $.getJSON( "ajax/result1-F.json", function( index ) {
  $.getJSON(landingDataAPI, function( index ) {

    $.each(index.content.users, function( i, val ) {
      val = jQuery.parseJSON(val);

      $container1.append( "<div><ul>" + "<img src='" + val.profileImage + "'></img>" + "</ul><ul><li>"+ val.name + "</li><li>" + val.occupation +"</li><li>"  + val.location + "</li><li>" + val.division + "</li></ul>" + "<ul><li> <button> FOLLOW </button> </li>" + "<li>" + val.followers + "</li><li>followers</li><ul></div>");
    });
    $.each(index.content.news, function( i, val ) {
      val = jQuery.parseJSON(val);
      $container2.append( "<div><ul><li>"+ val.title + "</li><li>" + val.date +"</li><li>"  + val.tags + "</li><li>" + val.division + "</li></ul>" + "<ul><li> <button> SHARE </button> </li><ul></div>");
    });
    var boxL = $('.table-details2').height();
    var tableL = $('.table-details1').height();
    var totalL = $('.card-ajax').height();
    var cardL = boxL + tableL;
    if (cardL > totalL){
      $('ul li:last').css('opacity','0');
    };

    $.each(index.content.news, function( i, val ) {
      val = jQuery.parseJSON(val);
      var division = val.division;
      $.each(division, function() {
        var eachdivi = division[2];
        if ($.inArray(eachdivi, divisionsArray) == -1) {
            divisionsArray.push(eachdivi);
      }
    });
  });

  divisionsArray.sort();

  $.each(divisionsArray, function (i) {
    if (i <= 5){
      $divisionDropDown.append('<option value="' + divisionsArray[i] + '">' + divisionsArray[i] + '</option>');
      }
      else {

      }
  });

  $divisionDropDown.change(function () {
      var seleceddivision = this.value;
      //filter based on  selected division.
      makesArray = jQuery.grep(index.content.users, function (product, i) {
          return product.division == seleceddivision;
          console.log(makesArray);
      });
      // updateTable(makesArray);

  });

  // updateTable = function (collaction) {
  //   $container1.empty().hide(0).delay(200).fadeIn(700);
  //     for (var i = 0; i < 2; i++) {
  //         // original was i < collaction.length
  //         $container1.append("<div><ul>" +  "<img src='collaction[i].profileImage'></img>" + "</ul><ul><li>"+ collaction[i].name + "</li><li>" + collaction[i].occupation +"</li><li>"  + collaction[i].location + "</li><li>" + collaction[i].division + "</li></ul>" + "<ul><li> <button> FOLLOW </button> </li>" + "<li>" + collaction[i].followers + "</li><li>followers</li><ul></div>");
  //     }
  //   }
  });
</script>
