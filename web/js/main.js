$(function () {
  const windowWidth = window.outerWidth;
  $.post("/site/size-load", { windowWidth: windowWidth }, Success);
  function Success(data) {
    if (data == "203") {
      document.location = document.location;
    }
  }
});

$(document).ready(function (event) {
  var windowWidth = window.outerWidth;
  if (windowWidth > 1600) {
    $.session.set("siz", "1680");
  } else if (windowWidth < 1599 && windowWidth > 1366) {
    $.session.set("siz", "1440");
  } else if (windowWidth < 1365 && windowWidth > 1024) {
    $.session.set("siz", "1280");
  } else if (windowWidth < 1024) {
    $.session.set("siz", "370");
  } else {
  }
});

window.addEventListener(
  "resize",
  (event) => {
    var windowWidth = window.outerWidth;
    var vter = $.session.get("siz");

    if (windowWidth > 1600) {
      if (vter < 1600) {
        $.session.set("siz", "1680");
        document.location = document.location;
      }
    } else if (windowWidth < 1599 && windowWidth > 1366) {
      if (vter > 1599 || vter < 1366) {
        $.session.set("siz", "1440");
        document.location = document.location;
      }
    } else if (windowWidth < 1365 && windowWidth > 1024) {
      if (vter > 1365 || vter < 1024) {
        $.session.set("siz", "1280");
        document.location = document.location;
      }
    } else if (windowWidth < 1024) {
      if (vter > 1024) {
        $.session.set("siz", "370");
        document.location = document.location;
      }
    } else {
    }
  },
  false
);
//console.log($.session.get("siz"), "222");
// $('.main-menu-item.menu-item-has-children > a:not([href*="/shop/"])').each(function(){
// 	$(this).attr('href','javascript:void(0);')
// });

$("#bottom_header ul li").hover(
  function () {
    if (!$(this).hasClass("link-shop")) {
      $(this)
        .find("a.main-menu-link")
        .css("background-color", $(this).attr("data-color"));
      $(this)
        .find("ul.sub-menu")
        .css("background-color", $(this).attr("data-color"))
        .slideDown(10);
    }
  },
  function () {
    if (!$(this).hasClass("link-shop")) {
      $(this).find("a.main-menu-link").css("background-color", "transparent");
      $(this)
        .find("ul.sub-menu")
        .slideUp(10)
        .css("background-color", "transparent");
    }
  }
);
$("#bottom_header ul li > ul > li > a").hover(
  function () {
    $(this).css(
      "color",
      $(this)
        .parents(".menu-item-has-children")
        .find("a.menu-link")
        .attr("data-color")
    );
  },
  function () {
    $(this).css("color", "#fff");
  }
);

// $( "#mob_menu .mob_list > li.menu-item-has-children" ).click(function(e) {
// 	if($(this).hasClass('opened')){
// 		$(this).removeClass('opened').css('background-color', 'transparent');
// 		$(this).find('ul.sub-menu').slideUp(100);
// 	} else {
// 		$(this).addClass('opened').css('background-color',$(this).attr('data-color'));
// 		$(this).find('ul.sub-menu').slideDown(100);
// 	}
// });
$(document).on(
  "click",
  "#mob_menu .mob_list > li.menu-item-has-children:not(.opened)",
  function (e) {
    e.preventDefault();
    $("#mob_menu .mob_list > li.menu-item-has-children.opened")
      .removeClass("opened")
      .css("background-color", "transparent");
    $("#mob_menu ul.sub-menu").slideUp(100);
    $(this)
      .addClass("opened")
      .css("background-color", $(this).attr("data-color"));
    $(this).find("ul.sub-menu").slideDown(100);
  }
);

