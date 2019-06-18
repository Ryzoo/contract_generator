<template>
    <v-card class="elevation-12">
        <v-toolbar>
            <v-toolbar-title>{{$t('form.resetPassword.title')}}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="pb-0">
            <v-form>
                <v-text-field
                    prepend-icon="person"
                    :label="$t('form.resetPassword.field.email')"
                    type="email">
                </v-text-field>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" to="/auth/login">{{$t('form.resetPassword.button.cancel')}}</v-btn>
            <v-btn color="primary">{{$t('form.resetPassword.button.remind')}}</v-btn>
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