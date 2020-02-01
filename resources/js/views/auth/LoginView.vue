<template>
  <v-card class="pa-5">
    <v-icon x-large right class="float-right auth-icon" >fas fa-unlock-alt</v-icon>
    <v-card-title>
      <h1 class="display-1 mb-5">{{$t("form.login.title") }}</h1>
    </v-card-title>
    <v-card-text class="pb-0">
      <v-form v-if="isLoaded">
        <v-text-field
          prepend-icon="fa-envelope"
          v-model="loginForm.email"
          :label="$t('base.field.email')"
          type="email"
        >
        </v-text-field>
        <v-text-field
          prepend-icon="fa-lock"
          v-model="loginForm.password"
          :label="$t('base.field.password')"
          type="password"
        >
        </v-text-field>
        <small class="ma-0"
        >{{ $t("form.login.text.forgotPassword") }}
          <router-link to="/auth/sendResetPasswordToken">{{
            $t("form.login.link.resetPassword")
            }}
          </router-link>
        </small>
        <br/>
      </v-form>
      <loader v-else/>
    </v-card-text>
    <v-card-actions>
      <v-spacer/>
      <v-btn
        :disabled="!isLoaded"
        outlined
        color="primary"
        to="/auth/register"
      >{{ $t("base.button.register") }}
      </v-btn>
      <v-btn :disabled="!isLoaded" color="primary" @click="sendLoginForm"
      >{{ $t("base.button.login") }}
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'LoginView',
  data () {
    return {
      isLoaded: true,
      loginForm: {
        email: 't.admin@test.pl',
        password: 'admin1'
      }
    }
  },
  methods: {
    sendLoginForm () {
      try {
        const validationArray = []

        validationArray[
          this.$t('base.field.email')
        ] = this.loginForm.email
        validationArray[
          this.$t('base.field.password')
        ] = this.loginForm.password

        const valid = new Validator(validationArray)

        valid.get(this.$t('base.field.email')).isEmail()
        valid.get(this.$t('base.field.password')).length(3, 255)
      } catch (e) {
        return
      }

      this.isLoaded = false
      axios.post('/auth/login', this.loginForm)
        .then(response => {
          notify.push(
            this.$t('form.login.notify.success'),
            notify.SUCCESS
          )
          auth.login(response.data, this.$route.query.redirect)
        })
        .finally(() => {
          this.isLoaded = true
        })
    }
  }
}
</script>

<style scoped/>
