<template>
    <v-flex xs12>
        <v-layout v-if="isLoaded" row wrap>
            <v-flex xs12>
                <v-layout row wrap class="justify-end">
                    <v-btn :to="{ name: 'createAccount' }" color="primary">
                        {{$t("page.panel.accounts.button.newAccount")}}
                    </v-btn>
                </v-layout>
            </v-flex>
            <v-flex xs12 mt-4>
                <v-data-table :headers="headers" :items="items">
                    <template v-slot:items="props">
                        <td>
                            <router-link :to="`/panel/account/${props.item.id}`">{{ props.item.firstName }} {{
                                props.item.lastName }}
                            </router-link>
                        </td>
                        <td>{{ props.item.email }}</td>
                        <td>{{ getRoleName(props.item.role) }}</td>
                        <td>{{ props.item.created_at }}</td>
                        <td>
                            <div class="table-icons">
                                <font-awesome-icon icon="edit"/>
                                <font-awesome-icon icon="trash"/>
                            </div>
                        </td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
        <loader v-else></loader>
    </v-flex>
</template>

<script>

  export default {
    name: "AccountsView",
    components: {},
    data() {
      return {
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
            sortable: false
          }
        ],
        items: []
      };
    },
    methods: {
      getUserList() {

        this.isLoaded = false;
        axios.get("/user")
            .then((response) => {
              this.items = response.data;
            })
            .finally(() => {
              this.isLoaded = true;
            })
      }
    },
    mounted() {
      this.getUserList();
    }
  };
</script>

<style scoped></style>
