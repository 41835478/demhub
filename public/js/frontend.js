<<<<<<< HEAD
// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    /*
     Allows you to add data-method="METHOD to links to automatically inject a form with the method on click
     Example: <a href="{{route('customers.destroy', $customer->id)}}" data-method="delete" name="delete_item">Delete</a>
     Injects a form with that's fired on click of the link with a DELETE request.
     Good because you don't have to dirty your HTML with delete forms everywhere.
     */
    $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' name='delete_item' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "   <input type='hidden' name='_token' value='"+$('meta[name="_token"]').attr('content')+"'>\n"+
        "</form>\n"
    })
        .removeAttr('href')
        .attr('style','cursor:pointer;')
        .attr('onclick','$(this).find("form").submit();');

    /*
     Generic are you sure dialog
     */
    $('form[name=delete_item]').submit(function(){
        return confirm("Are you sure you want to delete this item?");
    });

    /*
     Bind all bootstrap tooltips
     */
    $("[data-toggle=\"tooltip\"]").tooltip();
    $("[data-toggle=\"popover\"]").popover();
    //This closes the popover when its clicked away from
    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
});
$(function(){

});
/*! Backstretch - v2.0.4 - 2013-06-19
* http://srobbin.com/jquery-plugins/backstretch/
* Copyright (c) 2013 Scott Robbin; Licensed MIT */
(function(a,d,p){a.fn.backstretch=function(c,b){(c===p||0===c.length)&&a.error("No images were supplied for Backstretch");0===a(d).scrollTop()&&d.scrollTo(0,0);return this.each(function(){var d=a(this),g=d.data("backstretch");if(g){if("string"==typeof c&&"function"==typeof g[c]){g[c](b);return}b=a.extend(g.options,b);g.destroy(!0)}g=new q(this,c,b);d.data("backstretch",g)})};a.backstretch=function(c,b){return a("body").backstretch(c,b).data("backstretch")};a.expr[":"].backstretch=function(c){return a(c).data("backstretch")!==p};a.fn.backstretch.defaults={centeredX:!0,centeredY:!0,duration:5E3,fade:0};var r={left:0,top:0,overflow:"hidden",margin:0,padding:0,height:"100%",width:"100%",zIndex:-999999},s={position:"absolute",display:"none",margin:0,padding:0,border:"none",width:"auto",height:"auto",maxHeight:"none",maxWidth:"none",zIndex:-999999},q=function(c,b,e){this.options=a.extend({},a.fn.backstretch.defaults,e||{});this.images=a.isArray(b)?b:[b];a.each(this.images,function(){a("<img />")[0].src=this});this.isBody=c===document.body;this.$container=a(c);this.$root=this.isBody?l?a(d):a(document):this.$container;c=this.$container.children(".backstretch").first();this.$wrap=c.length?c:a('<div class="backstretch"></div>').css(r).appendTo(this.$container);this.isBody||(c=this.$container.css("position"),b=this.$container.css("zIndex"),this.$container.css({position:"static"===c?"relative":c,zIndex:"auto"===b?0:b,background:"none"}),this.$wrap.css({zIndex:-999998}));this.$wrap.css({position:this.isBody&&l?"fixed":"absolute"});this.index=0;this.show(this.index);a(d).on("resize.backstretch",a.proxy(this.resize,this)).on("orientationchange.backstretch",a.proxy(function(){this.isBody&&0===d.pageYOffset&&(d.scrollTo(0,1),this.resize())},this))};q.prototype={resize:function(){try{var a={left:0,top:0},b=this.isBody?this.$root.width():this.$root.innerWidth(),e=b,g=this.isBody?d.innerHeight?d.innerHeight:this.$root.height():this.$root.innerHeight(),j=e/this.$img.data("ratio"),f;j>=g?(f=(j-g)/2,this.options.centeredY&&(a.top="-"+f+"px")):(j=g,e=j*this.$img.data("ratio"),f=(e-b)/2,this.options.centeredX&&(a.left="-"+f+"px"));this.$wrap.css({width:b,height:g}).find("img:not(.deleteable)").css({width:e,height:j}).css(a)}catch(h){}return this},show:function(c){if(!(Math.abs(c)>this.images.length-1)){var b=this,e=b.$wrap.find("img").addClass("deleteable"),d={relatedTarget:b.$container[0]};b.$container.trigger(a.Event("backstretch.before",d),[b,c]);this.index=c;clearInterval(b.interval);b.$img=a("<img />").css(s).bind("load",function(f){var h=this.width||a(f.target).width();f=this.height||a(f.target).height();a(this).data("ratio",h/f);a(this).fadeIn(b.options.speed||b.options.fade,function(){e.remove();b.paused||b.cycle();a(["after","show"]).each(function(){b.$container.trigger(a.Event("backstretch."+this,d),[b,c])})});b.resize()}).appendTo(b.$wrap);b.$img.attr("src",b.images[c]);return b}},next:function(){return this.show(this.index<this.images.length-1?this.index+1:0)},prev:function(){return this.show(0===this.index?this.images.length-1:this.index-1)},pause:function(){this.paused=!0;return this},resume:function(){this.paused=!1;this.next();return this},cycle:function(){1<this.images.length&&(clearInterval(this.interval),this.interval=setInterval(a.proxy(function(){this.paused||this.next()},this),this.options.duration));return this},destroy:function(c){a(d).off("resize.backstretch orientationchange.backstretch");clearInterval(this.interval);c||this.$wrap.remove();this.$container.removeData("backstretch")}};var l,f=navigator.userAgent,m=navigator.platform,e=f.match(/AppleWebKit\/([0-9]+)/),e=!!e&&e[1],h=f.match(/Fennec\/([0-9]+)/),h=!!h&&h[1],n=f.match(/Opera Mobi\/([0-9]+)/),t=!!n&&n[1],k=f.match(/MSIE ([0-9]+)/),k=!!k&&k[1];l=!((-1<m.indexOf("iPhone")||-1<m.indexOf("iPad")||-1<m.indexOf("iPod"))&&e&&534>e||d.operamini&&"[object OperaMini]"==={}.toString.call(d.operamini)||n&&7458>t||-1<f.indexOf("Android")&&e&&533>e||h&&6>h||"palmGetResource"in d&&e&&534>e||-1<f.indexOf("MeeGo")&&-1<f.indexOf("NokiaBrowser/8.5.0")||k&&6>=k)})(jQuery,window);

$(function () {
	"use strict";

  /* ---------------------------------------------------------
	 * Background (Backstretch)
	 */

	$(".js-fullheight-body").backstretch([
		"../images/backgrounds/fullscreen.jpg"
	]);

	$(".js-landing-hero").backstretch([
		"../images/backgrounds/landing-hero.jpg"
	]);

	$(".js-thankyou-page").backstretch([
		"../images/backgrounds/landing-hero.jpg"
	]);

	$("#welcome_secondary_text").backstretch([
		"../images/backgrounds/welcome.jpg"
	]);

	$(".js-about-hero").backstretch([
		"../images/about/ryersonslc.jpg"
	]);

	/* ---------------------------------------------------------
	 * Background (Backstretch) - Divisions
	 */

	$(".welcome-division-all-img").backstretch([
		"../images/backgrounds/divisions/all.jpg"
	]);

	$(".welcome-division-health-img").backstretch([
		"../images/backgrounds/divisions/health.jpg"
	]);

	$(".welcome-division-science-img").backstretch([
		"../images/backgrounds/divisions/science.jpg"
	]);

	$(".welcome-division-response-img").backstretch([
		"../images/backgrounds/divisions/response.jpg"
	]);

	$(".welcome-division-security-img").backstretch([
		"../images/backgrounds/divisions/security.jpg"
	]);

	$(".welcome-division-continuity-img").backstretch([
		"../images/backgrounds/divisions/continuity.jpg"
	]);

	$(".welcome-division-humanitarian-img").backstretch([
		"../images/backgrounds/divisions/humanitarian.jpg"
	]);

});

function pageUpdate(){
  if(!$('#user_name').val() || !$('#email').val() || !$('#password').val()) {
  // $("#sign-up-form").slideUp();
  $('#modalErrorButton').click();
  }
  else {
    $('#modalSuccessButton').click();
  }
}
function updateForm(){
  // document.getElementById("form-part-1").style.display="none";
  document.getElementById("form-part-2").style.display="";
}


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

/* Modernizr 2.8.3 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-flexbox-hsla-multiplebgs-opacity-rgba-textshadow-cssanimations-csscolumns-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-applicationcache-canvas-canvastext-draganddrop-hashchange-history-audio-video-indexeddb-input-inputtypes-localstorage-postmessage-sessionstorage-websockets-websqldatabase-webworkers-geolocation-inlinesvg-smil-svg-svgclippaths-touch-webgl-shiv-mq-cssclasses-addtest-prefixed-teststyles-testprop-testallprops-hasevent-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function D(a){j.cssText=a}function E(a,b){return D(n.join(a+";")+(b||""))}function F(a,b){return typeof a===b}function G(a,b){return!!~(""+a).indexOf(b)}function H(a,b){for(var d in a){var e=a[d];if(!G(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function I(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:F(f,"function")?f.bind(d||b):f}return!1}function J(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+p.join(d+" ")+d).split(" ");return F(b,"string")||F(b,"undefined")?H(e,b):(e=(a+" "+q.join(d+" ")+d).split(" "),I(e,b,c))}function K(){e.input=function(c){for(var d=0,e=c.length;d<e;d++)u[c[d]]=c[d]in k;return u.list&&(u.list=!!b.createElement("datalist")&&!!a.HTMLDataListElement),u}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),e.inputtypes=function(a){for(var d=0,e,f,h,i=a.length;d<i;d++)k.setAttribute("type",f=a[d]),e=k.type!=="text",e&&(k.value=l,k.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(f)&&k.style.WebkitAppearance!==c?(g.appendChild(k),h=b.defaultView,e=h.getComputedStyle&&h.getComputedStyle(k,null).WebkitAppearance!=="textfield"&&k.offsetHeight!==0,g.removeChild(k)):/^(search|tel)$/.test(f)||(/^(url|email)$/.test(f)?e=k.checkValidity&&k.checkValidity()===!1:e=k.value!=l)),t[a[d]]=!!e;return t}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var d="2.8.3",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k=b.createElement("input"),l=":)",m={}.toString,n=" -webkit- -moz- -o- -ms- ".split(" "),o="Webkit Moz O ms",p=o.split(" "),q=o.toLowerCase().split(" "),r={svg:"http://www.w3.org/2000/svg"},s={},t={},u={},v=[],w=v.slice,x,y=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},z=function(b){var c=a.matchMedia||a.msMatchMedia;if(c)return c(b)&&c(b).matches||!1;var d;return y("@media "+b+" { #"+h+" { position: absolute; } }",function(b){d=(a.getComputedStyle?getComputedStyle(b,null):b.currentStyle)["position"]=="absolute"}),d},A=function(){function d(d,e){e=e||b.createElement(a[d]||"div"),d="on"+d;var f=d in e;return f||(e.setAttribute||(e=b.createElement("div")),e.setAttribute&&e.removeAttribute&&(e.setAttribute(d,""),f=F(e[d],"function"),F(e[d],"undefined")||(e[d]=c),e.removeAttribute(d))),e=null,f}var a={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return d}(),B={}.hasOwnProperty,C;!F(B,"undefined")&&!F(B.call,"undefined")?C=function(a,b){return B.call(a,b)}:C=function(a,b){return b in a&&F(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=w.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(w.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(w.call(arguments)))};return e}),s.flexbox=function(){return J("flexWrap")},s.canvas=function(){var a=b.createElement("canvas");return!!a.getContext&&!!a.getContext("2d")},s.canvastext=function(){return!!e.canvas&&!!F(b.createElement("canvas").getContext("2d").fillText,"function")},s.webgl=function(){return!!a.WebGLRenderingContext},s.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:y(["@media (",n.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},s.geolocation=function(){return"geolocation"in navigator},s.postmessage=function(){return!!a.postMessage},s.websqldatabase=function(){return!!a.openDatabase},s.indexedDB=function(){return!!J("indexedDB",a)},s.hashchange=function(){return A("hashchange",a)&&(b.documentMode===c||b.documentMode>7)},s.history=function(){return!!a.history&&!!history.pushState},s.draganddrop=function(){var a=b.createElement("div");return"draggable"in a||"ondragstart"in a&&"ondrop"in a},s.websockets=function(){return"WebSocket"in a||"MozWebSocket"in a},s.rgba=function(){return D("background-color:rgba(150,255,150,.5)"),G(j.backgroundColor,"rgba")},s.hsla=function(){return D("background-color:hsla(120,40%,100%,.5)"),G(j.backgroundColor,"rgba")||G(j.backgroundColor,"hsla")},s.multiplebgs=function(){return D("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(j.background)},s.backgroundsize=function(){return J("backgroundSize")},s.borderimage=function(){return J("borderImage")},s.borderradius=function(){return J("borderRadius")},s.boxshadow=function(){return J("boxShadow")},s.textshadow=function(){return b.createElement("div").style.textShadow===""},s.opacity=function(){return E("opacity:.55"),/^0.55$/.test(j.opacity)},s.cssanimations=function(){return J("animationName")},s.csscolumns=function(){return J("columnCount")},s.cssgradients=function(){var a="background-image:",b="gradient(linear,left top,right bottom,from(#9f9),to(white));",c="linear-gradient(left top,#9f9, white);";return D((a+"-webkit- ".split(" ").join(b+a)+n.join(c+a)).slice(0,-a.length)),G(j.backgroundImage,"gradient")},s.cssreflections=function(){return J("boxReflect")},s.csstransforms=function(){return!!J("transform")},s.csstransforms3d=function(){var a=!!J("perspective");return a&&"webkitPerspective"in g.style&&y("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},s.csstransitions=function(){return J("transition")},s.fontface=function(){var a;return y('@font-face {font-family:"font";src:url("https://")}',function(c,d){var e=b.getElementById("smodernizr"),f=e.sheet||e.styleSheet,g=f?f.cssRules&&f.cssRules[0]?f.cssRules[0].cssText:f.cssText||"":"";a=/src/i.test(g)&&g.indexOf(d.split(" ")[0])===0}),a},s.generatedcontent=function(){var a;return y(["#",h,"{font:0/0 a}#",h,':after{content:"',l,'";visibility:hidden;font:3px/1 a}'].join(""),function(b){a=b.offsetHeight>=3}),a},s.video=function(){var a=b.createElement("video"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),c.h264=a.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),c.webm=a.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,"")}catch(d){}return c},s.audio=function(){var a=b.createElement("audio"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),c.mp3=a.canPlayType("audio/mpeg;").replace(/^no$/,""),c.wav=a.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),c.m4a=(a.canPlayType("audio/x-m4a;")||a.canPlayType("audio/aac;")).replace(/^no$/,"")}catch(d){}return c},s.localstorage=function(){try{return localStorage.setItem(h,h),localStorage.removeItem(h),!0}catch(a){return!1}},s.sessionstorage=function(){try{return sessionStorage.setItem(h,h),sessionStorage.removeItem(h),!0}catch(a){return!1}},s.webworkers=function(){return!!a.Worker},s.applicationcache=function(){return!!a.applicationCache},s.svg=function(){return!!b.createElementNS&&!!b.createElementNS(r.svg,"svg").createSVGRect},s.inlinesvg=function(){var a=b.createElement("div");return a.innerHTML="<svg/>",(a.firstChild&&a.firstChild.namespaceURI)==r.svg},s.smil=function(){return!!b.createElementNS&&/SVGAnimate/.test(m.call(b.createElementNS(r.svg,"animate")))},s.svgclippaths=function(){return!!b.createElementNS&&/SVGClipPath/.test(m.call(b.createElementNS(r.svg,"clipPath")))};for(var L in s)C(s,L)&&(x=L.toLowerCase(),e[x]=s[L](),v.push((e[x]?"":"no-")+x));return e.input||K(),e.addTest=function(a,b){if(typeof a=="object")for(var d in a)C(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},D(""),i=k=null,function(a,b){function l(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function m(){var a=s.elements;return typeof a=="string"?a.split(" "):a}function n(a){var b=j[a[h]];return b||(b={},i++,a[h]=i,j[i]=b),b}function o(a,c,d){c||(c=b);if(k)return c.createElement(a);d||(d=n(c));var g;return d.cache[a]?g=d.cache[a].cloneNode():f.test(a)?g=(d.cache[a]=d.createElem(a)).cloneNode():g=d.createElem(a),g.canHaveChildren&&!e.test(a)&&!g.tagUrn?d.frag.appendChild(g):g}function p(a,c){a||(a=b);if(k)return a.createDocumentFragment();c=c||n(a);var d=c.frag.cloneNode(),e=0,f=m(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function q(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return s.shivMethods?o(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(s,b.frag)}function r(a){a||(a=b);var c=n(a);return s.shivCSS&&!g&&!c.hasCSS&&(c.hasCSS=!!l(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),k||q(a,c),a}var c="3.7.0",d=a.html5||{},e=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,f=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g,h="_html5shiv",i=0,j={},k;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",g="hidden"in a,k=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){g=!0,k=!0}})();var s={elements:d.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:c,shivCSS:d.shivCSS!==!1,supportsUnknownElements:k,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:r,createElement:o,createDocumentFragment:p};a.html5=s,r(b)}(this,b),e._version=d,e._prefixes=n,e._domPrefixes=q,e._cssomPrefixes=p,e.mq=z,e.hasEvent=A,e.testProp=function(a){return H([a])},e.testAllProps=J,e.testStyles=y,e.prefixed=function(a,b,c){return b?J(a,b,c):J(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+v.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};

/*
 * zClip :: jQuery ZeroClipboard v1.1.1
 * http://steamdev.com/zclip
 *
 * Copyright 2011, SteamDev
 * Released under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Date: Wed Jun 01, 2011
 */


(function ($) {

    $.fn.zclip = function (params) {

        if (typeof params == "object" && !params.length) {

            var settings = $.extend({

                path: 'ZeroClipboard.swf',
                copy: null,
                beforeCopy: null,
                afterCopy: null,
                clickAfter: true,
                setHandCursor: true,
                setCSSEffects: true

            }, params);
			

            return this.each(function () {

                var o = $(this);

                if (o.is(':visible') && (typeof settings.copy == 'string' || $.isFunction(settings.copy))) {

                    ZeroClipboard.setMoviePath(settings.path);
                    var clip = new ZeroClipboard.Client();
                    
                    if($.isFunction(settings.copy)){
                    	o.bind('zClip_copy',settings.copy);
                    }
                    if($.isFunction(settings.beforeCopy)){
                    	o.bind('zClip_beforeCopy',settings.beforeCopy);
                    }
                    if($.isFunction(settings.afterCopy)){
                    	o.bind('zClip_afterCopy',settings.afterCopy);
                    }                    

                    clip.setHandCursor(settings.setHandCursor);
                    clip.setCSSEffects(settings.setCSSEffects);
                    clip.addEventListener('mouseOver', function (client) {
                        o.trigger('mouseenter');
                    });
                    clip.addEventListener('mouseOut', function (client) {
                        o.trigger('mouseleave');
                    });
                    clip.addEventListener('mouseDown', function (client) {

                        o.trigger('mousedown');
                        
			if(!$.isFunction(settings.copy)){
			   clip.setText(settings.copy);
			} else {
			   clip.setText(o.triggerHandler('zClip_copy'));
			}                        
                        
                        if ($.isFunction(settings.beforeCopy)) {
                            o.trigger('zClip_beforeCopy');                            
                        }

                    });

                    clip.addEventListener('complete', function (client, text) {

                        if ($.isFunction(settings.afterCopy)) {
                            
                            o.trigger('zClip_afterCopy');

                        } else {
                            if (text.length > 500) {
                                text = text.substr(0, 500) + "...\n\n(" + (text.length - 500) + " characters not shown)";
                            }
							
			    o.removeClass('hover');
                            alert("Copied text to clipboard:\n\n " + text);
                        }

                        if (settings.clickAfter) {
                            o.trigger('click');
                        }

                    });

					
                    clip.glue(o[0], o.parent()[0]);
					
		    $(window).bind('load resize',function(){clip.reposition();});
					

                }

            });

        } else if (typeof params == "string") {

            return this.each(function () {

                var o = $(this);

                params = params.toLowerCase();
                var zclipId = o.data('zclipId');
                var clipElm = $('#' + zclipId + '.zclip');

                if (params == "remove") {

                    clipElm.remove();
                    o.removeClass('active hover');

                } else if (params == "hide") {

                    clipElm.hide();
                    o.removeClass('active hover');

                } else if (params == "show") {

                    clipElm.show();

                }

            });

        }

    }	
	
	

})(jQuery);







// ZeroClipboard
// Simple Set Clipboard System
// Author: Joseph Huckaby
var ZeroClipboard = {

    version: "1.0.7",
    clients: {},
    // registered upload clients on page, indexed by id
    moviePath: 'ZeroClipboard.swf',
    // URL to movie
    nextId: 1,
    // ID of next movie
    $: function (thingy) {
        // simple DOM lookup utility function
        if (typeof(thingy) == 'string') thingy = document.getElementById(thingy);
        if (!thingy.addClass) {
            // extend element with a few useful methods
            thingy.hide = function () {
                this.style.display = 'none';
            };
            thingy.show = function () {
                this.style.display = '';
            };
            thingy.addClass = function (name) {
                this.removeClass(name);
                this.className += ' ' + name;
            };
            thingy.removeClass = function (name) {
                var classes = this.className.split(/\s+/);
                var idx = -1;
                for (var k = 0; k < classes.length; k++) {
                    if (classes[k] == name) {
                        idx = k;
                        k = classes.length;
                    }
                }
                if (idx > -1) {
                    classes.splice(idx, 1);
                    this.className = classes.join(' ');
                }
                return this;
            };
            thingy.hasClass = function (name) {
                return !!this.className.match(new RegExp("\\s*" + name + "\\s*"));
            };
        }
        return thingy;
    },

    setMoviePath: function (path) {
        // set path to ZeroClipboard.swf
        this.moviePath = path;
    },

    dispatch: function (id, eventName, args) {
        // receive event from flash movie, send to client		
        var client = this.clients[id];
        if (client) {
            client.receiveEvent(eventName, args);
        }
    },

    register: function (id, client) {
        // register new client to receive events
        this.clients[id] = client;
    },

    getDOMObjectPosition: function (obj, stopObj) {
        // get absolute coordinates for dom element
        var info = {
            left: 0,
            top: 0,
            width: obj.width ? obj.width : obj.offsetWidth,
            height: obj.height ? obj.height : obj.offsetHeight
        };

        if (obj && (obj != stopObj)) {
			info.left += obj.offsetLeft;
            info.top += obj.offsetTop;
        }

        return info;
    },

    Client: function (elem) {
        // constructor for new simple upload client
        this.handlers = {};

        // unique ID
        this.id = ZeroClipboard.nextId++;
        this.movieId = 'ZeroClipboardMovie_' + this.id;

        // register client with singleton to receive flash events
        ZeroClipboard.register(this.id, this);

        // create movie
        if (elem) this.glue(elem);
    }
};

