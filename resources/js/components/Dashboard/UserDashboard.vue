<template>
  <v-row class="complaint-container">
    <v-btn v-if="currentStep!=='base'" class="my-5" color="primary" @click="showPage('base')">< Powrót</v-btn>
    <BaseStep v-if="currentStep==='base'" @step="showPage"/>
    <Complaint v-if="currentStep==='complaint'" @complaint="showComplaint"/>
    <component v-if="currentStep!=='complaint' && currentStep.includes('complaint')" :is="currentStep"/>
  </v-row>
</template>

<script>
import * as Complaints from './user-dashboard/base-steps/complaint/index'
import BaseStep from './user-dashboard/base-steps/BaseStep'
import Complaint from './user-dashboard/base-steps/Complaint.vue'

export default {
  name: 'UserDashboard',
  components: {
    BaseStep,
    Complaint,
    ...Complaints
  },
  data: () => {
    return {
      currentStep: 'base'
    }
  },
  methods: {
    showPage (step) {
      this.currentStep = step
    },
    showComplaint (step) {
      this.currentStep = 'complaint-' + step
    }
  }
}
</script>

<style lang="scss">
  .complaint-container {
    h1 {
      font-size: 28px;
    }

    h1, h2 {
      color: #4C2E80;
    }
  }
</style>
