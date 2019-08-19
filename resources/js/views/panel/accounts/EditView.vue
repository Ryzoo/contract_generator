<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
                <v-card class="pb-3">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title class="white--text">{{$t('form.accountEditForm.title')}} - {{user.email}}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text v-if="isLoaded">
                        <v-form>
                            <v-layout row wrap>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-text-field
                                        prepend-icon="person"
                                        v-model="user.firstName"
                                        :label="$t('form.accountEditForm.field.firstName')"
                                        required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-text-field
                                        prepend-icon="person"
                                        v-model="user.lastName"
                                        :label="$t('form.accountEditForm.field.lastName')"
                                        required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-select
                                        prepend-icon="verified_user"
                                        v-model="user.role"
                                        :label="$t('form.accountEditForm.field.role')"
                                        :items="roleList"
                                        required
                                    ></v-select>
                                </v-flex>
                                <v-flex xs12>
                                    <v-layout row wrap class="justify-end">
                                        <v-btn color="primary" flat="flat" @click="$router.push('/panel/accounts')" >
                                            {{ $t("form.accountEditForm.button.prev") }}
                                        </v-btn>
                                        <v-btn color="success" @click="saveAccount()">
                                            {{ $t("form.accountEditForm.button.save") }}
                                        </v-btn>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-form>
                    </v-card-text>
                    <loader v-else></loader>
                </v-card>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
import {UserRoleEnum} from "../../../additionalModules/Enums";

export default {
    name: "CreateAccountsView",
    data: function() {
        return {
          accountId: this.$route.params.id,
          isLoaded: true,
          userRoles: UserRoleEnum,
          user: {
            firstName: null,
            lastName: null,
            email: null,
            role: null,
          },
          roleList: []
        };
    },
    methods: {
      saveAccount(){
        try {
          let validationArray = [];

          validationArray[
              this.$t("form.accountEditForm.field.firstName")
              ] = this.user.firstName;
          validationArray[
              this.$t("form.accountEditForm.field.lastName")
              ] = this.user.lastName;
          validationArray[
              this.$t("form.accountEditForm.field.role")
              ] = this.user.role;

          let valid = new window.Validator(validationArray);

          valid
              .get(this.$t("form.accountEditForm.field.firstName"))
              .length(3, 50);
          valid
              .get(this.$t("form.accountEditForm.field.lastName"))
              .length(3, 50);
          valid
              .get(this.$t("form.accountEditForm.field.role"))
              .isBetween(0,1);

        } catch (e) {
          return;
        }

        this.isLoaded = false;
        axios
            .put(`/user/`+this.accountId, this.user)
            .then(response => {
              notify.push(
                  this.$t("form.accountEditForm.notify.success"),
                  notify.SUCCESS
              );
              this.$router.push("/panel/accounts");
            })
            .finally(() => {
              this.isLoaded = true;
            });
      },
      loadAccount(){
        this.isLoaded = false;
        axios
            .get(`/user/`+this.accountId,)
            .then(response => {
              this.user = {
                firstName: response.data.firstName,
                lastName: response.data.lastName,
                email: response.data.email,
                role: response.data.role.toString(),
              };
            })
            .catch(()=>{
              this.$router.push("/panel/accounts");
            })
            .finally(() => {
              this.isLoaded = true;
            });
      }
    },
    mounted() {
      for (let i in this.userRoles) {
        this.roleList.push({
              text: this.getRoleName(this.userRoles[i]),
              value: this.userRoles[i]
        });
      }

      this.loadAccount();
    }
};
</script>

<style scoped lang="scss">
</style>
