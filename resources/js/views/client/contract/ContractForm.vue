<template>
    <v-container class="fill-height">
        <v-row align="center" justify="center">
            <v-col sm="12" md="4" lg="3">
              <contract-list
                @selected="selectContract"
              />
            </v-col>
            <v-col sm="12" md="8" lg="9">
                <v-fade-transition mode="out-in">
                  <contract-form-render
                    v-if="contractData"
                    :contract="contractData"
                  />
                    <v-alert
                        v-else
                        border="top"
                        colored-border
                        type="info"
                        elevation="2"
                    >
                        {{ $t("pages.form.selectOneContract") }}
                    </v-alert>
                </v-fade-transition>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import ContractList from '../../../components/Contract/ContractList'
import ContractFormRender from '../../../components/Contract/ContractFormRender'

export default {
  name: 'ContractForm',
  components: {
    ContractList,
    ContractFormRender
  },
  data () {
    return {
      contractData: null
    }
  },
  methods: {
    selectContract (contractData) {
      this.contractData = contractData
    }
  }
}
</script>

<style scoped>

</style>
