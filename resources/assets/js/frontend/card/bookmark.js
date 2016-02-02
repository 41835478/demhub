$(document).ready(function(e){
    console.log("Getting started");
    $("form.bookmark").submit(function(e){
        e.preventDefault();

        var bookmark_target = this;
        console.log("The bookmark target is " + bookmark_target.action);

        $.ajax({
            type: 'post',
            url: bookmark_target.action,
            async: true,
            cache: false,
            dataType: 'json',
            // data: $('form.bookmark').serialize(),
            beforeSend: function() {
                //$("#validation-errors").hide().empty();
            },
            complete: function(jqHXR, status) {
                $("#loading-content").fadeOut(200);
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
