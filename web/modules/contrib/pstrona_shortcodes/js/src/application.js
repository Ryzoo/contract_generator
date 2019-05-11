window.$ = window.jQuery = jQuery;
import ShortcodeParser from "./class/ShortcodeParser.js";
import LayoutBuilder from "./class/LayoutBuilder.js";
import Modals from "./class/modals/Modal.js";

(function (Drupal, $) {
  LayoutBuilder.init(ShortcodeParser, Modals);

  let myeditor = {
    attach: function attach(element, format) {
      LayoutBuilder.enableView(element);
    },
    detach: function detach(element, format, trigger) {
      LayoutBuilder.disableView();
      if((format.format === "shortcode" || format.editor === 'ps_shortcode_editor') && trigger && trigger === 'serialize'){
        setTimeout(function(){
          LayoutBuilder.enableView(element);
        },200);
      }
    },
    onChange: function onChange(element, callback) {
      callback();
    }
  };

  Drupal.editors.ps_shortcode_editor = myeditor;
})(Drupal, jQuery);
