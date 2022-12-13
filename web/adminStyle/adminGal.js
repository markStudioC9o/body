var upDown = '<i class="fa fa-arrows-v" aria-hidden="true"></i>';
var leftR = '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>';
var trash = '<i class="fa fa-trash-o" aria-hidden="true"></i>';
var colum = '<i class="fa fa-columns" aria-hidden="true"></i>';

var col =
  '<div class="block-gall-default" style="flex-grow:1; min-height:200px;display: flex;flex-direction: column;"><div class="col-bl" style="width:100%; height:100%;display: flex;flex-grow:1;"><div class="param-bl-col"><span class="pl-col-j">' +
  colum +
  '</span><br><span class="mn-col">' +
  trash +
  '</span></div><div class="bt-pr"><span class="pl-line">' +
  upDown +
  '</span><span class="mn-line">' +
  trash +
  "</span></div></div></div>";
var col2 =
  '<div class="block-gall-default" style="flex-grow:1; min-height:200px;display: flex;flex-direction: column;"><div class="col-bl" style="width:100%; height:100%;display: flex;flex-grow:1;"><div class="param-bl-col"><span class="pl-col-j">' +
  colum +
  '</span><br><span class="mn-col">' +
  trash +
  '</span></div><div class="bt-pr"><span class="pl-line">' +
  upDown +
  "</span></div></div></div>";
var line =
  '<div class="col-bl" style="flex-grow:1;display: flex;width:100%; height:100%"><div class="param-bl-col"><span class="pl-col-j">' +
  colum +
  '</span></div><div class="bt-pr"><span class="pl-line">' +
  upDown +
  '</span><span class="mn-line">' +
  trash +
  "</span></div></div>";

var Mincol =
  '<div class="param-bl-col"><span class="pl-col-j">' +
  colum +
  '</span><br><span class="mn-col">' +
  trash +
  '</span></div><div class="bt-pr"><span class="pl-line">' +
  upDown +
  '</span><span class="mn-line">' +
  trash +
  "</span></div>";

$(document).on("click", ".pl-col", function (e) {
  $(this).parents(".block-gall-default").after(col);
});

$(document).on("click", ".pl-col-a", function (e) {
  $(this).parents(".block-gall-default").after(col2);
});

$(document).on("click", ".mn-col", function (e) {
  $(this).parents(".block-gall-default").remove();
});
$(document).on("click", ".pl-line", function (e) {
  $(this).parents(".col-bl").after(line);
});
$(document).on("click", ".mn-line", function (e) {
  var i = 0;
  $(this)
    .closest(".block-gall-default")
    .children(".col-bl")
    .each(function (index, value) {
      i++;
      return i;
    });
  console.log(i);
  if (i == 1) {
    $(this).closest(".block-gall-default").remove();
  } else {
    $(this).parents(".col-bl").remove();
  }
});

var colMl =
  '<div class="col-ml" style="width:100%"><div class="sled-ty"><span class="trach-dels">' +
  trash +
  '</span></div></div><div class="col-ml" style="width:100%"><div class="sled-ty"><span class="trach-dels">' +
  trash +
  "</span></div></div>";
$(document).on("click", ".pl-col-j", function (e) {
  $(this).closest(".col-bl").html(colMl);
});
$(".fat-plus").on("click", function (e) {
  $("#templateGallery").append(col2);
});
$(document).on("click", ".trach-dels", function (e) {
  $(this).closest(".col-bl").html(Mincol);
});

$(document).on("click", "#saveGallery", function (e) {
  var name = $('#nameSet').val();
  $("#templateGallery .param-bl-col").remove();
  $("#templateGallery .pl-line").remove();
  $("#templateGallery .bt-pr").remove();
  $("#templateGallery .trach-dels").remove();
  var html = $("#templateGallery").html();
  // console.log(htmlGall);
  if(name == ""){
    alert("Введите наименование");
  }else{
    $.post("/admin/articles/save-gall", { html: html, name: name }, Success);
  function Success(data) {
    if(data){
      document.location = document.location;
    }
  }
  }
  
});

$(document).on("click", "#updateGallery", function (e) {
  var id = $(this).data('id');
  var name = $('#nameSet').val();
  $("#templateGallery .param-bl-col").remove();
  $("#templateGallery .pl-line").remove();
  $("#templateGallery .bt-pr").remove();
  $("#templateGallery .trach-dels").remove();
  var html = $("#templateGallery").html();
  // console.log(htmlGall);
  if(name == ""){
    alert("Введите наименование");
  }else{
    $.post("/admin/gallery/save-gall", { id: id, html: html, name: name }, Success);
  function Success(data) {
    if(data){
      document.location = document.location;
    }
  }
  }
  
});



$(document).ready(function (e) {
  var genParam =
    '<div class="param-bl-col"><span class="pl-col-j"><i class="fa fa-columns" aria-hidden="true"></i></span><br><span class="mn-col"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div>';
  var minParam =
    '<div class="sled-ty"><span class="trach-dels"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div>';
  var pent = '<div class="bt-pr"><span class="pl-line"><i class="fa fa-arrows-v" aria-hidden="true"></i></span></div>';
  var temp = $("#templateGallery");
  

  var pert = '<div class="param-bl-col"><span class="pl-col-j"><i class="fa fa-columns" aria-hidden="true"></i></span></div><div class="bt-pr"><span class="pl-line"><i class="fa fa-arrows-v" aria-hidden="true"></i></span><span class="mn-line"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div>';
  if (temp.length) {
    $(".block-gall-default").each(function (e) {
      if ($(this).children(".col-bl").length) {
        var i = 1;
        $(this)
          .children(".col-bl")
          .each(function (e) {

            if ($(this).children(".col-ml").length) {
              $(this)
                .children(".col-ml")
                .each(function (e) {
                  if (!$(this).find(".trach-dels").length) {
                    $(this).html(minParam);
                  }
                });
            } else {
              if(i == 1){
                if (!$(this).children(".param-bl-col").length) {
                  $(this).append(genParam);
                }
                if (!$(this).children(".bt-pr").length) {
                  $(this).append(pent);
                }
              }else{
                if (!$(this).children(".param-bl-col").length) {
                  $(this).append(pert);
                }
              }
              i++
            }
          });
      }
    });
  }
});
