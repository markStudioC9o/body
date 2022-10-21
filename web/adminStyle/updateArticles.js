$(document).ready(function (e) {
  var deefer =
    '<div class="step-block" style="opacity: 0;">' +
    '<span class="up-bs">' +
    '<i class="fa fa-arrow-up"></i>' +
    "</span>" +
    '<span class="down-bs">' +
    '<i class="fa fa-arrow-down"></i>' +
    "</span>" +
    '<span class="del-bs">' +
    '<i class="fa fa-trash"></i>' +
    "</span>" +
    "</div>";

    var setting = '<div class="sirkle-param-cop"><i class="fa fa-plus"></i><div class="cropp-block"><ul><li class="cop-block title">Копировать</li><li class="cop-paste">Вставить</li></ul></div></div>';
    var setting2 = '<div class="sirkle-param-cop"><i class="fa fa-plus"></i><div class="cropp-block"><ul><li class="cop-block text">Копировать</li><li class="cop-paste">Вставить</li></ul></div></div>';
    var setting3 = '<div class="sirkle-param-cop"><i class="fa fa-plus"></i><div class="cropp-block"><ul><li class="cop-block img">Копировать</li><li class="cop-paste">Вставить</li></ul></div></div>';
    var setting4 = '<div class="sirkle-param-cop"><i class="fa fa-plus"></i><div class="cropp-block"><ul><li class="cop-block colum">Копировать</li><li class="cop-paste">Вставить</li></ul></div></div>';
    var setting5 = '<div class="sirkle-param-cop"><i class="fa fa-plus"></i><div class="cropp-block"><ul><li class="cop-paste">Вставить</li></ul></div></div>';
    var video = '<div class="sirkle-param-cop"><i class="fa fa-plus"></i><div class="cropp-block"><ul><li class="cop-block video">Копировать</li><li class="cop-paste">Вставить</li></ul></div></div>';


if($('.block-qout').length){
  $('.block-qout').each(function(e){
    $(this).closest('.poor-block').append(deefer);
  });
}

  if ($("#mainH1").length) {
    $("#mainH1").children(".title-text").attr("contenteditable", "true");
    $("#mainH1")
      .parent(".block-tex-title.element-bord")
      .wrap('<div class="poor-block" />');
    $("#mainH1").closest(".poor-block").append(deefer);
    $("#mainH1").closest(".poor-block").append(setting);
    
  }
  if ($(".block-tex-title.element-bord").length) {
    $(".block-tex-title.element-bord").each(function (e) {
      var id = $(this).children("h2").attr("id");
      $("#" + id)
        .children(".title-text")
        .attr("contenteditable", "true");
      $("#" + id)
        .parent(".block-tex-title.element-bord")
        .wrap('<div class="poor-block" />');
      $("#" + id)
        .closest(".poor-block")
        .append(deefer);
        $("#" + id)
        .closest(".poor-block")
        .append(setting);
    });
    
  }
  if ($(".content-text-redactor").length) {
    $(".content-text-redactor").each(function (e) {
      $(this).children(".contrel-text").attr("contenteditable", "true");
      $(this).parent(".poor-block").append(deefer);
      $(this).parent(".poor-block").append(setting2);
      
    });
  }

  var setLestBlock =
    '<ul class="setLestBlock">' +
    "<li>" +
    '<span class="pul">' +
    '<i class="fa fa-plus"></i>' +
    "</span>" +
    "</li>" +
    "</ul>";
  var setCletBlock =
    '<ul class="setLestBlock">' +
    "<li>" +
    '<span class="pul">' +
    '<i class="fa fa-plus"></i>' +
    "</span>" +
    "</li>" +
    "<li>" +
    '<span class="min">' +
    '<i class="fa fa-minus"></i>' +
    "</span>" +
    "</li>" +
    "</ul>";
  // var setColBlock =
  //   '<ul class="setColBlock">' +
  //   '<li class="fa-ad-col"><i class="fa fa-list" aria-hidden="true"></i></li>'+
  //   '<li class="fa-ad-file">' +
  //   '<i class="fa fa-file"></i>' +
  //   "</li>" +
  //   '<li class="fa-ad-image">' +
  //   '<i class="fa fa-image"></i>' +
  //   "</li>" +
  //   "</ul>";

    var setColBlock = '<ul class="setColBlock"><li class="fa-ad-file"><i class="fa fa-file"></i></li><li class="fa-ad-text">Tt</li><li class="fa-ad-image"><i class="fa fa-image"></i></li></ul>';

  // if($('.param-colum').length){
  //   var i = 1;
  //   $('.param-colum').each(function(e){
  //     if(i != 1){
  //       if(!$(this).children(".setLestBlock").length){
  //         $(this).append(setLestBlock);
  //       }
  //       if(!$(this).children(".setColBlock").length){
  //         $(this).append(setColBlock);
  //       }
  //     }
  //     i++;
  //   })
  // }
  if ($(".bt-sg").length) {
    $(".bt-sg").each(function (e) {
      if (!$(this).parent(".poor-block").children(".step-block").length) {
        $(this).parent(".poor-block").prepend(deefer);
        $(this).parent(".poor-block").prepend(setting4);
        
      }
      var i = 1;
      $(this)
        .children(".param-colum")
        .each(function (e) {
          if (!$(this).children(".setColBlock").length) {
            $(this).append(setColBlock);
          }
          if (i == 1) {
            if (!$(this).children(".setLestBlock").length) {
              $(this).append(setLestBlock);
            }
          } else {
            if (!$(this).children(".setLestBlock").length) {
              $(this).append(setCletBlock);
            }
          }
          i++;
        });
    });
  }
  
  if ($(".img-template").length) {
    $(".img-template").each(function (e) {
      $(this).wrap('<div class="poor-block" />');
      $(this).parent(".poor-block").prepend(deefer);
      $(this).parent(".poor-block").prepend(setting3);
    });
  }
  if ($(".element-bord").length) {
    $(".element-bord").each(function (e) {
      if (!$(this).parent(".poor-block").length) {
        $(this).wrap('<div class="poor-block" />');
        $(this).parent(".poor-block").prepend(deefer);
      }
    });
  }
  if($('.content-form-redactor').length){
    $('.content-form-redactor').each(function(e){
      $(this).parent(".poor-block").prepend(deefer);
    })
  }
  if($('.block-accardion').length){
    $('.block-accardion').each(function(e){
      $(this).parent(".poor-block").prepend(deefer);
    })
  }
  if($(".trl-den").length){
    $('.trl-den').each(function(e){
      $(this).parent(".poor-block").prepend(deefer);
    })
  }
  if($(".block-form-end").length){
    $('.block-form-end').each(function(e){
      $(this).parent(".poor-block").prepend(deefer);
    })
  }
  if($(".boot").length){
    $('.boot').each(function(e){
      $(this).parent(".poor-block").prepend(deefer);
    })
  }
  if($('.block-video-default').length){
    $('.block-video-default').each(function(e){
      $(this).closest('.poor-block').prepend(video);
    });
  }
  if($('.gall-img-template').length){
    $('.gall-img-template').each(function(e){
      $(this).closest('.poor-block').prepend(setting5);
    })
  }
  if($('.block-slider-gal').length){
    $('.block-slider-gal').each(function(e){
      $(this).closest('.poor-block').prepend(setting5);
    })
  }
  let set6 = '<div class="sirkle-param-cop"><i class="fa fa-plus"></i><div class="cropp-block"><ul><li class="margin-block-coper">Копировать</li><li class="cop-paste">Вставить</li></ul></div></div>';
  if($('.trl-den').length){
    $('.trl-den').each(function(e){
      $(this).closest('.poor-block').prepend(set6);
    })
  }
  
  
});

// setting5