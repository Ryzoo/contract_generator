<template>
    <v-col>
        <v-row>
            <div class="builder-container">
                <v-navigation-drawer width="490" v-model="drawerRight" app right>
                    <div class="right-side">
                        <div class="sidebar-builder-options">
                            <v-tabs slider-size="3" vertical>
                                <v-tab><v-icon size="26">fab fa-elementor</v-icon></v-tab>
                                <v-tab><v-icon size="26">fa-cog</v-icon></v-tab>
                                <v-tab><v-icon size="26">fa-code</v-icon></v-tab>
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
                                                <span>{{ block.blockName }}</span>
                                            </div>
                                        </div>
                                        <div class="options-section-3">
                                            <span class="sub-title">Dodaj nowy blok</span>
                                            <div class="block-button">
                                                <v-btn color="primary" @click="addBlockDialog = true">Nowy blok</v-btn>
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
                                <v-tab-item>
                                    <div class="builder-options-content">
                                        <h2>Opcje bloku</h2>
                                        <div class="options-section-1">
                                            <span class="sub-title">Konfiguruj blok</span>
                                            <v-text-field v-model="activeBlock.blockName" label="Nazwa" outline></v-text-field>
                                        </div>
                                        <div class="options-section-2">
                                            <span class="sub-title">Logika</span>
                                            <div class="builder-elements">
                                                <div class="select-options">
                                                    <div class="w-50">
                                                        <span>Akcja</span>
                                                        <v-select
                                                            :items="attributesName"
                                                            label="Pokaż"
                                                            outlined
                                                            color="primary"
                                                            dense
                                                            :value="attributeValue"
                                                        >
                                                        </v-select>
                                                    </div>
                                                    <!--<v-select-->
                                                    <!--:items="blockOptions"-->
                                                    <!--label="Blok"-->
                                                    <!--outlined-->
                                                    <!--color="primary"-->
                                                    <!--dense>-->
                                                    <!--</v-select>-->
                                                    <!--<p>ten blok gdy</p>-->
                                                    <!--<v-select-->
                                                        <!--:items="termOptions"-->
                                                        <!--label="Warunki"-->
                                                        <!--outlined-->
                                                        <!--color="primary"-->
                                                        <!--dense>-->
                                                    <!--</v-select>-->
                                                    <!--<p>warunki pasują do</p>-->

                                                    <div class="w-50">
                                                        <v-select
                                                            :items="operatorOptions"
                                                            label="Operator"
                                                            outlined
                                                            color="primary"
                                                            dense
                                                            :value="operatorValue"
                                                        >
                                                        </v-select>
                                                        <v-text-field
                                                            label="Wyrażenie"
                                                            outlined
                                                            color="primary"
                                                            :value="termValue"
                                                        ></v-text-field>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </v-tab-item>
                            </v-tabs>
                        </div>
                    </div>
                </v-navigation-drawer>
<!--                <div>-->
<!--                    <h1>Edytujesz: Ttutaj fajna nazwa tego czegos</h1>-->
<!--                    <div>-->
<!--                        <v-btn text color="primary">Powrót</v-btn>-->
<!--                        <v-btn outlined color="primary">Zapisz</v-btn>-->
<!--                        <v-btn color="primary">Zapisz i wyjdź</v-btn>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <v-divider></v-divider>-->
                <v-btn right absolute color="primary" @click="drawerRight = !drawerRight">
                    {{ this.drawerRight ? "Hide settings" : "Show settings" }}
                </v-btn>
                <div class="left-side">
                    <div class="builder-content">
                        <div class="builder-blocks">
                            <ContainerBlock
                                v-for="(block, index) in filterParentBlocks"
                                :block="block"
                                :key="block.id"
                                :divider="block.isDivider"
                                :level="0"
                                :blockIndex="index"
                            >
                            </ContainerBlock>
                        </div>
                    </div>
                </div>
            </div>
        </v-row>

    </v-col>
</template>

