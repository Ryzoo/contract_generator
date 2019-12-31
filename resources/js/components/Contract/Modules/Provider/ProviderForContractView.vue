<template>
  <section v-if="!isLoading">
    <v-card-title>Ten kontroler ma włączony moduł dostarczania umowy</v-card-title>
    <v-divider/>
    <v-card-text>
      <p>Aktualnie wybrany jest tryb renderowania pliku pdf do przeglądarki</p>
    </v-card-text>
    <v-card-actions>
      <v-spacer/>
      <v-btn
        color="primary"
        @click="renderContract">
        Renderuj
      </v-btn>
    </v-card-actions>
  </section>
  <loader v-else/>
</template>

<script>
import { ContractProviderType } from './Enums'

export default {
  name: 'ProviderForContractView',
  props: ['contract', 'actualModule'],
  data () {
    return {
      ContractProviderType: ContractProviderType,
      isLoading: false,
      actualRenderType: this.actualModule.settings.type
    }
  },
  methods: {
    renderContract () {
      this.isLoading = true
      axios({
        url: `/contract/${this.contract.id}/render`,
        method: 'POST',
        responseType: 'blob',
        data: {
          formElements: this.$store.getters.formElements
        }
      })
        .then((response) => {
          Notify.push('Render zakończony pomyślnie', Notify.SUCCESS)
          const url = window.URL.createObjectURL(new Blob([response.data]))
          const link = document.createElement('a')
          link.href = url
          link.setAttribute('download', 'file.pdf')
          document.body.appendChild(link)
          link.click()
        })
        .finally(() => {
          this.isLoading = false
          this.$router.back()
        })
    }
  }
}
</script>
