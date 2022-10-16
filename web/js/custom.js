function AddsImage(){
  $.post('/admin/articles/render-image-gal',Success);
  function Success(data){
    $('#idrety').html(data);
    $("#image").modal("show");
  }
}


$(function () {
  var options = {
    maxLevels: 2,
    insertZone: 50,
    placeholderCss: { "background-color": "#ff8" },
    hintCss: { "background-color": "#bbf" },
    isAllowed: function (cEl, hint, target) {
      if (target.data("module") === "c" && cEl.data("module") !== "c") {
        hint.css("background-color", "#ff9999");
        return false;
      } else {
        hint.css("background-color", "#99ff99");
        return true;
      }
    },
    opener: {
      active: true,
      as: "html",
      close: '<i class="fa fa-minus c3"></i>',
      open: '<i class="fa fa-plus"></i>',
      openerCss: {
        display: "inline-block",
        float: "left",
        "margin-left": "-35px",
        "margin-right": "5px",
        "font-size": "1.1em",
      },
    },
    ignoreClass: "shlot_trof",
  };

  var options1 = {
    maxLevels: 1,
    insertZone: 50,
    placeholderCss: { "background-color": "#ff8" },
    hintCss: { "background-color": "#bbf" },
    isAllowed: function (cEl, hint, target) {
      if (target.data("module") === "c" && cEl.data("module") !== "c") {
        hint.css("background-color", "#ff9999");
        return false;
      } else {
        hint.css("background-color", "#99ff99");
        return true;
      }
    },
    opener: {
      active: true,
      as: "html",
      close: '<i class="fa fa-minus c3"></i>',
      open: '<i class="fa fa-plus"></i>',
      openerCss: {
        display: "inline-block",
        float: "left",
        "margin-left": "-35px",
        "margin-right": "5px",
        "font-size": "1.1em",
      },
    },
    ignoreClass: "shlot_trof_btn",
  };

  $("#sTree2").sortableLists(options);
  $("#sTree3").sortableLists(options1);

  $("#toArrBtn").on("click", function () {
    var data = $("#sTree2").sortableListsToHierarchy();
    //console.log(data);
    $.post("/admin/menu/save-menu", { data: data }, Success);
    function Success(data) {
      if (data) {
        document.location = document.location;
      }
    }
  });

  $("#toArrBtnBottom").on("click", function () {
    var data = $("#sTree3").sortableListsToHierarchy();
    $.post("/admin/menu/save-menu-btn", { data: data }, Success);
    function Success(data) {
      if (data) {
        document.location = document.location;
      }
    }
  });
});

var MainBlock = $("#blockContent");
$("#ad-colom-block").on("click", function (e) {
  $.post("/admin/colum/index", Success);
  function Success(data) {
    MainBlock.append(data);
  }
});

$(document).on("click", ".min", function (e) {
  $(this).closest(".param-colum").remove();
});
var podBlock =
  '<div class="param-colum"><div class="elga"></div><ul class="setLestBlock"><li><span class="pul"><i class="fa fa-plus"></i></span></li><li><span class="min"><i class="fa fa-minus"></i></span></li></ul><ul class="setColBlock"><li class="fa-ad-file"><i class="fa fa-file"></i></li><li class="fa-ad-text">Tt</li><li class="fa-ad-image"><i class="fa fa-image"></i></li></ul></div>';
$(document).on("click", ".pul", function (e) {
  $(this).closest(".param-colum").after(podBlock);
});

//ДВИЖЕНИЕ БЛОКОВ
$(document).on("click", ".down-bs", function (e) {
  var tag1 = $(this).parent(".step-block").parent(".poor-block");
  $(this)
    .parent(".step-block")
    .parent(".poor-block")
    .next(".poor-block")
    .after(tag1);
  console.log("step");
});
$(document).on("click", ".up-bs", function (e) {
  var tag2 = $(this).parent(".step-block").parent(".poor-block");
  $(this)
    .parent(".step-block")
    .parent(".poor-block")
    .prev(".poor-block")
    .before(tag2);
  console.log("step");
});
$(document).on("click", ".del-bs", function (e) {
  var tag2 = $(this).parent(".step-block").parent(".poor-block");
  $(".block-parametrs").html("");
  tag2.remove();
});
$(document).on("click", "#ad-text-block", function (e) {
  $.post("/admin/articles/new-text-block", Success);
  function Success(data) {
    MainBlock.append(data);
  }
});
$(document).on("click", "#ad-text-title", function (e) {
  if (MainBlock.find("#mainH1").length != 0) {
  } else {
    $.post("/admin/articles/new-title-block", { data: "h1" }, Success);
    function Success(data) {
      MainBlock.prepend(data);
    }
  }
});
$(document).on("click", "#ad-head-title", function (e) {
  if ($(".param-colum.active").length) {
    $.post("/admin/articles/new-title-block-in-col", { data: "h2" }, Success);
    function Success(data) {
      $(".param-colum.active").prepend(data);
    }
  } else {
    $.post("/admin/articles/new-title-block", { data: "h2" }, Success);
    function Success(data) {
      MainBlock.append(data);
    }
  }
});
$(document).on("input keyup", ".varibleMar", function (e) {
  var val = $(this).val();
  var id = $("#paramIdOp").val();
  var col = $("#" + id);
  var type = $(this).data("type");
  col.css(type, val + "px");
});

$(document).on("input keyup", ".varibleMar", function (e) {
  var val = $(this).val();
  var id = $("#paramIdOp").val();
  var col = $("#" + id);
  var type = $(this).data("type");
  col.css(type, val + "px");
});

$(document).on("input keyup", "#list-margin-input input", function (e) {
  var val = $(this).val();
  var type = $(this).data("type");
  var block = $(this).data("param");
  var id = $(this).data("id");
  if (block == "text-imger") {
    $("." + block + "_margin_tag." + id + "_opens")
      .siblings(".img-wrap")
      .css(type, val + "px");
  } else {
    if (id != "") {
      if ($("." + id).length) {
        $("." + id).css(type, val + "px");
      } else {
        $("." + block + "_margin_tag." + id + "_opens").css(type, val + "px");
      }
    } else {
      $("." + block + "_margin_tag").css(type, val + "px");
    }
  }
});

$(document).on("input keyup", "#list-padding-input input", function (e) {
  var val = $(this).val();
  var type = $(this).data("type");
  var block = $(this).data("param");
  var id = $(this).data("id");
  console.log(id);

  if (block != "col-text-padding") {
    if (id != "") {
      $("." + block + "_padding_tag." + id + "_opens").css(type, val + "px");
    } else {
      $("." + block + "_padding_tag").css(type, val + "px");
    }
  } else {
    if ($("." + id).length) {
      $("." + id).css(type, val + "px");
    } else {
      if ($("div[data-id='" + id + "']").length) {
        $("div[data-id='" + id + "']").css(type, val + "px");
      }
    }
  }
});

$(document).on("change", "#selectAuthor", function (e) {
  var val = $(this).val();
  if (val) {
    $.post("/admin/articles/selcet-authors", { val: val }, Success);
    function Success(data) {
      if (data) {
        var result = JSON.parse(data);
        html_authors_replacement(result);
      }
    }
  }
});

function html_authors_replacement(data) {
  $(".inf a").html(data.name);
  $(".inf a").attr("href", data.link);
  $(".author_img").css(
    "background-image",
    'url("/authors/' + data.photo + '")'
  );
}

// АВТОРЫ
$(document).on("click", "#ad-author-block", function (e) {
  $.post("/admin/articles/ad-author", Success);
  function Success(data) {
    MainBlock.append(data);
  }
});
$(document).on("click", ".block-author-default", function (e) {
  if (!$(this).hasClass("active")) {
    $(".element-bord").removeClass("active");
    $(this).addClass("active");
  }
  var output = new Object();
  var cssPropert = $(this)
    .find(".author_block")
    .css(["margin-left", "margin-right", "margin-top", "margin-bottom"]);
  $.each(cssPropert, function (prop, value) {
    output[prop] = value;
  });

  $.post("/admin/articles/author-serring", { output: output }, Success);
  function Success(data) {
    $(".block-parametrs").html(data);
  }
});
$(document).on("click", "#ad-share-block", function (e) {
  if (!$(".share-block").length) {
    $.post("/admin/articles/ad-share", Success);
    function Success(data) {
      MainBlock.append(data);
    }
  }
});
$(document).on("click", ".block-share-default", function (e) {
  if (!$(this).hasClass("active")) {
    $(".element-bord").removeClass("active");
    $(this).addClass("active");
  }
});
$("#add-imag").on("click", function (e) {
  AddsImage();
});


$("#img-dowloand").on("click", function (e) {
  if (window.FormData === undefined) {
    alert("В вашем браузере FormData не поддерживается");
  } else {
    var formData = new FormData();
    formData.append("file", $("#input__file")[0].files[0]);
    $.ajax({
      type: "POST",
      url: "/admin/articles/add-image",
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      dataType: "json",
      success: function (data) {
        $("#image").modal("hide");
        $.pjax.reload({ container: "#pajax-modal-img", async: false });
        if ($(".abbred-image").hasClass("in-slider")) {
          var name = $(".abbred-image").data("img_id");
          $('input[name="name-' + name + '"]').val(data.path);
          $(".abbred-image").data("img_id", "");
          $("#image .abbred-image").removeClass("in-slider");
          return false;
        }
        addImageStr(data.path);
      },
    });
  }
});

$(document).on("change", "#signatureImg", function (e) {
  var val = $(this).val();
  if (val != "") {
    $(".dfert-gg").css("display", "block");
  } else {
    $(".dfert-gg").css("display", "none");
  }
  var id = $(this).data("tag");
  var width = $(".img-tag-" + id).width();
  var style =
    "width:" +
    width +
    "px;padding:10px;text-align: center;color: #fff; background: #00A6CA";
  var classT = "signut_padding_tag  " + id + "_opens signut sig-img-" + id;
  var signatur =
    '<div style="' +
    style +
    '" class="' +
    classT +
    '" data-tag="' +
    id +
    '">' +
    val +
    "</div>";
  if ($(".sig-img-" + id).length) {
    if (val == "") {
      $(".sig-img-" + id).remove();
    } else {
      $(".sig-img-" + id).html(val);
    }
  } else {
    $(".img-tag-" + id)
      .parent(".img-wrap")
      .append(signatur);
  }
});

$(document).on("click", ".img-template", function (e) {
  var signut, outputSignut;
  var outputSignut = "";
  var marginTopImg = $(this).find('.img-wrap').css('margin-top');
  var marginTopText = $(this).find('.add-te').css('padding-top');
  
  if (!$(this).hasClass("active")) {
    $(".element-bord").removeClass("active");
    $(".poor-block").removeClass("active");
    $(this).addClass("active");
  }
  var margin = "0";
  if (
    $(this).find(".img-wrap").css("margin-right") != "0" &&
    $(this).find(".img-wrap").css("margin-right") != ""
  ) {
    var margin = $(this).find(".img-wrap").css("margin-right");
  } else {
    if (
      $(this).find(".img-wrap").css("margin-left") != "0" &&
      $(this).find(".img-wrap").css("margin-left") != ""
    ) {
      var margin = $(this).find(".img-wrap").css("margin-left");
    }
  }
  var tag = $(this).data("tag");
  var size = $(this).children(".img-wrap").attr("data-width");
  var output = new Object();
  var cssProperties = $(this).css([
    "margin-left",
    "margin-right",
    "margin-top",
    "margin-bottom",
    "border-radius",
    "padding-left",
    "padding-right",
    "padding-top",
    "padding-bottom",
    "background-color",
  ]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });
  var addPadding = new Object();
  if ($(this).find(".add-te").length) {
    addPadding["left"] = $(this).find(".add-te").css("padding-left");
    addPadding["right"] = $(this).find(".add-te").css("padding-right");
  }
  var imgMargin = new Object();
  if ($(this).find(".img-wrap").length) {
    imgMargin["left"] = $(this).find(".img-wrap").css("margin-left");
    imgMargin["right"] = $(this).find(".img-wrap").css("margin-right");
  }

  var link = $('img[data-tag="' + tag + '"]').attr("data-link");
  var sert = "";
  var modal = "";
  if ($('img[data-tag="' + tag + '"]').hasClass("op-new")) {
    sert = "checked";
  }
  if ($('img[data-tag="' + tag + '"]').hasClass("op-in-modal")) {
    modal = "checked";
  }
  if ($(this).find(".signut").length) {
    var signut = $(this).find(".signut").html();
    var outputSignut = new Object();
    var cssPropert = $(this)
      .find(".signut")
      .css([
        "padding-left",
        "padding-right",
        "padding-top",
        "padding-bottom",
        "color",
        "background",
      ]);
    $.each(cssPropert, function (prop, value) {
      outputSignut[prop] = value;
    });
  }
  var method = $(this).attr('data-method');
  $.post(
    "/admin/articles/img-param",
    {
      tag: tag,
      output: output,
      size: size,
      link: link,
      sert: sert,
      signut: signut,
      outputSignut: outputSignut,
      modal: modal,
      method: method,
      addPadding: addPadding,
      imgMargin: imgMargin,
      marginTopText: marginTopText,
      marginTopImg: marginTopImg
    },
    Success
  );
  function Success(data) {
    $(".block-parametrs").html(data);
  }

  
});



