$(function () {
  $('#more_options').toggle();
});

$('#publication_date').click( function (){
  $('#datetimepicker1').datetimepicker({format: 'DD/MM/YYYY'});
});

function showMore () {
  $('#more_options').toggle();
};
