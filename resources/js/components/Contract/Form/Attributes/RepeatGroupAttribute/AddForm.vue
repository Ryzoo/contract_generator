<template>
  <section>
    <v-col cols="12" class="mb-0 pb-0">
      <component
        ref="addForm"
        :is="Mapper.getAttributeComponentName(this.attribute.attributeType)"
        :attribute="this.attribute"
      >
      </component>
    </v-col>
    <v-col
      cols="12"
      class="mt-0 pt-0"
      v-if="!!this.attribute.settings.isMultiUse"
    >
      <v-btn
        dense
        color="primary"
        :disabled="!this.attribute.isValid"
        class="ma-auto"
        small
        @click="addValue"
        >{{ $t("base.button.addElement") }}</v-btn
      >
    </v-col>
  </section>
</template>

<script>
import NumberAttribute from "../../Attributes/NumberAttribute";
import TextAttribute from "../../Attributes/TextAttribute";
import SelectAttribute from "../../Attributes/SelectAttribute";
import RepeatGroupAttribute from "../../Attributes/RepeatGroupAttribute";
import BoolAttribute from "../../Attributes/BoolAttribute";
import DateAttribute from "../../Attributes/DateAttribute";
import TimeAttribute from "../../Attributes/TimeAttribute";
import BoolInputAttribute from "../../Attributes/BoolInputAttribute";
import CurrencyAttribute from "../../Attributes/CurrencyAttribute";

export default {
  name: "AddForm",
  props: ["attribute"],
  components: {
    NumberAttribute,
    TextAttribute,
    SelectAttribute,
    RepeatGroupAttribute,
    BoolAttribute,
    DateAttribute,
    TimeAttribute,
    BoolInputAttribute,
    CurrencyAttribute,
  },
  data() {
    return {
      lastValue: {
        newValue: null,
        isValid: false,
      },
    };
  },
  methods: {
    addValue() {
      this.$store.dispatch("formElements_add_attribute_row", this.attribute.id);
      this.$refs.addForm.resetForm();
    },
  },
};
</script>

<style lang="scss">
.repeat-group-add .col {
  padding-bottom: 0 !important;
}
</style>