$(document).on("change", ".tab-img-video", function (e) {
  var val = $(this).val();
  var tag = $(this).data("tag");
  $(".img-template[data-tag='" + tag + "'] .img-wrap").css(
    "margin-top",
    val + "px"
  );
});

$(document).on("change", ".tab-block-text", function (e) {
  var val = $(this).val();
  var tag = $(this).data("tag");
  $(".add-te[data-tag='" + tag + "']").css("padding-top", val + "px");
});

$(document).on("change", "#par-im-pos", function (e) {
  var tag = $(this).data("tag");
  var val = $(this).val();
  $(".rower-" + tag).css("text-align", val);
});

$(document).on("change", "#par-im-st", function (e) {
  var tag = $(this).data("tag");
  var val = $(this).val();
  $('.img-template[data-tag="'+tag+'"]').attr('data-method', val);
  if (val == "tex-left" || val == "tex-right") {
    $(".param-tob-bottom").css("display", "block");
  } else {
    $(".img-template[data-tag='" + tag + "'] .img-wrap").css("margin-top", "");
    $(".add-te[data-tag='" + tag + "']").css("padding-top", "");
    $(".param-tob-bottom").css("display", "none");
  }

  $(".tefg-" + tag + ".add-te").removeClass("tex-left");
  $(".tefg-" + tag + ".add-te").removeClass("tex-right");
  if (val == "img-left") {
    imgTextNo(tag, "left", "auto 0 0 0 ");
  }
  if (val == "img-center") {
    imgTextNo(tag, "center", "0 auto");
  }
  if (val == "img-right") {
    imgTextNo(tag, "right", "0 0 0 auto");
  }

  if (val == "tex-bot") {
    if (
      !$(".element-bord.img-template.rower-" + tag)
        .children(".add-te")
        .hasClass("tefg-" + tag)
    ) {
      imgLeftTextRightFloat(val, tag, "left");
    } else {
      imgPosT(tag, "left");
    }
  }

  if (val == "tex-up") {
    if (
      !$(".element-bord.img-template.rower-" + tag)
        .children(".add-te")
        .hasClass("tefg-" + tag)
    ) {
      imgLeftTextRightFloat(val, tag, "right");
    } else {
      imgPosT(tag, "right");
    }
  }

  if (val == "tex-left") {
    if ($(".tefg-" + tag + ".add-te").length) {
      var imgWidth = $(".rower-" + tag)
        .children(".img-wrap")
        .attr("data-width");
      var wid = 100 - imgWidth;

      $(".rower-" + tag)
        .children(".img-wrap")
        .css("order", "inherit");
      $(".rower-" + tag)
        .children(".img-wrap")
        .css("float", "");
      $(".rower-" + tag).css("display", "flex");
      $(".tefg-" + tag).css("width", wid + "%");

      if (
        $(".tefg-" + tag).css("padding-right") != "" &&
        $(".tefg-" + tag).css("padding-right") != "0"
      ) {
        $(".tefg-" + tag).css(
          "padding-left",
          $(".tefg-" + tag).css("padding-right")
        );
        $(".tefg-" + tag).css("padding-right", "0");
      }
    } else {
      $(".rower-" + tag)
        .children(".img-wrap")
        .css("order", "inherit");
      TextNewPos(tag, "left");
    }
    $(".tefg-" + tag + ".add-te").addClass("tex-left");
    $(".tefg-" + tag + ".add-te").removeClass("tex-right");
  }

  if (val == "tex-right") {
    if ($(".tefg-" + tag + ".add-te").length) {
      $(".rower-" + tag)
        .children(".img-wrap")
        .css("order", "1");
      $(".rower-" + tag)
        .children(".img-wrap")
        .css("float", "");
      $(".rower-" + tag).css("display", "flex");
      var imgWidth = $(".rower-" + tag)
        .children(".img-wrap")
        .attr("data-width");
      var wid = 100 - imgWidth;
      $(".tefg-" + tag).css("width", wid + "%");

      if (
        $(".tefg-" + tag).css("padding-left") != "" &&
        $(".tefg-" + tag).css("padding-left") != "0"
      ) {
        $(".tefg-" + tag).css(
          "padding-right",
          $(".tefg-" + tag).css("padding-left")
        );
        $(".tefg-" + tag).css("padding-left", "0");
      }
    } else {
      $(".rower-" + tag)
        .children(".img-wrap")
        .css("order", "1");
      TextNewPos(tag, "right");
    }
    $(".tefg-" + tag + ".add-te").removeClass("tex-left");
    $(".tefg-" + tag + ".add-te").addClass("tex-right");
  }
});

function TextNewPos(tag, pos) {
  $(".rower-" + tag).css("display", "flex");
  var width = $(".rower-" + tag)
    .children(".img-wrap")
    .attr("data-width");

  $(".rower-" + tag)
    .children(".img-wrap")
    .children("img")
    .css("width", "100%");

  $(".rower-" + tag)
    .children(".img-wrap")
    .css("width", width + "%");

  var letWidth = 100 - width;
  var div = conTextFloat(letWidth, tag);

  $(".rower-" + tag).append(div);
}

function imgTextNo(tag, param, sight) {
  $(".tefg-" + tag).remove();
  $(".rower-" + tag)
    .children(".img-wrap")
    .removeAttr("style");
  if (param != "center") {
    $(".rower-" + tag)
      .children(".img-wrap")
      .css("float", param);
    $(".rower-" + tag).css("display", "flow-root");
  } else {
    $(".rower-" + tag)
      .children(".img-wrap")
      .css("margin", "0 auto");
  }

  if ($(".sig-img-" + tag).length) {
    $(".sig-img-" + tag).css("margin", sight);
  }
  var width = $(".rower-" + tag)
    .children(".img-wrap")
    .attr("data-width");

  $(".rower-" + tag)
    .children(".img-wrap")
    .css("width", width + "%");

  if (
    $(".rower-" + tag)
      .children(".img-wrap")
      .children(".signut_padding_tag").length
  ) {
    var wid = $(".rower-" + tag)
      .children(".img-wrap")
      .children("img")
      .width();
    $(".rower-" + tag)
      .children(".img-wrap")
      .children(".signut_padding_tag")
      .css("width", wid + "px");
  }
}

function imgPosT(tag, pos) {
  $(".rower-" + tag)
    .children(".img-wrap")
    .css("float", pos);
  $(".rower-" + tag)
    .children(".img-wrap")
    .css("order", "");
  $(".rower-" + tag).css("display", "block");
  $(".tefg-" + tag).css("width", "inherit");
}
function imgLeftTextRightFloat(val, tag, pos) {
  if ($(".tefg-" + tag + ".add-te").length) {
    $(".tefg-" + tag + ".add-te").removeClass("tex-left");
    $(".tefg-" + tag + ".add-te").removeClass("tex-right");
  }
  $(".rower-" + tag)
    .children(".img-wrap")
    .css("float", pos);
  $(".rower-" + tag)
    .children(".img-wrap")
    .css("order", "");
  var width = $(".rower-" + tag)
    .children(".img-wrap")
    .attr("data-width");

  $(".rower-" + tag)
    .children(".img-wrap")
    .children("img")
    .css("width", "100%");

  $(".rower-" + tag)
    .children(".img-wrap")
    .css("width", width + "%");
  $(".rower-" + tag).css("display", "flow-root");

  var div =
    '<div contenteditable="true" class="add-te text-imger_margin_tag ' +
    tag +
    "_opens tefg-" +
    tag +
    '" data-tag="' +
    tag +
    '">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi dolor provident, officiis iste veritatis ullam ipsam qui molestias quidem repudiandae, atque illo tempore exercitationem quisquam officia impedit dignissimos, eligendi repellat.</div>';
  $(".rower-" + tag).append(div);
}

function conTextFloat(width, tag) {
  var div =
    '<div contenteditable="true" style="width:' +
    width +
    '%" class="flext add-te text-imger_margin_tag ' +
    tag +
    "_opens tefg-" +
    tag +
    '" data-tag="' +
    tag +
    '">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit sint dolore non ad, cum commodi modi perferendis cupiditate tempore quasi accusamus, debitis voluptatum repellat placeat reprehenderit nostrum vitae aliquam animi?</div>';
  return div;
}

$("#ford").on("click", function (e) {
  //console.log($('#my-textarea').val());
  var tag = $("#block-temp-left-d").data("tag");

  var area = $("#my-textarea").val();
  var html = $(".redactor-editor").html();
  console.log(area);
  console.log(html);
  $(".add-te.tefg-" + tag).html(area);
  var lineHei = $("#block-temp-left-d .line-hg").val();
  $(".add-te.tefg-" + tag).css("line-height", lineHei + "px");
  $(".add-te.tefg-" + tag).removeAttr("data-art");
  $(".add-te.tefg-" + tag).attr("data-art", area);

  $("#my-textarea").val("");
  $("#my-textarea").html("");
  $(".redactor-editor").html("");
  $("#block-temp-left-d").css("display", "none");
});

$("#block-temp-left-d .kp").on("click", function (e) {
  $("#block-temp-left-d").css("display", "none");
});
// $('#my-textarea').change(function(e){
//   var val = $(this).val();
//   console.log(val);
//   console.log('der');
// });
// END Add img

let inputs = document.querySelectorAll(".input__file");
Array.prototype.forEach.call(inputs, function (input) {
  let label = input.nextElementSibling,
    labelVal = label.querySelector(".input__file-button-text").innerText;

  input.addEventListener("change", function (e) {
    let countFiles = "";
    if (this.files && this.files.length >= 1) countFiles = this.files.length;

    if (countFiles)
      label.querySelector(".input__file-button-text").innerText =
        "Выбрано файлов: " + countFiles;
    else label.querySelector(".input__file-button-text").innerText = labelVal;
  });
});

