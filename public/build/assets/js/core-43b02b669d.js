$(document).ready(function(){$("i").hover(function(){$(this).tooltip("show")},function(){$(this).tooltip("hide")})}),$(document).ready(function(){$("div#dashboard-icon > i").click(function(){$("div#dashboard").css("marginLeft")<"0px"?$("div#dashboard").animate({marginLeft:0},function(){$("div#dashboard-icon > i").removeClass(),$("div#dashboard-icon > i").attr("data-original-title","Close Dashboard"),$("div#dashboard-icon > i").addClass("fa fa-angle-double-left"),$("div#dashboard-icon").css("left","261px")}):$("div#dashboard").animate({marginLeft:-1e3},function(){$("div#dashboard-icon > i").removeClass(),$("div#dashboard-icon > i").attr("data-original-title","Open Dashboard"),$("div#dashboard-icon > i").addClass("fa fa-angle-double-right"),$("div#dashboard-icon").css("left","0")})}),$("i").hover(function(){$(this).tooltip("show")},function(){$(this).tooltip("hide")})});
//# sourceMappingURL=core.js.map
