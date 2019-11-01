<template>
    <section>
        <h3>Auth provider some options to determine client access. Choose one:</h3>
        <v-divider class="my-3"></v-divider>
        <v-row>
            <v-col class="d-flex" cols="12" >
                <v-select
                    :items="items"
                    v-model="actualAuthType"
                    label="Authorization options"
                ></v-select>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    v-if="actualAuthType === AuthType.PASSWORD"
                    v-model="password"
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
    data(){
      return {
        AuthType: AuthType,
        items: [
          {text: "Access for all", value: AuthType.ALL},
          {text: "Access for logged user", value: AuthType.LOGIN},
          {text: "Access with password", value: AuthType.PASSWORD},
        ],
        actualAuthType: AuthType.ALL,
        password: ""
      }
    },
    methods:{
      saveConfig(){
        console.log("TODO: save config to store and add possibility to load default value from config");
      }
    },
  }
</script>

<style scoped>

</style>
