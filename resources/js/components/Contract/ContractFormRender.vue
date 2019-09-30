<template>
    <v-card
        v-if="!isLoading"
        color="#446477"
    >
        <v-card-text class="white--text">
            <div class="headline mb-2">{{contract.name}}</div>
            <v-divider></v-divider>
            <v-stepper v-model="actualStep">
                <v-stepper-header>
                    <template v-for="step in stepList">
                        <v-stepper-step
                            :key="`${step.id}-header`"
                            :complete="actualStep > step.id"
                            :step="step.id"
                        >
                            Krok: {{step.id}}
                        </v-stepper-step>

                        <v-divider
                            v-if="step.id < stepList.length - 1"
                            :key="step.id"
                        ></v-divider>
                    </template>
                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content
                        v-for="step in stepList"
                        :key="`${step.id}-content`"
                        :step="step.id"
                    >
                        <form-renderer
                            :formElements="step.content"
                        ></form-renderer>

                        <v-container>
                            <v-row>
                                <v-col align="end">
                                    <v-btn text v-if="actualStep > 1 && actualStep <= stepList.length" @click="goBackStep">Go back</v-btn>
                                    <v-btn color="primary" v-if="actualStep < stepList.length" @click="goToNextStep">Go next</v-btn>
                                    <v-btn color="success" v-if="actualStep === stepList.length" @click="renderContract">Render contract</v-btn>
                                </v-col>
                            </v-row>
                        </v-container>

                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
        </v-card-text>
    </v-card>
    <loader v-else></loader>
</template>

<script>
  import FormRenderer from "./Form/FormRenderer";

  export default {
    name: "ContractFormRender",
    props: ["contract"],
    components: {
      FormRenderer
    },
    data() {
      return {
        isLoading: false,
        actualStep: 1
      }
    },
    computed: {
      stepList(){
        return Object.assign([],this.$store.getters.formElementsStepList);
      }
    },
    watch: {
      contract(oldValue, newValue) {
        if (oldValue !== newValue) {
          this.loadContractForm();
        }
      }
    },
    methods: {
      goBackStep(){
        this.actualStep = this.actualStep === 1 ? 1 : this.actualStep-1;
      },
      goToNextStep(){
        if(this.isCurrentStepValid()){
          this.actualStep = this.actualStep === this.stepList.length ? this.actualStep : this.actualStep+1;
        }
      },
      isCurrentStepValid(){
        if(!this.stepList[this.actualStep].content.every(e=>e.isValid)){
          Notify.push("Complete all elements of this page correctly",Notify.WARNING);
          return false;
        }

        return true;
      },
      loadContractForm() {
        this.isLoading = true;
        axios.get(`/contract/${this.contract.id}/form`)
            .then((response) => {
              this.$store.dispatch("formElements_set", response.data);
            })
            .finally(() => {
              this.isLoading = false;
            })
      },
      renderContract(){
        this.isLoading = true;
        axios({
          url: `/contract/${this.contract.id}/render`,
          method: 'POST',
          responseType: 'blob',
          data: {
            formElements: this.$store.getters.formElements
          }
        })
            .then((response) => {
              Notify.push("Render zakończony pomyślnie", Notify.SUCCESS);
              const url = window.URL.createObjectURL(new Blob([response.data]));
              const link = document.createElement('a');
              link.href = url;
              link.setAttribute('download', 'file.pdf');
              document.body.appendChild(link);
              link.click();
            })
            .finally(() => {
              this.isLoading = false;
            })
      }
    },
    mounted() {
      this.loadContractForm();
    }
  }
</script>

<style scoped>

</style>
