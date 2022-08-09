<template>
  <v-card flat class="fill-height">
    <v-toolbar color="primary" dark extended flat>
      <v-btn v-if="isAuthorized" outlined small @click="backToPanel">
        <v-icon small left>fa-columns</v-icon>
        Go to panel
      </v-btn>
      <v-btn v-else outlined small @click="goToLogin">
        <v-icon small left>fa-lock-open</v-icon>
        Login or register
      </v-btn>

      <v-spacer />

      <v-btn outlined small @click="goToContractList">
        <v-icon small left>fa-newspaper</v-icon>
        {{ $t("navigation.formContract") }}
      </v-btn>
    </v-toolbar>

    <v-fade-transition mode="out-in">
      <router-view />
    </v-fade-transition>
  </v-card>
</template>

<script>
export default {
  name: "ClientPageLayout",
  methods: {
    backToPanel() {
      this.$router.push("/panel/");
    },
    goToLogin() {
      this.$router.push("/auth/login");
    },
    goToContractList() {
      this.$router.push("/client/form");
    },
  },
  computed: {
    isAuthorized() {
      return auth.isAuthorized();
    },
  },
};
</script>

<style scoped></style>
