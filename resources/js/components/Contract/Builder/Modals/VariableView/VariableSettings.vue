<template>
  <section>
    <template v-for="setting in settingsList">
      <v-checkbox
        :key="setting"
        hide-details
        v-if="setting === 'required'"
        :label="$t('form.variableForm.isRequired')"
        @change="saveInput($event, setting)"
      />
      <v-checkbox
        :key="setting"
        hide-details
        v-if="setting === 'isMultiSelect'"
        :label="$t('form.variableForm.isMultiSelect')"
        @change="saveInput($event, setting)"
      />
      <v-text-field
        :key="setting"
        hide-details
        v-if="setting === 'lengthMin' || setting === 'lengthMax'"
        :label="setting === 'lengthMin' ? $t('form.variableForm.lengthMin') : $t('form.variableForm.lengthMax')"
        @change="saveInput($event, setting)"
        outline/>
      <v-text-field
        :key="setting"
        hide-details
        v-if="setting === 'valueMin' || setting === 'valueMax'"
        :label="setting === 'valueMin' ? $t('form.variableForm.valueMin') : $t('form.variableForm.valueMax')"
        @change="saveInput($event, setting)"
        outline/>
    </template>
  </section>
</template>

<script>
export default {
  props: ['settings'],
  name: 'VariableSettings',
  // TODO: How should looks items from multi select and for all attributes 'value'
  data () {
    return {
      settingsList: Object.keys(this.settings),
      required: 0,
      lengthMin: 0,
      lengthMax: 0,
      valueMin: 0,
      valueMax: 0,
      isMultiSelect: 0
    }
  },
  watch: {
    settings (value) {
      this.settingsList = Object.keys(value)
    }
  },
  methods: {
    saveInput (value, setting) {
      this.$emit('save', { name: setting, value })
    }
  },
  mounted () {
    this.settingsList.forEach((setting) => {
      this.$emit('save', { name: setting, value: this[setting] })
    })
  }
}
</script>
