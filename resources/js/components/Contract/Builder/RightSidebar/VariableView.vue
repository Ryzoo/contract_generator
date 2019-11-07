<template>
    <section>
        <div class="options-section-1">
            <span class="sub-title">Konfiguracja zmiennej</span>
            <div class="w-50">
                <v-select
                    :items="variableOptions"
                    label="Typ"
                    outlined
                    color="primary"
                    dense
                    :value="attribute.attributeType"
                >
                </v-select>
                <v-text-field v-model="attribute.attributeName" label="Nazwa" outline></v-text-field>
            </div>
            <v-checkbox
                v-model="attribute.settings.required"
                label="Czy wymagane"
            ></v-checkbox>
            <v-text-field v-model="attribute.settings.lengthMin" label="Min" outline></v-text-field>
            <v-text-field v-model="attribute.settings.lengthMax" label="Max" outline></v-text-field>
            <div class="block-button">
                <v-btn color="primary" @click="saveVariable()">Zapisz</v-btn>
            </div>
        </div>
        <div class="options-section-2">
            <span class="sub-title">Dodaj zmienną</span>
            <div class="builder-elements">
                <div class="select-options">
                    <div class="w-50">
                        <v-select
                            :items="variableOptions"
                            label="Typ"
                            outlined
                            color="primary"
                            dense
                            :value="attribute.attributeType"
                        >
                        </v-select>
                        <v-text-field v-model="attribute.attributeName" label="Nazwa"
                                      outline></v-text-field>
                    </div>
                    <v-text-field v-model="conditional" label="Warunek" outline></v-text-field>
                    <div class="block-button">
                        <v-btn color="primary" @click="saveVariable()">Dodaj zmienną</v-btn>
                    </div>
                </div>
            </div>
        </div>
        <div class="options-section-3">
            <span class="sub-title">Lista zmiennych</span>
            <div class="builder-elements">
<!--                TODO: Load into inputs variable settings when click-->
                <div v-for="attribute in attributesList" class="variables-list">
                    <span class="variable">{{attribute.attributeName}}</span>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
  import Selector from "../../../../additionalModules/StaticSelectors";

  export default {
    name: "VariableView",
    data(){
      return {
        variableOptions: Selector.VariableType,
        attribute: {
          attributeName: "",
          id: this.$store.getters.builder_getVariableId,
          attributeType: "",
          defaultValue: "",
          placeholder: "",
          settings: {
            required: "",
            lengthMin: "",
            lengthMax: ""
          }
        },
        conditional: "",
        attributesList: []
      }
    },
    mounted() {
      this.attributesList = this.$store.getters.builder_allVariables;
    },
    methods:{
      saveVariable() {
        this.attributesList.push(this.attribute);
        this.$store.dispatch("builder_setVariable", this.attributesList);
        this.$store.dispatch("builder_idVariableIncrement");

        this.attribute = {
          attributeName: "",
          id: this.$store.getters.builder_getVariableId,
          attributeType: "",
          defaultValue: "",
          placeholder : "",
          settings: {
            required: "",
            lengthMin: "",
            lengthMax: ""
          }
        }

      },
    }
  }
</script>

<style scoped>

</style>