ZeroClipboard.Client.prototype = {

    id: 0,
    // unique ID for us
    ready: false,
    // whether movie is ready to receive events or not
    movie: null,
    // reference to movie object
    clipText: '',
    // text to copy to clipboard
    handCursorEnabled: true,
    // whether to show hand cursor, or default pointer cursor
    cssEffects: true,
    // enable CSS mouse effects on dom container
    handlers: null,
    // user event handlers
    glue: function (elem, appendElem, stylesToAdd) {
        // glue to DOM element
        // elem can be ID or actual DOM element object
        this.domElement = ZeroClipboard.$(elem);

        // float just above object, or zIndex 99 if dom element isn't set
        var zIndex = 99;
        if (this.domElement.style.zIndex) {
            zIndex = parseInt(this.domElement.style.zIndex, 10) + 1;
        }

        if (typeof(appendElem) == 'string') {
            appendElem = ZeroClipboard.$(appendElem);
        } else if (typeof(appendElem) == 'undefined') {
            appendElem = document.getElementsByTagName('body')[0];
        }

        // find X/Y position of domElement
        var box = ZeroClipboard.getDOMObjectPosition(this.domElement, appendElem);

        // create floating DIV above element
        this.div = document.createElement('div');
        this.div.className = "zclip";
        this.div.id = "zclip-" + this.movieId;
        $(this.domElement).data('zclipId', 'zclip-' + this.movieId);
        var style = this.div.style;
        style.position = 'absolute';
        style.left = '' + box.left + 'px';
        style.top = '' + box.top + 'px';
        style.width = '' + box.width + 'px';
        style.height = '' + box.height + 'px';
        style.zIndex = zIndex;

        if (typeof(stylesToAdd) == 'object') {
            for (addedStyle in stylesToAdd) {
                style[addedStyle] = stylesToAdd[addedStyle];
            }
        }

        // style.backgroundColor = '#f00'; // debug
        appendElem.appendChild(this.div);

        this.div.innerHTML = this.getHTML(box.width, box.height);
    },

    getHTML: function (width, height) {
        // return HTML for movie
        var html = '';
        var flashvars = 'id=' + this.id + '&width=' + width + '&height=' + height;

        if (navigator.userAgent.match(/MSIE/)) {
            // IE gets an OBJECT tag
            var protocol = location.href.match(/^https/i) ? 'https://' : 'http://';
            html += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="' + protocol + 'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="' + width + '" height="' + height + '" id="' + this.movieId + '" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="' + ZeroClipboard.moviePath + '" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="' + flashvars + '"/><param name="wmode" value="transparent"/></object>';
        } else {
            // all other browsers get an EMBED tag
            html += '<embed id="' + this.movieId + '" src="' + ZeroClipboard.moviePath + '" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="' + width + '" height="' + height + '" name="' + this.movieId + '" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="' + flashvars + '" wmode="transparent" />';
        }
        return html;
    },

    hide: function () {
        // temporarily hide floater offscreen
        if (this.div) {
            this.div.style.left = '-2000px';
        }
    },

    show: function () {
        // show ourselves after a call to hide()
        this.reposition();
    },

    destroy: function () {
        // destroy control and floater
        if (this.domElement && this.div) {
            this.hide();
            this.div.innerHTML = '';

            var body = document.getElementsByTagName('body')[0];
            try {
                body.removeChild(this.div);
            } catch (e) {;
            }

            this.domElement = null;
            this.div = null;
        }
    },

    reposition: function (elem) {
        // reposition our floating div, optionally to new container
        // warning: container CANNOT change size, only position
        if (elem) {
            this.domElement = ZeroClipboard.$(elem);
            if (!this.domElement) this.hide();
        }

        if (this.domElement && this.div) {
            var box = ZeroClipboard.getDOMObjectPosition(this.domElement);
            var style = this.div.style;
            style.left = '' + box.left + 'px';
            style.top = '' + box.top + 'px';
        }
    },

    setText: function (newText) {
        // set text to be copied to clipboard
        this.clipText = newText;
        if (this.ready) {
            this.movie.setText(newText);
        }
    },

    addEventListener: function (eventName, func) {
        // add user event listener for event
        // event types: load, queueStart, fileStart, fileComplete, queueComplete, progress, error, cancel
        eventName = eventName.toString().toLowerCase().replace(/^on/, '');
        if (!this.handlers[eventName]) {
            this.handlers[eventName] = [];
        }
        this.handlers[eventName].push(func);
    },

    setHandCursor: function (enabled) {
        // enable hand cursor (true), or default arrow cursor (false)
        this.handCursorEnabled = enabled;
        if (this.ready) {
            this.movie.setHandCursor(enabled);
        }
    },

    setCSSEffects: function (enabled) {
        // enable or disable CSS effects on DOM container
        this.cssEffects = !! enabled;
    },

    receiveEvent: function (eventName, args) {
        // receive event from flash
        eventName = eventName.toString().toLowerCase().replace(/^on/, '');

        // special behavior for certain events
        switch (eventName) {
        case 'load':
            // movie claims it is ready, but in IE this isn't always the case...
            // bug fix: Cannot extend EMBED DOM elements in Firefox, must use traditional function
            this.movie = document.getElementById(this.movieId);
            if (!this.movie) {
                var self = this;
                setTimeout(function () {
                    self.receiveEvent('load', null);
                }, 1);
                return;
            }

            // firefox on pc needs a "kick" in order to set these in certain cases
            if (!this.ready && navigator.userAgent.match(/Firefox/) && navigator.userAgent.match(/Windows/)) {
                var self = this;
                setTimeout(function () {
                    self.receiveEvent('load', null);
                }, 100);
                this.ready = true;
                return;
            }

            this.ready = true;
            try {
                this.movie.setText(this.clipText);
            } catch (e) {}
            try {
                this.movie.setHandCursor(this.handCursorEnabled);
            } catch (e) {}
            break;

        case 'mouseover':
            if (this.domElement && this.cssEffects) {
                this.domElement.addClass('hover');
                if (this.recoverActive) {
                    this.domElement.addClass('active');
                }


            }


            break;

        case 'mouseout':
            if (this.domElement && this.cssEffects) {
                this.recoverActive = false;
                if (this.domElement.hasClass('active')) {
                    this.domElement.removeClass('active');
                    this.recoverActive = true;
                }
                this.domElement.removeClass('hover');

            }
            break;

        case 'mousedown':
            if (this.domElement && this.cssEffects) {
                this.domElement.addClass('active');
            }
            break;

        case 'mouseup':
            if (this.domElement && this.cssEffects) {
                this.domElement.removeClass('active');
                this.recoverActive = false;
            }
            break;
        } // switch eventName
        if (this.handlers[eventName]) {
            for (var idx = 0, len = this.handlers[eventName].length; idx < len; idx++) {
                var func = this.handlers[eventName][idx];

                if (typeof(func) == 'function') {
                    // actual function reference
                    func(this, args);
                } else if ((typeof(func) == 'object') && (func.length == 2)) {
                    // PHP style object + method, i.e. [myObject, 'myMethod']
                    func[0][func[1]](this, args);
                } else if (typeof(func) == 'string') {
                    // name of function
                    window[func](this, args);
                }
            } // foreach event handler defined
        } // user defined handler for event
    }

};	


(function($) {
	var has_VML, has_canvas, create_canvas_for, add_shape_to, clear_canvas, shape_from_area,
		canvas_style, hex_to_decimal, css3color, is_image_loaded, options_from_area;

	has_canvas = !!document.createElement('canvas').getContext;

	// VML: more complex
	has_VML = (function() {
		var a = document.createElement('div');
		a.innerHTML = '<v:shape id="vml_flag1" adj="1" />';
		var b = a.firstChild;
		b.style.behavior = "url(#default#VML)";
		return b ? typeof b.adj == "object": true;
	})();

	if(!(has_canvas || has_VML)) {
		$.fn.maphilight = function() { return this; };
		return;
	}
	
	if(has_canvas) {
		hex_to_decimal = function(hex) {
			return Math.max(0, Math.min(parseInt(hex, 16), 255));
		};
		css3color = function(color, opacity) {
			return 'rgba('+hex_to_decimal(color.substr(0,2))+','+hex_to_decimal(color.substr(2,2))+','+hex_to_decimal(color.substr(4,2))+','+opacity+')';
		};
		create_canvas_for = function(img) {
			var c = $('<canvas style="width:'+$(img).width()+'px;height:'+$(img).height()+'px;"></canvas>').get(0);
			c.getContext("2d").clearRect(0, 0, $(img).width(), $(img).height());
			return c;
		};
		var draw_shape = function(context, shape, coords, x_shift, y_shift) {
			x_shift = x_shift || 0;
			y_shift = y_shift || 0;
			
			context.beginPath();
			if(shape == 'rect') {
				// x, y, width, height
				context.rect(coords[0] + x_shift, coords[1] + y_shift, coords[2] - coords[0], coords[3] - coords[1]);
			} else if(shape == 'poly') {
				context.moveTo(coords[0] + x_shift, coords[1] + y_shift);
				for(i=2; i < coords.length; i+=2) {
					context.lineTo(coords[i] + x_shift, coords[i+1] + y_shift);
				}
			} else if(shape == 'circ') {
				// x, y, radius, startAngle, endAngle, anticlockwise
				context.arc(coords[0] + x_shift, coords[1] + y_shift, coords[2], 0, Math.PI * 2, false);
			}
			context.closePath();
		};
		add_shape_to = function(canvas, shape, coords, options, name) {
			var i, context = canvas.getContext('2d');
			
			// Because I don't want to worry about setting things back to a base state
			
			// Shadow has to happen first, since it's on the bottom, and it does some clip /
			// fill operations which would interfere with what comes next.
			if(options.shadow) {
				context.save();
				if(options.shadowPosition == "inside") {
					// Cause the following stroke to only apply to the inside of the path
					draw_shape(context, shape, coords);
					context.clip();
				}
				
				// Redraw the shape shifted off the canvas massively so we can cast a shadow
				// onto the canvas without having to worry about the stroke or fill (which
				// cannot have 0 opacity or width, since they're what cast the shadow).
				var x_shift = canvas.width * 100;
				var y_shift = canvas.height * 100;
				draw_shape(context, shape, coords, x_shift, y_shift);
				
				context.shadowOffsetX = options.shadowX - x_shift;
				context.shadowOffsetY = options.shadowY - y_shift;
				context.shadowBlur = options.shadowRadius;
				context.shadowColor = css3color(options.shadowColor, options.shadowOpacity);
				
				// Now, work out where to cast the shadow from! It looks better if it's cast
				// from a fill when it's an outside shadow or a stroke when it's an interior
				// shadow. Allow the user to override this if they need to.
				var shadowFrom = options.shadowFrom;
				if (!shadowFrom) {
					if (options.shadowPosition == 'outside') {
						shadowFrom = 'fill';
					} else {
						shadowFrom = 'stroke';
					}
				}
				if (shadowFrom == 'stroke') {
					context.strokeStyle = "rgba(0,0,0,1)";
					context.stroke();
				} else if (shadowFrom == 'fill') {
					context.fillStyle = "rgba(0,0,0,1)";
					context.fill();
				}
				context.restore();
				
				// and now we clean up
				if(options.shadowPosition == "outside") {
					context.save();
					// Clear out the center
					draw_shape(context, shape, coords);
					context.globalCompositeOperation = "destination-out";
					context.fillStyle = "rgba(0,0,0,1);";
					context.fill();
					context.restore();
				}
			}
			
			context.save();
			
			draw_shape(context, shape, coords);
			
			// fill has to come after shadow, otherwise the shadow will be drawn over the fill,
			// which mostly looks weird when the shadow has a high opacity
			if(options.fill) {
				context.fillStyle = css3color(options.fillColor, options.fillOpacity);
				context.fill();
			}
			// Likewise, stroke has to come at the very end, or it'll wind up under bits of the
			// shadow or the shadow-background if it's present.
			if(options.stroke) {
				context.strokeStyle = css3color(options.strokeColor, options.strokeOpacity);
				context.lineWidth = options.strokeWidth;
				context.stroke();
			}
			
			context.restore();
			
			if(options.fade) {
				$(canvas).css('opacity', 0).animate({opacity: 1}, 100);
			}
		};
		clear_canvas = function(canvas) {
			canvas.getContext('2d').clearRect(0, 0, canvas.width,canvas.height);
		};
	} else {   // ie executes this code
		create_canvas_for = function(img) {
			return $('<var style="zoom:1;overflow:hidden;display:block;width:'+img.width+'px;height:'+img.height+'px;"></var>').get(0);
		};
		add_shape_to = function(canvas, shape, coords, options, name) {
			var fill, stroke, opacity, e;
			for (var i in coords) { coords[i] = parseInt(coords[i], 10); }
			fill = '<v:fill color="#'+options.fillColor+'" opacity="'+(options.fill ? options.fillOpacity : 0)+'" />';
			stroke = (options.stroke ? 'strokeweight="'+options.strokeWidth+'" stroked="t" strokecolor="#'+options.strokeColor+'"' : 'stroked="f"');
			opacity = '<v:stroke opacity="'+options.strokeOpacity+'"/>';
			if(shape == 'rect') {
				e = $('<v:rect name="'+name+'" filled="t" '+stroke+' style="zoom:1;margin:0;padding:0;display:block;position:absolute;left:'+coords[0]+'px;top:'+coords[1]+'px;width:'+(coords[2] - coords[0])+'px;height:'+(coords[3] - coords[1])+'px;"></v:rect>');
			} else if(shape == 'poly') {
				e = $('<v:shape name="'+name+'" filled="t" '+stroke+' coordorigin="0,0" coordsize="'+canvas.width+','+canvas.height+'" path="m '+coords[0]+','+coords[1]+' l '+coords.join(',')+' x e" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:0px;left:0px;width:'+canvas.width+'px;height:'+canvas.height+'px;"></v:shape>');
			} else if(shape == 'circ') {
				e = $('<v:oval name="'+name+'" filled="t" '+stroke+' style="zoom:1;margin:0;padding:0;display:block;position:absolute;left:'+(coords[0] - coords[2])+'px;top:'+(coords[1] - coords[2])+'px;width:'+(coords[2]*2)+'px;height:'+(coords[2]*2)+'px;"></v:oval>');
			}
			e.get(0).innerHTML = fill+opacity;
			$(canvas).append(e);
		};
		clear_canvas = function(canvas) {
			// jquery1.8 + ie7 
			var $html = $("<div>" + canvas.innerHTML + "</div>");
			$html.children('[name=highlighted]').remove();
			canvas.innerHTML = $html.html();
		};
	}
	
	shape_from_area = function(area) {
		var i, coords = area.getAttribute('coords').split(',');
		for (i=0; i < coords.length; i++) { coords[i] = parseFloat(coords[i]); }
		return [area.getAttribute('shape').toLowerCase().substr(0,4), coords];
	};

	options_from_area = function(area, options) {
		var $area = $(area);
		return $.extend({}, options, $.metadata ? $area.metadata() : false, $area.data('maphilight'));
	};
	
	is_image_loaded = function(img) {
		if(!img.complete) { return false; } // IE
		if(typeof img.naturalWidth != "undefined" && img.naturalWidth === 0) { return false; } // Others
		return true;
	};

	canvas_style = {
		position: 'absolute',
		left: 0,
		top: 0,
		padding: 0,
		border: 0
	};
	
	var ie_hax_done = false;
	$.fn.maphilight = function(opts) {
		opts = $.extend({}, $.fn.maphilight.defaults, opts);
		
		if(!has_canvas && !ie_hax_done) {
			$(window).ready(function() {
				document.namespaces.add("v", "urn:schemas-microsoft-com:vml");
				var style = document.createStyleSheet();
				var shapes = ['shape','rect', 'oval', 'circ', 'fill', 'stroke', 'imagedata', 'group','textbox'];
				$.each(shapes,
					function() {
						style.addRule('v\\:' + this, "behavior: url(#default#VML); antialias:true");
					}
				);
			});
			ie_hax_done = true;
		}
		
		return this.each(function() {
			var img, wrap, options, map, canvas, canvas_always, highlighted_shape, usemap;
			img = $(this);

			if(!is_image_loaded(this)) {
				// If the image isn't fully loaded, this won't work right.  Try again later.
				return window.setTimeout(function() {
					img.maphilight(opts);
				}, 200);
			}

			options = $.extend({}, opts, $.metadata ? img.metadata() : false, img.data('maphilight'));

			// jQuery bug with Opera, results in full-url#usemap being returned from jQuery's attr.
			// So use raw getAttribute instead.
			usemap = img.get(0).getAttribute('usemap');

			if (!usemap) {
				return;
			}

			map = $('map[name="'+usemap.substr(1)+'"]');

			if(!(img.is('img,input[type="image"]') && usemap && map.size() > 0)) {
				return;
			}

			if(img.hasClass('maphilighted')) {
				// We're redrawing an old map, probably to pick up changes to the options.
				// Just clear out all the old stuff.
				var wrapper = img.parent();
				img.insertBefore(wrapper);
				wrapper.remove();
				$(map).unbind('.maphilight');
			}

			wrap = $('<div></div>').css({
				display:'block',
				backgroundImage:'url("'+this.src+'")',
				backgroundSize:'contain',
				position:'relative',
				padding:0,
				width:this.width,
				height:this.height
				});
			if(options.wrapClass) {
				if(options.wrapClass === true) {
					wrap.addClass($(this).attr('class'));
				} else {
					wrap.addClass(options.wrapClass);
				}
			}
			img.before(wrap).css('opacity', 0).css(canvas_style).remove();
			if(has_VML) { img.css('filter', 'Alpha(opacity=0)'); }
			wrap.append(img);
			
			canvas = create_canvas_for(this);
			$(canvas).css(canvas_style);
			canvas.height = this.height;
			canvas.width = this.width;
			
			$(map).bind('alwaysOn.maphilight', function() {
				// Check for areas with alwaysOn set. These are added to a *second* canvas,
				// which will get around flickering during fading.
				if(canvas_always) {
					clear_canvas(canvas_always);
				}
				if(!has_canvas) {
					$(canvas).empty();
				}
				$(map).find('area[coords]').each(function() {
					var shape, area_options;
					area_options = options_from_area(this, options);
					if(area_options.alwaysOn) {
						if(!canvas_always && has_canvas) {
							canvas_always = create_canvas_for(img[0]);
							$(canvas_always).css(canvas_style);
							canvas_always.width = img[0].width;
							canvas_always.height = img[0].height;
							img.before(canvas_always);
						}
						area_options.fade = area_options.alwaysOnFade; // alwaysOn shouldn't fade in initially
						shape = shape_from_area(this);
						if (has_canvas) {
							add_shape_to(canvas_always, shape[0], shape[1], area_options, "");
						} else {
							add_shape_to(canvas, shape[0], shape[1], area_options, "");
						}
					}
				});
			}).trigger('alwaysOn.maphilight')
			.bind('mouseover.maphilight, focus.maphilight', function(e) {
				var shape, area_options, area = e.target;
				area_options = options_from_area(area, options);
				if(!area_options.neverOn && !area_options.alwaysOn) {
					shape = shape_from_area(area);
					add_shape_to(canvas, shape[0], shape[1], area_options, "highlighted");
					if(area_options.groupBy) {
						var areas;
						// two ways groupBy might work; attribute and selector
						if(/^[a-zA-Z][\-a-zA-Z]+$/.test(area_options.groupBy)) {
							areas = map.find('area['+area_options.groupBy+'="'+$(area).attr(area_options.groupBy)+'"]');
						} else {
							areas = map.find(area_options.groupBy);
						}
						var first = area;
						areas.each(function() {
							if(this != first) {
								var subarea_options = options_from_area(this, options);
								if(!subarea_options.neverOn && !subarea_options.alwaysOn) {
									var shape = shape_from_area(this);
									add_shape_to(canvas, shape[0], shape[1], subarea_options, "highlighted");
								}
							}
						});
					}
					// workaround for IE7, IE8 not rendering the final rectangle in a group
					if(!has_canvas) {
						$(canvas).append('<v:rect></v:rect>');
					}
				}
			}).bind('mouseout.maphilight, blur.maphilight', function(e) { clear_canvas(canvas); });
			
			img.before(canvas); // if we put this after, the mouseover events wouldn't fire.
			
			img.addClass('maphilighted');
		});
	};
	$.fn.maphilight.defaults = {
		fill: true,
		fillColor: '000000',
		fillOpacity: 0.2,
		stroke: true,
		strokeColor: 'ff0000',
		strokeOpacity: 1,
		strokeWidth: 1,
		fade: true,
		alwaysOn: false,
		neverOn: false,
		groupBy: false,
		wrapClass: true,
		// plenty of shadow:
		shadow: false,
		shadowX: 0,
		shadowY: 0,
		shadowRadius: 6,
		shadowColor: '000000',
		shadowOpacity: 0.8,
		shadowPosition: 'outside',
		shadowFrom: false
	};
})(jQuery);

/*!
 * The Final Countdown for jQuery v2.0.3 (http://hilios.github.io/jQuery.countdown/)
 * Copyright (c) 2014 Edson Hilios
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], factory);
    } else {
        factory(jQuery);
    }
})(function($) {
    "use strict";
    var PRECISION = 100;
    var instances = [], matchers = [];
    matchers.push(/^[0-9]*$/.source);
    matchers.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    matchers.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    matchers = new RegExp(matchers.join("|"));
    function parseDateString(dateString) {
        if (dateString instanceof Date) {
            return dateString;
        }
        if (String(dateString).match(matchers)) {
            if (String(dateString).match(/^[0-9]*$/)) {
                dateString = Number(dateString);
            }
            if (String(dateString).match(/\-/)) {
                dateString = String(dateString).replace(/\-/g, "http://demo.shnayder.pro/");
            }
            return new Date(dateString);
        } else {
            throw new Error("Couldn't cast `" + dateString + "` to a date object.");
        }
    }
    var DIRECTIVE_KEY_MAP = {
        Y: "years",
        m: "months",
        w: "weeks",
        d: "days",
        D: "totalDays",
        H: "hours",
        M: "minutes",
        S: "seconds"
    };
    function strftime(offsetObject) {
        return function(format) {
            var directives = format.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
            if (directives) {
                for (var i = 0, len = directives.length; i < len; ++i) {
                    var directive = directives[i].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/), regexp = new RegExp(directive[0]), modifier = directive[1] || "", plural = directive[3] || "", value = null;
                    directive = directive[2];
                    if (DIRECTIVE_KEY_MAP.hasOwnProperty(directive)) {
                        value = DIRECTIVE_KEY_MAP[directive];
                        value = Number(offsetObject[value]);
                    }
                    if (value !== null) {
                        if (modifier === "!") {
                            value = pluralize(plural, value);
                        }
                        if (modifier === "") {
                            if (value < 10) {
                                value = "0" + value.toString();
                            }
                        }
                        format = format.replace(regexp, value.toString());
                    }
                }
            }
            format = format.replace(/%%/, "%");
            return format;
        };
    }
    function pluralize(format, count) {
        var plural = "s", singular = "";
        if (format) {
            format = format.replace(/(:|;|\s)/gi, "").split(/\,/);
            if (format.length === 1) {
                plural = format[0];
            } else {
                singular = format[0];
                plural = format[1];
            }
        }
        if (Math.abs(count) === 1) {
            return singular;
        } else {
            return plural;
        }
    }
    var Countdown = function(el, finalDate, callback) {
        this.el = el;
        this.$el = $(el);
        this.interval = null;
        this.offset = {};
        this.instanceNumber = instances.length;
        instances.push(this);
        this.$el.data("countdown-instance", this.instanceNumber);
        if (callback) {
            this.$el.on("update.countdown", callback);
            this.$el.on("stoped.countdown", callback);
            this.$el.on("finish.countdown", callback);
        }
        this.setFinalDate(finalDate);
        this.start();
    };
    $.extend(Countdown.prototype, {
        start: function() {
            if (this.interval !== null) {
                clearInterval(this.interval);
            }
            var self = this;
            this.update();
            this.interval = setInterval(function() {
                self.update.call(self);
            }, PRECISION);
        },
        stop: function() {
            clearInterval(this.interval);
            this.interval = null;
            this.dispatchEvent("stoped");
        },
        pause: function() {
            this.stop.call(this);
        },
        resume: function() {
            this.start.call(this);
        },
        remove: function() {
            this.stop();
            instances[this.instanceNumber] = null;
            delete this.$el.data().countdownInstance;
        },
        setFinalDate: function(value) {
            this.finalDate = parseDateString(value);
        },
        update: function() {
            if (this.$el.closest("html").length === 0) {
                this.remove();
                return;
            }
            this.totalSecsLeft = this.finalDate.getTime() - new Date().getTime();
            this.totalSecsLeft = Math.ceil(this.totalSecsLeft / 1e3);
            this.totalSecsLeft = this.totalSecsLeft < 0 ? 0 : this.totalSecsLeft;
            this.offset = {
                seconds: this.totalSecsLeft % 60,
                minutes: Math.floor(this.totalSecsLeft / 60) % 60,
                hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
                days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
                weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
                months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30),
                years: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 365)
            };
            if (this.totalSecsLeft === 0) {
                this.stop();
                this.dispatchEvent("finish");
            } else {
                this.dispatchEvent("update");
            }
        },
        dispatchEvent: function(eventName) {
            var event = $.Event(eventName + ".countdown");
            event.finalDate = this.finalDate;
            event.offset = $.extend({}, this.offset);
            event.strftime = strftime(this.offset);
            this.$el.trigger(event);
        }
    });
    $.fn.countdown = function() {
        var argumentsArray = Array.prototype.slice.call(arguments, 0);
        return this.each(function() {
            var instanceNumber = $(this).data("countdown-instance");
            if (instanceNumber !== undefined) {
                var instance = instances[instanceNumber], method = argumentsArray[0];
                if (Countdown.prototype.hasOwnProperty(method)) {
                    instance[method].apply(instance, argumentsArray.slice(1));
                } else if (String(method).match(/^[$A-Z_][0-9A-Z_$]*$/i) === null) {
                    instance.setFinalDate.call(instance, method);
                    instance.start();
                } else {
                    $.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, method));
                }
            } else {
                new Countdown(this, argumentsArray[0], argumentsArray[1]);
            }
        });
    };
});
/* Placeholders.js v3.0.2 */
(function(t){"use strict";function e(t,e,r){return t.addEventListener?t.addEventListener(e,r,!1):t.attachEvent?t.attachEvent("on"+e,r):void 0}function r(t,e){var r,n;for(r=0,n=t.length;n>r;r++)if(t[r]===e)return!0;return!1}function n(t,e){var r;t.createTextRange?(r=t.createTextRange(),r.move("character",e),r.select()):t.selectionStart&&(t.focus(),t.setSelectionRange(e,e))}function a(t,e){try{return t.type=e,!0}catch(r){return!1}}t.Placeholders={Utils:{addEventListener:e,inArray:r,moveCaret:n,changeType:a}}})(this),function(t){"use strict";function e(){}function r(){try{return document.activeElement}catch(t){}}function n(t,e){var r,n,a=!!e&&t.value!==e,u=t.value===t.getAttribute(V);return(a||u)&&"true"===t.getAttribute(D)?(t.removeAttribute(D),t.value=t.value.replace(t.getAttribute(V),""),t.className=t.className.replace(R,""),n=t.getAttribute(F),parseInt(n,10)>=0&&(t.setAttribute("maxLength",n),t.removeAttribute(F)),r=t.getAttribute(P),r&&(t.type=r),!0):!1}function a(t){var e,r,n=t.getAttribute(V);return""===t.value&&n?(t.setAttribute(D,"true"),t.value=n,t.className+=" "+I,r=t.getAttribute(F),r||(t.setAttribute(F,t.maxLength),t.removeAttribute("maxLength")),e=t.getAttribute(P),e?t.type="text":"password"===t.type&&M.changeType(t,"text")&&t.setAttribute(P,"password"),!0):!1}function u(t,e){var r,n,a,u,i,l,o;if(t&&t.getAttribute(V))e(t);else for(a=t?t.getElementsByTagName("input"):b,u=t?t.getElementsByTagName("textarea"):f,r=a?a.length:0,n=u?u.length:0,o=0,l=r+n;l>o;o++)i=r>o?a[o]:u[o-r],e(i)}function i(t){u(t,n)}function l(t){u(t,a)}function o(t){return function(){m&&t.value===t.getAttribute(V)&&"true"===t.getAttribute(D)?M.moveCaret(t,0):n(t)}}function c(t){return function(){a(t)}}function s(t){return function(e){return A=t.value,"true"===t.getAttribute(D)&&A===t.getAttribute(V)&&M.inArray(C,e.keyCode)?(e.preventDefault&&e.preventDefault(),!1):void 0}}function d(t){return function(){n(t,A),""===t.value&&(t.blur(),M.moveCaret(t,0))}}function g(t){return function(){t===r()&&t.value===t.getAttribute(V)&&"true"===t.getAttribute(D)&&M.moveCaret(t,0)}}function v(t){return function(){i(t)}}function p(t){t.form&&(T=t.form,"string"==typeof T&&(T=document.getElementById(T)),T.getAttribute(U)||(M.addEventListener(T,"submit",v(T)),T.setAttribute(U,"true"))),M.addEventListener(t,"focus",o(t)),M.addEventListener(t,"blur",c(t)),m&&(M.addEventListener(t,"keydown",s(t)),M.addEventListener(t,"keyup",d(t)),M.addEventListener(t,"click",g(t))),t.setAttribute(j,"true"),t.setAttribute(V,x),(m||t!==r())&&a(t)}var b,f,m,h,A,y,E,x,L,T,N,S,w,B=["text","search","url","tel","email","password","number","textarea"],C=[27,33,34,35,36,37,38,39,40,8,46],k="#ccc",I="placeholdersjs",R=RegExp("(?:^|\\s)"+I+"(?!\\S)"),V="data-placeholder-value",D="data-placeholder-active",P="data-placeholder-type",U="data-placeholder-submit",j="data-placeholder-bound",q="data-placeholder-focus",z="data-placeholder-live",F="data-placeholder-maxlength",G=document.createElement("input"),H=document.getElementsByTagName("head")[0],J=document.documentElement,K=t.Placeholders,M=K.Utils;if(K.nativeSupport=void 0!==G.placeholder,!K.nativeSupport){for(b=document.getElementsByTagName("input"),f=document.getElementsByTagName("textarea"),m="false"===J.getAttribute(q),h="false"!==J.getAttribute(z),y=document.createElement("style"),y.type="text/css",E=document.createTextNode("."+I+" { color:"+k+"; }"),y.styleSheet?y.styleSheet.cssText=E.nodeValue:y.appendChild(E),H.insertBefore(y,H.firstChild),w=0,S=b.length+f.length;S>w;w++)N=b.length>w?b[w]:f[w-b.length],x=N.attributes.placeholder,x&&(x=x.nodeValue,x&&M.inArray(B,N.type)&&p(N));L=setInterval(function(){for(w=0,S=b.length+f.length;S>w;w++)N=b.length>w?b[w]:f[w-b.length],x=N.attributes.placeholder,x?(x=x.nodeValue,x&&M.inArray(B,N.type)&&(N.getAttribute(j)||p(N),(x!==N.getAttribute(V)||"password"===N.type&&!N.getAttribute(P))&&("password"===N.type&&!N.getAttribute(P)&&M.changeType(N,"text")&&N.setAttribute(P,"password"),N.value===N.getAttribute(V)&&(N.value=x),N.setAttribute(V,x)))):N.getAttribute(D)&&(n(N),N.removeAttribute(V));h||clearInterval(L)},100)}M.addEventListener(t,"beforeunload",function(){K.disable()}),K.disable=K.nativeSupport?e:i,K.enable=K.nativeSupport?e:l}(this);
//============================================================
//
// Flat Surface Shader
//
// Copyright (C) 2013 Matthew Wagerfield
//
// Twitter: https://twitter.com/mwagerfield
//
// Permission is hereby granted, free of charge, to any
// person obtaining a copy of this software and associated
// documentation files (the "Software"), to deal in the
// Software without restriction, including without limitation
// the rights to use, copy, modify, merge, publish, distribute,
// sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do
// so, subject to the following conditions:
//
// The above copyright notice and this permission notice
// shall be included in all copies or substantial portions
// of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
// OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
// LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
// FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO
// EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE
// FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
// AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE
// OR OTHER DEALINGS IN THE SOFTWARE.
//
//============================================================

