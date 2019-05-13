import IconPicker from '../summernote/IconPicker';

class Config {

    constructor() {
        let self = this;
        this.shortcodeModalConfigTemplate = `
        <div class="shortcode-modal-config">
            <div class="shortcode-back"></div>
            <div class="shortcode-container">
                <div class="head">Element configuration</div>
                <div class="body"></div>
                <div class="actions">
                    <button class="shortcode-modal-cancel-button button">Cancel</button>
                    <button class="shortcode-modal-save-button button button--primary">Save</button>
                </div>
            </div>
        </div>`;

        jQuery(document).off('click', '.shortcode-modal-settings-content .tabs li');
        jQuery(document).on('click', '.shortcode-modal-settings-content .tabs li', function () {
            let id = jQuery(this).data('id');
            jQuery('.shortcode-modal-settings-content .tabs li').removeClass('actived');
            jQuery(this).addClass('actived');
            jQuery('.shortcode-modal-settings-content .content-tab').removeClass('actived');
            jQuery('.shortcode-modal-settings-content .content-tab[data-id="' + id + '"]').addClass('actived');
        });

        jQuery(document).off('click', '.shortcode-modal-save-button');
        jQuery(document).on('click', '.shortcode-modal-save-button', () => {
            this.saveConfigToShortcodeElement();
        });

        jQuery(document).off('click', '.select-icon-button-in-element');
        jQuery(document).on('click', '.select-icon-button-in-element', function () {
            IconPicker.showForElement(this);
        });

        jQuery(document).off('click', '.select-icon-button-remove');
        jQuery(document).on('click', '.select-icon-button-remove', function () {
            $(this).parent().find("div").first().html("");
            $(this).parent().find("div").first().data("icon", "");
            $(this).parent().find("button").first().text("Select icon");
        });


        // file element
        jQuery(document).off("keydown", ".input-file-trigger");
        jQuery(document).on("keydown", ".input-file-trigger", function (event) {
            if (event.keyCode == 13 || event.keyCode == 32) {
                jQuery(this).parent().find(".input-file").first().click();
            }
        });

        jQuery(document).off("click", ".input-file-trigger");
        jQuery(document).on("click", ".input-file-trigger", function (event) {
            jQuery(this).parent().find(".input-file").first().click();
            return false;
        });

        jQuery(document).off('click', '.select-file-button-remove');
        jQuery(document).on('click', '.select-file-button-remove', function () {
            let label = jQuery(this).parent().find('label').first();
            let inputElement = jQuery(this).parent().find('input[type="hidden"]').first();
            let trans = label.data('name');

            let saveButton = jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().find('.actions').first().find('.shortcode-modal-save-button').first();
            let lastTextButton = saveButton.text();
            saveButton.text('Wait for image delete...');
            saveButton.attr("disabled", true);

            if (inputElement.val().length > 4) {
                let id = inputElement.val().split("{#}")[0];
                let data = new FormData();
                data.append('id', id);

                jQuery.ajax({
                    url: '/ajax/pstrona_shortcodes/ajax_delete_file',
                    type: 'POST',
                    data: data,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data, textStatus, jqXHR) {
                        label.text(trans);
                        saveButton.text(lastTextButton);
                        saveButton.attr("disabled", false);
                        inputElement.val('');
                    }
                });
            }
        });