$(".saveArticleThis").on("click", function (e) {
  e.preventDefault();
  var textArticles = $("#textPrevArticles").val();
  var titleArticles = $("#titleArticles").val();
  var link = $("#linkArticles").val();
  var val = $("#blockContent");
  $(".element-bord").unwrap(".poor-block");
  $(".sirkle-param-cop").remove();
  $(".step-block").remove();
  $(".setLestBlock").remove();
  $(".setColBlock").remove();
  $(".tool-sf").remove();
  $(".element-bord").removeClass("active");
  $(".title-text").removeAttr("contenteditable");
  $("#mainH1 .title-text").removeAttr("contenteditable");
  $(".poor-block").removeClass("active");
  $(".param-colum").removeClass("active");
  var html = val.html();
  var text = $("#mainH1 .title-text").text();
  if (text == "") {
    text = $("h2 .title-text").text();
  }
  var heading = $(".headingSelect").val();
  var widget = $("#articlesWidget").val();
  var botomBanner = $('select[name="bottom-banner"]').val();
  var articleSiblid = $(".article_siblid").val();
  var lang = $("#ArticlesLang").val();
  var size = $("#ArticlesSize").val();
  var keywords = $('textarea[name="SeoKeywords"]').val();
  var description = $('textarea[name="SeoDescription"]').val();

  if ($("input[name='videoArticles']").prop("checked")) {
    var videoArticles = "2";
  } else {
    var videoArticles = "1";
  }
  if ($("input[name='noindexArticles']").prop("checked")) {
    var noindexArticles = "2";
  } else {
    var noindexArticles = "1";
  }

  if ($('select[name="select-headin"]').length) {
    var mainHeading = $('select[name="select-headin"]').val();
  } else {
    var mainHeading = "";
  }
  var id = $("#idArticles").val();
  if (window.FormData === undefined) {
    alert("В вашем браузере FormData не поддерживается");
  } else {
    var formData = new FormData();
    formData.append("file", $("#prevImageArticles")[0].files[0]);
    $.ajax({
      type: "POST",
      url: "/admin/articles/save-artcles-image",
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      dataType: "json",
    }).done(function (response) {
      console.log(response, "222");
      $.post(
        "/admin/articles/save-artic",
        {
          img_articles: response.path,
          text: textArticles,
          title: titleArticles,
          texter: text,
          html: html,
          heading: heading,
          mainHeading: mainHeading,
          widget_articles: widget,
          articleSiblid: articleSiblid,
          botomBanner: botomBanner,
          id: id,
          lang: lang,
          size: size,
          videoArticles: videoArticles,
          noindexArticles: noindexArticles,
          link: link,
          keywords: keywords,
          description: description,
        },
        Success
      );
      function Success(data) {
        console.log(data);
        if (!!id) {
          //alert(id);
          //alert('123');
          //?id=112&tag=ru&size=1440
          if (!!size) {
            var sizes = "&size=" + size;
          } else {
            var sizes = "";
          }
          if (!!lang) {
            var tag = "&tag=" + lang;
          } else {
            var tag = "";
          }

          document.location =
            "/admin/articles/articles-version?id=" + id + sizes + tag;
        } else {
          if (data) {
            document.location = "/admin/articles/update?id=" + data;
          }
        }
      }
    });
  }
});

// function get_selected_text() {
// 	if (window.getSelection()) {
// 		var select = window.getSelection();
// 		alert(select.toString());
// 	}
// }
$(document).on("click", ".re-alignment", function (e) {
  $(this).siblings(".redactor-dropdown").css("display", "block");
});
$(document).on("click", ".redactor-dropdown.custom-redactor a", function (e) {
  e.preventDefault();
  var reb = $(this).data("reb");
  var type = $(this).data("type");
  $('.flext.add-te[data-tag="' + reb + '"]').css("text-align", type);
  $('.est-text[data-id="' + reb + '"]').css("text-align", type);
  $(".redactor-dropdown.custom-redactor").css("display", "none");
});

$(document).on("click", ".re-icon.lac", function (e) {
  e.preventDefault();
  if (window.getSelection() == "") {
    return false;
  }
  var range = new Range();
  var sel = window.getSelection();

  var data = $(this).data("reb");
  var range = sel.getRangeAt(0);
  var id = range.startContainer.parentNode.parentNode.id;

  if ($(this).hasClass("re-bold")) {
    var node = range.startContainer;
    if (
      node.parentNode.nodeName == "STRONG" ||
      node.parentNode.nodeName == "strong" ||
      node.parentNode.nodeName == "b" ||
      node.parentNode.nodeName == "B"
    ) {
      //$(node).unwrap();
      document.execCommand("removeFormat", false, "bold");
    } else {
      // var selectionContents = range.extractContents();
      // var span = document.createElement("strong");
      // span.appendChild(selectionContents);
      // range.insertNode(span);
      document.execCommand("bold", false, null);
    }
    // sel.removeAllRanges();
    return false;
  }

  if ($(this).hasClass("re-underline")) {
    var node = range.startContainer;
    if (node.parentNode.nodeName == "U" || node.parentNode.nodeName == "u") {
      document.execCommand("removeFormat", false, "underline");
    } else {
      // var selectionContents = range.extractContents();
      // var span = document.createElement("u");
      // span.appendChild(selectionContents);
      // range.insertNode(span);
      document.execCommand("underline", false, null);
    }
    // sel.removeAllRanges();
  }

  if ($(this).hasClass("re-italic")) {
    var node = range.startContainer;
    if (node.parentNode.nodeName == "EM" || node.parentNode.nodeName == "em") {
      document.execCommand("removeFormat", false, "italic");
    } else {
      // var selectionContents = range.extractContents();
      // var span = document.createElement("em");
      // span.appendChild(selectionContents);
      // range.insertNode(span);
      document.execCommand("italic", false, null);
    }
    // sel.removeAllRanges();
  }

  if ($(this).hasClass("re-deleted")) {
    var node = range.startContainer;
    if (node.parentNode.nodeName == "S" || node.parentNode.nodeName == "s") {
      document.execCommand("removeFormat", false, "strikethrough");
    } else {
      document.execCommand("strikethrough", false, null);
    }
    //sel.removeAllRanges();
  }

  //  if ("dataRed-" + data == id) {
  if ($(this).hasClass("re-link")) {
    var url = prompt("Введите URL", "");
    document.execCommand("CreateLink", false, url);
    return false;

    // var node = range.startContainer;
    // if (node.parentNode.nodeName == "A" || node.parentNode.nodeName == "a") {
    //   $(node).unwrap();
    // } else {
    //   var selectionContents = range.extractContents();
    //   var e = document.createElement("a");
    //   e.href = $(".link-text").val();
    //   if ($("#openNewWindow").is(":checked")) {
    //     e.target = "_blank";
    //   }
    //   e.appendChild(selectionContents);
    //   range.insertNode(e);
    // }
    // sel.removeAllRanges();
  }

  if ($(this).hasClass("fa-unlink")) {
    document.execCommand("unlink", false, null);
    return false;
  }
});

$("body").on("input", ".toolbar-color", function () {
  var val = $(this).val();
  document.execCommand("styleWithCSS", false, true);
  document.execCommand("foreColor", false, val);
  document.execCommand("styleWithCSS", false, false);
});

// Цвет фона
$("body").on("input", ".toolbar-bg", function () {
  var val = $(this).val();
  document.execCommand("styleWithCSS", false, true);
  document.execCommand("hiliteColor", false, val);
  document.execCommand("styleWithCSS", false, false);
});

$(document).on("click", ".lac.res-link", function (e) {
  if ($(this).hasClass("res-link")) {
    var url = prompt("Введите URL", "");
    document.execCommand("CreateLink", false, url);
    return false;
    // var node = range.startContainer;
    // if (node.parentNode.nodeName == "A" || node.parentNode.nodeName == "a") {
    //   $(node).unwrap();
    // } else {
    //   var selectionContents = range.extractContents();
    //   var e = document.createElement("a");
    //   e.href = $(".link-text").val();
    //   if ($("#openNewWindow").is(":checked")) {
    //     e.target = "_blank";
    //   }
    //   e.appendChild(selectionContents);
    //   range.insertNode(e);
    // }
    // sel.removeAllRanges();
  }
});

$(document).on("click", ".poor-block", function (e) {
  $(".poor-block").removeClass("active");
  $(".element-bord").removeClass("active");
  $(this).addClass("active");
});
$(document).on("click", ".fa-ad-file", function (e) {
  $("#textarea-col").val("");
  $(".texts-cols .redactor-editor").html("");

  var data = $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .attr("data-list");
  $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .parent("div")
    .removeClass()
    .addClass("param-colum");

  $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .removeClass("." + data);
  $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .removeClass("list_" + data);
  $(this).closest(".setColBlock").siblings(".elga").removeAttr("data-list");

  $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .children(".ul-wrap")
    .remove();

  $("#block-colum-left").css("display", "block");
  var rand =
    Math.floor(Math.random() * 10) +
    "-" +
    Math.floor(Math.random() * 10) +
    "-" +
    Math.floor(Math.random() * 10);
  $(".block-parametrs").html("");

  if ($(this).parent(".setColBlock").siblings(".elga").hasClass("text-fict")) {
    var tor = $(this).parent(".setColBlock").siblings(".elga").data("fict");
    $("#column").val(tor);
    var area = $("." + tor)
      .children(".innertText")
      .html();
    var html = $("." + tor).attr("data-art");
    $("#textarea-col").val(html);
    $(".texts-cols .redactor-editor").html(area);

    var output = new Object();
    var cssProperties = $(this)
      .closest(".param-colum")
      .find(".innertText")
      .css(["line-height"]);
    $.each(cssProperties, function (prop, value) {
      output[prop] = value;
    });
    $("#block-colum-left .line-hg").val(
      output["line-height"].replace("px", "")
    );
  } else {
    $(this)
      .parent(".setColBlock")
      .siblings(".elga")
      .addClass("text-" + rand);
    $(this)
      .parent(".setColBlock")
      .siblings(".elga")
      .attr("data-fict", "text-" + rand);
    $(this).parent(".setColBlock").siblings(".elga").addClass("text-fict");
    $("#column").val("text-" + rand);
  }
});

$("#ford-text-col").on("click", function (e) {
  var area = $("#textarea-col").val();
  var html = $(".texts-cols .redactor-editor").html();
  var classCol = $("#column").val();
  var lineHei = $("#block-colum-left .line-hg").val();
  $("." + classCol).html('<div class="innertText">' + area + "</div>");
  $("." + classCol).attr("data-art", html);
});

$("#block-colum-left .kp").on("click", function (e) {
  $("#block-colum-left").css("display", "none");
});

$(document).on("change", "#colorRevers", function (e) {
  var val = $(this).val();
  // alert(val);
  var param = $(this).data("param");
  $("." + param + "_color_tag").css("color", val);
  $("." + param + "_border_color_tag").css("border", "2px solid " + val);
});

$(document).on("click", ".socials_and_player", function (e) {
  var obj = new Object();
  i = 0;
  $(".soc").each(function (e) {
    if ($(this).hasClass("active")) {
      obj[i] = new Object();
      obj[i]["vis"] = "1";
    } else {
      obj[i] = new Object();
      obj[i]["vis"] = "2";
    }

    if ($(this).children(".counter").length) {
      obj[i]["col"] = $(this).children(".counter").html();
    }
    i++;
  });

  var output = new Object();
  var cssProperties = $(".share-block").css([
    "margin-left",
    "margin-right",
    "margin-top",
    "margin-bottom",
  ]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });

  $.post("/admin/articles/param-social", { obj: obj, output: output }, Success);
  function Success(data) {
    if (data) {
      $(".block-parametrs").html(data);
    }
  }
});

$("#prevImageArticles").change(function (e) {
  if (window.FormData === undefined) {
    alert("В вашем браузере FormData не поддерживается");
  } else {
    var f = document.getElementById("prevImageArticles");
    var rd = new FileReader(); // Создаем объект чтения файла
    var files = f.files[0]; // Получаем файлы в файловом компоненте
    rd.readAsDataURL(files); // чтение файла заменено на тип base64
    rd.onloadend = function (e) {
      // После загрузки получаем результат и присваиваем его img
      console.log(this.result);
      //document.getElementById("book-pic").src = this.result;
      var img = '<img src="' + this.result + '" style="width:100%">';
      $(".wid-im").html(img);
    };
  }
});
$(document).on("click", ".shlot_trof", function (e) {
  var data = $(this).data("id");
  $("#sTree2 li").css("background", "inherit");
  $("#" + data).css("background", "rgb(238 238 238)");
  $.post("/admin/menu/menu-param", { data: data }, Success);
  function Success(data) {
    $("#reportCon").html(data);
  }
});

