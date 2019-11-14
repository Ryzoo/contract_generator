<template>
    <v-row align="center" justify="center">
        <v-col xs="12" sm="10" lg="8">
            <v-card>
                <v-toolbar dark color="primary">
                    <v-toolbar-title class="white--text">
                        {{ $t("form.accountEditForm.title") }} - {{ email }}
                    </v-toolbar-title>
                </v-toolbar>
                <v-card-text v-if="isLoaded">
                    <v-form>
                        <v-container>
                            <v-row>
                                <v-col sm="12" md="6" class="pa-1">
                                    <v-text-field
                                        prepend-icon="fa-user-edit"
                                        v-model="user.firstName"
                                        :label="$t('base.field.firstName')"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col sm="12" md="6" class="pa-1">
                                    <v-text-field
                                        prepend-icon="fa-user-edit"
                                        v-model="user.lastName"
                                        :label="$t('base.field.lastName')"
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row align="end" justify="end">
                                <v-btn
                                    color="primary"
                                    text
                                    @click="$router.push('/panel/admin/accounts')"
                                >
                                    {{ $t("base.button.back") }}
                                </v-btn>
                                <v-btn color="success" @click="saveAccount()">
                                    {{ $t("base.button.save") }}
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-form>
                </v-card-text>
                <loader v-else></loader>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>

  export default {
    name: "CreateAccountsView",
    data: function () {
      return {
        accountId: this.$route.params.id,
        isLoaded: true,
        email: null,
        user: {
          firstName: null,
          lastName: null
        }
      };
    },
    methods: {
      saveAccount() {
        try {
          let validationArray = [];

          validationArray[this.$t("base.field.firstName")] = this.user.firstName;
          validationArray[this.$t("base.field.lastName")] = this.user.lastName;

          let valid = new window.Validator(validationArray);

          valid.get(this.$t("base.field.firstName"))
              .length(3, 50);

          valid.get(this.$t("base.field.lastName"))
              .length(3, 50);

        }
        catch (e) {
          return;
        }

        this.isLoaded = false;

        axios.put(`/user/` + this.accountId, this.user)
            .then(response => {
              notify.push(
                  this.$t("form.accountEditForm.notify.success"),
                  notify.SUCCESS
              );
              this.$router.push("/panel/admin/accounts");
            })
            .finally(() => {
              this.isLoaded = true;
            });
      },
      loadAccount() {
        this.isLoaded = false;

        axios.get(`/user/` + this.accountId)
            .then(response => {
              this.user = {
                firstName: response.data.firstName,
                lastName: response.data.lastName,
              };

              this.email = response.data.email
            })
            .catch(() => {
              this.$router.push("/panel/admin/accounts");
            })
            .finally(() => {
              this.isLoaded = true;
            });
      }
    },
    mounted() {
      this.loadAccount();
    }
  };
</script>

<style scoped lang="scss"></style>
