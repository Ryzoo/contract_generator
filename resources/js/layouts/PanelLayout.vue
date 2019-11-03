<template>
    <section>
        <v-navigation-drawer
            v-if="pageOnCreator"
            width="490"
            v-model="navigationRight"
            app
            right>
            <RightSidebar></RightSidebar>
        </v-navigation-drawer>
        <v-navigation-drawer
            :mini-variant="mini"
            v-model="navigationModel"
            dark
            absolute
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
                        <v-img :src="user.profileImage"></v-img>
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
                <v-divider light></v-divider>

                <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    :to="item.link ? item.link : null"
                    @click="item.logout ? logout() : null"
                >
                    <v-list-item-avatar>
                        <v-icon>{{item.icon}}</v-icon>
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>{{item.title}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app>
            <v-app-bar-nav-icon
                dark
                @click.stop="navigationModel = !navigationModel"
            ></v-app-bar-nav-icon>
            <v-toolbar-title>{{$t('pageMeta.appTitle')}}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-app-bar-nav-icon
                v-if="pageOnCreator"
                dark
                @click.stop="navigationRight = !navigationRight"
            ></v-app-bar-nav-icon>
        </v-app-bar>

        <v-content>
            <v-container
                class="fill-height"
                fluid
            >
                <v-fade-transition mode="out-in">
                    <router-view></router-view>
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
  import RightSidebar from "../components/Contract/Builder/RightSidebar";

  export default {
    name: "PanelLayout",
    components: {
      RightSidebar
    },
    data: function () {
      return {
        navigationRight: true,
        navigationModel: true,
        mini: false,
        user: this.$store.getters.authUser,
        items: [
          {
            title: this.$t('navigation.dashboard'),
            icon: "fa-poll",
            link: "/panel/dashboard"
          },
          {
            title: this.$t('navigation.profile'),
            icon: "fa-user-tie",
            link: "/panel/my_profile"
          },
          {
            title: this.$t('navigation.clients'),
            icon: "fa-users"
          },
          {
            title: this.$t('navigation.contract'),
            icon: "fa-file-contract",
            link: "/panel/contracts"
          },
          {
            title: this.$t('navigation.schema'),
            icon: "fa-th"
          },
          {
            title: this.$t('navigation.accounts'),
            icon: "fa-users-cog",
            link: "/panel/accounts"
          },
          {
            title: this.$t('navigation.settings'),
            icon: "fa-cog"
          },
          {
            title: this.$t('navigation.logout'),
            icon: "fa-sign-out-alt",
            logout: true
          }
        ]
      }
    },
    computed: {
      pageOnCreator() {
        return this.$route.path === "/panel/contracts/builder";
      }
    },
    methods: {
      logout() {
        auth.logout();
      }
    }
  };
</script>

<style lang="scss"></style>

</
style
>
