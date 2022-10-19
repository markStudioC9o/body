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
    ignoreClass: "addTab",
  };
  
  $("#treeSortSoc").sortableLists(options2);
  
  $('.addTab').on('click', function(e){
    e.preventDefault();
    // var LiTab = "<li class=\"tabLi\">пропуск</li>";
    // $('#treeSortSoc').append(LiTab);
    $(this).closest("li").addClass('prytir');
  })
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

  $("#saveSort").on("click", function () {
    var data = $("#treeSortSoc").sortableListsToArray();
    console.log(data);
  });
});