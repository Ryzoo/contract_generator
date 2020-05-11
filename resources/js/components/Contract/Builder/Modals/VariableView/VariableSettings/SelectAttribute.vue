<template>
  <v-row>
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
    <v-col cols="12">
      <v-checkbox
        hide-details
        dense
        outlined
        v-model="settingsData.allowSelfOptions"
        label="Allow self options?"
        @change="update"
      />
    </v-col>
    <v-col cols="12">
      <v-checkbox
        hide-details
        dense
        outlined
        v-model="settingsData.isMultiSelect"
        :label="$t('form.variableForm.isMultiSelect')"
        @change="update"
      />
    </v-col>
    <v-col cols="12" v-if="settingsData.isMultiSelect">
      <v-select
        persistent-hint
        :items="multiRenderTypeItems"
        :hint="$t('form.variableForm.multiRenderTypeHint')"
        hide-details
        dense
        outlined
        v-model="settingsData.listRenderType"
        :label="$t('form.variableForm.multiRenderType')"
        @change="update"
      />
    </v-col>
    <v-col cols="12">
      <v-combobox
        persistent-hint
        :hint="$t('form.variableForm.itemsHint')"
        hide-details
        dense
        outlined
        small-chips
        multiple
        clearable
        deletable-chips
        v-model="settingsData.items"
        :label="$t('form.variableForm.items')"
        @change="update"
      />
    </v-col>
  </v-row>
</template>

<script>
import {MultiUseRenderType} from "../../../../../../additionalModules/Enums";

export default {
  name: 'SelectAttribute',
  props: ['settings'],
  data () {
    return {
      multiRenderTypeItems: [
        {
          text: 'List',
          value: MultiUseRenderType.LIST.toString()
        },
        {
          text: 'Comma separated',
          value: MultiUseRenderType.COMMA_SEPARATED.toString()
        },
        {
          text: 'Table',
          value: MultiUseRenderType.TABLE.toString()
        }
      ],
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
    update () {
      this.$emit('save', this.settingsData)
    }
  }
}
</script>

<style scoped>

</style>
