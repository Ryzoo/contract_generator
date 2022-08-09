<template>
    <v-card>
        <v-card-title
            >Block configuration:<small class="pl-3" style="color: #7a7a7a">{{
                block.blockName
            }}</small></v-card-title
        >
        <v-card-text>
            <v-divider />
            <v-tabs
                background-color="primary"
                grow
                show-arrows
                dark
                v-model="currentTab"
            >
                <v-tabs-slider color="primary" />

                <v-tab :key="0" href="#tab-0">
                    <v-icon class="pr-2">fa-id-card</v-icon>
                    Basic
                </v-tab>
                <v-tab :key="1" href="#tab-1">
                    <v-icon class="pr-2">fa-clipboard-list</v-icon>
                    Logic
                </v-tab>

                <v-tab-item :key="0" value="tab-0" class="pt-3">
                    <v-col cols="12">
                        <v-text-field
                            v-model="block.blockName"
                            label="Block name"
                            outlined
                            hide-details
                            dense
                        />
                    </v-col>
                    <v-col
                        cols="12"
                        v-if="block.blockType === BlockTypeEnum.REPEAT_BLOCK"
                    >
                        <v-textarea
                            v-model="block.settings.separator"
                            label="Separator text"
                            rows="1"
                            dense
                            persistent-hint
                            hint="This text will separate all of the repeat blocks"
                            outlined
                            auto-grow
                            clearable
                        />
                    </v-col>
                    <v-col
                        cols="12"
                        v-if="
                            block.blockType === BlockTypeEnum.PAGE_DIVIDE_BLOCK
                        "
                    >
                        <v-switch
                            outlined
                            hide-details
                            dense
                            v-model="block.settings.isBreaker"
                            label="Should be a page breaker?"
                        />
                    </v-col>
                </v-tab-item>

                <v-tab-item :key="1" value="tab-1" class="pt-3">
                    <QueryBuilder
                        :id="block.id"
                        :conditionals="block.conditionals"
                        @conditional-change="onConditionalChange"
                    />
                </v-tab-item>
            </v-tabs>
        </v-card-text>
        <v-card-actions>
            <v-spacer />
            <v-btn color="primary" outlined @click="pushCloseEvent"
                >Cancel</v-btn
            >
            <v-btn color="primary" @click="saveBlockConfiguration">Save</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import QueryBuilder from '../../../common/QueryBuilder'
import { BlockTypeEnum } from '../../../../additionalModules/Enums'

export default {
    name: 'SelectedBlockView',
    components: { QueryBuilder },
    data() {
        return {
            currentTab: null,
            BlockTypeEnum: BlockTypeEnum,
        }
    },
    computed: {
        block() {
            return {
                ...this.$store.state.builder.builder.activeBlock,
            }
        },
    },
    methods: {
        pushCloseEvent() {
            this.$emit('close')
        },
        saveBlockConfiguration() {
            this.pushCloseEvent()
            this.$store.dispatch('builder_changeActiveBlock', this.block)
        },
        onConditionalChange(newConditionalValue) {
            this.block.conditionals = newConditionalValue
        },
    },
}
</script>
