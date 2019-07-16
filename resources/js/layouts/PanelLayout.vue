<template>
    <section>
        <v-navigation-drawer
            :mini-variant="mini"
            v-model="navigationModel"
            dark
            absolute
            overflow
            app
        >
            <v-list class="pa-1">
                <v-list-tile v-if="mini" @click.stop="mini = !mini">
                    <v-list-tile-action>
                        <font-awesome-icon icon="chevron-right"/>
                    </v-list-tile-action>
                </v-list-tile>

                <v-list-tile avatar tag="div">
                    <v-list-tile-avatar>
                        <lazy-img :src="user.profileImage"></lazy-img>
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title> {{user.firstName}} {{user.lastName}} </v-list-tile-title>
                    </v-list-tile-content>

                    <v-list-tile-action>
                        <v-btn icon @click.stop="mini = !mini">
                            <font-awesome-icon icon="chevron-left"/>
                        </v-btn>
                    </v-list-tile-action>
                </v-list-tile>
            </v-list>
            <v-list class="pt-0" dense>
                <v-divider light></v-divider>

                <v-list-tile
                    v-for="item in items"
                    :key="item.title"
                    :to="item.link ? item.link : null"
                    @click="item.logout ? logout() : null"
                >
                    <v-list-tile-action>
                        <font-awesome-icon size="2x" :icon="item.icon"/>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title >{{item.title}}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app absolute>
            <v-toolbar-side-icon dark
                                 @click.stop="navigationModel = !navigationModel"
            ></v-toolbar-side-icon>
            <v-toolbar-title>{{$t('pageMeta.appTitle')}}</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fluid>
                <v-layout align-center justify-center>
                    <v-fade-transition mode="out-in">
                        <router-view></router-view>
                    </v-fade-transition>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app inset>
            <span class="px-3">&copy; {{ new Date().getFullYear() }} - {{$t('pageMeta.copyright')}}</span>
        </v-footer>
    </section>
</template>

<script>
  export default {
    name: "PanelLayout",
    data: function () {
      return {
        navigationModel: true,
        mini: false,
        user: this.$store.getters.authUser,
        items: [
          {
            title: this.$t('navigation.dashboard'),
            icon: "poll",
            link: "/panel/dashboard"
          },
          {
            title: this.$t('navigation.profile'),
            icon: "user-tie",
            link: "/panel/my_profile"
          },
          {
            title: this.$t('navigation.clients'),
            icon: "users"
          },
          {
            title: this.$t('navigation.agreements'),
            icon: "file-contract",
            link: "/panel/agreements"
          },
          {
            title: this.$t('navigation.schema'),
            icon: "th"
          },
          {
            title: this.$t('navigation.accounts'),
            icon: "users-cog",
            link: "/panel/accounts"
          },
          {
            title: this.$t('navigation.settings'),
            icon: "cog"
          },
          {
            title: this.$t('navigation.logout'),
            icon: "sign-out-alt",
            logout: true
          }
        ]
      }
    },
    methods:{
      logout(){
        auth.logout();
      }
    }
  }
</script>

<style lang="scss">

</style>