$(document).on("click", ".shlot_trof_btn", function (e) {
  var data = $(this).data("id");
  $("#sTree3 li").css("background", "inherit");
  $("#bt-" + data).css("background", "rgb(238 238 238)");
  $.post("/admin/menu/menu-param-btn", { data: data }, Success);
  function Success(data) {
    $("#reportConBtn").html(data);
  }
});

$(document).on("change", "#myFiles", function (e) {
  var f = document.getElementById("myFiles");
  var rd = new FileReader();
  var files = f.files[0];
  rd.readAsDataURL(files);

  rd.onloadend = function (e) {
    console.log(this.result);
    var img = '<img src="' + this.result + '" style="width:100%">';
    $(".wid-img").html(img);
  };
});

$(document).on("submit", "form#form-id", function (e) {
  e.preventDefault();
  var formData = new FormData($(this)[0]);

  $.ajax({
    type: "post",
    url: "/admin/menu/save-icon",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
      //console.log(data);
      if (data == "Ok") {
        document.location = document.location;
      }
    },
  });
  return false;
});

$(document).on("click", "#add-video", function (e) {
  $("#video").modal("show");
});
$(document).on("click", "#saveVideo", function (e) {
  e.preventDefault();
  var key_id = $("#video #key_id").val();
  var type = $("#type_pr").val();
  $.post("/admin/articles/video-save", { key_id: key_id, type: type }, Success);
  function Success(data) {
    if (data) {
      $("#video").modal("hide");
      MainBlock.append(data);
    } else {
      alert("Видео не найдено!");
    }
  }
});
$("#accordion").accordion({
  collapsible: true,
  active: false,
});
$(document).on("click", ".video_alt", function (e) {
  var id = $(this).data("id");
  $("#video #key_id").val(id);
});



$(".delet-arctic").on("click", function (e) {
  var id = $(this).data("id");
  if (confirm("Удалить?")) {
    $.post("/admin/setting/delete-arcticles", { id: id }, Success);
    function Success(data) {
      if (data) {
        document.location = document.location;
      }
    }
  }
});
$(document).on("change", ".imgSize", function (e) {
  var tag = $(this).data("tag");
  var val = $(this).val();
  if ($(".img-tag-" + tag).length) {
    $(".img-tag-" + tag)
      .parent(".img-wrap")
      .css("width", val + "%");
    var attr = $(".img-tag-" + tag)
      .parent(".img-wrap")
      .attr("data-width");
    if (typeof attr !== typeof undefined && attr !== false) {
      $(".img-tag-" + tag)
        .parent(".img-wrap")
        .attr("data-width", val);
    } else {
      $(".img-tag-" + tag)
        .parent(".img-wrap")
        .data("width", val);
    }
    if ($(".img-tag-" + tag).siblings(".signut_padding_tag").length) {
      var width = $(".img-tag-" + tag).width();
      $(".img-tag-" + tag)
        .siblings(".signut_padding_tag")
        .css("width", width + "px");
    }
    if (
      $(".img-tag-" + tag)
        .closest(".img-wrap")
        .siblings(".add-te").length
    ) {
      if (
        $(".img-tag-" + tag)
          .closest(".img-wrap")
          .siblings(".add-te")
          .hasClass("tex-right") ||
        $(".img-tag-" + tag)
          .closest(".img-wrap")
          .siblings(".add-te")
          .hasClass("tex-left")
      ) {
        var widthSub = 100 - val;
        $(".img-tag-" + tag)
          .closest(".img-wrap")
          .siblings(".add-te")
          .css("width", widthSub + "%");
      }
    }
  } else {
    if ($("video[data-tag='" + tag + "']").length) {
      $("video[data-tag='" + tag + "']")
        .parent(".img-wrap")
        .css("width", val + "%");
      if (
        $("video[data-tag='" + tag + "']")
          .parent(".img-wrap")
          .siblings(".add-te[data-tag='" + tag + "']").length
      ) {
        if (
          $("video[data-tag='" + tag + "']")
            .parent(".img-wrap")
            .siblings(".add-te[data-tag='" + tag + "']")
            .hasClass("tex-left") ||
          $("video[data-tag='" + tag + "']")
            .parent(".img-wrap")
            .siblings(".add-te[data-tag='" + tag + "']")
            .hasClass("tex-right")
        ) {
          var widthSub = 100 - val;
          $("video[data-tag='" + tag + "']")
            .parent(".img-wrap")
            .siblings(".add-te[data-tag='" + tag + "']")
            .css("width", widthSub + "%");
        }
      }
    }
  }
});

$(document).on("click", "#add-gallery", function (e) {
  $.post("/admin/gallery/list", Success);
  function Success(data) {
    $(".abbred-gal").html(data);
    $("#modal-gal").modal("show");
  }
});
$(document).on("click", ".app-gelser", function (e) {
  var id = $(this).data("id");
  $.post("/admin/gallery/get", { id: id }, Success);
  function Success(data) {
    MainBlock.append(data);
    $("#modal-gal").modal("hide");
    $(".col-bl").each(function (e) {
      if ($(this).children(".col-ml").length) {
        $(this)
          .children(".col-ml")
          .each(function (e) {
            $(this).append("<span class='at_i'>A</span>");
          });
      } else {
        $(this).append("<span class='at_i'>A</span>");
      }
    });
  }
});
$(document).on("click", ".block-gall-default", function (e) {
  var obj = $(this).parent(".asp-gall");
  obj.find(".block-gall-default").each(function (e) {
    $(this).css("width", $(this).width());
    $(this).css("flex-grow", "inherit");
    $(this).resizable({
      resize: function (e, ui) {
        if ($(this).find("video").length) {
          $(this)
            .find("video")
            .attr("width", Math.round(ui.size.width).toFixed() + "px");
        }
      },
    });
  });
  // if (e.target.className == "at_i") {
  //   // $(this).resizable("destroy");
  // } else {
  //     $(this).resizable();
  // }
});
$(document).ready(function (e) {
  $(document).on("click", ".param-colum", function (e) {
    if ($(".param-colum").hasClass("ui-resizable")) {
      $(".param-colum").removeClass("ui-resizable");
      //$('.param-colum').resizable({destroy : true});
    }
    var width = $(this).closest(".bt-sg").width();
    var child = 0;
    var parent = $(this).closest(".bt-sg");
    parent.children(".param-colum").each(function (e) {
      child = child + $(this).width();
    });
    child = child + 6;
    console.log(Math.round(child).toFixed());
    console.log(Math.round(width).toFixed());
    var prerem = width - child;
    var objWidth = $(this).width();
    var dfRt = objWidth + prerem;
    // if (child > width || child == width) {
      $(this).resizable({
        maxWidth: dfRt,
        resize: function (e, ui) {
          $(".amfor").remove();
          var msg = Math.round(ui.size.width).toFixed();
          $(this).append('<div class="amfor">' + msg + "</div>");
          child = child + 2;
          if (child > width) {
            return false;
          }
        },
        stop: function (e, ui) {
          $(".amfor").remove();
        },
      });
    // } else {
      // $(this).resizable({
      //   maxWidth: width,
      //   resize: function (e, ui) {
      //     $(".amfor").remove();
      //     var msg = Math.round(ui.size.width).toFixed();
      //     $(this).append('<div class="amfor">' + msg + "</div>");
      //     child = child + 2;
      //     if (child > width) {
      //       return false;
      //     }
      //   },
      //   stop: function (e, ui) {
      //     $(".amfor").remove();
      //   },
      // });
    // }
  });
});

$(document).on("click", ".at_i", function (e) {
  AddsImage();
  if ($(this).parent(".col-bl").length) {
    var rand = randomInteger(1, 999) + "coltast" + randomInteger(1, 999);
    $(this).parent(".col-bl").addClass(rand);
    $(".abbred-image").addClass("aprovCol");
    $(".abbred-image").data("img_id", rand);
  }
  if ($(this).parent(".col-ml").length) {
    var rand = randomInteger(1, 999) + "coltast" + randomInteger(1, 999);
    $(this).parent(".col-ml").addClass(rand);
    $(".abbred-image").addClass("aprovCol");
    $(".abbred-image").data("img_id", rand);
  }
});
$(document).ready(function (event) {
  $(document).click(function (e) {
    if (
      e.target.className != "block-gall-default" &&
      e.target.className != "col-bl"
    ) {
      // $(".block-gall-default").resizable("destroy");
    }
  });
});
$(".bordContent li").on("click", function (e) {
  $(".block-parametrs").html("");
});

$(document).on("click", ".fa-ad-col", function (e) {
  var data = $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .attr("data-fict");
  $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .parent("div")
    .removeClass()
    .addClass("param-colum");
  $(this).closest(".setColBlock").siblings(".elga").removeClass("text-fict");
  $(this).closest(".setColBlock").siblings(".elga").removeClass(data);
  $(this).closest(".setColBlock").siblings(".elga").removeAttr("data-fict");
  $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .parent("div")
    .removeAttr("data-fict");

  $("#block-colum-left").css("display", "none");
  var list = $(this).closest(".setColBlock").siblings(".elga").data("list");
  var list2 = $(this)
    .closest(".setColBlock")
    .siblings(".elga")
    .attr("data-list");
  if (!!!list || !!!list2) {
    var id = randomInteger(1, 999) + "list" + randomInteger(1, 999);
    var list =
      "<div class='ul-wrap' id='" +
      id +
      "' data-id='" +
      id +
      "'><ul><li class='param_1'>lorem</li></ul></div>";
    $(this)
      .closest(".setColBlock")
      .siblings(".elga")
      .addClass("list_" + id);
    $(this).closest(".setColBlock").siblings(".elga").attr("data-list", id);
    $(this).closest(".setColBlock").siblings(".elga").html(list);
  }
});

$(document).on("click", ".ul-wrap", function (e) {
  var array = new Object();
  var ul = $(this).children("ul");
  var is = 1;
  ul.children("li").each(function (e) {
    array["param_" + is] = $(this).html();
    //console.log($(this).html());
    is++;
  });

  var output = new Object();
  var cssProperties = $(this).children("ul").css(["font-size"]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });

  var id = $(this).data("id");
  $.post(
    "/admin/articles/add-ul",
    { id: id, array: array, output: output },
    Success
  );
  function Success(data) {
    //console.log(data);
    $(".block-parametrs").html(data);
  }
});
$(document).on("click", ".asd-input-list", function (e) {
  var i = 1;
  var es = "";
  $(".inp-ul").each(function (e) {
    i++;
    es = i;
  });
  var inp =
    '<div class="input_dev"><input type="text" class="inp-ul form-control" data-id="' +
    es +
    '" name="param_' +
    es +
    '" value=""><span class="remove-ul-li fa fa-trash"></span><span class="dert fa fa-link" data-param="param_' +
    es +
    '"></span></div>';
  $("#ulForm").append(inp);
});

