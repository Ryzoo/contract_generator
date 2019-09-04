<template>
    <v-col>
        <v-row>
            <v-col align="end">
                <v-btn :to="{ name: 'createAgreement' }" color="primary">
                    {{$t("pageMeta.panel.agreements.button.newAgreement")}}
                </v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col xs="12">
                <v-data-table
                    class="elevation-2"
                    :headers="headers"
                    :items="items">
                    <template v-slot:item.action="{ item }">
                        <div class="table-icons">
                            <v-icon>fa-edit</v-icon>
                            <v-icon>fa-trash</v-icon>
                        </div>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>
    </v-col>
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
                    value: "action",
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

<style scoped></style>
