$("#top-menu li a").mouseenter(function() {
    $(this).children(".img-circle").attr("style","background:linear-gradient(rgba(237, 107, 0, 0.5), rgba(237, 107, 0, 0.5)),url({{Auth::user()->avatar->url('thumb')}});background-size:cover;");
});
$("#top-menu li a").mouseleave(function() {
    $(this).children(".img-circle").attr("style","background-image:url({{Auth::user()->avatar->url('thumb')}});");
});

//	$(".nav-searchbar").focus(function() {
//		$(".nav-searchbar").addClass("active");//.attr("style","color: #ed6b00;background-color:#fff;");
//		$(".nav-search-icon-style").addClass("active");//.attr("style","background-color: #fff;color: #ed6b00;");
//		$(".nav-search-text").addClass("active");//.attr("style","background-color: #ededed;color: #ed6b00;");
//	});

$(document).ready(function(){
	$(".searchbar-group").mouseenter(function() {
		search_focus(true);
	}).mouseleave(function() {
		search_focus(false);
	});

	$(".nav-searchbar, .nav-search-text, .nav-search-icon-style").blur(function(){
		search_focus(false);
	}).focus(function(){
		search_focus(true);
	});

	if($(".nav-searchbar").val() && $(".nav-searchbar").val().trim() !== ""){
		search_focus(true);
	}
});

function search_focus(give_focus){
	if(give_focus){
		$(".nav-searchbar").addClass("active");//.attr("style","color: #ed6b00;background-color:#fff;");
		$(".nav-search-icon-style").addClass("active");//.attr("style","background-color: #fff;color: #ed6b00;");
		$(".nav-search-text").addClass("active");//.attr("style","background-color: #ededed;color: #ed6b00;");
	} else {
		if(	$(".nav-searchbar").val().trim() === "" &&
			!$(".nav-searchbar").is(":focus") &&
			!$(".nav-search-icon-style").is(":focus") &&
			!$(".nav-search-text").is(":focus"))
		{
			$(".nav-searchbar").removeClass("active");//.attr("style","background-color:#546f7a;");
			$(".nav-search-icon-style").removeClass("active");//.attr("style","background-color: #546f7a;color: #fff;");
			$(".nav-search-text").removeClass("active");//.attr("style","background-color:#455a63;color:#fff;");
		}
	}
}
