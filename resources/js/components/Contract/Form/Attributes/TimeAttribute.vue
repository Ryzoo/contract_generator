<template>
  <v-col cols="12">
    <v-dialog
      ref="dialog"
      v-model="timeDialog"
      :return-value.sync="time"
      persistent
      width="290px"
    >
      <template v-slot:activator="{ on }">
        <v-text-field
          v-model="time"
          :label="attribute.attributeName"
          :placeholder="attribute.placeholder ? String(attribute.placeholder) : ''"
          :error="validationError.length > 0"
          :error-messages="validationError"
          :hint="attribute.description"
          :persistent-hint="!!attribute.description"
          outlined
          :dense="dense"
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
        v-model="time"
        scrollable
      >
        <v-spacer></v-spacer>
        <v-btn outlined color="primary" @click="timeDialog = false">{{ $t('base.button.cancel') }}</v-btn>
        <v-btn color="primary" @click="()=>{changeValue(time)}">{{ $t('base.button.save') }}</v-btn>
      </v-time-picker>
    </v-dialog>
  </v-col>
</template>

<script>
export default {
  name: 'TimeAttribute',
  props: ['attribute', 'validationError', 'dense'],
  data () {
    return {
      timeDialog: false,
      time: this.attribute.value
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
