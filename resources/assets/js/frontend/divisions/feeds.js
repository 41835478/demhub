
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

$(".share-dropdown-toggle").mouseenter(function(){
  $(this).attr("data-toggle","dropdown");
});

$(".share-dropdown-toggle").mouseleave(function(){

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
$(window).load(function() {
  $('[data-toggle="tooltip"]').tooltip();
});
