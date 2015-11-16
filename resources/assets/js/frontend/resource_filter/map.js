
$( document ).ready(function() {
	$('.map').maphilight({fade: true});
});

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
		console.log(document.getElementById(mapCountry+"_poly_"+i).coords);
  }
}

$("select#country").change(function(){
  if (($("select#country").val()) !== null){

    var filterVar = $("select#country").val();
    var country = filterVar.toLowerCase();
    country=country.replace(/ /g,"_");
		currentCountry=country;
    // var list =document.getElementsByClassName(country);

    if($("tr").hasClass('in')) {
            $("tr").addClass("out");
            $("tr").removeClass("in");
            $("tr." +country).addClass("in");
            $("tr." +country).removeClass("out");
        }

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
			// document.getElementById("divisionFormGroup").style.display="";
    }

});

function firstFilterF(country){

  var filterVar = country;
  document.getElementById("country").value=country;

  country = filterVar.toLowerCase();
  country = country.replace(/ /g,"_");
	currentCountry=country;
  // var list =document.getElementsByClassName(country);

  if($("tr").hasClass('in')) {
          $("tr").addClass("out");
          $("tr").removeClass("in");
          $("tr." +country).addClass("in");
          $("tr." +country).removeClass("out");
      }
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
		// document.getElementById("divisionFormGroup").style.display="";

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

			if($("tr").hasClass('in')) {
			        $("tr." +filterVar).addClass("in");
			        $("tr." +filterVar).removeClass("out");
			    }
					$(".mapContainer").hide();
					// document.getElementById(country+"_map").style.display="";
					document.getElementById("mapListing").style.display="";

			filterVar = $("select#country").val();
			var country = filterVar.toLowerCase();
			country=country.replace(/ -/g,"_");
			$("#backButton").prop("onclick","firstFilterF('"+country+"')");
		}
	});

$("select#region").change(function(){

if (($("select#region").val()) !== null){
  var filterVar = $("select#region").val();
  var region = filterVar.toLowerCase();
  region=region.replace(/ -/g,"_");

  // var list =document.getElementsByClassName(country);

  if($("tr").hasClass('in')) {
          $("tr").addClass("out");
          $("tr").removeClass("in");
          $("tr." +region).addClass("in");
          $("tr." +region).removeClass("out");
      }
      $(".mapContainer").hide();
      // document.getElementById(country+"_map").style.display="";
      document.getElementById("mapListing").style.display="";

      $("#backButton").attr("onclick","firstFilterF('"+currentCountry+"')");

  }
});

function secondFilterF(region){
  document.getElementById("region").value=region;
  var filterVar = region;
  region = filterVar.toLowerCase();
  region=region.replace(/ /g,"_");
  // var list =document.getElementsByClassName(country);

  if($("tr").hasClass('in')) {
          $("tr").addClass("out");
          $("tr").removeClass("in");
          $("tr." +region).addClass("in");
          $("tr." +region).removeClass("out");
      }

    $(".mapContainer").hide();
    // document.getElementById(country+"_map").style.display="";
    document.getElementById("mapListing").style.display="";
		$("#backButton").attr("onclick","firstFilterF('"+currentCountry+"')");


}
