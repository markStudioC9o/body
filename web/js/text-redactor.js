// $(document).on("click", ".add-te", function (e) {
// if ($(this).find("span.clop")) {
//   $("span.clop").remove();
// }
// var output = new Object();
// var cssProperties = $(this)
//   .parent(".element-bord")
//   .children(".img-wrap")
//   .css(["margin-left", "margin-right", "margin-top", "margin-bottom"]);
// $.each(cssProperties, function (prop, value) {
//   output[prop] = value;
// });

// var cssProp = $(this).css(["line-height"]);

// var outputsr = new Object();
// $.each(cssProp, function (prop, value) {
//   outputsr[prop] = value;
// });

// $("#block-temp-left-d .line-hg").val(
//   outputsr["line-height"].replace("px", "")
// );

// var tag = $(this).data("tag");
// $("#block-temp-left-d").css("display", "block");
// if ($("#block-temp-left-d").data("tag")) {
//   $("#block-temp-left-d").data("tag", tag);
//   $('input[data-param="text-imger"]').data("id", tag);
// } else {
//   $("#block-temp-left-d").attr("data-tag", tag);
//   $('input[data-param="text-imger"]').attr("data-id", tag);
// }
// var html = $(this).html();
// var area = $(this).attr("data-art");
// $("#my-textarea").val(html);
// $(".redactor-editor").html(area);
// $("#block-temp-left-d input[type='number'][data-param='text-imger']").each(
//   function (e) {
//     var type = $(this).data("type");
//     $(this).val(output[type].replace("px", ""));
//   }
// );
// });

$(document).on("click", ".add-te", function (e) {
  if (!$(this).closest(".poor-block").hasClass("active")) {
    var id = $(this).data("tag");
    var elems = $(this);
    var fonts = $(this).css("font-size");
    var line = $(this).css("line-height");
    var wight = $(this).css("font-weight");
    $.post("/admin/text-block/setting", { id: id }, Success).then(function(){
      if (elems.find(".gap-text").length) {
        var hetGal = elems.find(".gap-text").css("height");
        $('.lh-gap[data-reb="' + id + '"]').val(hetGal.replace(/[^\d]/g, ""));
      }else{
        console.log('No gap!');  
      }
    });
    function Success(data) {
      $(".tool-sf").remove();
      elems.closest(".element-bord").append(data);
      $('.form-tip[data-reb="' + id + '"]').val(fonts.replace(/[^\d]/g, ""));
      $('.lh-tip[data-reb="' + id + '"]').val(line.replace(/[^\d]/g, ""));
      $('#wight-param[data-reb="' + id + '"]')
        .val(wight.replace(/[^\d]/g, ""))
        .change();
    }
  }
});

$(document).on("change", ".form-tip", function (e) {
  //e.preventDefault();
  var val = $(this).val();
  var id = $(this).data("reb");
  if (window.getSelection() == "") {
    if ($(".add-te.tefg-" + id).length) {
      $(".add-te.tefg-" + id).css("font-size", val + "px");
    }
    if ($('.est-text[data-id="' + id + '"]').length) {
      $('.est-text[data-id="' + id + '"]').css("font-size", val + "px");
    }
    if ($('.contrel-text[data-reb="' + id + '"]').length) {
      $('.contrel-text[data-reb="' + id + '"]').css("font-size", val + "px");
    }
  } else {
    execFontSize(val, "px");
  }
  return false;
});

$(document).on("change", "#wight-param", function (e) {
  var val = $(this).val();
  var id = $(this).data("reb");
  // if (window.getSelection() == "") {
  if ($('.est-text[data-id="' + id + '"]').length) {
    $('.est-text[data-id="' + id + '"]').css("font-weight", val);
  }
  if ($(".tefg-" + id).length) {
    $(".tefg-" + id).css("font-weight", val);
  }
  if ($('.contrel-text[data-reb="' + id + '"]').length) {
    $('.contrel-text[data-reb="' + id + '"]').css("font-weight", val);
  }
  // } else {
  //   execWeightSize(val);
  // }
  return false;
});

var execWeightSize = function (size) {
  var range = new Range();
  var sel = window.getSelection();
  var range = sel.getRangeAt(0);
  var node = range.startContainer;
  var fZ = node.parentNode.style.getPropertyValue("font-size");
  console.log(size);
  if (!!!fZ) {
    var spanString = $("<span/>", {
      text: window.getSelection(),
    })
      .css("font-weight", size)
      .css("font-size", fZ)
      .prop("outerHTML");
  } else {
    var spanString = $("<span/>", {
      text: window.getSelection(),
    })
      .css("font-weight", size)
      .prop("outerHTML");
  }
  document.execCommand("insertHTML", false, spanString);
};

