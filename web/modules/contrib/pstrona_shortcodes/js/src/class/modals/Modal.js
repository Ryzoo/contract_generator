import ModalSelect from "./Select.js";
import ModalConfig from "./Config.js";

class Modal {
    constructor() {
        jQuery(document).off('click', '.shortcode-modal-cancel-button');
        jQuery(document).on('click', '.shortcode-modal-cancel-button', () => {
            this.close();
        });

        jQuery(document).keyup((e) => {
            if (e.keyCode == 27) {
                this.close();
            }
        });

    }

    init(LayoutBuilder, Elements, ShortcodeParser) {
        this.LayoutBuilder = LayoutBuilder
        this.Elements = Elements
        this.ShortcodeParser = ShortcodeParser
        ModalConfig.init(LayoutBuilder, Elements, this, ShortcodeParser);
        ModalSelect.init(LayoutBuilder, Elements, this, ShortcodeParser);
    }

    open(type, args = null) {
        this.close();
        switch (type) {
            case 'select':
                ModalSelect.show(args);
                break;
            case 'config':
                ModalConfig.show(args);
                break;
        }
    }

    close() {
        if ($('.shortcode-modal')) $('.shortcode-modal').remove();
        if ($('.shortcode-modal-config')) $('.shortcode-modal-config').remove();

        $('.ps_shortcode_element').each((i, element) => {
            $(element).removeClass('actived');
        });

        ModalSelect.lastClickedAddButtonElement = null;
    }
}

export default new Modal();
