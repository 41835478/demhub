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

	if(search_has_text()){
		search_focus(true);
	}
});

$(document).on('change', 'select[name="scope"]', function(){
	$(this).parents('form').submit();
});

function search_focus(give_focus){
	if(give_focus){
		$(".nav-searchbar").addClass("active");
		$(".nav-search-icon-style").addClass("active");
		$(".nav-search-text").addClass("active");
	} else {
		if(	!search_has_text() &&
			!$(".nav-searchbar").is(":focus") &&
			!$(".nav-search-icon-style").is(":focus") &&
			!$(".nav-search-text").is(":focus"))
		{
			$(".nav-searchbar").removeClass("active");
			$(".nav-search-icon-style").removeClass("active");
			$(".nav-search-text").removeClass("active");
		}
	}
}

function search_has_text()
{
	var text = '';
	$(".nav-searchbar").each(function(index){
		if($(this).val().trim() !== '')
			text = $(this).val().trim();
	});

	if(text == '')
		return false;
	else
		return text;
}
