<template>
  <v-card>
    <v-card-title>Attribute list:</v-card-title>
    <v-divider/>
    <v-card-text>
      <v-row class="mt-2">
        <v-btn color="primary mx-2" @click="addNewAttribute">+ Add new</v-btn>
        <v-text-field
          v-if="this.$store.getters.builder_allVariables.length > 0"
          label="Filter by name"
          v-model="searchText"
          dense
          hide-details
          outlined
        ></v-text-field>
      </v-row>

      <div v-if="this.$store.getters.builder_allVariables.length > 0"
           class="text-center">
        <v-row>
          <v-col cols="12" md="4">
            <h4>Simple attributes</h4>
            <v-chip
              class="d-block ma-1 py-1"
              label
              close
              small
              v-for="attribute in defaultAttributes"
              :key="attribute.id"
              color="primary"
              @click="editVariable(attribute)"
              @click:close="tryToRemoveAttribute(attribute)"
            >
              {{attribute.attributeName}}
            </v-chip>
          </v-col>
          <v-col cols="12" md="4">
            <h4>Attributes used in group</h4>
            <v-chip
              class="d-block ma-1 py-1"
              label
              close
              small
              v-for="attribute in usedInGroupsAttributes"
              :key="attribute.id"
              color="primary"
              @click="editVariable(attribute)"
              @click:close="tryToRemoveAttribute(attribute)"
            >
              {{attribute.attributeName}}
            </v-chip>
          </v-col>
          <v-col cols="12" md="4">
            <h4>Group attributes</h4>
            <v-chip
              class="d-block ma-1 py-1"
              label
              close
              small
              v-for="attribute in groupsAttributes"
              :key="attribute.id"
              color="primary"
              @click="editVariable(attribute)"
              @click:close="tryToRemoveAttribute(attribute)"
            >
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
    <v-card-actions>
      <v-spacer/>
      <v-btn color="primary" outlined @click="pushCloseEvent">Exit</v-btn>
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
      max-width="800px">
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
import { AttributeTypeEnum } from '../../../../additionalModules/Enums'

export default {
  name: 'VariableView',
  components: {
    CreateEditVariable
  },
  data () {
    return {
      AttributeTypeEnum: AttributeTypeEnum,
      searchText: '',
      showAddEditModal: false,
      deleteDialog: false,
      attribute: null,
      removedAttribute: null
    }
  },
  computed: {
    defaultAttributes () {
      return this.$store.getters.builder_allVariables
        .filter((x) => this.searchText.length < 3 || x.attributeName.toLowerCase().includes(this.searchText.toLowerCase()))
        .filter((x) => parseInt(x.attributeType) !== AttributeTypeEnum.ATTRIBUTE_GROUP)
        .filter((x) => !x.isInGroup)
    },
    usedInGroupsAttributes () {
      return this.$store.getters.builder_allVariables
        .filter((x) => this.searchText.length < 3 || x.attributeName.toLowerCase().includes(this.searchText.toLowerCase()))
        .filter((x) => parseInt(x.attributeType) !== AttributeTypeEnum.ATTRIBUTE_GROUP)
        .filter((x) => x.isInGroup)
    },
    groupsAttributes () {
      return this.$store.getters.builder_allVariables
        .filter((x) => this.searchText.length < 3 || x.attributeName.toLowerCase().includes(this.searchText.toLowerCase()))
        .filter((x) => parseInt(x.attributeType) === AttributeTypeEnum.ATTRIBUTE_GROUP)
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
  .v-chip.v-size--small {
    height: auto !important;
  }

  .v-chip {
    white-space: normal !important;
  }

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
