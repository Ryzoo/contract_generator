<template>
  <v-card class="ma-auto" width="800px" v-if="isLoaded">
    <v-card-title>
      <span>{{draftList.length}} attributes in library</span>
      <v-spacer></v-spacer>
      <v-btn v-if="draftList.length" color="primary" @click="addVariable">+ Add new attribute</v-btn>
    </v-card-title>

    <v-card-text>
      <section v-if="draftList.length">
        <v-divider></v-divider>
        <v-list two-line class="attributes-list">
          <v-list-item v-for="draft in draftList" :key="draft.id" >
            <v-list-item-content>
              <v-list-item-title>
                <v-chip
                  v-if="draft.category && draft.category.length"
                  class="mr-2"
                  color="pink"
                  small
                  label
                  text-color="white"
                >
                  {{draft.category}}
                </v-chip> {{draft.name}}
              </v-list-item-title>
              <v-list-item-subtitle>{{draft.description}}</v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-icon>
              <v-btn small text color="primary" @click="() => editVariable(draft)"> Edit <v-icon small right>fa-edit</v-icon> </v-btn>
              <v-btn small text color="error" @click="() => deleteVariable(draft)"> Delete <v-icon small right>fa-trash</v-icon> </v-btn>
            </v-list-item-icon>
          </v-list-item>
        </v-list>
      </section>
      <v-alert type="info" prominent v-else>
        <v-row align="center">
          <v-col class="grow">Any attributes in library. Create one!</v-col>
          <v-col class="shrink">
            <v-btn color="white" outlined @click="addVariable">+ Add new attribute</v-btn>
          </v-col>
        </v-row>
      </v-alert>
    </v-card-text>

    <v-dialog
      persistent
      v-model="showCreateEditModal"
      scrollable
      max-width="800px">
      <AttributeCreateEditModal
        :categories="categoriesForDrafts"
        :edit-attribute-id="attributeToEdit"
        @close="showCreateEditModal=false"
      />
    </v-dialog>
    <v-dialog persistent v-model="showDeleteModal" max-width="290">
      <v-card>
        <v-card-title class="headline">Delete attribute from library</v-card-title>

        <v-card-text>
          Do you want to completely remove this attribute?
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn color="primary" text @click="showDeleteModal = false">
            {{ $t("base.button.cancel") }}
          </v-btn>
          <v-btn color="error" @click="forceDeleteVariable">
            {{ $t("base.button.remove") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
  <loader v-else></loader>
</template>

<script>
import AttributeCreateEditModal from './AttributeCreateEditModal'
export default {
  name: 'AttributesLibraryView',
  components: { AttributeCreateEditModal },
  data () {
    return {
      showCreateEditModal: false,
      showDeleteModal: false,
      attributeToDelete: null,
      attributeToEdit: null,
      isLoaded: false
    }
  },
  computed: {
    draftList () {
      return this.$store.getters.library_attributes_getDraftList
    },
    categoriesForDrafts () {
      return this.draftList.filter(x => x.category && x.category.length).map(x => x.category)
    }
  },
  methods: {
    forceDeleteVariable () {
      this.isLoaded = false
      axios.delete('/library/variables/' + this.attributeToDelete)
        .then(() => {
          this.showDeleteModal = false
          this.$store.dispatch('library_attributes_deleteDraft', this.attributeToDelete)
        })
        .finally(() => {
          this.isLoaded = true
        })
    },
    addVariable () {
      this.attributeToEdit = null
      this.showCreateEditModal = true
    },
    editVariable (attribute) {
      this.attributeToEdit = attribute.id
      this.showCreateEditModal = true
    },
    deleteVariable (attribute) {
      this.showDeleteModal = true
      this.attributeToDelete = attribute.id
    },
    loadVariables () {
      this.isLoaded = false
      axios.get('/library/variables')
        .then(response => {
          this.$store.dispatch('library_attributes_setDraftList', response.data)
        })
        .finally(() => {
          this.isLoaded = true
        })
    }
  },
  mounted () {
    this.loadVariables()
  }
}
</script>

<style lang="scss" scoped>
  .attributes-list{
    .v-list-item:nth-child(odd){
      background: #ededed;
    }
  }
</style>
