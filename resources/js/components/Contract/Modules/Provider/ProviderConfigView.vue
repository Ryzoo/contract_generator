<template>
    <section>
        <h3>THis module determine hom the rendered contract should be provided to user</h3>
        <v-divider class="my-3"></v-divider>
        <v-row>
            <v-col class="d-flex" cols="12" >
                <v-select
                    :items="items"
                    v-model="settings.type"
                    label="Provide options"
                ></v-select>
            </v-col>
        </v-row>
    </section>
</template>

<script>
  import {ContractProviderType} from "./Enums";

  export default {
    name: "ProviderConfigView",
    props: ["module"],
    data(){
      return {
        ContractProviderType: ContractProviderType,
        items: [
          {text: "Render after finish", value: ContractProviderType.RENDER},
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