$(document).on("click", ".opens_ul_li", function (e) {
  e.preventDefault();
  var array = $("#ulForm").serializeArray();
  var id = $(".id_ul_li").val();
  var size = $(".size-ul").val();
  var padding = $(".padding-ul").val();
  var icon = $("#custom-icon").val();
  var type = $("#icons_ul").val();
  $.post(
    "/admin/articles/array-ul",
    {
      array: array,
      id: id,
      padding: padding,
      size: size,
      icon: icon,
      type: type,
    },
    Success
  );
  function Success(data) {
    $("#" + id).html(data);
  }
});
$(document).on("change", "#icons_ul", function (e) {
  var val = $(this).val();
  var id = $(".id_ul_li").val();
  if (val == "chek") {
    var padding = $(".padding-ul").val();
    $("#" + id).addClass("check-list");
    $("#" + id).removeClass("croce");
    $("#" + id).removeClass("dots");
    $("#" + id + " ul li").each(function (e) {
      $(this).children("span").remove();
      $(this).css("padding-left", padding + "px");
    });
  }
  if (val == "crest") {
    var padding = $(".padding-ul").val();
    $("#" + id).removeClass("check-list");
    $("#" + id).addClass("croce");
    $("#" + id).removeClass("dots");
    $("#" + id + " ul li").each(function (e) {
      $(this).children("span").remove();
      $(this).css("padding-left", padding + "px");
    });
  }
  if (val == "dots") {
    var padding = $(".padding-ul").val();
    $("#" + id).removeClass("check-list");
    $("#" + id).removeClass("croce");
    $("#" + id).addClass("dots");
    $("#" + id + " ul li").each(function (e) {
      $(this).children("span").remove();
      $(this).css("padding-left", padding + "px");
    });
  }
  if (val == "default") {
    var padding = $(".padding-ul").val();
    $("#" + id).removeClass("check-list");
    $("#" + id).removeClass("croce");
    $("#" + id).removeClass("dots");
    $("#" + id + " ul li").each(function (e) {
      $(this).children("span").remove();
      $(this).css("padding-left", padding + "px");
    });
  }
  if (val == "custom") {
    var padding = $(".padding-ul").val();
    $("#" + id).removeClass("check-list");
    $("#" + id).removeClass("croce");
    $("#" + id).removeClass("dots");
    var val = $("#custom-icon").val();
    $("#custom-icon").css("display", "block");
    if (val != "") {
      $("#" + id + " ul li").each(function (e) {
        if (!$(this).children("span").length) {
          var span =
            "<span style='margin-right:" + padding + "px'>" + val + "</span>";
          $(this).prepend(span);
          $(this).css("padding", "0");
        } else {
          $(this).children("span").html(val);
          $(this)
            .children("span")
            .css("margin-right", padding + "px");
          $(this).css("padding", "0");
        }
      });
    }
  } else {
    $("#custom-icon").css("display", "none");
  }

  if (val == "numb") {
    var padding = $(".padding-ul").val();
    var i = 1;
    $("#" + id).removeClass("check-list");
    $("#" + id).removeClass("croce");
    $("#" + id).removeClass("dots");

    $("#" + id + " ul li").each(function (e) {
      var span =
        "<span style='margin-right:" + padding + "px'>" + i + "</span>";
      $(this).css("padding", "0");
      if ($(this).children("span").length) {
        $(this).children("span").html(i);
        $(this)
          .children("span")
          .css("margin-right", padding + "px");
      } else {
        $(this).prepend(span);
      }
      i++;
    });
  }
});
$(document).on("change", "#custom-icon", function (e) {
  var padding = $(".padding-ul").val();
  var val = $(this).val();
  if (val != "") {
    var id = $(".id_ul_li").val();
    $("#" + id + " ul li").each(function (e) {
      if (!$(this).children("span").length) {
        var span =
          "<span style='margin-right:" + padding + "px'>" + val + "</span>";
        $(this).prepend(span);
        $(this).css("padding", "0");
      } else {
        $(this).children("span").html(val);
        $(this)
          .children("span")
          .css("margin-right", padding + "px");
        $(this).css("padding", "0");
      }
    });
  }
});
$(document).on("click", ".dert", function (e) {
  var param = $(this).data("param");
  $("#link-ul").modal("show");
  $("#li_id").val(param);
  var val = $("input[name='" + param + "']").val();
  if (val != "") {
    $(".link-title-ul").val(val);
  }
});

$(document).on("click", "#addInLink", function (e) {
  e.preventDefault();
  var id = $("#li_id").val();
  var url = $(".link-url").val();
  var title = $(".link-title-ul").val();
  if (title != "" && url != "" && id != "") {
    var tag = "";
    if ($(".blankLinkUl").is(":checked")) {
      tag = 'target="_blank"';
    }
    var link = "<a href='" + url + "' " + tag + ">" + title + "</a>";
    link.innerHTML;
    $('.inp-ul[name="' + id + '"]').val(link);
    $("#link-ul").modal("hide");
    $("#link-ul .link-url").val("");
    $("#link-ul .link-title-ul").val("");
  }
});

$(document).on("change", ".padding-ul", function (e) {
  var val = $(this).val();
  var id = $(".id_ul_li").val();
  $("#" + id + " > ul > li").each(function (e) {
    if ($(this).children("span").length) {
      $(this)
        .children("span")
        .css("margin-right", val + "px");
      $(this).css("padding-left", "0px");
    } else {
      $(this).css("padding-left", val + "px");
    }
  });
});

$(document).on("click", ".elga", function (e) {
  if ($(this).hasClass("text-fict")) {
    var id = $(this).data("fict");

    var output = new Object();
    var cssProperties = $(this).css([
      "padding-left",
      "padding-right",
      "padding-top",
      "padding-bottom",
    ]);
    $.each(cssProperties, function (prop, value) {
      output[prop] = value;
    });

    $.post("/admin/module-block/text-col", { id: id, output: output }, Success);
    function Success(data) {
      $(".block-parametrs").html(data);
    }
  }
});
$(document).on("click", "#ul-col-align .nav-link", function (e) {
  var id = $(".id_ul_li").val();
  var pos = $(this).data("pos");
  if (pos != "lite" && pos != "strong") {
    $("#" + id)
      .children("ul")
      .css("text-align", pos);
    $("#" + id)
      .children("ul")
      .removeClass();
    $("#" + id)
      .children("ul")
      .addClass(pos);
  }
  if (pos == "strong") {
    $("#" + id)
      .children("ul")
      .css("font-weight", "bold");
  }
  if (pos == "lite") {
    $("#" + id)
      .children("ul")
      .css("font-weight", "inherit");
  }
});
$(document).on("change", ".size-ul", function (e) {
  var val = $(this).val();
  var id = $(".id_ul_li").val();

  $("#" + id)
    .children("ul")
    .css("font-size", val + "px");
});

// (function() {

//   'use strict';

//   $('.input-file').each(function() {
//     var $input = $(this),
//         $label = $input.next('.js-labelFile'),
//         labelVal = $label.html();

//    $input.on('change', function(element) {
//       var fileName = '';
//       if (element.target.value) fileName = element.target.value.split('\\').pop();
//       fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
//    });
//   });

// })();

$(document).on("click", ".remove-ul-li", function (e) {
  $(this).parent(".input_dev").remove();
});
$(document).on("click", ".delete-ul", function (e) {
  e.preventDefault();
  var id = $(".id_ul_li").val();
  if ($("#" + id).length) {
    $("#" + id).remove();
  }
  if ($(".elga").hasClass("list_" + id)) {
    $(".elga").removeClass("list_" + id);
    $(".elga").removeAttr("data-list");
  }
  $(".block-parametrs").html("");
});

$(document).on("click", "#ad-form-block", function (e) {
  $("#modal-form").modal("show");
});

$(document).on("click", ".app-form", function (e) {
  var id = $(this).data("id");
  if ($(this).hasClass("end-form")) {
    if (!$("#form-end-page").length) {
      $.post("/admin/form-bild/end-page", Success);
      function Success(data) {
        MainBlock.append(data);
        $("#modal-form").modal("hide");
      }
    } else {
      alert("Данный блок формы нв странице уже есть!");
    }
  } else {
    if (!$("#form-" + id).length) {
      $.post("/admin/form-bild/add-page", { id: id }, Success);
      function Success(data) {
        MainBlock.append(data);
        $("#modal-form").modal("hide");
      }
    } else {
      alert("Данный блок формы нв странице уже есть!");
    }
  }
});
$(document).on("click", ".content-form-redactor", function (e) {
  var id = $(this).data("id");
  $.post("/admin/form-bild/param-page", { id: id }, Success);
  function Success(data) {
    $(".block-parametrs").html(data);
  }
});
$(document).on("change", "#view-form", function (e) {
  var val = $(this).val();
  var id = $(".id_form").val();
  if (val == "label-2") {
    $("#form-" + id).addClass("veiw-alter");
  }
  if (val == "label-1") {
    $("#form-" + id).removeClass("veiw-alter");
  }
});
$(document).on("click", "#form-end-page", function (e) {
  var id = "btn-param";

  var output = new Object();
  var cssProperties = $(".btn-form_margin_tag").css([
    "margin-left",
    "margin-right",
    "margin-top",
    "margin-bottom",
  ]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });

  $.post("/admin/form-bild/param-page", { id: id, output: output }, Success);
  function Success(data) {
    $(".block-parametrs").html(data);
  }
});
$(document).on("change", "#view-form-btn", function (e) {
  var val = $(this).val();
  $("#form-end-page").removeClass().addClass(val);
});

$(document).on("click", "#add-accar", function (e) {
  $.post("/admin/accardion/add", Success);
  function Success(data) {
    MainBlock.append(data);
  }
});

$(document).on("click", ".add-alem-accr", function (e) {
  var classElem = $(this).data("class");
  $.post("/admin/accardion/add-elem", Success);
  function Success(data) {
    $("." + classElem).before(data);
  }
});
$(document).on("click", ".del-elem-accr", function (e) {
  $(this).parent(".block-accardion-page").remove();
  $(".block-parametrs").html("");
});
$(document).on("click", "#add-paddinger", function (e) {
  $.post("/admin/accardion/paddinger", Success);
  function Success(data) {
    MainBlock.append(data);
  }
});
$(document).on("click", "#add-liner", function (e) {
  $.post("/admin/accardion/liner", Success);
  function Success(data) {
    MainBlock.append(data);
  }
});

$(document).on("click", ".ltr-param", function (e) {
  var id = $(this).data("id");
  var output = new Object();
  var cssProperties = $(this).children(".linter").css(["background-color"]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });
  $.post("/admin/accardion/liner-param", { id: id, output: output }, Success);
  function Success(data) {
    $(".block-parametrs").html(data);
  }
});

$(document).on("change", ".color-liner", function (e) {
  var val = $(this).val();
  var id = $("#idLine").val();
  $(".ltr-param[data-id='" + id + "']")
    .children(".linter")
    .css("background-color", val);
});
$(document).on("click", ".param-colum", function (e) {
  $(".param-colum").removeClass("active");
  $(this).addClass("active");
  if ($(this).children(".elga").html() == "") {
    $(".block-parametrs").html("");
  }
});

$(".blockContent").on("click", function (e) {
  $(".param-colum").removeClass("active");
});

$(document).keyup(function (e) {
  if (e.key === "Escape" || e.keyCode === 27) {
    $(".block-tex-title").removeClass("active");
    $(".param-colum").removeClass("active");
    $(".poor-block").removeClass("active");
    $(".block-accardion-page").removeClass("active");
    $(".block-parametrs").html("");
    $("#block-colum-left").css("display", "none");
    $("#block-temp-left-d").css("display", "none");
    $(".tool-sf").remove();
  }
});

$(document).on(
  "click",
  ".block-tex-title, .element-bord, .poor-block",
  function (e) {
    if (!$(this).find(".param-colum").length) {
      $(".param-colum").removeClass("active");
    }
  }
);
$(document).on("click", "#add-knopka", function (e) {});

$(".blockContent").on("click", "a", function (e) {
  e.preventDefault();
});
$(document).on("click", "#hadAudio a", function (e) {
  e.preventDefault();
  var ta = $(this).data("da");
  if (ta == "y") {
    $(".player").css("display", "block");
  } else {
    $(".player").css("display", "none");
  }
});
$(document).on(
  "change",
  '.cos-list-param input[type="checkbox"]',
  function (e) {
    var name = $(this).attr("name");

    if ($(".soc." + name).hasClass("active")) {
      $(".soc." + name).removeClass("active");
    } else {
      $(".soc." + name).addClass("active");
    }
    //console.log($(this).val());
  }
);

