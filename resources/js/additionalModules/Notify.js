export default class Notify {
    constructor() {
        this.ERROR = 0
        this.SUCCESS = 1
        this.INFO = 2
        this.WARNING = 3

        this.defaultNotifyTime = 7000
        this.removeOnError = false
        this.defaultNotifyType = this.INFO

        this.createContainer()

        const self = this

        $(document).on('click', '.notify-container .close', function () {
            self.removeNotify($(this).parent())
        })
    }

    createContainer() {
        const containerHtml = '<div class="notify-container"></div>'
        const container = $('body').find('.notify-container')

        if (container.length <= 0) {
            $('body').append(containerHtml)
        }
    }

    push(notifyText, notifyType, notifyTime) {
        const notifyElement = document.createElement('div')
        notifyElement.classList.add(`notify-type-${notifyType}`)
        notifyElement.classList.add('notify-element')
        notifyElement.innerHTML = `<p>${notifyText}</p><span class="close"></span>`

        const container =
            document.body.getElementsByClassName('notify-container')[0]
        container.appendChild(notifyElement)

        setTimeout(() => {
            this.removeNotify(notifyElement)
        }, notifyTime || this.defaultNotifyTime)
    }

    removeNotify(notify) {
        $(notify).addClass('notify-remove')
        setTimeout(() => {
            notify.remove()
        }, 300)
    }
}
