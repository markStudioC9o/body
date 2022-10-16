<section>
  <div class="demo-wrap">
    <div class="container">
      <div class="grid">
        <div class="col-1-2">
          <strong>Кадрирование</strong>
          <p>Размер кадра соответствует размеру спрайта</p>
          <br>
          <div class="actions">
            <button class="resizer-result btn btn-info">Заменить</button>
          </div>
        </div>
        <div class="col-1-2">
          <div id="resizer-demo"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<div id="html-result">

</div>
<script>
var Demo = (function() {
  function output(node) {
    var existing = $('#result .croppie-result');
    if (existing.length > 0) {
      existing[0].parentNode.replaceChild(node, existing[0]);
    } else {
      $('#result')[0].appendChild(node);
    }
  }

  function blobToBase64(blob) {
  return new Promise((resolve, _) => {
    const reader = new FileReader();
    reader.onloadend = () => resolve(reader.result);
    reader.readAsDataURL(blob);
  });
}
  function popupResult(result) {
    var html;
    if (result.html) {
      html = result.html;
    }
    if (result.src) {
      result.src.then(function(value){
        $('.img-wrap-in-col[data-src="<?= $data['src']?>"]').css("background-image", "url("+value+")");
       });
      
    }
  }
  var wd = <?= $data['width']?>+50;
  var hg = <?= $data['height']?>+50;
  function demoResizer() {
    var vEl = document.getElementById('resizer-demo'),
      resize = new Croppie(vEl, {
        viewport: {
          width: "<?= $data['width']?>",
          height: "<?= $data['height']?>"
        },
        boundary: {
          width: wd,
          height: hg
        },
        showZoomer: true,
        enableResize: false,
        enableOrientation: true,
        mouseWheelZoom: 'ctrl'
      });
    resize.bind({
      url: "/gallery/<?= $data['src']?>",
      points: [0,10],
      zoom: 0,
    }).then(function(){
				  	$('.cr-slider').attr({'min':0.2000, 'max':1.5000});
			});
    vEl.addEventListener('update', function(ev) {
      console.log('resize update', ev);
    });
    document.querySelector('.resizer-result').addEventListener('click', function(ev) {
      resize.result({
        type: 'blob'
      }).then(function(blob) {
        
        popupResult({
          src: blobToBase64(blob)
        });
      });
    });
  }
  function init() {
    demoResizer();
  }
  return {
    init: init
  };
})();
  (function() {
    var method;
    var noop = function() {};
    var methods = [
      'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
      'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
      'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
      'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
      method = methods[length];

      // Only stub undefined methods.
      if (!console[method]) {
        console[method] = noop;
      }
    }


    if (Function.prototype.bind) {
      window.log = Function.prototype.bind.call(console.log, console);
    } else {
      window.log = function() {
        Function.prototype.apply.call(console.log, console, arguments);
      };
    }
  })();
            Demo.init();
</script>