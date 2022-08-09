<template>
  <v-card flat>
    <v-card-text v-if="isLoaded">
      <v-form>
        <v-container>
          <v-row>
            <v-col cols="12" md="6" class="pa-1">
              <v-text-field
                v-model="user.firstName"
                :label="$t('base.field.firstName')"
                required
              />
            </v-col>
            <v-col cols="12" md="6" class="pa-1">
              <v-text-field
                v-model="user.lastName"
                :label="$t('base.field.lastName')"
                required
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
  name: "BasicDataTab",
  props: ["userData", "editable"],
  data() {
    return {
      isLoaded: true,
      user: {
        firstName: this.userData.firstName,
        lastName: this.userData.lastName,
      },
    };
  },
  methods: {
    saveBasicData() {
      try {
        const validationArray = [];

        validationArray[this.$t("base.field.firstName")] = this.user.firstName;
        validationArray[this.$t("base.field.lastName")] = this.user.lastName;

        const valid = new window.Validator(validationArray);

        valid.get(this.$t("base.field.firstName")).length(3, 50);
        valid.get(this.$t("base.field.lastName")).length(3, 50);
      } catch (e) {
        return;
      }

      this.isLoaded = false;
      axios
        .put(`/user/${this.userData.id}`, this.user)
        .then(() => {
          notify.push(
            this.$t("form.accountEditForm.notify.success"),
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

<style scoped></style>
