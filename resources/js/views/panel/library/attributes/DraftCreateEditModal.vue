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
      <v-row class="mt-2">
        <v-btn color="primary mx-2" @click="tryAddNewAttribute">
          <v-icon left small>fa-plus</v-icon>
          Add new</v-btn>
        <v-text-field
          v-if="this.$store.getters.builder_allVariables.length > 0"
          label="Filter by name"
          v-model="searchText"
          dense
          hide-details
          outlined
        ></v-text-field>
        <v-btn color="primary" @click="showLibraryModal = true">
          <v-icon left small>fa-archive</v-icon>
          Get from library
        </v-btn>
      </v-row>
      <v-divider class="my-5"></v-divider>
      <div v-if="draft.content.length"
           class="text-center">
        <v-row>
          <v-col cols="12" md="4">
            <h4>Simple attributes</h4>
            <v-chip
              class="d-block ma-1 py-1 variable-chip"
              label
              close
              small
              v-for="attribute in defaultAttributes"
              :key="attribute.id"
              color="primary"
              @click="tryEditVariable(attribute)"
              @click:close="tryToRemoveAttribute(attribute)"
            >
              <v-avatar
                v-if="attribute.settings.isMultiUse"
                left
                class="yellow"
              >
              </v-avatar>
              <v-btn x-small text color="white" class="mx-1 attribute-copy" @click="(ev) => {
                      ev.stopPropagation();
                      copyAttribute(attribute)
                    }">
                <v-icon left small class="ma-0">fa-copy</v-icon>
              </v-btn>
              {{attribute.attributeName}}
            </v-chip>
          </v-col>
          <v-col cols="12" md="4">
            <h4>Attributes used in group</h4>
            <v-chip
              class="d-block ma-1 py-1"
              label
              small
              v-for="attribute in usedInGroupsAttributes"
              :key="attribute.id"
              color="primary"
              @click="tryEditVariable(attribute)"
            >
              <v-btn x-small text color="white" class="mx-1 attribute-copy" @click="(ev) => {
                      ev.stopPropagation();
                      copyAttribute(attribute)
                    }">
                <v-icon left small class="ma-0">fa-copy</v-icon>
              </v-btn>
              {{attribute.attributeName}}
            </v-chip>
          </v-col>
          <v-col cols="12" md="4">
            <h4>Group attributes</h4>
            <v-chip
              class="d-block ma-1 py-1 variable-chip"
              label
              close
              small
              v-for="attribute in groupsAttributes"
              :key="attribute.id"
              color="primary"
              @click="tryEditVariable(attribute)"
              @click:close="tryToRemoveAttribute(attribute)"
            >
              <v-avatar
                v-if="attribute.settings.isMultiUse"
                left
                class="yellow"
              >
              </v-avatar>
              <v-btn x-small text color="white" class="mx-1 attribute-copy" @click="(ev) => {
                ev.stopPropagation();
                copyAttribute(attribute)
              }">
                <v-icon left small class="ma-0">fa-copy</v-icon>
              </v-btn>
              {{attribute.attributeName}}
            </v-chip>
          </v-col>
        </v-row>
      </div>
      <v-alert
        v-else
        dense
        text
        class="mt-5 mb-0"
        type="info"
      >
        {{$t("pages.panel.contracts.builder.noVariables")}}
      </v-alert>
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

    <v-dialog persistent v-model="showDeleteDialog" max-width="290">
      <v-card>
        <v-card-title class="headline">
          {{ $t("pages.panel.contracts.builder.removeAttributeTitle") }}
        </v-card-title>
        <v-card-text>
          {{ $t("base.description.remove") }}
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn color="primary" text @click="showDeleteDialog = false">
            {{ $t("base.button.cancel") }}
          </v-btn>
          <v-btn color="error" @click="removeAttribute">
            {{ $t("base.button.remove") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog persistent
              v-model="showAddEditModal"
              scrollable
              max-width="800px">
      <CreateEditVariable
        v-if="showAddEditModal"
        :attribute="editAttribute"
        :all-attributes="draft.content"
        :no-store="true"
        @edit="editVariable"
        @add="addNewAttribute"
        @close="showAddEditModal = false"
      />
    </v-dialog>
    <v-dialog persistent
              v-model="showLibraryModal"
              scrollable
              max-width="500px">
      <VariableLibraryResolver
        @import="importAttributes"
        v-if="showLibraryModal"
        @close="showLibraryModal = false"
      />
    </v-dialog>
  </v-card>
</template>

<script>
import { AttributeTypeEnum } from '../../../../additionalModules/Enums'
import VariableLibraryResolver from '../../../../components/Contract/Builder/Modals/VariableLibraryResolver'
import CreateEditVariable from '../../../../components/Contract/Builder/Modals/VariableView/CreateEditVariable'

export default {
  name: 'DraftCreateEditModal',
  props: ['editAttributeId', 'categories'],
  components: {
    CreateEditVariable,
    VariableLibraryResolver
  },
  data () {
    return {
      idCounter: 0,
      showAddEditModal: false,
      showDeleteDialog: false,
      showLibraryModal: false,
      isLoaded: true,
      editAttribute: null,
      removedAttribute: null,
      searchText: '',
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
  computed: {
    defaultAttributes () {
      return this.draft.content
        .filter((x) => this.searchText.length < 3 || x.attributeName.toLowerCase().includes(this.searchText.toLowerCase()))
        .filter((x) => parseInt(x.attributeType) !== AttributeTypeEnum.ATTRIBUTE_GROUP)
        .filter((x) => !x.isInGroup)
    },
    usedInGroupsAttributes () {
      return this.draft.content
        .filter((x) => this.searchText.length < 3 || x.attributeName.toLowerCase().includes(this.searchText.toLowerCase()))
        .filter((x) => parseInt(x.attributeType) !== AttributeTypeEnum.ATTRIBUTE_GROUP)
        .filter((x) => x.isInGroup)
    },
    groupsAttributes () {
      return this.draft.content
        .filter((x) => this.searchText.length < 3 || x.attributeName.toLowerCase().includes(this.searchText.toLowerCase()))
        .filter((x) => parseInt(x.attributeType) === AttributeTypeEnum.ATTRIBUTE_GROUP)
    }
  },
  methods: {
    importAttributes (attributes) {
      attributes.forEach(attribute => {
        if (attribute.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
          attribute.settings.attributes = attribute.settings.attributes.map(attributeIn => {
            this.idCounter++
            attributeIn.id = this.idCounter
            this.draft.content.push({
              ...attributeIn
            })

            return {
              ...attributeIn
            }
          })
        }
        this.idCounter++
        this.draft.content.push({
          ...attribute,
          id: this.idCounter
        })
      })

      this.idCounter++
    },
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
      this.idCounter = Math.max(...this.draft.content.map(x => parseInt(x.id)))
    },
    loadNewDraftData () {
      this.draft = {
        ...this.$store.getters.library_attributes_getDefaultDraft
      }
    },
    tryToRemoveAttribute (attribute) {
      this.removedAttribute = attribute
      this.showDeleteDialog = true
    },
    tryAddNewAttribute () {
      this.editAttribute = null
      this.showAddEditModal = true
    },
    tryEditVariable (attribute) {
      this.editAttribute = {
        ...attribute
      }

      this.showAddEditModal = true
    },
    copyAttribute (attribute) {
      this.idCounter++
      this.draft.content.push({
        ...attribute,
        id: this.idCounter,
        isInGroup: false,
        attributeName: attribute.attributeName + ' copy'
      })
    },
    addNewAttribute (attribute) {
      this.idCounter++
      this.draft.content.push({
        ...attribute,
        id: this.idCounter
      })
    },
    removeAttribute () {
      this.draft.content = this.draft.content.filter(x => parseInt(x.id) !== parseInt(this.removedAttribute.id))
      this.showDeleteDialog = false
    },
    editVariable (attribute) {
      this.draft.content = this.draft.content.map(x => {
        if (parseInt(x.id) === parseInt(attribute.id)) {
          return {
            ...attribute
          }
        }
        return x
      })
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

<style lang="scss">
  .variable-chip{
    .v-avatar{
      background: #E91E63 !important;
      position: absolute;
      left: -31px;
      padding: 0;
      margin: 0;
      width: 50px !important;
      height: 50px !important;
    }
  }
</style>
