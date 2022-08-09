<template>
    <currency-select
        v-model="currentValue"
        :label="attribute.attributeName"
        :placeholder="attribute.placeholder || ' '"
        :error="!attribute.isValid"
        :error-messages="attribute.errorMessage"
        :hint="attribute.labelAfter"
        persistent-placeholder
        :show-details="true"
        :persistent-hint="!!attribute.labelAfter"
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
    </currency-select>
</template>

<script>
import CurrencySelect from '../../../common/CurrencySelect'
export default {
    name: 'CurrencyAttribute',
    components: { CurrencySelect },
    props: ['attribute', 'outside'],
    data() {
        return {
            currentValue: this.attribute.value || this.attribute.defaultValue,
        }
    },
    watch: {
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
    methods: {
        resetForm() {
            this.currentValue = this.attribute.defaultValue
        },
    },
}
</script>

<style scoped></style>
