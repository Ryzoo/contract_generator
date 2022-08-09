<template>
    <section class="pr-4">
        <div class="block-handle" v-if="block.id > 1">
            <i class="fas fa-arrows-alt" />
        </div>
        <div class="block-divider-line">{{ block.blockName }}</div>
        <v-btn
            v-if="block.id > 1"
            small
            text
            color="primary"
            @click="editBlock"
        >
            {{ $t('base.button.edit') }}
            <v-icon small right>fa-edit</v-icon>
        </v-btn>
        <v-btn
            v-if="block.id > 1"
            small
            text
            color="error"
            @click="removeBlock"
        >
            {{ $t('base.button.delete') }}
            <v-icon small right>fa-trash</v-icon>
        </v-btn>
    </section>
</template>

<script>
export default {
    name: 'PageDivideBlock',
    props: ['block', 'nestedVariables'],
    data() {
        return {
            divideBlockModal: false,
        }
    },
    methods: {
        removeBlock() {
            this.$store.dispatch('builder_removeBlock', this.block.id)
        },
        editBlock() {
            this.$store
                .dispatch('builder_setActiveBlock', {
                    block: this.block,
                    nestedVariables: this.nestedVariables,
                })
                .then(() => {
                    this.$emit('show-block-modal')
                })
        },
    },
}
</script>

<style lang="scss" scoped>
section {
    display: flex;
    align-items: center;

    .block-divider-line {
        display: flex;
        align-items: center;
        text-align: center;
        width: 100%;
        opacity: 0.3;

        &:before,
        &:after {
            content: '';
            flex: 1;
            border-bottom: 2px dashed #bbb;
        }

        &:before {
            margin-right: 10px;
        }

        &:after {
            margin-left: 10px;
        }
    }
}
</style>
