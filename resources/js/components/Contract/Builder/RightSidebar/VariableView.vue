<template>
    <section>
        <div class="options-section-1">
            <span class="sub-title">{{isNewAttribute ? "Dodaj nową zmienną" : "Edycja zmiennej"}}</span>
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
                <v-text-field v-model="attribute.additionalInformation" label="Dodatkowe informacje"
                              outline></v-text-field>
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
            <span class="sub-title">Lista zmiennych</span>
            <div class="flex-column">
                <v-row class="justify-center mt-2">
                    <v-btn color="primary" @click="resetToDefault">Dodaj nową</v-btn>
                </v-row>
                <v-divider class="my-3"></v-divider>
                <div class="variables-list">
                    <span v-for="attribute in attributesList" class="variable" @click="editAttribute(attribute)">{{attribute.attributeName}}</span>
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
                attributesList: [],
                allAttributes: [],
                isNewAttribute: true,
            }
        },
        mounted() {
            this.getAllAttributes();
            this.attributesList = this.$store.getters.builder_allVariables;
        },
        methods: {
            editAttribute(attribute) {
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
            resetToDefault() {
                this.attribute = this.getDefaultAttribute();
                this.isNewAttribute = true;
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

<style scoped lang="scss">
    .variables-list {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;

        .variable {
            background: #dabd79 0% 0% no-repeat padding-box;
            box-shadow: 0px 3px 6px #dabd79;
            border-radius: 10px;
            color: white;
            padding: 5px;
            margin: 5px;

            &:hover {
                cursor: pointer;
            }
        }
    }

</style>
