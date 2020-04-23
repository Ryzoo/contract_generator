<template>
  <section>
    <v-card
      v-if="!isLoading"
      max-width="800px"
      class="mx-auto"
      style="margin-top: -60px;"
    >
      <v-card-title v-if="currentAction === availableActionsHook.FORM_RENDER">
        {{contract.name}}
      </v-card-title>
      <v-divider/>

      <action-renderer
        v-if="currentAction === availableActionsHook.BEFORE_FORM_RENDER"
        v-model="currentAction"
        @action-pass="loadContractForm"
        :contract="contract"
      />
      <action-renderer
        v-if="currentAction === availableActionsHook.BEFORE_FORM_END || currentAction === availableActionsHook.AFTER_FORM_END"
        v-model="currentAction"
        :contract="contract"
      />
    </v-card>
    <loader v-else/>
    <v-row style="max-width: 700px" class="mx-auto mt-5" v-if="currentAction === availableActionsHook.FORM_RENDER">
      <v-col cols="12">
        <v-stepper v-model="actualStep">
          <v-stepper-header>
            <template v-for="step in stepList">
              <hr
                :class="{'colored-hr': actualStep >= step.id}"
                class="stepper-divider"
                v-if="step.id > 1"
                :key="step.id + '-up-hr'"
              />

              <v-stepper-step
                :key="`${step.id}-header`"
                :complete="actualStep > step.id"
                :step="step.id"
              >
              </v-stepper-step>

              <hr
                :class="{'colored-hr': actualStep >= step.id}"
                class="stepper-divider"
                v-if="step.id < stepList.length"
                :key="step.id + '-bottom-hr'"
              />
            </template>
          </v-stepper-header>

          <v-stepper-items>
            <v-stepper-content
              v-for="step in stepList"
              :key="`${step.id}-content`"
              :step="step.id"
            >
              <v-row v-if="step.content.length > 5">
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

              <v-row v-if="actualStep === 1">
                <v-col>
                  <v-alert type="info" v-if="contract && contract.description" >
                    <div v-html="contract.description"/>
                  </v-alert>
                </v-col>
              </v-row>

              <form-renderer
                :formElements="step.content"
              />

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
            </v-stepper-content>
          </v-stepper-items>
        </v-stepper>
      </v-col>
    </v-row>
  </section>
</template>

<script>
import FormRenderer from './Form/FormRenderer'
import ActionRenderer from './Form/ActionRenderer'
import { AvailableRenderActionsHook } from './../../additionalModules/Enums'

export default {
  name: 'ContractFormRender',
  props: ['contractId'],
  components: {
    FormRenderer,
    ActionRenderer
  },
  data () {
    return {
      contract: null,
      isLoading: true,
      actualStep: 1,
      availableActionsHook: AvailableRenderActionsHook,
      currentAction: AvailableRenderActionsHook.BEFORE_FORM_RENDER,
      actionStatus: false
    }
  },
  computed: {
    stepList () {
      return this.$store.getters.formElementsStepList
    }
  },
  watch: {
    actualStep () {
      this.$forceUpdate()
    },
    contract (oldValue, newValue) {
      if (oldValue !== newValue) {
        this.init()
      }
    }
  },
  methods: {
    goBackStep () {
      this.actualStep = this.actualStep === 1 ? 1 : this.actualStep - 1
    },
    goToNextStep () {
      this.validateActual()
        .then(() => {
          if (this.isCurrentStepValid()) {
            this.actualStep = this.actualStep === this.stepList.length ? this.actualStep : this.actualStep + 1
          }
        })
    },
    isCurrentStepValid () {
      if (!this.stepList[this.actualStep - 1].content.filter(x => x.isActive).every(e => e.isValid)) {
        Notify.push(this.$t('module.notify.completeAllElement'), Notify.ERROR)
        return false
      }

      return true
    },
    validateActual () {
      return this.$store.dispatch('formElements_validate_current', this.actualStep - 1)
    },
    loadContractForm (additionalAttributes) {
      this.isLoading = true
      const additionalParam = this.getAttributesFromArrayWithObject(additionalAttributes)

      axios.get(`/contract/form/${this.contractId}?${additionalParam}`)
        .then((response) => {
          this.contract = response.data.contract
          this.$store.dispatch('formElements_set', response.data.formElements)
            .then(() => {
              this.currentAction = this.availableActionsHook.FORM_RENDER
              this.isLoading = false
            })
        })
        .catch(() => {
          this.currentAction = this.availableActionsHook.BEFORE_FORM_RENDER
          this.isLoading = false
        })
    },
    getAttributesFromArrayWithObject (additionalAttributes) {
      if (!additionalAttributes.length) return ''

      const defaultAttributeObject = {}
      additionalAttributes.map(x => {
        Object.assign(defaultAttributeObject, x)
      })
      return defaultAttributeObject ? new URLSearchParams(defaultAttributeObject).toString() : ''
    },
    finishContractForm () {
      this.validateActual()
        .then(() => {
          if (this.isCurrentStepValid()) {
            this.currentAction = this.availableActionsHook.BEFORE_FORM_END
          }
        })
    },
    init () {
      this.currentAction = this.availableActionsHook.BEFORE_FORM_RENDER
      this.loadContractModules()
    },
    loadContractModules () {
      this.isLoading = true
      axios.get(`/contract/modules/${this.contractId}`)
        .then((response) => {
          this.$store.dispatch('contractModules_set', response.data)
        })
        .finally(() => {
          this.isLoading = false
        })
    }
  },
  mounted () {
    this.init()
  }
}
</script>

<style lang="scss" >
  @import "./../../../sass/colors";

  .v-input--selection-controls{
    margin-top: 0;
  }

  .v-stepper__header {
    padding: 10px;
  }

  .stepper-divider {
    height: 3px;
    width: 100%;
    align-self: center;
    flex: 1 1 0px;
    background-color: #cdcdcd;
    color: #cdcdcd;
    border: none;

    &.colored-hr {
      background-color: $primary;
      color: $primary;
    }
  }
  .v-stepper__step__step .v-icon.v-icon {
    font-size: 1rem;
  }

  .v-stepper__step--active {
    border-radius: 50%;
    border: 3px solid $primary;
  }
  .v-application--is-ltr .v-stepper__step__step {
    margin-right: 0px;
  }

  .v-stepper__step {
    padding: 3px;
    height: max-content;
    align-self: center;
  }

  .v-stepper__step__step {
    background: #cdcdcd !important;
    font-weight: 500;
  }

  .v-stepper__step--inactive {
    padding: 0;
  }
</style>
