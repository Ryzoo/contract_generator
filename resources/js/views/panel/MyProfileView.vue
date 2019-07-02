<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm4>
                <v-card>
                    <v-avatar
                        size="80%"
                        class="mx-auto d-block"
                    >
                        <lazy-img src="https://randomuser.me/api/portraits/men/80.jpg" alt="avatar"></lazy-img>
                    </v-avatar>
                    <v-divider class="my-3"></v-divider>
                    <h1 class="text-xs-center"> adam malysz </h1>
                </v-card>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
  export default {
    name: "MyProfileView"
  }
</script>

<style scoped>

</style>