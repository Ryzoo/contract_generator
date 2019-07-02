<template>
    <section>
        <v-layout>
            <v-flex xs8>
                <div class="builder-content">
                    <div v-if="elements.length > 0"></div>
                    <div v-else>
                        <div class="empty-elements"></div>
                    </div>
                </div>
            </v-flex>
            <v-flex xs4></v-flex>
        </v-layout>
    </section>
</template>

<script>
export default {
    name: "CreateAgreementView",
    data: function() {
        return {
            elements: [
                // {
                //     name: "bloczek",
                //     type: "block"
                // },
                // {
                //     name: "bloczek2",
                //     type: "block"
                // }
            ]
        };
    },
    mounted() {}
};
</script>

<style scoped></style>
