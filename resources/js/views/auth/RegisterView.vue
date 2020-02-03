<template>
  <v-card class="pa-5">
    <v-icon x-large right class="float-right auth-icon">fas fa-user-lock</v-icon>
    <v-card-title>
      <h1 class="display-1 mb-5">{{$t("form.register.title") }}</h1>
    </v-card-title>
    <v-card-text class="pb-0">
      <v-form v-if="isLoaded">
        <v-text-field
          prepend-icon="fa-user-edit"
          v-model="registerForm.firstName"
          :label="$t('base.field.firstName')"
          type="text"
        >
        </v-text-field>
        <v-text-field
          prepend-icon="fa-user-edit"
          v-model="registerForm.lastName"
          :label="$t('base.field.lastName')"
          type="text"
        >
        </v-text-field>
        <v-text-field
          prepend-icon="fa-envelope"
          v-model="registerForm.email"
          :label="$t('base.field.email')"
          type="email"
        >
        </v-text-field>
        <v-text-field
          prepend-icon="fa-lock"
          v-model="registerForm.password"
          :label="$t('base.field.password')"
          type="password"
        >
        </v-text-field>
        <v-text-field
          prepend-icon="fa-lock"
          v-model="registerForm.rePassword"
          :label="$t('base.field.rePassword')"
          type="password"
        >
        </v-text-field>
        <v-checkbox v-model="registerForm.rodoAccept">
          <template v-slot:label>
            {{ $t("base.field.rodoAccept") }}:
            <a target="_blank" href="http://google.pl" @click.stop>
              {{ $t("base.link.rodo") }}
            </a>
          </template>
        </v-checkbox>
        <v-checkbox v-model="registerForm.regulationsAccept">
          <template v-slot:label>
            {{ $t("base.field.regulationsAccept") }}:
            <a target="_blank" href="http://google.pl" @click.stop>
              {{ $t("base.link.regulations") }}
            </a>
          </template>
        </v-checkbox>
      </v-form>
      <loader v-else/>
    </v-card-text>
    <v-card-actions>
      <v-spacer/>
      <v-btn
        text
        color="primary"
        :disabled="!isLoaded"
        to="/auth/login"
      >{{ $t("base.button.login") }}
      </v-btn
      >
      <v-btn
        color="primary"
        :disabled="!isLoaded"
        @click="sendRegisterForm"
      >{{ $t("base.button.register") }}
      </v-btn
      >
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'RegisterView',
  data () {
    return {
      isLoaded: true,
      registerForm: {
        firstName: '',
        lastName: '',
        email: '',
        password: '',
        rePassword: '',
        rodoAccept: false,
        regulationsAccept: false
      }
    }
  },
  methods: {
    sendRegisterForm () {
      try {
        const validationArray = []

        validationArray[
          this.$t('base.field.firstName')
        ] = this.registerForm.firstName
        validationArray[
          this.$t('base.field.lastName')
        ] = this.registerForm.lastName
        validationArray[
          this.$t('base.field.email')
        ] = this.registerForm.email
        validationArray[
          this.$t('base.field.password')
        ] = this.registerForm.password
        validationArray[
          this.$t('base.field.rePassword')
        ] = this.registerForm.rePassword
        validationArray[
          this.$t('base.field.rodoAccept')
        ] = this.registerForm.rodoAccept
        validationArray[
          this.$t('base.field.regulationsAccept')
        ] = this.registerForm.regulationsAccept

        const valid = new window.Validator(validationArray)

        valid
          .get(this.$t('base.field.firstName'))
          .length(3, 50)
        valid
          .get(this.$t('base.field.lastName'))
          .length(3, 50)
        valid.get(this.$t('base.field.email')).isEmail()
        valid
          .get(this.$t('base.field.password'))
          .length(6, 50)
        valid
          .get(this.$t('base.field.rePassword'))
          .length(6, 50)
          .sameAs(this.$t('base.field.password'))
        valid.get(this.$t('base.field.rodoAccept')).isTrue()
        valid
          .get(this.$t('base.field.regulationsAccept'))
          .isTrue()
      } catch (e) {
        return
      }

      this.isLoaded = false
      axios.post('/auth/register', this.registerForm)
        .then(response => {
          notify.push(this.$t('form.register.notify.success'), notify.SUCCESS)
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
