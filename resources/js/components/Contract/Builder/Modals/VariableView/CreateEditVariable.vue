<template>
  <v-card>
    <v-card-title>
      <v-row class="align-center">
        <v-col cols="12" md="auto">
          {{isNew ? $t("form.variableForm.new.title") : $t("form.variableForm.update.title")}}
        </v-col>
        <v-col>
          <v-select
            :items="variableTypeList"
            :label="$t('form.variableForm.type')"
            outlined
            dense
            hide-details
            color="primary"
            v-model="attributeData.attributeType"
            @change="setVariableType"
          />
        </v-col>
      </v-row>
    </v-card-title>
    <v-divider/>
    <v-card-text>
      <v-row v-if="attributeData.attributeType > -1">
        <v-col cols="12">
          <v-text-field
            hide-details
            dense
            outlined
            autofocus
            v-model="attributeData.attributeName"
            :label="$t('form.variableForm.name')"
          />
        </v-col>
        <v-col cols="12">
          <v-expansion-panels>
            <v-expansion-panel>
              <v-expansion-panel-header>Settings</v-expansion-panel-header>
              <v-expansion-panel-content>
                <VariableSettings
                  :attribute="attributeData"
                  @save="updateSettings"
                />
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </v-col>
        <v-col cols="12">
          <v-expansion-panels>
            <v-expansion-panel>
              <v-expansion-panel-header>Additional configuration</v-expansion-panel-header>
              <v-expansion-panel-content>
                <v-row>
                  <v-col cols="12">
                    <v-text-field hide-details dense outlined v-model="attributeData.placeholder" :label="$t('form.variableForm.placeholder')" outline/>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field hide-details dense outlined v-model="attributeData.description" :label="$t('form.variableForm.label')" outline/>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field hide-details dense outlined v-model="attributeData.defaultValue" :label="$t('form.variableForm.defaultValue')" outline/>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field hide-details dense outlined v-model="attributeData.additionalInformation" :label="$t('form.variableForm.additionalInformation')" outline/>
                  </v-col>
                  <v-col cols="12">
                    <v-checkbox class="mt-0" hide-details dense outlined v-model="attributeData.toAnonymize" :label="$t('form.variableForm.forAnonymise')"/>
                  </v-col>
                </v-row>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </v-col>
        <v-col cols="12">
          <v-expansion-panels>
            <v-expansion-panel>
              <v-expansion-panel-header>
                Multi use
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <v-row>
                  <v-col cols="12">
                    <v-switch class="mt-0" hide-details dense outlined v-model="attributeData.settings.isMultiUse" :label="$t('form.variableForm.isMultiUse')"></v-switch>
                  </v-col>
                  <v-col cols="12">
                    <v-switch class="mt-0" hide-details dense outlined v-model="attributeData.settings.isInline" :label="$t('form.variableForm.isInline')"></v-switch>
                  </v-col>
                  <v-col cols="12" v-if="attributeData.settings.isInline">
                    <v-select
                      persistent-hint
                      :items="multiRenderTypeItems"
                      :hint="$t('form.variableForm.multiRenderTypeHint')"
                      hide-details
                      dense
                      outlined
                      v-model="attributeData.settings.multiUseRenderType"
                      :label="$t('form.variableForm.multiRenderType')"
                    />
                  </v-col>
                </v-row>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </v-col>
      </v-row>
    </v-card-text>

    <v-card-actions>
      <v-spacer/>
      <v-btn color="primary" outlined @click="pushCloseEvent">Cancel</v-btn>
      <v-btn color="primary" @click="saveVariable">{{isNew ? "Create" : "Save"}}</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import VariableSettings from './VariableSettings'
import { MultiUseRenderType } from '../../../../../additionalModules/Enums'

export default {
  name: 'CreateEditVariable',
  props: [
    'attribute'
  ],
  components: {
    VariableSettings
  },
  data () {
    return {
      multiRenderTypeItems: [
        {
          text: 'List',
          value: MultiUseRenderType.LIST.toString()
        },
        {
          text: 'Comma separated',
          value: MultiUseRenderType.COMMA_SEPARATED.toString()
        },
        {
          text: 'Table',
          value: MultiUseRenderType.TABLE.toString()
        }
      ],
      isLoading: false,
      variableTypeList: [],
      isNew: !this.attribute,
      attributeData: {
        ...(this.attribute || this.getDefaultAttribute())
      }
    }
  },
  mounted () {
    this.getAttributeDefaultSettings()
  },
  methods: {
    updateSettings (newSettings) {
      this.attributeData.settings = {
        ...newSettings
      }
    },
    setVariableType (type) {
      this.attributeData.attributeType = type
      this.getAttributeDefaultSettings()
    },
    pushCloseEvent () {
      this.$emit('close')
    },
    getAttributeDefaultSettings () {
      this.isLoading = true
      axios.get('elements/attributes')
        .then((res) => {
          this.variableTypeList = res.data.map(x => {
            return {
              value: x.attributeType,
              text: x.attributeName
            }
          })
          const attributeData = res.data.find(x => x.attributeType === this.attributeData.attributeType)
          this.setDefaultSettingsToNonSet(attributeData ? attributeData.settings : {})
        })
        .finally(() => {
          this.isLoading = false
        })
    },
    setDefaultSettingsToNonSet (defaultSettings) {
      const settings = {
        ...this.attributeData.settings
      }

      Object.keys(defaultSettings).map((key, index) => {
        if (!settings[key]) { settings[key] = defaultSettings[key] }
      })

      this.attributeData.settings = settings
    },
    getDefaultAttribute () {
      return {
        attributeName: '',
        id: this.$store.getters.builder_getVariableId,
        attributeType: -1,
        defaultValue: '',
        additionalInformation: '',
        placeholder: '',
        description: '',
        toAnonymize: '',
        isMultiUse: false,
        isInline: false,
        multiUseRenderType: null,
        settings: {}
      }
    },
    isValid () {
      try {
        const validationArray = []
        validationArray[this.$t('form.variableForm.name')] = this.attributeData.attributeName

        const valid = new Validator(validationArray)

        valid.get(this.$t('form.variableForm.name')).length(3, 255)
      } catch (e) {
        return false
      }

      return true
    },
    saveVariable () {
      if (this.isValid()) {
        if (this.isNew) {
          this.$store.dispatch('builder_addVariable', this.attributeData)
        } else {
          this.$store.dispatch('builder_editVariable', this.attributeData)
        }

        this.$emit('close')
      }
    }
  }
}
</script>
