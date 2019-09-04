import { Node } from 'tiptap'

export default class VariableNode extends Node {

  get name() {
    return 'variable'
  }

  get schema() {
    return {
      // here you have to specify all values that can be stored in this node
      attrs: {
      },
      content: 'block+',
      group: 'block',
      selectable: false,
      // parseDOM and toDOM is still required to make copy and paste work
      parseDOM: [{
        tag: 'variable',
        // getAttrs: dom => ({
        //   parameters: dom.getAttribute('parameters'),
        // }),
      }],
      toDOM: () => ['variable',0],
    }
  }

  // return a vue component
  // this can be an object or an imported component
  // get view() {
  //   return {
  //     // there are some props available
  //     // `node` is a Prosemirror Node Object
  //     // `updateAttrs` is a function to update attributes defined in `schema`
  //     // `view` is the ProseMirror view instance
  //     // `options` is an array of your extension options
  //     // `selected`
  //     props: ['node', 'updateAttrs', 'view'],
  //     computed: {
  //       parameters: {
  //         get() {
  //           return this.node.attrs.parameters
  //         },
  //         set(parameters) {
  //           // we cannot update `src` itself because `this.node.attrs` is immutable
  //           this.updateAttrs({
  //             parameters,
  //           })
  //         },
  //       },
  //     },
  //     template: `
  //           <variable></variable>
  //     `,
  //   }
  // }

}