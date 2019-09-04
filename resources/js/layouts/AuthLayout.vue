<template>
    <v-container
        class="fill-height"
        fluid
    >
        <v-row
            align="center"
            justify="center"
        >
            <v-col
                cols="12"
                sm="8"
                md="4"
            >
                <v-fade-transition mode="out-in">
                    <router-view></router-view>
                </v-fade-transition>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "AuthLayout"
};
</script>

<style scoped></style>
