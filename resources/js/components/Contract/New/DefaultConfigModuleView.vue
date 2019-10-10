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
            <div class="module-action" v-if="isOn">
                <v-icon>fa-sliders-h</v-icon>
            </div>
        </v-fade-transition>
        <div class="module-action">
            <v-switch v-model="isOn" color="success" hide-details inset></v-switch>
        </div>
    </div>
</template>

<script>
  import AuthConfigView from "../Modules/Auth/AuthConfigView";
  import ProviderConfigView from "../Modules/Provider/ProviderConfigView";

  export default {
    name: "DefaultConfigModuleView",
    props:[
        "module"
    ],
    data(){
      return {
        isOn: false
      }
    },
    components:{
      AuthConfigView,
      ProviderConfigView,
    },
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
