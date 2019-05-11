class Select {
  constructor() {
    this.shortcodeModalTemplate = `
    <div class="shortcode-modal">
        <div class="shortcode-back"></div>
        <div class="shortcode-container">
            <div class="head"> Select one element from list below</div>
            <div class="search-body">
                  <p>Shortcode list is auto generated. They know which elements can be placed in wich place. You will see below only elements thats can be placed in current container.</p>
                  <input class="shortcode-search-input" autofocus>
                  <small>Enter character to text input before, to filter shortcodes below.</small>
            </div>
            <div class="body"></div>
            <div class="actions">
                <button class="shortcode-modal-cancel-button button">Cancel</button>
            </div>
        </div>
    </div>`;

    let self = this;
    jQuery(document).off('click', '.ps_shortcode_element');
    jQuery(document).on('click', '.ps_shortcode_element', function () {
      self.createShortcodeView(this);
    });

    jQuery(document).off('keyup', '.shortcode-search-input');
    jQuery(document).on('keyup', '.shortcode-search-input', function () {
      let text = $(this).val().toLowerCase();
      jQuery(".ps_shortcode_element").each(function () {
        let className = $(this).text().toLowerCase();
        if(className.includes( text.trim() )){
          $(this).stop().show();
        }else $(this).stop().hide();
      });
    });
  }

  getSelectList(parentName) {
    $.ajax({
      url: '/ajax/pstrona_shortcodes/shortcodes_filtered_list',
      data: {
        'parent': parentName
      },
      type: 'POST',
      cache: false,
      dataType: 'json',
      headers: {
        'Content-Type': undefined,
      },
      success: (data) => {
        this.fullData = Object.values(data);
      },
      async: false
    });
  }

  init(LayoutBuilder, Elements, Modals, ShortcodeParser) {
    this.LayoutBuilder = LayoutBuilder;
    this.Elements = Elements;
    this.Modals = Modals;
    this.ShortcodeParser = ShortcodeParser;
    this.allTags = this.LayoutBuilder.allTags;

  }

  show(args) {
    $('body').append(this.shortcodeModalTemplate);
    this.lastClickedAddButtonElement = args;
    $('.shortcode-modal .body').html(this.createElementFromShortcodeData());
    this.LayoutBuilder.initializeTip();
    $('.shortcode-search-input').focus();
  }

  createShortcodeView(clickedElement) {
    $('.ps_shortcode_element').each((i, element) => {
      $(element).removeClass('actived');
    });
    $(clickedElement).addClass('actived');

    let token = $(clickedElement).data('token');

    if (this.lastClickedAddButtonElement) {
      for (let i = 0; i < this.allTags.length; i++) {
        if (this.allTags[i].token === token) {
          this.Elements.add(this.allTags[i], this.lastClickedAddButtonElement);
          break;
        }
      }
    }
  }

  createElementFromShortcodeData() {
    let parentName = $(this.lastClickedAddButtonElement).parent().parent().data('shortcode');
    this.getSelectList(parentName ? parentName : '');
    console.log(this.fullData, parentName ? parentName : '');

    let elements = `<div class="ps_shortcode_container">`;

    for (let i = 0; i < this.fullData.length; i++) {
      elements += `<div class="ps_shortcode_elements_group"><div class="ps_group_name">${this.fullData[i].name}</div><div class="ps_group_elements">`;
      for (let j = 0; j < this.fullData[i].elements.length; j++) {
        elements += `<div title="${this.fullData[i].elements[j].description}" class="ps_shortcode_element" data-token="` + this.fullData[i].elements[j].token + `">` + this.fullData[i].elements[j].title + `</div>`;
      }
      elements += `</div></div>`
    }

    elements += `</div>`;
    return elements;
  }
}

export default new Select();
