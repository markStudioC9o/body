$(document).ready(function(e){
  $('.labelRadio').on('click', function(e){
    if(!$(this).hasClass('chek')){
      $(this).closest('.wilder').children('.labelRadio').removeClass('chek');
      // $('.labelRadio').removeClass('chek');
      $(this).addClass('chek');
    }
  })
  $('.labelChekbox').on('click', function(e){
    if($(this).hasClass('chek')){
      $(this).removeClass('chek');
    }else{
      $(this).addClass('chek');
    }
  })
  $('#newhomebb .send-form-page').on('click', function(e){
    e.preventDefault();
    var array = new Object();
    var i = 0;
    $('.for-block').each(function(e){
      $(this).children('.wilder').children('label').each(function(e){
        if($(this).hasClass('chek')){
          array[i] = $(this).children('input').val();
          i++;
        }
      })
    })
    console.log(array);
    })

    $("label[for='input-param-gen']").each(function(e){
      $(this).html(function(index, text) {
        return text.replace("*", "<span>*</span>")
        });
    });
    $('.wilder input[type="text"]').change(function(e){
      if($(this).val() != ''){
        $(this).addClass('chek');
      }else{
        $(this).removeClass('chek');
      }
    })
    
});