<template>
    <v-row>
        <v-col cols="12">
            <contract-form-render
                v-if="this.$route.params.id"
                :contract-id="this.$route.params.id"
            />
            <loader v-else />
        </v-col>
    </v-row>
</template>

<script>
import ContractFormRender from '../../../components/Contract/ContractFormRender'

export default {
    name: 'ContractFormFillView',
    components: {
        ContractFormRender,
    },
    mounted() {
        if (!this.$route.params.id) this.$router.back()
    },
}
</script>