function initPlugin() {
  FSS={FRONT:0,BACK:1,DOUBLE:2,SVGNS:"http://www.w3.org/2000/svg"},FSS.Array="function"==typeof Float32Array?Float32Array:Array,FSS.Utils={isNumber:function(t){return!isNaN(parseFloat(t))&&isFinite(t)}},function(){for(var t=0,e=["ms","moz","webkit","o"],i=0;e.length>i&&!window.requestAnimationFrame;++i)window.requestAnimationFrame=window[e[i]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[e[i]+"CancelAnimationFrame"]||window[e[i]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(e){var i=(new Date).getTime(),r=Math.max(0,16-(i-t)),s=window.setTimeout(function(){e(i+r)},r);return t=i+r,s}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(t){clearTimeout(t)})}(),Math.PIM2=2*Math.PI,Math.PID2=Math.PI/2,Math.randomInRange=function(t,e){return t+(e-t)*Math.random()},Math.clamp=function(t,e,i){return t=Math.max(t,e),t=Math.min(t,i)},FSS.Vector3={create:function(t,e,i){var r=new FSS.Array(3);return this.set(r,t,e,i),r},clone:function(t){var e=this.create();return this.copy(e,t),e},set:function(t,e,i,r){return t[0]=e||0,t[1]=i||0,t[2]=r||0,this},setX:function(t,e){return t[0]=e||0,this},setY:function(t,e){return t[1]=e||0,this},setZ:function(t,e){return t[2]=e||0,this},copy:function(t,e){return t[0]=e[0],t[1]=e[1],t[2]=e[2],this},add:function(t,e){return t[0]+=e[0],t[1]+=e[1],t[2]+=e[2],this},addVectors:function(t,e,i){return t[0]=e[0]+i[0],t[1]=e[1]+i[1],t[2]=e[2]+i[2],this},addScalar:function(t,e){return t[0]+=e,t[1]+=e,t[2]+=e,this},subtract:function(t,e){return t[0]-=e[0],t[1]-=e[1],t[2]-=e[2],this},subtractVectors:function(t,e,i){return t[0]=e[0]-i[0],t[1]=e[1]-i[1],t[2]=e[2]-i[2],this},subtractScalar:function(t,e){return t[0]-=e,t[1]-=e,t[2]-=e,this},multiply:function(t,e){return t[0]*=e[0],t[1]*=e[1],t[2]*=e[2],this},multiplyVectors:function(t,e,i){return t[0]=e[0]*i[0],t[1]=e[1]*i[1],t[2]=e[2]*i[2],this},multiplyScalar:function(t,e){return t[0]*=e,t[1]*=e,t[2]*=e,this},divide:function(t,e){return t[0]/=e[0],t[1]/=e[1],t[2]/=e[2],this},divideVectors:function(t,e,i){return t[0]=e[0]/i[0],t[1]=e[1]/i[1],t[2]=e[2]/i[2],this},divideScalar:function(t,e){return 0!==e?(t[0]/=e,t[1]/=e,t[2]/=e):(t[0]=0,t[1]=0,t[2]=0),this},cross:function(t,e){var i=t[0],r=t[1],s=t[2];return t[0]=r*e[2]-s*e[1],t[1]=s*e[0]-i*e[2],t[2]=i*e[1]-r*e[0],this},crossVectors:function(t,e,i){return t[0]=e[1]*i[2]-e[2]*i[1],t[1]=e[2]*i[0]-e[0]*i[2],t[2]=e[0]*i[1]-e[1]*i[0],this},min:function(t,e){return e>t[0]&&(t[0]=e),e>t[1]&&(t[1]=e),e>t[2]&&(t[2]=e),this},max:function(t,e){return t[0]>e&&(t[0]=e),t[1]>e&&(t[1]=e),t[2]>e&&(t[2]=e),this},clamp:function(t,e,i){return this.min(t,e),this.max(t,i),this},limit:function(t,e,i){var r=this.length(t);return null!==e&&e>r?this.setLength(t,e):null!==i&&r>i&&this.setLength(t,i),this},dot:function(t,e){return t[0]*e[0]+t[1]*e[1]+t[2]*e[2]},normalise:function(t){return this.divideScalar(t,this.length(t))},negate:function(t){return this.multiplyScalar(t,-1)},distanceSquared:function(t,e){var i=t[0]-e[0],r=t[1]-e[1],s=t[2]-e[2];return i*i+r*r+s*s},distance:function(t,e){return Math.sqrt(this.distanceSquared(t,e))},lengthSquared:function(t){return t[0]*t[0]+t[1]*t[1]+t[2]*t[2]},length:function(t){return Math.sqrt(this.lengthSquared(t))},setLength:function(t,e){var i=this.length(t);return 0!==i&&e!==i&&this.multiplyScalar(t,e/i),this}},FSS.Vector4={create:function(t,e,i){var r=new FSS.Array(4);return this.set(r,t,e,i),r},set:function(t,e,i,r,s){return t[0]=e||0,t[1]=i||0,t[2]=r||0,t[3]=s||0,this},setX:function(t,e){return t[0]=e||0,this},setY:function(t,e){return t[1]=e||0,this},setZ:function(t,e){return t[2]=e||0,this},setW:function(t,e){return t[3]=e||0,this},add:function(t,e){return t[0]+=e[0],t[1]+=e[1],t[2]+=e[2],t[3]+=e[3],this},multiplyVectors:function(t,e,i){return t[0]=e[0]*i[0],t[1]=e[1]*i[1],t[2]=e[2]*i[2],t[3]=e[3]*i[3],this},multiplyScalar:function(t,e){return t[0]*=e,t[1]*=e,t[2]*=e,t[3]*=e,this},min:function(t,e){return e>t[0]&&(t[0]=e),e>t[1]&&(t[1]=e),e>t[2]&&(t[2]=e),e>t[3]&&(t[3]=e),this},max:function(t,e){return t[0]>e&&(t[0]=e),t[1]>e&&(t[1]=e),t[2]>e&&(t[2]=e),t[3]>e&&(t[3]=e),this},clamp:function(t,e,i){return this.min(t,e),this.max(t,i),this}},FSS.Color=function(t,e){this.rgba=FSS.Vector4.create(),this.hex=t||"#000000",this.opacity=FSS.Utils.isNumber(e)?e:1,this.set(this.hex,this.opacity)},FSS.Color.prototype={set:function(t,e){t=t.replace("#","");var i=t.length/3;return this.rgba[0]=parseInt(t.substring(0*i,1*i),16)/255,this.rgba[1]=parseInt(t.substring(1*i,2*i),16)/255,this.rgba[2]=parseInt(t.substring(2*i,3*i),16)/255,this.rgba[3]=FSS.Utils.isNumber(e)?e:this.rgba[3],this},hexify:function(t){var e=Math.ceil(255*t).toString(16);return 1===e.length&&(e="0"+e),e},format:function(){var t=this.hexify(this.rgba[0]),e=this.hexify(this.rgba[1]),i=this.hexify(this.rgba[2]);return this.hex="#"+t+e+i,this.hex}},FSS.Object=function(){this.position=FSS.Vector3.create()},FSS.Object.prototype={setPosition:function(t,e,i){return FSS.Vector3.set(this.position,t,e,i),this}},FSS.Light=function(t,e){FSS.Object.call(this),this.ambient=new FSS.Color(t||"#FFFFFF"),this.diffuse=new FSS.Color(e||"#FFFFFF"),this.ray=FSS.Vector3.create()},FSS.Light.prototype=Object.create(FSS.Object.prototype),FSS.Vertex=function(t,e,i){this.position=FSS.Vector3.create(t,e,i)},FSS.Vertex.prototype={setPosition:function(t,e,i){return FSS.Vector3.set(this.position,t,e,i),this}},FSS.Triangle=function(t,e,i){this.a=t||new FSS.Vertex,this.b=e||new FSS.Vertex,this.c=i||new FSS.Vertex,this.vertices=[this.a,this.b,this.c],this.u=FSS.Vector3.create(),this.v=FSS.Vector3.create(),this.centroid=FSS.Vector3.create(),this.normal=FSS.Vector3.create(),this.color=new FSS.Color,this.polygon=document.createElementNS(FSS.SVGNS,"polygon"),this.polygon.setAttributeNS(null,"stroke-linejoin","round"),this.polygon.setAttributeNS(null,"stroke-miterlimit","1"),this.polygon.setAttributeNS(null,"stroke-width","1"),this.computeCentroid(),this.computeNormal()},FSS.Triangle.prototype={computeCentroid:function(){return this.centroid[0]=this.a.position[0]+this.b.position[0]+this.c.position[0],this.centroid[1]=this.a.position[1]+this.b.position[1]+this.c.position[1],this.centroid[2]=this.a.position[2]+this.b.position[2]+this.c.position[2],FSS.Vector3.divideScalar(this.centroid,3),this},computeNormal:function(){return FSS.Vector3.subtractVectors(this.u,this.b.position,this.a.position),FSS.Vector3.subtractVectors(this.v,this.c.position,this.a.position),FSS.Vector3.crossVectors(this.normal,this.u,this.v),FSS.Vector3.normalise(this.normal),this}},FSS.Geometry=function(){this.vertices=[],this.triangles=[],this.dirty=!1},FSS.Geometry.prototype={update:function(){if(this.dirty){var t,e;for(t=this.triangles.length-1;t>=0;t--)e=this.triangles[t],e.computeCentroid(),e.computeNormal();this.dirty=!1}return this}},FSS.Plane=function(t,e,i,r){FSS.Geometry.call(this),this.width=t||100,this.height=e||100,this.segments=i||4,this.slices=r||4,this.segmentWidth=this.width/this.segments,this.sliceHeight=this.height/this.slices;var s,n,o,h,a,l,u,c=[],S=this.width*-.5,f=.5*this.height;for(s=0;this.segments>=s;s++)for(c.push([]),n=0;this.slices>=n;n++)u=new FSS.Vertex(S+s*this.segmentWidth,f-n*this.sliceHeight),c[s].push(u),this.vertices.push(u);for(s=0;this.segments>s;s++)for(n=0;this.slices>n;n++)o=c[s+0][n+0],h=c[s+0][n+1],a=c[s+1][n+0],l=c[s+1][n+1],t0=new FSS.Triangle(o,h,a),t1=new FSS.Triangle(a,h,l),this.triangles.push(t0,t1)},FSS.Plane.prototype=Object.create(FSS.Geometry.prototype),FSS.Material=function(t,e){this.ambient=new FSS.Color(t||"#444444"),this.diffuse=new FSS.Color(e||"#FFFFFF"),this.slave=new FSS.Color},FSS.Mesh=function(t,e){FSS.Object.call(this),this.geometry=t||new FSS.Geometry,this.material=e||new FSS.Material,this.side=FSS.FRONT,this.visible=!0},FSS.Mesh.prototype=Object.create(FSS.Object.prototype),FSS.Mesh.prototype.update=function(t,e){var i,r,s,n,o;if(this.geometry.update(),e)for(i=this.geometry.triangles.length-1;i>=0;i--){for(r=this.geometry.triangles[i],FSS.Vector4.set(r.color.rgba),s=t.length-1;s>=0;s--)n=t[s],FSS.Vector3.subtractVectors(n.ray,n.position,r.centroid),FSS.Vector3.normalise(n.ray),o=FSS.Vector3.dot(r.normal,n.ray),this.side===FSS.FRONT?o=Math.max(o,0):this.side===FSS.BACK?o=Math.abs(Math.min(o,0)):this.side===FSS.DOUBLE&&(o=Math.max(Math.abs(o),0)),FSS.Vector4.multiplyVectors(this.material.slave.rgba,this.material.ambient.rgba,n.ambient.rgba),FSS.Vector4.add(r.color.rgba,this.material.slave.rgba),FSS.Vector4.multiplyVectors(this.material.slave.rgba,this.material.diffuse.rgba,n.diffuse.rgba),FSS.Vector4.multiplyScalar(this.material.slave.rgba,o),FSS.Vector4.add(r.color.rgba,this.material.slave.rgba);FSS.Vector4.clamp(r.color.rgba,0,1)}return this},FSS.Scene=function(){this.meshes=[],this.lights=[]},FSS.Scene.prototype={add:function(t){return t instanceof FSS.Mesh&&!~this.meshes.indexOf(t)?this.meshes.push(t):t instanceof FSS.Light&&!~this.lights.indexOf(t)&&this.lights.push(t),this},remove:function(t){return t instanceof FSS.Mesh&&~this.meshes.indexOf(t)?this.meshes.splice(this.meshes.indexOf(t),1):t instanceof FSS.Light&&~this.lights.indexOf(t)&&this.lights.splice(this.lights.indexOf(t),1),this}},FSS.Renderer=function(){this.width=0,this.height=0,this.halfWidth=0,this.halfHeight=0},FSS.Renderer.prototype={setSize:function(t,e){return this.width!==t||this.height!==e?(this.width=t,this.height=e,this.halfWidth=.5*this.width,this.halfHeight=.5*this.height,this):void 0},clear:function(){return this},render:function(){return this}},FSS.CanvasRenderer=function(){FSS.Renderer.call(this),this.element=document.createElement("canvas"),this.element.style.display="block",this.context=this.element.getContext("2d"),this.setSize(this.element.width,this.element.height)},FSS.CanvasRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.CanvasRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.element.width=t,this.element.height=e,this.context.setTransform(1,0,0,-1,this.halfWidth,this.halfHeight),this},FSS.CanvasRenderer.prototype.clear=function(){return FSS.Renderer.prototype.clear.call(this),this.context.clearRect(-this.halfWidth,-this.halfHeight,this.width,this.height),this},FSS.CanvasRenderer.prototype.render=function(t){FSS.Renderer.prototype.render.call(this,t);var e,i,r,s,n;for(this.clear(),this.context.lineJoin="round",this.context.lineWidth=1,e=t.meshes.length-1;e>=0;e--)if(i=t.meshes[e],i.visible)for(i.update(t.lights,!0),r=i.geometry.triangles.length-1;r>=0;r--)s=i.geometry.triangles[r],n=s.color.format(),this.context.beginPath(),this.context.moveTo(s.a.position[0],s.a.position[1]),this.context.lineTo(s.b.position[0],s.b.position[1]),this.context.lineTo(s.c.position[0],s.c.position[1]),this.context.closePath(),this.context.strokeStyle=n,this.context.fillStyle=n,this.context.stroke(),this.context.fill();return this},FSS.WebGLRenderer=function(){FSS.Renderer.call(this),this.element=document.createElement("canvas"),this.element.style.display="block",this.vertices=null,this.lights=null;var t={preserveDrawingBuffer:!1,premultipliedAlpha:!0,antialias:!0,stencil:!0,alpha:!0};return this.gl=this.getContext(this.element,t),this.unsupported=!this.gl,this.unsupported?"WebGL is not supported by your browser.":(this.gl.clearColor(0,0,0,0),this.gl.enable(this.gl.DEPTH_TEST),this.setSize(this.element.width,this.element.height),void 0)},FSS.WebGLRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.WebGLRenderer.prototype.getContext=function(t,e){var i=!1;try{if(!(i=t.getContext("experimental-webgl",e)))throw"Error creating WebGL context."}catch(r){console.error(r)}return i},FSS.WebGLRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.unsupported?void 0:(this.element.width=t,this.element.height=e,this.gl.viewport(0,0,t,e),this)},FSS.WebGLRenderer.prototype.clear=function(){return FSS.Renderer.prototype.clear.call(this),this.unsupported?void 0:(this.gl.clear(this.gl.COLOR_BUFFER_BIT|this.gl.DEPTH_BUFFER_BIT),this)},FSS.WebGLRenderer.prototype.render=function(t){if(FSS.Renderer.prototype.render.call(this,t),!this.unsupported){var e,i,r,s,n,o,h,a,l,u,c,S,f,m,g,d=!1,p=t.lights.length,F=0;if(this.clear(),this.lights!==p){if(this.lights=p,!(this.lights>0))return;this.buildProgram(p)}if(this.program){for(e=t.meshes.length-1;e>=0;e--)i=t.meshes[e],i.geometry.dirty&&(d=!0),i.update(t.lights,!1),F+=3*i.geometry.triangles.length;if(d||this.vertices!==F){this.vertices=F;for(a in this.program.attributes){for(u=this.program.attributes[a],u.data=new FSS.Array(F*u.size),f=0,e=t.meshes.length-1;e>=0;e--)for(i=t.meshes[e],r=0,s=i.geometry.triangles.length;s>r;r++)for(n=i.geometry.triangles[r],m=0,g=n.vertices.length;g>m;m++){switch(vertex=n.vertices[m],a){case"side":this.setBufferData(f,u,i.side);break;case"position":this.setBufferData(f,u,vertex.position);break;case"centroid":this.setBufferData(f,u,n.centroid);break;case"normal":this.setBufferData(f,u,n.normal);break;case"ambient":this.setBufferData(f,u,i.material.ambient.rgba);break;case"diffuse":this.setBufferData(f,u,i.material.diffuse.rgba)}f++}this.gl.bindBuffer(this.gl.ARRAY_BUFFER,u.buffer),this.gl.bufferData(this.gl.ARRAY_BUFFER,u.data,this.gl.DYNAMIC_DRAW),this.gl.enableVertexAttribArray(u.location),this.gl.vertexAttribPointer(u.location,u.size,this.gl.FLOAT,!1,0,0)}}for(this.setBufferData(0,this.program.uniforms.resolution,[this.width,this.height,this.width]),o=p-1;o>=0;o--)h=t.lights[o],this.setBufferData(o,this.program.uniforms.lightPosition,h.position),this.setBufferData(o,this.program.uniforms.lightAmbient,h.ambient.rgba),this.setBufferData(o,this.program.uniforms.lightDiffuse,h.diffuse.rgba);for(l in this.program.uniforms)switch(u=this.program.uniforms[l],S=u.location,c=u.data,u.structure){case"3f":this.gl.uniform3f(S,c[0],c[1],c[2]);break;case"3fv":this.gl.uniform3fv(S,c);break;case"4fv":this.gl.uniform4fv(S,c)}}return this.gl.drawArrays(this.gl.TRIANGLES,0,this.vertices),this}},FSS.WebGLRenderer.prototype.setBufferData=function(t,e,i){if(FSS.Utils.isNumber(i))e.data[t*e.size]=i;else for(var r=i.length-1;r>=0;r--)e.data[t*e.size+r]=i[r]},FSS.WebGLRenderer.prototype.buildProgram=function(t){if(!this.unsupported){var e=FSS.WebGLRenderer.VS(t),i=FSS.WebGLRenderer.FS(t),r=e+i;if(!this.program||this.program.code!==r){var s=this.gl.createProgram(),n=this.buildShader(this.gl.VERTEX_SHADER,e),o=this.buildShader(this.gl.FRAGMENT_SHADER,i);if(this.gl.attachShader(s,n),this.gl.attachShader(s,o),this.gl.linkProgram(s),!this.gl.getProgramParameter(s,this.gl.LINK_STATUS)){var h=this.gl.getError(),a=this.gl.getProgramParameter(s,this.gl.VALIDATE_STATUS);return console.error("Could not initialise shader.\nVALIDATE_STATUS: "+a+"\nERROR: "+h),null}return this.gl.deleteShader(o),this.gl.deleteShader(n),s.code=r,s.attributes={side:this.buildBuffer(s,"attribute","aSide",1,"f"),position:this.buildBuffer(s,"attribute","aPosition",3,"v3"),centroid:this.buildBuffer(s,"attribute","aCentroid",3,"v3"),normal:this.buildBuffer(s,"attribute","aNormal",3,"v3"),ambient:this.buildBuffer(s,"attribute","aAmbient",4,"v4"),diffuse:this.buildBuffer(s,"attribute","aDiffuse",4,"v4")},s.uniforms={resolution:this.buildBuffer(s,"uniform","uResolution",3,"3f",1),lightPosition:this.buildBuffer(s,"uniform","uLightPosition",3,"3fv",t),lightAmbient:this.buildBuffer(s,"uniform","uLightAmbient",4,"4fv",t),lightDiffuse:this.buildBuffer(s,"uniform","uLightDiffuse",4,"4fv",t)},this.program=s,this.gl.useProgram(this.program),s}}},FSS.WebGLRenderer.prototype.buildShader=function(t,e){if(!this.unsupported){var i=this.gl.createShader(t);return this.gl.shaderSource(i,e),this.gl.compileShader(i),this.gl.getShaderParameter(i,this.gl.COMPILE_STATUS)?i:(console.error(this.gl.getShaderInfoLog(i)),null)}},FSS.WebGLRenderer.prototype.buildBuffer=function(t,e,i,r,s,n){var o={buffer:this.gl.createBuffer(),size:r,structure:s,data:null};switch(e){case"attribute":o.location=this.gl.getAttribLocation(t,i);break;case"uniform":o.location=this.gl.getUniformLocation(t,i)}return n&&(o.data=new FSS.Array(n*r)),o},FSS.WebGLRenderer.VS=function(t){var e=["precision mediump float;","#define LIGHTS "+t,"attribute float aSide;","attribute vec3 aPosition;","attribute vec3 aCentroid;","attribute vec3 aNormal;","attribute vec4 aAmbient;","attribute vec4 aDiffuse;","uniform vec3 uResolution;","uniform vec3 uLightPosition[LIGHTS];","uniform vec4 uLightAmbient[LIGHTS];","uniform vec4 uLightDiffuse[LIGHTS];","varying vec4 vColor;","void main() {","vColor = vec4(0.0);","vec3 position = aPosition / uResolution * 2.0;","for (int i = 0; i < LIGHTS; i++) {","vec3 lightPosition = uLightPosition[i];","vec4 lightAmbient = uLightAmbient[i];","vec4 lightDiffuse = uLightDiffuse[i];","vec3 ray = normalize(lightPosition - aCentroid);","float illuminance = dot(aNormal, ray);","if (aSide == 0.0) {","illuminance = max(illuminance, 0.0);","} else if (aSide == 1.0) {","illuminance = abs(min(illuminance, 0.0));","} else if (aSide == 2.0) {","illuminance = max(abs(illuminance), 0.0);","}","vColor += aAmbient * lightAmbient;","vColor += aDiffuse * lightDiffuse * illuminance;","}","vColor = clamp(vColor, 0.0, 1.0);","gl_Position = vec4(position, 1.0);","}"].join("\n");return e},FSS.WebGLRenderer.FS=function(){var t=["precision mediump float;","varying vec4 vColor;","void main() {","gl_FragColor = vColor;","}"].join("\n");return t},FSS.SVGRenderer=function(){FSS.Renderer.call(this),this.element=document.createElementNS(FSS.SVGNS,"svg"),this.element.setAttribute("xmlns",FSS.SVGNS),this.element.setAttribute("version","1.1"),this.element.style.display="block",this.setSize(300,150)},FSS.SVGRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.SVGRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.element.setAttribute("width",t),this.element.setAttribute("height",e),this},FSS.SVGRenderer.prototype.clear=function(){FSS.Renderer.prototype.clear.call(this);for(var t=this.element.childNodes.length-1;t>=0;t--)this.element.removeChild(this.element.childNodes[t]);return this},FSS.SVGRenderer.prototype.render=function(t){FSS.Renderer.prototype.render.call(this,t);var e,i,r,s,n,o;for(e=t.meshes.length-1;e>=0;e--)if(i=t.meshes[e],i.visible)for(i.update(t.lights,!0),r=i.geometry.triangles.length-1;r>=0;r--)s=i.geometry.triangles[r],s.polygon.parentNode!==this.element&&this.element.appendChild(s.polygon),n=this.formatPoint(s.a)+" ",n+=this.formatPoint(s.b)+" ",n+=this.formatPoint(s.c),o=this.formatStyle(s.color.format()),s.polygon.setAttributeNS(null,"points",n),s.polygon.setAttributeNS(null,"style",o);return this},FSS.SVGRenderer.prototype.formatPoint=function(t){return this.halfWidth+t.position[0]+","+(this.halfHeight-t.position[1])},FSS.SVGRenderer.prototype.formatStyle=function(t){var e="fill:"+t+";";return e+="stroke:"+t+";"};
}

