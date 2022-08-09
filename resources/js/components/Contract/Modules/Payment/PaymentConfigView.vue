<template>
  <section>
    <h6>{{ $t("module.payment.descriptionConfig") }}</h6>
    <v-divider class="my-3" />
    <v-row>
      <v-col>
        <v-text-field
          type="text"
          v-model="settings.description"
          label="Payment title"
        />
      </v-col>
      <v-col>
        <v-text-field type="number" v-model="settings.amount" label="Amount" />
      </v-col>
      <v-col>
        <v-text-field
          type="text"
          v-model="settings.currency"
          label="Currency"
        />
      </v-col>
      <v-col>
        <v-text-field type="text" v-model="settings.country" label="Country" />
      </v-col>
    </v-row>
  </section>
</template>

<script>
export default {
  name: "PaymentConfigView",
  props: ["module"],
  data() {
    return {
      settings:
        this.$store.getters.getModuleSettings(this.module.slug) ||
        this.module.settings,
    };
  },
  methods: {
    saveConfig() {
      this.$store.dispatch("newContract_saveModuleConfig", {
        slug: this.module.slug,
        value: this.settings,
      });
    },
  },
};
</script>
