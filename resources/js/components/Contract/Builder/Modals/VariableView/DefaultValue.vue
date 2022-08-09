<template>
  <section>
    <v-text-field
      v-if="acceptedType([type.TEXT, type.BOOL_INPUT, type.DATE, type.TIME])"
      :hide-details="!acceptedType([type.DATE, type.TIME])"
      dense
      outlined
      v-model="currentValue"
      :label="$t('form.variableForm.defaultValue')"
      :hint="
        acceptedType([type.DATE, type.TIME])
          ? $t('form.variableForm.defaultValueHint.dateTime')
          : ''
      "
      outline
    />
    <v-text-field
      v-if="acceptedType(type.NUMBER)"
      hide-details
      dense
      outlined
      type="number"
      v-model="currentValue"
      :label="$t('form.variableForm.defaultValue')"
      outline
    />
    <v-autocomplete
      v-if="acceptedType([type.SELECT])"
      :label="$t('form.variableForm.defaultValue')"
      hide-details
      dense
      :items="items"
      outlined
      small-chips
      :multiple="isMultiSelect"
      clearable
      deletable-chips
      v-model="currentValue"
    />
    <v-switch
      v-if="acceptedType([type.BOOL])"
      outlined
      hide-details
      dense
      v-model="currentValue"
      :label="
        $t('form.variableForm.defaultValue') +
        ': ' +
        (!!currentValue).toString()
      "
    />
    <currency-select
      v-if="acceptedType([type.CURRENCY])"
      :label="$t('form.variableForm.defaultValue')"
      v-model="currentValue"
    />
  </section>
</template>

<script>
import { AttributeTypeEnum } from "../../../../../additionalModules/Enums";
import CurrencySelect from "../../../../common/CurrencySelect";

export default {
  name: "DefaultValue",
  components: { CurrencySelect },
  props: ["attributeData", "value"],
  data() {
    return {
      isMultiSelect: !!this.attributeData.settings.isMultiSelect,
      items: this.attributeData.settings.items || [],
      type: AttributeTypeEnum,
      currentValue: this.value,
    };
  },
  watch: {
    attributeData(newValue) {
      this.items = newValue.settings.items || [];
      this.isMultiSelect = !!this.attributeData.settings.isMultiSelect;
      if (
        this.isMultiSelect &&
        !Array.isArray(this.currentValue && this.acceptedType(this.type.SELECT))
      ) {
        this.currentValue = [];
      }
      if (
        !this.isMultiSelect &&
        Array.isArray(this.currentValue && this.acceptedType(this.type.SELECT))
      ) {
        this.currentValue = null;
      }
    },
    value(newValue) {
      this.currentValue = newValue;
    },
    currentValue() {
      this.update();
    },
  },
  methods: {
    acceptedType(types) {
      if (Array.isArray(types)) {
        return types.some(
          (x) => parseInt(x) === parseInt(this.attributeData.attributeType)
        );
      }
      return parseInt(types) === parseInt(this.attributeData.attributeType);
    },
    update() {
      this.$emit("input", this.currentValue);
    },
  },
};
</script>
