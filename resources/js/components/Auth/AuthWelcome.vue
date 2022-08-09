<template>
    <v-row class="align-center">
        <v-container class="white--text">
            <v-row>
                <h1 class="display-3 mx-auto">
                    {{ $t('pages.auth.welcome') }}
                </h1>
            </v-row>
            <v-row>
                <h3 class="mx-auto">{{ $t('pages.auth.sigin') }}</h3>
            </v-row>
            <v-row class="mt-5 mb-2">
                <h6 class="mx-auto">app.odszkodowaniezapaczke.pl</h6>
            </v-row>
        </v-container>
    </v-row>
</template>

<script>
import Logo from '../../assets/logo.png'
export default {
    data() {
        return {
            logo: Logo,
        }
    },
}
</script>

<style lang="scss">
.auth-welcome {
    height: 100%;
}
</style>
