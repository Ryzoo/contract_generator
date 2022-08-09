<template>
    <section>
        <v-row>
            <v-col>
                <h3>
                    {{ $t('pages.panel.contracts.builder.header') }}
                    <span
                        class="light-text"
                        v-if="$store.getters.getNewContractData"
                        >{{ $store.getters.getNewContractData.name }}</span
                    >
                </h3>
                <v-btn color="primary mt-3" small @click="showAttributeModal">{{
                    $t('pages.panel.contracts.builder.attributeList')
                }}</v-btn>
            </v-col>
            <v-col cols="auto">
                <v-row>
                    <v-col>
                        <v-btn
                            small
                            block
                            color="primary"
                            outlined
                            @click="goBack"
                            >{{ $t('base.button.configuration_back') }}</v-btn
                        >
                    </v-col>
                    <v-col>
                        <v-btn
                            small
                            block
                            color="primary"
                            @click="saveActual(true)"
                            >{{ $t('base.button.save_exit') }}</v-btn
                        >
                    </v-col>
                    <v-col>
                        <v-btn
                            small
                            block
                            color="secondary"
                            @click="openContentAsText"
                        >
                            <i class="fas fa-code"></i>
                        </v-btn>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col class="pt-4">
                        <v-switch v-model="autoSave" hide-details>
                            <template v-slot:label> Autozapis </template>
                        </v-switch>
                    </v-col>
                    <v-col>
                        <v-text-field
                            append-icon="far fa-clock"
                            dense
                            v-model="autoSaveTime"
                            :disabled="!autoSave"
                            type="number"
                            min="1"
                            max="10"
                            label="Minuty"
                            outlined
                            hide-details
                        ></v-text-field>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
        <ContractAsCodeModal
            v-if="showContractCodeEditDialog"
            :content="JSON.stringify($store.getters.getNewContractData)"
            @close="showContractCodeEditDialog = false"
        />
    </section>
</template>

<script>
import ContractAsCodeModal from './ContractAsCodeModal'

export default {
    name: 'Header',
    components: {
        ContractAsCodeModal,
    },
    data() {
        return {
            showContractCodeEditDialog: false,
            isLoaded: true,
            autoSave: false,
            autoSaveTime: 5,
            saveInterval: null,
        }
    },
    watch: {
        autoSave(newValue) {
            if (this.saveInterval) {
                clearInterval(this.saveInterval)
            }
            if (newValue) {
                this.saveInterval = setInterval(
                    this.saveActual,
                    this.autoSaveTime * 10000
                )
            }
        },
        autoSaveTime(newValue) {
            if (newValue < 1) newValue = 1
            if (this.saveInterval) {
                clearInterval(this.saveInterval)
            }
            this.saveInterval = setInterval(this.saveActual, newValue * 10000)
        },
    },
    methods: {
        showAttributeModal() {
            this.$emit('show-attribute-modal')
        },
        init() {
            const contract = this.$store.getters.getNewContractData
            this.$store.dispatch('builder_set', contract.blocks)
            this.$store.dispatch('builder_setVariable', contract.attributesList)
        },
        goBack() {
            const updateState = this.$store.getters.getNewContractUpdateState
            this.$router.push(`/panel/contracts/edit/${updateState.id}`)
        },
        openContentAsText() {
            this.showContractCodeEditDialog = true
        },
        saveActual(redirect) {
            this.isLoaded = false
            const updateState = this.$store.getters.getNewContractUpdateState
            const contract = this.$store.getters.getNewContractData

            contract.blocks = this.$store.getters.builder_allBlocks
            contract.attributesList = this.$store.getters.builder_allVariables

            this.$store.dispatch('newContract_setUpdate', contract).then(() => {
                axios
                    .put(
                        `/contract/${updateState.id}`,
                        this.$store.getters.getNewContractData
                    )
                    .then((response) => {
                        notify.push(
                            this.$t(
                                'pages.panel.contracts.builder.savedNotify'
                            ),
                            notify.SUCCESS
                        )
                        if (redirect) {
                            this.$store.dispatch('newContract_clear')
                            this.$router.push('/panel/contracts/list')
                        }
                    })
                    .finally(() => {
                        this.isLoaded = true
                    })
            })
        },
    },
    mounted() {
        this.init()
    },
    destroyed() {
        if (this.saveInterval) {
            clearInterval(this.saveInterval)
        }
    },
}
</script>

<style scoped>
.light-text {
    font-weight: 300;
}
</style>
