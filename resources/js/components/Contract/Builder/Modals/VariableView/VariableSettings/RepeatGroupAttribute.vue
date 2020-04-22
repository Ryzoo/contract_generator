<template>
  <v-row>
    <v-col cols="12">
      <v-select
        :items="attributesToAggregate.map((x) => ({
          text: x.attributeName,
          value: x.id
        }))"
        :value="selectedAttributes"
        :label="$t('form.variableForm.selectVariables')"
        multiple
        chips
        deletable-chips
        hide-details
        dense
        outlined
        @change="changeAttributes"
      ></v-select>
    </v-col>
    <v-col cols="12">
      <v-checkbox
        hide-details
        dense
        outlined
        v-model="settingsData.required"
        :label="$t('form.variableForm.isRequired')"
        @change="update"
      />
    </v-col>
  </v-row>
</template>

<script>
import { AttributeTypeEnum } from '../../../../../../additionalModules/Enums'
export default {
  name: 'RepeatGroupAttribute',
  props: ['settings', 'noStore', 'attributes'],
  computed: {
    selectedAttributes () {
      return this.settingsData.attributes ? this.settingsData.attributes.map((x) => ({
        text: x.attributeName,
        value: parseInt(x.id)
      })) : []
    },
    attributesToAggregate () {
      return this.attributes.filter((x) => x.attributeType !== AttributeTypeEnum.ATTRIBUTE_GROUP && !(x.settings.isMultiUse))
    }
  },
  data () {
    return {
      settingsData: {
        ...this.settings
      }
    }
  },
  watch: {
    settings (newValue) {
      if (JSON.stringify(newValue) !== JSON.stringify(this.settingsData)) {
        this.settingsData = {
          ...newValue
        }
      }
    }
  },
  methods: {
    editVariable (attribute) {
      this.$emit('edit', attribute)
    },
    changeAttributes (newValue) {
      const listOfAttributes = []

      if (newValue.length < this.settingsData.attributes.length) {
        const removedAttributes = this.settingsData.attributes.map(x => x.id).filter(x => !newValue.includes(x))
        if (!this.noStore) this.$store.dispatch('builder_attributes_clearConditionals', removedAttributes)
        else {
          this.settingsData.attributes
            .filter(x => !newValue.includes(x.id))
            .forEach(attribute => {
              this.editVariable({
                ...attribute,
                conditionals: [],
                isInGroup: false
              })
            })
        }
      }

      newValue.forEach(x => {
        const attributes = this.attributesToAggregate.find(a => a.id === x)

        if (attributes) {
          attributes.isInGroup = true
          listOfAttributes.push(attributes)
          if (this.noStore) {
            this.editVariable({
              ...attributes
            })
          }
        }
      })

      this.settingsData.attributes = [
        ...listOfAttributes
      ]

      this.update()
    },
    update () {
      this.$emit('save', this.settingsData)
    }
  }
}
</script>

<style scoped>

</style>