<script>
  import Selector from "../../../additionalModules/StaticSelectors";
  import { mapGetters } from 'vuex';

  export default {
    name: "CreateAgreementView",
    data: function () {
      return {
        parentBlockId: 0,
        drawerRight: true,
        newBlock: false,
        attributesName: [],
        activeBlock: [],
        operatorOptions: Selector.Operators,
        termValue: "",
        selectedBlockType: undefined,
        blockName: "",
        attributeValue: "",
        operatorValue: "",
        attributesList: [
          {
            attributeName: "Imię",
            id: 1,
            attributeType: 1,
            defaultValue : "",
            placeholder : "Testowe",
            settings: {
              lengthMin: 3,
              lengthMax: 50
            }
          },
          {
            attributeName: "Zmienna zależna od zmiennej 5 oraz sterująca",
            id: 2,
            attributeType: 0,
            defaultValue: 18,
            settings: {
              valueMin: 18,
              valueMax: 30
            }
          },
          {
            attributeName: "Wiek użytkownika",
            id: 3,
            attributeType: 2,
            defaultValue: null,
            settings: {
              isMultiSelect: true,
              items: [
                "Powyżej 20",
                "Poniżej 20"
              ]
            }
          },
          {
            attributeName: "Wzrost",
            id: 4,
            attributeType: 0,
            defaultValue : 170,
            settings: {
              valueMin: 18,
              valueMax: 30
            }
          },
          {
            attributeName: "Zmienna sterująca - niezależna",
            id: 5,
            attributeType: 0,
            defaultValue: 18,
            settings: {
              valueMin: 18,
              valueMax: 30
            }
          },
          {
            attributeName: "Test zagniezdzenia",
            id: 7,
            attributeType: 0,
            defaultValue: 18,
            settings: {
              valueMin: 18,
              valueMax: 30
            }
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
        categoriesNames: [],
        blockOptions:[
            "Pokaż",
            "Schowaj"
        ],
        termOptions:[
            "Wszystkie",
        ]
      };
    },
    computed: {
      filterParentBlocks() {
        let filteredBlocks = this.blocks.filter(x => !x.parentId);
        let obj = {isDivider: true};
        let arr = [
          obj,
        ];

        filteredBlocks.map(x => {
          arr.push(x);
          arr.push(obj);
        });

        return arr;
      },
      ...mapGetters({
        blocks: 'allBlocks'
      })
    },
    created() {
      this.$store.watch(
          (state, getters) => getters.activeBlock,
          (newValue, oldValue) => {
            this.activeBlock = newValue;
          },
      );
    },
    methods: {
      proba(){
        console.log(this.$store.getters.activeBlock);
      },
      blocksCategoryToSelect(categories) {
        let arrayOfCategories = [];

        categories.map(x => arrayOfCategories.push(x.name));

        return arrayOfCategories;
      },

      // getAttributes() {
      //   let blockId = $('.active').parent().attr("blockid");
      //   let conditionals = this.getConditionalFromBlock(blockId);
      //   let attributesId = [];
      //
      //   conditionals.map(x => {
      //     attributesId.push(Number(x.content[0]));
      //     this.operatorValue = x.content[1];
      //     this.attributeValue = Number(x.content[0]);
      //     this.termValue = x.content[2];
      //   });
      //
      //   let attributes = attributesId.map(x => this.attributesList.find(y => y.id === x));
      //
      //   attributes.map(x => {
      //     this.attributesName.push(
      //         {
      //           text: x.attributeName,
      //           value: x.id
      //         })
      //   });
      // },

      // getConditionalFromBlock(id) {
      //   return this.blocks.find(x => x.id === Number(id)).conditionals;
      // },
    },
    mounted() {
      this.categoriesNames = this.blocksCategoryToSelect(this.blocksCategory);

      // let apiBlock = [
      //   {
      //     id: 1,
      //     parentId: 0,
      //     blockName: "test",
      //     blockType: 0,
      //     content: {
      //       text: "Tutaj bardzo fajny tekst <b>sformatowany</b>. W tym miejscu zawiera zmienną <variable value='2'>nazwa jakas czy tam teskt</variable>"
      //     },
      //     conditionals: [
      //       {
      //         conditionalType: 0,
      //         content: [
      //           "5",
      //           "==",
      //           "18"
      //         ]
      //       }
      //     ],
      //     settings: {},
      //   },
      //   {
      //     id: 2,
      //     parentId: 0,
      //     blockType: 1,
      //     blockName: "test",
      //     content: {
      //       blocks: [
      //         {
      //           id: 3,
      //           parentId: 2,
      //           blockType: 0,
      //           blockName: "test",
      //           content: {
      //             text: "Tutaj bardzo fajny tekst <b>sformatowany</b>. W tym miejscu zawiera zmienną <variable value='1'>costam</variable>"
      //           },
      //           conditionals: [{
      //             conditionalType: 0,
      //             content: [
      //               "1",
      //               "==",
      //               "'Grzegorz'"
      //             ]
      //           }],
      //           settings: {}
      //         },
      //         {
      //           id: 4,
      //           parentId: 2,
      //           blockType: 0,
      //           blockName: "test",
      //           content: {
      //             text: "Tutaj bardzo fajny tekst <b>sformatowany</b>. W tym miejscu zawiera zmienną"
      //           },
      //           conditionals: [{
      //             conditionalType: 0,
      //             content: [
      //               "1",
      //               "==",
      //               "18"
      //             ]
      //           }],
      //           settings: {}
      //         }
      //       ]
      //     },
      //     conditionals: [{
      //       conditionalType: 0,
      //       content: [
      //         "2",
      //         "==",
      //         "18"
      //       ]
      //     }],
      //     settings:{}
      //   }
      // ];

      // this.$store.dispatch('block_set', apiBlock);
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
    }
</style>
