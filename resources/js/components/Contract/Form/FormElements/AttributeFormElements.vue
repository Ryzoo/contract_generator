<template>
    <v-row :class="{'multi-use-container':!!this.formElement.attribute.settings.isMultiUse, 'single-use-container':!(!!this.formElement.attribute.settings.isMultiUse)}">
      <h3 v-if="!!this.formElement.attribute.settings.isMultiUse">Multiple element</h3>
      <AddForm
        :attribute="this.formElement.attribute"
        :validationError="this.formElement.validationError || ''"
        @change="changeValue"
      />
      <v-col cols="12" class="pa-0" v-if="!!this.formElement.attribute.settings.isMultiUse">
          <v-divider class="my-3"/>
          <ValueList class="mb-3" @remove="changeValue" :value="this.formElement.attribute.value || []"/>
      </v-col>
    </v-row>
</template>

<script>
import AddForm from '../Attributes/RepeatGroupAttribute/AddForm'
import ValueList from '../Attributes/RepeatGroupAttribute/ValueList'

export default {
  name: 'AttributeFormElements',
  props: ['formElement'],
  components: {
    AddForm,
    ValueList
  },
  data () {
    return {
    }
  },
  methods: {
    changeValue (newValue) {
      this.$store.dispatch('formElements_change', {
        id: this.formElement.id,
        value: newValue
      })
    }
  }
}
</script>

<style lang="scss">
  .row.multi-use-container {
    border: 1px solid #dadada;
    border-radius: 5px;
    margin-bottom: 30px;
    position: relative;
    padding: 15px;

    & > h3 {
      position: absolute;
      background: white;
      margin: 0px -8px;
      padding: 0 10px;
      top: -15px;
      color: #626a6f;
    }
  }
  .row.single-use-container {
    padding: 0 15px;
    margin-bottom: 30px;
    margin-top: -15px;
  }
</style>
