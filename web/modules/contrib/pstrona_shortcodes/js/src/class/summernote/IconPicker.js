class IconPicker {

  constructor() {
    let self = this;

    this.template = `
        <div class="shortcode-modal-icon">
            <div class="shortcode-back"></div>
            <div class="shortcode-container">
                <div class="head">Select icon</div>
                <div class="search-body">
                    <label >Search icon</label><input class="icon-search-input"/>
                </div>
                <div class="body icon-select-container-parent"></div>
                <div class="actions">
                    <button class="shortcode-modal-cancel-button-icon button">Cancel</button>
                </div>
            </div>
        </div>`;

    jQuery(document).off('click', '.shortcode-modal-cancel-button-icon');
    jQuery(document).on('click', '.shortcode-modal-cancel-button-icon', function () {
      self.hideModal();
    });

    jQuery(document).off('click', '.icon-select-container');
    jQuery(document).on('click', '.icon-select-container', function () {
      self.selectIcon(this);
    });

    jQuery(document).off('keyup', '.icon-search-input');
    jQuery(document).on('keyup', '.icon-search-input', function () {
      let text = $(this).val();
      jQuery(".icon-select-container i").each(function () {
          let className = $(this).attr('class').split(" ")[1];
          className = className.replace("fa-","");
          if(className.includes( text.trim() )){
            $(this).parent().stop().show();
          }else $(this).parent().stop().hide();
      });
    });

  }

  selectIcon(iconElement) {
    this.hideModal();
    this.addIcon($(iconElement).find("i").first().attr('class'));
  }

  addIcon(iconCLass) {
    if(this.context){
      this.context.invoke('editor.restoreRange');
      let node = $("<span></span>").attr("class", iconCLass);
      this.context.invoke('editor.insertNode', node[0]);
      $(node).before("&nbsp;");
      $(node).after("&nbsp;");
      this.context.invoke('codeview.activate');
      this.context.invoke('codeview.deactivate');
    }else{
      $(this.element).parent().find("div").first().html(`<i class='${iconCLass}'></i>`);
      $(this.element).parent().find("div").first().data("icon",iconCLass);
      $(this.element).parent().find("button").first().text("Change icon");
    }
  }

  show(ctx) {
    this.context = ctx;
    this.context.invoke('editor.saveRange');
    this.showModal();
  }

  showForElement(element){
    this.element = element;
    this.context = null;
    this.showModal();
  }

  showModal() {
    $('body').append(this.template);

    jQuery.ajax({
      url: '/ajax/pstrona_shortcodes/ajax_get_icon_list',
      type: 'GET',
      cache: false,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function (data) {
        if (data) {
          let html = '';
          for (let i = 0; i < data.length; i++) {
            let name = data[i];
            html += `<div class="icon-select-container"><i class="${name}"></i></div>`;
          }
          $(".shortcode-modal-icon .icon-select-container-parent").first().html(html);
        }
      }
    });
  }


  hideModal() {
    $(".shortcode-modal-icon").first().remove();
  }

}

export default new IconPicker();
