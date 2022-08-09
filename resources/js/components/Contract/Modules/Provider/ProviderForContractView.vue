<template>
    <section v-if="!isLoading">
        <v-card-title>{{ $t('module.provider.title') }}</v-card-title>
        <v-divider />
        <v-card-text>
            <p>{{ $t('module.provider.description') }}</p>
        </v-card-text>
        <v-card-actions>
            <v-spacer />
            <v-btn color="primary" @click="renderContract">
                {{ $t('base.button.render') }}
            </v-btn>
        </v-card-actions>
    </section>
    <loader v-else />
</template>

<script>
import { ContractProviderType } from './Enums'

export default {
    name: 'ProviderForContractView',
    props: ['contract', 'actualModule'],
    data() {
        return {
            ContractProviderType: ContractProviderType,
            isLoading: false,
            actualRenderType: this.actualModule.settings.type,
        }
    },
    methods: {
        renderContract() {
            this.isLoading = true
            axios({
                url: `/contract/${this.contract.id}/render`,
                method: 'POST',
                responseType: 'blob',
                data: {
                    formElements: this.$store.getters.formElements,
                },
            })
                .then((response) => {
                    Notify.push(
                        this.$t('module.provider.successNotify'),
                        Notify.SUCCESS
                    )
                    this.$router.push('/panel/formSubmission')
                })
                .finally(() => {
                    this.isLoading = false
                })
        },
    },
}
</script>
