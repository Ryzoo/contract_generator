<template>
    <section v-if="isLoading">
        <h3>Ten kontroler ma włączony moduł dostarczania umowy</h3>
        <v-divider dark class="my-3"></v-divider>
        <p>Aktualnie wybrany jest tryb renderowania pliku pdf do przeglądarki</p>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                color="success"
                @click="finishContractForm">
                Renderuj
            </v-btn>
        </v-card-actions>
    </section>
    <loader v-else></loader>
</template>

<script>
  import {ContractProviderType} from "./Enums";

  export default {
    name: "ProviderForContractView",
    props: ['contract', 'actualModule'],
    data(){
      return {
        ContractProviderType: ContractProviderType,
        isLoading: false,
        actualRenderType: this.actualModule.settings.type
      }
    },
    methods: {
      finishContractForm() {

        switch(parseInt(this.actualRenderType)){
          case ContractProviderType.RENDER:
            this.renderContract();
            break;
          case AuthType.LOGIN:
            // TODO
            break;
          case AuthType.PASSWORD:
           // TODO
            break;
        }
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
    }
  }
</script>

<style scoped>

</style>
