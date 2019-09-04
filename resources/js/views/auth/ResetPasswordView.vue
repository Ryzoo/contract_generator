<template>
    <v-card class="elevation-12">
        <v-toolbar>
            <v-toolbar-title>{{
                $t("form.resetPasswordForm.title")
            }}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="pb-0">
            <v-form v-if="isLoaded">
                <v-text-field
                    prepend-icon="fa-lock"
                    v-model="resetPasswordForm.password"
                    :label="$t('form.resetPasswordForm.field.password')"
                    type="password"
                >
                </v-text-field>
                <v-text-field
                    prepend-icon="fa-lock"
                    v-model="resetPasswordForm.rePassword"
                    :label="$t('form.resetPasswordForm.field.rePassword')"
                    type="password"
                >
                </v-text-field>
            </v-form>
            <loader v-else></loader>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                text
                color="primary"
                to="/auth/login"
                :disabled="!isLoaded"
                >{{ $t("form.resetPasswordForm.button.cancel") }}</v-btn
            >
            <v-btn
                color="primary"
                :disabled="!isLoaded"
                @click="sendResetPassword"
                >{{ $t("form.resetPasswordForm.button.reset") }}</v-btn
            >
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    name: "ResetPasswordView",
    data() {
        return {
            isLoaded: true,
            resetPasswordForm: {
                resetToken: this.$route.params.token,
                password: "",
                rePassword: ""
            }
        };
    },
    methods: {
        sendResetPassword() {
            try {
                let validationArray = [];

                validationArray[
                    this.$t("form.resetPasswordForm.field.password")
                ] = this.resetPasswordForm.password;
                validationArray[
                    this.$t("form.resetPasswordForm.field.rePassword")
                ] = this.resetPasswordForm.rePassword;

                let valid = new window.Validator(validationArray);

                valid
                    .get(this.$t("form.resetPasswordForm.field.password"))
                    .length(6, 50);
                valid
                    .get(this.$t("form.resetPasswordForm.field.rePassword"))
                    .length(6, 50)
                    .sameAs(this.$t("form.resetPasswordForm.field.password"));
            } catch (e) {
                return;
            }

            this.isLoaded = false;
            axios
                .post("/auth/resetPassword", this.resetPasswordForm)
                .then(response => {
                    notify.push(
                        this.$t("form.resetPasswordForm.notify.success"),
                        notify.SUCCESS
                    );
                    this.$router.push("/auth/login");
                })
                .finally(() => {
                    this.isLoaded = true;
                });
        }
    }
};
</script>

<style scoped></style>
