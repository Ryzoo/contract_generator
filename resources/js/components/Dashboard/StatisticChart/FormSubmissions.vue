<template>
  <v-card class="mt-4 mx-auto">
    <v-sheet
      class="v-sheet--offset mx-auto"
      color="green"
      elevation="12"
      max-width="calc(100% - 32px)"
    >
      <v-sparkline
        :labels="labels"
        :value="value"
        color="white"
        line-width="2"
        padding="16"
      ></v-sparkline>
    </v-sheet>

    <v-card-text class="pt-0">
      <div class="title font-weight-light mb-2">Form Submission</div>
      <v-divider class="my-2"></v-divider>
      <v-icon class="mr-2" small> fa-clock </v-icon>
      <span class="caption grey--text font-weight-light" v-if="lastTime"
        >last submission created {{ lastTime }}</span
      >
      <span class="caption grey--text font-weight-light" v-else
        >Wait for some form submissions!</span
      >
    </v-card-text>
  </v-card>
</template>

<script>
import { StatisticType } from "../../../additionalModules/Enums";

export default {
  name: "FormSubmissions",
  data: () => ({
    lastTime: null,
    labels: [],
    value: [],
  }),
  mounted() {
    axios.get(`statistic/${StatisticType.SUBMISSIONS}`).then((response) => {
      this.lastTime = response.data.lastTime;

      response.data.data.forEach((x) => {
        this.labels.push(x.date.substring(0, 2));
        this.value.push(x.count);
      });
    });
  },
};
</script>

<style scoped>
.v-sheet--offset {
  top: -24px;
  position: relative;
}
</style>