$(document).on("change", '.cos-list-param input[type="number"]', function (e) {
  var name = $(this).attr("name");
  var str = name.replace("col-", "");
  var val = $(this).val();
  $(".soc." + str)
    .children(".counter")
    .html(val);

  //console.log($(this).val());
});
$(document).on("click", ".gall-img-template", function (e) {
  var id = $(this).attr("id");
  $.post("/admin/gallery/param-gal", { id: id }, Success);
  function Success(data) {
    $(".block-parametrs").html(data);
  }
});
$(document).on("change", ".pading-gal", function (e) {
  var id = $(".id-gall").val();
  var val = $(this).val();
  $("#" + id + " .col-bl").css("padding", val + "px");
  $("#" + id + " .col-ml").css("padding", val + "px");
});
$(document).on("click", ".add-gal-par", function (e) {
  var val = $(".prev-img").val();
  var id = $(".id-gall").val();
  $(".col-bl").removeClass("prev-image");
  $(".col-ml").removeClass("prev-image");
  var i = "0";
  $("#" + id + " .block-gall-default div").each(function (e) {
    if ($(this).hasClass("col-bl")) {
      if ($(this).children("div").hasClass("col-ml")) {
        $(this)
          .children(".col-ml")
          .each(function (e) {
            i++;
            if (i == val) {
              $(this).addClass("prev-image");
            }
          });
      } else {
        i++;
        if (i == val) {
          $(this).addClass("prev-image");
        }
      }
    }
  });
  console.log(i);

  var img = $("#" + id + " .prev-image")
    .children(".img-wrap-in-col")
    .data("src");
  var previu = '<div class="block-pren"><img src="/gallery/' + img + '"><div/>';
  $("#" + id).prepend(previu);
});

$(window).scroll(function () {
  if ($(".right-conters").length) {
    var scroll = $(document).scrollTop();
    var elTop = $(".right-conters").offset().top;
    var topSize = elTop + 150;
    if (scroll > topSize) {
      $(".fixed-param-right").css("display", "block");
      if (!$(".bordContent").hasClass("fixed")) {
        $(".bordContent").addClass("fixed");
      }
      if (!$(".block-parametrs").hasClass("fixed")) {
        $(".block-parametrs").addClass("fixed");
        var width = $(".connectedSortable.right-conters").width();
        $(".block-parametrs").css("width", width + "px");
      }
    } else {
      $(".fixed-param-right").css("display", "none");
      $(".block-parametrs").removeClass("fixed");
      $(".bordContent").removeClass("fixed");
    }
  }
});
$(document).on("click", ".op", function (e) {
  $(".fixed-param-right").removeClass("relle");
  $(".fixed-param-right .op").css("display", "none");
  $(".fixed-param-right .cos").css("display", "block");
});
$(document).on("click", ".cos", function (e) {
  $(".fixed-param-right").addClass("relle");
  $(".fixed-param-right .op").css("display", "block");
  $(".fixed-param-right .cos").css("display", "none");
});
$(document).on("click", "#add-slider-gal", function (e) {
  //$(document).ready(function (e) {
  $.post("/admin/articles/slider-gel", Success);
  function Success(data) {
    MainBlock.append(data);
  }
});
$(document).on("click", ".block-slider-gal", function (e) {
  var id = $(this).data("id");
  var modal = "";
  if ($(this).find(".open-in-modal").length) {
    modal = "chek";
  }
  var stel = "";
  if ($(this).find(".flort.no-port").length) {
    stel = $(this).find(".flort.no-port").css("display");
  }

  if (
    $(".slider-" + id)
      .children(".flort")
      .hasClass("no-port")
  ) {
    var obj = new Object();
    var i = 1;
    $(".slider-" + id)
      .children(".flort")
      .children(".img-werst")
      .each(function (e) {
        obj[i] = new Object();
        obj[i]["src"] = $(this).data("src");
        obj[i]["subs"] = $(this).data("subs");
        i++;
      });
    console.log(obj);
    $.post(
      "/admin/articles/param-slider",
      { id: id, obj: obj, modal: modal, stel: stel },
      Success
    );
    function Success(data) {
      $(".block-parametrs").html(data);
    }
  } else {
    $.post(
      "/admin/articles/param-slider",
      { id: id, modal: modal, stel: stel },
      Success
    );
    function Success(data) {
      $(".block-parametrs").html(data);
    }
  }
});

$(document).on("click", ".select-image-slider", function (e) {
  e.preventDefault();
  var name = $(this).data("name");
  $(".abbred-image").addClass("in-slider");
  $(".abbred-image").data("img_id", name);
  AddsImage();
});

$(document).on("click", ".add-slider-img", function (e) {
  e.preventDefault();
  var id = "";
  $("#form-slider-param .select-image-slider").each(function (e) {
    id = $(this).data("name");
  });

  $.post("/admin/articles/add-slider-field", { id: id }, Success);
  function Success(data) {
    $(".add-slider-img").parent(".form-group").before(data);
  }
  //alert(id);
});

$(document).on("click", ".insider-slider", function (e) {
  e.preventDefault();
  var array = $("#form-slider-param").serializeArray();
  var id = $('#form-slider-param input[name="id"]').val();
  if (
    $(".slider-" + id)
      .children(".flort")
      .hasClass("no-port")
  ) {
  }
  $.post("/admin/articles/gen-slider", { array: array, id: id }, Success);
  function Success(data) {
    $(".slider-" + id).html(data);
  }
});

$(document).on("click", ".remove-img-slider", function (e) {
  $(this).closest(".crostTrok").remove();
});

$(document).on("change", "#signatureBac", function (e) {
  var val = $(this).val();
  var tag = $(this).data("tag");
  $(".signut[data-tag='" + tag + "']").css("background", val);
});
$(document).on("change", "#signatureCol", function (e) {
  var val = $(this).val();
  var tag = $(this).data("tag");
  $(".signut[data-tag='" + tag + "']").css("color", val);
});
$(document).on("change", ".img-link-tag", function (e) {
  var tag = $(this).data("tag");
  var val = $(this).val();
  if (val != "") {
    $('img[data-tag="' + tag + '"]').attr("data-link", val);
    $('img[data-tag="' + tag + '"]').addClass("link-img-href");
  } else {
    $('img[data-tag="' + tag + '"]').removeAttr("data-link");
    $('img[data-tag="' + tag + '"]').removeClass("link-img-href");
  }
});
$(document).on("click", ".blank_tar", function (e) {
  var tag = $(this).data("tag");
  if ($(this).prop("checked")) {
    $('img[data-tag="' + tag + '"]').addClass("op-new");
  } else {
    $('img[data-tag="' + tag + '"]').removeClass("op-new");
  }
});

$(document).on("click", ".modal_open", function (e) {
  var tag = $(this).data("tag");
  if ($(this).prop("checked")) {
    $('img[data-tag="' + tag + '"]').addClass("op-in-modal");
  } else {
    $('img[data-tag="' + tag + '"]').removeClass("op-in-modal");
  }
});
$(document).on("change", ".sizen-text", function (e) {
  var val = $(this).val();
  var id = $(this).data("tag");
  $('.contrel-text[data-reb="' + id + '"]').css("font-size", val + "px");
});
$(document).on("change", ".line-height-text-block", function (e) {
  var val = $(this).val();
  var id = $(this).data("tag");
  $('.contrel-text[data-reb="' + id + '"]').css("line-height", val + "px");
});
$(document).on("change", ".widght-text", function (e) {
  var val = $(this).val();
  var id = $(this).data("tag");
  $('.contrel-text[data-reb="' + id + '"]').css("font-weight", val);
});

$(document).on("change", ".headingSelect", function (e) {
  var val = $(this).val();
  $.post("/admin/articles/main-heading", { val: val }, Success);
  function Success(data) {
    $(".head-select-list").html(data);
  }
});

$(document).on("click", ".add-link-block", function (e) {
  var pos = $(this).data("pos");
  var type = $(this).data("type");
  var ret = $(this);
  $.post("/admin/setting/add-block", { pos: pos, type: type }, Success);
  function Success(data) {
    ret.before(data);
    console.log(data);
  }
});

$(document).on("click", ".modal-block", function (e) {
  var pos = $(this).data("pos");
  var ret = $(this);
  $.post("/admin/setting/modal-block", { pos: pos }, Success);
  function Success(data) {
    ret.before(data);
    console.log(data);
  }
});

$(document).on("change", "#dateAuthor", function (e) {
  var val = $(this).val();
  $(".data-param.inf").html(val);
});

$(document).on("click", ".col-elem-accr", function (e) {
  var id = $(this).data("id");
  $.post("/admin/colum/index", Success);
  function Success(data) {
    $(".accr-element")
      .find("#redactor-" + id)
      .html(data);
  }
});

$(document).on("click", ".img-elem-accr", function (e) {
  var id = $(this).data("id");
  $(".abbred-image").addClass("inAcardion");
  $(".abbred-image.inAcardion").attr("data-img_id", id);
  AddsImage();
});

$(document).on("click", ".accardion-title", function (e) {
  var id = $(this).closest(".block-accardion").data("id");
  $.post("/admin/accardion/title-param", { id: id }, Success);
  function Success(data) {
    $(".block-parametrs").html(data);
  }
});
$(document).on("change", ".inp-title-accardion", function (e) {
  var val = $(this).val();
  var id = $(this).data("id");
  var type = $(this).data("type");
  switch (type) {
    case "color":
      $('.block-accardion[data-id="' + id + '"] .text-acc').css("color", val);
      break;
    case "size":
      $('.block-accardion[data-id="' + id + '"] .text-acc').css(
        "font-size",
        val + "px"
      );
      break;
    case "weight":
      $('.block-accardion[data-id="' + id + '"] .text-acc').css(
        "font-weight",
        val
      );
      break;
  }
});
$(document).on("click", ".remove-img", function (e) {
  var src = $(this).data("src");
  var result = confirm("Удалить файл?");
  if (result) {
    $.post("/admin/image/remove-image", { src: src }, Success);
  }
  function Success(data) {
    if (data) {
      $.pjax.reload({ container: "#pajax-modal-img", async: false });
    }
  }
});
$(document).on("click", ".cadring", function (e) {
  var height = $(this).closest(".img-wrap-in-col").height();
  var width = $(this).closest(".img-wrap-in-col").width();

  var src = $(this).parent(".img-wrap-in-col").data("src");
  $.post(
    "/admin/image/cadring",
    { src: src, width: width, height: height },
    Success
  );
  function Success(data) {
    $("#carding").modal("show");
    $("#carding-body").html(data);
  }
});

$(document).on("click", "#add-button", function (e) {
  $.post("/admin/bootom/param", Success);
  function Success(data) {
    MainBlock.append(data);
  }
});

$(document).on("click", ".boot", function (e) {
  var id = $(this).data("id");
  var text = $(this).children(".inBottom").html();
  var link = $(this).children(".inBottom").attr("data-link");
  var output = new Object();
  var cssProperties = $(this)
    .children(".inBottom")
    .css([
      "color",
      "background-color",
      "font-size",
      "font-weight",
      "padding-top",
      "padding-left",
      "padding-right",
      "padding-bottom",
      "border-radius",
      "border-color",
      "border-width",
    ]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });
  var checked = "";
  if ($(this).children(".inBottom").hasClass("new-open")) {
    checked = "checked";
  }
  $.post(
    "/admin/bootom/param-boot",
    { id: id, text: text, link: link, output: output, checked: checked },
    Success
  );
  function Success(data) {
    $(".block-parametrs").html(data);
  }
});
$(document).on("change", ".param-boot-text-er", function (e) {
  var id = $("#idBootm").val();
  var val = $(this).val();
  if ($(this).data("type") == "text") {
    $(".boot[data-id='" + id + "']")
      .children(".inBottom")
      .html(val);
  } else {
    $(".boot[data-id='" + id + "']")
      .children(".inBottom")
      .attr("data-link", val);
  }
});
$(document).on("change", ".font-boot", function (e) {
  var id = $("#idBootm").val();
  var val = $(this).val();
  var type = $(this).data("type");
  if (type == "border") {
    var color = $(".border-color").val();
    $(".boot[data-id='" + id + "']")
      .children(".inBottom")
      .css(type, val + "px");
    $(".boot[data-id='" + id + "']")
      .children(".inBottom")
      .css("border-style", "solid");
    $(".boot[data-id='" + id + "']")
      .children(".inBottom")
      .css("border-color", color);
  } else {
    $(".boot[data-id='" + id + "']")
      .children(".inBottom")
      .css(type, val + "px");
  }
});

