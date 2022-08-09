<template>
    <v-col v-if="isLoaded">
        <v-row>
            <v-col align="start">
                <v-btn
                    v-if="multiSelectedItems.length > 0"
                    @click="
                        tryToRemoveContract(multiSelectedItems.map((e) => e.id))
                    "
                    color="error"
                >
                    <v-icon small>fa-trash</v-icon>
                    {{ $t('base.button.remove') }}
                </v-btn>
                <v-btn @click="newContract" color="primary">
                    {{ $t('pages.panel.contracts.buttons.new_contract') }}
                </v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-data-table
                    class="elevation-2"
                    :headers="headers"
                    show-select
                    v-model="multiSelectedItems"
                    item-key="id"
                    :items="contractItems"
                >
                    <template v-slot:item.isAvailable="{ item }">
                        <v-btn
                            small
                            v-if="item.isAvailable"
                            color="success"
                            @click="makeContractOffline(item.id)"
                        >
                            <v-icon small>fas fa-power-off</v-icon>
                        </v-btn>
                        <v-btn
                            small
                            v-else
                            color="error"
                            @click="makeContractOnline(item.id)"
                        >
                            <v-icon small>fas fa-power-off</v-icon>
                        </v-btn>
                    </template>
                    <template v-slot:item.action="{ item }">
                        <div class="table-icons">
                            <v-btn
                                small
                                color="primary"
                                @click="goToEdit(item.id)"
                            >
                                <v-icon small>fa-edit</v-icon>
                                {{ $t('base.button.edit') }}
                            </v-btn>
                            <v-btn
                                small
                                color="error"
                                @click="tryToRemoveContract([item.id])"
                            >
                                <v-icon small>fa-trash</v-icon>
                                {{ $t('base.button.remove') }}
                            </v-btn>
                        </div>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>

        <v-dialog persistent v-model="deleteDialog" max-width="290">
            <v-card>
                <v-card-title class="headline">
                    {{ $t('form.removeContractForm.title') }}
                </v-card-title>

                <v-card-text>
                    {{ $t('base.description.remove') }}
                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="primary" text @click="deleteDialog = false">
                        {{ $t('base.button.cancel') }}
                    </v-btn>
                    <v-btn color="error" @click="removeContract">
                        {{ $t('base.button.remove') }}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-col>
    <loader v-else />
</template>

<script>
export default {
    name: 'AgreementsView',
    data: function () {
        return {
            multiSelectedItems: [],
            headers: [
                {
                    text: this.$t('base.headers.isAvailable'),
                    value: 'isAvailable',
                    width: '50px',
                },
                {
                    text: this.$t('base.headers.name'),
                    value: 'name',
                },
                {
                    text: this.$t('base.headers.created'),
                    value: 'created_at',
                },
                {
                    text: this.$t('base.headers.actions'),
                    value: 'action',
                    sortable: false,
                    width: '100px',
                },
            ],
            contractItems: [],
            isLoaded: false,
            removeContractId: null,
            deleteDialog: false,
        }
    },
    methods: {
        newContract() {
            this.$store.dispatch('newContract_clear').then(() => {
                this.$router.push({ name: 'createContract' })
            })
        },
        tryToRemoveContract(idArray) {
            this.removeContractId = idArray
            this.deleteDialog = true
        },
        removeContract() {
            this.isLoaded = false
            const idList = this.removeContractId.join(',')
            axios
                .delete(`/contract?idList=${idList}`)
                .then((_) => {
                    this.contractItems = this.contractItems.filter(
                        (e) => !this.removeContractId.includes(e.id)
                    )

                    this.removeContractId = null
                    this.multiSelectedItems = []
                    this.deleteDialog = false
                    notify.push(this.$t('base.notify.remove'), notify.SUCCESS)
                })
                .finally(() => {
                    this.isLoaded = true
                })
        },
        getContractList() {
            this.isLoaded = false
            axios
                .get('/contract')
                .then((response) => {
                    this.contractItems = response.data
                })
                .finally(() => {
                    this.isLoaded = true
                })
        },
        goToEdit(id) {
            this.$router.push(`/panel/contracts/builder/${id}`)
        },
        makeContractOffline(id) {
            this.isLoaded = false
            axios
                .put(`/contract/${id}/status/offline`)
                .then((_) => {
                    this.contractItems = this.contractItems.map((x) => {
                        if (x.id === id) {
                            return {
                                ...x,
                                isAvailable: false,
                            }
                        }
                        return x
                    })
                })
                .finally(() => {
                    this.isLoaded = true
                })
        },
        makeContractOnline(id) {
            this.isLoaded = false
            axios
                .put(`/contract/${id}/status/online`)
                .then((_) => {
                    this.contractItems = this.contractItems.map((x) => {
                        if (x.id === id) {
                            return {
                                ...x,
                                isAvailable: true,
                            }
                        }
                        return x
                    })
                })
                .finally(() => {
                    this.isLoaded = true
                })
        },
    },
    mounted() {
        this.getContractList()
    },
}
</script>

<style scoped />
