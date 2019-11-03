<template>
    <v-row>
        <v-col>
            <h3>Budujesz: <span class="light-text">{{this.contract.name}}</span></h3>
        </v-col>
        <v-col md="5" class="d-flex justify-end">
            <v-btn text color="primary" @click="goBack">Powrót</v-btn>
            <v-btn class="mx-2" outlined color="primary" @click="saveActual(false)">Zapisz</v-btn>
            <v-btn color="primary" @click="saveActual(true)">Zapisz i wyjdź</v-btn>
        </v-col>
    </v-row>
</template>

<script>
  export default {
    name: "Header",
    data() {
      return {
        contract: null,
        isLoaded: true
      }
    },
    methods: {
      init() {
        this.contract = this.$store.getters.getNewContractData;
      },
      goBack() {
        const updateState = this.$store.getters.getNewContractUpdateState;
        this.$router.push(`/panel/contracts/edit/${updateState.id}`);
      },
      saveActual(redirect) {
        this.isLoaded = false;
        const updateState = this.$store.getters.getNewContractUpdateState;

        axios.put(`/contract/${updateState.id}`, this.$store.getters.getNewContractData)
            .then(response => {
              notify.push(
                  "Umowa zapisana!",
                  notify.SUCCESS
              );
              if (redirect)
                this.$router.push("/panel/contracts")
            })
            .finally(() => {
              this.isLoaded = true;
            });
      }
    },
    mounted() {
      this.init();
    }
  }
</script>

<style scoped>
    .light-text {
        font-weight: 300;
    }
</style>
