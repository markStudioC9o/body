$(document).ready(function () {
  $("#pages-title").change(function (e) {
    var val = $(this).val();
    var trans = translit(val.trim());
    //$("#linkTranslite").val(trans);
  });

  function translit(word) {
    var answer = "";
    var converter = {
      а: "a",
      б: "b",
      в: "v",
      г: "g",
      д: "d",
      е: "e",
      ё: "e",
      ж: "zh",
      з: "z",
      и: "i",
      й: "y",
      к: "k",
      л: "l",
      м: "m",
      н: "n",
      о: "o",
      п: "p",
      р: "r",
      с: "s",
      т: "t",
      у: "u",
      ф: "f",
      х: "h",
      ц: "c",
      ч: "ch",
      ш: "sh",
      щ: "sch",
      ь: "",
      ы: "y",
      ъ: "",
      э: "e",
      ю: "yu",
      я: "ya",

      А: "a",
      Б: "b",
      В: "v",
      Г: "g",
      Д: "d",
      Е: "e",
      Ё: "e",
      Ж: "zh",
      З: "z",
      И: "i",
      Й: "y",
      К: "k",
      Л: "l",
      М: "m",
      Н: "n",
      О: "o",
      П: "p",
      Р: "r",
      С: "s",
      Т: "t",
      У: "u",
      Ф: "f",
      Х: "h",
      Ц: "c",
      Ч: "ch",
      Ш: "sh",
      Щ: "sch",
      Ь: "",
      Ы: "y",
      Ъ: "",
      Э: "e",
      Ю: "yu",
      Я: "ya",
      " ": "-",
      "  ": "-",
      _: "-",
      "!": "",
      "?": "",
    };

    for (var i = 0; i < word.length; ++i) {
      if (converter[word[i]] == undefined) {
        answer += word[i];
      } else {
        answer += converter[word[i]];
      }
    }

    return answer;
  }
});

$(document).on("change", '[name="type[Page]"]', function (e) {
  var val = $(this).val();
  $.post("/admin/pages/select-articles", { val: val }, Success);
});
function Success(data) {
  $(".areaArticles").html(data);
  // $('.selecter23').select2();
}
$(document).ready(function (e) {
  if ($('[name="type[Page]"]').length) {
    if ($('[name="type[Page]"]').val() != "") {
      var val = $('[name="type[Page]"]').val();
      if($('.catId-ls').length){
        if($('.catId-ls').val() != ""){
          id = $('.catId-ls').val();
        }else{
          id = '';
        }
      }
      $.post("/admin/pages/select-articles", { val: val, id: id }, Success);
      function Success(data) {
        $(".areaArticles").html(data);
      }
    }
  }
});
