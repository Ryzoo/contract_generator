<template>
    <section>
<!--        TODO: Create other settings for variable-->
        <template v-for="setting in settingsList">
            <v-checkbox
                v-if="setting === 'required'"
                :label="setting"
                @change="saveInput($event, setting)"
            ></v-checkbox>
            <v-text-field v-if="setting === 'lengthMin' || setting === 'lengthMax'" :label="setting" @change="saveInput($event, setting)" outline></v-text-field>
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
