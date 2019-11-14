<template>
    <v-col>
        <profile-view :user-data="user" :editable="true"></profile-view>
    </v-col>
</template>

<script>
import ProfileView from "../../../../components/ProfileView";

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
