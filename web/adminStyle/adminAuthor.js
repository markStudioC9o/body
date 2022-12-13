$(document).on('click', '.cherf-author', function(e){
  var id = $(this).data('id');
  $.post('/admin/authors/default-author', {id: id}, Success);
  function Success(data){
    if(data){
      document.location = document.location;
    }
  }
})