$(document).ready(function (e) {
  $(".add_input").on("click", function (e) {
    $.post("/admin/form-bild/new-field", Success);
    function Success(data) {
      $("#polForm").append(data);
    }
  });

  $(document).on("click", ".poor-block-input", function (e) {
    $('.poor-block-input').removeClass('active');
    $(this).addClass('active');
    if (!!!$(this).attr("id")) {
      var randId = randomInteger(1, 99)+"inp_id"+randomInteger(1, 99)+randomInteger(1, 99);
      $(this).attr("data-id", randId);
      $(this).attr("id", randId);
      getParam(randId);
    } else {
      getParam($(this).data('id'));
    }
  });

  $(document).on('click', '#saveParam', function(e){
    e.preventDefault();
    var arry = $('#id-param').serializeArray();
    var id = $('#id_ins').val();
    var name = translit($('#name_input').val().trim());
    var sub = '';
    sub = $('#sub_input').val();
    $.post('/admin/form-bild/succ-input',{arry: arry, name: name, sub: sub}, Success);
    function Success(data){
      console.log(data);
      $('#'+id).html(data);
      
    }
  })

  $(document).on('change', '#type_input', function(e){
    if($(this).val() == 'select' || $(this).val() == 'radio' || $(this).val() == 'checkbox'){
      $('.obred').css('display', 'block');
      $('.offlow').css('display', 'none');
      var id = 0;
      $.post('/admin/form-bild/list-param', {id: id}, Success);
      function Success(data){
        $('.list_param').html(data);
      }
    }
    if($(this).val() == 'text'){
      $('.offlow').css('display', 'block');
      $('.obred').css('display', 'none');
    }
  })

  

  function getParam(randId){
    $.post("/admin/form-bild/param", {id: randId }, Success);
      function Success(data) {
        $('.param_field').html(data);
      }
  }

  function randomInteger(min, max) {
    let rand = min + Math.random() * (max - min);
    return Math.round(rand);
  }
});

$(document).on('click', '.plus_param', function(e){
  var step = 0;
  $.each($('.on-step-param'),function(e){
    step++;
  });
  
  $.post('/admin/form-bild/list-param', {id: step}, Success);
    function Success(data){
      $('.list_param').prepend(data);
    }
});



// $('#pages-title').change(function(e){
//   var val = $(this).val();
//   var trans  = translit(val.trim());
//   $('#linkTranslite').val(trans);
// });

function translit(word){
var answer = '';
var converter = {
'??': 'a',    '??': 'b',    '??': 'v',    '??': 'g',    '??': 'd',
'??': 'e',    '??': 'e',    '??': 'zh',   '??': 'z',    '??': 'i',
'??': 'y',    '??': 'k',    '??': 'l',    '??': 'm',    '??': 'n',
'??': 'o',    '??': 'p',    '??': 'r',    '??': 's',    '??': 't',
'??': 'u',    '??': 'f',    '??': 'h',    '??': 'c',    '??': 'ch',
'??': 'sh',   '??': 'sch',  '??': '',     '??': 'y',    '??': '',
'??': 'e',    '??': 'yu',   '??': 'ya',

'??': 'a',    '??': 'b',    '??': 'v',    '??': 'g',    '??': 'd',
'??': 'e',    '??': 'e',    '??': 'zh',   '??': 'z',    '??': 'i',
'??': 'y',    '??': 'k',    '??': 'l',    '??': 'm',    '??': 'n',
'??': 'o',    '??': 'p',    '??': 'r',    '??': 's',    '??': 't',
'??': 'u',    '??': 'f',    '??': 'h',    '??': 'c',    '??': 'ch',
'??': 'sh',   '??': 'sch',  '??': '',     '??': 'y',    '??': '',
'??': 'e',    '??': 'yu',   '??': 'ya', ' ':'-', '  ':'-', '_':'-', '!':'','?':''
};

for (var i = 0; i < word.length; ++i ) {
if (converter[word[i]] == undefined){
 answer += word[i];
} else {
 answer += converter[word[i]];
}
}

return answer;
}
$(document).on('click', '.saveForm', function(e){
  e.preventDefault();
  var name = $('.nameForm').val();
  var val = $('#polForm').html();
  if(name == ''){
    $('.nameForm').css('border', '1px solid red');
    return false;
  }
  if(val.trim().length == 0){
    return false;
  }
  $.post('/admin/form-bild/save', {val: val, name: name}, Success);
  function Success(data){
    if(data){
      document.location= document.location;
    }
  }
  });