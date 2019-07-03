export default class Notify {

    constructor() {
        this.ERROR = 0;
        this.SUCCESS = 1;
        this.INFO = 2;
        this.WARNING = 3;

        this.defaultNotifyTime = 7000;
        this.removeOnError = false;
        this.defaultNotifyType = this.INFO;

        this.createContainer();

        let self = this;

        $(document).on('click','.notify-container .close',function(){
            self.removeNotify($(this).parent());
        });
    }

    createContainer() {
        let containerHtml = `<div class="notify-container"></div>`;
        let container =  $('body').find('.notify-container');

        if(container.length <= 0){
            $('body').append(containerHtml);
        }
    }

    push(notifyText, notifyType, notifyTime) {
        let notifyElement = document.createElement('div');
        notifyElement.classList.add(`notify-type-${notifyType}`);
        notifyElement.classList.add(`notify-element`);
        notifyElement.innerHTML = `<p>${notifyText}</p><span class="close"></span>`;

        let container =  document.body.getElementsByClassName('notify-container')[0];
        container.appendChild(notifyElement);

        if(notifyType !== this.ERROR || (notifyType === this.ERROR && this.removeOnError)){
            setTimeout(()=>{
                this.removeNotify(notifyElement);
            }, notifyTime ? notifyTime : this.defaultNotifyTime);
        }
    }

    removeNotify(notify){
        $(notify).addClass('notify-remove');
        setTimeout(()=>{
            notify.remove();
        },300);
    }

};