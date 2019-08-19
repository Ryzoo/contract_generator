<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12>
                <v-layout row wrap class="justify-end">
                    <v-btn :to="{ name: 'createAccount' }" color="primary">
                        {{ $t("page.panel.accounts.button.newAccount") }}
                    </v-btn>
                </v-layout>
            </v-flex>
            <v-flex xs12 mt-4>
                <v-data-table :headers="headers" :items="items">
                    <template v-slot:items="props">
                        <td>
                            <router-link :to="`/panel/account/${props.item.id}`"
                                >{{ props.item.firstName }}
                                {{ props.item.lastName }}</router-link
                            >
                        </td>
                        <td>{{ props.item.email }}</td>
                        <td>{{ props.item.role }}</td>
                        <td>{{ props.item.created_at }}</td>
                        <td>
                            <div class="table-icons">
                                <font-awesome-icon icon="edit" />
                                <font-awesome-icon icon="trash" />
                            </div>
                        </td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
export default {
    name: "AccountsView",
    components: {},
    data() {
        return {
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
                    sortable: false
                }
            ],
            items: [
                {
                    id: 0,
                    firstName: "Grzegorz",
                    lastName: "Kastelik",
                    email: "g.kastelik@gmail.com",
                    role: "0",
                    created_at: "2019-07-03 22:01:19"
                }
            ]
        };
    }
};
</script>

<style scoped></style>
