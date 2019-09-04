<template>
    <v-form>
        <v-container>
            <v-row>
                <component
                    v-if="ConditionalParser.validate(ConditionalEnum.SHOW_ON, item)"
                    v-for="item in attributes"
                    :key="item.id"
                    :is="Mapper.getAttributeComponentName(item.attributeType)"
                    v-bind="{
                        attribute: item
                    }"
                >
                </component>
            </v-row>
        </v-container>
    </v-form>
</template>

<script>
    import {ConditionalEnum} from "../../../additionalModules/Enums";
    import NumberAttribute from "./Attributes/NumberAttribute";

  export default {
    name: "FormRenderer",
    props: ["attributes"],
    components:{
      NumberAttribute
    },
    data(){
      return {
        ConditionalEnum: ConditionalEnum
      }
    },
    watch: {
      attributes(oldValue, newValue) {
        console.log(oldValue, newValue);
      }
    },
    methods: {
      validateIsShowed( attribute ){

      }
    }
  }
</script>

<style scoped>

</style>
