$(document).ready(function(){
    $("#inviteForm").hide();
    $('#invite-icon').click(function(){
        $("#inviteForm").show();
        if ($('#dashboard').css('right') == '-350px'){
            $('#dashboard').animate({
                right:'0px'
            }, function(){
                $('#invite-icon > i').removeClass();
                $('#invite-icon > i').addClass('fa fa-angle-double-right');
                $('#invite-icon').css('right', '350px');
            });
        } else if ($('#dashboard').css('right') == '0px'){
            $('#dashboard').animate({
                right:'-350px'
            }, function(){
                $('#invite-icon > i').removeClass();
                $('#invite-icon > i').addClass('fa fa-envelope-o');
                $('#invite-icon').css('right', '0');
            });
        }
    });

    $("i").hover(
        function(){
            $(this).tooltip('show');
        }, function() {
            $(this).tooltip('hide');
        }
    );

});

function sidebar(action)
{
    var dashboard = $("#dashboard");
    if(action == "invite"){
        $("#feedbackForm").hide();
        $("#inviteForm").show();
        dashboard.addClass("open");
    } else if(action == "close"){
        dashboard.removeClass("open");
    } else if(action == "toggle"){
        if(dashboard.hasClass("open")){
            dashboard.removeClass("open");
        } else {
            dashboard.addClass("open");
        }
    }
}

function feedbackFormUpdate(){
  if($( "input:checked" ).length < 3) {
    $('#modalErrorButton').click();
  } else {
    $('#modalSuccessButton').click();
  }
}
