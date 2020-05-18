<template>
  <v-text-field
    v-model="number"
    dense
    outlined
    type="number"
    :hide-details="!showDetails"
    :label="label"
    @change="changeNumber"
    :placeholder="placeholder"
    :error="error"
    :error-messages="errorMessages"
    :hint="hint"
    :persistent-hint="persistentHint"
  >
    <template v-slot:append-outer>
      <v-select
        v-model="currency"
        :items="listOfCurrency"
        menu-props="auto"
        label="Currency"
        dense
        outlined
        :hide-details="!showDetails"
        prepend-icon="fas fa-globe-americas"
        single-line
        @change="changeCurrency"
      />
      <slot name="append-outer"/>
    </template>
  </v-text-field>
</template>

<script>
export default {
  name: 'CurrencySelect',
  props: [
    'value',
    'label',
    'showDetails',
    'placeholder',
    'error',
    'errorMessages',
    'hint',
    'persistentHint'
  ],
  data () {
    return {
      number: this.value ? this.value.number : null,
      currency: this.value ? this.value.currency : null,
      listOfCurrency: [
        'PLN', 'USD'
      ]
    }
  },
  watch: {
    value (newValue) {
      this.number = newValue ? newValue.number : null
      this.currency = newValue ? newValue.currency : null
    }
  },
  methods: {
    changeNumber (value) {
      this.$emit('input', {
        number: value,
        currency: this.currency
      })
    },
    changeCurrency (value) {
      this.$emit('input', {
        number: this.number,
        currency: value
      })
    }

  }
}
</script>

<style lang="scss">
  .v-input__append-outer{
    margin: 0 0 0 10px !important;
  }
</style>