function initBackground() {
  var container = document.getElementById('background-container');
  var output = document.getElementById('background-output');

  if (!config.background.enabled) {
    return;
  }

  initPlugin();

  config.background.LIGHT.bounds = FSS.Vector3.create(),
  config.background.LIGHT.step = FSS.Vector3.create(
      Math.randomInRange(0.2, 1.0),
      Math.randomInRange(0.2, 1.0),
      Math.randomInRange(0.2, 1.0)
  )

  //------------------------------
  // Global Properties
  //------------------------------
  var now, start = Date.now();
  var center = FSS.Vector3.create();
  var attractor = FSS.Vector3.create();
  var renderer, scene, mesh, geometry, material;
  var webglRenderer, canvasRenderer, svgRenderer;
  var gui, autopilotController;


  //------------------------------
  // Methods
  //------------------------------
  function initialise() {
    createRenderer();
    createScene();
    createMesh();
    createLights();
    addEventListeners();
    resize(container.offsetWidth, container.offsetHeight);
    animate();
  }

  function createRenderer() {
    webglRenderer = new FSS.WebGLRenderer();
    canvasRenderer = new FSS.CanvasRenderer();
    svgRenderer = new FSS.SVGRenderer();
    setRenderer(config.background.RENDER.renderer);
  }

  function setRenderer(index) {
    if (renderer) {
      output.removeChild(renderer.element);
    }

    renderer = canvasRenderer;
    renderer.setSize(container.offsetWidth, container.offsetHeight);
    output.appendChild(renderer.element);
  }

  function createScene() {
    scene = new FSS.Scene();
  }

  function createMesh() {
    scene.remove(mesh);
    renderer.clear();
    geometry = new FSS.Plane(config.background.MESH.width * renderer.width, config.background.MESH.height * renderer.height, config.background.MESH.segments, config.background.MESH.slices);
    material = new FSS.Material(config.background.MESH.ambient, config.background.MESH.diffuse);
    mesh = new FSS.Mesh(geometry, material);
    scene.add(mesh);

    // Augment vertices for animation
    var v, vertex;
    for (v = geometry.vertices.length - 1; v >= 0; v--) {
      vertex = geometry.vertices[v];
      vertex.anchor = FSS.Vector3.clone(vertex.position);
      vertex.step = FSS.Vector3.create(
        Math.randomInRange(0.2, 1.0),
        Math.randomInRange(0.2, 1.0),
        Math.randomInRange(0.2, 1.0)
      );
      vertex.time = Math.randomInRange(0, Math.PIM2);
    }
  }

  function createLights() {
    var l, light;
    for (l = scene.lights.length - 1; l >= 0; l--) {
      light = scene.lights[l];
      scene.remove(light);
    }
    renderer.clear();
    for (l = 0; l < config.background.LIGHT.count; l++) {
      light = new FSS.Light(config.background.LIGHT.ambient, config.background.LIGHT.diffuse);
      light.ambientHex = light.ambient.format();
      light.diffuseHex = light.diffuse.format();
      scene.add(light);

      // Augment light for animation
      light.mass = Math.randomInRange(0.5, 1);
      light.velocity = FSS.Vector3.create();
      light.acceleration = FSS.Vector3.create();
      light.force = FSS.Vector3.create();

      // Ring SVG Circle
      light.ring = document.createElementNS(FSS.SVGNS, 'circle');
      light.ring.setAttributeNS(null, 'stroke', light.ambientHex);
      light.ring.setAttributeNS(null, 'stroke-width', '0.5');
      light.ring.setAttributeNS(null, 'fill', 'none');
      light.ring.setAttributeNS(null, 'r', '10');

      // Core SVG Circle
      light.core = document.createElementNS(FSS.SVGNS, 'circle');
      light.core.setAttributeNS(null, 'fill', light.diffuseHex);
      light.core.setAttributeNS(null, 'r', '4');
    }
  }

  function resize(width, height) {
    renderer.setSize(width, height);
    FSS.Vector3.set(center, renderer.halfWidth, renderer.halfHeight);
    createMesh();
  }

  function animate() {
    now = Date.now() - start;
    update();
    render();
    requestAnimationFrame(animate);
  }

  function update() {
    var ox, oy, oz, l, light, v, vertex, offset = config.background.MESH.depth/2;

    // Update Bounds
    FSS.Vector3.copy(config.background.LIGHT.bounds, center);
    FSS.Vector3.multiplyScalar(config.background.LIGHT.bounds, config.background.LIGHT.xyScalar);

    // Update Attractor
    FSS.Vector3.setZ(attractor, config.background.LIGHT.zOffset);

    // Overwrite the Attractor position
    if (config.background.LIGHT.autopilot) {
      ox = Math.sin(config.background.LIGHT.step[0] * now * config.background.LIGHT.speed);
      oy = Math.cos(config.background.LIGHT.step[1] * now * config.background.LIGHT.speed);
      FSS.Vector3.set(attractor,
        config.background.LIGHT.bounds[0]*ox,
        config.background.LIGHT.bounds[1]*oy,
        config.background.LIGHT.zOffset);
    }

    // Animate Lights
    for (l = scene.lights.length - 1; l >= 0; l--) {
      light = scene.lights[l];

      // Reset the z position of the light
      FSS.Vector3.setZ(light.position, config.background.LIGHT.zOffset);

      // Calculate the force Luke!
      var D = Math.clamp(FSS.Vector3.distanceSquared(light.position, attractor), config.background.LIGHT.minDistance, config.background.LIGHT.maxDistance);
      var F = config.background.LIGHT.gravity * light.mass / D;
      FSS.Vector3.subtractVectors(light.force, attractor, light.position);
      FSS.Vector3.normalise(light.force);
      FSS.Vector3.multiplyScalar(light.force, F);

      // Update the light position
      FSS.Vector3.set(light.acceleration);
      FSS.Vector3.add(light.acceleration, light.force);
      FSS.Vector3.add(light.velocity, light.acceleration);
      FSS.Vector3.multiplyScalar(light.velocity, config.background.LIGHT.dampening);
      FSS.Vector3.limit(light.velocity, config.background.LIGHT.minLimit, config.background.LIGHT.maxLimit);
      FSS.Vector3.add(light.position, light.velocity);
    }

    // Animate Vertices
    for (v = geometry.vertices.length - 1; v >= 0; v--) {
      vertex = geometry.vertices[v];
      ox = Math.sin(vertex.time + vertex.step[0] * now * config.background.MESH.speed);
      oy = Math.cos(vertex.time + vertex.step[1] * now * config.background.MESH.speed);
      oz = Math.sin(vertex.time + vertex.step[2] * now * config.background.MESH.speed);
      FSS.Vector3.set(vertex.position,
        config.background.MESH.xRange*geometry.segmentWidth*ox,
        config.background.MESH.yRange*geometry.sliceHeight*oy,
        config.background.MESH.zRange*offset*oz - offset);
      FSS.Vector3.add(vertex.position, vertex.anchor);
    }

    // Set the Geometry to dirty
    geometry.dirty = true;
  }

  function render() {
    renderer.render(scene);

    // Draw Lights
    if (config.background.LIGHT.draw) {
      var l, lx, ly, light;
      for (l = scene.lights.length - 1; l >= 0; l--) {
        light = scene.lights[l];
        lx = light.position[0];
        ly = light.position[1];
        switch(config.background.RENDER.renderer) {
          case CANVAS:
            renderer.context.lineWidth = 0.5;
            renderer.context.beginPath();
            renderer.context.arc(lx, ly, 10, 0, Math.PIM2);
            renderer.context.strokeStyle = light.ambientHex;
            renderer.context.stroke();
            renderer.context.beginPath();
            renderer.context.arc(lx, ly, 4, 0, Math.PIM2);
            renderer.context.fillStyle = light.diffuseHex;
            renderer.context.fill();
            break;
          case SVG:
            lx += renderer.halfWidth;
            ly = renderer.halfHeight - ly;
            light.core.setAttributeNS(null, 'fill', light.diffuseHex);
            light.core.setAttributeNS(null, 'cx', lx);
            light.core.setAttributeNS(null, 'cy', ly);
            renderer.element.appendChild(light.core);
            light.ring.setAttributeNS(null, 'stroke', light.ambientHex);
            light.ring.setAttributeNS(null, 'cx', lx);
            light.ring.setAttributeNS(null, 'cy', ly);
            renderer.element.appendChild(light.ring);
            break;
        }
      }
    }
  }

  function addEventListeners() {
    window.addEventListener('resize', onWindowResize);
    container.addEventListener('click', onMouseClick);
    container.addEventListener('mousemove', onMouseMove);
  }

  //------------------------------
  // Callbacks
  //------------------------------

  function onMouseClick(event) {
    if (config.background.LIGHT.followMouseClicks) {
      FSS.Vector3.set(attractor, event.x, renderer.height - event.y);
      FSS.Vector3.subtract(attractor, center);
      config.background.LIGHT.autopilot = !config.background.LIGHT.autopilot;
      autopilotController.updateDisplay();
    }
  }

  function onMouseMove(event) {
    FSS.Vector3.set(attractor, event.x, renderer.height - event.y);
    FSS.Vector3.subtract(attractor, center);
  }

  function onWindowResize(event) {
    resize(container.offsetWidth, container.offsetHeight);
    render();
  }



  // Let there be light!
  initialise();
}

/* ========================================================================
 * Bootstrap (plugin): validator.js v0.9.0
 * ========================================================================
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Cina Saffary.
 * Made by @1000hz in the style of Bootstrap 3 era @fat
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * ======================================================================== */


