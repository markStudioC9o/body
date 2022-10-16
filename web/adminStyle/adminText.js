$(document).on("click", ".content-text-redactor", function (e) {
  $(".content-text-redactor")
    .not(this)
    .closest(".poor-block")
    .children(".tool-sf")
    .remove();
  var id = $(this).data("id");
  var obj = $(this);
  var elem = $(this).closest(".poor-block");
  
  var fonts = $(this).children('.contrel-text').css("font-size");
  var line = $(this).children('.contrel-text').css("line-height");
  var wight = $(this).children('.contrel-text').css("font-weight");
  var border = $(this).children('.contrel-text').css("border-radius");

  $.post("/admin/text-block/setting", { id: id }, Success);
  function Success(data) {
    if (elem.find(".tool-sf").length) {
    } else {
    elem.append(data);
    $('.form-tip[data-reb="' + id + '"] option[value='+fonts.replace(/[^\d]/g, "")+']').prop('selected', true);
    $('.lh-tip[data-reb="' + id + '"]').val(line.replace(/[^\d]/g, ""));
    $('#wight-param[data-reb="' + id + '"] option[value='+wight.replace(/[^\d]/g, "")+']').prop('selected', true);
    }
  }
  $("#block-temp-left-d").css("display", "none");
  if (
    !$(this).parent(".poor-block").hasClass("active") &&
    !$(this).closest(".poor-block").hasClass("active")
  ) {
    if (obj.closest(".block-accardion-page").length) {
      if (!obj.closest(".block-accardion-page").hasClass("active")) {
        $(".block-accardion-page").removeClass("active");
        obj.closest(".block-accardion-page").addClass("active");
        GetTextParam(obj, id);
      }
    } else {
      $(".block-accardion-page").removeClass("active");
      GetTextParam(obj, id);
    }
  } else {
    if (obj.closest(".block-accardion-page").length) {
      if (!obj.closest(".block-accardion-page").hasClass("active")) {
        $(".block-accardion-page").removeClass("active");
        obj.closest(".block-accardion-page").addClass("active");
        GetTextParam(obj, id);
      }
    }
  }
});

function GetTextParam(obj, id) {
  var output = new Object();
  var cssProperties = obj.css([
    "background-color",
    "color",
    "line-height",
    "font-size",
    "font-weight",
    "margin-top",
    "margin-left",
    "margin-right",
    "margin-bottom",
    "padding-top",
    "padding-left",
    "padding-bottom",
    "padding-right",
    "border",
    "border-right-width",
    "border-left-width",
    "border-top-width",
    "border-bottom-width",
    "border-color",
    "border-style",
    "border-radius"
  ]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });
  console.log(output);
  var CssProp = obj
    .children(".contrel-text")
    .css(["line-height", "font-size", "font-weight"]);
  $.each(CssProp, function (prop, value) {
    output[prop] = value;
  });
  //console.log(output);
  $.post("/admin/text-block/param", { id: id, output: output }, Success);
  function Success(data) {
    $(".block-parametrs").html(data);
    if (obj.hasClass("border-set")) {
      $('#paramSelectText option[value="border"]').prop("selected", true);
      $(".border_sizes").css("display", "block");
    }

    if (obj.hasClass("color-set")) {
      $('#paramSelectText option[value="color"]').prop("selected", true);
      $(".color_sizes").css("display", "block");
    }
    if (obj.hasClass("colorBorder-set")) {
      $('#paramSelectText option[value="colorBorder"]').prop("selected", true);
      $(".colorBorder_sizes").css("display", "block");
    }
  }
}

