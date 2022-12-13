// var content = document.getElementById("widget-content");

// var descriptor = Object.getOwnPropertyDescriptor(
//   HTMLTextAreaElement.prototype,
//   "value"
// );
// Object.defineProperty(content, "value", {
//   set(value) {
//     this.dispatchEvent(new Event("input"));
//     var s = descriptor.set.call(this, value);
//     $(".widget-footer").html(s);
//   },
//   get() {
//     //return descriptor.get.call(this);
//     var v = descriptor.get.call(this);
//     $(".widget-footer").html(v);
//   },
// });
$("#widget-image").change(function (e) {
  if (window.FormData === undefined) {
    alert("В вашем браузере FormData не поддерживается");
  } else {
    var f = document.getElementById("widget-image");
    var rd = new FileReader(); // Создаем объект чтения файла
    var files = f.files[0]; // Получаем файлы в файловом компоненте
    rd.readAsDataURL(files); // чтение файла заменено на тип base64
    rd.onloadend = function (e) {
      // После загрузки получаем результат и присваиваем его img
      console.log(this.result);
      //document.getElementById("book-pic").src = this.result;
      var imges = '<img src="'+this.result+'">';
      //$('.wid-im').css('background-image', 'url("'+this.result+'")');
      $('.wid-im').html(imges);
    };
  }
});

$("#widget-title").on("change", function(e){
  var val = $(this).val();
  var headrWidget = '<div class="widget-header">'+val+'</div>';
  if($(".default-widget").find(".widget-header").length){
    $(".default-widget").find(".widget-header").html(val);
  }else{
    $(".default-widget").prepend(headrWidget);
  }
});


$( "#accordion" ).accordion({
  collapsible: true,
  active: false
});

$(document).on('keyup', '.redactor-editor', function(e){
  //alert('123');
  var html = $('#widget-content').val();
  console.log(html);
  if(html != ''){
    var footer = '<div class="widget-footer">'+html+'</div>';
    $(".widget-footer").remove();
    $(".default-widget").append(footer);
  }else{
    if($(".widget-footer").length){
      $(".widget-footer").remove();
    }
  }
  console.log();
})