var execFontSize = function (size, unit) {
  var range = new Range();
  var sel = window.getSelection();
  var range = sel.getRangeAt(0);
  var node = range.startContainer;
  // var fZ = node.parentNode.style.getPropertyValue("font-size")
  var fW = node.parentNode.style.getPropertyValue("font-weight");
  if (fW) {
    var spanString = $("<span/>", {
      text: document.getSelection(),
    })
      .css("font-weight", fW)
      .css("font-size", size + unit)
      .prop("outerHTML");
  } else {
    var spanString = $("<span/>", {
      text: document.getSelection(),
    })
      .css("font-size", size + unit)
      .prop("outerHTML");
  }
  document.execCommand("insertHTML", false, spanString);
  return false;
};

$(document).on("change", ".lh-tip", function (e) {
  var val = $(this).val();
  var id = $(this).data("reb");
  if ($(".add-te.tefg-" + id).length) {
    $(".add-te.tefg-" + id).css("line-height", val + "px");
  }
  if ($('.est-text[data-id="' + id + '"]').length) {
    $('.est-text[data-id="' + id + '"]').css("line-height", val + "px");
  }
  if ($('.contrel-text[data-reb="' + id + '"]').length) {
    $('.contrel-text[data-reb="' + id + '"]').css("line-height", val + "px");
  }
});
$(document).on("click", ".redactor-dropdown.custom-redactor a", function (e) {
  e.preventDefault();
  var val = $(this).data("type");
  var id = $(this).data("reb");
  if (window.getSelection() == "") {
    if ($(".add-te.tefg-" + id).length) {
      $(".add-te.tefg-" + id).css("text-align", val);
    }
    if ($('.est-text[data-id="' + id + '"]').length) {
      $('.est-text[data-id="' + id + '"]').css("text-align", val);
    }
    if ($('.contrel-text[data-reb="' + id + '"]').length) {
      $('.contrel-text[data-reb="' + id + '"]').css("text-align", val);
    }
  }
});
$(document).on("click", ".fa-ad-text", function (e) {
  1;
  var elem = $(this).closest(".setColBlock").siblings(".elga");
  var width = $(this).closest(".param-colum").css("width");

  $.post("/admin/colum/add-text", { width: width }, Success);

  function Success(data) {
    var res = JSON.parse(data);
    console.log(res);
    elem.html(res.textBlock);
    elem.addClass(res.randId);
    elem.attr("data-first", res.randId);
    elem.addClass("text-bb");
    $(".block-parametrs").html(res.temp);
  }
});

$(document).on("click", ".est-text", function (e) {
  var id = $(this).data("id");
  var elems = $(this);
  var fonts = $(this).css("font-size");
  var line = $(this).css("line-height");
  var wight = $(this).css("font-weight");
  var glow = $(this).closest(".param-colum").css("flex-grow");

  $.post("/admin/text-block/setting",
    { id: id, glow: glow },
    Success).then(function(){
      if (elems.find(".gap-text").length) {
        var hetGal = elems.find(".gap-text").css("height");
        console.log(hetGal.replace(/[^\d]/g, ""), id);
        $('.lh-gap[data-reb="' + id + '"]').val(hetGal.replace(/[^\d]/g, ""));
      }else{
        console.log('No gap!');  
      }
    }).catch(function(){
      console.log('Error!');
    });
  function Success(data) {
    $(".tool-sf").remove();
    elems.closest(".elga").append(data);
    $(
      '.form-tip[data-reb="' +
        id +
        '"] option[value=' +
        fonts.replace(/[^\d]/g, "") +
        "]"
    ).prop("selected", true);
    $('.lh-tip[data-reb="' + id + '"]').val(line.replace(/[^\d]/g, ""));
    $(
      '#wight-param[data-reb="' +
        id +
        '"] option[value=' +
        wight.replace(/[^\d]/g, "") +
        "]"
    ).prop("selected", true);
    var output = new Object();
    var cssProperties = elems.css([
      "color",
      "line-height",
      "font-size",
      "font-weight",
      "padding-top",
      "padding-left",
      "padding-right",
      "padding-bottom",
    ]);
    $.each(cssProperties, function (prop, value) {
      output[prop] = value;
    });
    var width = elems.closest(".param-colum").css("width");
    $.post(
      "/admin/colum/param",
      { id: id, output: output, width: width, glow: glow },
      Succ
    );
    function Succ(data) {
      $(".block-parametrs").html(data);
    }
    
  }
});

$(document).on("change", ".widthColum", function (e) {
  var id = $(".id-block-text-col").val();
  $(".elga." + id + ".text-bb")
    .parent(".param-colum")
    .css("width", $(this).val() + "px");
});
