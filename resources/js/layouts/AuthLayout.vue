<template>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-fade-transition mode="out-in">
                    <router-view></router-view>
                </v-fade-transition>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    name: "AuthLayout"
};
</script>

<style scoped></style>
