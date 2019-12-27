<template>
  <v-row>
    <v-col v-if="isLoaded">
      <v-row>
        <v-col>
          <v-btn :to="{ name: 'createRoles' }" color="primary">
            {{ $t("pages.panel.roles.buttons.new") }}
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col xs="12">
          <v-data-table
            class="elevation-2"
            :headers="headers"
            :items="items"
          >
            <template v-slot:item.name="{ item }">
                {{ item.name }}
            </template>
            <template v-slot:item.name="{ item }">
              {{ item.description }}
            </template>
            <template v-slot:item.action="{ item }">
              <div class="table-icons">
                <v-icon @click="$router.push(`/panel/admin/settings/roles/${item.id}/edit`)">fa-edit</v-icon>
                <v-icon @click="tryToRemove(item.id)">fa-trash</v-icon>
              </div>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-col>
    <loader v-else></loader>

    <v-dialog persistent v-model="deleteDialog" max-width="290">
      <v-card>
        <v-card-title class="headline">{{$t("form.roleRemoveForm.title")}}</v-card-title>

        <v-card-text>
          {{ $t("base.description.remove") }}
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn color="primary" text @click="deleteDialog = false">
            {{ $t("base.button.cancel") }}
          </v-btn>
          <v-btn color="error" @click="removeRole">
            {{ $t("base.button.remove") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  name: 'RolesView',
  components: {},
  data () {
    return {
      deleteDialog: false,
      isLoaded: true,
      headers: [
        {
          text: this.$t('base.headers.name'),
          value: 'name'
        },
        {
          text: this.$t('base.headers.descriptions'),
          value: 'description'
        },
        {
          text: this.$t('base.headers.actions'),
          value: 'action',
          sortable: false
        }
      ],
      items: [],
      removeRoleId: null
    }
  },
  methods: {
    tryToRemove (id) {
      this.removeRoleId = id
      this.deleteDialog = true
    },
    removeRole () {
      this.isLoaded = false
      axios
        .delete(`/role/${this.removeRoleId}`)
        .then(response => {
          this.items = this.items.filter(
            e => e.id !== this.removeRoleId
          )
          this.removeRoleId = null
          this.deleteDialog = false
          notify.push(
            this.$t('form.roleRemoveForm..notify.successRemove'),
            notify.SUCCESS
          )
        })
        .finally(() => {
          this.isLoaded = true
        })
    },
    getRoleList () {
      this.isLoaded = false
      axios
        .get('/role')
        .then(response => {
          this.items = response.data
        })
        .finally(() => {
          this.isLoaded = true
        })
    }
  },
  mounted () {
    this.getRoleList()
  }
}
</script>

<style scoped></style>
