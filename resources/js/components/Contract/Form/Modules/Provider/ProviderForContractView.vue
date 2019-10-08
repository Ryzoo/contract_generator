<template>
    <section v-if="!isLoading">
        <h3>Ten kontroler ma włączony moduł dostarczania umowy</h3>
        <v-divider dark class="my-3"></v-divider>
        <p>W przyszłości ma za zadanie dostarczać wyrenderowaną umowę w określony w ustawieniach sposób </br>
            Będzie rozszerzony również o opcje pozwalające na odpowiednie notyfikacje - np admina</p>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                color="success"
                @click="finishContractForm">
                Pokaż umowę
            </v-btn>
        </v-card-actions>
    </section>
    <loader v-else></loader>
</template>

<script>
  export default {
    name: "ProviderForContractView",
    props: ['contract'],
    data(){
      return {
        isLoading: false,
      }
    },
    methods: {
      finishContractForm() {
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
      },
    }
  }
</script>

<style scoped>

</style>
