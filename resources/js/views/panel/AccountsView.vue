<template>
    <v-row>
        <v-col v-if="isLoaded">
            <v-row>
                <v-col align="end">
                    <v-btn :to="{ name: 'createAccount' }" color="primary">
                        {{ $t("page.panel.accounts.button.newAccount") }}
                    </v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col xs="12">
                    <v-data-table
                        class="elevation-2"
                        :headers="headers"
                        :items="items">
                        <template v-slot:item.name="{ item }">
                            <router-link :to="`/panel/account/${item.id}`">
                                {{ item.firstName }} {{ item.lastName }}
                            </router-link>
                        </template>
                        <template v-slot:item.action="{ item }">
                            <div class="table-icons">
                                <v-icon @click="$router.push(`/panel/accounts/${item.id}/edit`)">fa-edit</v-icon>
                                <v-icon @click="tryToRemoveAccount(item.id)">fa-trash</v-icon>
                            </div>
                        </template>
                    </v-data-table>
                </v-col>
            </v-row>
        </v-col>
        <loader v-else></loader>

        <v-dialog
            persistent
            v-model="deleteDialog"
            max-width="290"
        >
            <v-card>
                <v-card-title class="headline">{{
                    $t("page.panel.accounts.description.removeTitle")
                }}</v-card-title>

                <v-card-text>
                    {{ $t("page.panel.accounts.description.remove") }}
                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn
                        color="primary"
                        text
                        @click="deleteDialog = false"
                    >
                        {{ $t("page.panel.accounts.button.cancel") }}
                    </v-btn>
                    <v-btn
                        color="error"
                        @click="removeAccount"
                    >
                        {{$t("page.panel.accounts.button.remove")}}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
export default {
    name: "AccountsView",
    components: {},
    data() {
        return {
            deleteDialog: false,
            isLoaded: true,
            headers: [
                {
                    text: this.$t("page.panel.accounts.headers.name"),
                    value: "name"
                },
                {
                    text: this.$t("page.panel.accounts.headers.email"),
                    value: "email"
                },
                {
                    text: this.$t("page.panel.accounts.headers.role"),
                    value: "role"
                },
                {
                    text: this.$t("page.panel.accounts.headers.created_at"),
                    value: "created_at"
                },
                {
                    text: this.$t("page.panel.accounts.headers.actions"),
                    value: "action",
                    sortable: false
                }
            ],
            items: [],
            removeUserId: null
        };
    },
    methods: {
        tryToRemoveAccount(id) {
            this.removeUserId = id;
            this.deleteDialog = true;
        },
        removeAccount() {
            this.isLoaded = false;
            axios
                .delete(`/user/${this.removeUserId}`)
                .then(response => {
                    this.items = this.items.filter(
                        e => e.id != this.removeUserId
                    );
                    this.removeUserId = null;
                    this.deleteDialog = false;
                    notify.push(
                        this.$t("page.panel.accounts.notify.successRemove"),
                        notify.SUCCESS
                    );
                })
                .finally(() => {
                    this.isLoaded = true;
                });
        },
        getUserList() {
            this.isLoaded = false;
            axios
                .get("/user")
                .then(response => {
                    this.items = response.data;
                })
                .finally(() => {
                    this.isLoaded = true;
                });
        }
    },
    mounted() {
        this.getUserList();
    }
};
</script>

<style scoped></style>
