<template>
  <v-row>
    <v-col sm="12">
      <Header
        @show-attribute-modal="showAttributeModal = true"
      />
    </v-col>
    <v-col sm="12">
      <v-divider class="mb-3"/>
    </v-col>
    <v-col sm="12">
      <BlockLayout
        @show-block-modal="showBlockModal = true"
      />
    </v-col>

    <v-dialog
      v-model="showBlockModal"
      scrollable
      max-width="500px">
          <SelectedBlockView @close="showBlockModal=false"/>
    </v-dialog>

    <v-dialog
      v-model="showAttributeModal"
      scrollable
      max-width="500px">
        <VariableView @close="showAttributeModal=false"/>
    </v-dialog>
  </v-row>
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
      showAttributeModal: false,
      showBlockModal: false
    }
  }
}
</script>
