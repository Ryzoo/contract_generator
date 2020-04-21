<template>
  <v-card>
    <v-card-title class="headline">
      Variables drafts
    </v-card-title>

    <v-card-text v-if="!isLoading">
      <v-sheet class="pa-4 primary lighten-2" v-if="itemToTree.length">
        <v-text-field
          v-model="searchText"
          label="Search drafts"
          dark
          flat
          solo-inverted
          hide-details
          clearable
          clear-icon="mdi-close-circle-outline"
        ></v-text-field>
      </v-sheet>
      <v-alert class="my-3" width="100%" prominent type="info" v-if="!itemToTree.length">
        Any drafts in library!
      </v-alert>
      <v-treeview
        v-model="selected"
        v-if="itemToTree.length"
        class="my-3"
        :search="searchText"
        selectable
        hoverable
        rounded
        return-object
        open-on-click
        selected-color="success"
        :items="itemToTree"
      ></v-treeview>
    </v-card-text>
    <loader v-else></loader>

    <v-card-actions>
      <div class="flex-grow-1"></div>
      <v-btn color="primary" text @click="closeDialog">
        {{ $t("base.button.cancel") }}
      </v-btn>
      <v-btn color="primary" :disabled="!selected.length" @click="importAttributes">
        Import selected
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import { AttributeTypeEnum } from '../../../../additionalModules/Enums'

export default {
  name: 'VariableLibraryResolver',
  data () {
    return {
      searchText: '',
      isLoading: true,
      draftAttributes: [],
      itemToTree: [],
      selected: []
    }
  },
  methods: {
    closeDialog () {
      this.$emit('close')
    },
    importAttributes () {
      this.$emit('import', this.selected.map(x => x.attribute))
    },
    loadAttributes () {
      this.isLoading = true
      axios.get('library/variables')
        .then(response => {
          this.draftAttributes = response.data.map(x => ({
            ...x,
            content: JSON.parse(x.content)
          }))
          this.mapAttributesToItems()
        })
        .finally(() => {
          this.isLoading = false
        })
    },
    mapAttributesToItems () {
      const items = []
      this.draftAttributes.forEach(draft => {
        items.push({
          draft: draft,
          id: draft.id,
          name: draft.name,
          children: this.getAttributesListFromDraft(draft)
        })
      })
      this.itemToTree = items
    },
    getAttributesListFromDraft (draft) {
      const atrUsedInGroup = []
      draft.content.forEach(x => {
        if (x.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
          x.settings.attributes.forEach(y => {
            atrUsedInGroup.push(parseInt(y.id))
          })
        }
      })

      return draft.content
        .filter(x => !atrUsedInGroup.includes(parseInt(x.id)))
        .map(attribute => {
          return {
            attribute,
            id: `${draft.id}-${attribute.id}`,
            name: attribute.attributeName
          }
        })
    }
  },
  mounted () {
    this.loadAttributes()
  }
}
</script>

<style scoped>

</style>
