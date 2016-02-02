$(document).ready(function(e){
    $(".bookmark").submit(function(){
        e.preventDefault();
        console.log("Test successful");
    //     $.ajax({
    //         type: 'post',
    //         cache: false,
    //         dataType: 'json',
    //         data: $('form.bookmark').serialize(),
    //         beforeSend: function() {
    //             //$("#validation-errors").hide().empty();
    //         },
    //         complete: function(jqHXR, status) {
    //             $("#loading-content").fadeOut(200);
    //         },
    //         success: function(data) {
    //             console.log("Success!");
    //         },
    //         error: function(xhr, textStatus, thrownError) {
    //             alert('Something went to wrong.Please Try again later...');
    //         }
    //     });
    });
});
