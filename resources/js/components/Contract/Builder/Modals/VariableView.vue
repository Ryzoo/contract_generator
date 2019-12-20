<template>
  <v-card>
    <v-card-title>Attribute list:</v-card-title>
    <v-divider/>
    <v-card-text>
      <div v-if="$store.getters.builder_allVariables.length > 0" class="variables-list">
          <span v-for="attribute in $store.getters.builder_allVariables" class="variable" @click="editVariable(attribute)"><b>[{{attribute.id}}]</b> {{attribute.attributeName}}<div><v-icon
            @click="tryToRemoveAttribute($event, attribute)" class="delete-variable" small>fa-times</v-icon></div></span>
      </div>
      <div v-else class="no-variables">
        <h2>{{$t("pages.panel.contracts.builder.noVariables")}}</h2>
      </div>
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
      <CreateEditVariable :isNewAttribute="isNewAttribute" :editAttribute="attribute" :attributesList="$store.getters.builder_allVariables" @close="showAddEditModal=false"/>
    </v-dialog>
  </v-card>
</template>

<script>
  import CreateEditVariable from "./VariableView/CreateEditVariable";

  export default {
    name: "VariableView",
    components: {
      CreateEditVariable
    },
    data() {
      return {
        showAddEditModal: false,
        deleteDialog: false,
        variableOptions: [],
        attribute: null,
        allAttributes: [],
        isNewAttribute: true,
        removedAttribute: null
      }
    },
    methods: {
      tryToRemoveAttribute(e, attribute){
        e.stopPropagation();
        this.removedAttribute = attribute;
        this.deleteDialog = true;
      },
      removeAttribute(){
        this.$store.dispatch("builder_removeVariable", this.removedAttribute.id);
        this.deleteDialog = false;
      },
      addNewAttribute() {
        this.attribute = null;
        this.isNewAttribute = true;
        this.showAddEditModal = true;
      },
      pushCloseEvent() {
        this.$emit('close');
      },
      editVariable(attribute) {
        this.attribute = attribute;
        this.isNewAttribute = false;
        this.showAddEditModal = true;
      },
    }
  }
</script>

<style scoped lang="scss">
  .variables-list {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;

    .variable {
      background: #dabd79 0% 0% no-repeat padding-box;
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
