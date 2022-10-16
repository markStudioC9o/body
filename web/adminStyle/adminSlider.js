$("#slideritem-image").change(function (e) {
  if (window.FormData === undefined) {
    alert("В вашем браузере FormData не поддерживается");
  } else {
    var f = document.getElementById("slideritem-image");
    var rd = new FileReader(); // Создаем объект чтения файла
    var files = f.files[0]; // Получаем файлы в файловом компоненте
    rd.readAsDataURL(files); // чтение файла заменено на тип base64
    rd.onloadend = function (e) {
      // После загрузки получаем результат и присваиваем его img
      //console.log(this.result.clientWidth);
      //document.getElementById("book-pic").src = this.result;
      //var imges = '<img src="' + this.result + '">';
      //$('.wid-im').css('background-image', 'url("'+this.result+'")');
      //let image = '';

      let im = new Image();

      im.src = this.result;
      im.style = "max-width: 100%";
      $(".wid-im").html(im);
      var param = new Object();

      im.onload = function () {
        param["rel-size"] = im.naturalWidth + " x " + im.naturalHeight;
        param["load-size"] = im.width + "x" + im.height;
        param["size"] = Math.round(files.size / 1024) + "KB";
        param["type"] = files.type;
        var dester = "<ul>";
        $.each(param, function (prop, value) {
          dester = dester + "<li>" + value + "</li>";
          
        });
        dester = dester + "</ul>";
        $(".wid-im").append(dester);
      };
      
    };
  }
});

$("#sliderlang-image").change(function (e) {
  if (window.FormData === undefined) {
    alert("В вашем браузере FormData не поддерживается");
  } else {
    var f = document.getElementById("sliderlang-image");
    var rd = new FileReader(); // Создаем объект чтения файла
    var files = f.files[0]; // Получаем файлы в файловом компоненте
    rd.readAsDataURL(files); // чтение файла заменено на тип base64
    rd.onloadend = function (e) {
      // После загрузки получаем результат и присваиваем его img
      //console.log(this.result.clientWidth);
      //document.getElementById("book-pic").src = this.result;
      //var imges = '<img src="' + this.result + '">';
      //$('.wid-im').css('background-image', 'url("'+this.result+'")');
      //let image = '';

      let im = new Image();

      im.src = this.result;
      im.style = "max-width: 100%";
      $(".wid-im").html(im);
      var param = new Object();

      im.onload = function () {
        param["rel-size"] = im.naturalWidth + " x " + im.naturalHeight;
        param["load-size"] = im.width + "x" + im.height;
        param["size"] = Math.round(files.size / 1024) + "KB";
        param["type"] = files.type;
        var dester = "<ul>";
        $.each(param, function (prop, value) {
          dester = dester + "<li>" + value + "</li>";
          
        });
        dester = dester + "</ul>";
        $(".wid-im").append(dester);
      };
      
    };
  }
});

// var width = img;
// var height = img.clientHeight;
