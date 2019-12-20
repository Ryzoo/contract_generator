<template>
    <section>
<!--        TODO: Create other settings for variable-->
        <template v-for="setting in settingsList">
          <v-checkbox
            hide-details
            v-if="setting === 'required'"
            :label="$t('form.variableForm.isRequired')"
            @change="saveInput($event, setting)"
          />
          <v-text-field  hide-details v-if="setting === 'lengthMin' || setting === 'lengthMax'" :label="setting === 'lengthMin'  ? $t('form.variableForm.lengthMin') : $t('form.variableForm.lengthMax')"
                        @change="saveInput($event, setting)" outline/>
        </template>
    </section>
</template>

<script>
    export default {
        props: ["settings"],
        name: "VariableSettings",
        data () {
            return {
                settingsList: Object.keys(this.settings)
            }
        },
        watch: {
          settings(value) {
              this.settingsList = Object.keys(value)
          }
        },
        methods: {
            saveInput(value, setting) {
                this.$emit("save", {name: setting, value});
            }
        }
    }
</script>

<style scoped>

</style>
