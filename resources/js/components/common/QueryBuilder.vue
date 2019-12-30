<template>
  <v-col sm="12">
    <v-select
      :items="blockOptions"
      label="Action"
      outlined
      dense
      color="primary"
      v-model="conditionalType"
      hide-details
    >
    </v-select>
    <vue-query-builder
      :key="componentKey"
      :rules="rulesFromAttributes"
      :query="content"
      v-model="content"
    />
  </v-col>
</template>

<script>
import VueQueryBuilder from 'vue-query-builder-vuetifyjs'
import 'vue-query-builder-vuetifyjs/dist/VueQueryBuilder.css'
import { ConditionalEnum } from '../../additionalModules/Enums'

export default {
  name: 'QueryBuilder',
  components: { VueQueryBuilder },
  props: ['conditionals'],
  data () {
    return {
      componentKey: 0,
      conditionalRules: [],
      blockOptions: [
        'SHOW_ON'
      ],
      content: JSON.parse(this.conditionals && this.conditionals[0] ? this.conditionals[0].content || '{}' : '{}'),
      conditionalType: 'SHOW_ON'
    }
  },
  watch: {
    conditionals (newValue) {
      this.content = JSON.parse(newValue && newValue[0] ? newValue[0].content || '{}' : '{}')
      this.componentKey += 1
    },
    content (newValue) {
      this.onConditionalChange(newValue)
    }
  },
  computed: {
    rulesFromAttributes () {
      return this.$store.getters.builder_allVariables
        .filter(x => x.attributeType !== 3)
        .map(x => ({
          type: this.mapBackendTypeToBuilderType(x),
          id: x.id,
          label: x.attributeName,
          options: x.settings.items || []
        }))
    }
  },
  methods: {
    onConditionalChange (newValue) {
      this.$emit('conditional-change', [{
        conditionalType: parseInt(ConditionalEnum[this.conditionalType]),
        content: JSON.stringify(newValue, null, 2)
      }])
    },
    mapBackendTypeToBuilderType (variable) {
      switch (variable.attributeType) {
        case 0:
        case 1:
          return variable.attributeType
        case 2:
          return variable.settings.isMultiSelect ? 3 : 2
      }
      return -1
    }
  }
}
</script>
