<template>
  <section>
    <v-col cols="12" class="mb-0 pb-0" >
      <component
        ref="addForm"
        :is="Mapper.getAttributeComponentName(this.attribute.attributeType)"
        :attribute="this.attribute"
        :errorFromValidation="this.validationError || ''"
        @change-value="changeValue"
      >
      </component>
    </v-col>
    <v-col cols="12" class="mt-0 pt-0" v-if="this.attribute.isMultiUse">
      <v-btn dense color="primary" :disabled="!lastValue.isValid" class="ma-auto" small @click="addValue">{{$t("base.button.addElement")}}</v-btn>
    </v-col>
  </section>
</template>

<script>
import NumberAttribute from '../../Attributes/NumberAttribute'
import TextAttribute from '../../Attributes/TextAttribute'
import SelectAttribute from '../../Attributes/SelectAttribute'
import RepeatGroupAttribute from '../../Attributes/RepeatGroupAttribute'
import BoolAttribute from '../../Attributes/BoolAttribute'
import DateAttribute from '../../Attributes/DateAttribute'
import TimeAttribute from '../../Attributes/TimeAttribute'

export default {
  name: 'AddForm',
  props: ['attribute', 'validationError'],
  components: {
    NumberAttribute,
    TextAttribute,
    SelectAttribute,
    RepeatGroupAttribute,
    BoolAttribute,
    DateAttribute,
    TimeAttribute
  },
  data () {
    return {
      lastValue: {
        newValue: null,
        isValid: false
      }
    }
  },
  methods: {
    addValue () {
      if (this.lastValue.isValid) {
        this.$refs.addForm.resetForm()
        let attributeValue = this.attribute.value

        if (!Array.isArray(attributeValue)) attributeValue = []

        this.$emit('change', [
          ...attributeValue,
          this.lastValue.newValue
        ])
      }
    },
    changeValue (newValue) {
      this.lastValue = newValue
      if (!this.attribute.isMultiUse) { this.$emit('change', newValue.newValue) }
    }
  }
}
</script>

<style lang="scss">
    .repeat-group-add .col{
        padding-bottom: 0 !important;
    }
</style>
