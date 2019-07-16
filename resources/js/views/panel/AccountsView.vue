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
                                <font-awesome-icon @click="tryToRemoveAccount(props.item.id)" icon="trash"/>
                            </div>
                        </td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
        <loader v-else></loader>


        <v-dialog
            v-model="deleteDialog"
            max-width="290"
        >
            <v-card>
                <v-card-title class="headline">{{$t("page.panel.accounts.description.removeTitle")}}</v-card-title>

                <v-card-text>
                    {{$t("page.panel.accounts.description.remove")}}
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        flat="flat"
                        @click="deleteDialog = false"
                    >
                        {{$t("page.panel.accounts.button.cancel")}}
                    </v-btn>

                    <v-btn
                        color="error"
                        flat="flat"
                        @click="removeAccount"
                    >
                        {{$t("page.panel.accounts.button.remove")}}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-flex>
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
            sortable: false
          }
        ],
        items: [],
        removeUserId: null
      };
    },
    methods: {
      tryToRemoveAccount(id){
        this.removeUserId = id;
        this.deleteDialog = true;
      },
      removeAccount() {
        this.isLoaded = false;
        axios.delete(`/user/${this.removeUserId}`)
            .then((response) => {
              this.items = this.items.filter(e=>e.id != this.removeUserId);
              this.removeUserId = null;
              this.deleteDialog = false;
              notify.push(
                  this.$t("page.panel.accounts.notify.successRemove"),
                  notify.SUCCESS
              );
            })
            .finally(() => {
              this.isLoaded = true;
            })
      },
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
