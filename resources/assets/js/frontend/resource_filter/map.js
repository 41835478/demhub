
// $( document ).ready(function() {
// 	$('.map').maphilight({fade: true});
// });

var countries = ["canada","united_states","australia"];
var currentCountry;
var counter=0;

function changeCoordinates (mapCountry){
  var widthDiff= 650/$("#"+mapCountry+"_img").attr('orgWidth');

  var polyShapeHighlight;
  var coords;
  var coordsArray=[];
  for (var i=1;i<=$("#"+mapCountry+"_poly_count").val();i++){

    coords=$("#"+mapCountry+"_poly_"+i).attr('coords');
    coordsArray= coords.split(",");
    for (var j=0;j<coordsArray.length;j++){
      coordsArray[j]=coordsArray[j]*widthDiff;
      coordsArray[j]=Math.trunc(coordsArray[j]);
    }
    document.getElementById(mapCountry+"_poly_"+i).coords=coordsArray.join();
  }
}
function changeTitle (mapCountry){

  var polyShapeHighlight;
  var coords;
  var coordsArray=[];
  for (var i=1;i<=$("#"+mapCountry+"_poly_count").val();i++){

    coords=$("#"+mapCountry+"_poly_"+i).attr('title');
    document.getElementById(mapCountry+"_poly_"+i).title=coords.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });;
  }
}
$("select#country").change(function(){
  if (($("select#country").val()) !== null){

    var filterVar = $("select#country").val();
    var country = filterVar.toLowerCase();
    country=country.replace(/ /g,"_");
		currentCountry=country;
    // var list =document.getElementsByClassName(country);


            $("tr").addClass("out");
            $("tr").removeClass("in");
            $("tr." +country).addClass("in");
            $("tr." +country).removeClass("out");


      fillRegions(country);
      var regionForm =("<option value='' disabled selected>Select One</option>; "+fillRegions(country));
      document.getElementById("region").innerHTML=regionForm;
      document.getElementById("regionFormGroup").style.display="";
      $(".mapContainer").hide();
			if (country == "new_zealand"){
	      document.getElementById("mapListing").style.display="";
	    }
			else if (country == "canada"){
				document.getElementById("canada_map").style.marginTop="-150px";
			}
			else if (country == "australia"){
				document.getElementById("australia_map").style.marginTop="-15px";
			}

      $("#"+country+"_map").show();
      document.getElementById(country+"_map").style.visibility="";
      document.getElementById(country+"_map").style.height="";
      $("#backButton").attr("onclick","window.location.reload()");
      document.getElementById("backButton").style.display="";
			document.getElementById("divisionFormGroup").style.display="";
			// document.getElementById("keywordFormGroup").style.display="";
			document.getElementById("countryFormGroup").style.display="none";
    }

});

function firstFilterF(country){
	$('#country option:selected').text(country);
  var filterVar = country;

  country = filterVar.toLowerCase();
  country = country.replace(/ /g,"_");
	currentCountry=country;
  // var list =document.getElementsByClassName(country);


          $("tr").addClass("out");
          $("tr").removeClass("in");
          $("tr." +country).addClass("in");
          $("tr." +country).removeClass("out");

    fillRegions(country);
    var regionForm =("<option value='' disabled selected>Select One</option>;"+fillRegions(country));
    document.getElementById("region").innerHTML=regionForm;
    document.getElementById("regionFormGroup").style.display="";
    $(".mapContainer").hide();

    if (country == "new_zealand"){
      document.getElementById("mapListing").style.display="";
    }
		else if (country == "canada"){
			document.getElementById("canada_map").style.marginTop="-150px";
		}
		else if (country == "australia"){
			document.getElementById("australia_map").style.marginTop="-15px";
		}

    $("#backButton").attr("onclick","window.location.reload()");

    document.getElementById("backButton").style.display="";
    $("#"+country+"_map").show();
    document.getElementById(country+"_map").style.visibility="";
    document.getElementById(country+"_map").style.height="";
    // document.getElementById("bottomMapSwap").style.height="";
		document.getElementById("divisionFormGroup").style.display="";
		// document.getElementById("keywordFormGroup").style.display="";
		document.getElementById("countryFormGroup").style.display="none";
  }
function fillRegions(country){
  var data = document.getElementById(country).innerHTML;
  // data=data.replace(/,/g,'","');
  var regionArray= data.split(",");
  var optionHTML="";
  for (var i=0;i<(regionArray.length);i++){
    optionHTML += ("<option>"+regionArray[i]+"</option>; ");
  }
  // console.log(optionHTML);
  return optionHTML;
}

$("select#division").change(function(){
		if (($("select#division").val()) != null){
			var filterVar = $("select#division").val();
			var item;

			$("td.division_tags").each(function() {
			item=this.innerHTML;
			console.log(item);
				if(item.indexOf(filterVar) ==-1) {
					$(this).parent().addClass("out");
        	$(this).parent().removeClass("in");
				}
			});

					$(".mapContainer").hide();
					// document.getElementById(country+"_map").style.display="";
					document.getElementById("mapListing").style.display="";


			$("#backButton").prop("onclick","firstFilterF('"+currentCountry+"')");
		}
	});

$("select#keyword").change(function(){
		if (($("select#keyword").val()) != null){
			var filterVar = $("select#keyword").val();
			filterVar = filterVar.toLowerCase();
			alert(filterVar);
			var item;
			var parentClass;
			$("td.keyword_tags").each(function() {
				item = $(this).html();

				if(item.indexOf(filterVar) == -1 ) {
        	$(this).parent().removeClass("in");
					$(this).parent().addClass("out");
				} else {

				}
			});

					$(".mapContainer").hide();
					// document.getElementById(country+"_map").style.display="";
					document.getElementById("mapListing").style.display="";


			$("#backButton").prop("onclick","firstFilterF('"+currentCountry+"')");
		}
	});

$("select#region").change(function(){

if (($("select#region").val()) !== null){
  var filterVar = $("select#region").val();
  var region = filterVar.toLowerCase();
  region = region.replace(/ -/g,"_");

  // var list =document.getElementsByClassName(country);

          $("tr").addClass("out");
          $("tr").removeClass("in");
          $("tr." +region).addClass("in");
          $("tr." +region).removeClass("out");

      $(".mapContainer").hide();
      // document.getElementById(country+"_map").style.display="";
      document.getElementById("mapListing").style.display="";

      $("#backButton").attr("onclick","firstFilterF('"+currentCountry+"')");

  }
});

function secondFilterF(region){
	$("select#region option:selected").text(region);
  var filterVar = region;
  region = filterVar.toLowerCase();
  region=region.replace(/ /g,"_");
  // var list =document.getElementsByClassName(country);


          $("tr").addClass("out");
          $("tr").removeClass("in");
          $("tr." +region).addClass("in");
          $("tr." +region).removeClass("out");


    $(".mapContainer").hide();
    // document.getElementById(country+"_map").style.display="";
    document.getElementById("mapListing").style.display="";
		$("#backButton").attr("onclick","firstFilterF('"+currentCountry+"')");


}
