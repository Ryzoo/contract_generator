<template>
    <div class="sidebar-builder-options">
        <v-tabs v-model="activeTab" slider-size="3" vertical>
            <template v-for="element in sidebarElements">
                <v-tab>
                    <v-icon size="26">{{element.icon}}</v-icon>
                </v-tab>
                <v-tab-item>
                    <div class="builder-options-content">
                        <h2>{{element.name}}</h2>
                      <component :is="element.tabViewComponent"/>
                    </div>
                </v-tab-item>
            </template>
        </v-tabs>
    </div>
</template>

<script>
  import VariableView from "./RightSidebar/VariableView";
  import BlocksView from "./RightSidebar/BlocksView";
  import SelectedBlockView from "./RightSidebar/SelectedBlockView";

  export default {
    name: "RightSidebar",
    components:{
      SelectedBlockView,
      BlocksView,
      VariableView
    },
    data() {
      return {
        activeTab: null,
        sidebarElements: [
          {
            name: "Dostępne bloki",
            icon: "fab fa-elementor",
            tabViewComponent: "BlocksView"
          },
          {
            name: "Konfiguracja bloku",
            icon: "fa-cog",
            tabViewComponent: "SelectedBlockView"
          },
          {
            name: "Zmienne",
            icon: "fa-code",
            tabViewComponent: "VariableView"
          }
        ],
      };
    }
  }
</script>

<style lang="scss">
    .sidebar-builder-options {
        height: 100%;
        display: flex;

        .v-slide-group__content {
            .v-tab {
                margin-left: 0 !important;
            }
        }

        .builder-options-content {
            background-color: white;
            z-index: 3;
            width: 400px;

            h2 {
                text-align: center;
                padding: 5px 0;
                background-color: #dabd79;
                color: white;
            }

            .sub-title {
                display: block;
                text-align: center;
                padding: 5px 0;
                background-color: #f8f8f8;
            }

            .options {
                width: 150px;
                height: 80px;
                display: flex;
                justify-content: center;
                align-items: center;
                border: 2px solid #dabd79;
                color: #dabd79;

                &:hover {
                    cursor: pointer;
                }
            }

            .builder-elements {
                padding: 15px 0;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;

                .select-options {
                    width: 100%;
                }
            }

            .block-name {
                display: flex;
                flex-direction: row;
                justify-content: center;
                padding: 15px 0;

                span {
                    width: 270px;
                    display: flex;
                    height: 40px;
                    justify-content: center;
                    align-items: center;
                    border: 2px solid #dabd79;
                    color: #dabd79;

                    &:hover {
                        cursor: pointer;
                    }
                }
            }

            .block-button {
                padding: 15px 0;
                display: flex;
                justify-content: center;
            }

            .created-block-info {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 15px 0;

                .divider {
                    width: 20%;

                    hr {
                        color: #cacaca;
                    }
                }

                p {
                    width: 100px;
                    text-align: center;
                    margin: 0;
                }
            }

            .created-block {
                display: flex;
                flex-direction: column;
                align-items: center;

                span {
                    width: 200px;
                    height: 40px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    border: 1px solid #dabd79;
                    margin: 15px 0;
                    border-radius: 3px;

                    &:hover {
                        cursor: pointer;
                    }
                }
            }
        }
    }
</style>
