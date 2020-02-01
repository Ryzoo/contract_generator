<template>
    <v-row align="center" justify="center">
        <v-col cols="12" sm="10" lg="8">
            <v-card>
                <v-toolbar dark color="primary">
                    <v-toolbar-title class="white--text">
                        {{ $t("form.accountEditForm.title") }} - {{ email }}
                    </v-toolbar-title>
                </v-toolbar>
                <v-card-text v-if="isLoaded">
                    <v-form>
                        <v-container>
                            <v-row>
                                <v-col cols="12" md="6" class="pa-1">
                                  <v-text-field
                                    prepend-icon="fa-user-edit"
                                    v-model="user.firstName"
                                    :label="$t('base.field.firstName')"
                                    required
                                  />
                                </v-col>
                                <v-col cols="12" md="6" class="pa-1">
                                  <v-text-field
                                    prepend-icon="fa-user-edit"
                                    v-model="user.lastName"
                                    :label="$t('base.field.lastName')"
                                    required
                                  />
                                </v-col>
                              <v-col cols="12" md="6" class="pa-1">
                                <v-select
                                  prepend-icon="fa-shield-alt"
                                  v-model="user.roles"
                                  :items="roleList"
                                  chips
                                  :label="$t('base.field.role')"
                                  multiple
                                />
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
                                <v-btn color="success" @click="saveAccount()">
                                    {{ $t("base.button.save") }}
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-form>
                </v-card-text>
              <loader v-else/>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>

export default {
  name: 'CreateAccountsView',
  data: function () {
    return {
      accountId: this.$route.params.id,
      isLoaded: true,
      email: null,
      roleList: [],
      user: {
        firstName: null,
        lastName: null,
        roles: []
      }
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
    saveAccount () {
      try {
        const validationArray = []

        validationArray[this.$t('base.field.firstName')] = this.user.firstName
        validationArray[this.$t('base.field.lastName')] = this.user.lastName

        const valid = new window.Validator(validationArray)

        valid.get(this.$t('base.field.firstName'))
          .length(3, 50)

        valid.get(this.$t('base.field.lastName'))
          .length(3, 50)
      } catch (e) {
        return
      }

      this.isLoaded = false

      axios.put('/user/' + this.accountId, this.user)
        .then(response => {
          notify.push(
            this.$t('form.accountEditForm.notify.success'),
            notify.SUCCESS
          )
          this.$router.push('/panel/settings/accounts')
        })
        .finally(() => {
          this.isLoaded = true
        })
    },
    loadAccount () {
      this.isLoaded = false

      axios.get('/user/' + this.accountId)
        .then(response => {
          this.user = {
            firstName: response.data.firstName,
            lastName: response.data.lastName,
            roles: response.data.roles.map(x => x.id)
          }

          this.email = response.data.email
        })
        .catch(() => {
          this.$router.push('/panel/settings/accounts')
        })
        .finally(() => {
          this.isLoaded = true
        })
    }
  },
  mounted () {
    this.loadAccount()
    this.getRoleList()
  }
}
</script>

<style scoped lang="scss"/>
