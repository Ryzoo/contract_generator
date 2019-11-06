<template>
    <v-card >
        <v-card-text>
            <template v-if="isLoaded">
                <v-avatar size="80%" class="mx-auto d-block mb-2">
                    <v-img :src="user.profileImage" alt="avatar"></v-img>
                </v-avatar>
                <input
                    type="file"
                    id="profileImageInput"
                    hidden
                    ref="profileImage"
                    @change="profileImageAreChanged"
                />
                <v-btn
                    v-if="editable"
                    @click="changeProfileImage"
                    class="mx-auto d-block"
                    color="primary"
                    >{{ $t("base.button.edit") }}</v-btn
                >
                <v-btn
                    v-if="canBeSaved"
                    class="mx-auto d-block"
                    color="success"
                    @click="saveImage"
                >
                    {{ $t("base.button.save") }}
                </v-btn>
                <v-divider class="my-3"></v-divider>
                <h2 class="text-center">
                    {{ user.firstName }} {{ user.lastName }}
                </h2>
            </template>
            <loader v-else></loader>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: "BaseDataShow",
    props: ["userData", "editable"],
    data() {
        return {
            isLoaded: true,
            user: this.userData,
            canBeSaved: false,
        };
    },
    methods: {
        saveImage() {
            let imageFile = this.$refs.profileImage;

            if (imageFile && imageFile.files && imageFile.files[0]) {
                let formData = new FormData();
                formData.append("image", imageFile.files[0]);

                this.isLoaded = false;
                axios
                    .post(`/user/${this.user.id}/profileImage`, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(() => {
                        notify.push(
                            this.$t("form.accountEditForm.notify.success_img"),
                            notify.SUCCESS
                        );
                        auth.checkAuth();
                        this.canBeSaved = false;
                    })
                    .finally(() => {
                        this.isLoaded = true;
                    });
            }
        },
        changeProfileImage() {
            $("#profileImageInput").click();
        },
        profileImageAreChanged() {
            let input = this.$refs.profileImage;

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = e => {
                    this.user.profileImage = e.target.result;
                    this.canBeSaved = true;
                    this.$forceUpdate();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    }
};
</script>

<style scoped></style>
