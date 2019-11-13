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
                    v-model="attribute.attributeType"
                    @change="setSettingsForType"
                >
                </v-select>
                <v-text-field v-model="attribute.attributeName" label="Nazwa" outline></v-text-field>
                <v-text-field v-model="attribute.placeholder" label="Placeholder" outline></v-text-field>
                <v-text-field v-model="attribute.description" label="Opis" outline></v-text-field>
                <v-text-field v-model="attribute.defaultValue" label="Domyślna wartość" outline></v-text-field>
                <v-text-field v-model="attribute.additionalInformation" label="Dodatkowe informacje" outline></v-text-field>
                <v-checkbox label="Czy pole ma być anonimowe" v-model="attribute.toAnonymize"></v-checkbox>
            </div>

            <VariableSettings
                :settings="attribute.settings"
                @save="saveSettingsInput"
            />
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
                            v-model="attribute.attributeType"
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
    import VariableSettings from "./VariableView/VariableSettings";

    export default {
        name: "VariableView",
        components: {
            VariableSettings
        },
        data() {
            return {
                variableOptions: [],
                attribute: this.getDefaultAttribute(),
                conditional: "",
                attributesList: [],
                allAttributes: []
            }
        },
        mounted() {
            this.getAllAttributes();
            this.attributesList = this.$store.getters.builder_allVariables;
        },
        methods: {
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
                this.attributesList.push(this.attribute);
                this.$store.dispatch("builder_setVariable", this.attributesList);
                this.$store.dispatch("builder_idVariableIncrement");

                this.attribute = this.getDefaultAttribute();

            },
        }
    }
</script>

<style scoped>

</style>
