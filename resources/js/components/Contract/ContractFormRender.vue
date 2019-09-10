<template>
    <v-card
        v-if="!isLoading"
        color="#446477"
        dark
    >
        <v-card-text class="white--text">
            <div class="headline mb-2">{{contract.name}}</div>
            <v-divider></v-divider>
            <form-renderer
                :attributes="attributesList"
            ></form-renderer>
        </v-card-text>

        <v-card-actions>
            <div class="flex-grow-1"></div>
            <v-btn color="primary" @click="renderContract()">Wygeneruj umowę</v-btn>
        </v-card-actions>
    </v-card>
    <loader v-else></loader>
</template>

<script>
  import FormRenderer from "./Form/FormRenderer";

  export default {
    name: "ContractFormRender",
    props: ["contract"],
    components: {
      FormRenderer
    },
    data() {
      return {
        isLoading: false,
      }
    },
    computed: {
      attributesList () {
        return this.$store.getters.formAttributes;
      }
    },
    watch: {
      contract(oldValue, newValue) {
        if (oldValue !== newValue) {
          this.loadContractForm();
        }
      }
    },
    methods: {
      loadContractForm() {
        this.isLoading = true;
        axios.get(`/contract/${this.contract.id}/form`)
            .then((response) => {
              this.$store.dispatch("setAttributes", response.data.map(e => e.attribute));
            })
            .finally(() => {
              this.isLoading = false;
            })
      },
      renderContract(){
        this.isLoading = true;
        axios({
          url: `/contract/${this.contract.id}/render`,
          method: 'POST',
          responseType: 'blob',
          data: {
            attributesList: this.$store.getters.formAttributes
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
    },
    mounted() {
      this.loadContractForm();
    }
  }
</script>

<style scoped>

</style>
