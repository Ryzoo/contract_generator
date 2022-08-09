<template>
  <v-row>
    <v-col v-if="isLoaded">
      <v-row>
        <v-col>
          <v-btn :to="{ name: 'createAccount' }" color="primary">
            {{ $t("pages.panel.accounts.buttons.new") }}
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-data-table class="elevation-2" :headers="headers" :items="items">
            <template v-slot:item.name="{ item }">
              <router-link :to="`/panel/settings/accounts/${item.id}`">
                {{ item.firstName }} {{ item.lastName }}
              </router-link>
            </template>
            <template v-slot:item.roles="{ item }">
              <v-chip
                class="ma-1"
                color="primary"
                v-for="role in item.roles"
                :key="role.id"
                small
                label
              >
                {{ role.name }}
              </v-chip>
            </template>
            <template v-slot:item.action="{ item }">
              <div class="table-icons">
                <v-btn
                  color="primary"
                  small
                  @click="
                    $router.push(`/panel/settings/accounts/${item.id}/edit`)
                  "
                >
                  <v-icon small>fa-edit</v-icon>
                  {{ $t("base.button.edit") }}
                </v-btn>
                <v-btn color="error" small @click="tryToRemoveAccount(item.id)">
                  <v-icon small>fa-trash</v-icon>
                  {{ $t("base.button.remove") }}
                </v-btn>
              </div>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-col>
    <loader v-else />

    <v-dialog persistent v-model="deleteDialog" max-width="290">
      <v-card>
        <v-card-title class="headline">{{
          $t("form.accountRemoveForm.title")
        }}</v-card-title>

        <v-card-text>
          {{ $t("base.description.remove") }}
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn color="primary" text @click="deleteDialog = false">
            {{ $t("base.button.cancel") }}
          </v-btn>
          <v-btn color="error" @click="removeAccount">
            {{ $t("base.button.remove") }}
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
          text: this.$t("base.headers.name"),
          value: "name",
        },
        {
          text: this.$t("base.headers.email"),
          value: "email",
        },
        {
          text: this.$t("base.headers.roles"),
          value: "roles",
        },
        {
          text: this.$t("base.headers.created"),
          value: "created_at",
        },
        {
          text: this.$t("base.headers.actions"),
          value: "action",
          sortable: false,
          width: "100px",
        },
      ],
      items: [],
      removeUserId: null,
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
        .then((response) => {
          this.items = this.items.filter((e) => e.id !== this.removeUserId);
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
        .then((response) => {
          this.items = response.data;
        })
        .finally(() => {
          this.isLoaded = true;
        });
    },
  },
  mounted() {
    this.getUserList();
  },
};
</script>

<style scoped></style>
