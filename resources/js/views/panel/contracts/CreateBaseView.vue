<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
                <v-card class="pb-3" v-if="!isLoaded">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title class="white--text">Dodawanie nowej umowy</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                            prepend-icon="fa-file-signature"
                            v-model="contract.name"
                            label="Nazwa umowy"
                            required
                        ></v-text-field>
                        <ContractModuleConfiguration/>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            @click="cancelAddContract"
                            color="primary">
                            Anuluj
                        </v-btn>
                        <v-btn
                            outlined
                            @click="saveAndExit"
                            color="primary">
                            Zapisz i wyjdź
                        </v-btn>
                        <v-btn
                            @click="saveAndBuild"
                            color="primary">
                            Zapisz i przejdź do budowy
                        </v-btn>
                    </v-card-actions>
                </v-card>
                <loader v-else></loader>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
  import ContractModuleConfiguration from "../../../components/Contract/New/ContractModuleConfiguration";

  export default {
    name: "CreateBaseView",
    components: {
      ContractModuleConfiguration
    },
    data() {
      return {
        isLoaded: false,
        contract: {
          name: ""
        }
      }
    },
    methods: {
      cancelAddContract() {
        this.$router.push("/panel/contracts");
      },
      saveAndExit(){
        this.$router.push("/panel/contracts");
      },
      saveAndBuild(){
        this.$router.push("/panel/contracts/create");
      }
    }
  }
</script>

<style scoped>

</style>
