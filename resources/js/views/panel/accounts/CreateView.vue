<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
                <v-card class="pb-3">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title class="white--text">{{
                            $t("form.accountAddForm.title")
                        }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text v-if="isLoaded">
                        <v-form>
                            <v-layout row wrap>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-text-field
                                        prepend-icon="person"
                                        v-model="user.firstName"
                                        :label="
                                            $t(
                                                'form.accountAddForm.field.firstName'
                                            )
                                        "
                                        required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-text-field
                                        prepend-icon="person"
                                        v-model="user.lastName"
                                        :label="
                                            $t(
                                                'form.accountAddForm.field.lastName'
                                            )
                                        "
                                        required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-text-field
                                        prepend-icon="email"
                                        v-model="user.email"
                                        :label="
                                            $t(
                                                'form.accountAddForm.field.email'
                                            )
                                        "
                                        type="email"
                                        required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-select
                                        prepend-icon="verified_user"
                                        v-model="user.role"
                                        :label="
                                            $t('form.accountAddForm.field.role')
                                        "
                                        :items="roleList"
                                        required
                                    ></v-select>
                                </v-flex>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-text-field
                                        prepend-icon="lock"
                                        v-model="user.password"
                                        :label="
                                            $t(
                                                'form.accountAddForm.field.password'
                                            )
                                        "
                                        type="password"
                                    >
                                    </v-text-field>
                                </v-flex>
                                <v-flex xs12 md6 class="pa-1">
                                    <v-text-field
                                        prepend-icon="lock"
                                        v-model="user.rePassword"
                                        :label="
                                            $t(
                                                'form.accountAddForm.field.rePassword'
                                            )
                                        "
                                        type="password"
                                    >
                                    </v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-layout row wrap class="justify-end">
                                        <v-btn
                                            color="primary"
                                            flat="flat"
                                            @click="
                                                $router.push('/panel/accounts')
                                            "
                                        >
                                            {{
                                                $t(
                                                    "form.accountAddForm.button.prev"
                                                )
                                            }}
                                        </v-btn>
                                        <v-btn
                                            color="success"
                                            @click="addAccount()"
                                        >
                                            {{
                                                $t(
                                                    "form.accountAddForm.button.add"
                                                )
                                            }}
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
import { UserRoleEnum } from "../../../additionalModules/Enums";

export default {
    name: "CreateAccountsView",
    data: function() {
        return {
            isLoaded: true,
            userRoles: UserRoleEnum,
            user: {
                firstName: null,
                lastName: null,
                email: null,
                role: null,
                password: null,
                rePassword: null
            },
            roleList: []
        };
    },
    methods: {
        addAccount() {
            try {
                let validationArray = [];

                validationArray[
                    this.$t("form.accountAddForm.field.firstName")
                ] = this.user.firstName;
                validationArray[
                    this.$t("form.accountAddForm.field.lastName")
                ] = this.user.lastName;
                validationArray[
                    this.$t("form.accountAddForm.field.email")
                ] = this.user.email;
                validationArray[
                    this.$t("form.accountAddForm.field.role")
                ] = this.user.role;
                validationArray[
                    this.$t("form.accountAddForm.field.password")
                ] = this.user.password;
                validationArray[
                    this.$t("form.accountAddForm.field.rePassword")
                ] = this.user.rePassword;

                let valid = new window.Validator(validationArray);

                valid
                    .get(this.$t("form.accountAddForm.field.firstName"))
                    .length(3, 50);
                valid
                    .get(this.$t("form.accountAddForm.field.lastName"))
                    .length(3, 50);
                valid.get(this.$t("form.accountAddForm.field.email")).isEmail();
                valid
                    .get(this.$t("form.accountAddForm.field.role"))
                    .isBetween(0, 1);
                valid
                    .get(this.$t("form.accountAddForm.field.password"))
                    .length(6, 50);
                valid
                    .get(this.$t("form.accountAddForm.field.rePassword"))
                    .length(6, 50)
                    .sameAs(this.$t("form.accountAddForm.field.password"));
            } catch (e) {
                return;
            }

            this.isLoaded = false;
            axios
                .post("/user", this.user)
                .then(response => {
                    notify.push(
                        this.$t("form.accountAddForm.notify.success"),
                        notify.SUCCESS
                    );
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
    }
};
</script>

<style scoped lang="scss"></style>
