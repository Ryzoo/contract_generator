class Elements {
  constructor() {
    this.id = 0;
    let self = this;

    jQuery(document).off('click', '.ps-shortcode-icon-edit');
    jQuery(document).on('click', '.ps-shortcode-icon-edit', function() {
      let element = jQuery(this).parent().parent().parent();
      let currentId = element.attr('id');
      self.Modals.open("config", currentId);
    });

    jQuery(document).off('click', '.ps-shortcode-icon-copy');
    jQuery(document).on('click', '.ps-shortcode-icon-copy', function() {
      $('.html_editor_quill').summernote('disable');
      let element = jQuery(this).parent().parent().parent();
      let newElement = element.clone();
      newElement.insertAfter(element);
      self.LayoutBuilder.initSortable();

      newElement.attr('data-settings', JSON.stringify(element.data('settings')));
      newElement.attr('id', self.getNewId());

      element.find('.drag').each(function(){
        let lastId = "#" + $(this).attr('id');
        let elIn = newElement.find(lastId);

        if(elIn && elIn.length > 0){
          elIn.attr('data-settings', JSON.stringify($(this).data('settings')));
          elIn.attr('id', self.getNewId());
        }
      });

      newElement.addClass('ps-drag-show');
      newElement.attr('style','display:none');
      self.showAll();
    });

    jQuery(document).off('click', '.ps-shortcode-icon-remove');
    jQuery(document).on('click', '.ps-shortcode-icon-remove', function() {
      let element = jQuery(this).parent().parent().parent();
      element.addClass('ps-drag-hide');
      self.hideAll();
      setTimeout(()=>{
        element.remove();
      },300)
    });
  }

  getNewId(){
    let currentId = "shortcode-visual-element-" + this.id;
    this.id++;
    return currentId;
  }

  init(LayoutBuilder, Modals, ShortcodeParser) {
    this.LayoutBuilder = LayoutBuilder;
    this.Modals = Modals;
    this.ShortcodeParser = ShortcodeParser;
  }

  add(tagElement, lastClickedAddButtonElement) {
    let code = this.baseElementTemplate(tagElement.title, tagElement.token, tagElement.settings);
    let body = $(lastClickedAddButtonElement).parent().parent().find('.body').first();
    if(body && body.length > 0){
        body.append(code);
    }else{
        $(lastClickedAddButtonElement).parent().prepend(code);
    }
    this.showAll();
    this.ShortcodeParser.checkForAdditionalClass(tagElement.token, tagElement.settings, "#shortcode-visual-element-" + (this.id - 1));
    this.Modals.open('config', "shortcode-visual-element-" + (this.id - 1));
    this.LayoutBuilder.initSortable();
  }

  baseElementTemplate(name, shortcode = '', settings = [], bodyContent = '') {
    let currentId = "shortcode-visual-element-" + this.id;
    let addButton = this.LayoutBuilder.addButtonTemplate;
    this.id++;
    let addPlace = `<div class="addPlace">${addButton}</div>`;
    let body = `<div class="body">${bodyContent}</div>`;

    for(let i=0;i < settings[0].elements.length; i++){
        if(settings[0].elements[i].type === "solo" && settings[0].elements[i].value === "true"){
            addPlace = '';
            body = '';
            break;
        }
    }
    let data = JSON.stringify(settings);

    return `
          <div class="drag ps-drag-show" style="display:none" id="${currentId}" data-shortcode="${shortcode}" data-settings='${data}'>
              <div class="head">
                  <div class="nav-icon"><span></span><span></span><span></span></div>
                  <h3>${name}</h3>
                  <div class='element-options'>
                    <span title='Edit' data-tippy-placement="top" class="ps-shortcode-icon-edit"></span>
                    <span title='Copy' data-tippy-placement="top" class="ps-shortcode-icon-copy"></span>
                    <span title='Remove' data-tippy-placement="top" class="ps-shortcode-icon-remove"></span>
                  </div>
              </div>
              ${body}
              ${addPlace}
          </div>
      `;
  };

  showAll(){
    $('.ps-drag-show').each(function(){
      $(this).fadeIn(300);
      $(this).removeClass('ps-drag-show');
    });
  }

  hideAll(){
    $('.ps-drag-hide').each(function(){
      $(this).fadeOut(300);
    });
  }


}

export default new Elements();
