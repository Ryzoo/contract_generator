<template>
  <v-row>
    <BaseStep v-if="currentStep==='base'" @step="showPage" />
    <Complaint v-if="currentStep==='complaint'" @complaint="showComplaint" />
    <component v-if="currentStep!=='complaint' && currentStep.includes('complaint')" :is="currentStep" />
  </v-row>
</template>

<script>
import BaseStep from './user-dashboard/base-steps/BaseStep'
import Complaint from './user-dashboard/base-steps/Complaint'
import ComplaintGls from './user-dashboard/base-steps/complaint/ComplaintGls'
import ComplaintInpost from './user-dashboard/base-steps/complaint/ComplaintInpost'
import ComplaintDpd from './user-dashboard/base-steps/complaint/ComplaintDpd'
import ComplaintGeis from './user-dashboard/base-steps/complaint/ComplaintGeis'
import ComplaintUps from './user-dashboard/base-steps/complaint/ComplaintUps'
import ComplaintDhl from './user-dashboard/base-steps/complaint/ComplaintDhl'
import ComplaintFedex from './user-dashboard/base-steps/complaint/ComplaintFedex'
import ComplaintTnt from './user-dashboard/base-steps/complaint/ComplaintTnt'
import ComplaintFurgonetka from './user-dashboard/base-steps/complaint/ComplaintFurgonetka'
import ComplaintKurjerzy from './user-dashboard/base-steps/complaint/ComplaintKurjerzy'
import ComplaintSendit from './user-dashboard/base-steps/complaint/ComplaintSendit'
import ComplaintPrzesylarka from './user-dashboard/base-steps/complaint/ComplaintPrzesylarka'
import ComplaintWysylajtaniej from './user-dashboard/base-steps/complaint/ComplaintWysylajtaniej'
import ComplaintEpaka from './user-dashboard/base-steps/complaint/ComplaintEpaka'
import ComplaintApaczka from './user-dashboard/base-steps/complaint/ComplaintApaczka'
import ComplaintBrokerkurier from './user-dashboard/base-steps/complaint/ComplaintBrokerkurier'

export default {
  name: 'UserDashboard',
  components: {
    BaseStep,
    Complaint,
    ComplaintGls,
    ComplaintInpost,
    ComplaintDpd,
    ComplaintDhl,
    ComplaintFedex,
    ComplaintTnt,
    ComplaintGeis,
    ComplaintUps,
    ComplaintFurgonetka,
    ComplaintKurjerzy,
    ComplaintSendit,
    ComplaintPrzesylarka,
    ComplaintWysylajtaniej,
    ComplaintEpaka,
    ComplaintApaczka,
    ComplaintBrokerkurier
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

<style>
  h1{
    font-size: 28px;
  }
  h1, h2{
    color: #4C2E80;
  }
</style>
