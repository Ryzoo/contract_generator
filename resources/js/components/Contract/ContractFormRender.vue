<template>
    <v-card
        v-if="!isLoading"
        color="#446477"
    >
        <v-card-text class="white--text" v-if="currentAction === availableActionsHook.BEFORE_FORM_RENDER">
            <action-renderer
                v-model="currentAction"
                @action-pass="loadContractForm"
                :contract="contract"
            ></action-renderer>
        </v-card-text>

        <v-card-text class="white--text" v-if="currentAction === availableActionsHook.FORM_RENDER">
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
                                    <v-btn text v-if="actualStep > 1 && actualStep <= stepList.length"
                                           @click="goBackStep">Go back
                                    </v-btn>
                                    <v-btn color="primary" v-if="actualStep < stepList.length"
                                           @click="goToNextStep">Go next
                                    </v-btn>
                                    <v-btn color="success" v-if="actualStep === stepList.length"
                                           @click="finishContractForm">Finish
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-container>

                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
        </v-card-text>

        <v-card-text class="white--text" v-if="currentAction === availableActionsHook.BEFORE_FORM_END || currentAction === availableActionsHook.AFTER_FORM_END">
            <action-renderer
                v-model="currentAction"
                :contract="contract"
            ></action-renderer>
        </v-card-text>

    </v-card>
    <loader v-else></loader>
</template>

<script>
  import FormRenderer from "./Form/FormRenderer";
  import ActionRenderer from "./Form/ActionRenderer";
  import {AvailableRenderActionsHook} from "./../../additionalModules/Enums";

  export default {
    name: "ContractFormRender",
    props: ["contract"],
    components: {
      FormRenderer,
      ActionRenderer
    },
    data(){
      return {
        isLoading: true,
        actualStep: 1,
        availableActionsHook: AvailableRenderActionsHook,
        currentAction: AvailableRenderActionsHook.BEFORE_FORM_RENDER,
        actionStatus: false
      }
    },
    computed: {
      stepList() {
        return Object.assign([], this.$store.getters.formElementsStepList);
      }
    },
    watch: {
      actualStep(vv) {
        this.$forceUpdate();
        console.log(vv);
      },
      contract(oldValue, newValue) {
        if (oldValue !== newValue) {
          this.init();
        }
      }
    },
    methods: {
      goBackStep() {
        this.actualStep = this.actualStep === 1 ? 1 : this.actualStep - 1;
      },
      goToNextStep() {
        if (this.isCurrentStepValid()) {
          this.actualStep = this.actualStep === this.stepList.length ? this.actualStep : this.actualStep + 1;
        }
      },
      isCurrentStepValid() {
        if (!this.stepList[this.actualStep - 1].content.every(e => e.isValid)) {
          Notify.push("Complete all elements of this page correctly", Notify.WARNING);
          return false;
        }

        return true;
      },
      loadContractForm(additionalAttributes) {
        this.isLoading = true;
        const additionalParam = this.getAttributesFromArrayWithObject(additionalAttributes);

        axios.get(`/contract/${this.contract.id}/form?${additionalParam}`)
            .then((response) => {
              this.$store.dispatch("formElements_set", response.data);
            })
            .catch(() => {
              this.currentAction = this.availableActionsHook.BEFORE_FORM_RENDER;
            })
            .finally(() => {
              this.isLoading = false;
            })
      },
      getAttributesFromArrayWithObject(additionalAttributes) {
        let defaultAttributeObject = {};
        additionalAttributes.map(x => {
          Object.assign(defaultAttributeObject, x);
        });
        return defaultAttributeObject ? new URLSearchParams(defaultAttributeObject).toString() : "";
      },
      finishContractForm() {
        if (this.isCurrentStepValid()) {
          this.currentAction = this.availableActionsHook.BEFORE_FORM_END;
        }
      },
      init() {
        this.currentAction = this.availableActionsHook.BEFORE_FORM_RENDER;
        this.loadContractModules();
      },
      loadContractModules() {
        this.isLoading = true;
        axios.get(`/contract/${this.contract.id}/modules`)
            .then((response) => {
              this.$store.dispatch("contractModules_set", response.data);
            })
            .finally(() => {
              this.isLoading = false;
            })
      }
    },
    mounted() {
      this.init();
    }
  }
</script>

<style scoped>

</style>
