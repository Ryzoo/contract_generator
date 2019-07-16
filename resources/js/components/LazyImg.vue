<template>
    <v-img :src="src" aspect-ratio="1" class="grey lighten-2">
        <template v-slot:placeholder>
            <v-layout fill-height align-center justify-center ma-0>
                <v-progress-circular
                    indeterminate
                    color="grey lighten-5"
                ></v-progress-circular>
            </v-layout>
        </template>
    </v-img>
</template>

<script>
export default {
    name: "LazyImg",
    props: ["src"]
};
</script>

<style scoped></style>
