<template>
  <v-card>
    <v-card-title>{{isNewAttribute ? "Add new variable" : "Edit variable"}}</v-card-title>
    <v-divider/>
    <v-card-text>
      <v-col sm="12">
        <v-select
          :items="variableOptions"
          label="Typ"
          outlined
          dense
          hide-details
          color="primary"
          v-model="attribute.attributeType"
          @change="setSettingsForType"
        />
      </v-col>

      <v-row v-if="attribute.attributeType > -1">
        <v-col sm="12">
          <v-text-field v-model="attribute.attributeName" label="Nazwa" outline/>
        </v-col>
        <v-col sm="12">
          <v-text-field v-model="attribute.placeholder" label="Placeholder" outline/>
        </v-col>
        <v-col sm="12">
          <v-text-field v-model="attribute.description" label="Opis" outline/>
        </v-col>
        <v-col sm="12">
          <v-text-field v-model="attribute.defaultValue" label="Domyślna wartość" outline/>
        </v-col>
        <v-col sm="12">
          <v-text-field v-model="attribute.additionalInformation" label="Dodatkowe informacje" outline/>
        </v-col>
        <v-col sm="12">
          <v-checkbox label="Czy pole ma być anonimowe" v-model="attribute.toAnonymize"/>
        </v-col>
        <v-col sm="12">
          <VariableSettings
            :settings="attribute.settings"
            @save="saveSettingsInput"
          />
        </v-col>
      </v-row>
    </v-card-text>

    <v-card-actions>
      <v-spacer/>
      <v-btn color="primary" outlined @click="pushCloseEvent">Cancel</v-btn>
      <v-btn color="primary" @click="saveVariable">{{isNewAttribute ? "Create" : "Save"}}</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  import VariableSettings from "./VariableSettings";

  export default {
    name: "CreateEditVariable",
    props:[
      'attributesList', 'editAttribute', 'isNewAttribute'
    ],
    components: {
      VariableSettings
    },
    data() {
      return {
        variableOptions: [],
        attribute: this.editAttribute || this.getDefaultAttribute(),
        allAttributes: [],
      }
    },
    watch: {
      editAttribute(newValue){
        this.attribute = this.editAttribute || this.getDefaultAttribute()
      }
    },
    mounted() {
      this.getAllAttributes();
    },
    methods: {
      pushCloseEvent() {
        this.$emit('close');
      },
      getAllAttributes() {
        axios.get("elements/attributes")
          .then((res) => {
            this.allAttributes = res.data;
            this.variableOptions = res.data.map(x => {
              return {
                value: x.attributeType,
                text: x.attributeName
              }
            })
          })
      },
      editVariable(attribute) {
        this.isNewAttribute = false;
        this.attribute = attribute;
      },
      saveSettingsInput(inputData) {
        this.attribute.settings[inputData.name] = inputData.value;
      },
      setSettingsForType() {
        this.attribute.settings = this.getSettingsForType(this.attribute.attributeType);
      },
      getSettingsForType(type) {
        let attributeType = this.allAttributes.find(x => x.attributeType === type);
        return attributeType ? attributeType.settings : [];
      },
      getDefaultAttribute() {
        return {
          attributeName: "",
          id: this.$store.getters.builder_getVariableId,
          attributeType: -1,
          defaultValue: "",
          additionalInformation: "",
          placeholder: "",
          description: "",
          toAnonymize: "",
          settings: {}
        }
      },
      saveVariable() {
        let isNew = true;

        this.attributesList.map((attribute) => {
          if (attribute.id === this.attribute.id) {
            attribute = this.attribute;
            isNew = false;
          }

          return attribute;
        });

        if (isNew) {
          this.attributesList.push(this.attribute);
        }
        this.$store.dispatch("builder_setVariable", this.attributesList);
        this.$store.dispatch("builder_idVariableIncrement");

        this.attribute = this.getDefaultAttribute();
        this.$emit('close');
      }
    }
  }
</script>

<style scoped lang="scss"/>
