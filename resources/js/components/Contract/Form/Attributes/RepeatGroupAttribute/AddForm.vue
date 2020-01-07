<template>
    <v-row class="repeat-group-add">
        <component v-for="(attribute, index) in attributesList"
                   :key="index"
                   :is="Mapper.getAttributeComponentName(attribute.attributeType)"
                   :dense="true"
                   v-bind="{
                        attribute: attribute,
                        validationError: validationIndex === index ? validationError : ''
                    }"
                   @change-value="(newValue)=>{
                        changeValue(newValue, attribute)
                    }"
        >
        </component>
        <v-row class="justify-center">
            <v-btn dense color="primary" @click="add">{{$t("base.button.addElement")}}</v-btn>
        </v-row>
    </v-row>
</template>

<script>
import NumberAttribute from '../../Attributes/NumberAttribute'
import TextAttribute from '../../Attributes/TextAttribute'
import SelectAttribute from '../../Attributes/SelectAttribute'
import AttributeValidator from '../../Validators/AttributeValidator'
import RepeatGroupAttribute from '../../Attributes/RepeatGroupAttribute'

export default {
  name: 'AddForm',
  props: ['attributes'],
  components: {
    NumberAttribute,
    TextAttribute,
    SelectAttribute,
    RepeatGroupAttribute
  },
  data () {
    return {
      attributesList: [],
      validationError: '',
      validationIndex: -1
    }
  },
  methods: {
    changeValue (newValue, attribute) {
      if (newValue) {
        this.attributesList = this.attributesList.map(x => {
          if (x.attributeName === attribute.attributeName) {
            x.value = newValue
          }
          return x
        })
      }
    },
    isValid (newValue, attribute) {
      const validatorResult = AttributeValidator.validate(attribute, newValue)
      this.validationError = validatorResult.errorMessage
      let index = -1

      this.attributesList.map((element, i) => {
        if (element.attributeName === attribute.attributeName) {
          index = i
        }
      })

      this.validationIndex = index
      return validatorResult.status
    },
    add () {
      const isAllValid = this.attributesList.every(x => this.isValid(x.value, x))

      if (isAllValid) {
        this.$emit('add', Object.assign([], this.attributesList))
        this.resetForm()
      }
    },
    resetForm () {
      const newAttributes = JSON.parse(JSON.stringify(this.attributes))
      this.attributesList = newAttributes.map(x => {
        x.value = x.defaultValue
        return x
      })
      this.validationError = ''
      this.validationIndex = -1
    }
  },
  mounted () {
    this.resetForm()
  }
}
</script>

<style lang="scss">
    .repeat-group-add .col{
        padding-bottom: 0 !important;
    }
</style>
