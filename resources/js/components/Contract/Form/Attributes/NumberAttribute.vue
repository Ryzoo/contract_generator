<template>
    <v-text-field
            :label="attribute.attributeName"
            :placeholder="attribute.placeholder"
            :error="!attribute.isValid"
            :error-messages="attribute.errorMessage"
            v-model="currentValue"
            type="number"
            outlined
            dense
        >
            <template v-slot:append-outer v-if="attribute.additionalInformation && attribute.additionalInformation.length > 0">
                <v-tooltip right>
                    <template v-slot:activator="{ on }">
                        <v-icon color="primary" dark v-on="on">fa-question-circle</v-icon>
                    </template>
                    <span>{{attribute.additionalInformation}}</span>
                </v-tooltip>
            </template>
        </v-text-field>
</template>

<script>
export default {
  name: 'NumberAttribute',
  props: ['attribute', 'outside'],
  data () {
    return {
      currentValue: this.attribute.settings.defaultValue
    }
  },
  watch: {
    currentValue (newValue) {
      if (this.outside) {
        this.$emit('change-value', {
          ...this.attribute,
          value: parseFloat(newValue)
        })
        return
      }
      this.$store.dispatch('formElements_change_attribute', {
        id: this.attribute.id,
        value: parseFloat(newValue)
      })
    }
  },
  methods: {
    resetForm () {
      this.currentValue = this.attribute.settings.defaultValue
    }
  }
}
</script>

<style scoped>

</style>
