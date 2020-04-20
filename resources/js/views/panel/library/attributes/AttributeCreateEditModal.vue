<template>
  <v-card>
    <v-card-title class="headline">
      {{ !isNew ? 'Edit attributes draft' : 'Create new attributes draft'}}
    </v-card-title>

    <v-card-text class="my-2" v-if="draft && isLoaded">
      <v-form v-model="form.valid">
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              prepend-icon="fa-file-signature"
              v-model="draft.name"
              outlined
              :rules="form.rules.name"
              dense
              label="Name"
              required
            />
            <v-combobox
              prepend-icon="fa-layer-group"
              v-model="draft.category"
              :items="categories"
              label="Category"
              outlined
              :rules="form.rules.category"
              chips
              clearable
              deletable-chips
              required
              dense
            ></v-combobox>
          </v-col>
          <v-col cols="12" md="6">
            <v-textarea
              prepend-icon="fa-align-center"
              v-model="draft.description"
              outlined
              :rules="form.rules.description"
              dense
              label="Description"
              required
            />
          </v-col>
        </v-row>
      </v-form>
      <v-divider></v-divider>
      <v-expansion-panels class="mt-5">
        <v-expansion-panel>
          <v-expansion-panel-header>Attributes content</v-expansion-panel-header>
          <v-expansion-panel-content>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-card-text>
    <loader v-else></loader>

    <v-card-actions>
      <div class="flex-grow-1"></div>
      <v-btn color="primary" text @click="closeDialog">
        {{ $t("base.button.cancel") }}
      </v-btn>
      <v-btn v-if="!isNew" :disabled="!form.valid" color="primary" @click="saveDraft">
        Save
      </v-btn>
      <v-btn v-else :disabled="!form.valid" color="primary" @click="createDraft">
        Create
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'AttributeCreateEditModal',
  props: ['editAttributeId', 'categories'],
  data () {
    return {
      isLoaded: true,
      form: {
        valid: true,
        rules: {
          name: [
            v => !!v || 'Name is required',
            v => v.length >= 3 || 'Name must be grater than 10 characters'
          ],
          description: [
            v => !!v || 'Description is required',
            v => v.length >= 3 || 'Description must be grater than 3 characters'
          ],
          category: [
            v => !!v || 'Category is required'
          ]
        }
      },
      draft: null,
      isNew: this.editAttributeId === null || this.editAttributeId === undefined
    }
  },
  watch: {
    editAttributeId () {
      this.isNew = this.editAttributeId === null || this.editAttributeId === undefined
      if (this.isNew) {
        this.loadNewDraftData()
      } else {
        this.loadExistedDraftData()
      }
    }
  },
  methods: {
    closeDialog () {
      this.$emit('close')
    },
    saveDraft () {
      this.isLoaded = false
      axios.put('/library/variables/' + this.editAttributeId, {
        ...this.draft,
        content: JSON.stringify(this.draft.content)
      })
        .then(() => {
          this.$store.dispatch('library_attributes_updateDraft', this.draft)
          this.closeDialog()
        })
        .finally(() => {
          this.isLoaded = true
        })
    },
    createDraft () {
      this.isLoaded = false
      axios.post('/library/variables/', {
        ...this.draft,
        content: JSON.stringify(this.draft.content)
      })
        .then((response) => {
          this.draft.id = response.data
          this.$store.dispatch('library_attributes_addDraft', this.draft)
          this.closeDialog()
        })
        .finally(() => {
          this.isLoaded = true
        })
    },
    loadExistedDraftData () {
      this.draft = {
        ...this.$store.getters.library_attributes_getExistedDraft(this.editAttributeId)
      }
    },
    loadNewDraftData () {
      this.draft = {
        ...this.$store.getters.library_attributes_getDefaultDraft
      }
    }
  },
  mounted () {
    if (this.isNew) {
      this.loadNewDraftData()
    } else {
      this.loadExistedDraftData()
    }
  }
}
</script>

<style scoped>

</style>
