<template>
  <v-row class="group-attribute">
    <h3>{{attribute.attributeName}}</h3>
    <v-col cols="12" v-for="(attribute, index) in currentValue" :key="index">
      <component
         :is="Mapper.getAttributeComponentName(attribute.attributeType)"
         v-bind="{
            attribute: attribute,
            validationError: validationErrors[index]
         }"
         @change-value="(newValue)=>{
            changeValue(newValue.newValue, attribute)
        }"
      />
    </v-col>
  </v-row>
</template>

<script>
import NumberAttribute from './NumberAttribute'
import TextAttribute from './TextAttribute'
import SelectAttribute from './SelectAttribute'
import AttributeValidator from '../Validators/AttributeValidator'
import RepeatGroupAttribute from './RepeatGroupAttribute'

export default {
  name: 'RepeatGroupAttribute',
  props: ['attribute', 'errorFromValidation'],
  components: {
    NumberAttribute,
    TextAttribute,
    SelectAttribute,
    RepeatGroupAttribute
  },
  data () {
    return {
      defaultValue: JSON.stringify(this.attribute.settings.attributes),
      currentValue: this.attribute.settings.attributes,
      validationErrors: [],
      resetNow: false
    }
  },
  watch:{
    errorFromValidation (newValue) {
      if (newValue.length) this.validationError = newValue
    }
  },
  methods: {
    changeValue (newValue, attribute) {
      this.currentValue = JSON.stringify(this.currentValue.map(x => {
        if (x.attributeName === attribute.attributeName) {
          x.value = newValue
        }
        return x
      }))

      this.currentValue = JSON.parse(this.currentValue)

      const isValid = this.currentValue.every((attr, index) => this.isValid(attr.value, attr, index))

      if (this.resetNow) {
        this.resetNow = false
      }

      this.$emit('change-value', {
        newValue: this.currentValue,
        isValid
      })
    },
    isValid (newValue, attribute, index) {
      const validatorResult = AttributeValidator.validate(attribute, newValue)
      if (!this.resetNow) {
        this.validationErrors[index] = validatorResult.errorMessage
      }
      return validatorResult.status
    },
    resetForm () {
      this.resetNow = true
      this.currentValue = JSON.parse(this.defaultValue)
      this.validationError = ''
    }
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
