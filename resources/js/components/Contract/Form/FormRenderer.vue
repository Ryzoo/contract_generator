<template>
    <v-form>
        <v-container>
            <component
                v-for="(formElement, index) in formElements"
                v-if="formElement.isActive"
                :key="index"
                :is="Mapper.getElementFormComponentName(formElement.elementType)"
                v-bind="{
                    formElement: Object.assign({},formElement)
                }"
            >
            </component>
        </v-container>
    </v-form>
</template>

<script>
  import {ConditionalEnum} from "../../../additionalModules/Enums";
  import AttributeFormElements from "./FormElements/AttributeFormElements";

  export default {
    name: "FormRenderer",
    props: ["formElements"],
    components:{
      AttributeFormElements
    },
    data() {
      return {
        ConditionalEnum: ConditionalEnum
      }
    }
  }
</script>

<style scoped>

</style>
