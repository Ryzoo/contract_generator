<template>
    <div class="table-container">
        <v-data-table :headers="headers" :items="items">
            <template slot="headerCell" slot-scope="props">
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <span class="header-text" v-on="on">
                            {{ props.header.text }}
                        </span>
                    </template>
                    <span>
                        {{ props.header.text }}
                    </span>
                </v-tooltip>
            </template>
            <template v-slot:items="props">
                <td>{{ props.item.name }}</td>
                <td
                    v-bind:class="{
                        'success--text': props.item.active,
                        'error--text': !props.item.active
                    }"
                >
                    {{ props.item.status }}
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
    </div>
</template>

<script>
export default {
    name: "Table",
    props: ["headers", "items"],
    data: () => {
        return {};
    },
    methods: {},
    mounted: function() {}
};
</script>

<style lang="scss">
.table-container {
    .theme--light.v-table {
        background-color: transparent;
    }
    .theme--light.v-table tbody tr:not(:last-child) {
        border-bottom: none;
        background-color: white;
    }
    .v-datatable__progress {
        height: 20px !important;
    }
    .theme--light.v-datatable .v-datatable__actions {
        border-top: none;
    }
    .theme--light.v-table thead tr:first-child {
        border-bottom: none;
        background-color: white;
        border-radius: 5px;
    }
    table.v-table tbody tr {
        background-color: white;
    }
    .table-container table.v-table tbody tr:before {
        content: "";
        display: block;
        height: 15px;
    }
    .v-datatable {
        margin-top: 20px;
    }
    .header-text {
        font-size: 14px;
        font-weight: 600;
    }
    table.v-table tbody td {
        color: #919191;
        font-size: 14px;
    }
    .table-icons > *:hover {
        cursor: pointer;
    }
}
</style>