+function ($) {
  'use strict';

  // VALIDATOR CLASS DEFINITION
  // ==========================

  var Validator = function (element, options) {
    this.$element = $(element)
    this.options  = options

    options.errors = $.extend({}, Validator.DEFAULTS.errors, options.errors)

    for (var custom in options.custom) {
      if (!options.errors[custom]) throw new Error('Missing default error message for custom validator: ' + custom)
    }

    $.extend(Validator.VALIDATORS, options.custom)

    this.$element.attr('novalidate', true) // disable automatic native validation
    this.toggleSubmit()

    this.$element.on('input.bs.validator change.bs.validator focusout.bs.validator', $.proxy(this.validateInput, this))
    this.$element.on('submit.bs.validator', $.proxy(this.onSubmit, this))

    this.$element.find('[data-match]').each(function () {
      var $this  = $(this)
      var target = $this.data('match')

      $(target).on('input.bs.validator', function (e) {
        $this.val() && $this.trigger('input.bs.validator')
      })
    })
  }

  Validator.INPUT_SELECTOR = ':input:not([type="submit"], button):enabled:visible'

  Validator.DEFAULTS = {
    delay: 500,
    html: false,
    disable: true,
    custom: {},
    errors: {
      match: 'Does not match',
      minlength: 'Not long enough'
    },
    feedback: {
      success: 'glyphicon-ok',
      error: 'glyphicon-remove'
    }
  }

  Validator.VALIDATORS = {
    'native': function ($el) {
      var el = $el[0]
      return el.checkValidity ? el.checkValidity() : true
    },
    'match': function ($el) {
      var target = $el.data('match')
      return !$el.val() || $el.val() === $(target).val()
    },
    'minlength': function ($el) {
      var minlength = $el.data('minlength')
      return !$el.val() || $el.val().length >= minlength
    }
  }

  Validator.prototype.validateInput = function (e) {
    var $el        = $(e.target)
    var prevErrors = $el.data('bs.validator.errors')
    var errors

    if ($el.is('[type="radio"]')) $el = this.$element.find('input[name="' + $el.attr('name') + '"]')

    this.$element.trigger(e = $.Event('validate.bs.validator', {relatedTarget: $el[0]}))

    if (e.isDefaultPrevented()) return

    var self = this

    this.runValidators($el).done(function (errors) {
      $el.data('bs.validator.errors', errors)

      errors.length ? self.showErrors($el) : self.clearErrors($el)

      if (!prevErrors || errors.toString() !== prevErrors.toString()) {
        e = errors.length
          ? $.Event('invalid.bs.validator', {relatedTarget: $el[0], detail: errors})
          : $.Event('valid.bs.validator', {relatedTarget: $el[0], detail: prevErrors})

        self.$element.trigger(e)
      }

      self.toggleSubmit()

      self.$element.trigger($.Event('validated.bs.validator', {relatedTarget: $el[0]}))
    })
  }


  Validator.prototype.runValidators = function ($el) {
    var errors   = []
    var deferred = $.Deferred()
    var options  = this.options

    $el.data('bs.validator.deferred') && $el.data('bs.validator.deferred').reject()
    $el.data('bs.validator.deferred', deferred)

    function getErrorMessage(key) {
      return $el.data(key + '-error')
        || $el.data('error')
        || key == 'native' && $el[0].validationMessage
        || options.errors[key]
    }

    $.each(Validator.VALIDATORS, $.proxy(function (key, validator) {
      if (($el.data(key) || key == 'native') && !validator.call(this, $el)) {
        var error = getErrorMessage(key)
        !~errors.indexOf(error) && errors.push(error)
      }
    }, this))

    if (!errors.length && $el.val() && $el.data('remote')) {
      this.defer($el, function () {
        var data = {}
        data[$el.attr('name')] = $el.val()
        $.get($el.data('remote'), data)
          .fail(function (jqXHR, textStatus, error) { errors.push(getErrorMessage('remote') || error) })
          .always(function () { deferred.resolve(errors)})
      })
    } else deferred.resolve(errors)

    return deferred.promise()
  }

  Validator.prototype.validate = function () {
    var delay = this.options.delay

    this.options.delay = 0
    this.$element.find(Validator.INPUT_SELECTOR).trigger('input.bs.validator')
    this.options.delay = delay

    return this
  }

  Validator.prototype.showErrors = function ($el) {
    var method = this.options.html ? 'html' : 'text'

    this.defer($el, function () {
      var $group = $el.closest('.form-group')
      var $block = $group.find('.help-block.with-errors')
      var $feedback = $group.find('.form-control-feedback')
      var errors = $el.data('bs.validator.errors')

      if (!errors.length) return

      errors = $('<ul/>')
        .addClass('list-unstyled')
        .append($.map(errors, function (error) { return $('<li/>')[method](error) }))

      $block.data('bs.validator.originalContent') === undefined && $block.data('bs.validator.originalContent', $block.html())
      $block.empty().append(errors)
      $group.addClass('has-error')

      $feedback.length
        && $feedback.removeClass(this.options.feedback.success)
        && $feedback.addClass(this.options.feedback.error)
        && $group.removeClass('has-success')
    })
  }

  Validator.prototype.clearErrors = function ($el) {
    var $group = $el.closest('.form-group')
    var $block = $group.find('.help-block.with-errors')
    var $feedback = $group.find('.form-control-feedback')

    $block.html($block.data('bs.validator.originalContent'))
    $group.removeClass('has-error')

    $feedback.length
      && $feedback.removeClass(this.options.feedback.error)
      && $feedback.addClass(this.options.feedback.success)
      && $group.addClass('has-success')
  }

  Validator.prototype.hasErrors = function () {
    function fieldErrors() {
      return !!($(this).data('bs.validator.errors') || []).length
    }

    return !!this.$element.find(Validator.INPUT_SELECTOR).filter(fieldErrors).length
  }

  Validator.prototype.isIncomplete = function () {
    function fieldIncomplete() {
      return this.type === 'checkbox' ? !this.checked                                   :
             this.type === 'radio'    ? !$('[name="' + this.name + '"]:checked').length :
                                        $.trim(this.value) === ''
    }

    return !!this.$element.find(Validator.INPUT_SELECTOR).filter('[required]').filter(fieldIncomplete).length
  }

  Validator.prototype.onSubmit = function (e) {
    this.validate()
    if (this.isIncomplete() || this.hasErrors()) e.preventDefault()
  }

  Validator.prototype.toggleSubmit = function () {
    if(!this.options.disable) return

    var $btn = $('button[type="submit"], input[type="submit"]')
      .filter('[form="' + this.$element.attr('id') + '"]')
      .add(this.$element.find('input[type="submit"], button[type="submit"]'))

    $btn.toggleClass('disabled', this.isIncomplete() || this.hasErrors())
  }

  Validator.prototype.defer = function ($el, callback) {
    callback = $.proxy(callback, this)
    if (!this.options.delay) return callback()
    window.clearTimeout($el.data('bs.validator.timeout'))
    $el.data('bs.validator.timeout', window.setTimeout(callback, this.options.delay))
  }

  Validator.prototype.destroy = function () {
    this.$element
      .removeAttr('novalidate')
      .removeData('bs.validator')
      .off('.bs.validator')

    this.$element.find(Validator.INPUT_SELECTOR)
      .off('.bs.validator')
      .removeData(['bs.validator.errors', 'bs.validator.deferred'])
      .each(function () {
        var $this = $(this)
        var timeout = $this.data('bs.validator.timeout')
        window.clearTimeout(timeout) && $this.removeData('bs.validator.timeout')
      })

    this.$element.find('.help-block.with-errors').each(function () {
      var $this = $(this)
      var originalContent = $this.data('bs.validator.originalContent')

      $this
        .removeData('bs.validator.originalContent')
        .html(originalContent)
    })

    this.$element.find('input[type="submit"], button[type="submit"]').removeClass('disabled')

    this.$element.find('.has-error').removeClass('has-error')

    return this
  }

  // VALIDATOR PLUGIN DEFINITION
  // ===========================


  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var options = $.extend({}, Validator.DEFAULTS, $this.data(), typeof option == 'object' && option)
      var data    = $this.data('bs.validator')

      if (!data && option == 'destroy') return
      if (!data) $this.data('bs.validator', (data = new Validator(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.validator

  $.fn.validator             = Plugin
  $.fn.validator.Constructor = Validator


  // VALIDATOR NO CONFLICT
  // =====================

  $.fn.validator.noConflict = function () {
    $.fn.validator = old
    return this
  }


  // VALIDATOR DATA-API
  // ==================

  $(window).on('load', function () {
    $('form[data-toggle="validator"]').each(function () {
      var $form = $(this)
      Plugin.call($form, $form.data())
    })
  })

}(jQuery);

var config = {
    countdown: {
        year: 2015,
        month: 11,
        day: 10,
        hour: 0,
        minute: 0,
        second: 0
    },

    subscription_form_tooltips: {
        success: 'You have been subscribed!',
        already_subscribed: 'You are already subscribed',
        empty_email: 'Please, Enter your email',
        invalid_email: 'Email is invalid. Enter valid email address',
        default_error: 'Error! Contact administration'
    }
}

$(function() {
    var $body = $(document.body),
        $window = $(window);



    // Background

    var canvas = document.createElement('canvas');

    backgroundEnabled = canvas.getContext && canvas.getContext('2d') && $('#background-container').css('display') != 'none';

    if (backgroundEnabled) {
        config.background = {
            enabled: true,

            RENDER: {
                renderer: 'canvas'
            },

            MESH: {
                width: 1.2,
                height: 1.2,
                depth: 10,
                segments: 16,
                slices: 8,
                xRange: 0.8,
                yRange: 0.1,
                zRange: 1.0,
                ambient: '#555555',
                diffuse: '#FFFFFF',
                speed: 0.0005
            },

            LIGHT: {
                count: 2,
                xyScalar: 1,
                zOffset: 150,
                ambient: '#880066',
                diffuse: '#D77600',
                speed: 0.001,
                gravity: 1200,
                dampening: 0.15,
                minLimit: 8,
                maxLimit: null,
                minDistance: 20,
                maxDistance: 400,
                autopilot: true,
                draw: false
            }
        }


        if ($body.hasClass('theme-ice')) {
            config.background.LIGHT.ambient = '#1165A4';
            config.background.LIGHT.diffuse = '#514311';
        } else if ($body.hasClass('theme-nature')) {
            config.background.LIGHT.ambient = '#00935B';
            config.background.LIGHT.diffuse = '#02480A';
        } else if ($body.hasClass('theme-sea')) {
            config.background.LIGHT.ambient = '#76E4CE';
            config.background.LIGHT.diffuse = '#0E411F';
            config.background.LIGHT.zOffset = 100;
        } else if ($body.hasClass('theme-candy')) {
            config.background.LIGHT.ambient = '#A42D71';
            config.background.LIGHT.diffuse = '#4E2F1B';
        } else if ($body.hasClass('theme-peach')) {
            config.background.LIGHT.ambient = '#FF7171';
            config.background.LIGHT.diffuse = '#895321';
            config.background.LIGHT.zOffset = 100;
        } else if ($body.hasClass('theme-light')) {
            config.background.LIGHT.ambient = '#DBAA95';
            config.background.LIGHT.diffuse = '#4F460B';
        } else if ($body.hasClass('theme-darkness')) {
            config.background.LIGHT.ambient = '#3C3C3C';
            config.background.LIGHT.diffuse = '#494949';
            config.background.LIGHT.zOffset = 200;
        }

        initBackground();
    }



    // Countdown

    var date = new Date(config.countdown.year,
                        config.countdown.month - 1,
                        config.countdown.day,
                        config.countdown.hour,
                        config.countdown.minute,
                        config.countdown.second),
        $countdownNumbers = {
            days: $('#countdown-days'),
            hours: $('#countdown-hours'),
            minutes: $('#countdown-minutes'),
            seconds: $('#countdown-seconds')
        };

    $('#countdown').countdown(date).on('update.countdown', function(event) {
        $countdownNumbers.days.text(event.offset.totalDays);
        $countdownNumbers.hours.text(('0' + event.offset.hours).slice(-2));
        $countdownNumbers.minutes.text(('0' + event.offset.minutes).slice(-2));
        $countdownNumbers.seconds.text(('0' + event.offset.seconds).slice(-2));
    });



    // Subscription form

    var messages = config.subscription_form_tooltips,
        error = false,
        $form = $('#subscription-form'),
        $email = $('#subscription-form-email'),
        $button = $('#subscription-form-submit'),
        $tooltip;

    function renderTooltip(type, message) {
        var offset;

        if (!$tooltip) {
            $tooltip = $('<p class="subscription-form-tooltip"></p>').appendTo($form);
        }

        if (type == 'success') {
            $tooltip.removeClass('error').addClass('success');
        } else {
            $tooltip.removeClass('success').addClass('error');
        }

        $tooltip.text(message).fadeTo(0, 0);
        offset = $tooltip.outerWidth() / 2;
        $tooltip.css('margin-left', -offset).animate({top: '100%'}, 200).dequeue().fadeTo(200, 1);
    }

    function hideTooltip() {
        if ($tooltip) {
            $tooltip.animate({top: '120%'}, 200).dequeue().fadeTo(100, 0);
        }
    }

    function changeFormState(type, message) {
        $email.removeClass('success error');

        if (type == 'normal') {
            hideTooltip();
        } else {
            renderTooltip(type, message);
            $email.addClass(type);
        }
    }

    $form.submit(function(event) {
        event.preventDefault();

        var email = $email.val();

        if (email.length == 0) {
            changeFormState('error', messages['empty_email']);
        } else {
            $.post('subscribe.html', {
                'email': email,
                'ajax': 1
            }, function(data) {
                if (data.status == 'success') {
                    changeFormState('success', messages['success']);
                } else {
                    switch(data.error) {
                        case 'empty_email':
                        case 'invalid_email':
                        case 'already_subscribed':
                            changeFormState('error', messages[data.error]);
                            break;

                        default:
                            changeFormState('error', messages['default_error'])
                            break;
                    }
                }
            }, 'json');
        }
    });

    // Remove tooltip on text change
    $email.on('change focus click keydown', function() {
        if ($email.val().length > 0) {
            changeFormState('normal');
        }
    });
});
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


//2)



  

$(function() {
    var $html = $('html'),
        $demo_panel = $('#demo-panel'),
        $themeSwitchers = $('.demo-panel-themes li');

    $('#demo-panel-activator').on('click', function(e) {
        e.preventDefault();

        $demo_panel.toggleClass('active');
    });

    $themeSwitchers.on('click', function() {
        var $this = $(this);

        $themeSwitchers.filter('.active').removeClass('active');
        $this.toggleClass('active');
    });
});
var twitterElement;
var newScript;
var copyLink;
$(".feedsbox").mouseenter(function() {
  twitterElement=$(this).find(".article_twitter");
  $(twitterElement).addClass("twitter-share-button");
  copyLink=$(this).find(".copy-button");
  $(copyLink).attr('id', 'copy-button');
  copyLink=$(this).find(".copy-button-text");
  $(copyLink).attr('id', 'copy-button-text');
  copyLink=$(this).find(".copy-button-link");
  $(copyLink).attr('id', 'copy-button-link');

  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(document.body){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
});

$(".dropdown-toggle").mouseenter(function(){
  $(this).attr("data-toggle","dropdown");
});

$(".dropdown-toggle").mouseleave(function(){

  $(this).addClass("t0ggle");
  $(this).attr("data-toggle","");
  
  $(".copy-button").zclip({
	        path:"../js/ZeroClipboard.swf",
	        copy:function(){return $("#copy-button-link").text();},
			afterCopy:function(){
				document.getElementById("copy-button-text").innerHTML=" Copied To Clipboard";
        setTimeout(function(){
          $('.t0ggle').attr("data-toggle","dropdown");
          $('.t0ggle').click();
          $('.t0ggle').removeClass('t0ggle');
        },500);
			}
	});
});

$(".feedsbox").mouseleave(function() {
  copyLink=$(this).find(".copy-button");
  $(copyLink).attr('id', '');
  copyLink=$(this).find(".copy-button-text");
  $(copyLink).attr('id', '');
  copyLink=$(this).find(".copy-button-link");
  $(copyLink).attr('id', '');
});

=======
function pageUpdate(){$("#user_name").val()&&$("#email").val()&&$("#password").val()?$("#modalSuccessButton").click():$("#modalErrorButton").click()}function updateForm(){document.getElementById("form-part-2").style.display=""}function changeCoordinates(t){for(var e,i=650/$("#"+t+"_img").attr("orgWidth"),n=[],r=1;r<=$("#"+t+"_poly_count").val();r++){e=$("#"+t+"_poly_"+r).attr("coords"),n=e.split(",");for(var o=0;o<n.length;o++)n[o]=n[o]*i,n[o]=Math.trunc(n[o]);document.getElementById(t+"_poly_"+r).coords=n.join()}}function changeTitle(t){for(var e,i=1;i<=$("#"+t+"_poly_count").val();i++)e=$("#"+t+"_poly_"+i).attr("title"),document.getElementById(t+"_poly_"+i).title=e.replace(/(?:^|\s)\S/g,function(t){return t.toUpperCase()})}function firstFilterF(t){$("#country option:selected").text(t);var e=t;t=e.toLowerCase(),t=t.replace(/ /g,"_"),currentCountry=t,$("tr").addClass("out"),$("tr").removeClass("in"),$("tr."+t).addClass("in"),$("tr."+t).removeClass("out"),fillRegions(t);var i="<option value='' disabled selected>Select One</option>;"+fillRegions(t);document.getElementById("region").innerHTML=i,document.getElementById("regionFormGroup").style.display="",$(".mapContainer").hide(),"new_zealand"==t?document.getElementById("mapListing").style.display="":"canada"==t?document.getElementById("canada_map").style.marginTop="-150px":"australia"==t&&(document.getElementById("australia_map").style.marginTop="-15px"),$("#backButton").attr("onclick","window.location.reload()"),document.getElementById("backButton").style.display="",$("#"+t+"_map").show(),document.getElementById(t+"_map").style.visibility="",document.getElementById(t+"_map").style.height="",document.getElementById("divisionFormGroup").style.display="",document.getElementById("countryFormGroup").style.display="none"}function fillRegions(t){for(var e=document.getElementById(t).innerHTML,i=e.split(","),n="",r=0;r<i.length;r++)n+="<option>"+i[r]+"</option>; ";return n}function secondFilterF(t){$("select#region option:selected").text(t);var e=t;t=e.toLowerCase(),t=t.replace(/ /g,"_"),$("tr").addClass("out"),$("tr").removeClass("in"),$("tr."+t).addClass("in"),$("tr."+t).removeClass("out"),$(".mapContainer").hide(),document.getElementById("mapListing").style.display="",$("#backButton").attr("onclick","firstFilterF('"+currentCountry+"')")}function initPlugin(){FSS={FRONT:0,BACK:1,DOUBLE:2,SVGNS:"http://www.w3.org/2000/svg"},FSS.Array="function"==typeof Float32Array?Float32Array:Array,FSS.Utils={isNumber:function(t){return!isNaN(parseFloat(t))&&isFinite(t)}},function(){for(var t=0,e=["ms","moz","webkit","o"],i=0;e.length>i&&!window.requestAnimationFrame;++i)window.requestAnimationFrame=window[e[i]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[e[i]+"CancelAnimationFrame"]||window[e[i]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(e){var i=(new Date).getTime(),n=Math.max(0,16-(i-t)),r=window.setTimeout(function(){e(i+n)},n);return t=i+n,r}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(t){clearTimeout(t)})}(),Math.PIM2=2*Math.PI,Math.PID2=Math.PI/2,Math.randomInRange=function(t,e){return t+(e-t)*Math.random()},Math.clamp=function(t,e,i){return t=Math.max(t,e),t=Math.min(t,i)},FSS.Vector3={create:function(t,e,i){var n=new FSS.Array(3);return this.set(n,t,e,i),n},clone:function(t){var e=this.create();return this.copy(e,t),e},set:function(t,e,i,n){return t[0]=e||0,t[1]=i||0,t[2]=n||0,this},setX:function(t,e){return t[0]=e||0,this},setY:function(t,e){return t[1]=e||0,this},setZ:function(t,e){return t[2]=e||0,this},copy:function(t,e){return t[0]=e[0],t[1]=e[1],t[2]=e[2],this},add:function(t,e){return t[0]+=e[0],t[1]+=e[1],t[2]+=e[2],this},addVectors:function(t,e,i){return t[0]=e[0]+i[0],t[1]=e[1]+i[1],t[2]=e[2]+i[2],this},addScalar:function(t,e){return t[0]+=e,t[1]+=e,t[2]+=e,this},subtract:function(t,e){return t[0]-=e[0],t[1]-=e[1],t[2]-=e[2],this},subtractVectors:function(t,e,i){return t[0]=e[0]-i[0],t[1]=e[1]-i[1],t[2]=e[2]-i[2],this},subtractScalar:function(t,e){return t[0]-=e,t[1]-=e,t[2]-=e,this},multiply:function(t,e){return t[0]*=e[0],t[1]*=e[1],t[2]*=e[2],this},multiplyVectors:function(t,e,i){return t[0]=e[0]*i[0],t[1]=e[1]*i[1],t[2]=e[2]*i[2],this},multiplyScalar:function(t,e){return t[0]*=e,t[1]*=e,t[2]*=e,this},divide:function(t,e){return t[0]/=e[0],t[1]/=e[1],t[2]/=e[2],this},divideVectors:function(t,e,i){return t[0]=e[0]/i[0],t[1]=e[1]/i[1],t[2]=e[2]/i[2],this},divideScalar:function(t,e){return 0!==e?(t[0]/=e,t[1]/=e,t[2]/=e):(t[0]=0,t[1]=0,t[2]=0),this},cross:function(t,e){var i=t[0],n=t[1],r=t[2];return t[0]=n*e[2]-r*e[1],t[1]=r*e[0]-i*e[2],t[2]=i*e[1]-n*e[0],this},crossVectors:function(t,e,i){return t[0]=e[1]*i[2]-e[2]*i[1],t[1]=e[2]*i[0]-e[0]*i[2],t[2]=e[0]*i[1]-e[1]*i[0],this},min:function(t,e){return e>t[0]&&(t[0]=e),e>t[1]&&(t[1]=e),e>t[2]&&(t[2]=e),this},max:function(t,e){return t[0]>e&&(t[0]=e),t[1]>e&&(t[1]=e),t[2]>e&&(t[2]=e),this},clamp:function(t,e,i){return this.min(t,e),this.max(t,i),this},limit:function(t,e,i){var n=this.length(t);return null!==e&&e>n?this.setLength(t,e):null!==i&&n>i&&this.setLength(t,i),this},dot:function(t,e){return t[0]*e[0]+t[1]*e[1]+t[2]*e[2]},normalise:function(t){return this.divideScalar(t,this.length(t))},negate:function(t){return this.multiplyScalar(t,-1)},distanceSquared:function(t,e){var i=t[0]-e[0],n=t[1]-e[1],r=t[2]-e[2];return i*i+n*n+r*r},distance:function(t,e){return Math.sqrt(this.distanceSquared(t,e))},lengthSquared:function(t){return t[0]*t[0]+t[1]*t[1]+t[2]*t[2]},length:function(t){return Math.sqrt(this.lengthSquared(t))},setLength:function(t,e){var i=this.length(t);return 0!==i&&e!==i&&this.multiplyScalar(t,e/i),this}},FSS.Vector4={create:function(t,e,i){var n=new FSS.Array(4);return this.set(n,t,e,i),n},set:function(t,e,i,n,r){return t[0]=e||0,t[1]=i||0,t[2]=n||0,t[3]=r||0,this},setX:function(t,e){return t[0]=e||0,this},setY:function(t,e){return t[1]=e||0,this},setZ:function(t,e){return t[2]=e||0,this},setW:function(t,e){return t[3]=e||0,this},add:function(t,e){return t[0]+=e[0],t[1]+=e[1],t[2]+=e[2],t[3]+=e[3],this},multiplyVectors:function(t,e,i){return t[0]=e[0]*i[0],t[1]=e[1]*i[1],t[2]=e[2]*i[2],t[3]=e[3]*i[3],this},multiplyScalar:function(t,e){return t[0]*=e,t[1]*=e,t[2]*=e,t[3]*=e,this},min:function(t,e){return e>t[0]&&(t[0]=e),e>t[1]&&(t[1]=e),e>t[2]&&(t[2]=e),e>t[3]&&(t[3]=e),this},max:function(t,e){return t[0]>e&&(t[0]=e),t[1]>e&&(t[1]=e),t[2]>e&&(t[2]=e),t[3]>e&&(t[3]=e),this},clamp:function(t,e,i){return this.min(t,e),this.max(t,i),this}},FSS.Color=function(t,e){this.rgba=FSS.Vector4.create(),this.hex=t||"#000000",this.opacity=FSS.Utils.isNumber(e)?e:1,this.set(this.hex,this.opacity)},FSS.Color.prototype={set:function(t,e){t=t.replace("#","");var i=t.length/3;return this.rgba[0]=parseInt(t.substring(0*i,1*i),16)/255,this.rgba[1]=parseInt(t.substring(1*i,2*i),16)/255,this.rgba[2]=parseInt(t.substring(2*i,3*i),16)/255,this.rgba[3]=FSS.Utils.isNumber(e)?e:this.rgba[3],this},hexify:function(t){var e=Math.ceil(255*t).toString(16);return 1===e.length&&(e="0"+e),e},format:function(){var t=this.hexify(this.rgba[0]),e=this.hexify(this.rgba[1]),i=this.hexify(this.rgba[2]);return this.hex="#"+t+e+i,this.hex}},FSS.Object=function(){this.position=FSS.Vector3.create()},FSS.Object.prototype={setPosition:function(t,e,i){return FSS.Vector3.set(this.position,t,e,i),this}},FSS.Light=function(t,e){FSS.Object.call(this),this.ambient=new FSS.Color(t||"#FFFFFF"),this.diffuse=new FSS.Color(e||"#FFFFFF"),this.ray=FSS.Vector3.create()},FSS.Light.prototype=Object.create(FSS.Object.prototype),FSS.Vertex=function(t,e,i){this.position=FSS.Vector3.create(t,e,i)},FSS.Vertex.prototype={setPosition:function(t,e,i){return FSS.Vector3.set(this.position,t,e,i),this}},FSS.Triangle=function(t,e,i){this.a=t||new FSS.Vertex,this.b=e||new FSS.Vertex,this.c=i||new FSS.Vertex,this.vertices=[this.a,this.b,this.c],this.u=FSS.Vector3.create(),this.v=FSS.Vector3.create(),this.centroid=FSS.Vector3.create(),this.normal=FSS.Vector3.create(),this.color=new FSS.Color,this.polygon=document.createElementNS(FSS.SVGNS,"polygon"),this.polygon.setAttributeNS(null,"stroke-linejoin","round"),this.polygon.setAttributeNS(null,"stroke-miterlimit","1"),this.polygon.setAttributeNS(null,"stroke-width","1"),this.computeCentroid(),this.computeNormal()},FSS.Triangle.prototype={computeCentroid:function(){return this.centroid[0]=this.a.position[0]+this.b.position[0]+this.c.position[0],this.centroid[1]=this.a.position[1]+this.b.position[1]+this.c.position[1],this.centroid[2]=this.a.position[2]+this.b.position[2]+this.c.position[2],FSS.Vector3.divideScalar(this.centroid,3),this},computeNormal:function(){return FSS.Vector3.subtractVectors(this.u,this.b.position,this.a.position),FSS.Vector3.subtractVectors(this.v,this.c.position,this.a.position),FSS.Vector3.crossVectors(this.normal,this.u,this.v),FSS.Vector3.normalise(this.normal),this}},FSS.Geometry=function(){this.vertices=[],this.triangles=[],this.dirty=!1},FSS.Geometry.prototype={update:function(){if(this.dirty){var t,e;for(t=this.triangles.length-1;t>=0;t--)e=this.triangles[t],e.computeCentroid(),e.computeNormal();this.dirty=!1}return this}},FSS.Plane=function(t,e,i,n){FSS.Geometry.call(this),this.width=t||100,this.height=e||100,this.segments=i||4,this.slices=n||4,this.segmentWidth=this.width/this.segments,this.sliceHeight=this.height/this.slices;var r,o,a,s,c,l,u,h=[],d=this.width*-.5,f=.5*this.height;for(r=0;this.segments>=r;r++)for(h.push([]),o=0;this.slices>=o;o++)u=new FSS.Vertex(d+r*this.segmentWidth,f-o*this.sliceHeight),h[r].push(u),this.vertices.push(u);for(r=0;this.segments>r;r++)for(o=0;this.slices>o;o++)a=h[r+0][o+0],s=h[r+0][o+1],c=h[r+1][o+0],l=h[r+1][o+1],t0=new FSS.Triangle(a,s,c),t1=new FSS.Triangle(c,s,l),this.triangles.push(t0,t1)},FSS.Plane.prototype=Object.create(FSS.Geometry.prototype),FSS.Material=function(t,e){this.ambient=new FSS.Color(t||"#444444"),this.diffuse=new FSS.Color(e||"#FFFFFF"),this.slave=new FSS.Color},FSS.Mesh=function(t,e){FSS.Object.call(this),this.geometry=t||new FSS.Geometry,this.material=e||new FSS.Material,this.side=FSS.FRONT,this.visible=!0},FSS.Mesh.prototype=Object.create(FSS.Object.prototype),FSS.Mesh.prototype.update=function(t,e){var i,n,r,o,a;if(this.geometry.update(),e)for(i=this.geometry.triangles.length-1;i>=0;i--){for(n=this.geometry.triangles[i],FSS.Vector4.set(n.color.rgba),r=t.length-1;r>=0;r--)o=t[r],FSS.Vector3.subtractVectors(o.ray,o.position,n.centroid),FSS.Vector3.normalise(o.ray),a=FSS.Vector3.dot(n.normal,o.ray),this.side===FSS.FRONT?a=Math.max(a,0):this.side===FSS.BACK?a=Math.abs(Math.min(a,0)):this.side===FSS.DOUBLE&&(a=Math.max(Math.abs(a),0)),FSS.Vector4.multiplyVectors(this.material.slave.rgba,this.material.ambient.rgba,o.ambient.rgba),FSS.Vector4.add(n.color.rgba,this.material.slave.rgba),FSS.Vector4.multiplyVectors(this.material.slave.rgba,this.material.diffuse.rgba,o.diffuse.rgba),FSS.Vector4.multiplyScalar(this.material.slave.rgba,a),FSS.Vector4.add(n.color.rgba,this.material.slave.rgba);FSS.Vector4.clamp(n.color.rgba,0,1)}return this},FSS.Scene=function(){this.meshes=[],this.lights=[]},FSS.Scene.prototype={add:function(t){return t instanceof FSS.Mesh&&!~this.meshes.indexOf(t)?this.meshes.push(t):t instanceof FSS.Light&&!~this.lights.indexOf(t)&&this.lights.push(t),this},remove:function(t){return t instanceof FSS.Mesh&&~this.meshes.indexOf(t)?this.meshes.splice(this.meshes.indexOf(t),1):t instanceof FSS.Light&&~this.lights.indexOf(t)&&this.lights.splice(this.lights.indexOf(t),1),this}},FSS.Renderer=function(){this.width=0,this.height=0,this.halfWidth=0,this.halfHeight=0},FSS.Renderer.prototype={setSize:function(t,e){return this.width!==t||this.height!==e?(this.width=t,this.height=e,this.halfWidth=.5*this.width,this.halfHeight=.5*this.height,this):void 0},clear:function(){return this},render:function(){return this}},FSS.CanvasRenderer=function(){FSS.Renderer.call(this),this.element=document.createElement("canvas"),this.element.style.display="block",this.context=this.element.getContext("2d"),this.setSize(this.element.width,this.element.height)},FSS.CanvasRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.CanvasRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.element.width=t,this.element.height=e,this.context.setTransform(1,0,0,-1,this.halfWidth,this.halfHeight),this},FSS.CanvasRenderer.prototype.clear=function(){return FSS.Renderer.prototype.clear.call(this),this.context.clearRect(-this.halfWidth,-this.halfHeight,this.width,this.height),this},FSS.CanvasRenderer.prototype.render=function(t){FSS.Renderer.prototype.render.call(this,t);var e,i,n,r,o;for(this.clear(),this.context.lineJoin="round",this.context.lineWidth=1,e=t.meshes.length-1;e>=0;e--)if(i=t.meshes[e],i.visible)for(i.update(t.lights,!0),n=i.geometry.triangles.length-1;n>=0;n--)r=i.geometry.triangles[n],o=r.color.format(),this.context.beginPath(),this.context.moveTo(r.a.position[0],r.a.position[1]),this.context.lineTo(r.b.position[0],r.b.position[1]),this.context.lineTo(r.c.position[0],r.c.position[1]),this.context.closePath(),this.context.strokeStyle=o,this.context.fillStyle=o,this.context.stroke(),this.context.fill();return this},FSS.WebGLRenderer=function(){FSS.Renderer.call(this),this.element=document.createElement("canvas"),this.element.style.display="block",this.vertices=null,this.lights=null;var t={preserveDrawingBuffer:!1,premultipliedAlpha:!0,antialias:!0,stencil:!0,alpha:!0};return this.gl=this.getContext(this.element,t),this.unsupported=!this.gl,this.unsupported?"WebGL is not supported by your browser.":(this.gl.clearColor(0,0,0,0),this.gl.enable(this.gl.DEPTH_TEST),void this.setSize(this.element.width,this.element.height))},FSS.WebGLRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.WebGLRenderer.prototype.getContext=function(t,e){var i=!1;try{if(!(i=t.getContext("experimental-webgl",e)))throw"Error creating WebGL context."}catch(n){console.error(n)}return i},FSS.WebGLRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.unsupported?void 0:(this.element.width=t,this.element.height=e,this.gl.viewport(0,0,t,e),this)},FSS.WebGLRenderer.prototype.clear=function(){return FSS.Renderer.prototype.clear.call(this),this.unsupported?void 0:(this.gl.clear(this.gl.COLOR_BUFFER_BIT|this.gl.DEPTH_BUFFER_BIT),this)},FSS.WebGLRenderer.prototype.render=function(t){if(FSS.Renderer.prototype.render.call(this,t),!this.unsupported){var e,i,n,r,o,a,s,c,l,u,h,d,f,m,p,g=!1,v=t.lights.length,b=0;if(this.clear(),this.lights!==v){if(this.lights=v,!(this.lights>0))return;this.buildProgram(v)}if(this.program){for(e=t.meshes.length-1;e>=0;e--)i=t.meshes[e],i.geometry.dirty&&(g=!0),i.update(t.lights,!1),b+=3*i.geometry.triangles.length;if(g||this.vertices!==b){this.vertices=b;for(c in this.program.attributes){for(u=this.program.attributes[c],u.data=new FSS.Array(b*u.size),f=0,e=t.meshes.length-1;e>=0;e--)for(i=t.meshes[e],n=0,r=i.geometry.triangles.length;r>n;n++)for(o=i.geometry.triangles[n],m=0,p=o.vertices.length;p>m;m++){switch(vertex=o.vertices[m],c){case"side":this.setBufferData(f,u,i.side);break;case"position":this.setBufferData(f,u,vertex.position);break;case"centroid":this.setBufferData(f,u,o.centroid);break;case"normal":this.setBufferData(f,u,o.normal);break;case"ambient":this.setBufferData(f,u,i.material.ambient.rgba);break;case"diffuse":this.setBufferData(f,u,i.material.diffuse.rgba)}f++}this.gl.bindBuffer(this.gl.ARRAY_BUFFER,u.buffer),this.gl.bufferData(this.gl.ARRAY_BUFFER,u.data,this.gl.DYNAMIC_DRAW),this.gl.enableVertexAttribArray(u.location),this.gl.vertexAttribPointer(u.location,u.size,this.gl.FLOAT,!1,0,0)}}for(this.setBufferData(0,this.program.uniforms.resolution,[this.width,this.height,this.width]),a=v-1;a>=0;a--)s=t.lights[a],this.setBufferData(a,this.program.uniforms.lightPosition,s.position),this.setBufferData(a,this.program.uniforms.lightAmbient,s.ambient.rgba),this.setBufferData(a,this.program.uniforms.lightDiffuse,s.diffuse.rgba);for(l in this.program.uniforms)switch(u=this.program.uniforms[l],d=u.location,h=u.data,u.structure){case"3f":this.gl.uniform3f(d,h[0],h[1],h[2]);break;case"3fv":this.gl.uniform3fv(d,h);break;case"4fv":this.gl.uniform4fv(d,h)}}return this.gl.drawArrays(this.gl.TRIANGLES,0,this.vertices),this}},FSS.WebGLRenderer.prototype.setBufferData=function(t,e,i){if(FSS.Utils.isNumber(i))e.data[t*e.size]=i;else for(var n=i.length-1;n>=0;n--)e.data[t*e.size+n]=i[n]},FSS.WebGLRenderer.prototype.buildProgram=function(t){if(!this.unsupported){var e=FSS.WebGLRenderer.VS(t),i=FSS.WebGLRenderer.FS(t),n=e+i;if(!this.program||this.program.code!==n){var r=this.gl.createProgram(),o=this.buildShader(this.gl.VERTEX_SHADER,e),a=this.buildShader(this.gl.FRAGMENT_SHADER,i);if(this.gl.attachShader(r,o),this.gl.attachShader(r,a),this.gl.linkProgram(r),!this.gl.getProgramParameter(r,this.gl.LINK_STATUS)){var s=this.gl.getError(),c=this.gl.getProgramParameter(r,this.gl.VALIDATE_STATUS);return console.error("Could not initialise shader.\nVALIDATE_STATUS: "+c+"\nERROR: "+s),null}return this.gl.deleteShader(a),this.gl.deleteShader(o),r.code=n,r.attributes={side:this.buildBuffer(r,"attribute","aSide",1,"f"),position:this.buildBuffer(r,"attribute","aPosition",3,"v3"),centroid:this.buildBuffer(r,"attribute","aCentroid",3,"v3"),normal:this.buildBuffer(r,"attribute","aNormal",3,"v3"),ambient:this.buildBuffer(r,"attribute","aAmbient",4,"v4"),diffuse:this.buildBuffer(r,"attribute","aDiffuse",4,"v4")},r.uniforms={resolution:this.buildBuffer(r,"uniform","uResolution",3,"3f",1),lightPosition:this.buildBuffer(r,"uniform","uLightPosition",3,"3fv",t),lightAmbient:this.buildBuffer(r,"uniform","uLightAmbient",4,"4fv",t),lightDiffuse:this.buildBuffer(r,"uniform","uLightDiffuse",4,"4fv",t)},this.program=r,this.gl.useProgram(this.program),r}}},FSS.WebGLRenderer.prototype.buildShader=function(t,e){if(!this.unsupported){var i=this.gl.createShader(t);return this.gl.shaderSource(i,e),this.gl.compileShader(i),this.gl.getShaderParameter(i,this.gl.COMPILE_STATUS)?i:(console.error(this.gl.getShaderInfoLog(i)),null)}},FSS.WebGLRenderer.prototype.buildBuffer=function(t,e,i,n,r,o){var a={buffer:this.gl.createBuffer(),size:n,structure:r,data:null};switch(e){case"attribute":a.location=this.gl.getAttribLocation(t,i);break;case"uniform":a.location=this.gl.getUniformLocation(t,i)}return o&&(a.data=new FSS.Array(o*n)),a},FSS.WebGLRenderer.VS=function(t){var e=["precision mediump float;","#define LIGHTS "+t,"attribute float aSide;","attribute vec3 aPosition;","attribute vec3 aCentroid;","attribute vec3 aNormal;","attribute vec4 aAmbient;","attribute vec4 aDiffuse;","uniform vec3 uResolution;","uniform vec3 uLightPosition[LIGHTS];","uniform vec4 uLightAmbient[LIGHTS];","uniform vec4 uLightDiffuse[LIGHTS];","varying vec4 vColor;","void main() {","vColor = vec4(0.0);","vec3 position = aPosition / uResolution * 2.0;","for (int i = 0; i < LIGHTS; i++) {","vec3 lightPosition = uLightPosition[i];","vec4 lightAmbient = uLightAmbient[i];","vec4 lightDiffuse = uLightDiffuse[i];","vec3 ray = normalize(lightPosition - aCentroid);","float illuminance = dot(aNormal, ray);","if (aSide == 0.0) {","illuminance = max(illuminance, 0.0);","} else if (aSide == 1.0) {","illuminance = abs(min(illuminance, 0.0));","} else if (aSide == 2.0) {","illuminance = max(abs(illuminance), 0.0);","}","vColor += aAmbient * lightAmbient;","vColor += aDiffuse * lightDiffuse * illuminance;","}","vColor = clamp(vColor, 0.0, 1.0);","gl_Position = vec4(position, 1.0);","}"].join("\n");return e},FSS.WebGLRenderer.FS=function(){var t=["precision mediump float;","varying vec4 vColor;","void main() {","gl_FragColor = vColor;","}"].join("\n");return t},FSS.SVGRenderer=function(){FSS.Renderer.call(this),this.element=document.createElementNS(FSS.SVGNS,"svg"),this.element.setAttribute("xmlns",FSS.SVGNS),this.element.setAttribute("version","1.1"),this.element.style.display="block",this.setSize(300,150)},FSS.SVGRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.SVGRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.element.setAttribute("width",t),this.element.setAttribute("height",e),this},FSS.SVGRenderer.prototype.clear=function(){FSS.Renderer.prototype.clear.call(this);for(var t=this.element.childNodes.length-1;t>=0;t--)this.element.removeChild(this.element.childNodes[t]);return this},FSS.SVGRenderer.prototype.render=function(t){FSS.Renderer.prototype.render.call(this,t);var e,i,n,r,o,a;for(e=t.meshes.length-1;e>=0;e--)if(i=t.meshes[e],i.visible)for(i.update(t.lights,!0),n=i.geometry.triangles.length-1;n>=0;n--)r=i.geometry.triangles[n],r.polygon.parentNode!==this.element&&this.element.appendChild(r.polygon),o=this.formatPoint(r.a)+" ",o+=this.formatPoint(r.b)+" ",o+=this.formatPoint(r.c),a=this.formatStyle(r.color.format()),r.polygon.setAttributeNS(null,"points",o),r.polygon.setAttributeNS(null,"style",a);return this},FSS.SVGRenderer.prototype.formatPoint=function(t){return this.halfWidth+t.position[0]+","+(this.halfHeight-t.position[1])},FSS.SVGRenderer.prototype.formatStyle=function(t){var e="fill:"+t+";";return e+="stroke:"+t+";"}}function initBackground(){function t(){e(),n(),r(),o(),u(),a(m.offsetWidth,m.offsetHeight),s()}function e(){F=new FSS.WebGLRenderer,C=new FSS.CanvasRenderer,k=new FSS.SVGRenderer,i(config.background.RENDER.renderer)}function i(t){v&&p.removeChild(v.element),v=C,v.setSize(m.offsetWidth,m.offsetHeight),p.appendChild(v.element)}function n(){b=new FSS.Scene}function r(){b.remove(y),v.clear(),S=new FSS.Plane(config.background.MESH.width*v.width,config.background.MESH.height*v.height,config.background.MESH.segments,config.background.MESH.slices),w=new FSS.Material(config.background.MESH.ambient,config.background.MESH.diffuse),y=new FSS.Mesh(S,w),b.add(y);var t,e;for(t=S.vertices.length-1;t>=0;t--)e=S.vertices[t],e.anchor=FSS.Vector3.clone(e.position),e.step=FSS.Vector3.create(Math.randomInRange(.2,1),Math.randomInRange(.2,1),Math.randomInRange(.2,1)),e.time=Math.randomInRange(0,Math.PIM2)}function o(){var t,e;for(t=b.lights.length-1;t>=0;t--)e=b.lights[t],b.remove(e);for(v.clear(),t=0;t<config.background.LIGHT.count;t++)e=new FSS.Light(config.background.LIGHT.ambient,config.background.LIGHT.diffuse),e.ambientHex=e.ambient.format(),e.diffuseHex=e.diffuse.format(),b.add(e),e.mass=Math.randomInRange(.5,1),e.velocity=FSS.Vector3.create(),e.acceleration=FSS.Vector3.create(),e.force=FSS.Vector3.create(),e.ring=document.createElementNS(FSS.SVGNS,"circle"),e.ring.setAttributeNS(null,"stroke",e.ambientHex),e.ring.setAttributeNS(null,"stroke-width","0.5"),e.ring.setAttributeNS(null,"fill","none"),e.ring.setAttributeNS(null,"r","10"),e.core=document.createElementNS(FSS.SVGNS,"circle"),e.core.setAttributeNS(null,"fill",e.diffuseHex),e.core.setAttributeNS(null,"r","4")}function a(t,e){v.setSize(t,e),FSS.Vector3.set(T,v.halfWidth,v.halfHeight),r()}function s(){g=Date.now()-E,c(),l(),requestAnimationFrame(s)}function c(){var t,e,i,n,r,o,a,s=config.background.MESH.depth/2;for(FSS.Vector3.copy(config.background.LIGHT.bounds,T),FSS.Vector3.multiplyScalar(config.background.LIGHT.bounds,config.background.LIGHT.xyScalar),FSS.Vector3.setZ($,config.background.LIGHT.zOffset),config.background.LIGHT.autopilot&&(t=Math.sin(config.background.LIGHT.step[0]*g*config.background.LIGHT.speed),e=Math.cos(config.background.LIGHT.step[1]*g*config.background.LIGHT.speed),FSS.Vector3.set($,config.background.LIGHT.bounds[0]*t,config.background.LIGHT.bounds[1]*e,config.background.LIGHT.zOffset)),n=b.lights.length-1;n>=0;n--){r=b.lights[n],FSS.Vector3.setZ(r.position,config.background.LIGHT.zOffset);var c=Math.clamp(FSS.Vector3.distanceSquared(r.position,$),config.background.LIGHT.minDistance,config.background.LIGHT.maxDistance),l=config.background.LIGHT.gravity*r.mass/c;FSS.Vector3.subtractVectors(r.force,$,r.position),FSS.Vector3.normalise(r.force),FSS.Vector3.multiplyScalar(r.force,l),FSS.Vector3.set(r.acceleration),FSS.Vector3.add(r.acceleration,r.force),FSS.Vector3.add(r.velocity,r.acceleration),FSS.Vector3.multiplyScalar(r.velocity,config.background.LIGHT.dampening),FSS.Vector3.limit(r.velocity,config.background.LIGHT.minLimit,config.background.LIGHT.maxLimit),FSS.Vector3.add(r.position,r.velocity)}for(o=S.vertices.length-1;o>=0;o--)a=S.vertices[o],t=Math.sin(a.time+a.step[0]*g*config.background.MESH.speed),e=Math.cos(a.time+a.step[1]*g*config.background.MESH.speed),i=Math.sin(a.time+a.step[2]*g*config.background.MESH.speed),FSS.Vector3.set(a.position,config.background.MESH.xRange*S.segmentWidth*t,config.background.MESH.yRange*S.sliceHeight*e,config.background.MESH.zRange*s*i-s),FSS.Vector3.add(a.position,a.anchor);S.dirty=!0}function l(){if(v.render(b),config.background.LIGHT.draw){var t,e,i,n;for(t=b.lights.length-1;t>=0;t--)switch(n=b.lights[t],e=n.position[0],i=n.position[1],config.background.RENDER.renderer){case CANVAS:v.context.lineWidth=.5,v.context.beginPath(),v.context.arc(e,i,10,0,Math.PIM2),v.context.strokeStyle=n.ambientHex,v.context.stroke(),v.context.beginPath(),v.context.arc(e,i,4,0,Math.PIM2),v.context.fillStyle=n.diffuseHex,v.context.fill();break;case SVG:e+=v.halfWidth,i=v.halfHeight-i,n.core.setAttributeNS(null,"fill",n.diffuseHex),n.core.setAttributeNS(null,"cx",e),n.core.setAttributeNS(null,"cy",i),v.element.appendChild(n.core),n.ring.setAttributeNS(null,"stroke",n.ambientHex),n.ring.setAttributeNS(null,"cx",e),n.ring.setAttributeNS(null,"cy",i),v.element.appendChild(n.ring)}}}function u(){window.addEventListener("resize",f),m.addEventListener("click",h),m.addEventListener("mousemove",d)}function h(t){config.background.LIGHT.followMouseClicks&&(FSS.Vector3.set($,t.x,v.height-t.y),FSS.Vector3.subtract($,T),config.background.LIGHT.autopilot=!config.background.LIGHT.autopilot,x.updateDisplay())}function d(t){FSS.Vector3.set($,t.x,v.height-t.y),FSS.Vector3.subtract($,T)}function f(t){a(m.offsetWidth,m.offsetHeight),l()}var m=document.getElementById("background-container"),p=document.getElementById("background-output");if(config.background.enabled){initPlugin(),config.background.LIGHT.bounds=FSS.Vector3.create(),config.background.LIGHT.step=FSS.Vector3.create(Math.randomInRange(.2,1),Math.randomInRange(.2,1),Math.randomInRange(.2,1));var g,v,b,y,S,w,F,C,k,x,E=Date.now(),T=FSS.Vector3.create(),$=FSS.Vector3.create();t()}}!function(){for(var t,e=function(){},i=["assert","clear","count","debug","dir","dirxml","error","exception","group","groupCollapsed","groupEnd","info","log","markTimeline","profile","profileEnd","table","time","timeEnd","timeline","timelineEnd","timeStamp","trace","warn"],n=i.length,r=window.console=window.console||{};n--;)t=i[n],r[t]||(r[t]=e)}(),$(function(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")}}),$("[data-method]").append(function(){return"\n<form action='"+$(this).attr("href")+"' method='POST' name='delete_item' style='display:none'>\n   <input type='hidden' name='_method' value='"+$(this).attr("data-method")+"'>\n   <input type='hidden' name='_token' value='"+$('meta[name="_token"]').attr("content")+"'>\n</form>\n"}).removeAttr("href").attr("style","cursor:pointer;").attr("onclick",'$(this).find("form").submit();'),$("form[name=delete_item]").submit(function(){return confirm("Are you sure you want to delete this item?")}),$('[data-toggle="tooltip"]').tooltip(),$('[data-toggle="popover"]').popover(),$("body").on("click",function(t){$('[data-toggle="popover"]').each(function(){$(this).is(t.target)||0!==$(this).has(t.target).length||0!==$(".popover").has(t.target).length||$(this).popover("hide")})})}),$(function(){}),function(t,e,i){t.fn.backstretch=function(n,r){return(n===i||0===n.length)&&t.error("No images were supplied for Backstretch"),0===t(e).scrollTop()&&e.scrollTo(0,0),this.each(function(){var e=t(this),i=e.data("backstretch");if(i){if("string"==typeof n&&"function"==typeof i[n])return void i[n](r);r=t.extend(i.options,r),i.destroy(!0)}i=new o(this,n,r),e.data("backstretch",i)})},t.backstretch=function(e,i){return t("body").backstretch(e,i).data("backstretch")},t.expr[":"].backstretch=function(e){return t(e).data("backstretch")!==i},t.fn.backstretch.defaults={centeredX:!0,centeredY:!0,duration:5e3,fade:0};var n={left:0,top:0,overflow:"hidden",margin:0,padding:0,height:"100%",width:"100%",zIndex:-999999},r={position:"absolute",display:"none",margin:0,padding:0,border:"none",width:"auto",height:"auto",maxHeight:"none",maxWidth:"none",zIndex:-999999},o=function(i,r,o){this.options=t.extend({},t.fn.backstretch.defaults,o||{}),this.images=t.isArray(r)?r:[r],t.each(this.images,function(){t("<img />")[0].src=this}),this.isBody=i===document.body,this.$container=t(i),this.$root=this.isBody?t(a?e:document):this.$container,i=this.$container.children(".backstretch").first(),this.$wrap=i.length?i:t('<div class="backstretch"></div>').css(n).appendTo(this.$container),this.isBody||(i=this.$container.css("position"),r=this.$container.css("zIndex"),this.$container.css({position:"static"===i?"relative":i,zIndex:"auto"===r?0:r,background:"none"}),this.$wrap.css({zIndex:-999998})),this.$wrap.css({position:this.isBody&&a?"fixed":"absolute"}),this.index=0,this.show(this.index),t(e).on("resize.backstretch",t.proxy(this.resize,this)).on("orientationchange.backstretch",t.proxy(function(){this.isBody&&0===e.pageYOffset&&(e.scrollTo(0,1),this.resize())},this))};o.prototype={resize:function(){try{var t,i={left:0,top:0},n=this.isBody?this.$root.width():this.$root.innerWidth(),r=n,o=this.isBody?e.innerHeight?e.innerHeight:this.$root.height():this.$root.innerHeight(),a=r/this.$img.data("ratio");a>=o?(t=(a-o)/2,this.options.centeredY&&(i.top="-"+t+"px")):(a=o,r=a*this.$img.data("ratio"),t=(r-n)/2,this.options.centeredX&&(i.left="-"+t+"px")),this.$wrap.css({width:n,height:o}).find("img:not(.deleteable)").css({width:r,height:a}).css(i)}catch(s){}return this},show:function(e){if(!(Math.abs(e)>this.images.length-1)){var i=this,n=i.$wrap.find("img").addClass("deleteable"),o={relatedTarget:i.$container[0]};return i.$container.trigger(t.Event("backstretch.before",o),[i,e]),this.index=e,clearInterval(i.interval),i.$img=t("<img />").css(r).bind("load",function(r){var a=this.width||t(r.target).width();r=this.height||t(r.target).height(),t(this).data("ratio",a/r),t(this).fadeIn(i.options.speed||i.options.fade,function(){n.remove(),i.paused||i.cycle(),t(["after","show"]).each(function(){i.$container.trigger(t.Event("backstretch."+this,o),[i,e])})}),i.resize()}).appendTo(i.$wrap),i.$img.attr("src",i.images[e]),i}},next:function(){return this.show(this.index<this.images.length-1?this.index+1:0)},prev:function(){return this.show(0===this.index?this.images.length-1:this.index-1)},pause:function(){return this.paused=!0,this},resume:function(){return this.paused=!1,this.next(),this},cycle:function(){return 1<this.images.length&&(clearInterval(this.interval),this.interval=setInterval(t.proxy(function(){this.paused||this.next()},this),this.options.duration)),this},destroy:function(i){t(e).off("resize.backstretch orientationchange.backstretch"),clearInterval(this.interval),i||this.$wrap.remove(),this.$container.removeData("backstretch")}};var a,s=navigator.userAgent,c=navigator.platform,l=s.match(/AppleWebKit\/([0-9]+)/),l=!!l&&l[1],u=s.match(/Fennec\/([0-9]+)/),u=!!u&&u[1],h=s.match(/Opera Mobi\/([0-9]+)/),d=!!h&&h[1],f=s.match(/MSIE ([0-9]+)/),f=!!f&&f[1];a=!((-1<c.indexOf("iPhone")||-1<c.indexOf("iPad")||-1<c.indexOf("iPod"))&&l&&534>l||e.operamini&&"[object OperaMini]"==={}.toString.call(e.operamini)||h&&7458>d||-1<s.indexOf("Android")&&l&&533>l||u&&6>u||"palmGetResource"in e&&l&&534>l||-1<s.indexOf("MeeGo")&&-1<s.indexOf("NokiaBrowser/8.5.0")||f&&6>=f)}(jQuery,window),$(function(){"use strict";$(".js-fullheight-body").backstretch(["../images/backgrounds/fullscreen.jpg"]),$(".js-landing-hero").backstretch(["../images/backgrounds/landing-hero.jpg"]),$(".js-thankyou-page").backstretch(["../images/backgrounds/landing-hero.jpg"]),
$("#welcome_secondary_text").backstretch(["../images/backgrounds/welcome.jpg"]),$(".js-about-hero").backstretch(["../images/about/ryersonslc.jpg"]),$(".welcome-division-all-img").backstretch(["../images/backgrounds/divisions/all.jpg"]),$(".welcome-division-health-img").backstretch(["../images/backgrounds/divisions/health.jpg"]),$(".welcome-division-science-img").backstretch(["../images/backgrounds/divisions/science.jpg"]),$(".welcome-division-response-img").backstretch(["../images/backgrounds/divisions/response.jpg"]),$(".welcome-division-security-img").backstretch(["../images/backgrounds/divisions/security.jpg"]),$(".welcome-division-continuity-img").backstretch(["../images/backgrounds/divisions/continuity.jpg"]),$(".welcome-division-humanitarian-img").backstretch(["../images/backgrounds/divisions/humanitarian.jpg"])}),$(document).ready(function(){$(".map").maphilight({fade:!0})});var countries=["canada","united_states","australia"],currentCountry,counter=0;$("select#country").change(function(){if(null!==$("select#country").val()){var t=$("select#country").val(),e=t.toLowerCase();e=e.replace(/ /g,"_"),currentCountry=e,$("tr").addClass("out"),$("tr").removeClass("in"),$("tr."+e).addClass("in"),$("tr."+e).removeClass("out"),fillRegions(e);var i="<option value='' disabled selected>Select One</option>; "+fillRegions(e);document.getElementById("region").innerHTML=i,document.getElementById("regionFormGroup").style.display="",$(".mapContainer").hide(),"new_zealand"==e?document.getElementById("mapListing").style.display="":"canada"==e?document.getElementById("canada_map").style.marginTop="-150px":"australia"==e&&(document.getElementById("australia_map").style.marginTop="-15px"),$("#"+e+"_map").show(),document.getElementById(e+"_map").style.visibility="",document.getElementById(e+"_map").style.height="",$("#backButton").attr("onclick","window.location.reload()"),document.getElementById("backButton").style.display="",document.getElementById("divisionFormGroup").style.display="",document.getElementById("countryFormGroup").style.display="none"}}),$("select#division").change(function(){if(null!=$("select#division").val()){var t,e=$("select#division").val();$("td.division_tags").each(function(){t=this.innerHTML,console.log(t),-1==t.indexOf(e)&&($(this).parent().addClass("out"),$(this).parent().removeClass("in"))}),$(".mapContainer").hide(),document.getElementById("mapListing").style.display="",$("#backButton").prop("onclick","firstFilterF('"+currentCountry+"')")}}),$("select#keyword").change(function(){if(null!=$("select#keyword").val()){var t=$("select#keyword").val();t=t.toLowerCase(),alert(t);var e;$("td.keyword_tags").each(function(){e=$(this).html(),-1==e.indexOf(t)&&($(this).parent().removeClass("in"),$(this).parent().addClass("out"))}),$(".mapContainer").hide(),document.getElementById("mapListing").style.display="",$("#backButton").prop("onclick","firstFilterF('"+currentCountry+"')")}}),$("select#region").change(function(){if(null!==$("select#region").val()){var t=$("select#region").val(),e=t.toLowerCase();e=e.replace(/ -/g,"_"),$("tr").addClass("out"),$("tr").removeClass("in"),$("tr."+e).addClass("in"),$("tr."+e).removeClass("out"),$(".mapContainer").hide(),document.getElementById("mapListing").style.display="",$("#backButton").attr("onclick","firstFilterF('"+currentCountry+"')")}}),window.Modernizr=function(t,e,i){function n(t){y.cssText=t}function r(t,e){return n(C.join(t+";")+(e||""))}function o(t,e){return typeof t===e}function a(t,e){return!!~(""+t).indexOf(e)}function s(t,e){for(var n in t){var r=t[n];if(!a(r,"-")&&y[r]!==i)return"pfx"==e?r:!0}return!1}function c(t,e,n){for(var r in t){var a=e[t[r]];if(a!==i)return n===!1?t[r]:o(a,"function")?a.bind(n||e):a}return!1}function l(t,e,i){var n=t.charAt(0).toUpperCase()+t.slice(1),r=(t+" "+x.join(n+" ")+n).split(" ");return o(e,"string")||o(e,"undefined")?s(r,e):(r=(t+" "+E.join(n+" ")+n).split(" "),c(r,e,i))}function u(){m.input=function(i){for(var n=0,r=i.length;r>n;n++)A[i[n]]=i[n]in S;return A.list&&(A.list=!!e.createElement("datalist")&&!!t.HTMLDataListElement),A}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),m.inputtypes=function(t){for(var n,r,o,a=0,s=t.length;s>a;a++)S.setAttribute("type",r=t[a]),n="text"!==S.type,n&&(S.value=w,S.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(r)&&S.style.WebkitAppearance!==i?(g.appendChild(S),o=e.defaultView,n=o.getComputedStyle&&"textfield"!==o.getComputedStyle(S,null).WebkitAppearance&&0!==S.offsetHeight,g.removeChild(S)):/^(search|tel)$/.test(r)||(n=/^(url|email)$/.test(r)?S.checkValidity&&S.checkValidity()===!1:S.value!=w)),L[t[a]]=!!n;return L}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var h,d,f="2.8.3",m={},p=!0,g=e.documentElement,v="modernizr",b=e.createElement(v),y=b.style,S=e.createElement("input"),w=":)",F={}.toString,C=" -webkit- -moz- -o- -ms- ".split(" "),k="Webkit Moz O ms",x=k.split(" "),E=k.toLowerCase().split(" "),T={svg:"http://www.w3.org/2000/svg"},$={},L={},A={},I=[],M=I.slice,R=function(t,i,n,r){var o,a,s,c,l=e.createElement("div"),u=e.body,h=u||e.createElement("body");if(parseInt(n,10))for(;n--;)s=e.createElement("div"),s.id=r?r[n]:v+(n+1),l.appendChild(s);return o=["&#173;",'<style id="s',v,'">',t,"</style>"].join(""),l.id=v,(u?l:h).innerHTML+=o,h.appendChild(l),u||(h.style.background="",h.style.overflow="hidden",c=g.style.overflow,g.style.overflow="hidden",g.appendChild(h)),a=i(l,t),u?l.parentNode.removeChild(l):(h.parentNode.removeChild(h),g.style.overflow=c),!!a},H=function(e){var i=t.matchMedia||t.msMatchMedia;if(i)return i(e)&&i(e).matches||!1;var n;return R("@media "+e+" { #"+v+" { position: absolute; } }",function(e){n="absolute"==(t.getComputedStyle?getComputedStyle(e,null):e.currentStyle).position}),n},B=function(){function t(t,r){r=r||e.createElement(n[t]||"div"),t="on"+t;var a=t in r;return a||(r.setAttribute||(r=e.createElement("div")),r.setAttribute&&r.removeAttribute&&(r.setAttribute(t,""),a=o(r[t],"function"),o(r[t],"undefined")||(r[t]=i),r.removeAttribute(t))),r=null,a}var n={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return t}(),V={}.hasOwnProperty;d=o(V,"undefined")||o(V.call,"undefined")?function(t,e){return e in t&&o(t.constructor.prototype[e],"undefined")}:function(t,e){return V.call(t,e)},Function.prototype.bind||(Function.prototype.bind=function(t){var e=this;if("function"!=typeof e)throw new TypeError;var i=M.call(arguments,1),n=function(){if(this instanceof n){var r=function(){};r.prototype=e.prototype;var o=new r,a=e.apply(o,i.concat(M.call(arguments)));return Object(a)===a?a:o}return e.apply(t,i.concat(M.call(arguments)))};return n}),$.flexbox=function(){return l("flexWrap")},$.canvas=function(){var t=e.createElement("canvas");return!!t.getContext&&!!t.getContext("2d")},$.canvastext=function(){return!!m.canvas&&!!o(e.createElement("canvas").getContext("2d").fillText,"function")},$.webgl=function(){return!!t.WebGLRenderingContext},$.touch=function(){var i;return"ontouchstart"in t||t.DocumentTouch&&e instanceof DocumentTouch?i=!0:R(["@media (",C.join("touch-enabled),("),v,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(t){i=9===t.offsetTop}),i},$.geolocation=function(){return"geolocation"in navigator},$.postmessage=function(){return!!t.postMessage},$.websqldatabase=function(){return!!t.openDatabase},$.indexedDB=function(){return!!l("indexedDB",t)},$.hashchange=function(){return B("hashchange",t)&&(e.documentMode===i||e.documentMode>7)},$.history=function(){return!!t.history&&!!history.pushState},$.draganddrop=function(){var t=e.createElement("div");return"draggable"in t||"ondragstart"in t&&"ondrop"in t},$.websockets=function(){return"WebSocket"in t||"MozWebSocket"in t},$.rgba=function(){return n("background-color:rgba(150,255,150,.5)"),a(y.backgroundColor,"rgba")},$.hsla=function(){return n("background-color:hsla(120,40%,100%,.5)"),a(y.backgroundColor,"rgba")||a(y.backgroundColor,"hsla")},$.multiplebgs=function(){return n("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(y.background)},$.backgroundsize=function(){return l("backgroundSize")},$.borderimage=function(){return l("borderImage")},$.borderradius=function(){return l("borderRadius")},$.boxshadow=function(){return l("boxShadow")},$.textshadow=function(){return""===e.createElement("div").style.textShadow},$.opacity=function(){return r("opacity:.55"),/^0.55$/.test(y.opacity)},$.cssanimations=function(){return l("animationName")},$.csscolumns=function(){return l("columnCount")},$.cssgradients=function(){var t="background-image:",e="gradient(linear,left top,right bottom,from(#9f9),to(white));",i="linear-gradient(left top,#9f9, white);";return n((t+"-webkit- ".split(" ").join(e+t)+C.join(i+t)).slice(0,-t.length)),a(y.backgroundImage,"gradient")},$.cssreflections=function(){return l("boxReflect")},$.csstransforms=function(){return!!l("transform")},$.csstransforms3d=function(){var t=!!l("perspective");return t&&"webkitPerspective"in g.style&&R("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(e,i){t=9===e.offsetLeft&&3===e.offsetHeight}),t},$.csstransitions=function(){return l("transition")},$.fontface=function(){var t;return R('@font-face {font-family:"font";src:url("https://")}',function(i,n){var r=e.getElementById("smodernizr"),o=r.sheet||r.styleSheet,a=o?o.cssRules&&o.cssRules[0]?o.cssRules[0].cssText:o.cssText||"":"";t=/src/i.test(a)&&0===a.indexOf(n.split(" ")[0])}),t},$.generatedcontent=function(){var t;return R(["#",v,"{font:0/0 a}#",v,':after{content:"',w,'";visibility:hidden;font:3px/1 a}'].join(""),function(e){t=e.offsetHeight>=3}),t},$.video=function(){var t=e.createElement("video"),i=!1;try{(i=!!t.canPlayType)&&(i=new Boolean(i),i.ogg=t.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),i.h264=t.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),i.webm=t.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,""))}catch(n){}return i},$.audio=function(){var t=e.createElement("audio"),i=!1;try{(i=!!t.canPlayType)&&(i=new Boolean(i),i.ogg=t.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),i.mp3=t.canPlayType("audio/mpeg;").replace(/^no$/,""),i.wav=t.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),i.m4a=(t.canPlayType("audio/x-m4a;")||t.canPlayType("audio/aac;")).replace(/^no$/,""))}catch(n){}return i},$.localstorage=function(){try{return localStorage.setItem(v,v),localStorage.removeItem(v),!0}catch(t){return!1}},$.sessionstorage=function(){try{return sessionStorage.setItem(v,v),sessionStorage.removeItem(v),!0}catch(t){return!1}},$.webworkers=function(){return!!t.Worker},$.applicationcache=function(){return!!t.applicationCache},$.svg=function(){return!!e.createElementNS&&!!e.createElementNS(T.svg,"svg").createSVGRect},$.inlinesvg=function(){var t=e.createElement("div");return t.innerHTML="<svg/>",(t.firstChild&&t.firstChild.namespaceURI)==T.svg},$.smil=function(){return!!e.createElementNS&&/SVGAnimate/.test(F.call(e.createElementNS(T.svg,"animate")))},$.svgclippaths=function(){return!!e.createElementNS&&/SVGClipPath/.test(F.call(e.createElementNS(T.svg,"clipPath")))};for(var N in $)d($,N)&&(h=N.toLowerCase(),m[h]=$[N](),I.push((m[h]?"":"no-")+h));return m.input||u(),m.addTest=function(t,e){if("object"==typeof t)for(var n in t)d(t,n)&&m.addTest(n,t[n]);else{if(t=t.toLowerCase(),m[t]!==i)return m;e="function"==typeof e?e():e,"undefined"!=typeof p&&p&&(g.className+=" "+(e?"":"no-")+t),m[t]=e}return m},n(""),b=S=null,function(t,e){function i(t,e){var i=t.createElement("p"),n=t.getElementsByTagName("head")[0]||t.documentElement;return i.innerHTML="x<style>"+e+"</style>",n.insertBefore(i.lastChild,n.firstChild)}function n(){var t=b.elements;return"string"==typeof t?t.split(" "):t}function r(t){var e=v[t[p]];return e||(e={},g++,t[p]=g,v[g]=e),e}function o(t,i,n){if(i||(i=e),u)return i.createElement(t);n||(n=r(i));var o;return o=n.cache[t]?n.cache[t].cloneNode():m.test(t)?(n.cache[t]=n.createElem(t)).cloneNode():n.createElem(t),!o.canHaveChildren||f.test(t)||o.tagUrn?o:n.frag.appendChild(o)}function a(t,i){if(t||(t=e),u)return t.createDocumentFragment();i=i||r(t);for(var o=i.frag.cloneNode(),a=0,s=n(),c=s.length;c>a;a++)o.createElement(s[a]);return o}function s(t,e){e.cache||(e.cache={},e.createElem=t.createElement,e.createFrag=t.createDocumentFragment,e.frag=e.createFrag()),t.createElement=function(i){return b.shivMethods?o(i,t,e):e.createElem(i)},t.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+n().join().replace(/[\w\-]+/g,function(t){return e.createElem(t),e.frag.createElement(t),'c("'+t+'")'})+");return n}")(b,e.frag)}function c(t){t||(t=e);var n=r(t);return b.shivCSS&&!l&&!n.hasCSS&&(n.hasCSS=!!i(t,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),u||s(t,n),t}var l,u,h="3.7.0",d=t.html5||{},f=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,m=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,p="_html5shiv",g=0,v={};!function(){try{var t=e.createElement("a");t.innerHTML="<xyz></xyz>",l="hidden"in t,u=1==t.childNodes.length||function(){e.createElement("a");var t=e.createDocumentFragment();return"undefined"==typeof t.cloneNode||"undefined"==typeof t.createDocumentFragment||"undefined"==typeof t.createElement}()}catch(i){l=!0,u=!0}}();var b={elements:d.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:h,shivCSS:d.shivCSS!==!1,supportsUnknownElements:u,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:c,createElement:o,createDocumentFragment:a};t.html5=b,c(e)}(this,e),m._version=f,m._prefixes=C,m._domPrefixes=E,m._cssomPrefixes=x,m.mq=H,m.hasEvent=B,m.testProp=function(t){return s([t])},m.testAllProps=l,m.testStyles=R,m.prefixed=function(t,e,i){return e?l(t,e,i):l(t,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(p?" js "+I.join(" "):""),m}(this,this.document),function(t,e,i){function n(t){return"[object Function]"==g.call(t)}function r(t){return"string"==typeof t}function o(){}function a(t){return!t||"loaded"==t||"complete"==t||"uninitialized"==t}function s(){var t=v.shift();b=1,t?t.t?m(function(){("c"==t.t?d.injectCss:d.injectJs)(t.s,0,t.a,t.x,t.e,1)},0):(t(),s()):b=0}function c(t,i,n,r,o,c,l){function u(e){if(!f&&a(h.readyState)&&(y.r=f=1,!b&&s(),h.onload=h.onreadystatechange=null,e)){"img"!=t&&m(function(){w.removeChild(h)},50);for(var n in E[i])E[i].hasOwnProperty(n)&&E[i][n].onload()}}var l=l||d.errorTimeout,h=e.createElement(t),f=0,g=0,y={t:n,s:i,e:o,a:c,x:l};1===E[i]&&(g=1,E[i]=[]),"object"==t?h.data=i:(h.src=i,h.type=t),h.width=h.height="0",h.onerror=h.onload=h.onreadystatechange=function(){u.call(this,g)},v.splice(r,0,y),"img"!=t&&(g||2===E[i]?(w.insertBefore(h,S?null:p),m(u,l)):E[i].push(h))}function l(t,e,i,n,o){return b=0,e=e||"j",r(t)?c("c"==e?C:F,t,e,this.i++,i,n,o):(v.splice(this.i++,0,t),1==v.length&&s()),this}function u(){var t=d;return t.loader={load:l,i:0},t}var h,d,f=e.documentElement,m=t.setTimeout,p=e.getElementsByTagName("script")[0],g={}.toString,v=[],b=0,y="MozAppearance"in f.style,S=y&&!!e.createRange().compareNode,w=S?f:p.parentNode,f=t.opera&&"[object Opera]"==g.call(t.opera),f=!!e.attachEvent&&!f,F=y?"object":f?"script":"img",C=f?"script":F,k=Array.isArray||function(t){return"[object Array]"==g.call(t)},x=[],E={},T={timeout:function(t,e){return e.length&&(t.timeout=e[0]),t}};d=function(t){function e(t){var e,i,n,t=t.split("!"),r=x.length,o=t.pop(),a=t.length,o={url:o,origUrl:o,prefixes:t};for(i=0;a>i;i++)n=t[i].split("="),(e=T[n.shift()])&&(o=e(o,n));for(i=0;r>i;i++)o=x[i](o);return o}function a(t,r,o,a,s){var c=e(t),l=c.autoCallback;c.url.split(".").pop().split("?").shift(),c.bypass||(r&&(r=n(r)?r:r[t]||r[a]||r[t.split("/").pop().split("?")[0]]),c.instead?c.instead(t,r,o,a,s):(E[c.url]?c.noexec=!0:E[c.url]=1,o.load(c.url,c.forceCSS||!c.forceJS&&"css"==c.url.split(".").pop().split("?").shift()?"c":i,c.noexec,c.attrs,c.timeout),(n(r)||n(l))&&o.load(function(){u(),r&&r(c.origUrl,s,a),l&&l(c.origUrl,s,a),E[c.url]=2})))}function s(t,e){function i(t,i){if(t){if(r(t))i||(h=function(){var t=[].slice.call(arguments);d.apply(this,t),f()}),a(t,h,e,0,l);else if(Object(t)===t)for(c in s=function(){var e,i=0;for(e in t)t.hasOwnProperty(e)&&i++;return i}(),t)t.hasOwnProperty(c)&&(!i&&!--s&&(n(h)?h=function(){var t=[].slice.call(arguments);d.apply(this,t),f()}:h[c]=function(t){return function(){var e=[].slice.call(arguments);t&&t.apply(this,e),f()}}(d[c])),a(t[c],h,e,c,l))}else!i&&f()}var s,c,l=!!t.test,u=t.load||t.both,h=t.callback||o,d=h,f=t.complete||o;i(l?t.yep:t.nope,!!u),u&&i(u)}var c,l,h=this.yepnope.loader;if(r(t))a(t,0,h,0);else if(k(t))for(c=0;c<t.length;c++)l=t[c],r(l)?a(l,0,h,0):k(l)?d(l):Object(l)===l&&s(l,h);else Object(t)===t&&s(t,h)},d.addPrefix=function(t,e){T[t]=e},d.addFilter=function(t){x.push(t)},d.errorTimeout=1e4,null==e.readyState&&e.addEventListener&&(e.readyState="loading",e.addEventListener("DOMContentLoaded",h=function(){e.removeEventListener("DOMContentLoaded",h,0),e.readyState="complete"},0)),t.yepnope=u(),t.yepnope.executeStack=s,t.yepnope.injectJs=function(t,i,n,r,c,l){var u,h,f=e.createElement("script"),r=r||d.errorTimeout;f.src=t;for(h in n)f.setAttribute(h,n[h]);i=l?s:i||o,f.onreadystatechange=f.onload=function(){!u&&a(f.readyState)&&(u=1,i(),f.onload=f.onreadystatechange=null)},m(function(){u||(u=1,i(1))},r),c?f.onload():p.parentNode.insertBefore(f,p)},t.yepnope.injectCss=function(t,i,n,r,a,c){var l,r=e.createElement("link"),i=c?s:i||o;r.href=t,r.rel="stylesheet",r.type="text/css";for(l in n)r.setAttribute(l,n[l]);a||(p.parentNode.insertBefore(r,p),m(i,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))},function(t){t.fn.zclip=function(e){if("object"==typeof e&&!e.length){var i=t.extend({path:"ZeroClipboard.swf",copy:null,beforeCopy:null,afterCopy:null,clickAfter:!0,setHandCursor:!0,setCSSEffects:!0},e);return this.each(function(){var e=t(this);if(e.is(":visible")&&("string"==typeof i.copy||t.isFunction(i.copy))){ZeroClipboard.setMoviePath(i.path);var n=new ZeroClipboard.Client;t.isFunction(i.copy)&&e.bind("zClip_copy",i.copy),t.isFunction(i.beforeCopy)&&e.bind("zClip_beforeCopy",i.beforeCopy),t.isFunction(i.afterCopy)&&e.bind("zClip_afterCopy",i.afterCopy),n.setHandCursor(i.setHandCursor),n.setCSSEffects(i.setCSSEffects),n.addEventListener("mouseOver",function(t){e.trigger("mouseenter")}),n.addEventListener("mouseOut",function(t){e.trigger("mouseleave")}),n.addEventListener("mouseDown",function(r){e.trigger("mousedown"),t.isFunction(i.copy)?n.setText(e.triggerHandler("zClip_copy")):n.setText(i.copy),t.isFunction(i.beforeCopy)&&e.trigger("zClip_beforeCopy")}),n.addEventListener("complete",function(n,r){t.isFunction(i.afterCopy)?e.trigger("zClip_afterCopy"):(r.length>500&&(r=r.substr(0,500)+"...\n\n("+(r.length-500)+" characters not shown)"),e.removeClass("hover"),alert("Copied text to clipboard:\n\n "+r)),i.clickAfter&&e.trigger("click")}),n.glue(e[0],e.parent()[0]),t(window).bind("load resize",function(){n.reposition()})}})}return"string"==typeof e?this.each(function(){var i=t(this);e=e.toLowerCase();var n=i.data("zclipId"),r=t("#"+n+".zclip");"remove"==e?(r.remove(),i.removeClass("active hover")):"hide"==e?(r.hide(),i.removeClass("active hover")):"show"==e&&r.show()}):void 0}}(jQuery);var ZeroClipboard={version:"1.0.7",clients:{},moviePath:"ZeroClipboard.swf",nextId:1,$:function(t){return"string"==typeof t&&(t=document.getElementById(t)),t.addClass||(t.hide=function(){this.style.display="none"},t.show=function(){this.style.display=""},t.addClass=function(t){this.removeClass(t),this.className+=" "+t},t.removeClass=function(t){for(var e=this.className.split(/\s+/),i=-1,n=0;n<e.length;n++)e[n]==t&&(i=n,n=e.length);return i>-1&&(e.splice(i,1),this.className=e.join(" ")),this},t.hasClass=function(t){return!!this.className.match(new RegExp("\\s*"+t+"\\s*"))}),t},setMoviePath:function(t){this.moviePath=t},dispatch:function(t,e,i){var n=this.clients[t];n&&n.receiveEvent(e,i)},register:function(t,e){this.clients[t]=e},getDOMObjectPosition:function(t,e){var i={left:0,top:0,width:t.width?t.width:t.offsetWidth,height:t.height?t.height:t.offsetHeight};return t&&t!=e&&(i.left+=t.offsetLeft,i.top+=t.offsetTop),i},Client:function(t){this.handlers={},this.id=ZeroClipboard.nextId++,this.movieId="ZeroClipboardMovie_"+this.id,ZeroClipboard.register(this.id,this),t&&this.glue(t)}};ZeroClipboard.Client.prototype={id:0,ready:!1,movie:null,clipText:"",handCursorEnabled:!0,cssEffects:!0,handlers:null,glue:function(t,e,i){this.domElement=ZeroClipboard.$(t);var n=99;this.domElement.style.zIndex&&(n=parseInt(this.domElement.style.zIndex,10)+1),"string"==typeof e?e=ZeroClipboard.$(e):"undefined"==typeof e&&(e=document.getElementsByTagName("body")[0]);var r=ZeroClipboard.getDOMObjectPosition(this.domElement,e);this.div=document.createElement("div"),this.div.className="zclip",this.div.id="zclip-"+this.movieId,$(this.domElement).data("zclipId","zclip-"+this.movieId);var o=this.div.style;if(o.position="absolute",o.left=""+r.left+"px",o.top=""+r.top+"px",o.width=""+r.width+"px",o.height=""+r.height+"px",o.zIndex=n,"object"==typeof i)for(addedStyle in i)o[addedStyle]=i[addedStyle];e.appendChild(this.div),this.div.innerHTML=this.getHTML(r.width,r.height)},getHTML:function(t,e){var i="",n="id="+this.id+"&width="+t+"&height="+e;if(navigator.userAgent.match(/MSIE/)){var r=location.href.match(/^https/i)?"https://":"http://";i+='<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="'+r+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="'+t+'" height="'+e+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+ZeroClipboard.moviePath+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+n+'"/><param name="wmode" value="transparent"/></object>'}else i+='<embed id="'+this.movieId+'" src="'+ZeroClipboard.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+t+'" height="'+e+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+n+'" wmode="transparent" />';return i},hide:function(){this.div&&(this.div.style.left="-2000px")},show:function(){this.reposition()},destroy:function(){if(this.domElement&&this.div){this.hide(),this.div.innerHTML="";var t=document.getElementsByTagName("body")[0];try{t.removeChild(this.div)}catch(e){}this.domElement=null,this.div=null}},reposition:function(t){if(t&&(this.domElement=ZeroClipboard.$(t),this.domElement||this.hide()),this.domElement&&this.div){var e=ZeroClipboard.getDOMObjectPosition(this.domElement),i=this.div.style;i.left=""+e.left+"px",i.top=""+e.top+"px"}},setText:function(t){this.clipText=t,this.ready&&this.movie.setText(t)},addEventListener:function(t,e){t=t.toString().toLowerCase().replace(/^on/,""),this.handlers[t]||(this.handlers[t]=[]),this.handlers[t].push(e)},setHandCursor:function(t){this.handCursorEnabled=t,this.ready&&this.movie.setHandCursor(t)},setCSSEffects:function(t){this.cssEffects=!!t},receiveEvent:function(t,e){switch(t=t.toString().toLowerCase().replace(/^on/,"")){case"load":if(this.movie=document.getElementById(this.movieId),!this.movie){var i=this;return void setTimeout(function(){i.receiveEvent("load",null)},1)}if(!this.ready&&navigator.userAgent.match(/Firefox/)&&navigator.userAgent.match(/Windows/)){var i=this;return setTimeout(function(){i.receiveEvent("load",null)},100),void(this.ready=!0)}this.ready=!0;try{this.movie.setText(this.clipText)}catch(n){}try{this.movie.setHandCursor(this.handCursorEnabled)}catch(n){}break;case"mouseover":this.domElement&&this.cssEffects&&(this.domElement.addClass("hover"),this.recoverActive&&this.domElement.addClass("active"));break;case"mouseout":this.domElement&&this.cssEffects&&(this.recoverActive=!1,this.domElement.hasClass("active")&&(this.domElement.removeClass("active"),this.recoverActive=!0),this.domElement.removeClass("hover"));break;case"mousedown":this.domElement&&this.cssEffects&&this.domElement.addClass("active");break;case"mouseup":this.domElement&&this.cssEffects&&(this.domElement.removeClass("active"),this.recoverActive=!1)}if(this.handlers[t])for(var r=0,o=this.handlers[t].length;o>r;r++){var a=this.handlers[t][r];"function"==typeof a?a(this,e):"object"==typeof a&&2==a.length?a[0][a[1]](this,e):"string"==typeof a&&window[a](this,e)}}},function(t){var e,n,r,o,a,s,c,l,u,h,d;if(n=!!document.createElement("canvas").getContext,e=function(){var t=document.createElement("div");t.innerHTML='<v:shape id="vml_flag1" adj="1" />';var e=t.firstChild;return e.style.behavior="url(#default#VML)",e?"object"==typeof e.adj:!0}(),!n&&!e)return void(t.fn.maphilight=function(){return this});if(n){l=function(t){return Math.max(0,Math.min(parseInt(t,16),255))},u=function(t,e){return"rgba("+l(t.substr(0,2))+","+l(t.substr(2,2))+","+l(t.substr(4,2))+","+e+")"},r=function(e){var i=t('<canvas style="width:'+t(e).width()+"px;height:"+t(e).height()+'px;"></canvas>').get(0);return i.getContext("2d").clearRect(0,0,t(e).width(),t(e).height()),i};var f=function(t,e,n,r,o){if(r=r||0,o=o||0,t.beginPath(),"rect"==e)t.rect(n[0]+r,n[1]+o,n[2]-n[0],n[3]-n[1]);else if("poly"==e)for(t.moveTo(n[0]+r,n[1]+o),i=2;i<n.length;i+=2)t.lineTo(n[i]+r,n[i+1]+o);else"circ"==e&&t.arc(n[0]+r,n[1]+o,n[2],0,2*Math.PI,!1);t.closePath()};o=function(e,i,n,r,o){var a=e.getContext("2d");if(r.shadow){a.save(),"inside"==r.shadowPosition&&(f(a,i,n),a.clip());var s=100*e.width,c=100*e.height;f(a,i,n,s,c),a.shadowOffsetX=r.shadowX-s,a.shadowOffsetY=r.shadowY-c,a.shadowBlur=r.shadowRadius,a.shadowColor=u(r.shadowColor,r.shadowOpacity);var l=r.shadowFrom;l||(l="outside"==r.shadowPosition?"fill":"stroke"),"stroke"==l?(a.strokeStyle="rgba(0,0,0,1)",a.stroke()):"fill"==l&&(a.fillStyle="rgba(0,0,0,1)",a.fill()),a.restore(),"outside"==r.shadowPosition&&(a.save(),f(a,i,n),a.globalCompositeOperation="destination-out",a.fillStyle="rgba(0,0,0,1);",a.fill(),a.restore())}a.save(),f(a,i,n),r.fill&&(a.fillStyle=u(r.fillColor,r.fillOpacity),a.fill()),r.stroke&&(a.strokeStyle=u(r.strokeColor,r.strokeOpacity),a.lineWidth=r.strokeWidth,a.stroke()),a.restore(),r.fade&&t(e).css("opacity",0).animate({opacity:1},100)},a=function(t){t.getContext("2d").clearRect(0,0,t.width,t.height)}}else r=function(e){return t('<var style="zoom:1;overflow:hidden;display:block;width:'+e.width+"px;height:"+e.height+'px;"></var>').get(0)},o=function(e,i,n,r,o){var a,s,c,l;for(var u in n)n[u]=parseInt(n[u],10);a='<v:fill color="#'+r.fillColor+'" opacity="'+(r.fill?r.fillOpacity:0)+'" />',s=r.stroke?'strokeweight="'+r.strokeWidth+'" stroked="t" strokecolor="#'+r.strokeColor+'"':'stroked="f"',c='<v:stroke opacity="'+r.strokeOpacity+'"/>',"rect"==i?l=t('<v:rect name="'+o+'" filled="t" '+s+' style="zoom:1;margin:0;padding:0;display:block;position:absolute;left:'+n[0]+"px;top:"+n[1]+"px;width:"+(n[2]-n[0])+"px;height:"+(n[3]-n[1])+'px;"></v:rect>'):"poly"==i?l=t('<v:shape name="'+o+'" filled="t" '+s+' coordorigin="0,0" coordsize="'+e.width+","+e.height+'" path="m '+n[0]+","+n[1]+" l "+n.join(",")+' x e" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:0px;left:0px;width:'+e.width+"px;height:"+e.height+'px;"></v:shape>'):"circ"==i&&(l=t('<v:oval name="'+o+'" filled="t" '+s+' style="zoom:1;margin:0;padding:0;display:block;position:absolute;left:'+(n[0]-n[2])+"px;top:"+(n[1]-n[2])+"px;width:"+2*n[2]+"px;height:"+2*n[2]+'px;"></v:oval>')),l.get(0).innerHTML=a+c,t(e).append(l)},a=function(e){var i=t("<div>"+e.innerHTML+"</div>");i.children("[name=highlighted]").remove(),e.innerHTML=i.html()};s=function(t){var e,i=t.getAttribute("coords").split(",");for(e=0;e<i.length;e++)i[e]=parseFloat(i[e]);return[t.getAttribute("shape").toLowerCase().substr(0,4),i]},d=function(e,i){var n=t(e);return t.extend({},i,t.metadata?n.metadata():!1,n.data("maphilight"))},h=function(t){return t.complete?"undefined"!=typeof t.naturalWidth&&0===t.naturalWidth?!1:!0:!1},c={position:"absolute",left:0,top:0,padding:0,border:0};var m=!1;t.fn.maphilight=function(i){return i=t.extend({},t.fn.maphilight.defaults,i),n||m||(t(window).ready(function(){document.namespaces.add("v","urn:schemas-microsoft-com:vml");var e=document.createStyleSheet(),i=["shape","rect","oval","circ","fill","stroke","imagedata","group","textbox"];t.each(i,function(){e.addRule("v\\:"+this,"behavior: url(#default#VML); antialias:true")})}),m=!0),this.each(function(){var l,u,f,m,p,g,v;if(l=t(this),!h(this))return window.setTimeout(function(){l.maphilight(i)},200);if(f=t.extend({},i,t.metadata?l.metadata():!1,l.data("maphilight")),v=l.get(0).getAttribute("usemap"),v&&(m=t('map[name="'+v.substr(1)+'"]'),l.is('img,input[type="image"]')&&v&&m.size()>0)){if(l.hasClass("maphilighted")){var b=l.parent();l.insertBefore(b),b.remove(),t(m).unbind(".maphilight")}u=t("<div></div>").css({display:"block",backgroundImage:'url("'+this.src+'")',backgroundSize:"contain",position:"relative",padding:0,width:this.width,height:this.height}),f.wrapClass&&(f.wrapClass===!0?u.addClass(t(this).attr("class")):u.addClass(f.wrapClass)),l.before(u).css("opacity",0).css(c).remove(),e&&l.css("filter","Alpha(opacity=0)"),u.append(l),p=r(this),t(p).css(c),p.height=this.height,p.width=this.width,t(m).bind("alwaysOn.maphilight",function(){g&&a(g),n||t(p).empty(),t(m).find("area[coords]").each(function(){var e,i;i=d(this,f),i.alwaysOn&&(!g&&n&&(g=r(l[0]),t(g).css(c),g.width=l[0].width,g.height=l[0].height,l.before(g)),i.fade=i.alwaysOnFade,e=s(this),n?o(g,e[0],e[1],i,""):o(p,e[0],e[1],i,""))})}).trigger("alwaysOn.maphilight").bind("mouseover.maphilight, focus.maphilight",function(e){var i,r,a=e.target;if(r=d(a,f),!r.neverOn&&!r.alwaysOn){if(i=s(a),o(p,i[0],i[1],r,"highlighted"),r.groupBy){var c;c=/^[a-zA-Z][\-a-zA-Z]+$/.test(r.groupBy)?m.find("area["+r.groupBy+'="'+t(a).attr(r.groupBy)+'"]'):m.find(r.groupBy);var l=a;c.each(function(){if(this!=l){var t=d(this,f);if(!t.neverOn&&!t.alwaysOn){var e=s(this);o(p,e[0],e[1],t,"highlighted")}}})}n||t(p).append("<v:rect></v:rect>")}}).bind("mouseout.maphilight, blur.maphilight",function(t){a(p)}),l.before(p),l.addClass("maphilighted")}})},t.fn.maphilight.defaults={fill:!0,fillColor:"000000",fillOpacity:.2,stroke:!0,strokeColor:"ff0000",strokeOpacity:1,strokeWidth:1,fade:!0,alwaysOn:!1,neverOn:!1,groupBy:!1,wrapClass:!0,shadow:!1,shadowX:0,shadowY:0,shadowRadius:6,shadowColor:"000000",shadowOpacity:.8,shadowPosition:"outside",shadowFrom:!1}}(jQuery),function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)}(function(t){"use strict";function e(t){if(t instanceof Date)return t;if(String(t).match(a))return String(t).match(/^[0-9]*$/)&&(t=Number(t)),String(t).match(/\-/)&&(t=String(t).replace(/\-/g,"http://demo.shnayder.pro/")),new Date(t);throw new Error("Couldn't cast `"+t+"` to a date object.")}function i(t){return function(e){var i=e.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);if(i)for(var r=0,o=i.length;o>r;++r){var a=i[r].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),c=new RegExp(a[0]),l=a[1]||"",u=a[3]||"",h=null;a=a[2],s.hasOwnProperty(a)&&(h=s[a],h=Number(t[h])),null!==h&&("!"===l&&(h=n(u,h)),""===l&&10>h&&(h="0"+h.toString()),e=e.replace(c,h.toString()))}return e=e.replace(/%%/,"%");
}}function n(t,e){var i="s",n="";return t&&(t=t.replace(/(:|;|\s)/gi,"").split(/\,/),1===t.length?i=t[0]:(n=t[0],i=t[1])),1===Math.abs(e)?n:i}var r=100,o=[],a=[];a.push(/^[0-9]*$/.source),a.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),a.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),a=new RegExp(a.join("|"));var s={Y:"years",m:"months",w:"weeks",d:"days",D:"totalDays",H:"hours",M:"minutes",S:"seconds"},c=function(e,i,n){this.el=e,this.$el=t(e),this.interval=null,this.offset={},this.instanceNumber=o.length,o.push(this),this.$el.data("countdown-instance",this.instanceNumber),n&&(this.$el.on("update.countdown",n),this.$el.on("stoped.countdown",n),this.$el.on("finish.countdown",n)),this.setFinalDate(i),this.start()};t.extend(c.prototype,{start:function(){null!==this.interval&&clearInterval(this.interval);var t=this;this.update(),this.interval=setInterval(function(){t.update.call(t)},r)},stop:function(){clearInterval(this.interval),this.interval=null,this.dispatchEvent("stoped")},pause:function(){this.stop.call(this)},resume:function(){this.start.call(this)},remove:function(){this.stop(),o[this.instanceNumber]=null,delete this.$el.data().countdownInstance},setFinalDate:function(t){this.finalDate=e(t)},update:function(){return 0===this.$el.closest("html").length?void this.remove():(this.totalSecsLeft=this.finalDate.getTime()-(new Date).getTime(),this.totalSecsLeft=Math.ceil(this.totalSecsLeft/1e3),this.totalSecsLeft=this.totalSecsLeft<0?0:this.totalSecsLeft,this.offset={seconds:this.totalSecsLeft%60,minutes:Math.floor(this.totalSecsLeft/60)%60,hours:Math.floor(this.totalSecsLeft/60/60)%24,days:Math.floor(this.totalSecsLeft/60/60/24)%7,totalDays:Math.floor(this.totalSecsLeft/60/60/24),weeks:Math.floor(this.totalSecsLeft/60/60/24/7),months:Math.floor(this.totalSecsLeft/60/60/24/30),years:Math.floor(this.totalSecsLeft/60/60/24/365)},void(0===this.totalSecsLeft?(this.stop(),this.dispatchEvent("finish")):this.dispatchEvent("update")))},dispatchEvent:function(e){var n=t.Event(e+".countdown");n.finalDate=this.finalDate,n.offset=t.extend({},this.offset),n.strftime=i(this.offset),this.$el.trigger(n)}}),t.fn.countdown=function(){var e=Array.prototype.slice.call(arguments,0);return this.each(function(){var i=t(this).data("countdown-instance");if(void 0!==i){var n=o[i],r=e[0];c.prototype.hasOwnProperty(r)?n[r].apply(n,e.slice(1)):null===String(r).match(/^[$A-Z_][0-9A-Z_$]*$/i)?(n.setFinalDate.call(n,r),n.start()):t.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi,r))}else new c(this,e[0],e[1])})}}),function(t){"use strict";function e(t,e,i){return t.addEventListener?t.addEventListener(e,i,!1):t.attachEvent?t.attachEvent("on"+e,i):void 0}function i(t,e){var i,n;for(i=0,n=t.length;n>i;i++)if(t[i]===e)return!0;return!1}function n(t,e){var i;t.createTextRange?(i=t.createTextRange(),i.move("character",e),i.select()):t.selectionStart&&(t.focus(),t.setSelectionRange(e,e))}function r(t,e){try{return t.type=e,!0}catch(i){return!1}}t.Placeholders={Utils:{addEventListener:e,inArray:i,moveCaret:n,changeType:r}}}(this),function(t){"use strict";function e(){}function i(){try{return document.activeElement}catch(t){}}function n(t,e){var i,n,r=!!e&&t.value!==e,o=t.value===t.getAttribute(R);return(r||o)&&"true"===t.getAttribute(H)?(t.removeAttribute(H),t.value=t.value.replace(t.getAttribute(R),""),t.className=t.className.replace(M,""),n=t.getAttribute(D),parseInt(n,10)>=0&&(t.setAttribute("maxLength",n),t.removeAttribute(D)),i=t.getAttribute(B),i&&(t.type=i),!0):!1}function r(t){var e,i,n=t.getAttribute(R);return""===t.value&&n?(t.setAttribute(H,"true"),t.value=n,t.className+=" "+I,i=t.getAttribute(D),i||(t.setAttribute(D,t.maxLength),t.removeAttribute("maxLength")),e=t.getAttribute(B),e?t.type="text":"password"===t.type&&W.changeType(t,"text")&&t.setAttribute(B,"password"),!0):!1}function o(t,e){var i,n,r,o,a,s,c;if(t&&t.getAttribute(R))e(t);else for(r=t?t.getElementsByTagName("input"):p,o=t?t.getElementsByTagName("textarea"):g,i=r?r.length:0,n=o?o.length:0,c=0,s=i+n;s>c;c++)a=i>c?r[c]:o[c-i],e(a)}function a(t){o(t,n)}function s(t){o(t,r)}function c(t){return function(){v&&t.value===t.getAttribute(R)&&"true"===t.getAttribute(H)?W.moveCaret(t,0):n(t)}}function l(t){return function(){r(t)}}function u(t){return function(e){return y=t.value,"true"===t.getAttribute(H)&&y===t.getAttribute(R)&&W.inArray(L,e.keyCode)?(e.preventDefault&&e.preventDefault(),!1):void 0}}function h(t){return function(){n(t,y),""===t.value&&(t.blur(),W.moveCaret(t,0))}}function d(t){return function(){t===i()&&t.value===t.getAttribute(R)&&"true"===t.getAttribute(H)&&W.moveCaret(t,0)}}function f(t){return function(){a(t)}}function m(t){t.form&&(k=t.form,"string"==typeof k&&(k=document.getElementById(k)),k.getAttribute(V)||(W.addEventListener(k,"submit",f(k)),k.setAttribute(V,"true"))),W.addEventListener(t,"focus",c(t)),W.addEventListener(t,"blur",l(t)),v&&(W.addEventListener(t,"keydown",u(t)),W.addEventListener(t,"keyup",h(t)),W.addEventListener(t,"click",d(t))),t.setAttribute(N,"true"),t.setAttribute(R,F),(v||t!==i())&&r(t)}var p,g,v,b,y,S,w,F,C,k,x,E,T,$=["text","search","url","tel","email","password","number","textarea"],L=[27,33,34,35,36,37,38,39,40,8,46],A="#ccc",I="placeholdersjs",M=RegExp("(?:^|\\s)"+I+"(?!\\S)"),R="data-placeholder-value",H="data-placeholder-active",B="data-placeholder-type",V="data-placeholder-submit",N="data-placeholder-bound",O="data-placeholder-focus",G="data-placeholder-live",D="data-placeholder-maxlength",P=document.createElement("input"),j=document.getElementsByTagName("head")[0],_=document.documentElement,z=t.Placeholders,W=z.Utils;if(z.nativeSupport=void 0!==P.placeholder,!z.nativeSupport){for(p=document.getElementsByTagName("input"),g=document.getElementsByTagName("textarea"),v="false"===_.getAttribute(O),b="false"!==_.getAttribute(G),S=document.createElement("style"),S.type="text/css",w=document.createTextNode("."+I+" { color:"+A+"; }"),S.styleSheet?S.styleSheet.cssText=w.nodeValue:S.appendChild(w),j.insertBefore(S,j.firstChild),T=0,E=p.length+g.length;E>T;T++)x=p.length>T?p[T]:g[T-p.length],F=x.attributes.placeholder,F&&(F=F.nodeValue,F&&W.inArray($,x.type)&&m(x));C=setInterval(function(){for(T=0,E=p.length+g.length;E>T;T++)x=p.length>T?p[T]:g[T-p.length],F=x.attributes.placeholder,F?(F=F.nodeValue,F&&W.inArray($,x.type)&&(x.getAttribute(N)||m(x),(F!==x.getAttribute(R)||"password"===x.type&&!x.getAttribute(B))&&("password"===x.type&&!x.getAttribute(B)&&W.changeType(x,"text")&&x.setAttribute(B,"password"),x.value===x.getAttribute(R)&&(x.value=F),x.setAttribute(R,F)))):x.getAttribute(H)&&(n(x),x.removeAttribute(R));b||clearInterval(C)},100)}W.addEventListener(t,"beforeunload",function(){z.disable()}),z.disable=z.nativeSupport?e:a,z.enable=z.nativeSupport?e:s}(this),+function(t){"use strict";function e(e){return this.each(function(){var n=t(this),r=t.extend({},i.DEFAULTS,n.data(),"object"==typeof e&&e),o=n.data("bs.validator");(o||"destroy"!=e)&&(o||n.data("bs.validator",o=new i(this,r)),"string"==typeof e&&o[e]())})}var i=function(e,n){this.$element=t(e),this.options=n,n.errors=t.extend({},i.DEFAULTS.errors,n.errors);for(var r in n.custom)if(!n.errors[r])throw new Error("Missing default error message for custom validator: "+r);t.extend(i.VALIDATORS,n.custom),this.$element.attr("novalidate",!0),this.toggleSubmit(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",t.proxy(this.validateInput,this)),this.$element.on("submit.bs.validator",t.proxy(this.onSubmit,this)),this.$element.find("[data-match]").each(function(){var e=t(this),i=e.data("match");t(i).on("input.bs.validator",function(t){e.val()&&e.trigger("input.bs.validator")})})};i.INPUT_SELECTOR=':input:not([type="submit"], button):enabled:visible',i.DEFAULTS={delay:500,html:!1,disable:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},i.VALIDATORS={"native":function(t){var e=t[0];return e.checkValidity?e.checkValidity():!0},match:function(e){var i=e.data("match");return!e.val()||e.val()===t(i).val()},minlength:function(t){var e=t.data("minlength");return!t.val()||t.val().length>=e}},i.prototype.validateInput=function(e){var i=t(e.target),n=i.data("bs.validator.errors");if(i.is('[type="radio"]')&&(i=this.$element.find('input[name="'+i.attr("name")+'"]')),this.$element.trigger(e=t.Event("validate.bs.validator",{relatedTarget:i[0]})),!e.isDefaultPrevented()){var r=this;this.runValidators(i).done(function(o){i.data("bs.validator.errors",o),o.length?r.showErrors(i):r.clearErrors(i),n&&o.toString()===n.toString()||(e=o.length?t.Event("invalid.bs.validator",{relatedTarget:i[0],detail:o}):t.Event("valid.bs.validator",{relatedTarget:i[0],detail:n}),r.$element.trigger(e)),r.toggleSubmit(),r.$element.trigger(t.Event("validated.bs.validator",{relatedTarget:i[0]}))})}},i.prototype.runValidators=function(e){function n(t){return e.data(t+"-error")||e.data("error")||"native"==t&&e[0].validationMessage||a.errors[t]}var r=[],o=t.Deferred(),a=this.options;return e.data("bs.validator.deferred")&&e.data("bs.validator.deferred").reject(),e.data("bs.validator.deferred",o),t.each(i.VALIDATORS,t.proxy(function(t,i){if((e.data(t)||"native"==t)&&!i.call(this,e)){var o=n(t);!~r.indexOf(o)&&r.push(o)}},this)),!r.length&&e.val()&&e.data("remote")?this.defer(e,function(){var i={};i[e.attr("name")]=e.val(),t.get(e.data("remote"),i).fail(function(t,e,i){r.push(n("remote")||i)}).always(function(){o.resolve(r)})}):o.resolve(r),o.promise()},i.prototype.validate=function(){var t=this.options.delay;return this.options.delay=0,this.$element.find(i.INPUT_SELECTOR).trigger("input.bs.validator"),this.options.delay=t,this},i.prototype.showErrors=function(e){var i=this.options.html?"html":"text";this.defer(e,function(){var n=e.closest(".form-group"),r=n.find(".help-block.with-errors"),o=n.find(".form-control-feedback"),a=e.data("bs.validator.errors");a.length&&(a=t("<ul/>").addClass("list-unstyled").append(t.map(a,function(e){return t("<li/>")[i](e)})),void 0===r.data("bs.validator.originalContent")&&r.data("bs.validator.originalContent",r.html()),r.empty().append(a),n.addClass("has-error"),o.length&&o.removeClass(this.options.feedback.success)&&o.addClass(this.options.feedback.error)&&n.removeClass("has-success"))})},i.prototype.clearErrors=function(t){var e=t.closest(".form-group"),i=e.find(".help-block.with-errors"),n=e.find(".form-control-feedback");i.html(i.data("bs.validator.originalContent")),e.removeClass("has-error"),n.length&&n.removeClass(this.options.feedback.error)&&n.addClass(this.options.feedback.success)&&e.addClass("has-success")},i.prototype.hasErrors=function(){function e(){return!!(t(this).data("bs.validator.errors")||[]).length}return!!this.$element.find(i.INPUT_SELECTOR).filter(e).length},i.prototype.isIncomplete=function(){function e(){return"checkbox"===this.type?!this.checked:"radio"===this.type?!t('[name="'+this.name+'"]:checked').length:""===t.trim(this.value)}return!!this.$element.find(i.INPUT_SELECTOR).filter("[required]").filter(e).length},i.prototype.onSubmit=function(t){this.validate(),(this.isIncomplete()||this.hasErrors())&&t.preventDefault()},i.prototype.toggleSubmit=function(){if(this.options.disable){var e=t('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]'));e.toggleClass("disabled",this.isIncomplete()||this.hasErrors())}},i.prototype.defer=function(e,i){return i=t.proxy(i,this),this.options.delay?(window.clearTimeout(e.data("bs.validator.timeout")),void e.data("bs.validator.timeout",window.setTimeout(i,this.options.delay))):i()},i.prototype.destroy=function(){return this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$element.find(i.INPUT_SELECTOR).off(".bs.validator").removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var e=t(this),i=e.data("bs.validator.timeout");window.clearTimeout(i)&&e.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var e=t(this),i=e.data("bs.validator.originalContent");e.removeData("bs.validator.originalContent").html(i)}),this.$element.find('input[type="submit"], button[type="submit"]').removeClass("disabled"),this.$element.find(".has-error").removeClass("has-error"),this};var n=t.fn.validator;t.fn.validator=e,t.fn.validator.Constructor=i,t.fn.validator.noConflict=function(){return t.fn.validator=n,this},t(window).on("load",function(){t('form[data-toggle="validator"]').each(function(){var i=t(this);e.call(i,i.data())})})}(jQuery);var config={countdown:{year:2015,month:11,day:10,hour:0,minute:0,second:0},subscription_form_tooltips:{success:"You have been subscribed!",already_subscribed:"You are already subscribed",empty_email:"Please, Enter your email",invalid_email:"Email is invalid. Enter valid email address",default_error:"Error! Contact administration"}};$(function(){function t(t,e){var i;s||(s=$('<p class="subscription-form-tooltip"></p>').appendTo(l)),"success"==t?s.removeClass("error").addClass("success"):s.removeClass("success").addClass("error"),s.text(e).fadeTo(0,0),i=s.outerWidth()/2,s.css("margin-left",-i).animate({top:"100%"},200).dequeue().fadeTo(200,1)}function e(){s&&s.animate({top:"120%"},200).dequeue().fadeTo(100,0)}function i(i,n){u.removeClass("success error"),"normal"==i?e():(t(i,n),u.addClass(i))}var n=$(document.body),r=($(window),document.createElement("canvas"));backgroundEnabled=r.getContext&&r.getContext("2d")&&"none"!=$("#background-container").css("display"),backgroundEnabled&&(config.background={enabled:!0,RENDER:{renderer:"canvas"},MESH:{width:1.2,height:1.2,depth:10,segments:16,slices:8,xRange:.8,yRange:.1,zRange:1,ambient:"#555555",diffuse:"#FFFFFF",speed:5e-4},LIGHT:{count:2,xyScalar:1,zOffset:150,ambient:"#880066",diffuse:"#D77600",speed:.001,gravity:1200,dampening:.15,minLimit:8,maxLimit:null,minDistance:20,maxDistance:400,autopilot:!0,draw:!1}},n.hasClass("theme-ice")?(config.background.LIGHT.ambient="#1165A4",config.background.LIGHT.diffuse="#514311"):n.hasClass("theme-nature")?(config.background.LIGHT.ambient="#00935B",config.background.LIGHT.diffuse="#02480A"):n.hasClass("theme-sea")?(config.background.LIGHT.ambient="#76E4CE",config.background.LIGHT.diffuse="#0E411F",config.background.LIGHT.zOffset=100):n.hasClass("theme-candy")?(config.background.LIGHT.ambient="#A42D71",config.background.LIGHT.diffuse="#4E2F1B"):n.hasClass("theme-peach")?(config.background.LIGHT.ambient="#FF7171",config.background.LIGHT.diffuse="#895321",config.background.LIGHT.zOffset=100):n.hasClass("theme-light")?(config.background.LIGHT.ambient="#DBAA95",config.background.LIGHT.diffuse="#4F460B"):n.hasClass("theme-darkness")&&(config.background.LIGHT.ambient="#3C3C3C",config.background.LIGHT.diffuse="#494949",config.background.LIGHT.zOffset=200),initBackground());var o=new Date(config.countdown.year,config.countdown.month-1,config.countdown.day,config.countdown.hour,config.countdown.minute,config.countdown.second),a={days:$("#countdown-days"),hours:$("#countdown-hours"),minutes:$("#countdown-minutes"),seconds:$("#countdown-seconds")};$("#countdown").countdown(o).on("update.countdown",function(t){a.days.text(t.offset.totalDays),a.hours.text(("0"+t.offset.hours).slice(-2)),a.minutes.text(("0"+t.offset.minutes).slice(-2)),a.seconds.text(("0"+t.offset.seconds).slice(-2))});var s,c=config.subscription_form_tooltips,l=$("#subscription-form"),u=$("#subscription-form-email");$("#subscription-form-submit");l.submit(function(t){t.preventDefault();var e=u.val();0==e.length?i("error",c.empty_email):$.post("subscribe.html",{email:e,ajax:1},function(t){if("success"==t.status)i("success",c.success);else switch(t.error){case"empty_email":case"invalid_email":case"already_subscribed":i("error",c[t.error]);break;default:i("error",c.default_error)}},"json")}),u.on("change focus click keydown",function(){u.val().length>0&&i("normal")})}),$(function(){var t=($("html"),$("#demo-panel")),e=$(".demo-panel-themes li");$("#demo-panel-activator").on("click",function(e){e.preventDefault(),t.toggleClass("active")}),e.on("click",function(){var t=$(this);e.filter(".active").removeClass("active"),t.toggleClass("active")})});
>>>>>>> eba0d432ae41f0e74243cf27fb965acfc2fcfd3a
//# sourceMappingURL=frontend.js.map
