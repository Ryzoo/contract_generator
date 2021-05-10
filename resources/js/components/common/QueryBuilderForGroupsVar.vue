<template>
  <v-col cols="12">
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
import { AttributeTypeEnum, ConditionalEnum } from '../../additionalModules/Enums'

export default {
  name: 'QueryBuilderForGroupsVar',
  components: { VueQueryBuilder },
  props: ['attribute', 'attributesList', 'parentId', 'noStore'],
  data () {
    return {
      availableAttributes: this.attributesList.filter(x => x.id !== this.attribute.id),
      componentKey: 0,
      conditionalRules: [],
      blockOptions: [
        'SHOW_ON'
      ],
      content: JSON.parse(this.attribute.conditionals && this.attribute.conditionals[0] ? this.attribute.conditionals[0].content || '{}' : '{}'),
      conditionalType: 'SHOW_ON'
    }
  },
  watch: {
    attributesList (newValue) {
      this.availableAttributes = newValue.filter(x => x.id !== this.attribute.id)
    },
    attribute (newValue) {
      this.content = JSON.parse(newValue.conditionals && newValue.conditionals[0] ? newValue.conditionals[0].content || '{}' : '{}')
      this.componentKey += 1
    },
    content (newValue) {
      this.onConditionalChange(newValue)
    }
  },
  computed: {
    rulesFromAttributes () {
      return this.availableAttributes
        .map((x) => {
          const type = this.mapBackendTypeToBuilderType(x)
          const options = x.settings.items ? x.settings.items.map(e => ({ label: e, value: e })) : null

          return {
            type: parseInt(type),
            id: this.parentId + ':' + x.id,
            label: x.attributeName,
            options: options || []
          }
        })
    }
  },
  methods: {
    onConditionalChange (newValue) {
      const data = (newValue.children && newValue.children.length > 0) ? [{
        conditionalType: parseInt(ConditionalEnum[this.conditionalType]),
        content: JSON.stringify(newValue, null, 2)
      }] : []

      this.attribute.conditionals = data

      if (this.noStore) {
        this.$emit('edit', {
          ...this.attribute
        })
      } else {
        this.$store.dispatch('variables_updateConditionals', {
          id: this.attribute.id,
          value: data
        })
      }
    },
    mapBackendTypeToBuilderType (variable) {
      switch (parseInt(variable.attributeType)) {
        case AttributeTypeEnum.NUMBER:
        case AttributeTypeEnum.TEXT:
        case AttributeTypeEnum.DATE:
        case AttributeTypeEnum.TIME:
        case AttributeTypeEnum.BOOL:
        case AttributeTypeEnum.AGGREGATE:
        case AttributeTypeEnum.BOOL_INPUT:
        case AttributeTypeEnum.CURRENCY:
          return parseInt(variable.attributeType)
        case AttributeTypeEnum.SELECT:
          return variable.settings.isMultiSelect ? 3 : 2
      }
      return -1
    }
  }
}
</script>
