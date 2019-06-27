<template>
    <v-card class="elevation-12">
        <v-toolbar>
            <v-toolbar-title>{{$t('form.register.title')}}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="pb-0">
            <v-form v-if="isLoaded">
                <v-text-field
                    prepend-icon="person"
                    v-model="registerForm.firstName"
                    :label="$t('form.register.field.firstName')"
                    type="text">
                </v-text-field>
                <v-text-field
                    prepend-icon="person"
                    v-model="registerForm.lastName"
                    :label="$t('form.register.field.lastName')"
                    type="text">
                </v-text-field>
                <v-text-field
                    prepend-icon="person"
                    v-model="registerForm.email"
                    :label="$t('form.register.field.email')"
                    type="email">
                </v-text-field>
                <v-text-field
                    prepend-icon="lock"
                    v-model="registerForm.password"
                    :label="$t('form.register.field.password')"
                    type="password">
                </v-text-field>
                <v-text-field
                    prepend-icon="lock"
                    v-model="registerForm.rePassword"
                    :label="$t('form.register.field.rePassword')"
                    type="password">
                </v-text-field>
            </v-form>
            <loader v-else></loader>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" :disabled="!isLoaded" to="/auth/login">{{$t('form.register.button.login')}}</v-btn>
            <v-btn color="primary" :disabled="!isLoaded" @click="sendRegisterForm">{{$t('form.register.button.register')}}</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
  export default {
    name: "RegisterView",
    data() {
      return {
        isLoaded: true,
        registerForm: {
          firstName: "",
          lastName: "",
          email: "",
          password: "",
          rePassword: "",
        }
      }
    },
    methods: {
      sendRegisterForm() {
        try {
          let validationArray = [];

          validationArray[this.$t('form.register.field.firstName')] = this.registerForm.firstName;
          validationArray[this.$t('form.register.field.lastName')] = this.registerForm.lastName;
          validationArray[this.$t('form.register.field.email')] = this.registerForm.email;
          validationArray[this.$t('form.register.field.password')] = this.registerForm.password;
          validationArray[this.$t('form.register.field.rePassword')] = this.registerForm.rePassword;

          let valid = new window.Validator(validationArray);

          valid.get(this.$t('form.register.field.firstName')).length(3, 50);
          valid.get(this.$t('form.register.field.lastName')).length(3, 50);
          valid.get(this.$t('form.register.field.email')).isEmail();
          valid.get(this.$t('form.register.field.password')).length(6, 50);
          valid.get(this.$t('form.register.field.rePassword'))
              .length(6, 50)
              .sameAs(this.$t('form.register.field.password'));
        }
        catch (e) {
          return
        }

        this.isLoaded = false;
        axios.post("/auth/register", this.registerForm)
            .then((response) => {
              notify.push(this.$t('form.register.notify.success'), notify.SUCCESS);
              this.$router.push( '/auth/login');
            })
            .finally(() => {
              this.isLoaded = true;
            })
      }
    }
  }
</script>

<style scoped>

</style>