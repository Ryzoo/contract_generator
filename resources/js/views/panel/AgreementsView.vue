<template>
    <section>
        <v-container>
            <v-flex xs12>
                <div class="action-button">
                    <v-btn color="primary">{{
                        $t("pageMeta.panel.agreements.button.newAgreement")
                    }}</v-btn>
                </div>
            </v-flex>
            <v-flex xs12 mt-4>
                <c-table :headers="headers" :items="items" />
            </v-flex>
        </v-container>
    </section>
</template>

<script>
import Table from "../../components/Table";

export default {
    components: {
        "c-table": Table
    },
    name: "AgreementsView",
    data: () => {
        return {
            headers: [
                {
                    text: "Nazwa",
                    value: "name"
                },
                {
                    text: "Status",
                    value: "status"
                },
                {
                    text: "Data dodania",
                    value: "date_add"
                },
                {
                    text: "Akcje",
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
    }
};
</script>

<style scoped>
.action-button {
    display: flex;
    justify-content: right;
}
</style>
