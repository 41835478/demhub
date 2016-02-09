$(document).on('submit', 'form.js-follow', function(e){
    e.preventDefault();
    var follow_target   = this;
    var span_target     = "#" + follow_target.id + " .js-follow-tag";
    var loader_target   = "#" + follow_target.id + " .js-loader";
    // unfollow : boolean to determine whether an item
    // is being followed or unfollowed
    var unfollow      = /unfollow/i.test(follow_target.action) ? true : false;
    var button_target;

    $.ajax({
        type: 'post',
        url: follow_target.action,
        async: true,
        beforeSend: function() {
            $(span_target).hide();
            $(loader_target).show();
        },
        complete: function(jqHXR, status) {
            // TODO - Add feedback for user to confirm that action was completed
            // something similar to a flash alert
            $(loader_target).hide();
            if (unfollow) {
                follow_target.action = follow_target.action.replace(/unfollow/g, "follow");
                button_target = $(span_target).parent().removeClass('btn-greytone').addClass('btn-style-alt');
                $(span_target).replaceWith(
                    "<span class='js-follow-tag glyphicon glyphicon-plus' aria-hidden='true'> FOLLOW</span>"
                );
            } else {
                follow_target.action = follow_target.action.replace(/follow/g, "unfollow");
                button_target = $(span_target).parent().addClass('btn-greytone').removeClass('btn-style-alt');
                $(span_target).replaceWith(
                    "<span class='js-follow-tag glyphicon glyphicon-ok' style='font-size:85%' aria-hidden='true'> UNFOLLOW</span>"
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
