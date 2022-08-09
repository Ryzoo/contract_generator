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
            <v-text-field
                hide-details
                dense
                outlined
                type="number"
                v-model="settingsData.valueMin"
                :label="$t('form.variableForm.valueMin')"
                @change="update"
            />
        </v-col>
        <v-col cols="12">
            <v-text-field
                hide-details
                dense
                outlined
                type="number"
                v-model="settingsData.valueMax"
                :label="$t('form.variableForm.valueMax')"
                @change="update"
            />
        </v-col>
        <v-col cols="12">
            <v-checkbox
                hide-details
                dense
                outlined
                v-model="settingsData.renderFloatAsText"
                label="Render float as text?"
                @change="update"
            />
        </v-col>
    </v-row>
</template>

<script>
export default {
    name: 'NumberAttribute',
    props: ['settings'],
    data() {
        return {
            settingsData: {
                ...this.settings,
            },
        }
    },
    watch: {
        settings(newValue) {
            if (
                JSON.stringify(newValue) !== JSON.stringify(this.settingsData)
            ) {
                this.settingsData = {
                    ...newValue,
                }
            }
        },
    },
    methods: {
        update() {
            this.$emit('save', this.settingsData)
        },
    },
}
</script>

<style scoped></style>
