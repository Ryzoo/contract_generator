<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
                <v-card class="pb-3">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title class="white--text">{{
                            $t('form.roleEditForm.title')
                        }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text v-if="isLoaded">
                        <v-form>
                            <v-container>
                                <v-row row wrap>
                                    <v-col cols="12" md="10" class="pa-1">
                                        <v-text-field
                                            prepend-icon="fa-user-tag"
                                            v-model="role.name"
                                            :label="$t('base.field.name')"
                                            required
                                            @change="onNameChange"
                                        />
                                    </v-col>
                                    <v-col sm="6" md="2" class="pa-1">
                                        <v-text-field
                                            v-model="role.level"
                                            :label="$t('base.field.level')"
                                            type="number"
                                            min="1"
                                            max="10"
                                        >
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" class="pa-1">
                                        <v-select
                                            prepend-icon="fa-lock"
                                            v-model="role.permission"
                                            :items="permissionList"
                                            chips
                                            :label="$t('base.field.permission')"
                                            multiple
                                        />
                                    </v-col>
                                    <v-col cols="12" class="pa-1">
                                        <v-textarea
                                            outlined
                                            v-model="role.description"
                                            :label="
                                                $t('base.field.description')
                                            "
                                            required
                                        />
                                    </v-col>
                                </v-row>
                                <v-row align="end" justify="end">
                                    <v-btn
                                        color="primary"
                                        text
                                        @click="
                                            $router.push(
                                                '/panel/settings/roles'
                                            )
                                        "
                                    >
                                        {{ $t('base.button.back') }}
                                    </v-btn>
                                    <v-btn color="success" @click="addRole()">
                                        {{ $t('base.button.update') }}
                                    </v-btn>
                                </v-row>
                            </v-container>
                        </v-form>
                    </v-card-text>
                    <loader v-else />
                </v-card>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
export default {
    name: 'EditView',
    data: function () {
        return {
            currentRoleId: this.$route.params.id,
            isLoaded: true,
            role: {
                name: null,
                description: null,
                level: 1,
                permission: null,
            },
            permissionList: [],
        }
    },
    methods: {
        onNameChange(newValue) {
            this.role.slug = newValue.toLowerCase().split(' ').join('_').trim()
        },
        addRole() {
            try {
                const validationArray = []

                validationArray[this.$t('base.field.name')] = this.role.name
                validationArray[this.$t('base.field.description')] =
                    this.role.description
                validationArray[this.$t('base.field.level')] = this.role.level

                const valid = new window.Validator(validationArray)

                valid.get(this.$t('base.field.name')).length(3, 255)

                valid.get(this.$t('base.field.description')).length(3, 255)

                valid.get(this.$t('base.field.level')).isBetween(0, 10)
            } catch (e) {
                return
            }

            this.isLoaded = false
            axios
                .put(`/role/${this.currentRoleId}`, this.role)
                .then((response) => {
                    notify.push(
                        this.$t('form.roleEditForm.notify.success'),
                        notify.SUCCESS
                    )
                    this.$router.push('/panel/settings/roles')
                })
                .finally(() => {
                    this.isLoaded = true
                })
        },
    },
    mounted() {
        this.isLoaded = false
        axios
            .get('/role/permission')
            .then((response) => {
                this.permissionList = response.data.map((x) => ({
                    text: x.name,
                    value: x.id,
                }))
            })
            .finally(() => {
                this.isLoaded = true
            })

        axios
            .get(`/role/${this.currentRoleId}`)
            .then((response) => {
                this.role = {
                    name: response.data.name,
                    description: response.data.description,
                    level: response.data.level,
                    permission: response.data.permissions.map((x) => x.id),
                }
            })
            .finally(() => {
                this.isLoaded = true
            })
    },
}
</script>

<style scoped lang="scss" />
