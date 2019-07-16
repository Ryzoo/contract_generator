<template>
    <v-layout row wrap>
        <v-flex xs12>
            <v-layout row wrap class="justify-end">
                <v-btn :to="{ name: 'createAgreement' }" color="primary">{{
                    $t("pageMeta.panel.agreements.button.newAgreement")
                }}</v-btn>
            </v-layout>
        </v-flex>
        <v-flex xs12 mt-4>
            <v-data-table :headers="headers" :items="items">
                <template v-slot:items="props">
                    <td>{{ props.item.name }}</td>
                    <td>
                        <span
                            :class="{
                                'success--text': props.item.active,
                                'error--text': !props.item.active
                            }"
                        >
                            {{ props.item.status }}
                        </span>
                    </td>
                    <td>
                        {{ props.item.date_add }}
                    </td>
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
</template>

<script>
export default {
    name: "AgreementsView",
    data: function() {
        return {
            headers: [
                {
                    text: this.$t("pageMeta.panel.agreements.headers.name"),
                    value: "name"
                },
                {
                    text: this.$t("pageMeta.panel.agreements.headers.status"),
                    value: "status"
                },
                {
                    text: this.$t("pageMeta.panel.agreements.headers.dateAdd"),
                    value: "date_add"
                },
                {
                    text: this.$t("pageMeta.panel.agreements.headers.actions"),
                    sortable: false
                }
            ],
            items: [
                {
                    name: "Umowa wynajmu",
                    status: "Aktywna",
                    date_add: "05-06-2019",
                    active: 1
                },
                {
                    name: "Odwołanie dpd",
                    status: "Nie aktywna",
                    date_add: "08-06-2019",
                    active: 0
                }
            ]
        };
    },
    mounted() {}
};
</script>

<style scoped>
</style>
