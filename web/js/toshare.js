function toShare(e) {
  window.open(e, "Share From BodyBalance", "width=600,height=600");
}

$(document).on('click', '.soc', function(e){
  if($(this).hasClass('vk')){
    toShare('http://vk.com/share.php?url='+document.location);
  }
  if($(this).hasClass('fb')){
    var title = $('title').text();
    toShare('http://www.facebook.com/share.php?u='+document.location+'&title='+title);
  }
  if($(this).hasClass('ok')){
    toShare('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='+document.location);
  }
  if($(this).hasClass('print')){
    window.print();
  }
});



    var send_to_mail = function(post_id) {
        let content = '<form action="#" class="send_to_mail_modal"><p class="title">Отправить статью на почту</p><p class="error_msg"></p><input type="hidden" name="post_id" value="'+post_id+'" /><span class="field"><input type="email" name="user_email" class="make_label" placeholder="Ваш E-mail" /></span><button class="send" type="submit">Отправить</button></form>';
        $('.breadcrumbs').after('<div id="load_audio_modal" class="modal banners_modal"><div class="bg"></div><div class="wrap"><span class="close"></span><div class="content">'+content+'</div></div></div>');
        create_label($('.make_label'));
        $('#load_audio_modal').show();
    }

    $(document).on('submit','#load_audio_modal .send_to_mail_modal',function(e){
        e.preventDefault();
        let form = $(this);
        form.find('.error_msg').html('').hide();
        var data = {
            'action': 'send_to_mail_modal',
            'post_id': form.find('input[name="post_id"]').val(),
            'user_email': form.find('input[name="user_email"]').val(),
        };
        $.ajax({
            url:ajaxurl,
            data:data,
            type:'POST',
            success:function(json){
                console.log(json);
                if( json['error'] ) {
                    form.find('.error_msg').html(json['error']).show();
                }
                if( json['success'] ) {
                    $('.modal').hide().remove();
                    let html = '';
                    html += '<div id="load_audio_modal" class="modal banners_modal"><div class="bg"></div><div class="wrap"><span class="close"></span><div class="content">';
                    html += '<p class="title">'+json['success']+'</p>';
                    html += '</div></div></div>';
                    $('footer').before(html);
                    $('#load_audio_modal').show();
                    setTimeout(function () {
                        $('.modal').hide().remove();
                        if(json['reload']) {
                            location.reload();
                        }
                    },3000);
                }
            }
        });
    });

    $(document).on('submit','#load_audio_modal .load_audio',function(e){
        e.preventDefault();
        let form = $(this);
        form.find('.error_msg').html('').hide();
        var data = {
            'action': 'send_audio_modal',
            'post_id': form.find('input[name="post_id"]').val(),
            'user_email': form.find('input[name="user_email"]').val(),
            'audio_field': form.find('input[name="audio-field"]').val(),
        };
        $.ajax({
            url:ajaxurl,
            data:data,
            type:'POST',
            success:function(json){
                console.log(json);
                if( json['error'] ) {
                    form.find('.error_msg').html(json['error']).show();
                }
                if( json['success'] ) {
                    $('.modal').hide().remove();
                    let html = '';
                    html += '<div id="load_audio_modal" class="modal banners_modal"><div class="bg"></div><div class="wrap"><span class="close"></span><div class="content">';
                    html += '<p class="title">'+json['success']+'</p>';
                    html += '</div></div></div>';
                    $('footer').before(html);
                    $('#load_audio_modal').show();
                    setTimeout(function () {
                        $('.modal').hide().remove();
                        if(json['reload']) {
                            location.reload();
                        }
                    },3000);
                }
            }
        });
    });
