<template>
    <v-card class="elevation-12">
        <v-toolbar flat>
            <v-toolbar-title>{{ $t("form.login.title") }}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="pb-0">
            <v-form v-if="isLoaded">
                <v-text-field
                    prepend-icon="fa-envelope"
                    v-model="loginForm.email"
                    :label="$t('form.login.field.email')"
                    type="email"
                >
                </v-text-field>
                <v-text-field
                    prepend-icon="fa-lock"
                    v-model="loginForm.password"
                    :label="$t('form.login.field.password')"
                    type="password"
                >
                </v-text-field>
                <small class="ma-0"
                    >{{ $t("form.login.text.forgotPassword") }}
                    <router-link to="/auth/sendResetPasswordToken">{{
                        $t("form.login.link.resetPassword")
                    }}</router-link>
                </small>
                <br />
            </v-form>
            <loader v-else></loader>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                :disabled="!isLoaded"
                text
                color="primary"
                to="/auth/register"
                >{{ $t("form.login.button.register") }}
            </v-btn>
            <v-btn :disabled="!isLoaded" color="primary" @click="sendLoginForm"
                >{{ $t("form.login.button.login") }}
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    name: "LoginView",
    data() {
        return {
            isLoaded: true,
            loginForm: {
                email: "t.client@test.pl",
                password: "client"
            }
        };
    },
    methods: {
        sendLoginForm() {
            try {
                let validationArray = [];

                validationArray[
                    this.$t("form.login.field.email")
                ] = this.loginForm.email;
                validationArray[
                    this.$t("form.login.field.password")
                ] = this.loginForm.password;

                let valid = new window.Validator(validationArray);

                valid.get(this.$t("form.login.field.email")).isEmail();
                valid.get(this.$t("form.login.field.password")).length(6, 50);
            } catch (e) {
                return;
            }

            this.isLoaded = false;
            axios
                .post("/auth/login", this.loginForm)
                .then(response => {
                    notify.push(
                        this.$t("form.login.notify.success"),
                        notify.SUCCESS
                    );
                    auth.login(response.data, this.$route.query.redirect);
                })
                .finally(() => {
                    this.isLoaded = true;
                });
        }
    }
};
</script>

<style scoped></style>
