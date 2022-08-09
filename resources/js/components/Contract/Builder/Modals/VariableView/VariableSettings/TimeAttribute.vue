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
    </v-row>
</template>

<script>
export default {
    name: 'TimeAttribute',
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
