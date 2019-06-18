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
                        <lazy-img src="https://randomuser.me/api/portraits/men/80.jpg"></lazy-img>
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title>Grzegorz Kastelik</v-list-tile-title>
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
                    @click=""
                >
                    <v-list-tile-action>
                        <font-awesome-icon size="2x" :icon="item.icon"/>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>{{item.title}}</v-list-tile-title>
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
                    <router-view></router-view>
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
    name: "GeneratorPanel",
    data: function () {
      return {
        navigationModel: true,
        mini: false,
        items: [
          {
            title: "Dashboard",
            icon: "poll"
          },
          {
            title: "Klienci",
            icon: "user"
          },
          {
            title: "Umowy",
            icon: "file-contract"
          },
          {
            title: "Schematy",
            icon: "th"
          },
          {
            title: "Konta",
            icon: "user"
          },
          {
            title: "Ustawienia",
            icon: "cog"
          },
        ]
      }
    },
  }
</script>

<style lang="scss">

</style>