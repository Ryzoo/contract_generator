<template>
  <section>
    <v-card-title>Ta umowa ma włączony moduł autoryzacji</v-card-title>
    <v-divider/>
    <v-card-text v-if="actualAuthType == AuthType.LOGIN">
      <p>Pozwolenie na wgląd mają tylko <b>zalogowani użytkownicy</b></p>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="primary"
          to="/auth/login">
          Przejdź do strony logowania
        </v-btn>
      </v-card-actions>
    </v-card-text>
    <v-card-text v-if="actualAuthType == AuthType.PASSWORD">
      <p>Pozwolenie na wgląd mają tylko <b>osoby znające hasło</b></p>
      <v-form>
        <v-text-field
          prepend-icon="fa-lock"
          v-model="password"
          label="Hasło"
          type="password"
        >
        </v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer/>
      <v-btn
        color="primary"
        @click="checkFinishLogic">
        Dalej
      </v-btn>
    </v-card-actions>
  </section>
</template>

<script>
import { AuthType } from './Enums'

export default {
  name: 'AuthBeforeRenderView',
  props: [
    'actualModule'
  ],
  data () {
    return {
      password: '',
      AuthType: AuthType,
      actualAuthType: this.actualModule.settings.type
    }
  },
  methods: {
    finishAction () {
      this.$emit('finish', [])
    },
    finishWithPassword () {
      if (!this.password) return

      try {
        const validationArray = []
        validationArray['Hasło'] = this.password

        const valid = new Validator(validationArray)

        valid.get('Hasło').length(1, 250)
      } catch (e) {
        return false
      }

      this.$emit('finish', {
        password: this.password
      })
    },
    finishAsLoggedUser () {
      const user = this.$store.getters.authUser
      if (user && user.email && user.loginToken) {
        this.finishAction()
      }

      return false
    },
    checkFinishLogic () {
      switch (String(this.actualAuthType)) {
        case AuthType.ALL:
          this.finishAction()
          break
        case AuthType.LOGIN:
          this.finishAsLoggedUser()
          break
        case AuthType.PASSWORD:
          this.finishWithPassword()
          break
      }
    }
  },
  mounted () {
    this.checkFinishLogic()
  }
}
</script>
