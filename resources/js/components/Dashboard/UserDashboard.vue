<template>
  <v-row>
    <BaseStep v-if="currentStep==='base'" @step="showPage" />
    <Complaint v-if="currentStep==='complaint'" @complaint="showComplaint" />
    <component v-if="currentStep!=='complaint' && currentStep.includes('complaint')" :is="currentStep" />
  </v-row>
</template>

<script>
import BaseStep from "./user-dashboard/base-steps/BaseStep";
import Complaint from "./user-dashboard/base-steps/Complaint";
import ComplaintGls from "./user-dashboard/base-steps/complaint/ComplaintGls";
import ComplaintInpost from "./user-dashboard/base-steps/complaint/ComplaintInpost";
import ComplaintDpd from "./user-dashboard/base-steps/complaint/ComplaintDpd";
import ComplaintGeis from "./user-dashboard/base-steps/complaint/ComplaintGeis";
import ComplaintUps from "./user-dashboard/base-steps/complaint/ComplaintUps";
import ComplaintDhl from "./user-dashboard/base-steps/complaint/ComplaintDhl";
import ComplaintFedex from "./user-dashboard/base-steps/complaint/ComplaintFedex";
import ComplaintTnt from "./user-dashboard/base-steps/complaint/ComplaintTnt";

export default {
  name: 'UserDashboard',
  components: {
    BaseStep, Complaint, ComplaintGls, ComplaintInpost, ComplaintDpd,
    ComplaintDhl, ComplaintFedex, ComplaintTnt, ComplaintGeis, ComplaintUps,
  },
  data: () => {
    return {
      currentStep: 'base'
    }
  },
  methods: {
    showPage(step){
      this.currentStep = step
    },
    showComplaint(step){
      this.currentStep = 'complaint-' + step
    }
  }
}
</script>

<style>
  h1{
    font-size: 28px;
  }
  h1, h2{
    color: #4C2E80;
  }
</style>
