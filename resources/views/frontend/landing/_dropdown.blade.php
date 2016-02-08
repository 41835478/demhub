<script>
  var divisionsArray = [];
  var $divisionDropDown = $("#DropDown_division");
  var $container1 = $(".table-details1");
  var $container2 = $(".table-details2");
  var containerH = $(".table-details1").height();
  var feedNumber = containerH / 95 ;
  var feedwhole = Math.round(feedNumber);
  var $boxbottom = $('.card-ajax');
  $boxbottom = $boxbottom.position().top + $boxbottom.outerHeight(true);
  console.log($boxbottom);

// te function to limit the words of the title and tags //
function limitWords(textToLimit, wordLimit)
    {
    var finalText = "";
    var text2 = textToLimit.replace(/\s+/g, ' ');
    var text3 = text2.split(' ');
    var numberOfWords = text3.length;
    var i=0;

    if(numberOfWords > wordLimit)
    {
    for(i=0; i< wordLimit; i++)
    finalText = finalText+" "+ text3[i]+" ";

    return finalText+"...";
    }
    else return textToLimit;
  }

    // main dropdown function
  $.ajaxSetup({ cache: false });

  $.when(

  ).then(function(){
  });

  var landingDataAPI = "{{Request::root() . '/getLandingData'}}";
  // $.getJSON( "ajax/result1-F.json", function( index ) {
  $.getJSON(landingDataAPI, function( index ) {

    $.each(index.content.users, function( i, val ) {
      val = jQuery.parseJSON(val);
      $container1.append( "<div><ul style='background-image:url("+ val.profileImage + "); background-repeat:no-repeat; background-size: auto 100%;'></ul><ul><li>"+ val.name + "</li><li>" + val.occupation +"</li><li>"  + val.location + "</li><li>" + val.division + "</li></ul>" + "<ul><li><a href =\"auth/register\"><button> FOLLOW </button></li></a>" + "<li>" + val.followers + "</li><li>followers</li><ul></div>");
    });
    $.each(index.content.news, function( i, val ) {
      val = jQuery.parseJSON(val);
      var limit = limitWords(val.title, 6);
      var tag = limitWords(val.title, 5);
      var $newsbottom = $($container2);
      $newsbottomL = $newsbottom.position().top + $newsbottom.outerHeight(true) + 100;
      if($newsbottomL < $boxbottom){
                $container2.append( "<div><ul><li>"+ limit + "</li><li>" + val.date +"</li><li>"  + tag + "</li><li>" + val.division + "</li></ul>" + "<ul><li> <a href =\"auth/register\"><button> SHARE </button> </li><ul></div>");
      }
      else{

      }
    });




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
      var seleceddivision = (this.value);

      // filter based on  selected division.
     makesArray = jQuery.grep(index.content.users, function (val, index) {
       val = jQuery.parseJSON(val);
       var division = this.value;
      return val.division[0] == seleceddivision;
    });

      makesArrayNews = jQuery.grep(index.content.news, function (val, index) {
        val = jQuery.parseJSON(val);
        var division = this.value;
       return val.division[0] == seleceddivision;
     });

    updateTable(makesArray);
    updateTableNews(makesArrayNews);
  });

  updateTable = function (usersArray) {
    $container1.empty().hide(0).delay(200).fadeIn(700);
    usersArray.forEach(function(entry){
      var user = JSON && JSON.parse(entry) || $.parseJSON(entry);
      $container1.append( "<div><ul style='background-image:url("+ user.profileImage + "); background-repeat:no-repeat; background-size: auto 100%;'></ul><ul><li>"+ user.name + "</li><li>" + user.occupation +"</li><li>"  + user.location + "</li><li>" + user.division + "</li></ul>" + "<ul><a href =\"auth/register\"><li> <button> FOLLOW </button> </li></a>" + "<li>" + user.followers + "</li><li>followers</li><ul></div>");
    });
  };



  updateTableNews = function (newsArray) {
    $container2.empty().hide(0).delay(200).fadeIn(700);
    newsArray.forEach(function(entry){
      var news = JSON && JSON.parse(entry) || $.parseJSON(entry);
      var limit = limitWords(news.title, 6);
      var tag = limitWords(news.title, 5);
      var $newsbottom = $($container2);
      $newsbottomL = $newsbottom.position().top + $newsbottom.outerHeight(true) + 300;
      if($newsbottomL < $boxbottom){
          $container2.append( "<div><ul><li>"+ limit + "</li><li>" + news.date +"</li><li>"  + tag + "</li><li>" + news.division + "</li></ul>" + "<ul><a href =\"auth/register\"><li> <button> SHARE </button> </li></a><ul></div>");
      }
      else{}
          console.log(news.title, $newsbottomL);
    });
  };

  //     updateTableNews = function (collaction) {
  //       $container1.empty().hide(0).delay(200).fadeIn(700);
  //         for (var i = 0; i < 2; i++) {
  //             // original was i < collaction.length
  //               $container2.append( "<div><ul><li>"+ collaction[i].title + "</li><li>" + collaction[i].date +"</li><li>"  + collaction[i].tags + "</li><li>" + collaction[i].division + "</li></ul>" + "<ul><li> <button> SHARE </button> </li><ul></div>");
  //           }
  //         };
  });
</script>
