$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
var caret="|";

$(".pub_checkbox").click(function (){
  if(caret.indexOf(this.id)== -1){
    caret=caret+this.id+"|";
  }
  else if (caret.indexOf(this.id)!= -1){
    var pos=caret.indexOf(this.id);
    caret=caret.substring(0, (pos-1))+caret.substring((pos+1));
  }
});

function caretSet (action){
  var actionLink=$("#caretForm").attr("action");
  actionArray=actionLink.split(000);
  $("#caretForm").attr("action", actionArray[0]+action+"-"+caret);
  $('#saveButton').click();
}