$(document).on("change", ".color-text-boot", function (e) {
  var id = $("#idBootm").val();
  var val = $(this).val();
  var type = $(this).data("type");
  $(".boot[data-id='" + id + "']")
    .children(".inBottom")
    .css(type, val);
});
$(document).on("click", ".boot-position .nav-link", function (e) {
  var id = $("#idBootm").val();
  var type = $(this).data("pos");
  $(".boot[data-id='" + id + "']").css("text-align", type);
});

$(document).on("change", ".font-weight", function (e) {
  var id = $("#idBootm").val();
  var val = $(this).val();
  $(".boot[data-id='" + id + "']")
    .children(".inBottom")
    .css("font-weight", val);
});

$(document).on("click", ".signitPol .nav-link", function (e) {
  var pos = $(this).data("pos");
  var tag = $(this).data("tag");
  $(".signut[data-tag='" + tag + "']").css("text-align", pos);
});

$(document).on("click", ".block-video-default", function (e) {
  var id = $(this).children(".block-video").data("id");
  var blockId = $(this).children(".block-video").attr("id");
  var chek = "";
  if ($("#" + blockId).hasClass("video-in-modal")) {
    chek = "chek";
  }
  $.post(
    "/admin/video/video-param",
    { id: id, blockId: blockId, chek: chek },
    Success
  );
  function Success(data) {
    $(".block-parametrs").html(data);
  }
});

$(document).on("click", ".video-dels", function (e) {
  var id = $(this).data("id");
  $.post("/admin/video/delete-video", { id: id }, Success);
  function Success(data) {
    if (data) {
      $.pjax.reload({ container: "#videoList", async: false });
    }
  }
});
$(document).on("change", "#block-temp-left-d .line-hg", function (e) {
  var val = $(this).val();
  $("#block-temp-left-d")
    .find(".redactor-editor")
    .css("line-height", val + "px");
});

$(document).on("change", "#block-colum-left .line-hg", function (e) {
  var val = $(this).val();
  $("#block-colum-left")
    .find(".redactor-editor")
    .css("line-height", val + "px");
});

$(document).on("click", "#open-modal-in-video", function (e) {
  var id = $("#blockId").val();
  if ($(this).prop("checked")) {
    $("#" + id).addClass("video-in-modal");
  } else {
    $("#" + id).removeClass("video-in-modal");
  }
});

$(function ($) {
  $(document).mouseup(function (e) {
    var div = $("#block-colum-left");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
      //div.hide();
    }
  });
});
$(function ($) {
  $(document).mouseup(function (e) {
    var div = $("#block-temp-left-d");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
      //div.hide();
    }
  });
});

$(document).on("click", ".new-open", function (e) {
  var tag = $("#idBootm").val();
  if ($(this).prop("checked")) {
    $('.boot[data-id="' + tag + '"] .inBottom').addClass("new-open");
  } else {
    $('.boot[data-id="' + tag + '"] .inBottom').removeClass("new-open");
  }
});

// $(document).on('click', '.cop-block', function(e){
//   var html = $(this).closest('.poor-block').clone();
//   html.children('.content-text-redactor ').attr('id', 'aaa');
//   var clone = html.html();
//   localStorage.mem = clone;
// })

$(document).on("click", ".cop-block.text", function (e) {
  var div = $(this).closest(".poor-block");
  var id = div.data("id");
  if (div.has(".content-text-redactor").length) {
    var html = div.clone();
    var rand = randomInteger(1, 999);
    html.find(".content-text-redactor").attr("id", "redactor-" + id + rand);
    html.find(".content-text-redactor").attr("data-id", id + rand);
    html.find(".content-text-redactor").removeClass(id + "_opens");
    html.find(".content-text-redactor").addClass(id + rand + "_opens");
    html.find(".contrel-text").removeClass("block-lest-" + id);
    html.find(".contrel-text").addClass("block-lest-" + id + rand);
    html.find(".contrel-text").attr("id", "dataRed-" + id + rand);
    html.find(".contrel-text").attr("data-reb", id + rand);
    var res = html.html();
    var clone =
      '<div class="poor-block" data-id="' + id + rand + '">' + res + "</div>";
    localStorage.mem = clone;
    $(".fixed-plash-block").addClass("viss");
  }
});


$(document).on("click", ".margin-block-coper", function (e) {
  var div = $(this).closest(".poor-block");
  if (div.has(".trl-den").length) {
    var html = div.clone();
    var rand = randomInteger(1, 999)+'-'+randomInteger(1, 999);
    html.find(".trl-den").attr("data-id", "cooperBlock-" + rand);
    var res = html.html();
    var clone =
      '<div class="poor-block">' + res + "</div>";
    localStorage.mem = clone;
    $(".fixed-plash-block").addClass("viss");
  }
});




$(document).on("click", ".cop-block.img", function (e) {
  var div = $(this).closest(".poor-block");
  var id = div.children(".element-bord").data("tag");
  var rand = randomInteger(1, 999) + "imgCop" + randomInteger(1, 999);
  var html = div.clone();
  // element-bord img-template  active
  html.find(".element-bord").attr("data-tag", rand);
  html.find(".element-bord").removeClass("rower-" + id);
  html.find(".element-bord").removeClass("active");
  html.find(".element-bord").addClass("rower-" + rand);

  // img-wol img-tag-486img635
  html.find(".img-wol").attr("data-tag", rand);
  html.find(".img-wol").removeClass("img-tag-" + id);
  html.find(".img-wol").addClass("img-tag-" + rand);
  if (html.find(".add-te").length) {
    html.find(".add-te").removeClass(id + "_opens");
    html.find(".add-te").addClass(rand + "_opens");
    html.find(".add-te").removeClass("tefg-" + id);
    html.find(".add-te").addClass("tefg-" + rand);
    html.find(".add-te").attr("data-tag", rand);
  }
  if (html.find(".signut").length) {
    html.find(".signut").removeClass(id + "_opens");
    html.find(".signut").removeClass("sig-img-" + id);

    html.find(".signut").addClass(rand + "_opens");
    html.find(".signut").addClass("sig-img-" + rand);
    html.find(".signut").attr("data-tag", rand);
  }
  var res = html.html();
  var clone = '<div class="poor-block">' + res + "</div>";
  localStorage.mem = clone;
  $(".fixed-plash-block").addClass("viss");
});

$(document).on("click", ".cop-block.video", function (e) {
  var div = $(this).closest(".poor-block");
  var id = div.children(".element-bord").data("tag");

  var rand =
    randomInteger(1, 999) +
    "vudeoAAAA" +
    randomInteger(1, 999) +
    randomInteger(1, 999);
  var html = div.clone();
  // console.log(rand);
  // element-bord img-template  active
  html.find(".element-bord").attr("data-tag", rand);
  html.find(".element-bord").removeClass("rower-" + id);
  html.find(".element-bord").removeClass("active");
  html.find(".element-bord").addClass("rower-" + rand);
  html.find(".img-wol").attr("data-tag", rand);
  html.find(".img-wol").removeClass("img-tag-" + id);
  html.find(".img-wol").addClass("img-tag-" + rand);
  if (html.find("video").length) {
    html.find("video").attr("data-tag", rand);
  }
  if (html.find(".add-te").length) {
    html.find(".add-te").removeClass(id + "_opens");
    html.find(".add-te").addClass(rand + "_opens");
    html.find(".add-te").removeClass("tefg-" + id);
    html.find(".add-te").addClass("tefg-" + rand);
    html.find(".add-te").attr("data-tag", rand);
  }

  if (html.find(".signut").length) {
    html.find(".signut").removeClass(id + "_opens");
    html.find(".signut").removeClass("sig-img-" + id);

    html.find(".signut").addClass(rand + "_opens");
    html.find(".signut").addClass("sig-img-" + rand);
    html.find(".signut").attr("data-tag", rand);
  }
  var res = html.html();

  var clone = '<div class="poor-block">' + res + "</div>";
  console.log(clone);
  localStorage.mem = clone;
  $(".fixed-plash-block").addClass("viss");
});

$(document).on("click", ".cop-block.title", function (e) {
  var div = $(this).closest(".poor-block");
  var id = div.find(".tit_elm").attr("id");
  var rand = "mainH2_" + randomInteger(1, 999) + "Cop" + randomInteger(1, 999);

  var html = div.clone();
  html.find(".tit_elm").attr("id", rand);
  var res = html.html();

  var clone = '<div class="poor-block">' + res + "</div>";
  localStorage.mem = clone;
  $(".fixed-plash-block").addClass("viss");
});

$(document).on("click", ".cop-block.video", function (e) {
  var div = $(this).closest(".poor-block");

  var html = div.clone();

  var id = html.find(".block-video").attr("data-id");
  var key = randomInteger(1, 999) + randomInteger(1, 999) + id;
  html.find(".block-video").removeAttr("class");

  html.find(".block-video").addClass("video_id-" + key);
  html.find(".block-video").attr("data-attr_id", key);

  var res = html.html();

  var clone = '<div class="poor-block">' + res + "</div>";
  localStorage.mem = clone;

  $(".fixed-plash-block").addClass("viss");
});

$(document).on("click", ".cop-block.colum", function (e) {
  var div = $(this).closest(".poor-block");
  $(".param-colum").removeClass("active");
  var html = div.clone();

  // if (html.find(".elga").hasClass("text-bb")) {
  //   var param1 =
  //     "texter" + randomInteger(1, 999) + "cop" + randomInteger(1, 999);
  //   var elem1 = html.find(".elga.text-bb");
  //   var first = elem1.data("first");
  //   elem1.removeClass(first);
  //   elem1.addClass(param1);
  //   elem1.attr("data-first", param1);
  //   elem1.children(".est-text").attr("data-id", param1);
  //   elem1.children(".est-text").removeClass(first + "_opens");
  //   elem1.children(".est-text").addClass(param1 + "_opens");
  // }

  html.find(".elga.text-bb").each(function (prop, index) {
    //console.log(prop);
    var param1 =
      "texter" + randomInteger(1, 999) + "cop" + randomInteger(1, 999);
    var elem1 = $(this);
    var first = elem1.data("first");
    elem1.removeClass(first);
    elem1.addClass(param1);
    elem1.attr("data-first", param1);
    elem1.children(".est-text").attr("data-id", param1);
    elem1.children(".est-text").removeClass(first + "_opens");
    elem1.children(".est-text").addClass(param1 + "_opens");
  });

  if (html.find(".elga").hasClass("text-fict")) {
    var param2 =
      "imper" + randomInteger(1, 999) + "cop" + randomInteger(1, 999);
    var elem2 = html.find(".elga.text-fict");
    var fict = elem2.data("fict");
    elem2.removeClass(fict);
    elem2.addClass(param2);
    elem2.attr("data-fict", param2);
  }
  if (html.find(".elga").children(".ul-wrap").length) {
    var param3 = "list" + randomInteger(1, 999) + "cop" + randomInteger(1, 999);
    var block1 = html.find(".elga").children(".ul-wrap");
    var block2 = block1.parent(".elga");
    var idse = block2.data("list");

    block2.removeClass("list_" + idse);
    block2.addClass("list_" + param3);
    block2.attr("data-list", param3);

    block1.attr("id", param3);
    block1.attr("data-id", param3);
  }

  if (html.find(".elga").children(".img-wrap").length) {
    var param4 = "imga" + randomInteger(1, 999) + "cop" + randomInteger(1, 999);
    var block1a = html.find(".elga").children(".img-wrap");
    var block2a = block1a.parent(".elga");
    var block3a = block1a.children(".img_in_elga");

    var idf = block2a.data("img_id");
    block1a.removeClass(idf + "_opens");
    block1a.addClass(param4 + "_opens");

    block2a.removeClass("imageElga_" + idf);
    block2a.addClass("imageElga_" + param4);
    block2a.attr("data-img_id", param4);

    block3a.attr("data-id", param4);
    block3a.removeClass("img_in_elga_" + idf);
    block3a.addClass("img_in_elga_" + param4);
  }
  // var rand = "mainH2_"+randomInteger(1, 999)+"Cop"+randomInteger(1, 999);

  var res = html.html();
  var clone = '<div class="poor-block">' + res + "</div>";
  localStorage.mem = clone;
  $(".fixed-plash-block").addClass("viss");
});

