<template>
  <v-card>
    <v-card-title>Attribute list:</v-card-title>
    <v-divider/>
    <v-card-text>
      <div class="variables-list">
          <span v-for="attribute in attributesList" class="variable" @click="editVariable(attribute)">{{attribute.attributeName}}<div><v-icon
            @click="deleteVariable($event, attribute)" class="delete-variable" small>fa-times</v-icon></div></span>
      </div>
    </v-card-text>
    <v-card-actions>
      <v-spacer/>
      <v-btn color="primary" outlined @click="pushCloseEvent">Exit</v-btn>
      <v-btn color="primary" @click="addNewAttribute">Add new variable</v-btn>
    </v-card-actions>

    <v-dialog
      v-model="showAddEditModal"
      scrollable
      max-width="500px">
      <CreateEditVariable :editAttribute="attribute" :attributesList="attributesList" @close="showAddEditModal=false"/>
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
        variableOptions: [],
        attributesList: [],
        attribute: null,
        allAttributes: [],
        isNewAttribute: true,
      }
    },
    mounted() {
      this.getAllAttributes();
      this.attributesList = this.$store.getters.builder_allVariables;
    },
    methods: {
      addNewAttribute() {
        this.attribute = null;
        this.showAddEditModal = true;
      },
      pushCloseEvent() {
        this.$emit('close');
      },
      editVariable(attribute) {
        this.attribute = attribute;
        this.showAddEditModal = true;
      },
      deleteVariable(e, attribute) {
        e.stopPropagation();
        this.attributesList = this.attributesList.filter((item) => item.id !== attribute.id)
        this.$store.dispatch("builder_setVariable", this.attributesList);
      }
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

</style>
