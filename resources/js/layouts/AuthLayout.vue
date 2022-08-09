<template>
  <v-container fluid class="fill-height primary">
    <v-row class="ma-0">
      <v-col class="d-none d-md-flex" cols="12" md="6" lg="7">
        <AuthWelcome />
      </v-col>
      <v-col
        cols="12"
        md="6"
        lg="5"
        class="ma-auto ma-md-0"
        style="max-width: 500px"
      >
        <LangSelector />
        <v-fade-transition mode="out-in">
          <router-view />
        </v-fade-transition>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AuthWelcome from "../components/Auth/AuthWelcome";
import LangSelector from "../components/common/LangSelector";

export default {
  name: "AuthLayout",
  components: {
    LangSelector,
    AuthWelcome,
  },
};
</script>

<style lang="scss">
.auth-icon {
  color: #dedede !important;
}
</style>
