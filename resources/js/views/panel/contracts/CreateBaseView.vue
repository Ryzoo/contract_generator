<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
                <v-card class="pb-3" v-if="isLoaded">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title class="white--text">{{ $t("form.contractAddForm.title") }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                      <v-text-field
                        prepend-icon="fa-file-signature"
                        v-model="contract.name"
                        :label="$t('form.contractAddForm.field.contract_name')"
                        @change="saveContractDataToStore"
                        required
                      />
                      <v-textarea
                        prepend-icon="fa-align-center"
                        v-model="contract.description"
                        :label="$t('form.contractAddForm.field.contract_description')"
                        @change="saveContractDataToStore"
                        required
                      />
                      <v-select
                        prepend-icon="fa-layer-group"
                        v-model="contract.categories"
                        @change="saveContractDataToStore"
                        chips
                        multiple
                        dense
                        deletable-chips
                        :items="categories"
                        :label="$t('form.contractAddForm.field.contract_categories')"
                      />
                      <ContractModuleConfiguration/>
                    </v-card-text>
                    <v-card-actions>
                      <v-spacer/>
                        <v-btn
                            text
                            @click="cancelAddContract"
                            color="primary">
                            {{ $t("base.button.back") }}
                        </v-btn>
                        <v-btn
                            outlined
                            @click="saveAndExit"
                            color="primary">
                            {{ $t("base.button.save_exit") }}
                        </v-btn>
                        <v-btn
                            @click="saveAndBuild"
                            color="primary">
                            {{ $t("base.button.save_build") }}
                        </v-btn>
                    </v-card-actions>
                </v-card>
              <loader v-else/>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
import ContractModuleConfiguration from '../../../components/Contract/New/ContractModuleConfiguration'

export default {
  name: 'CreateBaseView',
  components: {
    ContractModuleConfiguration
  },
  data () {
    return {
      categories: [],
      isLoaded: false,
      contract: {
        ...this.$store.getters.getNewContractData
      },
      contractId: this.$route.params.id || null
    }
  },
  methods: {
    getCategories () {
      this.isLoaded = false
      axios.get('/categories')
        .then(response => {
          this.categories = response.data.map(x => ({
            value: x.id,
            text: x.name
          }))
          this.isLoaded = true
        })
    },
    saveContractDataToStore () {
      this.$store.dispatch('newContract_setUpdate', this.contract)
    },
    cancelAddContract () {
      this.$store.dispatch('newContract_clear')
      this.$router.push('/panel/contracts/list')
    },
    saveAndExit () {
      this.saveContract(() => {
        this.$store.dispatch('newContract_clear')
        this.$router.push('/panel/contracts/list')
      })
    },
    saveAndBuild () {
      this.saveContract((res) => {
        this.$store.dispatch('newContract_setUpdate', {
          id: res.data.id,
          ...this.$store.getters.getNewContractData
        })
        this.$router.push('/panel/contracts/builder')
      })
    },
    saveContract (callback) {
      this.isLoaded = false
      const isEditMode = this.contractId !== null
      let request = null

      if (isEditMode) {
        request = axios.put(`/contract/${this.contractId}`, this.$store.getters.getNewContractData)
      } else {
        request = axios.post('/contract', this.$store.getters.getNewContractData)
      }

      request.then(response => {
        notify.push(
          this.$t('form.contractAddForm.notify.success'),
          notify.SUCCESS
        )
        if (callback) {
          callback(response)
        }
      })
        .finally(() => {
          this.isLoaded = true
        })
    },
    loadContract (callback) {
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
    this.getCategories()

    if (this.$route.params.id !== undefined) {
      this.loadContract()
    } else {
      this.isLoaded = true
    }
  }
}
</script>

<style scoped>

</style>
