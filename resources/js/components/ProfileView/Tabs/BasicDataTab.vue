<template>
    <v-card flat>
        <v-card-text v-if="isLoaded">
            <v-form>
                <v-layout row wrap>
                    <v-flex xs12 md6 class="pa-1">
                        <v-text-field
                            v-model="user.firstName"
                            :label="$t('form.profileEditForm.field.firstName')"
                            required
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 class="pa-1">
                        <v-text-field
                            v-model="user.lastName"
                            :label="$t('form.profileEditForm.field.lastName')"
                            required
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <v-layout row wrap class="justify-end">
                            <v-btn color="success" @click="saveBasicData()">
                                {{ $t("form.profileEditForm.button.save") }}
                            </v-btn>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-form>
        </v-card-text>
        <loader v-else></loader>
    </v-card>
</template>

<script>
export default {
    name: "BasicDataTab",
    props: ["userData", "editable"],
    data() {
        return {
            isLoaded: true,
            user: this.userData
        };
    },
    methods: {
        saveBasicData() {
            try {
                let validationArray = [];

                validationArray[
                    this.$t("form.profileEditForm.field.firstName")
                ] = this.user.firstName;
                validationArray[
                    this.$t("form.profileEditForm.field.lastName")
                ] = this.user.lastName;

                let valid = new window.Validator(validationArray);

                valid
                    .get(this.$t("form.profileEditForm.field.firstName"))
                    .length(3, 50);
                valid
                    .get(this.$t("form.profileEditForm.field.lastName"))
                    .length(3, 50);
            } catch (e) {
                return;
            }

            this.isLoaded = false;
            axios
                .put(`/user/${this.user.id}/basicData`, this.user)
                .then(response => {
                    notify.push(
                        this.$t("form.profileEditForm.notify.success"),
                        notify.SUCCESS
                    );
                    auth.checkAuth();
                })
                .finally(() => {
                    this.isLoaded = true;
                });
        }
    }
};
</script>

<style scoped></style>
