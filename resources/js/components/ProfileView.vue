<template>
    <v-row>
        <v-col xs="12" sm="4" lg="3" class="pa-1">
          <base-data-show
            :user-data="user"
            :editable="editable"
          />
        </v-col>
        <v-col xs="12" sm="8" lg="9" class="pa-1">
          <profile-data-tabs
            :user-data="user"
            :editable="editable"
          />
        </v-col>
    </v-row>
</template>

<script>
import BaseDataShow from './ProfileView/BaseDataShow'
import ProfileDataTabs from './ProfileView/ProfileDataTabs'

export default {
  name: 'ProfileView',
  components: {
    'base-data-show': BaseDataShow,
    'profile-data-tabs': ProfileDataTabs
  },
  props: ['userData', 'editable'],
  data () {
    return {
      user: this.userData
    }
  }
}
</script>

<style scoped></style>
