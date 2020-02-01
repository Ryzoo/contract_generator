<template>
    <v-row>
        <v-col>
            <h3>{{$t("pages.panel.contracts.builder.header")}} <span class="light-text" v-if="contract">{{contract.name}}</span></h3>
            <v-btn color="primary mt-3" small @click="showAttributeModal">{{$t("pages.panel.contracts.builder.attributeList")}}</v-btn>
        </v-col>
        <v-col cols="auto">
            <v-btn small text color="primary" @click="goBack">{{$t("base.button.configuration_back")}}</v-btn>
            <v-btn small class="mx-2" outlined color="primary" @click="saveActual(false)">{{$t("base.button.save")}}</v-btn>
            <v-btn small color="primary" @click="saveActual(true)">{{$t("base.button.save_exit")}}</v-btn>
        </v-col>
    </v-row>
</template>

<script>
export default {
  name: 'Header',
  data () {
    return {
      contract: null,
      isLoaded: true
    }
  },
  methods: {
    showAttributeModal () {
      this.$emit('show-attribute-modal')
    },
    init () {
      this.contract = this.$store.getters.getNewContractData
      this.$store.dispatch('builder_set', this.contract.blocks)
      this.$store.dispatch('builder_setVariable', this.contract.attributesList)
    },
    goBack () {
      const updateState = this.$store.getters.getNewContractUpdateState
      this.$router.push(`/panel/contracts/edit/${updateState.id}`)
    },
    saveActual (redirect) {
      this.isLoaded = false
      const updateState = this.$store.getters.getNewContractUpdateState

      this.contract.blocks = this.$store.getters.builder_allBlocks
      this.contract.attributesList = this.$store.getters.builder_allVariables

      this.$store.dispatch('newContract_setUpdate', this.contract)
        .then(() => {
          axios.put(`/contract/${updateState.id}`, this.$store.getters.getNewContractData)
            .then(response => {
              notify.push(
                this.$t('pages.panel.contracts.builder.savedNotify'),
                notify.SUCCESS
              )
              if (redirect) {
                this.$store.dispatch('newContract_clear')
                this.$router.push('/panel/contracts/list')
              }
            })
            .finally(() => {
              this.isLoaded = true
            })
        })
    }
  },
  mounted () {
    this.init()
  }
}
</script>

<style scoped>
    .light-text {
        font-weight: 300;
    }
</style>
