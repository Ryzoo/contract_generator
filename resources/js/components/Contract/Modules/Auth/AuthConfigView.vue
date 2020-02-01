<template>
    <section>
        <h3>{{this.$t('module.auth.descriptionConfig')}}</h3>
      <v-divider class="my-3"/>
        <v-row>
            <v-col class="d-flex" cols="12" >
              <v-select
                :items="items"
                v-model="settings.type"
                :label="$t('module.auth.authOptions')"
              />
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
              <v-text-field
                v-if="settings.type === AuthType.PASSWORD"
                v-model="settings.password"
                required
                hide-details
                type="password"
                :label="$t('module.auth.pwdToAccess')"
              />
            </v-col>
        </v-row>
    </section>
</template>

<script>

import { AuthType } from './Enums'

export default {
  name: 'AuthConfigView',
  props: ['module'],
  data () {
    return {
      AuthType: AuthType,
      items: [
        { text: this.$t('module.auth.type.accessForLogged'), value: AuthType.LOGIN },
        { text: this.$t('module.auth.type.accessWithPwd'), value: AuthType.PASSWORD }
      ],
      settings: this.$store.getters.getModuleSettings(this.module.name) || this.module.settings
    }
  },
  methods: {
    saveConfig () {
      this.$store.dispatch('newContract_saveModuleConfig', {
        name: this.module.name,
        value: this.settings
      })
    }
  }
}
</script>