$(document).ready(function () {
  // var home_top_slider = new Swiper("#home_top_slider .swiper-container", {
  //   slidesPerView: 1,
  //   spaceBetween: 0,
  //   pagination: {
  //     el: '.swiper-pagination',
  //     type: 'bullets',
  //   },
  //   autoplay: {
  //     delay: 13000,
  //     disableOnInteraction: false,
  //   },
  // });

  var home_top_slider = new Swiper("#home_top_slider .swiper-container", {
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
    speed: 1000,
    spaceBetween: 0,
    autoplay: {
      delay: 8000,
      disableOnInteraction: false,
    },
  });

  home_top_slider.on("slideChangeTransitionEnd", function () {
    let index = $("#home_top_slider")
      .find(".swiper-slide-active")
      .attr("data-slide-item");
    $(
      '#home_top_slider .to_slide:not([data-bullet-item="' + index + '"])'
    ).removeClass("active");
    $('#home_top_slider .to_slide[data-bullet-item="' + index + '"]').addClass(
      "active"
    );
    $("#home_mob_icons .item").removeClass("active");
    $('#home_mob_icons .item[data-bullet-item="' + index + '"]').addClass(
      "active"
    );
  });

  $("#home_top_slider .to_slide").hover(function () {
    let index = $(this).attr("data-bullet-item");
    $("#home_top_slider .to_slide").removeClass("active");
    $(this).addClass("active");
    $(
      "#home_top_slider .swiper-pagination-bullet:nth-child(" + index + ")"
    ).click();
  });

  $("#home_mob_icons .item").click(function () {
    let index = $(this).attr("data-bullet-item");
    $(
      "#home_top_slider .swiper-pagination-bullets .swiper-pagination-bullet:nth-child(" +
        index +
        ")"
    ).click();
  });

  $("#home_top_slider .to_popap").click(function () {
    let slides = $("#home_top_slider .swiper-wrapper").html();
    $("#home_top_slider").after(
      '<div id="home_top_slider_modal" class="modal banners_modal"><div class="bg"></div><div class="wrap"><span class="close"></span><div class="content">' +
        slides +
        "</div></div></div>"
    );
    $("#home_top_slider_modal").show();
  });
});
$(document).ready(function (e) {
  (function ($) {
    $.lebnikLoad = function (selector, url, callback) {
      $(document.body).lebnikLoad(selector, url, callback, true);
    };
    $.fn.lebnikLoad = function (
      selector,
      url,
      callback,
      without_selector_document
    ) {
      var selector_document = this;
      var e = $(
        '<iframe width="1086" height="611" src="' +
          url +
          '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
      );
      $(document.body).append(e);
      $(e).on("load", function () {
        var x = $(selector, e[0].contentWindow.document);
        if (callback) {
          callback(x);
        } else if (without_selector_document != true) {
          $(selector_document).html($(x).html());
        }
      });
    };
  })(jQuery);
});

$(document).on("click", ".btn-play", function (e) {
  //
  var attrId = $(this).parent(".block-video").data("attr_id");

  var height = $(this).parent(".block-video").height();
  var id = $(this).data("id");
  var type = $(this).data("type");
  $("#vide_id_" + attrId).css("height", height + "px");
  var iframe = document.createElement("iframe");
  iframe.setAttribute("style", "width:100%;height:100%");
  iframe.setAttribute("autoplay", "1");
  iframe.setAttribute("id", "video_loop_" + attrId);
  iframe.src =
    "https://www.youtube.com/embed/" +
    id +
    "?enablejsapi=1&wmode=transparent&autoplay=1";
  iframe.title = "YouTube video player";
  iframe.frameborder = "0";
  iframe.allow =
    "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
  iframe.loading = "lazy";

  if ($(this).parent(".block-video").hasClass("video-in-modal")) {
    $("#em_video").modal("show");
    setTimeout(() => {
      $("#video_pop").html(iframe);
    }, 300);
  } else {
    $("#vide_id_" + attrId).html(iframe);
  }
});

$(document).on("click", "#em_video .close", function (e) {
  var id = $("#video_pop iframe").attr("id");
  $("#" + id).remove();
});
var container = $(".bullet_title");

$(window).on("resize load", recalLines);
function recalLines() {
  var lines = 0,
    outerWrap = $('<div class="outer_wrapper">'),
    innerWrap = $('<div class="inner_wrapper">');
  innerWrap.text(container.text()).css("display", "inline").appendTo(outerWrap);
  outerWrap.appendTo("body").css({
    position: "absolute",
    left: -100500,
    width: container.width(),
    height: container.height(),
  });
  lines = innerWrap[0].getClientRects();
  outerWrap.remove();
  //console.log(lines);
}

