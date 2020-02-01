<template>
  <v-col>
    <v-row>
      <v-col cols="12" md="6">
        <UserRegistrations />
      </v-col>
      <v-col cols="12" md="6">
        <FormSubmissions />
      </v-col>
    </v-row>
  </v-col>
</template>

<script>

import UserRegistrations from './StatisticChart/UserRegistrations'
import FormSubmissions from './StatisticChart/FormSubmissions'

export default {
  name: 'AdminDashboard',
  components: {
    UserRegistrations,
    FormSubmissions
  }
}
</script>

<style scoped>
</style>
