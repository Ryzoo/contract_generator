import Elements from "./elements/Elements.js";

const tippy = require('./../../compiler/node_modules/tippy.js');

class LayoutBuilder {
  constructor() {
    let self = this;

    this.allTags = [];
    this.fullData = [];
    this.addButtonTemplate = '<div title="Add new item" class="add-new-short"> + </div>';

    jQuery(document).off('click', '.add-new-short');
    jQuery(document).on('click', '.add-new-short', function () {
      self.Modals.open('select', this);
    });

    jQuery.ajax({
      url: '/ajax/pstrona_shortcodes/shortcodes_list',
      success: (data) => {
        this.fullData = Object.values(JSON.parse(data));

        if (this.fullData) {
          for (let i = 0; i < this.fullData.length; i++) {
            this.allTags = this.allTags.concat(this.fullData[i].elements);
          }
        }
      },
      async: false
    });
  }

  init(ShortcodeParser, Modals) {
    this.ShortcodeParser = ShortcodeParser;
    this.Modals = Modals;
    this.Modals.init(this, Elements, ShortcodeParser);
    Elements.init(this, Modals, ShortcodeParser);
  }

  enableView(element) {
    this.textElement = $(element).first();
    this.textElement.hide();
    this.shView = $('.shortcode-view');

    if (this.shView.length <= 0) {
      $('.form-textarea-wrapper:last-child').append('<div class="shortcode-view body"></div>');
      this.shView = $('.shortcode-view');
    }
    else {
      this.shView.show();
    }

    if (this.shView.parent().find(".addPlace").length <= 0) {
      this.shView.parent().append(`<div class="addPlace">${this.addButtonTemplate}</div>`);
    }

    let textEl = this.textElement.text();


    if (this.textElement.val()) {
      textEl = this.textElement.val();
    }


    let structure = this.ShortcodeParser.parseTextToShortcodeStructure(textEl);

    let html = this.parseObjectStructureToHtml(structure);
    this.shView.html(html);

    Elements.showAll();

    this.initSortable();
    this.ShortcodeParser.checkForAllAdditionalClass();
  }

  parseObjectStructureToHtml(structure) {
    let html = '';
    $.each(structure, (index, value) => {
      let content = this.parseObjectStructureToHtml(value.content);
      let settings = this.getShortcodeSettingsFromaAttr(value);
      html += Elements.baseElementTemplate(this.getShortcodeTitle(value.token), value.token, settings, content);
    });
    return html;
  }

  getShortcodeSettingsFromaAttr(value) {
    let settings = [];

    for (let i = 0; i < this.allTags.length; i++) {
      if (this.allTags[i].token === value.token) {
        settings = $.extend(true, [], this.allTags[i].settings);
        break;
      }
    }

    if (value.param && value.param.length > 0) {
      let regexForVariable = /([A-z]+)="([^"]+)"/g;
      let returnedArray = null;
      do {
        returnedArray = regexForVariable.exec(value.param);
        if (returnedArray) {
          switch (returnedArray[1]) {
            case 'id':
              settings[2].elements[1].value = returnedArray[2];
              break;
            case 'class':
              settings[2].elements[0].value = returnedArray[2];
              break;
            case 'style':
              settings[1].elements[0].value = this.getVariableFromStyle(returnedArray[2], "padding-left");
              settings[1].elements[1].value = this.getVariableFromStyle(returnedArray[2], "padding-right");
              settings[1].elements[2].value = this.getVariableFromStyle(returnedArray[2], "padding-top");
              settings[1].elements[3].value = this.getVariableFromStyle(returnedArray[2], "padding-bottom");
              settings[1].elements[4].value = this.getVariableFromStyle(returnedArray[2], "margin-left");
              settings[1].elements[5].value = this.getVariableFromStyle(returnedArray[2], "margin-right");
              settings[1].elements[6].value = this.getVariableFromStyle(returnedArray[2], "margin-top");
              settings[1].elements[7].value = this.getVariableFromStyle(returnedArray[2], "margin-bottom");
              break;
            default:
              for (let i = 0; i < settings[3].elements.length; i++) {
                if (settings[3].elements[i].atr_name && settings[3].elements[i].atr_name === returnedArray[1]) {
                  let content = returnedArray[2].replace(/'/g, "\"");
                  settings[3].elements[i].value = content;
                  break;
                }
              }

              for (let i = 0; i < settings[0].elements.length; i++) {
                if (settings[0].elements[i].atr_name && settings[0].elements[i].atr_name === returnedArray[1]) {
                  let content = returnedArray[2].replace(/'/g, "\"");
                  settings[0].elements[i].value = content;
                  break;
                }
              }
              for (let i = 0; i < settings[4].elements.length; i++) {
                if (settings[4].elements[i].atr_name && settings[4].elements[i].atr_name === returnedArray[1]) {
                  let content = returnedArray[2].replace(/'/g, "\"");
                  settings[4].elements[i].value = content;
                  break;
                }
              }
              for (let i = 0; i < settings[2].elements.length; i++) {
                if (settings[2].elements[i].atr_name && settings[2].elements[i].atr_name === returnedArray[1]) {
                  let content = returnedArray[2].replace(/'/g, "\"");
                  settings[2].elements[i].value = content;
                  break;
                }
              }
          }
        }
      } while (returnedArray);
    }
    return settings;
  }

  getVariableFromStyle(style, variableName) {
    let pattern = new RegExp(variableName + ': ?([0-9A-z]+);', 'g');
    let returnedArray = pattern.exec(style);
    if (returnedArray && returnedArray[1]) {
      returnedArray[1] = returnedArray[1].replace(/px/g, '');
      return returnedArray[1];
    }
    return '';
  }

  getShortcodeTitle(shortcode) {
    let title = [];
    for (let i = 0; i < this.allTags.length; i++) {
      if (this.allTags[i].token === shortcode) {
        title = this.allTags[i].title;
        break;
      }
    }
    return title;
  }

  initializeTip() {
    tippy('.poz-admin-body [title]', {
      delay: 50,
      arrow: true,
      placement: 'bottom',
      size: 'small',
      duration: 200
    });

    tippy('.shortcode-modal [title], .shortcode-modal-config [title]', {
      delay: 50,
      arrow: true,
      placement: 'top',
      size: 'small',
      duration: 200
    });
  }

  disableView() {
    if (this.shView.parent().find(".addPlace").length > 0) {
      this.shView.parent().find(".addPlace").remove();
    }
    this.shView.hide();
    let html = this.ShortcodeParser.parseShortocdeToText(this.shView);
    this.textElement.show();
    this.textElement.text(html);
    this.textElement.val(html);
  }

  initSortable() {
    $(".shortcode-view .body, .shortcode-view").sortable({
      connectWith: '.shortcode-view .body,.shortcode-view',
      cursor: "move",
      delay: 100,
      helper: "clone",
      placeholder: "sortable-placeholder",
      opacity: 0.5,
      tolerance: "pointer"
    });
    this.initializeTip();
  }
}

export default new LayoutBuilder();
