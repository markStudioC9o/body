function AddsImage(){
  $.post('/admin/articles/render-image-gal',Success);
  function Success(data){
    $('#idrety').html(data);
    $("#image").modal("show");
  }
}


function randomInteger(min, max) {
  let rand = min - 0.5 + Math.random() * (max - min + 1);
  return Math.round(rand);
}
$(document).on('click', '.video-pop .controll', function(e){
  var dataId = $(this).closest(".abbred-image").data("img_id");
  var src = $(this).data('src');
  // console.log(src);
  
  if($(this).closest('.abbred-image').hasClass('aprovCol')){
    aprovVideo(src, dataId);
  }else{
    addVideStr(src);
  }
})
$(document).on("click", ".rever-img", function (e) {
  AddsImage();
  $(".abbred-image").addClass("rever-img");
  $(".abbred-image").attr("data-img_id", $(this).data("id"));
});

$(document).on("click", ".img-tag-prop", function (e) {
  $("#image").modal("hide");
  var src = $(this).data("img");
  var random = randomInteger(1, 999) + "img" + randomInteger(1, 999);

  if($(this).closest(".abbred-image").hasClass("qouter")){
    var link = $(this).data('img');
    $('#link-img').val(link);
    $('#link-icon').val('');
    $(this).closest(".abbred-image").removeClass("qouter");
    return false;
  }

  if ($(this).closest(".abbred-image").hasClass("imageCol")) {
    var dataId = $(this).closest(".abbred-image").data("img_id");
    addImageCol(src, dataId);
    $("#image .abbred-image").removeClass("imageCol");
    return false;
  }

  if ($(this).closest(".abbred-image").hasClass("aprovCol")) {
    var dataId = $(this).closest(".abbred-image").data("img_id");
    aprovCol(src, dataId);
    $("#image .abbred-image").removeClass("aprovCol");
    return false;
  }

  if ($(this).closest(".abbred-image").hasClass("in-slider")) {
    var name = $(".abbred-image").data("img_id");
    $('input[name="name-' + name + '"]').val(src);
    $(".abbred-image").data("img_id", "");
    $("#image .abbred-image").removeClass("in-slider");
    return false;
  }

  if ($(this).closest(".abbred-image").hasClass("inAcardion")) {
    var id = $(".abbred-image.inAcardion").attr("data-img_id");
    addImageInAcardion(src, id);
    $(".abbred-image").removeClass("inAcardion");
    return false;
  }
  if ($(this).closest(".abbred-image").hasClass("rever-img")) {
    var id = $(".abbred-image.rever-img").attr("data-img_id");
    $(".img-tag-" + id).attr("src", $(this).attr("src"));
    $(".abbred-image").removeClass("rever-img");
    return false;
  }

  addImageStr(src, random);
});

function addImageInAcardion(src, id) {
  $.post("/admin/articles/render-image", { src: src }, Success);
  function Success(data) {
    if (data) {
      console.log(id);
      $(".content-one-accardion[data-id='"+id+"']").append(data);
      $("#dataRed-" + id).removeAttr("contenteditable");
      $("#dataRed-" + id).removeClass("contrel-text");
      $("#dataRed-" + id)
        .parent("div")
        .removeAttr("class");
      $("#dataRed-" + id)
        .parent("div")
        .removeAttr("id");
    }
  }
}

$(document).on("click", "#image .close", function (e) {
  $("#image .abbred-image").removeClass("imageCol");
});

function aprovCol(src, id) {
  var classList = "imter" + id;
  var decster = '<div class="sled-ty"></div><span class="at_i">A</span>';
  var styleInCol = 'background-image:url("/gallery/' + src + '")';
  var subs = $("#imgSub").val();
  var image =
    decster +
    '<div class="img-wrap-in-col" style=' +
    styleInCol +
    ' data-src="' +
    src +
    '" data-sub="' +
    subs +
    '"><span class="cadring">+</span></div>';
  $("." + id).html(image);
}


function aprovVideo(src, id) {
  var width = $("." + id).width();
  var element = '<div class="sled-ty"></div><span class="at_i">A</span><video width="'+width+'px" data-tag="'+id+'" autoplay loop muted playsinline><source src="'+src+'"></video>';
  $("." + id).html(element);
}

function addVideStr(src){
  $.post('/admin/file/render-video', {src: src}, Success);
  function Success(data){
    if (data) {
      MainBlock.append(data);
    }
  }
}

