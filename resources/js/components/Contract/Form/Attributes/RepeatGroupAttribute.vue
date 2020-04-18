<template>
  <v-row class="group-attribute">
    <h3>{{attribute.attributeName}}</h3>
    <v-col cols="12" v-for="(attribute, index) in getAttributeValue" :key="index">
      <component
        :outside="true"
        :is="Mapper.getAttributeComponentName(attribute.attributeType)"
        :attribute="attribute"
        @change-value="changeValue"
      />
    </v-col>
  </v-row>
</template>

<script>
import NumberAttribute from './NumberAttribute'
import TextAttribute from './TextAttribute'
import SelectAttribute from './SelectAttribute'
import BoolInputAttribute from './BoolInputAttribute'
import BoolAttribute from './BoolAttribute'
import DateAttribute from './DateAttribute'
import TimeAttribute from './TimeAttribute'

export default {
  name: 'RepeatGroupAttribute',
  props: ['attribute', 'outside'],
  components: {
    NumberAttribute,
    TextAttribute,
    SelectAttribute,
    BoolAttribute,
    DateAttribute,
    TimeAttribute,
    BoolInputAttribute
  },
  computed: {
    getAttributeValue () {
      if (this.attribute.settings.isMultiUse) return this.attribute.value[0]
      return this.attribute.value
    }
  },
  methods: {
    changeValue (attribute) {
      console.log(attribute)
      const newValue = this.getAttributeValue.map((x) => {
        if (x.id === attribute.id) {
          return {
            ...attribute
          }
        }
        return {
          ...x
        }
      })

      if (this.outside) {
        this.$emit('change-value', {
          ...this.attribute,
          value: newValue
        })
        return
      }
      this.$store.dispatch('formElements_change_attribute', {
        id: this.attribute.id,
        value: newValue
      })
    },
    resetForm () {}
  }
}
</script>

<style lang="scss">
  .row.group-attribute {
    border: 1px solid #c7c7c7;
    border-radius: 5px;
    padding-top: 15px;
    position: relative;
    margin: 10px 0;

    & > h3 {
      position: absolute;
      color: #7d7d7d;
      left: 5px;
      top: -15px;
      background: white;
      padding: 0 10px;
    }
  }
</style>
