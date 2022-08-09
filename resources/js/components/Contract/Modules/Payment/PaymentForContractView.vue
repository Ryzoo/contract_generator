<template>
    <section v-if="!isLoading">
        <v-card-title>{{ $t('module.payment.title') }}</v-card-title>
        <v-divider />
        <v-card-text>
            <p>{{ $t('module.payment.description') }}</p>
        </v-card-text>
        <v-card-actions>
            <v-spacer />
            <v-btn color="primary" @click="renderContract">
                {{ $t('base.button.ok') }}
            </v-btn>
        </v-card-actions>
    </section>
    <loader v-else />
</template>

<script>
export default {
    name: 'PaymentForContractView',
    props: ['contract', 'actualModule'],
    data() {
        return {
            isLoading: false,
            actualRenderType: this.actualModule.settings.type,
        }
    },
    methods: {
        renderContract() {
            this.$emit('finish')
        },
    },
}
</script>
