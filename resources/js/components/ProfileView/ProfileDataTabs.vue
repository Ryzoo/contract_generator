<template>
    <v-card>
        <v-tabs v-model="tabModel" background-color="primary" grow show-arrows dark>
          <v-tabs-slider/>
            <v-tab
                v-for="(tab, index) in computedTabsItem"
                :key="index"
                :href="`#tab-${index}`"
            >
                <v-icon class="pr-2">{{ tab.icon }}</v-icon>
                {{ tab.name }}
            </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tabModel">
            <v-tab-item
                v-for="(tab, index) in computedTabsItem"
                :key="index"
                :value="'tab-' + index"
            >
              <component
                :user-data="user"
                :editable="editable"
                :is="tab.component"
              />
            </v-tab-item>
        </v-tabs-items>
    </v-card>
</template>

<script>
import BasicDataTab from './Tabs/BasicDataTab'
import ChangePasswordTab from './Tabs/ChangePasswordTab'

export default {
  name: 'ProfileDataTabs',
  components: {
    BasicDataTab,
    ChangePasswordTab
  },
  props: ['userData', 'editable'],
  data () {
    return {
      user: this.userData,
      tabModel: null,
      tabsItem: [
        {
          name: this.$t('pages.panel.accounts.tabs.basic_data'),
          icon: 'fa-id-card',
          editOnly: true,
          component: 'BasicDataTab'
        },
        {
          name: this.$t('pages.panel.accounts.tabs.change_password'),
          icon: 'fa-key',
          editOnly: true,
          component: 'ChangePasswordTab'
        }
      ]
    }
  },
  computed: {
    computedTabsItem () {
      return this.tabsItem.filter(x => !x.editOnly || this.editable)
    }
  }
}
</script>

<style scoped></style>
