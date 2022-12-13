(function ($) {
  $.Redactor.prototype.liher = function () {
    return {
      init: function () {
        var fonts = [10, 11, 12, 14, 16, 18, 20, 24, 28, 30];
        var that = this;
        var dropdown = {};

        $.each(fonts, function (i, s) {
          dropdown["s" + i] = {
            title: s + "px",
            func: function () {
              that.liher.set(s);
            },
          };
        });

        dropdown.remove = {
          title: "Remove Line height",
          func: that.liher.reset,
          class: "line-height-param"
        };

        var button = this.button.add("line-height", "Change Line height");
        this.button.addDropdown(button, dropdown);
      },
      set: function (size) {
      },
    };
  };
})(jQuery);
