<template>
    <v-row :class="{'multi-use-container':!!this.formElement.attribute.settings.isMultiUse, 'single-use-container':!(!!this.formElement.attribute.settings.isMultiUse)}">
      <h3 v-if="!!this.formElement.attribute.settings.isMultiUse">List of: {{this.formElement.attribute.attributeName}}</h3>
      <small v-if="!!this.formElement.attribute.settings.isMultiUse">If you want add more than one use button 'add next'</small>
      <v-col cols="12" class="pa-0" v-if="!!this.formElement.attribute.settings.isMultiUse">
        <v-divider class="my-3"/>
        <ValueList class="mb-3" :attribute="this.formElement.attribute"/>
        <v-divider class="my-3"/>
      </v-col>
      <AddForm
        :attribute="this.formElement.attribute"
      />
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
      background: white;
      margin: -30px -8px 0;
      padding: 0 10px;
      color: #626a6f;
    }
  }
  .row.single-use-container {
    padding: 0 15px;
    margin-bottom: 30px;
    margin-top: -15px;
  }
</style>