$(document).on("click", ".burger_menu", function (e) {
  if ($(this).hasClass("active")) {
    $(this).removeClass("active");
    $(this).children(".ps-2").css("display", "block");
    $(this)
      .children(".ps-1")
      .css("transform", "rotate(0deg)")
      .css("top", "-5px");
    $(this)
      .children(".ps-3")
      .css("transform", "rotate(0deg)")
      .css("top", "11px");
    $(this).children(".tlt").css("display", "block");
    $("#mob_menu").css("display", "none");
    $("#mob_bottom_header").css("display", "flex");
    $("header").removeClass("ficser");
    $("body").css("overflow-y", "inherit");
    $(".lang-mob.ff").css("opacity", "1");
  } else {
    $(".lang-mob.ff").css("opacity", "0");

    $("body").css("overflow-y", "hidden");
    $("#mob_bottom_header").css("display", "none");
    $(this).removeClass("fixed");
    $("header").addClass("ficser");
    $(this).addClass("active");
    $(this)
      .children(".ps-1")
      .css("transform", "rotate(-45deg)")
      .css("top", "10px");
    $(this)
      .children(".ps-3")
      .css("transform", "rotate(45deg)")
      .css("top", "10px");
    $(this).children(".ps-2").css("display", "none");
    $(this).children(".tlt").css("display", "none");
    $("#mob_menu").css("display", "block");
  }
});

$(document).scroll(function () {
  var scroll = $(document).scrollTop();
  if (scroll > 99) {
    $(".burger_menu").addClass("fixed");
  } else {
    $(".burger_menu").removeClass("fixed");
  }
});

$("div").removeAttr("contenteditable");

$(document).ready(function (e) {
  $(".del-elem-accr").remove();
  $(".add-alem-accr").remove();
  var galca = '<div class="galca"><span></span><span></span></div>';
  $(".accardion-title").append(galca);

  $(".accardion-title").on("click", function (e) {
    if ($(this).hasClass("opens")) {
      $(this).removeClass("opens");
      $(this).next("div").css("display", "none");
    } else {
      $(this).addClass("opens");
      $(this).next("div").css("display", "block");
    }
  });

  $(".asp-gall").on("click", function (e) {
    var targImg = e.target.getAttribute("data-src");
    var obj = new Object();
    var i = 0;
    $(".img-wrap-in-col").each(function (e) {
      obj[i] = new Object();
      obj[i]["src"] = $(this).data("src");
      obj[i]["scrub"] = $(this).data("sub");
      i++;
    });

    $.post("/site/image-popup", { obj: obj, targImg: targImg }, Success);
    function Success(data) {
      $("#blosker").html(data);
      $(".wrapper-black").addClass("active");
    }
  });

  $(document).on("click", ".prew-img img", function (e) {
    //console.log(e.target.getAttribute("src"));
    if (
      e.target.getAttribute("src") == "/icon/left-a.svg" ||
      e.target.getAttribute("src") == "/icon/right-a.svg"
    ) {
    } else {
      var parent = $(this).closest(".block-slider-gal");
      var targImg = $(this).data("src");
      var obj = new Object();
      var i = 0;
      if (parent.find(".flort").length) {
        parent.find(".flort div").each(function (e) {
          obj[i] = new Object();
          obj[i]["src"] = $(this).data("src");
          i++;
        });
        $.post("/site/image-popup", { obj: obj, targImg: targImg }, Success);
        function Success(data) {
          $("#blosker").html(data);
          $(".wrapper-black").addClass("active");
        }
      }
    }
  });

  $(document).on("click", ".or-elm div img", function (e) {
    var src = $(this).attr("src");
    var scrub = $(this).attr("data-scrub");
    var sret = "";
    if (scrub != "") {
      var scrub = $(this).attr("data-scrub");
      sret = '<div class="scrub">' + scrub + "</div>";
    }
    var perimage =
      '<div class="im-wr"><img src="' +
      src +
      '" id="prewImage-s"></div><div id=\"plazer-zoom\"></div>' +
      sret;
    $(".perimage").html(perimage);
  });
  // $('.wrapper-black').on('click', function(e){
  //   $(this).removeClass('active');
  // })

  $(document).mouseup(function (e) {
    var div = $(".im-wr img");
    var div2 = $(".or-elm img");
    var div3 = $(".class-loop");
    var div4 = $(".iicon-loop");
    //console.log(e.target);
    if (
      !div.is(e.target) &&
      !div2.is(e.target) &&
      !div3.is(e.target) &&
      !div4.is(e.target)
    ) {
      $(".wrapper-black").removeClass("active");
    }
    var dev = $(".search_form_header");
    if (!dev.is(e.target) && dev.has(e.target).length === 0) {
      if ($(".search_icon").hasClass("opner")) {
        dev.css("display", "none");
        $(".search_icon").removeClass("opner");
      }
    }
  });
});
$(document).on("click", ".img-werst", function (e) {
  var src = $(this).data("src");
  var id = $(this).data("id");
  $(".prew-img")
    .find('img[data-id="' + id + '"]')
    .attr("src", "/gallery/" + src);
  $(".prew-img")
    .find('img[data-id="' + id + '"]')
    .attr("data-src", src);
});
$(document).on("click", ".right-slig", function (e) {
  //var id =
  var id = $(this).closest(".block-slider-gal").data("id");
  var src = $(this).siblings("img").data("src");
  $(".img-werst." + id).each(function (e) {
    if (src == $(this).data("src")) {
      if ($(this).next().length) {
        var pret = $(this).next().data("src");
        $('.prew-img  img[data-id="' + id + '"]').attr(
          "src",
          "/gallery/" + pret
        );
        $('.prew-img  img[data-id="' + id + '"]').data("src", pret);
      } else {
        var pret = $(this)
          .parent(".flort")
          .children(".img-werst:first-child")
          .data("src");
        $('.prew-img  img[data-id="' + id + '"]').attr(
          "src",
          "/gallery/" + pret
        );
        $('.prew-img  img[data-id="' + id + '"]').data("src", pret);
      }
    }
  });
});

