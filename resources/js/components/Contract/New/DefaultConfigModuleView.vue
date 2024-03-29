<template>
    <div class="config-module-view">
        <div class="module-icon">
            <v-icon>{{module.icon}}</v-icon>
        </div>
        <div class="module-content">
            <h4 class="my-0">{{module.name}}</h4>
            <v-fade-transition mode="out-in">
                <p v-if="!isOn">{{module.description}}</p>
            </v-fade-transition>
        </div>
        <v-fade-transition mode="out-in">
            <div class="module-action" v-if="isOn" @click="configureDialog=true">
                <v-icon>fa-sliders-h</v-icon>
            </div>
        </v-fade-transition>
        <div class="module-action">
            <v-switch v-model="isOn" :disabled="module.required" @change="changeModuleState" color="success" hide-details inset/>
        </div>
        <v-dialog v-model="configureDialog"  width="800px">
            <v-card>
                <v-card-title>
                    <span class="headline">{{$t('module.header.moduleConfiguration')}} {{module.name}}</span>
                </v-card-title>
                <v-card-text>
                    <component :ref="module.slug" :module="module" :is="module.configComponent"/>
                </v-card-text>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn outlined color="primary" @click="configureDialog = false">{{$t('base.button.close')}}</v-btn>
                    <v-btn color="primary" @click="saveConfig">{{$t('base.button.save')}}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import AuthConfigView from '../Modules/Auth/AuthConfigView'
import ProviderConfigView from '../Modules/Provider/ProviderConfigView'

export default {
  name: 'DefaultConfigModuleView',
  props: [
    'module'
  ],
  data () {
    return {
      isOn: false,
      configureDialog: false
    }
  },
  components: {
    AuthConfigView,
    ProviderConfigView
  },
  methods: {
    saveConfig () {
      this.$refs[this.module.slug].saveConfig()
      this.configureDialog = false
    },
    changeModuleState (value) {
      return this.$store.dispatch('newContract_updateModuleState', {
        slug: this.module.slug,
        value: value,
        settings: this.module.settings
      })
    },
    loadDataFromStore () {
      const allModules = this.$store.getters.newContract_availableModules
      this.isOn = allModules.includes(this.module.slug)
      this.checkRequired()
    },
    checkRequired () {
      if (!this.isOn && this.module.required) {
        this.changeModuleState(true)
          .then(() => {
            this.loadDataFromStore()
          })
      }
    }
  },
  mounted () {
    this.loadDataFromStore()
  }
}
</script>

<style scoped lang="scss">
    .config-module-view {
        display: flex;
        justify-content: center;
        align-items: stretch;
        width: 100%;
        max-width: 500px;
        border: 2px solid #e0e0e0;
        background: #f2f2f2;
        border-radius: 20px;
        margin: 10px auto;
        transition: all .2s;

        &:hover{
            border: 2px solid #c2c2c2;
        }

        .module-icon{
            width: 80px;
            font-size: 73px;
            display: flex;
            justify-content: center;
            padding: 15px;
            i{
                font-size: 45px;
            }
        }

        .module-content{
            padding: 10px 10px 10px 0;
            display: flex;
            flex: 1;
            flex-direction: column;
            justify-content: center;
            p{
                flex: 1;
                margin: 0;
            }
        }

        .module-action{
            &:before{
                content: "";
                position: absolute;
                left: 0;
                background: #e0e0e0;
                height: 100%;
                width: 1px;
            }
            justify-content: center;
            align-items: center;
            position: relative;
            width: 80px;
            display: flex;
            flex-direction: column;

            .v-input--selection-controls{
                padding-top: 0;
                margin-top: 0;
                width: 41px;
            }

            i{
                font-size: 25px;
                transition: all .2s;
                &:hover{
                    transform: rotate(-90deg);
                    cursor: pointer;
                }
            }
        }
    }
</style>
