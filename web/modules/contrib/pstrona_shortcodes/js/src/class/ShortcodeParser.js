class ShortcodeParser {
    parseTextToShortcodeStructure(text) {
        let structure = this.parseText(text);
        return $.extend({}, structure);
    }

    parseText(text) {
        let textParsed = text.replace(/[\n\r\t]/g, '').trim();
        let pattern = /\[(ps_[^\]]+) ?psid="([^"]+)" ?([^\]]+) ?\](.*)(?:\[\/\1 ?psid="\2" ?\])/g;
        let returnedArray = null;
        let tokenStructure = [];

        do {
            returnedArray = pattern.exec(textParsed);

            if (returnedArray) {
                tokenStructure.push({
                    token: returnedArray[1].trim(),
                    psid: returnedArray[2].trim(),
                    param: returnedArray[3].trim(),
                    content: this.parseText(returnedArray[4].trim())
                });
            }
        } while (returnedArray);

        return tokenStructure;
    }

    parseShortocdeToText(shortcodeView, tab = 0) {
        let elements = null;
        if (shortcodeView.hasClass('drag')) {
            elements = shortcodeView.find('.body').first().children('.drag');
        }
        else {
            elements = shortcodeView.children('.drag');
        }

        let html = '';
        let tabHtml = '';

        for (var i = 0; i < tab; i++) {
            tabHtml += "    ";
        }

        let self = this;
        elements.each(function () {
            let token = $(this).data('shortcode');
            let attributes = self.generateShortcodeAttributes($(this).data('settings'));
            let elementsIs = self.parseShortocdeToText($(this), tab + 1);
            let psid = 'psid="' + $(this).attr('id') + '"';

            if (tab > 0) {
                if (elementsIs.length > 0) {
                    html += `${tabHtml}[${token} ${psid} ${attributes}]\n${elementsIs}${tabHtml}[/${token} ${psid}]\n`;
                }
                else {
                    html += `${tabHtml}[${token} ${psid} ${attributes}]${elementsIs}[/${token} ${psid}]\n`;
                }
            }
            else {
                if (elementsIs.length > 0) {
                    html += `${tabHtml}[${token} ${psid} ${attributes}]\n${elementsIs}${tabHtml}[/${token} ${psid}]\n`;
                }
                else {
                    html += `${tabHtml}[${token} ${psid} ${attributes}]${elementsIs}[/${token} ${psid}]\n`;
                }
            }
        });

        return html;
    }

    generateShortcodeAttributes(elementSettings) {
        let attributesList = {
            style: '',
            class: '',
            id: '',
        };

        function addClass(className) {
            attributesList.class += (attributesList.class.length === 0) ? className : " " + className;
        }

        function addStyle(style) {
            attributesList.style += (attributesList.style.length === 0) ? style : " " + style;
        }

        // add_atributes
        // tutaj okreslamy jakie atrybuty ma dodac dany parametr

        // tab size
        if (elementSettings[1].elements[0].value.length > 0) { // padding left
            addStyle(`padding-left: ${elementSettings[1].elements[0].value.replace(/ /g, '')}px;`);
        }
        if (elementSettings[1].elements[1].value.length > 0) { // padding right
            addStyle(`padding-right: ${elementSettings[1].elements[1].value.trim()}px;`);
        }
        if (elementSettings[1].elements[2].value.length > 0) { // padding top
            addStyle(`padding-top: ${elementSettings[1].elements[2].value.trim()}px;`);
        }
        if (elementSettings[1].elements[3].value.length > 0) { // padding bottom
            addStyle(`padding-bottom: ${elementSettings[1].elements[3].value.trim()}px;`);
        }
        if (elementSettings[1].elements[4].value.length > 0) { // margin left
            addStyle(`margin-left: ${elementSettings[1].elements[4].value.trim()}px;`);
        }
        if (elementSettings[1].elements[5].value.length > 0) { // margin right
            addStyle(`margin-right: ${elementSettings[1].elements[5].value.trim()}px;`);
        }
        if (elementSettings[1].elements[6].value.length > 0) { // margin top
            addStyle(`margin-top: ${elementSettings[1].elements[6].value.trim()}px;`);
        }
        if (elementSettings[1].elements[7].value.length > 0) { // margin bottom
            addStyle(`margin-bottom: ${elementSettings[1].elements[7].value.trim()}px;`);
        }

        // tab class, id, style, background
        if (elementSettings[2].elements[0].value.length > 0) { // additional class
            addClass(elementSettings[2].elements[0].value.trim());
        }
        if (elementSettings[2].elements[1].value.length > 0) { // id
            attributesList.id = elementSettings[2].elements[1].value.trim();
        }
        if (elementSettings[2].elements[3].value.length > 0 && elementSettings[2].elements[3].atr_name) { // additional class
            attributesList[elementSettings[2].elements[3].atr_name] = elementSettings[2].elements[3].value;
        }

        // animations
        $.each(elementSettings[3].elements, function (index, val) {
            if (val.atr_name && val.value && val.value.length > 0) {
                attributesList[val.atr_name] = val.value;
            }
        });

        // inne - cache / shadow
        $.each(elementSettings[4].elements, function (index, val) {
            if (val.atr_name && val.value && val.value.length > 0) {
                attributesList[val.atr_name] = val.value;
            }
        });

        $.each(elementSettings[0].elements, function (index, val) {
            if (val.atr_name && val.value && val.value.length > 0) {
                let content = val.value.replace(/"/g, "'");
                content = content.replace(/[\r\n]+/g, '');
                content = content.replace(/\t+/g, '');
                content = content.replace(/ {2,}/g, '');
                content = content.replace(/</g, '&lt;');
                content = content.replace(/>/g, '&gt;');
                attributesList[val.atr_name] = content;
            }
        });

        let code = '';
        $.each(attributesList, function (index, value) {
            if (value.length > 0) {
                code += index + `="${value}" `;
            }
        });

        return code;
    }

    checkForAllAdditionalClass() {
        $('.drag').each((index, variable) => {
            let token = $(variable).data('shortcode');
            let settings = $(variable).data('settings');
            let id = $(variable).attr('id');
            this.checkForAdditionalClass(token, settings, "#" + id);
        });
    }

    checkForAdditionalClass(shortcode = '', settings, id) {
        shortcode = shortcode.replace('ps_', '');

        switch (shortcode) {
            case "row":
                $(id).removeClass();
                $(id).addClass("drag ps-class-row");
                break;
            case "col":
                $(id).removeClass();
                let min = 12;
                for (var i = 0; i < settings[0].elements.length; i++) {
                    if (parseInt(settings[0].elements[i].value) < min) {
                        min = parseInt(settings[0].elements[i].value);
                    }
                }
                $(id).addClass("drag ps-class-col-" + min);
                break;
        }
    }
}

export default new ShortcodeParser();