$(document).on("click", ".left-slig", function (e) {
  //var id =
  var id = $(this).closest(".block-slider-gal").data("id");
  var src = $(this).siblings("img").data("src");
  $(".img-werst." + id).each(function (e) {
    if (src == $(this).data("src")) {
      if ($(this).prev().length) {
        var pret = $(this).prev().data("src");
        $('.prew-img  img[data-id="' + id + '"]').attr(
          "src",
          "/gallery/" + pret
        );
        $('.prew-img  img[data-id="' + id + '"]').data("src", pret);
      } else {
        var pret = $(this)
          .parent(".flort")
          .children(".img-werst:last-child")
          .data("src");
        $('.prew-img  img[data-id="' + id + '"]').attr(
          "src",
          "/gallery/" + pret
        );
        $('.prew-img  img[data-id="' + id + '"]').data("src", pret);
      }
    }
  });
});
$(document).on("click", ".searchButton", function (e) {
  e.preventDefault();
  var val = $(".field-search").val();
  if (val != "") {
    document.location = "/search?search=" + val;
  }
});

$(document).on("click", ".slir li", function (e) {
  var targ = $(this).data("href");
  $(".slir li").removeClass("active");
  $(this).addClass("active");
  $(".iv-target").each(function (e) {
    if ($(this).data("href") == targ) {
      $(this).addClass("active");
    } else {
      $(this).removeClass("active");
    }
  });
});
$(".btn.btn-success.img-elem-accr").remove();
// $(document).on('click', '.bullet.to_slide', function(e){
//   var id = $(this).data('bullet-item');
//   home_top_slider.swipeTo(id);//activeIndexChange
// })
$(document).on("click", ".img-wol", function (e) {
  if ($(this).hasClass("op-in-modal")) {
    var src = $(this).attr("src");
    var img = '<img src="' + src + '">';
    $("#video_pop").html(img);
    $("#em_video").modal("show");
  } else {
    var link = $(this).data("link");
    if (!!link && link != "") {
      if ($(this).hasClass("op-new")) {
        window.open(link, "_blank");
      } else {
        document.location = link;
      }
    }
  }
});
$(document).ready(function (e) {
  $(document).scroll(function () {
    if ($(this).scrollTop() > 100) {
      if (!$(".back_to_top").hasClass("show")) {
        $(".back_to_top").addClass("show");
      }
    } else {
      $(".back_to_top").removeClass("show");
    }
  });
  $(".back_to_top").on("click", function () {
    $("html, body").stop().animate({ scrollTop: 0 }, 300);
  });
});

