<template>
    <section>
        <h3>Auth provide some options to determine client access. Choose one:</h3>
        <v-divider class="my-3"></v-divider>
        <v-row>
            <v-col class="d-flex" cols="12" >
                <v-select
                    :items="items"
                    v-model="settings.type"
                    label="Authorization options"
                ></v-select>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    v-if="settings.type === AuthType.PASSWORD"
                    v-model="settings.password"
                    required
                    hide-details
                    type="password"
                    label="Password to access"
                ></v-text-field>
            </v-col>
        </v-row>
    </section>
</template>

<script>

  import {AuthType} from "./Enums";

  export default {
    name: "AuthConfigView",
    props: ["module"],
    data(){
      return {
        AuthType: AuthType,
        items: [
          {text: "Access for all", value: AuthType.ALL},
          {text: "Access for logged user", value: AuthType.LOGIN},
          {text: "Access with password", value: AuthType.PASSWORD},
        ],
        settings: this.$store.getters.getModuleSettings(this.module.name) || this.module.settings
      }
    },
    methods:{
      saveConfig(){
        this.$store.dispatch("newContract_saveModuleConfig",{
          name: this.module.name,
          value: this.settings
        });
      }
    }
  }
</script>

<style scoped>

</style>
