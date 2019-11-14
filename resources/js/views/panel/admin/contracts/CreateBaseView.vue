<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
                <v-card class="pb-3" v-if="isLoaded">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title class="white--text">{{ $t("form.contractAddForm.title") }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                            prepend-icon="fa-file-signature"
                            v-model="contract.name"
                            :label="$t('form.contractAddForm.field.contract_name')"
                            @change="saveContractDataToStore"
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
                            {{ $t("base.button.back") }}
                        </v-btn>
                        <v-btn
                            outlined
                            @click="saveAndExit"
                            color="primary">
                            {{ $t("base.button.save_exit") }}
                        </v-btn>
                        <v-btn
                            @click="saveAndBuild"
                            color="primary">
                            {{ $t("base.button.save_build") }}
                        </v-btn>
                    </v-card-actions>
                </v-card>
                <loader v-else></loader>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
  import ContractModuleConfiguration from "../../../../components/Contract/New/ContractModuleConfiguration";

  export default {
    name: "CreateBaseView",
    components: {
      ContractModuleConfiguration
    },
    data() {
      return {
        isLoaded: false,
        contract: [],
        contractId: this.$route.params.id || null
      }
    },
    methods: {
      init() {
        this.contract = this.$store.getters.getNewContractData;
      },
      saveContractDataToStore(value) {
        this.$store.dispatch("newContract_setName", value);
      },
      cancelAddContract() {
        this.$store.dispatch("newContract_clear");
        this.$router.push("/panel/admin/contracts");
      },
      saveAndExit() {
        this.saveContract(() => {
          this.$store.dispatch("newContract_clear");
          this.$router.push("/panel/admin/contracts");
        });
      },
      saveAndBuild() {
        this.saveContract((res) => {
          this.$store.dispatch("newContract_setUpdate", {
            id: res.data.id,
            ...this.$store.getters.getNewContractData
          });
          this.$router.push("/panel/admin/contracts/builder");
        });
      },
      saveContract(callback) {
        this.isLoaded = false;
        const isEditMode = this.contractId !== null;
        let request = null;

        if (isEditMode) {
          request = axios.put(`/contract/${this.contractId}`, this.$store.getters.getNewContractData);
        }
        else {
          request = axios.post(`/contract`, this.$store.getters.getNewContractData);
        }

        request.then(response => {
          notify.push(
              this.$t("form.contractAddForm.notify.success"),
              notify.SUCCESS
          );
          if (callback) {
            callback(response);
          }
        })
            .finally(() => {
              this.isLoaded = true;
            });
      },
      loadContract(callback) {
        this.isLoaded = false;
        axios.get(`/contract/${this.contractId}`)
            .then(response => {
              this.$store.dispatch("newContract_setUpdate", response.data)
                  .then(() => {
                    this.isLoaded = true;
                    this.init();
                  })
            });
      }
    },
    mounted() {
      if (this.$route.params.id !== undefined) {
        this.loadContract()
      }
      else {
        this.isLoaded = true;
        this.init();
      }
    }
  }
</script>

<style scoped>

</style>
