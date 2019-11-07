<template>
    <v-row>
        <component
            :is="Mapper.getAttributeComponentName(formElement.attribute.attributeType)"
            v-bind="{
                attribute: formElement.attribute,
                validationError: validationError
            }"
            @change-value="changeValue"
        >
        </component>
    </v-row>
</template>

<script>
  import NumberAttribute from "./../Attributes/NumberAttribute";
  import TextAttribute from "./../Attributes/TextAttribute";
  import SelectAttribute from "../Attributes/SelectAttribute";
  import AttributeValidator from "../Validators/AttributeValidator";
  import RepeatGroupAttribute from "../Attributes/RepeatGroupAttribute";

  export default {
    name: "AttributeFormElements",
    props: ["formElement"],
    components: {
      NumberAttribute,
      TextAttribute,
      SelectAttribute,
      RepeatGroupAttribute
    },
    data() {
      return {
        validationError: ""
      }
    },
    methods: {
      changeValue(newValue) {
        const isValidValue = this.isValid(newValue);

        let thisElement = Object.assign({}, this.formElement);

        thisElement.isValid = isValidValue;

        if (newValue) {
          thisElement.attribute.value = newValue;
        }

        this.$store.dispatch('formElements_change', {
          element: thisElement
        });
      },
      isValid(newValue, showError) {
        let validatorResult = AttributeValidator.validate(this.formElement.attribute, newValue);
        this.validationError = validatorResult.errorMessage;
        return validatorResult.status;
      }
    },
    mounted() {
      this.changeValue(this.formElement.attribute.defaultValue);
    }
  }
</script>

<style scoped>

</style>
