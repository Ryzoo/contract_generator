<template>
  <section>
    <v-navigation-drawer
      :mini-variant="mini"
      v-model="navigationModel"
      dark
      fixed
      overflow
      app
    >
      <v-list class="pa-1" dense>
        <v-list-item v-if="mini" @click.stop="mini = !mini">
          <v-list-item-action>
            <v-icon>fa-chevron-right</v-icon>
          </v-list-item-action>
        </v-list-item>

        <v-list-item tag="div">
          <v-list-item-avatar>
            <v-img :src="user.profileImage"/>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title> {{user.firstName}} {{user.lastName}}</v-list-item-title>
          </v-list-item-content>

          <v-list-item-action>
            <v-btn icon @click.stop="mini = !mini">
              <v-icon>fa-chevron-left</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
      </v-list>
      <v-list class="pt-0" dense>
        <template v-for="item in items">
          <v-list-item
            link
            :key="item.title"
            v-if="!item.elements"
            :prepend-icon="item.icon"
            :to="item.link ? item.link : null"
          >
            <v-list-item-action>
              <v-icon>{{item.icon}}</v-icon>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>{{item.title}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-group
            :key="item.title"
            v-else
          >
            <template v-slot:activator>
              <v-list-item-action>
                <v-icon>{{item.icon}}</v-icon>
              </v-list-item-action>

              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title>{{item.title}}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>

            <v-list-item
              v-for="(element, i) in item.elements"
              :key="i"
              :to="element.link ? element.link : null"
              link
            >
              <v-list-item-content>
                <v-list-item-title>
                  {{ element.title }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
        </template>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon
        dark
        @click.stop="navigationModel = !navigationModel"
      />
      <v-toolbar-title>{{$t('pageMeta.appTitle')}}</v-toolbar-title>
      <v-spacer/>
      <v-btn @click="logout()" text dark> <v-icon>fa-sign-out-alt fa-fw</v-icon> {{$t('navigation.logout')}}</v-btn>
    </v-app-bar>

    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-fade-transition mode="out-in">
          <router-view/>
        </v-fade-transition>
      </v-container>
    </v-content>

    <v-footer app inset>
            <span class="px-3"
            >&copy; {{ new Date().getFullYear() }} -
                {{ $t("pageMeta.copyright") }}</span
            >
    </v-footer>
  </section>
</template>

<script>
export default {
  name: 'PanelLayout',
  data: function () {
    return {
      navigationRight: true,
      navigationModel: true,
      mini: false,
      user: this.$store.getters.authUser,
      items: [
        {
          title: this.$t('navigation.dashboard'),
          icon: 'fa-poll fa-fw',
          link: '/panel/dashboard'
        },
        {
          title: this.$t('navigation.contract.main'),
          icon: 'fa-file-contract fa-fw',
          elements: [
            {
              title: this.$t('navigation.contract.contractList'),
              link: '/panel/contracts/list'
            },
            {
              title: this.$t('navigation.contract.schema'),
              link: '/panel/contracts/schema'
            }
          ]
        },
        {
          title: this.$t('navigation.settings.main'),
          icon: 'fa-cog fa-fw',
          elements: [
            {
              title: this.$t('navigation.settings.roles'),
              link: '/panel/settings/roles'
            },
            {
              title: this.$t('navigation.settings.account'),
              link: '/panel/settings/accounts'
            },
            {
              title: this.$t('navigation.settings.my_profile'),
              link: '/panel/settings/my_profile'
            }
          ]
        }
      ]
    }
  },
  methods: {
    logout () {
      auth.logout()
    }
  }
}
</script>

<style lang="scss">

</style>
