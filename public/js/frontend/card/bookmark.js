$(document).ready(function(e){
    console.log("Getting started");
    $("form.bookmark").submit(function(e){
        e.preventDefault();

        var bookmark_target = this;
        var span_target     = "#" + bookmark_target.id + " .bookmark-tag";
        var loader_target   = "#" + bookmark_target.id + " .loader";
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
                $(loader_target).fadeOut(200);
                if (unbookmark) {
                    $(span_target).replaceWith(
                        "<span class='bookmark-tag'><i class='glyphicon glyphicon-plus'></i> BOOKMARK</span>"
                    )
                    button_target = $(span_target).parent().removeClass('btn-greytone').addClass('btn-style-alt');
                } else {
                    $(span_target).replaceWith(
                        "<span class='bookmark-tag'><i class='glyphicon glyphicon-ok'></i> UNBOOKMARK</span>"
                    );
                    button_target = $(span_target).parent().addClass('btn-greytone').removeClass('btn-style-alt');
                }
            },
            success: function(data) {
                console.log("Success!");
            },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong. Please Try again later...');
            }
        });

        //prevent the form from actually submitting in browser
        return false;
    });
});