$(document).on("click", ".cop-paste", function (e) {
  var mem = localStorage.mem;
  $(this).closest(".poor-block").after(mem);
  localStorage.mem = "";
  $(".fixed-plash-block").removeClass("viss");
});
$(document).ready(function (e) {
  if (!!localStorage.mem) {
    $(".fixed-plash-block").addClass("viss");
  }
});

$(function () {
  var options = {
    maxLevels: 1,
    insertZone: 50,
    placeholderCss: { "background-color": "#ff8" },
    hintCss: { "background-color": "#bbf" },
    isAllowed: function (cEl, hint, target) {
      if (target.data("module") === "c" && cEl.data("module") !== "c") {
        hint.css("background-color", "#ff9999");
        return false;
      } else {
        hint.css("background-color", "#99ff99");
        return true;
      }
    },
    opener: {
      active: true,
      as: "html",
      close: '<i class="fa fa-minus c3"></i>',
      open: '<i class="fa fa-plus"></i>',
      openerCss: {
        display: "inline-block",
        float: "left",
        "margin-left": "-35px",
        "margin-right": "5px",
        "font-size": "1.1em",
      },
    },
    ignoreClass: "link_trof",
  };

  $("#listCon").sortableLists(options);
});
$(document).ready(function (e) {
  if ($(".actv_field").length) {
    var option = "";
    option += "<option value='start'>В начало</option>";
    $(".actv_field").each(function (e) {
      if ($(this).prop("checked")) {
        var id = $(this).data("id");
        var name = $('input[name="' + $(this).data("pos") + '[name]"]').val();
        option += "<option value=" + id + '> После "' + name + '"</option>';
      }
    });
    option += "<option value='end'>После всех</option>";
    $("#posLink").html(option);
  }
  $(".actv_field").change(function (e) {
    var arra = new Object();
    var i = 0;
    var option = "";
    option += "<option value='start'>В начало</option>";
    $(".actv_field").each(function (e) {
      if ($(this).prop("checked")) {
        // arra[i] = new Object();
        // arra[i]['id'] = new Object();
        // console.log($(this).data('id'));
        // i++;
        var id = $(this).data("id");
        var name = $('input[name="' + $(this).data("pos") + '[name]"]').val();
        option += "<option value=" + id + '> После "' + name + '"</option>';
      }
    });
    option += "<option value='end'>После всех</option>";
    $("#posLink").html(option);
  });
});

$(document).ready(function (e) {
  if ($(".selected-lang").length) {
    var val = $(".selected-lang").val();
    console.log(val);
    $('input[name="lang[' + val + '][name]"]').attr("disabled", "true");
    $(".selected-lang").on("change", function (e) {
      $(".lan-dispaly").removeAttr("disabled");
      var val = $(this).val();
      $('input[name="lang[' + val + '][name]"]').attr("disabled", "true");
    });
  }
  $("#articlesWidget").on("change", function (e) {
    var val = $(this).val();
    if (val) {
      $.post("/admin/articles/get-widget", { val, val }, Success);
      function Success(data) {
        $("#indexColum").html(data);
        //console.log(data);
      }
    }
  });
});

$(document).on("click", ".deleteThisElem", function (e) {
  $(this).closest(".operd").remove();
});
$(document).on("click", ".dir-tag", function (e) {
  var path = $(this).data("dir");
  $.post("/admin/file/get-dir", { path: path }, Success);
  function Success(data) {
    $(".pod_ht").css("display", "none");
    $(".pod_fd").html(data);
  }
});
$(document).on("click", ".dir-home", function (e) {
  $(".pod_ht").css("display", "block");
  $(".pod_fd").html("");
});
$(function () {
  $("#tabsNap").tabs();
});

$(document).on("change", ".changa-step", function (e) {
  var val = $(this).val();
  var id = $(this).data("id");

  if ($(".add-te.tefg-" + id).length) {
    var set = $(".add-te.tefg-" + id);
    var pos = set.siblings(".img-wrap").css("float");
    var order = set.siblings(".img-wrap").css("order");

    if (pos == "right" || pos == "left") {
      if (pos == "right") {
        CosR(id, val);
      }
      if (pos == "left") {
        CosL(id, val);
      }
    } else {
      if (order == "1") {
        CosPL(id, val);
      }
      if (order == "0") {
        CosRL(id, val);
      }
    }

    function CosPL(id, val) {
      $(".add-te.tefg-" + id)
        .siblings(".img-wrap")
        .css("margin-left", "0px");
      $(".add-te.tefg-" + id)
        .siblings(".img-wrap")
        .css("margin-right", "0px");
      $(".add-te.tefg-" + id).css("padding-right", val + "px");
      $(".add-te.tefg-" + id).css("padding-left", "0px");
    }
    function CosRL(id, val) {
      $(".add-te.tefg-" + id)
        .siblings(".img-wrap")
        .css("margin-left", "0px");
      $(".add-te.tefg-" + id)
        .siblings(".img-wrap")
        .css("margin-right", "0px");
      $(".add-te.tefg-" + id).css("padding-right", "0px");
      $(".add-te.tefg-" + id).css("padding-left", val + "px");
    }

    function CosL(id, val) {
      $(".add-te.tefg-" + id)
        .siblings(".img-wrap")
        .css("margin-left", "0px");
      $(".add-te.tefg-" + id)
        .siblings(".img-wrap")
        .css("margin-right", val + "px");
      $(".add-te.tefg-" + id).css("padding-right", "0px");
      $(".add-te.tefg-" + id).css("padding-left", "0px");
    }
    function CosR(id, val) {
      $(".add-te.tefg-" + id)
        .siblings(".img-wrap")
        .css("margin-right", "0px");

      $(".add-te.tefg-" + id)
        .siblings(".img-wrap")
        .css("margin-left", val + "px");
      $(".add-te.tefg-" + id).css("padding-right", "0px");
      $(".add-te.tefg-" + id).css("padding-left", "0px");
    }
  }
});

$(document).ready(function (e) {
  $("#pajaxRefer").on("click", function (e) {
    $.pjax.reload({ container: "#some_pjax_id", async: false });
  });
});
$(document).on("keyup input", ".seft", function (e) {
  var ret = $(this).val();
  if (ret != "") {
    $(".obedt").each(function (e) {
      $(this).closest("li").css("display", "block");
      var val = $(this).html();
      if (val.toUpperCase().indexOf(ret.toUpperCase()) >= 0) {
        $(this).closest("li").css("display", "block");
      } else {
        $(this).closest("li").css("display", "none");
      }
    });
  }
});
$(document).on("click", ".flowColum", function (e) {
  var id = $(this).data("id");
  //$(this).text('Отключить авто размер колонки');
  $(this).text("Включить авто размер колонки");
  $(this).addClass("flowAddColum");
  $(this).removeClass("flowColum");
  e.preventDefault();

  $('.elga[data-img_id="' + id + '"]')
    .parent(".param-colum")
    .css("flex-grow", "inherit");
});
$(document).on("click", ".flowAddColum", function (e) {
  e.preventDefault();
  $(this).text("Отключить авто размер колонки");
  //$(this).text('Включить авто размер колонки');
  $(this).addClass("flowColum");
  $(this).removeClass("flowAddColum");
  var id = $(this).data("id");
  $('.elga[data-img_id="' + id + '"]')
    .parent(".param-colum")
    .css("flex-grow", "1");
});

$(document).on("click", ".posert", function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  if ($(this).hasClass("texflowColum")) {
    $(this).text("Включить авто размер колонки");
    $(this).removeClass("texflowColum");
    $(this).addClass("texflowAddColum");
    $('.est-text[data-id="' + id + '"]')
      .closest(".param-colum")
      .css("flex-grow", "inherit");
  } else {
    if ($(this).hasClass("texflowAddColum")) {
      $(this).text("Отключить авто размер колонки");
      $(this).addClass("texflowColum");
      $(this).removeClass("texflowAddColum");
      $('.est-text[data-id="' + id + '"]')
        .closest(".param-colum")
        .css("flex-grow", "1");
    }
  }
});
$(document).on("change", 'select[name="paramauto"]', function (e) {
  var id = $(this).attr("id");
  var val = $(this).val();
  if (val != "default") {
    var secr = '<span class="' + id + " open " + val + '"></span>';
    $('.est-text[data-id="' + id + '"]').html(secr);
  } else {
    $("span .open." + id).rmeove();
  }
});

$(document).on("click", "#add-quete", function (e) {
  $("#quote").modal("show");
});

$(document).on("click", ".asd-fert", function (e) {
  var plob = "<p>asda1111111sdasdasdasd</p>";
  console.log($("#quote-bodsy").html(plob));
  $('#quote-bodsy-container div[contenteditable="true"]').html(plob);
  $("#quote-bodsy").val(plob);
});

$(document).on("change", "#colorImageBg", function (e) {
  var id = $("#idBlock").val();
  $("." + id).css("background-color", $(this).val());
});

$(document).on("change", ".radius-step", function (e) {
  var id = $("#idBlock").val();
  $("." + id).css("border-radius", $(this).val() + "px");
});
$(document).keyup(function (e) {
  console.dir(e);
  if (e.shiftKey && e.keyCode === 13) {
    insertTextAtCursor();
  }
  if (e.keyCode === 8) {
    e.preventDefault();
    return false;
  }
});
// Enter 13
// shift294

// "ShiftLeft"
// "Shift"
// 16


$(document).on("paste", "div[contenteditable='true']", function (event) {
  event.preventDefault();
  var text = window.event.clipboardData.getData("text/plain");
  var elsea = $(this)
  var sel, range;
  // document.execCommand("insertHTML", false, text);
  
  if (window.getSelection() == "") {
    sel = window.getSelection();
    if (sel.getRangeAt && sel.rangeCount) {
      range = sel.getRangeAt(0);
      range.deleteContents();
      range.insertNode(document.createTextNode(text));
    }
  } else if(document.selection && document.selection.createRange) {
    document.selection.createRange().text = text;
  }

});


  



function insertTextAtCursor() {
  var sel, range, html;
  if (window.getSelection) {
    sel = window.getSelection();

    newNode = document.createElement("span");
    newNode.className = "gap-text";

    newNode.appendChild(document.createTextNode(" "));
    if (sel.getRangeAt && sel.rangeCount) {
      range = sel.getRangeAt(0);
      range.deleteContents();
      range.insertNode(newNode);
    }
  } else if (document.selection && document.selection.createRange) {
    document.selection.createRange().text = text;
  }
}

/////////////////BTN//////////////////////
$(document).on("change", ".lh-gap", function (e) {
  var val = $(this).val();
  var tag = $(this).data("reb");
  if ($('.add-te[data-tag="' + tag + '"]').length) {
    $('.add-te[data-tag="' + tag + '"]')
      .find("span.gap-text")
      .css("height", val + "px");
  }
  if ($('.est-text[data-id="' + tag + '"]').length) {
    $('.est-text[data-id="' + tag + '"]')
      .find("span.gap-text")
      .css("height", val + "px");
  }
  if ($('.contrel-text[data-reb="' + tag + '"]').length) {
    $('.contrel-text[data-reb="' + tag + '"]')
      .find("span.gap-text")
      .css("height", val + "px");
  }
});
$(document).on('click', '.trl-den', function(e){
  var id = $(this).data('id');
  var height = $(this).height();
  $.post('/admin/accardion/paddinger-param',{id: id, height: height}, Success);
  function Success(data){
    $(".block-parametrs").html(data);
  }
})


$(document).on('click', '.paddingerToper', function(e){
  var val = $(this).val();
  var id = $('.paddingerIdtype').val();
  $('.trl-den[data-id="'+id+'"]').css('height', val+'px');
});




