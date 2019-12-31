<template>
  <component
    v-if="actualModule && actualHookName"
    :key="actualModuleIndex"
    :is="actualHookName"
    v-bind="{
                    actualModule: actualModule,
                    contract: contract
                }"
    @finish="finishAction"
  >
  </component>
</template>

<script>
import { AvailableRenderActionsHook } from './../../../additionalModules/Enums'
import AuthBeforeRenderView from '../Modules/Auth/AuthBeforeRenderView'
import ProviderForContractView from '../Modules/Provider/ProviderForContractView'

export default {
  name: 'ActionRenderer',
  components: {
    AuthBeforeRenderView,
    ProviderForContractView
  },
  props: [
    'value',
    'contract'
  ],

  watch: {
    value (newValue) {
      this.$forceUpdate()
      this.buildActions()
    }
  },
  data () {
    return {
      actualModule: null,
      actualModuleIndex: -1,
      actualHookName: null,
      moduleAttributeArray: []
    }
  },
  computed: {
    currentModulesTree () {
      return this.$store.getters.getContractModulesForAction(this.value)
    }
  },
  methods: {
    finishAction (moduleAttributeArray) {
      if (moduleAttributeArray) {
        this.moduleAttributeArray.push(moduleAttributeArray)
      }

      if (this.buildModule(this.actualModuleIndex + 1)) {
        return
      }

      this.$emit('action-pass', this.moduleAttributeArray)

      switch (this.value) {
        case AvailableRenderActionsHook.BEFORE_FORM_RENDER:
          this.$emit('input', AvailableRenderActionsHook.FORM_RENDER)
          break
        case AvailableRenderActionsHook.BEFORE_FORM_END:
          this.$emit('input', AvailableRenderActionsHook.AFTER_FORM_END)
          break
      }
    },
    buildActions () {
      this.actualModule = null
      this.actualModuleIndex = -1
      this.actualHookName = null
      this.moduleAttributeArray = []

      if (this.currentModulesTree.length === 0) {
        this.finishAction()
      }

      this.buildModule(0)
    },
    buildModule (index) {
      if (index >= this.currentModulesTree.length) {
        return false
      }

      this.actualModule = this.currentModulesTree[index]
      this.actualModuleIndex = index
      this.actualHookName = this.actualModule.renderHooks[`action-${this.value}`]

      return !!this.actualModule
    }
  },
  mounted () {
    this.buildActions()
  }

}
</script>

<style scoped>

</style>