$(document).on("click", ".inBottom", function (e) {
  var link = $(this).data("link");
  if ($(this).hasClass("new-open")) {
    window.open(link, "_blank");
  } else {
    document.location = link;
  }
});
$(document).ready(function (e) {
  $(".menu-link.main-menu-link").each(function (e) {
    if ($(this).attr("href") == document.location.pathname) {
      var color = $(this).data("color");
      $(this).css("background-color", color);
    }
  });
});
$(".variableSort li").hover(
  function () {
    var color = $(this).data("color");
    $(this).css("background", color);
  },
  function () {
    $(this).css("background", "transparent");
  }
);
$(".sortRazdelBlock").on("click", function (e) {
  if ($(".variableSort").hasClass("active")) {
    $(".variableSort").removeClass("active");
    $(".variableSort").css("display", "none");
  } else {
    $(".variableSort").addClass("active");
    $(".variableSort").css("display", "block");
  }
});

$("#selectRazdel").on("click", function (e) {
  if ($(".selectVarRazdel").hasClass("active")) {
    $(".selectVarRazdel").removeClass("active");
    $(".selectVarRazdel").css("display", "none");
  } else {
    $(".selectVarRazdel").addClass("active");
    $(".selectVarRazdel").css("display", "block");
  }
});

$(".selectVarRazdel li").hover(
  function () {
    var color = $(this).data("color");
    $(this).css("background", color);
  },
  function () {
    $(this).css("background", "transparent");
  }
);

$(".variableSort li").click(function (e) {
  var val = $(this).data("val");
  //console.log(val);
  document.location = "?sort=" + val;
});

$(".search_icon").on("click", function (e) {
  e.preventDefault();
  if (!$(this).hasClass("opner")) {
    $(this).addClass("opner");
    var phone = $("#top_header .item_phone").outerWidth(true);
    var social = 0;

    $("#top_header .item.social").each(function(e){
      social = social+$(this).outerWidth(true);
    })

    var item = 0;
    $("#top_header .item.net-promt").each(function(e){
      item = item+$(this).outerWidth(true);
    })

    var itemv = 0;
    $("#top_header .item.promt").each(function(e){
      itemv = itemv+$(this).outerWidth(true);
    })
    
    if($("#top_header .item.comcol").length){
      var comol = $("#top_header .item.comcol").outerWidth(true);
    }else{
      var comol = 0;
    }
    
    var search = $("#top_header .item.search").outerWidth(true);
    var ourWidth = phone+social +item+itemv+comol+search;

    $(".search_form_header").css("display", "block");
    $(".search_form_header").css("width", ourWidth + "px");
    console.log(comol, search, social, item, itemv, ourWidth);
  }
});
$(".ui-resizable-handle").remove();
$(document).ready(function (e) {
  if ($(window).width() < 1020) {
    if ($(".card__wrapper").length) {
      $(".card__wrapper").each(function (e) {
        if ($(this).find(".card-image") && $(this).find(".card-descr")) {
          //console.log("123");
          // $(this)
          //   .children(".card-descr")
          //   .css("height", $(this).children(".card-image").height() + "px");
        } else {
          //console.log("222");
        }
      });
    }
  }
});

$(document).on("click", ".openWidget", function (e) {
  e.preventDefault();
  if ($(this).hasClass("active")) {
    $(this).removeClass("active");
    $(".bb-arw-card.gert").removeClass("active");
    $("html").css("overflow", "");
  } else {
    $(this).addClass("active");
    $(".bb-arw-card.gert").addClass("active");
    if ($(window).width() < 1020) {
      $("html").css("overflow", "hidden");
    }
  }
});

$(".clic-clo").on("click", function (e) {
  $("html").css("overflow", "");
  $(".openWidget").removeClass("active");
  $(".bb-arw-card.gert").removeClass("active");
});
$(document).ready(function (e) {
  $(".bb-arw-card__form").css("display", "none");
  $(".bb-arw-tabs__tab").each(function (prop, elem) {
    if (prop == "0") {
      $(this).addClass("bb-arw-tabs__tab_selected");
      var id = $(this).data("id");
      $("#" + id).css("display", "block");
    }
  });

  $(".bb-arw-tabs__tab").on("click", function (e) {
    if (!$(this).hasClass("bb-arw-tabs__tab_selected")) {
      $(".bb-arw-tabs__tab").removeClass("bb-arw-tabs__tab_selected");
      $(this).addClass("bb-arw-tabs__tab_selected");
      $(".bb-arw-card__form").css("display", "none");
      var id = $(this).data("id");
      $("#" + id).css("display", "block");
    }
  });
  // $('.bb-arw-input__control[name="phone"]').mask("+99999999999");
});

