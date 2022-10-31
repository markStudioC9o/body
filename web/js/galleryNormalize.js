var width =  document.documentElement.clientWidth;
if(1023 > width){
  if($('body').find('.asp-gall').length){
    $('.asp-gall').each(function(){
      $(this).css('width', '100%');
      var wd = 0;
      $(this).find('.block-gall-default').each(function(prop, index){
        var size = $(this).width();
        wd = wd + size;
      })

      $(this).find('.block-gall-default').each(function(prop, index){
        var size = $(this).width();
        var wok = size / (wd / 100);
        // console.log(wok);
        $(this).css('width', wok+'%');
      })

      // console.log(wd);
    })
  }
}