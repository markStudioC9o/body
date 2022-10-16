$(document).on("click", ".block-tex-title", function (e) {
  var id = $(this).children().attr("id");
  var output = new Object();
  var cssProperties = $(this)
    .children(".tit_elm")
    .css([
      "color",
      "line-height",
      "font-size",
      "font-weight",
      "margin-top",
      "margin-left",
      "margin-right",
      "margin-bottom",
    ]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });
  if (!$(this).hasClass("active")) {
    $(".element-bord").removeClass("active");
    $(this).addClass("active");
    var col = $("#" + id);
    if (!!!col) {
      var color = $("#" + id).data("color");
    } else {
      var color = "";
    }
    $.post(
      "/admin/articles/param-title",
      { color: color, id: id, output: output },
      Success
    );
    function Success(data) {
      $(".block-parametrs").html(data);
    }
  }
});
// $(document).on("paste", ".title-text", function (event) {
//   event.preventDefault();
//   var clipboardData = window.event.clipboardData.getData("text");
//   if ($(this).children("span.titleLiner").length) {
//     $(this).append(clipboardData);
//     $(this).prepend("<span class='titleLiner'></span>");
//   } else {
//     $(this).append(clipboardData);
//   }
// });
$(document).on("change", "#templateTitle", function (e) {
  var val = $(this).val();
  var id = $("#paramIdOp").val();
  console.log(val);
  if (val == "notliner") {
    $("#" + id + " span.titleLiner").remove();
  } else {
    $("#" + id).prepend('<span class="titleLiner"></span>');
  }
});
$(document).on("input keyup", "#line-height-param", function (e) {
  var val = $(this).val();
  var id = $("#paramIdOp").val();
  var col = $("#" + id);
  col.css("line-height", val + "px");
});
$(document).on("input keyup", "#title-fonts-param", function (e) {
  var val = $(this).val();
  var id = $("#paramIdOp").val();
  var col = $("#" + id);
  col.css("font-size", val + "px");
});

$(document).on("click", "#ul-title-align .nav-link", function (e) {
  var pos = $(this).data("pos");
  var id = $("#paramIdOp").val();
  $("#" + id).css("text-align", "-webkit-" + pos);
});

$(document).on("change", "#fontWeightTitle", function (e) {
  var val = $(this).val();
  var id = $("#paramIdOp").val();
  var col = $("#" + id);
  col.css("font-weight", val);
});
$(document).on("change", "#colorTitH1", function (e) {
  var id = $("#paramIdOp").val();
  var col = $("#" + id);
  col.css("color", $(this).val());
  col.attr("data-color", $(this).val());
  if (col.children("div").hasClass("default")) {
    $("#" + id + " span.titleLiner").css("background", $(this).val());
  }
});