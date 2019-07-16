<template>
    <v-layout row wrap>
        <v-flex xs12 sm4 lg3 class="pa-1">
            <base-data-show
                :user-data="user"
                :editable="editable"
            ></base-data-show>
        </v-flex>
        <v-flex xs12 sm8 lg9 class="pa-1">
            <profile-data-tabs
                :user-data="user"
                :editable="editable"
            ></profile-data-tabs>
        </v-flex>
    </v-layout>
</template>

<script>
import BaseDataShow from "./ProfileView/BaseDataShow";
import ProfileDataTabs from "./ProfileView/ProfileDataTabs";

export default {
    name: "ProfileView",
    components: {
        "base-data-show": BaseDataShow,
        "profile-data-tabs": ProfileDataTabs
    },
    props: ["userData", "editable"],
    data() {
        return {
            user: this.userData
        };
    }
};
</script>

<style scoped></style>
