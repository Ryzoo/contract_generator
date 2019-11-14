<template>
    <v-card class="elevation-12">
        <v-toolbar>
            <v-toolbar-title>{{
                $t("form.resetPasswordForm.title")
                }}
            </v-toolbar-title>
        </v-toolbar>
        <v-card-text class="pb-0">
            <v-form v-if="isLoaded">
                <v-text-field
                    prepend-icon="fa-envelope"
                    v-model="resetPasswordForm.email"
                    :label="$t('base.field.email')"
                    type="email"
                >
                </v-text-field>
                <v-text-field
                    prepend-icon="fa-lock"
                    v-model="resetPasswordForm.password"
                    :label="$t('base.field.password')"
                    type="password"
                >
                </v-text-field>
                <v-text-field
                    prepend-icon="fa-lock"
                    v-model="resetPasswordForm.password_confirmation"
                    :label="$t('base.field.rePassword')"
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
            >{{ $t("fbase.button.cancel") }}
            </v-btn
            >
            <v-btn
                color="primary"
                :disabled="!isLoaded"
                @click="sendResetPassword"
            >{{ $t("base.button.reset") }}
            </v-btn
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
          email: this.$route.query.email,
          token: this.$route.query.token,
          password: "",
          password_confirmation: ""
        }
      };
    },
    methods: {
      sendResetPassword() {
        try {
          let validationArray = [];


          validationArray[
              this.$t('form.register.field.email')
              ] = this.resetPasswordForm.email;
          validationArray[
              this.$t("form.resetPasswordForm.field.password")
              ] = this.resetPasswordForm.password;
          validationArray[
              this.$t("form.resetPasswordForm.field.rePassword")
              ] = this.resetPasswordForm.password_confirmation;

          let valid = new window.Validator(validationArray);

          valid
              .get(this.$t('form.register.field.email'))
              .isEmail();

          valid
              .get(this.$t("form.resetPasswordForm.field.password"))
              .length(6, 50);

          valid
              .get(this.$t("form.resetPasswordForm.field.rePassword"))
              .length(6, 50)
              .sameAs(this.$t("form.resetPasswordForm.field.password"));
        }
        catch (e) {
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
