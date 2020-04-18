<template>
  <v-dialog
    ref="dialog"
    v-model="timeDialog"
    :return-value.sync="currentValue"
    persistent
    width="290px"
  >
    <template v-slot:activator="{ on }">
      <v-text-field
        v-model="currentValue"
        :label="attribute.attributeName"
        :placeholder="attribute.placeholder"
        :error="!attribute.isValid"
        :error-messages="attribute.errorMessage"
        :required="attribute.settings.required"
        outlined
        dense
        prepend-icon="far fa-clock"
        readonly
        v-on="on"
      >
        <template v-slot:append-outer
                  v-if="attribute.additionalInformation && attribute.additionalInformation.length > 0">
          <v-tooltip right>
            <template v-slot:activator="{ on }">
              <v-icon color="primary" dark v-on="on">fa-question-circle</v-icon>
            </template>
            <span>{{attribute.additionalInformation}}</span>
          </v-tooltip>
        </template>
      </v-text-field>
    </template>
    <v-time-picker
      v-model="currentValue"
      scrollable
    >
      <v-spacer></v-spacer>
      <v-btn outlined color="primary" @click="timeDialog = false">{{ $t('base.button.cancel') }}</v-btn>
      <v-btn color="primary" @click="()=>{$refs.dialog.save(currentValue)}">{{ $t('base.button.save') }}</v-btn>
    </v-time-picker>
  </v-dialog>
</template>

<script>

export default {
  name: 'TimeAttribute',
  props: ['attribute', 'outside'],
  data () {
    return {
      timeDialog: false,
      currentValue: this.attribute.settings.defaultValue
    }
  },
  methods: {
    resetForm () {
      this.currentValue = this.attribute.settings.defaultValue
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
