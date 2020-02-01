<template>
    <v-form>
        <v-container>
            <component
                v-for="(formElement, index) in activeFormElements"
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
import { ConditionalEnum } from '../../../additionalModules/Enums'
import AttributeFormElements from './FormElements/AttributeFormElements'

export default {
  name: 'FormRenderer',
  props: ['formElements'],
  components: {
    AttributeFormElements
  },
  data () {
    return {
      ConditionalEnum: ConditionalEnum
    }
  },
  computed: {
    activeFormElements () {
      return this.formElements.filter(x => x.isActive)
    }
  }
}
</script>

<style scoped>

</style>
