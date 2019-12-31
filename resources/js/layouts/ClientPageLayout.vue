<template>
  <v-card flat class="fill-height">
    <v-toolbar
      color="primary"
      dark
      extended
      flat
    >
      <v-btn v-if="isAuthorized" outlined small @click="backToPanel">
        <v-icon small left>fa-columns</v-icon>
        Go to panel
      </v-btn>
      <v-btn v-else outlined small @click="goToLogin">
        <v-icon small left>fa-auth</v-icon>
        Login or register
      </v-btn>
    </v-toolbar>

    <v-fade-transition mode="out-in">
      <router-view/>
    </v-fade-transition>
  </v-card>
</template>

<script>
export default {
  name: 'ClientPageLayout',
  methods: {
    backToPanel () {
      this.$router.push('/panel/')
    },
    goToLogin () {
      this.$router.push('/auth/login')
    }
  },
  computed: {
    isAuthorized () {
      return auth.isAuthorized()
    }
  }
}
</script>

<style scoped>

</style>
