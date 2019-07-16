<template>
    <v-flex xs12>
        <profile-view :user-data="user" :editable="true"></profile-view>
    </v-flex>
</template>

<script>
import ProfileView from "../../components/ProfileView";

export default {
    name: "MyProfileView",
    components: {
        "profile-view": ProfileView
    },
    data() {
        return {
            user: Object.assign({}, this.$store.getters.authUser)
        };
    }
};
</script>

<style scoped></style>
