<template>
  <section>
    <v-card-title>{{$t('module.auth.title')}}</v-card-title>
    <v-divider/>
    <v-card-text v-if="actualAuthType === AuthType.LOGIN">
      <p>{{$t('module.auth.description')}}</p>
      <v-card-actions>
        <v-btn
          class="mx-auto"
          color="primary"
          to="/auth/login">
          <v-icon small left>fa-lock-open</v-icon> {{$t('base.button.goToLogin')}}
        </v-btn>
      </v-card-actions>
    </v-card-text>
    <v-card-text v-if="actualAuthType === AuthType.PASSWORD">
      <p>{{$t('module.auth.descriptionAuth')}}</p>
      <v-form>
        <v-text-field
          prepend-inner-icon="fa-lock"
          v-model="password"
          hide-details
          outlined
          :label="$t('base.field.password')"
          type="password"
        >
        </v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer/>
      <v-btn
        color="primary"
        :disabled="disableNextButton()"
        @click="checkFinishLogic">
        {{$t('base.button.next')}}
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
  computed: {
    isAuthorized () {
      return auth.isAuthorized()
    }
  },
  methods: {
    disableNextButton () {
      switch (String(this.actualAuthType)) {
        case AuthType.LOGIN:
          return !this.isAuthorized
        case AuthType.PASSWORD:
          return !this.password.length
      }

      return false
    },
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
      if (this.isAuthorized) {
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
