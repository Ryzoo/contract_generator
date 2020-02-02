<template>
    <section>
        <h3>{{$t('module.provider.descriptionConfig')}}</h3>
      <v-divider class="my-3"/>
        <v-row>
            <v-col class="d-flex" cols="12" >
              <v-select
                :items="items"
                v-model="settings.type"
                label="Provide options"
              />
            </v-col>
        </v-row>
    </section>
</template>

<script>
import { ContractProviderType } from './Enums'

export default {
  name: 'ProviderConfigView',
  props: ['module'],
  data () {
    return {
      ContractProviderType: ContractProviderType,
      items: [
        { text: this.$t('module.provider.type.renderAfterFinish'), value: ContractProviderType.RENDER },
        { text: this.$t('module.provider.type.renderToEmail'), value: ContractProviderType.EMAIL }
      ],
      settings: this.$store.getters.getModuleSettings(this.module.slug) || this.module.settings
    }
  },
  methods: {
    saveConfig () {
      this.$store.dispatch('newContract_saveModuleConfig', {
        slug: this.module.slug,
        value: this.settings
      })
    }
  }
}
</script>
