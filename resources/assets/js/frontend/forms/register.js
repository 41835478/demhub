function pageUpdate(){
  if(!$('#user_name').val() || !$('#email').val() || !$('#password').val()) {
  // $("#sign-up-form").slideUp();
  $('#modalErrorButton').click();
  }
  else {
    $('#modalSuccessButton').click();
  }
}
function updateForm(){
  // document.getElementById("form-part-1").style.display="none";
  document.getElementById("form-part-2").style.display="";
}
