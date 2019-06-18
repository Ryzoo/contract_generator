<template>
    <v-card class="elevation-12">
        <v-toolbar>
            <v-toolbar-title>{{$t('form.register.title')}}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="pb-0">
            <v-form>
                <v-text-field
                    prepend-icon="person"
                    :label="$t('form.register.field.firstName')"
                    type="email">
                </v-text-field>
                <v-text-field
                    prepend-icon="person"
                    :label="$t('form.register.field.lastName')"
                    type="email">
                </v-text-field>
                <v-text-field
                    prepend-icon="person"
                    :label="$t('form.register.field.email')"
                    type="email">
                </v-text-field>
                <v-text-field
                    prepend-icon="lock"
                    :label="$t('form.register.field.password')"
                    type="password">
                </v-text-field>
                <v-text-field
                    prepend-icon="lock"
                    :label="$t('form.register.field.rePassword')"
                    type="password">
                </v-text-field>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" to="/auth/login">{{$t('form.register.button.login')}}</v-btn>
            <v-btn color="primary">{{$t('form.register.button.register')}}</v-btn>
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