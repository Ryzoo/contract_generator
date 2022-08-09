<template>
    <v-row class="pa-0 ma-0 d-flex justify-center align-center">
        <v-switch
            class="mr-2"
            :label="boolLabel"
            :placeholder="attribute.placeholder || ' '"
            :error="!attribute.isValid"
            :error-messages="attribute.errorMessage"
            :hint="attribute.labelAfter"
            persistent-placeholder
            :persistent-hint="!!attribute.labelAfter"
            v-model="currentBoolValue"
            :name="attribute.attributeName"
            outlined
            dense
        >
            <template
                v-slot:append-outer
                v-if="
                    attribute.additionalInformation &&
                    attribute.additionalInformation.length > 0
                "
            >
                <v-tooltip right>
                    <template v-slot:activator="{ on }">
                        <v-icon color="primary" dark v-on="on"
                            >fa-question-circle</v-icon
                        >
                    </template>
                    <span>{{ attribute.additionalInformation }}</span>
                </v-tooltip>
            </template>
        </v-switch>
        <v-text-field
            class="input-in-bool"
            v-model="currentInputValue"
            hide-details
            outlined
            :disabled="!currentBoolValue"
            :suffix="inputLabel"
            dense
        >
            <template
                v-slot:append-outer
                v-if="
                    attribute.additionalInformation &&
                    attribute.additionalInformation.length > 0
                "
            >
                <v-tooltip right>
                    <template v-slot:activator="{ on }">
                        <v-icon color="primary" dark v-on="on"
                            >fa-question-circle</v-icon
                        >
                    </template>
                    <span>{{ attribute.additionalInformation }}</span>
                </v-tooltip>
            </template>
        </v-text-field>
    </v-row>
</template>

<script>
export default {
    name: 'BoolInputAttribute',
    props: ['attribute', 'outside'],
    data() {
        return {
            currentBoolValue: this.attribute.defaultValue.value,
            currentInputValue: this.attribute.defaultValue.input,
            boolLabel:
                this.attribute.settings.boolLabel ||
                this.attribute.attributeName,
            inputLabel: this.attribute.settings.inputLabel || '',
            currentValue: {
                ...this.attribute.defaultValue,
            },
        }
    },
    methods: {
        resetForm() {
            this.currentValue = {
                ...this.attribute.defaultValue,
            }
        },
    },
    watch: {
        currentInputValue(newValue) {
            this.currentValue = {
                input: newValue,
                bool: this.currentBoolValue,
            }
        },
        currentBoolValue(newValue) {
            this.currentValue = {
                input: this.currentInputValue,
                bool: newValue,
            }
        },
        currentValue(newValue) {
            if (this.outside) {
                this.$emit('change-value', {
                    ...this.attribute,
                    value: newValue,
                })
                return
            }
            this.$store.dispatch('formElements_change_attribute', {
                id: this.attribute.id,
                value: newValue,
            })
        },
    },
}
</script>
