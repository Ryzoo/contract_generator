<template>
    <v-card class="pb-3">
        <v-avatar
            size="80%"
            class="mx-auto d-block"
        >
            <lazy-img :src="user.profileImage" alt="avatar"></lazy-img>
        </v-avatar>
        <input type="file" id="profileImageInput" hidden ref="profileImage" @change="profileImageAreChanged">
        <v-btn v-if="editable" @click="changeProfileImage" small class="mx-auto d-block" color="primary">{{$t('form.profileEditForm.button.change_img')}}</v-btn>
        <v-btn v-if="canBeSaved" small class="mx-auto d-block" color="success" @click="saveImage">
            {{$t('form.profileEditForm.button.save_img')}}
        </v-btn>
        <v-divider class="my-3"></v-divider>
        <h2 class="text-xs-center">{{user.firstName}} {{user.lastName}}</h2>
        <small class="text-xs-center d-block">{{isAdmin ? $t('user.roles.admin') : $t('user.roles.client') }}</small>
    </v-card>
</template>

<script>
    import {UserRoleEnum} from "../../additionalModules/Enums";

  export default {
    name: "BaseDataShow",
    props:[
      "userData",
      "editable"
    ],
    data(){
      return {
        user: this.userData,
        canBeSaved: false,
        isAdmin: this.userData.role === UserRoleEnum.ADMINISTRATOR
      }
    },
    methods:{
      saveImage(){

      },
      changeProfileImage(){
        $('#profileImageInput').click();
      },
      profileImageAreChanged(){
        let input = this.$refs.profileImage;

        if (input.files && input.files[0]) {
          let reader = new FileReader();

          reader.onload = (e) => {
            this.user.profileImage = e.target.result;
            this.canBeSaved = true;
            this.$forceUpdate();
          };

          reader.readAsDataURL(input.files[0]);
        }
      }
    }
  }
</script>

<style scoped>

</style>