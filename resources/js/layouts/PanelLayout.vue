<template>
    <section>
        <!--<div class="sidebar-nav-container">-->
            <!--<div class="nav-header">-->
                <!--<h2 class="title">Pozytywny <span class="primary&#45;&#45;text">Generator</span></h2>-->
            <!--</div>-->
            <!--<div class="nav-content">-->
                <!--<ul class="nav-items">-->
                    <!--<li class="nav-item">-->
                        <!--Dashboard-->
                    <!--</li>-->
                <!--</ul>-->
            <!--</div>-->
        <!--</div>-->
        <v-navigation-drawer
            :mini-variant="mini"
            absolute
            dark
            permanent
        >
            <v-list class="pa-1">
                <v-list-tile v-if="mini" @click.stop="mini = !mini">
                    <v-list-tile-action>
                        <font-awesome-icon icon="bars"/>
                    </v-list-tile-action>
                </v-list-tile>

                <v-list-tile avatar tag="div">
                    <v-list-tile-avatar>
                        <img src="https://randomuser.me/api/portraits/men/80.jpg">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title>Grzegorz Kastelik</v-list-tile-title>
                    </v-list-tile-content>

                    <v-list-tile-action>
                        <v-btn class="hamburger-icon" icon @click.stop="mini = !mini">
                            <font-awesome-icon icon="bars"/>
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
        <router-view></router-view>
    </section>
</template>

<script>
  export default {
    name: "GeneratorPanel",
    data: function () {
      return {
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

<style scoped lang="scss">
.hamburger-icon svg {
    width: 35px;
    height: 25px;
}
</style>