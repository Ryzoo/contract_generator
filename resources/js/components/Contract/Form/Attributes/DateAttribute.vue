<template>
  <v-col cols="12">
    <v-dialog
      ref="dialog"
      v-model="dateDialog"
      :return-value.sync="date"
      persistent
      width="290px"
    >
      <template v-slot:activator="{ on }">
        <v-text-field
          v-model="date"
          :label="attribute.attributeName"
          :placeholder="attribute.placeholder ? String(attribute.placeholder) : ''"
          :error="validationError.length > 0"
          :error-messages="validationError"
          :hint="attribute.description"
          :persistent-hint="!!attribute.description"
          outlined
          :dense="dense"
          prepend-icon="far fa-calendar-alt"
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
      <v-date-picker
        v-model="date"
        scrollable
      >
        <v-spacer></v-spacer>
        <v-btn text color="primary" @click="dateDialog = false">{{ $t('base.button.cancel') }}</v-btn>
        <v-btn text color="primary" @click="()=>{changeValue(date)}">{{ $t('base.button.ok') }}</v-btn>
      </v-date-picker>
    </v-dialog>
  </v-col>
</template>

<script>
export default {
  name: 'DateAttribute',
  props: ['attribute', 'validationError', 'dense'],
  data () {
    return {
      dateDialog: false,
      date: this.attribute.value
    }
  },
  methods: {
    changeValue (newValue) {
      this.$refs.dialog.save(newValue)
      this.$emit('change-value', newValue)
    }
  }
}
</script>
