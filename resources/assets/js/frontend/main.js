$(function(){

});

function twitterActivate (item) {
  var twitterElement;
  twitterElement=$(item).find($(".article_twitter"));
  $(twitterElement).addClass("twitter-share-button");
  !function(d,s,id){
    var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
    if(document.body){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}
  }(document, 'script', 'twitter-wjs');
};