        jQuery(document).off("change", ".input-file");
        jQuery(document).on("change", ".input-file", function (event) {
            jQuery(this).parent().find(".file-return").first().html(this.value);
            let label = jQuery(this).parent().find('label').first();
            let selfEl = jQuery(this).parent().find('input[type="hidden"]').first();
            let data = new FormData();
            data.append('files[image]', jQuery(this)[0].files[0]);
            data.append('last', selfEl.val());
            let saveButton = jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().find('.actions').first().find('.shortcode-modal-save-button').first();
            let lastTextButton = saveButton.text();
            saveButton.text('Wait for image load...');
            saveButton.attr("disabled", true);

            jQuery.ajax({
                url: '/ajax/pstrona_shortcodes/ajax_send_file',
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data, textStatus, jqXHR) {
                    if (data.id > 0) {
                        if (data.url && data.url.length > 1) {
                            selfEl.val(data.id + "{#}" + data.url);
                            let splitedArray = data.url.split("/");
                            label.text(splitedArray[splitedArray.length - 1]);
                        }
                    }
                    saveButton.text(lastTextButton);
                    saveButton.attr("disabled", false);
                },
                error: function () {
                    saveButton.text(lastTextButton);
                    saveButton.attr("disabled", false);
                }
            });
        });

        // multi file element
        jQuery(document).off("keydown", ".input-file-multi-trigger");
        jQuery(document).on("keydown", ".input-file-multi-trigger", function (event) {
            if (event.keyCode == 13 || event.keyCode == 32) {
                jQuery(this).parent().find(".input-file-multi").first().click();
            }
        });

        jQuery(document).off("click", ".input-file-multi-trigger");
        jQuery(document).on("click", ".input-file-multi-trigger", function (event) {
            jQuery(this).parent().find(".input-file-multi").first().click();
            return false;
        });

        jQuery(document).off('click', '.select-file-multi-button-remove');
        jQuery(document).on('click', '.select-file-multi-button-remove', function () {
            let inputElement = jQuery(this).parent().parent().parent().find('input[type="hidden"]').first();
            let saveButton = jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().find('.actions').first().find('.shortcode-modal-save-button').first();
            let lastTextButton = saveButton.text();
            let containerForFile = jQuery(this).parent();

            let fileID = jQuery(this).parent().find('.file-label-name').first().attr("id");
            fileID = fileID.split("id-")[1];

            if (inputElement.val().length > 2) {
                saveButton.text('Wait for image delete...');
                saveButton.attr("disabled", true);

                let data = new FormData();
                data.append('id', fileID);

                jQuery.ajax({
                    url: '/ajax/pstrona_shortcodes/ajax_delete_file',
                    type: 'POST',
                    data: data,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data, textStatus, jqXHR) {
                        saveButton.text(lastTextButton);
                        saveButton.attr("disabled", false);
                        let inputVal = inputElement.val();
                        inputVal = inputVal.split("{|#|}");

                        let newInputVal = '';
                        inputVal.map((element) => {
                            let id = element.split("{#}")[0];
                            if (fileID !== id) {
                                newInputVal += "{|#|}" + element;
                            }
                        });

                        inputElement.val(newInputVal);
                        containerForFile.remove();
                    }
                });
            }
        });

        jQuery(document).off("change", ".input-file-multi");
        jQuery(document).on("change", ".input-file-multi", function (event) {
            let selfEl = jQuery(this).parent().find('input[type="hidden"]').first();
            let content = jQuery(this).parent().find('.input-file-multi-content').first();

            jQuery(this).parent().find(".file-return").first().html(this.value);

            for (let i = 0; i < jQuery(this)[0].files.length; i++) {
                self.sendFileIn(this, jQuery(this)[0].files[i], '', content);
            }
        });

        this.addIconsButton = function (context) {
            let ui = jQuery.summernote.ui;
            let button = ui.button({
                contents: '<i class="fab fa-fonticons"/> Ikony',
                tooltip: 'Dodaj ikonę',
                click: function () {
                    IconPicker.show(context);
                }
            });

            return button.render();   // return button as jquery object
        }
    }

    sendFileIn(elementIn, file, last, contentContainer) {
        let selfEl = jQuery(elementIn).parent().find('input[type="hidden"]').first();
        let saveButton = jQuery(elementIn).parent().parent().parent().parent().parent().parent().parent().parent().find('.actions').first().find('.shortcode-modal-save-button').first();
        let lastTextButton = saveButton.text();

        saveButton.attr("disabled", true);
        saveButton.text('Wait for img save...');

        let data = new FormData();

        data.append('files[image]', file);
        data.append('last', last);

        jQuery.ajax({
            url: '/ajax/pstrona_shortcodes/ajax_send_file',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data, textStatus, jqXHR) {
                if (data.id > 0) {
                    if (data.url && data.url.length > 1) {
                        let fileInputData = data.id + "{#}" + data.url;
                        let fileName = data.url.split("/");
                        fileName = fileName[fileName.length - 1];
                        selfEl.val(selfEl.val() + "{|#|}" + fileInputData);
                        contentContainer.append(`<div class='file-single-element'><span id='file-id-${data.id}' class='file-label-name'>${fileName}</span><div class='select-file-multi-button-remove'><i class='far fa-trash-alt'></i></div></div>`);
                    }
                }
                saveButton.text(lastTextButton);
                saveButton.attr("disabled", false);
            },
            error: function () {
                saveButton.text(lastTextButton);
                saveButton.attr("disabled", false);
            }
        });
    }

    init(LayoutBuilder, Elements, Modals, ShortcodeParser) {
        this.LayoutBuilder = LayoutBuilder;
        this.Elements = Elements;
        this.Modals = Modals;
        this.ShortcodeParser = ShortcodeParser;
        this.quillEditor = null;
    }

    show(elementId) {
        let element = $("#" + elementId);
        let settings = element.data("settings");
        let token = element.data("shortcode");
        this.actualOpenedId = elementId;
        let self = this;

        $.ajax({
            url: "/ajax/pstrona_shortcodes/get_settings_html",
            type: "POST",
            dataType: 'json',
            async: false,
            data: {
                "settings": JSON.stringify(settings),
                "token": token
            },
            success: (data) => {
                if (!data.error) {
                    $('body').append(this.shortcodeModalConfigTemplate);
                    $(".shortcode-modal-config .body").first().html(data.data);

                    if ($('.html_editor_quill').length > 0) {
                        $('.html_editor_quill').first().summernote({
                            placeholder: 'Wprowadź zawartość...',
                            tabsize: 4,
                            height: 200,
                            prettifyHtml: true,
                            toolbar: [
                                ['style', ['style']],
                                ['fontsize', ['fontsize']],
                                ['font', ['bold', 'italic', 'underline', 'clear']],
                                ['fontname', ['fontname']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'hr']],
                                ['view', ['fullscreen', 'codeview']],
                                ['help', ['help']],
                                ['icons', ['addIcons']]
                            ],
                            buttons: {
                                addIcons: this.addIconsButton
                            },
                            callbacks: {
                                onImageUpload: function (files) {
                                    let editor = jQuery(this);
                                    self.sendFile(files[0], editor);
                                },
                                onPaste: function (e) {
                                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text'); e.preventDefault(); document.execCommand('insertText', false, bufferText);
                                }
                            }
                        });
                    }

                    this.betterSelectCreate();
                }
            }
        });
    }

    sendFile(file, editor) {
        let data = new FormData();
        data.append('files[image]', file);
        $.ajax({
            data: data,
            type: 'POST',
            url: '/ajax/pstrona_shortcodes/ajax_send_file',
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                editor.summernote('insertImage', data.url);
            }
        });
    }

    saveConfigToShortcodeElement() {
        let settings = $("#" + this.actualOpenedId).data('settings');

        for (let i = 0; i < settings.length; i++) {
            for (let j = 0; j < settings[i].elements.length; j++) {
                let type = settings[i].elements[j].type;
                let id = `#el-${i}-${j}`;
                switch (type) {
                    case "text":
                    case "textarea":
                    case "number":
                    case "color":
                        let code1 = $(id).val().replace(/"/g, "'").replace((/  |\r\n|\n|\r|\t/gm), "");
                        settings[i].elements[j].value = code1;
                        break;
                    case "file_list":
                        settings[i].elements[j].value = $(id).val();
                        break;
                    case "file":
                        settings[i].elements[j].value = $(id).val();
                        break;
                    case "html":
                        let code = $(id).summernote('code').replace(/"/g, "'");
                        code = code.replace((/  |\r\n|\n|\r|\t/gm), "");
                        settings[i].elements[j].value = code;
                        break;
                    case "checbox":
                        settings[i].elements[j].value = $(id).prop('checked') ? "true" : "false";
                        break;
                    case "select":
                        settings[i].elements[j].value = $(id).val();
                        break;
                    case "icon":
                        settings[i].elements[j].value = $(id).data('icon') ? $(id).data('icon') : "";
                        break;
                }
            }
        }

        $("#" + this.actualOpenedId).data('settings', settings);
        this.ShortcodeParser.checkForAdditionalClass($("#" + this.actualOpenedId).data('shortcode'), settings, "#" + this.actualOpenedId);
        this.Modals.close();
    }

    betterSelectCreate() {
        var x, i, j, selElmnt, a, b, c;

        x = document.getElementsByClassName("ps-custom-select");
        for (i = 0; i < x.length; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            if (selElmnt.options) {
                /*for each element, create a new DIV that will act as the selected item:*/
                a = document.createElement("DIV");
                a.setAttribute("class", "select-selected");
                a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                x[i].appendChild(a);
                /*for each element, create a new DIV that will contain the option list:*/
                b = document.createElement("DIV");
                b.setAttribute("class", "select-items select-hide");
                for (j = 1; j < selElmnt.length; j++) {
                    /*for each option in the original select element,
                    create a new DIV that will act as an option item:*/
                    c = document.createElement("DIV");
                    c.innerHTML = selElmnt.options[j].innerHTML;
                    c.addEventListener("click", function (e) {
                        /*when an item is clicked, update the original select box,
                        and the selected item:*/
                        var y, i, k, s, h;
                        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                        h = this.parentNode.previousSibling;
                        for (i = 0; i < s.length; i++) {
                            if (s.options[i].innerHTML == this.innerHTML) {
                                s.selectedIndex = i;
                                h.innerHTML = this.innerHTML;
                                y = this.parentNode.getElementsByClassName("same-as-selected");
                                for (k = 0; k < y.length; k++) {
                                    y[k].removeAttribute("class");
                                }
                                this.setAttribute("class", "same-as-selected");
                                break;
                            }
                        }
                        h.click();
                    });
                    b.appendChild(c);
                }
                x[i].appendChild(b);
                a.addEventListener("click", function (e) {
                    /*when the select box is clicked, close any other select boxes,
                    and open/close the current select box:*/
                    e.stopPropagation();
                    closeAllSelect(this);
                    this.nextSibling.classList.toggle("select-hide");
                    this.classList.toggle("select-arrow-active");
                });
            }
        }

        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            for (i = 0; i < y.length; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                }
                else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < x.length; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }

        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
    }

}

export default new Config();
