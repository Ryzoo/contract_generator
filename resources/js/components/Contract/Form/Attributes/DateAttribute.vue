<template>
  <v-menu
    ref="dialog"
    v-model="dateDialog"
    :close-on-content-click="false"
    transition="scale-transition"
    offset-y
    max-width="290px"
    min-width="290px"
  >
    <template v-slot:activator="{ on }">
      <v-text-field
        v-model="currentValue"
        :label="attribute.attributeName"
        :placeholder="attribute.placeholder"
        :error="!attribute.isValid"
        :hint="attribute.labelAfter"
        :persistent-hint="!!attribute.labelAfter"
        :error-messages="attribute.errorMessage"
        outlined
        dense
        prepend-icon="far fa-calendar-alt"
        readonly
        v-on="on"
      ></v-text-field>
    </template>
    <v-date-picker v-model="currentValue" no-title @input="dateDialog = false"></v-date-picker>
  </v-menu>
</template>

<script>

export default {
  name: 'DateAttribute',
  props: ['attribute', 'outside'],
  data () {
    return {
      dateDialog: false,
      currentValue: this.attribute.value || this.attribute.defaultValue
    }
  },
  methods: {
    resetForm () {
      this.currentValue = this.attribute.defaultValue
    }
  },
  watch: {
    currentValue (newValue) {
      if (this.outside) {
        this.$emit('change-value', {
          ...this.attribute,
          value: newValue
        })
        return
      }
      this.$store.dispatch('formElements_change_attribute', {
        id: this.attribute.id,
        value: newValue
      })
    }
  }
}
</script>
