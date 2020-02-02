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
            <v-img src="https://image.flaticon.com/icons/png/512/197/197717.png"/>
          </v-list-item-avatar>
          <v-list-item-content class="text-center">
            {{$t('pageMeta.appTitle')}}
          </v-list-item-content>
          <v-list-item-action>
            <v-btn icon @click.stop="mini = !mini">
              <v-icon>fa-chevron-left</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
      </v-list>
      <v-list class="pt-0" dense>
        <template v-for="item in calculatedAccessItems">
          <v-list-item
            link
            :key="item.title"
            v-if="!item.elements"
            :prepend-icon="item.icon"
            :to="item.link ? item.link : null"
            :disabled="item.disabled"
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
            v-else-if="item.elements && item.elements.length > 0"
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
              :disabled="element.disabled"
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
      <v-spacer/>

      <v-menu
        v-model="menu"
        bottom
        offset-y
      >
        <template v-slot:activator="{ on }">
          <v-btn
            text
            dark
            v-on="on"
          >
            <v-avatar size="30" class="mr-2">
              <v-img :src="user.profileImage"/>
            </v-avatar>
            {{user.firstName}} {{user.lastName}}
          </v-btn>
        </template>
        <v-card v-if="user">
          <v-col cols="12">
            <v-btn
              class="mt-1"
              small
              text
              block
              color="primary"
              @click="goToProfilePage()"
            >
              {{$t('navigation.profile.main')}}
              <v-icon small right>fa-users-cog fa-fw</v-icon>
            </v-btn>
            <v-btn
              class="mt-1"
              small
              block
              text
              color="primary"
              @click="showNotifications()"
            >
              {{$t('navigation.profile.notifications')}}
              <v-icon small right>fa-bell fa-fw</v-icon>
            </v-btn>
            <v-btn
              class="mt-1"
              small
              block
              text
              color="error"
              @click="logout()"
            >
              {{$t('navigation.logout')}}
              <v-icon small right>fa-sign-out-alt fa-fw</v-icon>
            </v-btn>
          </v-col>
        </v-card>
      </v-menu>

    </v-app-bar>

    <v-content>
      <v-container
        class="fill-height mb-5"
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
import { Permissions } from '../additionalModules/Permissions'
import { Roles } from '../additionalModules/Roles'

export default {
  name: 'PanelLayout',
  data: function () {
    return {
      menu: false,
      navigationRight: true,
      navigationModel: true,
      mini: false,
      items: [
        {
          title: this.$t('navigation.dashboard'),
          icon: 'fa-poll fa-fw',
          roles: [Roles.ADMIN, Roles.CLIENT],
          link: '/panel/dashboard'
        },
        {
          title: this.$t('navigation.formContract'),
          icon: 'fa-newspaper fa-fw',
          roles: [Roles.ADMIN, Roles.CLIENT],
          link: '/client/form'
        },
        {
          title: this.$t('navigation.formSubmission'),
          icon: 'fa-file-contract fa-fw',
          roles: [Roles.CLIENT],
          link: '/panel/formSubmission'
        },
        {
          title: this.$t('navigation.contract.main'),
          icon: 'fa-file-contract fa-fw',
          roles: [Roles.ADMIN],
          elements: [
            {
              title: this.$t('navigation.contract.contractList'),
              link: '/panel/contracts/list',
              access: [
                Permissions.MANAGE_CONTRACTS
              ]
            },
            {
              title: this.$t('navigation.contract.schema'),
              link: '/panel/contracts/schema',
              disabled: true,
              access: [
                Permissions.MANAGE_CONTRACTS
              ]
            },
            {
              title: this.$t('navigation.contract.category'),
              link: '/panel/contracts/category',
              access: [
                Permissions.MANAGE_CONTRACTS
              ]
            }
          ]
        },
        {
          title: this.$t('navigation.settings.main'),
          icon: 'fa-cog fa-fw',
          roles: [Roles.ADMIN],
          elements: [
            {
              title: this.$t('navigation.settings.roles'),
              link: '/panel/settings/roles',
              access: [
                Permissions.MANAGE_ROLES
              ]
            },
            {
              title: this.$t('navigation.settings.account'),
              link: '/panel/settings/accounts',
              access: [
                Permissions.MANAGE_USERS
              ]
            }
          ]
        }
      ]
    }
  },
  computed: {
    calculatedAccessItems () {
      return this.calculateAccessArray(this.items)
    },
    user () {
      const user = Object.assign({}, this.$store.getters.authUser)
      return {
        ...user,
        roles: user ? user.roles.sort((a, b) => b.level - a.level)[0] || null : null
      }
    }
  },
  methods: {
    showNotifications () {
      alert('not implemented')
    },
    calculateAccessArray (elements) {
      return elements.map(x => {
        x.active = true

        if (x.access) {
          x.active = x.access.every(z => this.Auth.checkPermission(z))
        }

        if (x.roles) {
          x.active = x.roles.some(z => this.Auth.checkRole(z))
        }

        if (x.elements) {
          x.elements = this.calculateAccessArray(x.elements)
        }

        return x
      }).filter(x => x.active)
    },
    goToProfilePage () {
      this.$router.push('/panel/settings/my_profile')
      this.menu = false
    },
    logout () {
      this.menu = false
      this.Auth.logout()
    }
  }
}
</script>

<style>
  .padding-x-full-menu{
    padding: 0 50px;
  }
</style>
