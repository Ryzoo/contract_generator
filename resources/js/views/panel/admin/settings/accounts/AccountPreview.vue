<template>
    <v-col v-if="isLoaded">
        <profile-view
            v-if="userData"
            :user-data="userData"
            :editable="false"
        ></profile-view>
        <v-alert v-else prominent type="error">
            <v-row align="center">
                <v-col class="grow">{{$t('pages.panel.accounts.descriptions.user_not_exist')}}</v-col>
                <v-col class="shrink">
                    <v-btn color="secondary" @click="$router.go(-1)"
                        >{{$t('base.button.back')}}</v-btn
                    >
                </v-col>
            </v-row>
        </v-alert>
    </v-col>
    <loader v-else></loader>
</template>

<script>
import ProfileView from "../../../../../components/ProfileView";

export default {
    name: "AccountPreview",
    components: {
        ProfileView
    },
    data() {
        return {
            isLoaded: true,
            userData: null
        };
    },
    methods: {
        getUserData() {
            const userID = this.$route.params.id;
            this.isLoaded = false;

            axios
                .get(`/user/${userID}`)
                .then(response => {
                    this.userData = response.data;
                })
                .finally(() => {
                    this.isLoaded = true;
                });
        }
    },
    mounted() {
        this.getUserData();
    }
};
</script>

<style></style>
