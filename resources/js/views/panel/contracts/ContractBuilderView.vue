<template>
  <v-row v-if="isLoaded">
    <v-col cols="12">
      <Header
          @show-attribute-modal="showAttributeModal = true"
      />
      <v-divider class="my-3"/>
    </v-col>
    <v-col cols="12">
      <BlockLayout
          @show-block-modal="showBlockModal = true"
      />
    </v-col>

    <v-dialog
        v-model="showBlockModal"
        scrollable
        max-width="800px">
      <SelectedBlockView @close="showBlockModal=false"/>
    </v-dialog>

    <v-dialog
        v-model="showAttributeModal"
        scrollable
        width="900px">
      <VariableView @close="showAttributeModal=false"/>
    </v-dialog>
  </v-row>
  <loader v-else></loader>
</template>

<script>
import Header from '../../../components/Contract/Builder/Header'
import BlockLayout from '../../../components/Contract/Builder/BlockLayout'
import SelectedBlockView from '../../../components/Contract/Builder/Modals/SelectedBlockView'
import VariableView from '../../../components/Contract/Builder/Modals/VariableView'

export default {
  name: 'CreateAgreementView',
  components: {
    Header,
    BlockLayout,
    SelectedBlockView,
    VariableView
  },
  data () {
    return {
      isLoaded: false,
      showAttributeModal: false,
      showBlockModal: false,
      contractId: this.$route.params.id || null
    }
  },
  methods: {
    loadContract () {
      this.isLoaded = false
      axios.get(`/contract/${this.contractId}`)
        .then(response => {
          this.$store.dispatch('newContract_setUpdate', {
            ...response.data,
            categories: response.data.categories.map(x => x.id)
          })
            .then(() => {
              this.contract = {
                ...this.$store.getters.getNewContractData
              }
              this.isLoaded = true
            })
        })
    }
  },
  mounted () {
    if (this.$route.params.id !== undefined) {
      this.loadContract()
    } else {
      this.isLoaded = true
    }
  }
}
</script>
