<template>
    <v-row>
        <v-col>
            <h3>{{$t("pages.panel.contracts.builder.header")}} <span class="light-text" v-if="contract">{{contract.name}}</span></h3>
            <v-btn color="primary mt-3" small @click="showAttributeModal">{{$t("pages.panel.contracts.builder.attributeList")}}</v-btn>
        </v-col>
        <v-col md="5" class="d-flex justify-end">
            <v-btn text color="primary" @click="goBack">{{$t("base.button.back")}}</v-btn>
            <v-btn class="mx-2" outlined color="primary" @click="saveActual(false)">{{$t("base.button.save")}}</v-btn>
            <v-btn color="primary" @click="saveActual(true)">{{$t("base.button.save_exit")}}</v-btn>
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
      showAttributeModal(){
        this.$emit('show-attribute-modal');
      },
      init() {
        this.contract = this.$store.getters.getNewContractData;
        this.$store.dispatch("builder_set", this.contract.blocks);
        this.$store.dispatch("builder_setVariable", this.contract.attributesList);
      },
      goBack() {
        const updateState = this.$store.getters.getNewContractUpdateState;
        this.$router.push(`/panel/admin/contracts/edit/${updateState.id}`);
      },
      saveActual(redirect) {
        this.isLoaded = false;
        const updateState = this.$store.getters.getNewContractUpdateState;

        this.contract.blocks = this.$store.getters.builder_allBlocks;
        this.contract.attributesList = this.$store.getters.builder_allVariables;
        this.$store.dispatch("newContract_setUpdate", this.contract);

        axios.put(`/contract/${updateState.id}`, this.$store.getters.getNewContractData)
            .then(response => {
              notify.push(
                 $t("pages.panel.contracts.builder.savedNotify"),
                  notify.SUCCESS
              );
              if (redirect)
                this.$router.push("/panel/admin/contracts")
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