$(document).on("change", "#paramSelectText", function (e) {
  var id = $(this).data("id");
  var val = $(this).val();
  $(".prm_off").css("display", "none");
  $("." + val + "_sizes").css("display", "block");
  if (val == "color") {
    var color = $("#colorText_" + id).val();
    var colorMain = $("#colorMainText_" + id).val();
    ColorBorderSet(0, 0, 0, 0, id);
    ColBorder(0, 0, id);
    ColgCol(color, colorMain, id);
    $("." + id + "_opens").removeClass("colorBorder-set");
    $("." + id + "_opens").removeClass("border-set");
    $("." + id + "_opens").addClass("color-set");
  }
  if (val == "border") {
    ColgCol(0, 0, id);
    ColorBorderSet(0, 0, 0, 0, id);
    var color = $("#colorBorder_" + id).val();
    var borderMain = $("#sizeBorder_" + id).val();
    $("." + id + "_opens").removeClass("color-set");
    $("." + id + "_opens").removeClass("colorBorder-set");
    $("." + id + "_opens").addClass("border-set");
    ColBorder(color, borderMain, id);
    $(".def-et").val("2");
  }
  if (val == "colorBorder") {
    $("." + id + "_opens").removeClass("border-set");
    $("." + id + "_opens").removeClass("color-set");
    $("." + id + "_opens").addClass("colorBorder-set");
    ColgCol(0, 0, id);
    ColBorder(0, 0, id);
    var colorBorder = $("#colorSetBorder_" + id).val();
    var sizeBorder = $("#sizeSetBorder_" + id).val();
    var colorText = $("#colorSetMainText_" + id).val();
    var BgText = $("#colorSetText_" + id).val();

    ColorBorderSet(colorBorder, sizeBorder, colorText, BgText, id);
  }
  if (val == "default") {
    $("." + id + "_opens").removeClass("border-set");
    $("." + id + "_opens").removeClass("color-set");
    $("." + id + "_opens").removeClass("colorBorder-set");
    ColgCol(0, 0, id);
    ColorBorderSet(0, 0, 0, 0, id);
    ColBorder(0, 0, id);
  }
});
$(document).on("change", ".border-param", function (e) {
  var id = $(this).data("id");
  var val = $(this).val();
  var color = $("#colorBorder_" + id).val();
  var pos = $(this).data("pos");
  if (color != 0 && val != 0) {
    $("." + id + "_opens").css("border-" + pos + "-width", val + "px");
    $("." + id + "_opens").css("border-color", color);
    $("." + id + "_opens").css("border-style", "solid");
  } else {
    $("." + id + "_opens").css("border-" + pos + "-width", "0");
  }
});
$(document).on("change", ".color-param-text", function (e) {
  var id = $(this).data("id");
  var color = $(this).val();
  var val = $("#sizeBorder_" + id).val();
  ColBorder(color, val, id);
});
$(document).on("change", ".color-param", function (e) {
  var id = $(this).data("id");
  var color = $(this).val();
  if ($(this).hasClass("bg")) {
    var colorTx = $(".color-param.tx").val();
    ColgCol(color, colorTx, id);
  }
  if ($(this).hasClass("tx")) {
    var colorTx = $(".color-param.bg").val();
    ColgCol(colorTx, color, id);
  }
});

function ColgCol(color, colorMain, id) {
  if (color != 0 && colorMain != 0) {
    $("." + id + "_opens").css("background-color", color);
    $("." + id + "_opens").css("color", colorMain);
  } else {
    $("." + id + "_opens").css("background-color", "transparent");
    $("." + id + "_opens").css("color", "#212529");
  }
}
function ColBorder(color, borderMain, id) {
  if (color != 0 && borderMain != 0) {
    $("." + id + "_opens").css("border-right-width", borderMain + "px");
    $("." + id + "_opens").css("border-color", color);
    $("." + id + "_opens").css("border-style", "solid");
  }
}

function ColorBorderSet(colorBorder, sizeBorder, colorText, BgText, id) {
  if (colorBorder != 0 && colorText != 0 && BgText != 0 && sizeBorder != 0) {
    var line = sizeBorder + "px solid " + colorBorder;
    $("." + id + "_opens").css("background", BgText);
    $("." + id + "_opens").css("color", colorText);
    $("." + id + "_opens").css("border", line);
  } else {
    $("." + id + "_opens").css("background", "transparent");
    $("." + id + "_opens").css("color", "#212529");
    $("." + id + "_opens").css("border", "none");
  }
}

$(document).on("click", "#add-list-ul", function (e) {
  var rand = randomInteger(1, 999) + "list" + randomInteger(1, 999);
  var panel =
    '<div class="step-block"><span class="up-bs"><i class="fa fa-arrow-up"></i></span><span class="down-bs"><i class="fa fa-arrow-down"></i></span><span class="del-bs"><i class="fa fa-trash"></i></span></div>';
  var data =
    "<div class='poor-block'><div class='list-block-ul' id='" +
    rand +
    "' data-id='" +
    rand +
    "'><ul data-id='" +
    rand +
    "'><li>123<li></ul></div>" +
    panel +
    "</div>";
  MainBlock.append(data);
});

// $(document).on('click', '.list-block-ul', function(e){
//   var id = $(this).data('id');
//   $.post('/admin/articles/add-ul',{id: id},Success);
//   function Success(data){
//    $('.block-parametrs').html(data);
//   }
// })
$(document).on("change", ".set-border-color", function (e) {
  var val = $(this).val();
  var type = $(this).data("type");
  var id = $(this).data("id");
  if (type == "border-width") {
    $("." + id + "_opens").css(type, val + "px");
  } else {
    $("." + id + "_opens").css(type, val);
  }
});

$(document).on("change", ".set-border-rad", function (e) {
  var val = $(this).val();
  var type = $(this).data("type");
  var id = $(this).data("id");
  if (type == "border-radius") {
    $("." + id + "_opens").css(type, val + "px");
  } else {
    $("." + id + "_opens").css(type, val);
  }
});
