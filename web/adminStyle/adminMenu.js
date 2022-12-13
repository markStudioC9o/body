$(document).ready(function (e) {
  $(".asd_pnkt").on("click", function (e) {
    e.preventDefault();
    $.post("/admin/menu/add-menu", Success);
    function Success(data) {
      $("#reportCon").html(data);
    }
  });

  $(".asd_pnkt_btn").on("click", function (e) {
    e.preventDefault();
    $.post("/admin/menu/add-menu-btn", Success);
    function Success(data) {
      $("#reportConBtn").html(data);
    }
  });
});

$(document).on('click', '.removeImgmenu', function(e){
  let isBoss = confirm("Вы уверены что хотите удалить?");
  let id = $(this).data('id');
  if(isBoss){
    $.post('/admin/menu/remove-icon', {id: id}, Success);
    function Success(data){
      if(data == 'ok'){
        document.location = document.location
      }
    }
  }
});
