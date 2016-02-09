$(document).ready(function() {
    get_activities();
});

var timeOut = 0;
var topCheck = false;
$(window).on("scroll", function() {
    var feedOffset = $("#activity-feed").offset().top;
    var feedHeight = $("#activity-feed").height();
    var winHeight = $(window).height();
    var scrollTop = $(window).scrollTop();
    var scrollBottom = $(window).scrollTop() + feedOffset;

    // TODO - Add small empty space at the bottom for loader
    // and accommodate for this
    if ((winHeight + scrollTop) >= (feedOffset + feedHeight) && timeOut !== 1) {
        timeOut = 1;
        get_activities();
    }

    if (scrollBottom < -1 && timeOut !== 1) {
        //alert( $(this).text() + ' was scrolled to the top' );
        timeOut = 1;
        topCheck = true;
        get_activities();
    }
});

function get_activities() {
    var activity_feed = $("#activity-feed");
    var current_page = activity_feed.attr("data-page"); // add this to the div when available
    var new_page = 0;
    if (topCheck != 1) {
        new_page = parseInt(current_page) + 1;
    }

    $.ajax({
        type: "get",
        url: activity_feed.attr("data-url") + "?page=" + new_page,
        async: true,
        beforeSend: function() {
            $(".loading").show();
        },
        complete: function(jqHXR, status) {
            //
            $("#loading-content").fadeOut(200);
        },
        success: function(response) {
            if (topCheck === true) {
                $(activity_feed).html(response);
            } else {
                activity_feed.append(response);
            }
            setTimeout(function() {
                timeOut = 0;
                topCheck = false;
            }, 550);
            activity_feed.attr("data-page", new_page);

            // if (response.status == 'ok') {
            // 	activity_feed.attr("data-page", new_page);
            // 	$.each(response.data, function(index, value){
            //
            // 	});
            // } else {
            //
            // }
        }
    });
}
