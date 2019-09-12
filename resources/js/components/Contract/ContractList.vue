<template>
    <v-col>
        <v-row>
            <v-card v-if="contractItems.length || isLoading" width="100%">
                <v-list v-if="!isLoading">
                    <v-list-item-group>
                        <v-list-item
                            v-for="item in contractItems"
                            :key="item.id"
                            @click="emitSelectContract(item)"
                        >
                            <v-list-item-content>
                                <v-list-item-title
                                    v-text="item.name"
                                ></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>
                <loader v-else></loader>
            </v-card>
            <v-alert
                v-if="!isLoading && !contractItems.length"
                width="100%"
                type="error"
            >
                Brak umów!
            </v-alert>
        </v-row>
    </v-col>
</template>

<script>
export default {
    name: "ContractList",
    data: () => ({
        contractItems: [],
        isLoading: false
    }),
    methods: {
        emitSelectContract(selectedContract) {
            this.$emit("selected", selectedContract);
        },
        getContractList() {
            this.isLoading = true;
            axios
                .get("/contract")
                .then(response => {
                    this.contractItems = response.data;
                })
                .finally(() => {
                    this.isLoading = false;
                });
        }
    },
    mounted() {
        this.getContractList();
    }
};
</script>

<style scoped></style>
