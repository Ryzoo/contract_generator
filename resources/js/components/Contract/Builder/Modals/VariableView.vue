<template>
  <v-card>
    <v-card-title>Attribute list:</v-card-title>
    <v-divider/>
    <v-card-text>
      <v-text-field
        v-if="this.$store.getters.builder_allVariables.length > 0"
        label="Filter by name"
        class="mt-2"
        v-model="searchText"
        dense
        hide-details
        outlined
      ></v-text-field>
      <div v-if="currentVariable.length > 0"
           class="text-center">
          <v-chip
            class="d-block ma-1"
            label
            close
            small
            v-for="attribute in currentVariable"
            :key="attribute.id"
            color="primary"
            @click="editVariable(attribute)"
            @click:close="tryToRemoveAttribute(attribute)"
          >
            <b>[{{attribute.id}}]&nbsp;</b>
            {{attribute.attributeName}}
          </v-chip>
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
    <v-card-actions>
      <v-spacer/>
      <v-btn color="primary" outlined @click="pushCloseEvent">Exit</v-btn>
      <v-btn color="primary" @click="addNewAttribute">Add new variable</v-btn>
    </v-card-actions>

    <v-dialog persistent v-model="deleteDialog" max-width="290">
      <v-card>
        <v-card-title class="headline">
          {{ $t("pages.panel.contracts.builder.removeAttributeTitle") }}
        </v-card-title>

        <v-card-text>
          {{ $t("base.description.remove") }}
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn color="primary" text @click="deleteDialog = false">
            {{ $t("base.button.cancel") }}
          </v-btn>
          <v-btn color="error" @click="removeAttribute">
            {{ $t("base.button.remove") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
      v-model="showAddEditModal"
      scrollable
      max-width="500px">
      <CreateEditVariable
        v-if="showAddEditModal"
        :attribute="attribute"
        @close="showAddEditModal = false"
      />
    </v-dialog>
  </v-card>
</template>

<script>
import CreateEditVariable from './VariableView/CreateEditVariable'

export default {
  name: 'VariableView',
  components: {
    CreateEditVariable
  },
  data () {
    return {
      searchText: '',
      showAddEditModal: false,
      deleteDialog: false,
      attribute: null,
      removedAttribute: null
    }
  },
  computed: {
    currentVariable () {
      return this.$store.getters.builder_allVariables.filter((x) => this.searchText.length < 3 || x.attributeName.toLowerCase().includes(this.searchText.toLowerCase()))
    }
  },
  methods: {
    tryToRemoveAttribute (attribute) {
      this.removedAttribute = attribute
      this.deleteDialog = true
    },
    removeAttribute () {
      this.$store.dispatch('builder_removeVariable', this.removedAttribute.id)
      this.deleteDialog = false
    },
    addNewAttribute () {
      this.attribute = null
      this.showAddEditModal = true
    },
    pushCloseEvent () {
      this.$emit('close')
      this.showAddEditModal = false
    },
    editVariable (attribute) {
      this.attribute = {
        ...attribute
      }
      this.showAddEditModal = true
    }
  }
}
</script>

<style scoped lang="scss">
  @import "./../../../../../sass/colors";

  .variables-list {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;

    .variable {
      background: $primary 0% 0% no-repeat padding-box;
      padding: 3px 8px;
      border-radius: 5px;
      color: white;
      margin: 5px;
      display: flex;

      .delete-variable {
        padding: 0 5px;
        margin-left: 10px;
      }

      &:hover {
        cursor: pointer;
      }
    }
  }

  .no-variables {
    display: flex;
    justify-content: center;
    padding: 15px;
    opacity: 0.3;
  }

</style>