function addImageStr(src) {
  if (!$(".abbred-image").hasClass("rever-img")) {
    $.post("/admin/articles/render-image", { src: src }, Success);
    function Success(data) {
      if (data) {
        MainBlock.append(data);
      }
    }
  }else{
    var id = $(".abbred-image.rever-img").attr("data-img_id");
    $(".img-tag-" + id).attr("src", '/gallery/'+src);
    $(".abbred-image").removeClass("rever-img");
    return false;
  }
}

function addImageCol(src, id) {
  // var image =  '' '/gallery/'+src;
  var classList = "img_in_elga  img_in_elga_" + id;
  var image =
    '<div class="img-wrap image-colum_padding_tag ' +
    id +
    '_opens"><img src="/gallery/' +
    src +
    '" data-id="' +
    id +
    '" class="' +
    classList +
    '"></div>';
  $(".imageElga_" + id).append(image);
}

$(document).on("click", ".img_in_elga", function (e) {
  var id = $(this).data("id");
  var output = new Object();
  var cssProperties = $(this)
    .parent(".img-wrap")
    .css(["padding-left", "padding-right", "padding-top", "padding-bottom"]);
  $.each(cssProperties, function (prop, value) {
    output[prop] = value;
  });

  var parentColum = $(this).closest('.param-colum').css('flex-grow');
  
  

  var parent = $(this).parent();
  if (parent[0].nodeName == "A") {
    var por = new Object();
    por["href"] = parent.attr("href");
    if (parent.attr("target").length && parent.attr("target") == "_blank") {
      por["target"] = true;
    }
  } else {
    var por = null;
  }
  var width = $(this).closest(".param-colum").css("width");
  $.post(
    "/admin/colum-image/param-image",
    { id: id, output: output, por: por, width: width, parentColum: parentColum },
    Success
  );
  function Success(data) {
    $(".block-parametrs").html(data);
    var width = $(this).closest(".param-colum").css("width");
  }
});








$(document).on("change", ".blockWidthCol", function (e) {
  var id = $(".idImageColum").val();
  $(".img_in_elga_" + id)
    .closest(".param-colum")
    .css("width", $(this).val() + "px");
});

$(document).on("click", ".fa-ad-image", function (e) {
  AddsImage();
  var randImageNum = randomInteger(1, 999);
  var classImg = "imageElga_" + randImageNum;
  $(this).closest(".param-colum").children(".elga").addClass(classImg);
  $(this)
    .closest(".param-colum")
    .children(".elga")
    .attr("data-img_id", randImageNum);
  if (!$("#image .abbred-image").hasClass("imageCol")) {
    $("#image .abbred-image").addClass("imageCol");
    $("#image .imageCol").data("img_id", randImageNum);
  }
});

$(document).on("click", ".flopImage", function (e) {
  var id = $(this).data("id");
  var obj = $(".img_in_elga_" + id);
  var parentBlock = obj.closest(".param-colum");

  $(".img_in_elga_" + id).css("width", "100%");
  parentBlock.css("width", "calc(100%/3)");
  parentBlock.css("flex-grow", "1");
});
$(document).on("click", ".flopColum", function (e) {
  var id = $(this).data("id");
  var obj = $(".img_in_elga_" + id);
  var parentBlock = obj.closest(".param-colum");
  parentBlock.css("width", "fit-content");
  parentBlock.css("flex-grow", "inherit");
  //$('.img_in_elga_'+id).css('width', '100%');
});
$(document).on("click", ".del-img-col", function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  if ($(".imageElga_" + id).length) {
    $(".imageElga_" + id)
      .children(".img-wrap." + id + "_opens")
      .remove();
    $(".block-parametrs").html("");
    $(".imageElga_" + id).removeAttr("data-img_id");
  }
  if ($(".elga").hasClass("imageElga_" + id)) {
    $(".elga").removeClass("imageElga_" + id);
  }
});

$(document).on("click", ".addLinkSeh", function (e) {
  if ($(".linkFromImgLink").length) {
    var tar = "target='_blank'";
    var id = $(".idImageColum").val();

    var val = $(".linkFromImgLink").val();
    var ser = $(".img_in_elga_" + id).parent();

    if (ser[0].nodeName == "DIV") {
      if (val != "") {
        $(".img_in_elga_" + id).wrap(
          '<a class="sepul" ' + tar + ' href="' + val + '"></a>'
        );
      }
    } else {
      if (val != "") {
        $(".img_in_elga_" + id).unwrap("a");
        $(".img_in_elga_" + id).wrap(
          '<a class="sepul" ' + tar + ' href="' + val + '"></a>'
        );
      } else {
        $(".img_in_elga_" + id).unwrap("a");
      }
    }
  }
});

$(document).on("click", "a.sepul", function (e) {
  e.preventDefault();
});
