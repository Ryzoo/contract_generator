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
export default {
  name: 'RepeatGroupAttribute',
  props: ['settings'],
  computed: {
    selectedAttributes () {
      return this.settingsData.attributes ? this.settingsData.attributes.map((x) => ({
        text: x.attributeName,
        value: x.id
      })) : []
    },
    attributesToAggregate () {
      return this.$store.getters.builder_allVariables
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
    changeAttributes (newValue) {
      const listOfAttributes = []

      newValue.forEach(x => {
        const attributes = this.attributesToAggregate.find(a => a.id === x)
        if (attributes) { listOfAttributes.push(attributes) }
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
