export default class DragService {
  static initDrag (contenerId, store) {
    const el = document.getElementById(contenerId)
    if (el) {
      console.log('build: ' + contenerId)
      window.Sortable.create(el, {
        group: 'blocks',
        draggable: '.block',
        handle: '.block-handle',
        animation: 150,
        fallbackOnBody: true,
        swapThreshold: 0.65,
        onEnd: (evt) => {
          if (store && evt.clone && evt.to) {
            store.dispatch('builder_dragBlock', {
              blockId: parseInt(evt.clone.firstChild.firstChild.dataset.id),
              destinationBlock: parseInt(evt.to.dataset.id),
              placeIndex: evt.newIndex
            })
          }
        }
      })
    }
  }
};
