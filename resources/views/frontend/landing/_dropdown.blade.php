<script>
  var divisionsArray = [],
      $divisionDropDown = $("#DropDown_division"),
      $container1 = $(".table-details1"),
      $container2 = $(".table-details2"),
      containerH = $(".table-details1").height(),
      feedNumber = containerH / 95 ,
      feedwhole = Math.round(feedNumber),
      numUser1 = 1;
      numNew1 = 1;
      numUser2 = 1;
      numNew2 = 1;
      $boxbottom = $('.card-ajax');

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
      numUser1 ++;
      if(numUser1 < 5){
          $container1.append( "<div><ul style='background-image:url("+ val.profileImage + "); background-repeat:no-repeat; background-size: auto 100%;'></ul><ul><li>"+ val.name + "</li><li>" + val.occupation +"</li><li>"  + val.location + "</li><li>" + val.division + "</li></ul>" + "<ul><li><a href =\"auth/register\"><button> FOLLOW </button></li></a>" + "<li>" + val.followers + "</li><li>followers</li><ul></div>");
      }
      else{
          $container2.append();
      }
    });
    $.each(index.content.news, function( i, val ) {
      val = jQuery.parseJSON(val);
      var limit = limitWords(val.title, 6);
      var tag = limitWords(val.title, 5);
      var $newsbottom = $($container2);
      $newsbottomL = $newsbottom.position().top + $newsbottom.outerHeight(true) + 100;
    //   if($newsbottomL < $boxbottom){
        numNew1 ++;
        if(numNew1 < 5){
            $container2.append( "<div><ul><li>"+ limit + "</li><li>" + val.date +"</li><li>"  + tag + "</li><li>" + val.division + "</li></ul>" + "<ul><li> <a href =\"auth/register\"><button> SHARE </button> </li><ul></div>");
        }
        if(numNew1 > 5){
            $container2.append();
        }
    });




    $.each(index.content.news, function( i, val ) {
      val = jQuery.parseJSON(val);
      var division = val.division;
      $.each(division, function() {
        var eachdivi = division[0];
        if ($.inArray(eachdivi, divisionsArray) == -1) {
            divisionsArray.push(eachdivi);
      }
    });
  });

  divisionsArray.sort();
  $.each(divisionsArray, function (i) {
      $divisionDropDown.append('<option value="' + divisionsArray[i] + '">' + divisionsArray[i] + '</option>');

  });
 $divisionDropDown.append('<option value="Science & Environment">Science & Environment</option>')

  $divisionDropDown.change(function () {
      var seleceddivision = (this.value);
      console.log(seleceddivision);
      // filter based on  selected division.
     makesArray = jQuery.grep(index.content.users, function (val, index) {
       val = jQuery.parseJSON(val);
       var division = this.value;
      return val.division[0] == seleceddivision;
    });

      makesArrayNews = jQuery.grep(index.content.news, function (val, index) {
        val = jQuery.parseJSON(val);
        var division = this.value;
       return val.division[0] == seleceddivision || val.division[2] == "Science & Environment";
     });

     numNew2 = 1;
     numUser2 = 1;
    updateTable(makesArray);
    updateTableNews(makesArrayNews);
  });

  updateTable = function (usersArray) {
    $container1.empty().hide(0).delay(200).fadeIn(700);
    usersArray.forEach(function(entry){
      var user = JSON && JSON.parse(entry) || $.parseJSON(entry);
      if(numUser2 < 5){
          $container1.append( "<div><ul style='background-image:url("+ user.profileImage + "); background-repeat:no-repeat; background-size: auto 100%;'></ul><ul><li>"+ user.name + "</li><li>" + user.occupation +"</li><li>"  + user.location + "</li><li>" + user.division + "</li></ul>" + "<ul><a href =\"auth/register\"><li> <button> FOLLOW </button> </li></a>" + "<li>" + user.followers + "</li><li>followers</li><ul></div>");
      }
      else {
          $container1.append();
      }
    });
  };



  updateTableNews = function (newsArray) {

    $container2.empty().hide(0).delay(200).fadeIn(700);
    newsArray.forEach(function(entry){
        numNew2 ++
      var news = JSON && JSON.parse(entry) || $.parseJSON(entry);
      var limit = limitWords(news.title, 6);
      var tag = limitWords(news.title, 5);
      var $newsbottom = $($container2);
      $newsbottomL = $newsbottom.position().top + $newsbottom.outerHeight(true) + 300;
      if(numNew2 < 5){
          $container2.append( "<div><ul><li>"+ limit + "</li><li>" + news.date +"</li><li>"  + tag + "</li><li>" + news.division + "</li></ul>" + "<ul><a href =\"auth/register\"><li> <button> SHARE </button> </li></a><ul></div>");
      }
      else {
          $container2.append();
      }
    });
  };

  //     updateTableNews = function (collaction) {
  //       $container1.empty().hide(0).delay(200).fadeIn(700);
  //         for(var i = 0; i < 2; i++) {
  //             // original was i < collaction.length
  //               $container2.append( "<div><ul><li>"+ collaction[i].title + "</li><li>" + collaction[i].date +"</li><li>"  + collaction[i].tags + "</li><li>" + collaction[i].division + "</li></ul>" + "<ul><li> <button> SHARE </button> </li><ul></div>");
  //           }
  //         };
  });
</script>
