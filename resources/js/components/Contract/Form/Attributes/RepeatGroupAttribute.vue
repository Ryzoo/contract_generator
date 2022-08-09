<template>
  <v-row
    :class="
      'group-attribute' + (!attribute.isValid ? ' group-attribute-invalid' : '')
    "
  >
    <h3>{{ attribute.attributeName }}</h3>
    <v-alert type="error" v-if="!attribute.isValid" dense class="ma-1 mx-auto">
      {{ attribute.errorMessage }}
    </v-alert>
    <v-col
      cols="12"
      v-for="(attribute, index) in attributesList"
      :key="index + ' ' + lastLength"
    >
      <component
        :outside="true"
        :is="Mapper.getAttributeComponentName(attribute.attributeType)"
        :attribute="attribute"
        @change-value="changeValue"
      />
    </v-col>
  </v-row>
</template>

<script>
import NumberAttribute from "./NumberAttribute";
import TextAttribute from "./TextAttribute";
import SelectAttribute from "./SelectAttribute";
import BoolInputAttribute from "./BoolInputAttribute";
import BoolAttribute from "./BoolAttribute";
import DateAttribute from "./DateAttribute";
import TimeAttribute from "./TimeAttribute";
import CurrencyAttribute from "./CurrencyAttribute";

export default {
  name: "RepeatGroupAttribute",
  props: ["attribute", "outside"],
  components: {
    NumberAttribute,
    TextAttribute,
    SelectAttribute,
    BoolAttribute,
    DateAttribute,
    TimeAttribute,
    BoolInputAttribute,
    CurrencyAttribute,
  },
  data() {
    return {
      lastLength: 1,
      activeCount: 0,
      attributeValue: [...this.attribute.defaultValue],
    };
  },
  computed: {
    attributesList() {
      return this.attributeValue.filter((x) => x.isActive);
    },
  },
  watch: {
    attribute(newValue) {
      if (newValue.settings.isMultiUse) {
        this.attributeValue = [...newValue.value[0]];
      } else {
        this.attributeValue = [...newValue.value];
      }
      this.lastLength = newValue.settings.isMultiUse
        ? newValue.value.length
        : 1;
      this.activeCount = newValue.settings.isMultiUse
        ? newValue.value[0].filter((x) => x.isActive).length
        : newValue.value.filter((x) => x.isActive).length;
    },
  },
  methods: {
    changeValue(attribute) {
      const newValue = this.attributeValue.map((x) => {
        if (x.id === attribute.id) {
          return {
            ...attribute,
          };
        }
        return {
          ...x,
        };
      });

      if (this.outside) {
        this.$emit("change-value", {
          ...this.attribute,
          value: newValue,
        });
        return;
      }
      this.$store.dispatch("formElements_change_attribute", {
        id: this.attribute.id,
        value: newValue,
      });
    },
    resetForm() {
      this.attributeValue = [...this.attribute.defaultValue];
    },
  },
};
</script>

<style lang="scss">
.group-attribute-invalid {
  border: 2px solid #d73c45 !important;
  & > h3 {
    color: #d73c45 !important;
  }
}
.row.group-attribute {
  border: 1px solid #c7c7c7;
  border-radius: 5px;
  padding-top: 15px;
  position: relative;
  margin: 10px 0;

  & > h3 {
    color: #7d7d7d;
    margin: -30px 8px 0;
    background: white;
    padding: 0 10px;
  }
}
</style>