$(".bb-arw-button.bb-arw-card__button").on("click", function (e) {
  e.preventDefault();
  $("html").css("overflow", "");
  $(".bb-arw-input__control").removeClass("invalid");
  $(".bb-arw-select.bb-arw-card__field").removeClass("invalid");
  var step = true;
  if (
    $("input[name='choise-city']").length &&
    $("input[name='choise-city']").val() == "" &&
    $("input[name='choise-city']").hasClass("sholm")
  ) {
    $(".bb-arw-select.bb-arw-card__field").addClass("invalid");
    step = false;
  }
  var id = $(this).closest(".bb-arw-card__form").attr("id");

  if ($("#" + id + " .bb-arw-checkbox__control").prop("checked")) {
    $("#" + id + " input").each(function (e) {
      if ($(this).val() == "" && $(this).hasClass("recs")) {
        $(this).addClass("invalid");
        step = false;
      }
    });
    if (step) {
      var form = $("#" + id).serializeArray();
      //console.log(form);
      $.post("/apisend/index", { form: form }, Success);
      function Success(data) {
        //console.log(data);
      }

      $(".bb-arw-card").css("display", "none");
      $(".bb-arw-input__control").removeClass("invalid");
      // $(".bb-arw-input__control").val("");
      $(".bb-arw-card.bb-arw-card_final").removeAttr("style");
      $(".bb-arw-card_final").addClass("active");
      setTimeout(function (e) {
        $(".bb-arw-card").removeClass("active");
        $(".bb-arw-card.bb-arw-card_final").css("display", "none");
        $(".bb-arw-card_final").removeClass("active");
        $(".openWidget").removeClass("active");
        $(".bb-arw-card").removeAttr("style");
      }, 3000);

      // var i = 0;
      // $("#" + id + " input").each(function (e) {
      //     array[i] = new Object();
      //     array[i]['name'] = $(this).attr('name');
      //     array[i]['value'] = $(this).val();
      //     i++;
      // });
    }
  }
});

function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode(key);
  var regex = /[0-9]|\./;
  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

$(".btn-cls-svg").on("click", function (e) {
  $("html").css("overflow", "");
  if ($(".openWidget").hasClass("active")) {
    $(".openWidget").removeClass("active");
    $(".bb-arw-card.gert").removeClass("active");
  }
});
$('.bb-arw-input__control[name="email"]').on("change", function (e) {
  if ($(this).val().indexOf("@") < 0) {
    $(this).addClass("invalid");
  } else {
    $(this).removeClass("invalid");
  }
});

$(".bb-arw-input__control").on("change", function (e) {
  if ($(this).val() != "") {
    if (!$(this).hasClass("invalid")) {
      $(this).css("border-color", "#00A6CA");
    } else {
      $(this).removeClass("invalid");
      $(this).css("border-color", "#00A6CA");
      //$(this).css("border-color", "#C50815");
    }
  } else {
    $(this).addClass("invalid");
    $(this).css("border-color", "#C50815");
  }
});

