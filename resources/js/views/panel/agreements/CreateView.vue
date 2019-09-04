<template>
    <section>
        <div class="builder-container">
            <div class="left-side">
                <div class="builder-content">
                    <div v-if="blocks.length > 5"></div>
                    <div v-else>
                        <div class="empty-elements">
                            <span>Dodaj element</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="sidebar-builder-options">
                    <div class="v-tabs">
                        <div class="v-tab">O</div>
                        <div class="v-tab">U</div>
                        <div class="v-tab">K</div>
                    </div>
                    <div class="builder-options-content">
                        <h3>Opcje</h3>
                        <div class="options-section-1">
                            <span class="sub-title">Dodaj elementy</span>
                            <div class="builder-elements">
                                <div
                                    class="options"
                                    v-for="element in elementsType"
                                >
                                    <span>{{ element.name }}</span>
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
                                <v-btn color="primary" @click="dialog = true"
                                    >Nowy blok</v-btn
                                >
                            </div>
                            <div class="created-block-info">
                                <div class="divider"><hr /></div>
                                <p>lub wybierz istniejących kategorii</p>
                                <div class="divider"><hr /></div>
                            </div>
                            <div
                                class="created-block"
                                v-for="category in blocksCategory"
                            >
                                <span>{{ category.name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <v-dialog v-model="dialog" max-width="900">
            <v-card>
                <v-card-title class="headline justify-center" primary-title>
                    Nowy blok
                </v-card-title>
                <v-card-text>
                    <v-flex class="new-block-container" xs10>
                        <h3>Nazwa bloku</h3>
                        <v-text-field label="Nazwa" outline></v-text-field>
                    </v-flex>
                    <v-radio-group>
                        <v-radio
                            v-model="newBlock"
                            label="Zapisz blok jako nowy schemat"
                            @click="cosik()"
                        ></v-radio>
                    </v-radio-group>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog = false">
                        I accept
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </section>
</template>

<script>
export default {
    name: "CreateAgreementView",
    data: function() {
        return {
            newBlock: false,
            dialog: false,
            blocks: [
                {
                    name: "bloczek"
                },
                {
                    name: "bloczek2"
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
            ]
        };
    },
    methods: {
        cosik() {
            console.log(this.newBlock);
            this.newBlock = !this.newBlock;
        }
    },
    mounted() {}
};
</script>

<style scoped lang="scss">
.new-block-container {
    margin: auto;
    h3 {
        font-weight: 400;
    }
}
.left-side {
    padding-right: 400px;
}
.right-side {
    position: absolute;
    top: -88px;
    right: -24px;
    height: 100vh;
    padding-top: 64px;
    margin-top: 0;
    .sidebar-builder-options {
        height: 100%;
        display: flex;

        .v-tabs {
            height: min-content;
            .v-tab {
                padding: 7px 12px;
                background-color: #ececec;
                border-radius: 10px 0px 0px 10px;
                border: 1px solid #ded7c9;

                &:hover {
                    cursor: pointer;
                }
            }
        }

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
