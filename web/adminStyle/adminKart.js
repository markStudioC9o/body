$(document).ready(function(e){
    $('.dels').click(function() {
        var id = $(this).data('id');
        let isConfirmed = confirm('Точно удалить?');
        if (isConfirmed) {
            $.post('/admin/headings/delete', {id: id}, Success);
            function Success(data){
                if(data){
                    document.location = document.location;
                }else{
                    alert('Ошибка');
                }
                
            }
        };
    });

    
});

$(document).on('click', '#sevaHeadingImg', function(e){
  var formData = new FormData();
  formData.append("file", $("#headingBanner")[0].files[0]);
  $.ajax({
    type: "post",
    url: "/admin/headings/save-image",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      var result = JSON.parse(response);
      console.log(response.path);
      var id = $('.id_heading').val();
      $.post(
        "/admin/headings/save-image-head",
        {
          img: result.path,
          id: id,
        },
        Success
      );
      function Success(data) {
        console.log(data);
      }
    },
  });
});