<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
                <v-card class="pb-3">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title class="white--text">{{ $t("form.accountAddForm.title") }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text v-if="isLoaded">
                        <v-form>
                            <v-container>
                                <v-row row wrap>
                                    <v-col sm="12" md="6" class="pa-1">
                                      <v-text-field
                                        prepend-icon="fa-user-edit"
                                        v-model="user.firstName"
                                        :label="$t('base.field.firstName')"
                                        required
                                      />
                                    </v-col>
                                    <v-col sm="12" md="6" class="pa-1">
                                      <v-text-field
                                        prepend-icon="fa-user-edit"
                                        v-model="user.lastName"
                                        :label="$t('base.field.lastName')"
                                        required
                                      />
                                    </v-col>
                                    <v-col sm="12" md="6" class="pa-1">
                                      <v-text-field
                                        prepend-icon="fa-envelope"
                                        v-model="user.email"
                                        :label="$t('base.field.email')"
                                        type="email"
                                        required
                                      />
                                    </v-col>
                                  <v-col sm="12" md="6" class="pa-1">
                                    <v-select
                                      prepend-icon="fa-shield-alt"
                                      v-model="user.roles"
                                      :items="roleList"
                                      chips
                                      :label="$t('base.field.role')"
                                      multiple
                                    />
                                  </v-col>
                                    <v-col sm="12" md="6" class="pa-1">
                                        <v-text-field
                                            prepend-icon="fa-lock"
                                            v-model="user.password"
                                            :label="$t('base.field.password')"
                                            type="password"
                                        >
                                        </v-text-field>
                                    </v-col>
                                    <v-col sm="12" md="6" class="pa-1">
                                        <v-text-field
                                            prepend-icon="fa-lock"
                                            v-model="user.password_confirmation"
                                            :label="$t('base.field.rePassword')"
                                            type="password"
                                        >
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row align="end" justify="end">
                                    <v-btn
                                        color="primary"
                                        text
                                        @click="$router.push('/panel/settings/accounts')"
                                    >
                                        {{ $t("base.button.back") }}
                                    </v-btn>
                                    <v-btn
                                        color="success"
                                        @click="addAccount()"
                                    >
                                        {{ $t("base.button.save") }}
                                    </v-btn>
                                </v-row>
                            </v-container>
                        </v-form>
                    </v-card-text>
                  <loader v-else/>
                </v-card>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
export default {
  name: 'CreateAccountsView',
  data: function () {
    return {
      isLoaded: true,
      user: {
        firstName: null,
        lastName: null,
        email: null,
        password: null,
        password_confirmation: null,
        roles: []
      },
      roleList: []
    }
  },
  methods: {
    getRoleList () {
      this.isLoaded = false
      axios
        .get('/role')
        .then(response => {
          this.roleList = response.data.map(x => ({
            text: x.name,
            value: x.id
          }))
        })
        .finally(() => {
          this.isLoaded = true
        })
    },
    addAccount () {
      try {
        const validationArray = []

        validationArray[this.$t('base.field.firstName')] = this.user.firstName
        validationArray[this.$t('base.field.lastName')] = this.user.lastName
        validationArray[this.$t('base.field.email')] = this.user.email
        validationArray[this.$t('base.field.password')] = this.user.password
        validationArray[this.$t('base.field.rePassword')] = this.user.password_confirmation

        const valid = new window.Validator(validationArray)

        valid.get(this.$t('base.field.firstName'))
          .length(3, 50)

        valid.get(this.$t('base.field.lastName'))
          .length(3, 50)

        valid.get(this.$t('base.field.email'))
          .isEmail()

        valid.get(this.$t('base.field.password'))
          .length(6, 50)

        valid.get(this.$t('base.field.rePassword'))
          .length(6, 50)
          .sameAs(this.$t('base.field.password'))
      } catch (e) {
        return
      }

      this.isLoaded = false
      axios
        .post('/user', this.user)
        .then(response => {
          notify.push(
            this.$t('form.accountAddForm.notify.success'),
            notify.SUCCESS
          )
          this.$router.push('/panel/settings/accounts')
        })
        .finally(() => {
          this.isLoaded = true
        })
    }
  },
  mounted () {
    this.getRoleList()
  }
}
</script>

<style scoped lang="scss"/>
