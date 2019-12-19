<template>
  <v-col sm="12" :class="{'repeat-group-container': true, 'error-is': validationError}">
    <h3>{{attribute.attributeName}}
      <v-tooltip right>
        <template v-slot:activator="{ on }">
          <v-icon color="primary" dark v-on="on">fa-question-circle</v-icon>
        </template>
        <span>{{attribute.additionalInformation}}</span>
      </v-tooltip>
    </h3>
    <small>{{attribute.description}}</small>
    <v-divider class="my-3"/>
    <small class="error--text" v-if="validationError">{{validationError}}</small>
    <v-divider class="my-3"/>
    <AddForm @add="addValue" :attributes="attribute.content"/>
    <v-divider class="my-3"/>
    <ValueList @remove="removeElement" :values="valueList"/>
  </v-col>
</template>

<script>
  import AddForm from "./RepeatGroupAttribute/AddForm";
  import ValueList from "./RepeatGroupAttribute/ValueList";

  export default {
    name: "RepeatGroupAttribute",
    props: ["attribute", "validationError"],
    components: {
      AddForm,
      ValueList
    },
    data() {
      return {
        valueList: [],
      }
    },
    watch: {
      attribute(attribute) {
        this.valueList = attribute.value ? attribute.value : []
      }
    },
    methods: {
      addValue(newValue) {
        this.valueList.push(newValue);
        this.changeValue();
      },
      removeElement(element) {
        this.valueList = this.valueList.filter(x => x !== element);
        this.changeValue();
      },
      changeValue() {
        this.$emit("change-value", this.valueList);
      }
    }
  }
</script>

<style scoped>
  .repeat-group-container {
    border: 2px solid #dadada;
    padding: 25px;
    border-radius: 10px;
  }

  .repeat-group-container.error-is {
    border: 2px solid #ff675f;
  }
</style>
