<template>
    <v-col>
        <v-row>
            <div class="builder-container">
                <v-navigation-drawer width="490" v-model="drawerRight" app right>
                    <div class="right-side">
                        <div class="sidebar-builder-options">
                            <v-tabs slider-size="3" vertical>
                                <v-tab>O</v-tab>
                                <v-tab>U</v-tab>
                                <v-tab>K</v-tab>
                                <v-tab-item>
                                    <div class="builder-options-content">
                                        <h3>Opcje</h3>
                                        <div class="options-section-1">
                                            <span class="sub-title">Dodaj elementy</span>
                                            <div class="builder-elements">
                                                <div class="options" v-for="element in elementsType">
                                                    <span>{{element.name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="options-section-2">
                                            <span class="sub-title">Dodane bloki</span>
                                            <div class="block-name" v-for="block in blocks">
                                                <span>{{ block.name }}</span>
                                            </div>
                                        </div>
                                        <div class="options-section-3">
                                            <span class="sub-title">Dodaj nowy blok</span>
                                            <div class="block-button">
                                                <v-btn color="primary" @click="dialog = true">Nowy blok</v-btn>
                                            </div>
                                            <div class="created-block-info">
                                                <div class="divider">
                                                    <hr/>
                                                </div>
                                                <p>
                                                    lub wybierz istniejących
                                                    kategorii
                                                </p>
                                                <div class="divider">
                                                    <hr/>
                                                </div>
                                            </div>
                                            <div class="created-block" v-for="category in blocksCategory">
                                                <span>{{ category.name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </v-tab-item>
                            </v-tabs>
                        </div>
                    </div>
                </v-navigation-drawer>
                <v-btn right absolute color="primary" @click="drawerRight = !drawerRight">
                    {{ this.drawerRight ? "Hide settings" : "Show settings" }}
                </v-btn>
                <div class="left-side">
                    <div class="builder-content">
                        <div v-if="blocks.length > 0">
                            <div class="builder-blocks">
                                <component
                                    v-for="(block, index) in blocks"
                                    :key="index"
                                    :is="Mapper.getBlockName(block.type)"
                                    v-bind="block"
                                    v-on:openDialog="dialog = true"
                                >
                                    <component
                                        v-for="(nestedBlock, index) in block.nested"
                                        :key="index"
                                        :is="Mapper.getBlockName(nestedBlock.type)"
                                        v-bind="nestedBlock"
                                        v-on:openDialog="dialog = true"
                                    >
                                    </component>
                                </component>
                            </div>
                        </div>
                        <div v-else>
                            <div class="empty-elements">
                                <span>Dodaj element</span>
                                <v-icon class="mx-3">fa-plus-circle</v-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </v-row>
        <v-dialog ref="newBlockDialog" v-model="dialog" max-width="900">
            <v-card>
                <v-card-title class="headline justify-center" primary-title>
                    Nowy blok
                </v-card-title>
                <v-card-text>
                    <v-flex class="new-block-container" xs10>
                        <h3>Nazwa bloku</h3>
                        <v-text-field label="Nazwa" outline></v-text-field>
                        <v-checkbox
                            v-model="newBlock"
                            label="Zapisz blok jako nowy schemat"
                        ></v-checkbox>
                        <h3>Wybierz istniejącą kategorię</h3>
                        <v-select
                            :items="categoriesNames"
                            label="Wybierz kategorię"
                            outline
                        ></v-select>
                        <h3>lub dodaj nową</h3>
                        <v-text-field label="Kategoria" outline></v-text-field>
                    </v-flex>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog = false">I accept</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-col>
</template>

<script>
  import TextBlock from "../../../components/Blocks/TextBlock";

  export default {
    name: "CreateAgreementView",
    components: {
      TextBlock
    },
    data: function () {
      return {
        drawerRight: true,
        newBlock: false,
        dialog: false,
        blocks: [
          {
            type: 0,
            content: {
              text: "<h1>Lorem ipsum</h1> <br> dolor sit amet, <variable>consectetur</variable> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            },
            conditionals: {},
            settings: {},
            nested: [
              {
                type: 0,
                content: {
                  text: "<h1>Lorem ipsum</h1> <br> dolor sit amet, <variable>consectetur</variable> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                conditionals: {},
                settings: {}
              }
            ]
          },
          {
            type: 0,
            content: {
              text: "<h1>Lorem ipsum</h1> <br> dolor sit amet, <variable>consectetur</variable> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            },
            conditionals: {},
            settings: {}
          }
        ],
        elementsType: [
          {
            type: "text",
            name: "Tekst"
          },
          {
            type: "variable",
            name: "Zmienna"
          }
        ],
        blocksCategory: [
          {
            name: "Kategoria 1",
            blocks: [
              {
                name: "bloczek"
              }
            ]
          },
          {
            name: "Kategoria 2",
            blocks: [
              {
                name: "bloczek2"
              }
            ]
          }
        ],
        categoriesNames: []
      };
    },
    methods: {
      blocksCategoryToSelect(categories) {
        let arrayOfCategories = [];

        categories.map(x => arrayOfCategories.push(x.name));

        return arrayOfCategories;
      }
    },
    mounted() {
      this.categoriesNames = this.blocksCategoryToSelect(this.blocksCategory);
    }
  };
</script>

<style scoped lang="scss">
    .builder-container {
        width: 100%;
    }

    .new-block-container {
        margin: auto;

        h3 {
            font-weight: 400;
        }
    }

    summary::-webkit-details-marker {
        display: none;
    }

    .left-side {
        margin-top: 60px;
    }

    .right-side {
        .sidebar-builder-options {
            height: 100%;
            display: flex;

            .v-slide-group__content {
                .v-tab {
                    margin-left: 0 !important;
                }
            }

            /*.v-tabs {*/
            /*height: min-content;*/
            /*.v-tab {*/
            /*padding: 7px 12px;*/
            /*background-color: #ececec;*/
            /*border-radius: 10px 0px 0px 10px;*/
            /*border: 1px solid #ded7c9;*/

            /*&:hover {*/
            /*cursor: pointer;*/
            /*}*/
            /*}*/
            /*}*/

            .builder-options-content {
                background-color: white;
                z-index: 3;
                width: 400px;

                h3 {
                    text-align: center;
                    padding: 5px 0;
                    background-color: #dabd79;
                }

                .sub-title {
                    display: block;
                    text-align: center;
                    padding: 5px 0;
                    background-color: #f8f8f8;
                }

                .options {
                    width: 100px;
                    height: 100px;
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
                    justify-content: space-around;
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
    }

    .builder-content {
        .empty-elements {
            border: 1px dashed #707070;
            width: 100%;
            height: 100px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
</style>
