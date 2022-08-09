<template>
  <v-list three-line v-if="contractsList.length && !isLoading">
    <v-list-item-group>
      <v-card v-for="item in contractsList" shaped class="mb-3" :key="item.id">
        <v-list-item @click="selectContract(item)">
          <v-list-item-content>
            <v-list-item-title> {{ item.name }}</v-list-item-title>
            <v-list-item-subtitle>
              <div class="mb-2 text-truncate">
                {{ item.description | striphtml }}
              </div>
              <v-chip
                v-for="category in item.categories"
                :key="category.id"
                class="mr-1"
                label
                color="primary"
                x-small
              >
                {{ category.name }}
              </v-chip>
            </v-list-item-subtitle>
          </v-list-item-content>
          <v-list-item-action>
            <v-btn
              color="primary"
              small
              outlined
              @click="selectContract(item)"
              >{{ $t("base.button.fillIn") }}</v-btn
            >
          </v-list-item-action>
        </v-list-item>
      </v-card>
    </v-list-item-group>
  </v-list>
  <v-alert v-else type="info">
    {{ $t("pages.form.noContract") }}
  </v-alert>
</template>

<script>
export default {
  name: "ContractList",
  props: ["searchCategory", "searchText"],
  data: () => ({
    contractItems: [],
    isLoading: false,
  }),
  computed: {
    searchData() {
      return {
        category: this.searchCategory,
        text: this.searchText,
      };
    },
    contractsList() {
      return this.contractItems.filter((x) => {
        const textAccept =
          x.name.toLowerCase().includes(this.searchData.text.toLowerCase()) ||
          x.description
            .toLowerCase()
            .includes(this.searchData.text.toLowerCase());
        const categoriesAccept = this.searchData.category.every((y) =>
          x.categories.some((z) => z.id === y)
        );
        return x.isAvailable && textAccept && categoriesAccept;
      });
    },
  },
  methods: {
    selectContract(selectedContract) {
      this.$router.push(`/client/form/${selectedContract.id}`);
    },
    getContractList() {
      this.isLoading = true;
      axios
        .get("/contract")
        .then((response) => {
          this.contractItems = response.data;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
  mounted() {
    this.getContractList();
  },
};
</script>
