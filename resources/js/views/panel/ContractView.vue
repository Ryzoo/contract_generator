<template>
    <v-col v-if="isLoaded">
        <v-row>
            <v-col align="start">
                <v-btn v-if="multiSelectedItems.length > 0" @click="tryToRemoveContract(multiSelectedItems.map(e=>e.id))"
                       color="error">
                    Delete selected
                </v-btn>
                <v-btn :to="{ name: 'createContract' }" color="primary">
                    {{ $t("page.panel.contracts.button.newAgreement") }}
                </v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col xs="12">
                <v-data-table
                    class="elevation-2"
                    :headers="headers"
                    show-select
                    v-model="multiSelectedItems"
                    item-key="id"
                    :items="contractItems"
                >
                    <template v-slot:item.action="{ item }">
                        <div class="table-icons">
                            <v-icon>fa-edit</v-icon>
                            <v-icon @click="tryToRemoveContract([item.id])">fa-trash</v-icon>
                        </div>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>

        <v-dialog persistent v-model="deleteDialog" max-width="290">
            <v-card>
                <v-card-title class="headline"
                >{{ $t("page.panel.contracts.description.removeTitle") }}
                </v-card-title>

                <v-card-text>
                    {{ $t("page.panel.contracts.description.remove") }}
                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="primary" text @click="deleteDialog = false">
                        {{ $t("page.panel.contracts.button.cancel") }}
                    </v-btn>
                    <v-btn color="error" @click="removeContract">
                        {{ $t("page.panel.contracts.button.remove") }}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-col>
    <loader v-else></loader>
</template>

<script>
  export default {
    name: "AgreementsView",
    data: function () {
      return {
        multiSelectedItems: [],
        headers: [
          {
            text: this.$t("page.panel.contracts.headers.name"),
            value: "name"
          },
          {
            text: this.$t("page.panel.contracts.headers.dateAdd"),
            value: "created_at"
          },
          {
            text: this.$t("page.panel.contracts.headers.actions"),
            value: "action",
            sortable: false
          }
        ],
        contractItems: [],
        isLoaded: false,
        removeContractId: null,
        deleteDialog: false
      };
    },
    methods: {
      tryToRemoveContract(idArray) {
        this.removeContractId = idArray;
        this.deleteDialog = true;
      },
      removeContract() {
        this.isLoaded = false;
        const idList = this.removeContractId.join(",");
        axios
            .delete(`/contract?idList=${idList}`)
            .then(response => {

              this.removeContractId.map(x => {
                this.contractItems = this.contractItems.filter(
                    e => e.id != x
                );
              });

              this.removeContractId = null;
              this.deleteDialog = false;
              notify.push(
                  this.$t("page.panel.contracts.notify.successRemove"),
                  notify.SUCCESS
              );
            })
            .finally(() => {
              this.isLoaded = true;
            });
      },
      getContractList() {
        this.isLoaded = false;
        axios
            .get("/contract")
            .then(response => {
              this.contractItems = response.data;
            })
            .finally(() => {
              this.isLoaded = true;
            });
      }
    },
    mounted() {
      this.getContractList();
    }
  };
</script>

<style scoped></style>
