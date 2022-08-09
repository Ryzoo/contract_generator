<template>
    <section v-if="!isLoading">
        <h3>{{ $t('form.contractAddForm.title_modules') }}</h3>
        <v-divider class="my-1" />
        <small>{{ $t('form.contractAddForm.description.modules') }}</small>
        <section
            class="module-section"
            v-for="section in sectionList"
            :key="section"
        >
            <h4>{{ Mapper.getModulePlaceName(section) }}</h4>
            <DefaultConfigModuleView
                v-for="module in moduleList.filter(
                    (x) => x.place === section && x.configComponent
                )"
                :key="section + module.name"
                :module="module"
            />
        </section>
    </section>
    <loader v-else />
</template>

<script>
import { ContractModulesAvailablePlace } from '../../../additionalModules/Enums'
import DefaultConfigModuleView from './DefaultConfigModuleView'

export default {
    name: 'ContractModuleConfiguration',
    components: {
        DefaultConfigModuleView,
    },
    data() {
        return {
            availableSection: ContractModulesAvailablePlace,
            availableSectionList: [
                ContractModulesAvailablePlace.PRE_FORM,
                ContractModulesAvailablePlace.POST_FORM,
                ContractModulesAvailablePlace.FINISHER,
            ],
            moduleList: [],
            isLoading: false,
        }
    },
    methods: {
        loadModuleList() {
            this.isLoading = true
            axios
                .get('/contract/modules')
                .then((response) => {
                    this.moduleList = response.data
                })
                .finally(() => {
                    this.isLoading = false
                })
        },
    },
    computed: {
        sectionList() {
            return this.availableSectionList.filter(
                (y) =>
                    this.moduleList.filter(
                        (x) => x.place === y && x.configComponent
                    ).length
            )
        },
    },
    mounted() {
        this.loadModuleList()
    },
}
</script>

<style scoped lang="scss">
section.module-section {
    padding: 5px 7px;
    margin: 5px 0;
    border-radius: 5px;
    border: 2px solid #f2f2f2;

    &:first-of-type {
        margin-top: 15px;
    }

    h4 {
        color: #999999;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }
}
</style>
