<template>
    <v-col v-if="isLoaded">
        <v-row>
            <v-col align="start">
                <v-btn v-if="multiSelectedItems.length > 0" @click="tryToRemoveContract(multiSelectedItems.map(e=>e.id))"
                       color="error">
                    Delete selected
                </v-btn>
                <v-btn :to="{ name: 'createContract' }" color="primary">
                    {{ $t("pages.panel.contracts.buttons.new_contract") }}
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
                            <v-icon @click="goToEdit(item.id)">fa-edit</v-icon>
                            <v-icon @click="tryToRemoveContract([item.id])">fa-trash</v-icon>
                        </div>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>

        <v-dialog persistent v-model="deleteDialog" max-width="290">
            <v-card>
                <v-card-title class="headline">
                    {{ $t("form.removeContractForm.title") }}
                </v-card-title>

                <v-card-text>
                    {{ $t("base.description.remove") }}
                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="primary" text @click="deleteDialog = false">
                        {{ $t("base.button.cancel") }}
                    </v-btn>
                    <v-btn color="error" @click="removeContract">
                        {{ $t("base.button.remove") }}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-col>
  <loader v-else/>
</template>

<script>
export default {
  name: 'AgreementsView',
  data: function () {
    return {
      multiSelectedItems: [],
      headers: [
        {
          text: this.$t('base.headers.name'),
          value: 'name'
        },
        {
          text: this.$t('base.headers.created'),
          value: 'created_at'
        },
        {
          text: this.$t('base.headers.actions'),
          value: 'action',
          sortable: false
        }
      ],
      contractItems: [],
      isLoaded: false,
      removeContractId: null,
      deleteDialog: false
    }
  },
  methods: {
    tryToRemoveContract (idArray) {
      this.removeContractId = idArray
      this.deleteDialog = true
    },
    removeContract () {
      this.isLoaded = false
      const idList = this.removeContractId.join(',')
      axios
        .delete(`/contract?idList=${idList}`)
        .then(response => {
          this.removeContractId.map(x => {
            this.contractItems = this.contractItems.filter(
              e => e.id !== x
            )
          })

          this.removeContractId = null
          this.multiSelectedItems = []
          this.deleteDialog = false
          notify.push(
            this.$t('base.notify.remove'),
            notify.SUCCESS
          )
        })
        .finally(() => {
          this.isLoaded = true
        })
    },
    getContractList () {
      this.isLoaded = false
      axios
        .get('/contract')
        .then(response => {
          this.contractItems = response.data
        })
        .finally(() => {
          this.isLoaded = true
        })
    },
    goToEdit (id) {
      this.$router.push(`contracts/edit/${id}`)
    }
  },
  mounted () {
    this.getContractList()
  }
}
</script>

<style scoped></style>
