<template>
  <section>
    <v-card
      class="mx-auto"
      max-width="700"
      style="margin-top: -50px;"
    >
      <v-card-text>
        <v-row>
          <v-col class="py-0" cols="12">
            <h3>{{$t('pages.form.filter.main')}}</h3>
          </v-col>
          <v-col cols="12" sm="6">
            <v-text-field
              :label="$t('pages.form.filter.text')"
              outlined
              hide-details
              dense
              v-model="searchText"
            />
          </v-col>
          <v-col cols="12" sm="6">
            <v-select
              :label="$t('pages.form.filter.categories')"
              outlined
              hide-details
              chips deletable-chips small-chips multiple
              dense
              :items="categoriesList"
              v-model="searchCategory"
            />
          </v-col>
          <v-col cols="12">
            <v-divider/>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
    <v-row style="max-width: 900px" class="mt-5 mx-auto">
      <v-col cols="12">
        <contract-list
          v-if="isLoaded"
          :search-category="searchCategory"
          :search-text="searchText"
        />
        <loader v-else/>
      </v-col>
    </v-row>
  </section>
</template>

<script>
import ContractList from '../../../components/Contract/ContractList'

export default {
  name: 'ContractFormView',
  components: {
    ContractList
  },
  data () {
    return {
      searchText: '',
      categoriesList: [],
      searchCategory: [],
      isLoaded: true
    }
  },
  methods: {
    getCategories () {
      this.isLoaded = false
      axios.get('/categories')
        .then(response => {
          this.categoriesList = response.data.map(x => ({
            value: x.id,
            text: x.name
          }))
          this.isLoaded = true
        })
    }
  },
  mounted () {
    this.getCategories()
  }
}
</script>
