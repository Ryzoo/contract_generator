<template>
  <v-row>
    <v-col cols="12" v-for="setting in filteredSettingsList" :key="setting">
      <v-checkbox
        class="mt-0"
        :key="setting"
        hide-details
        dense
        outlined
        :input-value="settings.required"
        v-if="setting === 'required'"
        :label="$t('form.variableForm.isRequired')"
        @change="saveInput(!!$event, setting)"
      />
      <v-checkbox
        class="mt-0"
        :key="setting"
        hide-details
        dense
        outlined
        :input-value="settings.isMultiSelect"
        v-if="setting === 'isMultiSelect'"
        :label="$t('form.variableForm.isMultiSelect')"
        @change="saveInput(!!$event, setting)"
      />
      <v-text-field
        :key="setting"
        hide-details
        dense
        outlined
        type="number"
        :value="setting === 'lengthMin' ? settings.lengthMin : settings.lengthMax"
        v-if="setting === 'lengthMin' || setting === 'lengthMax'"
        :label="setting === 'lengthMin' ? $t('form.variableForm.lengthMin') : $t('form.variableForm.lengthMax')"
        @change="saveInput(parseInt($event), setting)"
      />
      <v-text-field
        :key="setting"
        hide-details
        dense
        outlined
        type="number"
        :value="setting === 'valueMin' ? settings.valueMin : settings.valueMax"
        v-if="setting === 'valueMin' || setting === 'valueMax'"
        :label="setting === 'valueMin' ? $t('form.variableForm.valueMin') : $t('form.variableForm.valueMax')"
        @change="saveInput(parseInt($event), setting)"
      />
    </v-col>
  </v-row>
</template>

<script>
export default {
  props: ['settings', 'currentSettings'],
  name: 'VariableSettings',
  data () {
    return {
      settingsList: Object.keys(this.currentSettings),
      availableSettings: [
        'valueMin', 'valueMax',
        'lengthMin', 'lengthMax',
        'isMultiSelect', 'required'
      ]
    }
  },
  watch: {
    currentSettings (value) {
      this.settingsList = Object.keys(value)
    }
  },
  computed: {
    filteredSettingsList () {
      return this.settingsList.filter(x => this.availableSettings.includes(x))
    }
  },
  methods: {
    saveInput (value, name) {
      this.$emit('save', {
        name,
        value
      })
    }
  }
}
</script>