$(document).ready(function (e) {
  $(".posts_view_2 .item_wrap .item .info .desc").text(function (i, text) {
    if (text.length > 104) {
      text = text.substring(0, 115);
      var lastIndex = text.lastIndexOf(" ");
      text = text.substring(0, lastIndex) + "...";
      $(this).text(text);
    }
  });

  $(".posts_view_2 .item_wrap .item .info .title").text(function (i, text) {
    if (text.length > 60) {
      text = text.substring(0, 60);
      var lastIndex = text.lastIndexOf(" ");
      text = text.substring(0, lastIndex) + "...";
      $(this).text(text);
    }
  });
  $(".item.item_city a").on("click", function (e) {
    e.preventDefault();
    $(".wrapper_modal_lang").css("display", "block");
  });
  $(".cl-bt").on("click", function (e) {
    $(".wrapper_modal_lang").css("display", "none");
  });

  $(".bb-arw-select__item").on("click", function (e) {
    var val = $(this).data("val");
    $("input[name='choise-city']").val(val);
    $(".bb-astr").html(val);
    $(".bb-arw-select__value").addClass("chois");
    $(".bb-arw-select.bb-arw-card__field").css("border-color", "#00A6CA");
  });

  $(".bb-arw-select.bb-arw-card__field").on("click", function (e) {
    if ($(this).hasClass("bb-arw-select_open")) {
      $(this).removeClass("bb-arw-select_open");
    } else {
      $(this).addClass("bb-arw-select_open");
    }
  });
});

$(document).on("click", function (e) {
  $(".slo-g ul li").on("click", function (e) {
    if (!$(this).hasClass("title")) {
      var city = $(this).data("name");
      $.post("/site/location-city", { city: city }, Success);
      function Success(data) {
        //console.log(data);
        document.location = document.location;
      }
    }
  });
});

$(document).ready(function (e) {
  $(".img_slide_item").on("click", function (e) {
    var link = $(this).data("link");
    if (link != "") {
      window.open(link, "_blank");
    }
  });

  if ($("#rigfd").length) {
    $("#rigfd").on("change", function (e) {
      document.location = "/" + $(this).val();
    });
  }
  // $('.change_lang').on('click', function(e){
  //   $('#rigfd').trigger('click');
  // })

  //console.log($('.item.item_phone').css('margin-right') );
});


function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  /* Create lens: */
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /* Insert lens: */
  img.parentElement.insertBefore(lens, img);
  /* Calculate the ratio between result DIV and lens: */
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /* Set background properties for the result DIV */
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = img.width * cx + "px " + img.height * cy + "px";
  /* Execute a function when someone moves the cursor over the image, or the lens: */
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /* And also for touch screens: */
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  function moveLens(e) {
    var pos, x, y;
    /* Prevent any other actions that may occur when moving over the image */
    e.preventDefault();
    /* Get the cursor's x and y positions: */
    pos = getCursorPos(e);
    /* Calculate the position of the lens: */
    x = pos.x - lens.offsetWidth / 2;
    y = pos.y - lens.offsetHeight / 2;
    /* Prevent the lens from being positioned outside the image: */
    if (x > img.width - lens.offsetWidth) {
      x = img.width - lens.offsetWidth;
    }
    if (x < 0) {
      x = 0;
    }
    if (y > img.height - lens.offsetHeight) {
      y = img.height - lens.offsetHeight;
    }
    if (y < 0) {
      y = 0;
    }
    /* Set the position of the lens: */
    result.style.left = x + "px";
    result.style.top = y + "px";
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /* Display what the lens "sees": */
    result.style.backgroundPosition = "-" + x * cx + "px -" + y * cy + "px";
  }
  function getCursorPos(e) {
    var a,
      x = 0,
      y = 0;
    e = e || window.event;
    /* Get the x and y positions of the image: */
    a = img.getBoundingClientRect();
    /* Calculate the cursor's x and y coordinates, relative to the image: */
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /* Consider any page scrolling: */
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return { x: x, y: y };
  }
}

$(document).on("click", ".class-loop", function (e) {
  if($(this).hasClass('active-loop')){
    $('#plazer-zoom').attr('style', '');
    $('.img-zoom-lens').remove();
    $(this).removeClass('active-loop');
  }else{
    imageZoom("prewImage-s", "plazer-zoom");
    $(this).addClass('active-loop');
  }
});

$(document).ready(function(e){
  if($('.bt-sg').length){
    $('.bt-sg').each(function(e){
      var mac = $(this).width();
      if($(this).find('.param-colum').length){
        var btSg = 0;

        $(this).find('.param-colum').each(function(e){
          var width = $(this).width();
          btSg = btSg + width;
        });
        console.log(btSg);

        $(this).find('.param-colum').each(function(e){
          var width = $(this).width();
          var start = (width / (btSg / 100)) * (mac / 100);
          //console.log(procent);
          $(this).css('width', start+'px');
        });
        
      }
    });
  }
});


