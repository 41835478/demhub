
@if (! url('userhome'))
  <div class="row">
    <div class="col-md-10 col-md-offset-2" style="overflow-x:hidden">
      <h2><span class="label label-info" style="background-color:rgba(0, 0, 0, 0.7);">NEWS FEED</span><h2>
    </div>
  </div>
@else
  <div style="padding-bottom:20px"></div>
@endif

<div class="container-fluid">
  <div class="row">
    @include('division.__feedsbox')

    <!-- Twitter Button Javascript -->
<script>
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
// function toggleMenuOff() {
//   var Toggle=("#copy-button").parent(".dropdown-toggle");
//   $(Toggle).attr("data-toggle","");
// }
// function toggleMenu() {
//   // element.closest(".dropdown-toggle");
//   //  $(element).children('ul').stop().slideToggle(400);
//   //  $(element).dropdown("toggle");
//   $('#copy-button').preventDefault();
// }
$(".dropdown-toggle").mouseenter(function(){
  $(this).attr("data-toggle","dropdown");
});

$(".dropdown-toggle").mouseleave(function(){
  // e.preventDefault();
  // $(this).removeClass("dropdown-toggle");
  $(this).addClass("t0ggle");
  $(this).attr("data-toggle","");
  // $(Toggle).attr('class','');
  $(".copy-button").zclip({
	        path:"../js/ZeroClipboard.swf",
	        copy:function(){return $("#copy-button-link").text();},
			afterCopy:function(){
				document.getElementById("copy-button-text").innerHTML=" Copied To Clipboard";
        setTimeout(function(){
          $('.t0ggle').attr("data-toggle","dropdown");
          $('.t0ggle').click();
          $('.t0ggle').removeClass('t0ggle');
          // $(Toggle).addClass("dropdown-toggle");
          // $(Toggle).attr("data-toggle","dropdown");
        },500);
			}
	});
});
// document.getElementById("copy-button").addEventListener("click", function(event){
//     event.preventDefault()
// });

$(".feedsbox").mouseleave(function() {
  copyLink=$(this).find(".copy-button");
  $(copyLink).attr('id', '');
  copyLink=$(this).find(".copy-button-text");
  $(copyLink).attr('id', '');
  copyLink=$(this).find(".copy-button-link");
  $(copyLink).attr('id', '');

});
$(document).ready(function () {

  // $(".copy-button").click(function(){
  //     alert($("#copy-button-link").text());
  // });
});




</script>

  </div>
</div>
