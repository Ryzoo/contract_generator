<template>
  <v-card>
    <v-card-title>
      <v-row class="align-center">
        <v-col cols="12" md="auto">
          {{isNewAttribute ? $t("form.variableForm.new.title") : $t("form.variableForm.update.title")}}
        </v-col>
        <v-col>
          <v-select
            :items="variableOptions"
            :label="$t('form.variableForm.type')"
            outlined
            dense
            hide-details
            color="primary"
            v-model="attribute.attributeType"
            @change="setSettingsForType"
          />
        </v-col>
      </v-row>
    </v-card-title>
    <v-divider/>
    <v-card-text>
      <v-row v-if="attribute.attributeType > -1">
        <v-col cols="12">
          <v-text-field
            hide-details
            dense
            outlined
            autofocus
            v-model="attribute.attributeName"
            :label="$t('form.variableForm.name')"
          />
        </v-col>
        <v-col cols="12" class="pb-0" v-if="attribute.attributeType === AttributeTypeEnum.SELECT">
          <v-combobox
            persistent-hint
            :hint="$t('form.variableForm.itemsHint')"
            hide-details
            dense
            outlined
            :items="[]"
            small-chips
            multiple
            clearable
            deletable-chips
            v-model="attribute.settings.items"
            :label="$t('form.variableForm.items')"
          />
        </v-col>
        <v-col cols="12" class="pb-0" v-if="attribute.attributeType === AttributeTypeEnum.REPEAT_GROUP">
          <v-select
            v-model="selectedVariables"
            :items="attributesList"
            item-text="attributeName"
            item-value="id"
            :label="$t('form.variableForm.selectVariables')"
            multiple
            persistent-hint
            return-object
            single-line
            hide-details
            dense
            outlined
          ></v-select>
        </v-col>
        <v-col cols="12" class="py-0">
          <VariableSettings
            :attributesList="attributesList"
            :settings="attribute.settings"
            :currentSettings="settingsForType"
            @save="saveSettingsInput"
          />
        </v-col>
        <v-col cols="12">
          <v-expansion-panels>
            <v-expansion-panel>
              <v-expansion-panel-header>Additional configuration</v-expansion-panel-header>
              <v-expansion-panel-content>
                <v-row>
                  <v-col cols="12">
                    <v-text-field hide-details dense outlined v-model="attribute.placeholder" :label="$t('form.variableForm.placeholder')" outline/>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field hide-details dense outlined v-model="attribute.description" :label="$t('form.variableForm.label')" outline/>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field hide-details dense outlined v-model="attribute.defaultValue" :label="$t('form.variableForm.defaultValue')" outline/>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field hide-details dense outlined v-model="attribute.additionalInformation" :label="$t('form.variableForm.additionalInformation')" outline/>
                  </v-col>
                  <v-col cols="12">
                    <v-checkbox class="mt-0" hide-details dense outlined v-model="attribute.toAnonymize" :label="$t('form.variableForm.forAnonymise')"/>
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
      <v-btn color="primary" @click="saveVariable">{{isNewAttribute ? "Create" : "Save"}}</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import VariableSettings from './VariableSettings'
import { AttributeTypeEnum } from '../../../../../additionalModules/Enums'

export default {
  name: 'CreateEditVariable',
  props: [
    'attributesList', 'editAttribute', 'isNewAttribute'
  ],
  components: {
    VariableSettings
  },
  data () {
    const attribute = this.editAttribute || this.getDefaultAttribute()
    const selectedVariables = this.editAttribute ? this.getSelectedVariables(attribute) : []

    return {
      variableOptions: [],
      attribute: attribute,
      allAttributes: [],
      AttributeTypeEnum: AttributeTypeEnum,
      settingsForType: {},
      selectedVariables: selectedVariables
    }
  },
  watch: {
    editAttribute (newValue) {
      this.attribute = this.editAttribute || this.getDefaultAttribute()
      this.selectedVariables = this.editAttribute ? this.getSelectedVariables(this.attribute) : []
      this.settingsForType = this.getSettingsForType(this.attribute.attributeType)
    }
  },
  mounted () {
    this.getAllAttributes()
  },
  methods: {
    getSelectedVariables (attribute) {
      if (attribute.content && attribute.content.length > 0) {
        this.selectedVariables = attribute.content
      }

      return this.selectedVariables
    },
    pushCloseEvent () {
      this.$emit('close')
    },
    getAllAttributes () {
      axios.get('elements/attributes')
        .then((res) => {
          this.allAttributes = res.data
          this.variableOptions = res.data.map(x => {
            return {
              value: x.attributeType,
              text: x.attributeName
            }
          })
          this.settingsForType = this.getSettingsForType(this.attribute.attributeType)
        })
    },
    editVariable (attribute) {
      this.isNewAttribute = false
      this.attribute = attribute
    },
    saveSettingsInput (inputData) {
      this.attribute.settings[inputData.name] = inputData.value
    },
    setSettingsForType () {
      this.settingsForType = this.getSettingsForType(this.attribute.attributeType)
      this.attribute.settings = this.settingsForType
    },
    getSettingsForType (type) {
      const attributeType = this.allAttributes.find(x => x.attributeType === type)
      return attributeType ? attributeType.settings : {}
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
        settings: {}
      }
    },
    isValid () {
      try {
        const validationArray = []
        validationArray[this.$t('form.variableForm.name')] = this.attribute.attributeName

        if (this.attribute.attributeType === AttributeTypeEnum.SELECT) {
          validationArray[this.$t('form.variableForm.items')] = this.attribute.settings.items
        }

        const valid = new Validator(validationArray)

        valid.get(this.$t('form.variableForm.name')).length(3, 255)

        if (this.attribute.attributeType === AttributeTypeEnum.SELECT) {
          valid.get(this.$t('form.variableForm.items')).count(1)
        }
      } catch (e) {
        return false
      }

      return true
    },
    saveVariable () {
      if (this.isValid()) {
        const newSettings = {}

        Object.keys(this.settingsForType).forEach(key => {
          newSettings[key] = this.attribute.settings[key]
        })

        if (this.attribute.attributeType === AttributeTypeEnum.REPEAT_GROUP) {
          this.attribute.content = this.selectedVariables
        }

        this.$store.dispatch('builder_editVariable', this.attribute)
        this.$store.dispatch('builder_idVariableIncrement')

        this.attribute = this.getDefaultAttribute()
        this.$emit('close')
      }
    }
  }
}
</script>

<style scoped lang="scss"/>
