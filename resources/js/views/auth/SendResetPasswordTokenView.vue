<template>
  <v-card class="pa-5">
    <v-icon x-large right class="float-right auth-icon">fas fa-user-lock</v-icon>
    <v-card-title>
      <h1 class="display-1 mb-5">{{$t("form.sendResetTokenForm.title") }}</h1>
    </v-card-title>
    <v-card-text class="pb-0">
      <v-form v-if="isLoaded">
        <v-text-field
          prepend-icon="fa-envelope"
          v-model="sendTokenForm.email"
          :label="$t('base.field.email')"
          type="email"
        >
        </v-text-field>
      </v-form>
      <loader v-else></loader>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn
        text
        color="primary"
        to="/auth/login"
        :disabled="!isLoaded"
      >{{ $t("base.button.cancel") }}
      </v-btn
      >
      <v-btn
        color="primary"
        :disabled="!isLoaded"
        @click="sendResetToken"
      >{{ $t("base.button.remind") }}
      </v-btn
      >
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'SendResetPasswordTokenView',
  data () {
    return {
      isLoaded: true,
      sendTokenForm: {
        email: ''
      }
    }
  },
  methods: {
    sendResetToken () {
      try {
        const validationArray = []

        validationArray[
          this.$t('form.sendResetTokenForm.field.email')
        ] = this.sendTokenForm.email

        const valid = new window.Validator(validationArray)

        valid
          .get(this.$t('form.sendResetTokenForm.field.email'))
          .isEmail()
      } catch (e) {
        return
      }

      this.isLoaded = false
      axios
        .post('/auth/resetPassword/sendToken', this.sendTokenForm)
        .then(response => {
          notify.push(
            this.$t('form.sendResetTokenForm.notify.success'),
            notify.SUCCESS
          )
          this.$router.push('/auth/login')
        })
        .finally(() => {
          this.isLoaded = true
        })
    }
  }
}
</script>

<style scoped></style>
