<template>
    <v-card class="elevation-12">
        <v-toolbar>
            <v-toolbar-title>{{$t('form.login.title')}}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="pb-0">
            <v-form>
                <v-text-field
                    prepend-icon="person"
                    :label="$t('form.login.field.email')"
                    type="email">
                </v-text-field>
                <v-text-field
                    prepend-icon="lock"
                    :label="$t('form.login.field.password')"
                    type="password">
                </v-text-field>
            </v-form>
            <small class="ma-0">{{$t('form.login.text.forgotPassword')}} <router-link to="/auth/resetPassword">{{$t('form.login.link.resetPassword')}}</router-link></small> <br/>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" to="/auth/register">{{$t('form.login.button.register')}}</v-btn>
            <v-btn color="primary">{{$t('form.login.button.login')}}</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
  export default {
    name: "LoginView"
  }
</script>

<style scoped>

</style>