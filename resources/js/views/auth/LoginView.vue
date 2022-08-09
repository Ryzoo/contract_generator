<template>
    <v-card class="pa-5">
        <v-icon x-large right class="float-right auth-icon"
            >fas fa-unlock-alt</v-icon
        >
        <v-card-title>
            <h1 class="display-1 mb-5">{{ $t('form.login.title') }}</h1>
        </v-card-title>
        <v-card-text class="pb-0">
            <v-form v-if="isLoaded" @submit="sendLoginForm">
                <v-text-field
                    prepend-icon="fa-envelope"
                    v-model="loginForm.email"
                    :label="$t('base.field.email')"
                    type="email"
                    name="email"
                >
                </v-text-field>
                <v-text-field
                    prepend-icon="fa-lock"
                    name="password"
                    v-model="loginForm.password"
                    :label="$t('base.field.password')"
                    type="password"
                >
                </v-text-field>
                <small class="ma-0"
                    >{{ $t('form.login.text.forgotPassword') }}
                    <router-link to="/auth/sendResetPasswordToken"
                        >{{ $t('form.login.link.resetPassword') }}
                    </router-link>
                </small>
                <br />
                <div class="d-flex mt-3 justify-end">
                    <v-btn
                        :disabled="!isLoaded"
                        outlined
                        color="primary"
                        to="/auth/register"
                        >{{ $t('base.button.register') }}
                    </v-btn>
                    <v-btn :disabled="!isLoaded" color="primary" type="submit"
                        >{{ $t('base.button.login') }}
                    </v-btn>
                </div>
            </v-form>
            <loader v-else />
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: 'LoginView',
    data() {
        return {
            isLoaded: true,
            loginForm: {
                email: '',
                password: '',
            },
        }
    },
    methods: {
        sendLoginForm() {
            try {
                const validationArray = []

                validationArray[this.$t('base.field.email')] =
                    this.loginForm.email
                validationArray[this.$t('base.field.password')] =
                    this.loginForm.password

                const valid = new Validator(validationArray)

                valid.get(this.$t('base.field.email')).isEmail()
                valid.get(this.$t('base.field.password')).length(3, 255)
            } catch (e) {
                return
            }

            this.isLoaded = false
            axios
                .post('/auth/login', this.loginForm)
                .then((response) => {
                    notify.push(
                        this.$t('form.login.notify.success'),
                        notify.SUCCESS
                    )
                    auth.login(response.data, this.$route.query.redirect)
                })
                .finally(() => {
                    this.isLoaded = true
                })
        },
    },
}
</script>

<style scoped />
