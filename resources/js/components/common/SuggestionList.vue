<template>
  <div class="suggestion-list">
    <div v-if="hasResults">
      <div
          v-for="(variable, index) in items"
          :key="variable.id"
          class="suggestion-list__item"
          :class="{ 'is-selected': navigatedVariableIndex === index }"
          @click="selectVariable(variable)"
      >
        {{ variable.name }}
      </div>
    </div>
    <div v-else class="suggestion-list__item is-empty">
      No variables found
    </div>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      required: true,
    },

    command: {
      type: Function,
      required: true,
    },
  },

  data() {
    return {
      navigatedVariableIndex: 0,
    }
  },

  mounted () {
    console.log('suggestion mounted', this.items);
  },

  computed: {
    hasResults() {
      return this.items.length
    },
  },

  methods: {
    onKeyDown({ event }) {
      if (event.keyCode === 38) {
        this.upHandler()
        return true
      }

      if (event.keyCode === 40) {
        this.downHandler()
        return true
      }

      if (event.keyCode === 13) {
        this.enterHandler()
        return true
      }

      return false
    },

    upHandler () {
      this.navigatedVariableIndex = ((this.navigatedVariableIndex + this.items.length) - 1) % this.items.length
    },

    downHandler () {
      this.navigatedVariableIndex = (this.navigatedVariableIndex + 1) % this.items.length
    },

    enterHandler () {
      const variable = this.items[this.navigatedVariableIndex]
      if (variable) {
        this.selectVariable(variable)
      }
    },

    selectVariable (variable) {
      this.command({ id: variable.id, label: variable.name })
    },
  },
}
</script>
