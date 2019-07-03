<template>
    <v-card class="pb-3">
        <div v-if="isLoaded">
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
        </div>
        <loader v-else></loader>
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
        isLoaded: true,
        user: this.userData,
        canBeSaved: false,
        isAdmin: this.userData.role === UserRoleEnum.ADMINISTRATOR
      }
    },
    methods:{
      saveImage(){
        let imagefile = this.$refs.profileImage;

        if(imagefile && imagefile.files && imagefile.files[0]){
          let formData = new FormData();
          formData.append("image", imagefile.files[0]);

          this.isLoaded = false;
          axios.post(`/user/${this.user.id}/profileImage`, formData,{
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
              .then(() => {
                notify.push(this.$t('page.panel.profile.base.success_change_img'), notify.SUCCESS);
                auth.checkAuth();
                this.canBeSaved = false;
              })
              .finally(() => {
                this.isLoaded = true;
              })
        }
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