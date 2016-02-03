$(document).on('submit', 'form.js-bookmark', function(e){
    e.preventDefault();
    var bookmark_target = this;
    var span_target     = "#" + bookmark_target.id + " .js-bookmark-tag";
    var loader_target   = "#" + bookmark_target.id + " .js-loader";
    // unbookmark : boolean to determine whether an item
    // is being bookmarked or unbookmarked
    var unbookmark      = /unbookmark/i.test(bookmark_target.action) ? true : false;
    var button_target;

    $.ajax({
        type: 'post',
        url: bookmark_target.action,
        async: true,
        beforeSend: function() {
            $(span_target).hide();
            $(loader_target).show();
        },
        complete: function(jqHXR, status) {
            $(loader_target).hide();
            if (unbookmark) {
                bookmark_target.action = bookmark_target.action.replace(/unbookmark/g, "bookmark");
                button_target = $(span_target).parent().removeClass('btn-greytone').addClass('btn-style-alt');
                $(span_target).replaceWith(
                    "<span class='js-bookmark-tag glyphicon glyphicon-plus' aria-hidden='true'></span>"
                );
            } else {
                bookmark_target.action = bookmark_target.action.replace(/bookmark/g, "unbookmark");
                button_target = $(span_target).parent().addClass('btn-greytone').removeClass('btn-style-alt');
                $(span_target).replaceWith(
                    "<span class='js-bookmark-tag glyphicon glyphicon-ok' aria-hidden='true'></span>"
                );
            }
        },
        success: function(data) {
            console.log("Success!");
        },
        error: function(xhr, textStatus, thrownError) {
            alert('Something went to wrong. Please Try again later...');
        }
    });
});
