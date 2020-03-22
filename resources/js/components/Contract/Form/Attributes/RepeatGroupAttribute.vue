<template>
  <v-col cols="12" :class="{'repeat-group-container': true, 'error-is': validationError.length}">
    <h3 class="attribute-header">{{attribute.attributeName}}
      <v-tooltip right v-if="attribute.additionalInformation">
        <template v-slot:activator="{ on }">
          <v-icon color="primary" dark v-on="on">fa-question-circle</v-icon>
        </template>
        <span>{{attribute.additionalInformation}}</span>
      </v-tooltip>
    </h3>
    <small>{{attribute.description}}</small>

    <v-divider class="my-3"/>
    <small class="error--text" v-if="validationError.length">{{validationError}}</small>

    <v-divider class="my-3" v-if="validationError.length"/>
    <AddForm @add="addValue" @change="changeMulti" :attributes="attribute.settings.attributes" :is-multi-use="attribute.isMultiUse"/>

    <div v-if="attribute.isMultiUse">
      <v-divider class="my-3"/>
      <ValueList class="mb-3" @remove="removeElement" :values="valueList"/>
    </div>
  </v-col>
</template>

<script>
import AddForm from './RepeatGroupAttribute/AddForm'
import ValueList from './RepeatGroupAttribute/ValueList'

export default {
  name: 'RepeatGroupAttribute',
  props: ['attribute', 'validationError'],
  components: {
    AddForm,
    ValueList
  },
  data () {
    return {
      valueList: []
    }
  },
  watch: {
    attribute (attribute) {
      this.valueList = attribute.value ? attribute.value : []
    }
  },
  methods: {
    changeMulti (newValue) {
      this.valueList = [newValue]
      this.changeValue()
    },
    addValue (newValue) {
      this.valueList.push(newValue)
      this.changeValue()
    },
    removeElement (element) {
      this.valueList = this.valueList.filter(x => x !== element)
      this.changeValue()
    },
    changeValue () {
      this.$emit('change-value', this.valueList)
    }
  }
}
</script>

<style scoped>
  .attribute-header{
    font-size: 16px;
    font-weight: 300;
  }

  .repeat-group-container {
    border: 2px solid #dadada;
    padding: 25px;
    border-radius: 10px;
  }

  .repeat-group-container.error-is {
    border: 2px solid #ff675f;
  }
</style>
