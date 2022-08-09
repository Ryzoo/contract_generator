export default class DragService {
    static initDrag(contenerId, store) {
        const el = document.getElementById(contenerId)
        if (el) {
            window.Sortable.create(el, {
                group: 'blocks',
                draggable: '.block',
                handle: '.block-handle',
                filter: '.ignore-elements',
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                onEnd: (evt) => {
                    if (store && evt.clone && evt.to) {
                        store.dispatch('builder_dragBlock', {
                            blockId: parseInt(
                                evt.clone.firstElementChild.firstElementChild
                                    .dataset.id
                            ),
                            destinationBlock: parseInt(evt.to.dataset.id),
                            placeIndex: evt.newIndex,
                        })
                    }
                },
                onMove: (evt) => {
                    return (
                        evt.related.firstElementChild.firstElementChild.dataset
                            .id > 1
                    )
                },
            })
        }
    }
}
