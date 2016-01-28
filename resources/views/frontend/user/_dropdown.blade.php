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
    var jasondata = [];

    $.each(index.content.users, function( i, val ) {
      val = jQuery.parseJSON(val);
      $container1.append( "<div><ul>" + val.profileImage + "</ul><ul><li>"+ val.name + "</li><li>" + val.occupation +"</li><li>"  + val.location + "</li><li>" + val.division + "</li></ul>" + "<ul><li> <button> FOLLOW </button> </li>" + "<li>" + val.followers + "</li><li>followers</li><ul></div>");
    });

    var jasondata = [];
    $.each(index.content.users, function( i, val ) {

      var division = index[i].division;
      if ($.inArray(division, divisionsArray) == -1) {
          divisionsArray.push(division);
      }
  });

  divisionsArray.sort();

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

  updateTable = function (collaction) {
    $container1.empty().hide(0).delay(200).fadeIn(700);
      for (var i = 0; i < 2; i++) {
          // original was i < collaction.length
          $container1.append("<div><ul>" + collaction[i].profileImage + "</ul><ul><li>"+ collaction[i].name + "</li><li>" + collaction[i].occupation +"</li><li>"  + collaction[i].location + "</li><li>" + collaction[i].division + "</li></ul>" + "<ul><li> <button> FOLLOW </button> </li>" + "<li>" + collaction[i].followers + "</li><li>followers</li><ul></div>");
      }
    }
  });
</script>
