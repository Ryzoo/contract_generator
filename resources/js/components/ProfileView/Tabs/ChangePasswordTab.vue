<template>
  <v-card flat>
    <v-card-text v-if="isLoaded">
      <v-form>
        <v-container>
          <v-row>
            <v-col cols="12" md="6" class="pa-1">
              <v-text-field
                v-model="data.actualPassword"
                :label="$t('base.field.actualPassword')"
                required
                type="password"
              />
            </v-col>
            <v-col cols="12" md="6" class="pa-1">
              <v-text-field
                v-model="data.newPassword"
                :label="$t('base.field.newPassword')"
                required
                type="password"
              />
            </v-col>
            <v-col cols="12" md="6" class="pa-1">
              <v-text-field
                v-model="data.rePassword"
                :label="$t('base.field.rePassword')"
                required
                type="password"
              />
            </v-col>
            <v-col cols="12">
              <v-row class="justify-end">
                <v-btn color="success" @click="saveBasicData()">
                  {{ $t("base.button.save") }}
                </v-btn>
              </v-row>
            </v-col>
          </v-row>
        </v-container>
      </v-form>
    </v-card-text>
    <loader v-else />
  </v-card>
</template>

<script>
export default {
  name: "ChangePasswordTab",
  props: ["userData", "editable"],
  data() {
    return {
      isLoaded: true,
      data: {
        actualPassword: null,
        rePassword: null,
        newPassword: null,
      },
    };
  },
  methods: {
    saveBasicData() {
      try {
        const validationArray = [];

        validationArray[this.$t("base.field.actualPassword")] =
          this.data.actualPassword;
        validationArray[this.$t("base.field.rePassword")] =
          this.data.rePassword;
        validationArray[this.$t("base.field.newPassword")] =
          this.data.newPassword;

        const valid = new window.Validator(validationArray);

        valid.get(this.$t("base.field.newPassword")).length(3, 255);
        valid.get(this.$t("base.field.actualPassword")).length(3, 255);
        valid
          .get(this.$t("base.field.rePassword"))
          .length(3, 255)
          .sameAs(this.$t("base.field.newPassword"));
      } catch (e) {
        return;
      }

      this.isLoaded = false;

      const pwdData = {
        actualPassword: this.data.actualPassword,
        password: this.data.newPassword,
        password_confirmation: this.data.rePassword,
      };

      axios
        .put(`/user/${this.userData.id}/change-password`, pwdData)
        .then((response) => {
          notify.push(
            this.$t("form.accountChangePasswordForm.notify.success"),
            notify.SUCCESS
          );
          auth.checkAuth();
        })
        .finally(() => {
          this.isLoaded = true;
        });
    },
  },
};
</script>

<style scoped />
