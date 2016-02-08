// TODO - Fix this so that it plays nicely with includes/invites.js

$(document).ready(function() {
    $("#feedbackForm").hide();
    $('div#dashboard-icon > i').click(function() {
        $("#feedbackForm").show();
        if ($('div#dashboard').css('right') == '-350px') {
            $('div#dashboard').animate({
                right: '0px'
            }, function() {
                $('div#dashboard-icon > i').removeClass();
                $('div#dashboard-icon > i').addClass('fa fa-angle-double-right');
                $('div#dashboard-icon').css('right', '350px');
            });
        } else if ($('div#dashboard').css('right') == '0px') {
            $('div#dashboard').animate({
                right: '-350px'
            }, function() {
                $('div#dashboard-icon > i').removeClass();
                $('div#dashboard-icon > i').addClass('fa fa-pencil-square-o');
                $('div#dashboard-icon').css('right', '0');
            });
        }
    });

});

function sidebar(action) {
    var dashboard = $("#dashboard");
    if (action == "invite") {
        $("#feedbackForm").hide();
        $("#inviteForm").show();
        dashboard.addClass("open");
    } else if (action == "feedback") {
        $("#feedbackForm").show();
        $("#inviteForm").hide();
        dashboard.addClass("open");
    } else if (action == "close") {
        dashboard.removeClass("open");
    } else if (action == "toggle") {
        if (dashboard.hasClass("open")) {
            dashboard.removeClass("open");
        } else {
            dashboard.addClass("open");
        }
    }
}

function feedbackFormUpdate() {
    if ($("input:checked").length < 3) {
        $('#modalErrorButton').click();
    } else {
        $('#modalSuccessButton').click();
    }
}
