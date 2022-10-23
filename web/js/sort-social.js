$(function () {
  var options2 = {
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
    ignoreClass: "arrbuf",
  };
  
  $("#treeSortSoc").sortableLists(options2);
  
  $('.addTab').on('click', function(e){
    e.preventDefault();
    $(this).closest("li").addClass('prytir');
    $(this).closest("li").attr('data-value', 'promt');
    
  });

  $('.removeTab').on('click', function(e){
    e.preventDefault();
    $(this).closest("li").removeClass('prytir');
    $(this).closest("li").removeAttr('data-value');
    
  });
  // $("#toArrBtn").on("click", function () {
  //   var data = $("#sTree2").sortableListsToHierarchy();
  //   //console.log(data);
  //   $.post("/admin/menu/save-menu", { data: data }, Success);
  //   function Success(data) {
  //     if (data) {
  //       document.location = document.location;
  //     }
  //   }
  // });

  $("#saveSort").on("click", function (e){
    e.preventDefault();
    var result = $("#treeSortSoc").sortableListsToArray();
    var id = $(this).data('id');
      $.post('/admin/location/sort-save', {result: result, id: id}, Success);
      function Success(data){
        if(data == '111'){
          // window.location = window.location;
          // document.location = document.location;
          location.href=location.href;
          location.reload(); // window.location.reload()
        }else{
          console.log(data);
        }
      }
  });
});