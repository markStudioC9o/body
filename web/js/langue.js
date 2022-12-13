$(document).on('click', '.checLang', function(e){
var id = $(this).data('id');
$.post('/admin/language-setting/active', {id: id}, Success);
function Success(data){
  if(data == '200'){
    document.location = document.location;
  }
}
});