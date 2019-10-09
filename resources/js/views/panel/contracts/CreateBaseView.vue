<template>
    <v-flex xs12>
        <v-layout row wrap>
            <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
                <v-card class="pb-3">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title class="white--text">Dodawanie nowej umowy</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text v-if="isLoaded">
                        <v-form>
                            <v-container>
                                <v-row row wrap>
                                    <v-col sm="12" class="pa-1">
                                        <p>Proces ten składa się z kilku kroków. Najpierw podaj podstawowe dane, a następnie wybierz jakie mmoduły mają być w danej umowie.</p>
                                    </v-col>
                                    <v-col sm="12" class="pa-1">
                                        <v-text-field
                                            prepend-icon="fa-user-edit"
                                            v-model="contract.name"
                                            label="Nazwa umowy"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row align="end" justify="end">
                                    <v-btn
                                        color="primary"
                                        text
                                        @click="$router.push('/panel/accounts')"
                                    >
                                        {{
                                        $t(
                                        "form.accountEditForm.button.prev"
                                        )
                                        }}
                                    </v-btn>
                                    <v-btn
                                        color="success"
                                        @click="addAccount()"
                                    >
                                        {{
                                        $t(
                                        "form.accountEditForm.button.save"
                                        )
                                        }}
                                    </v-btn>
                                </v-row>
                            </v-container>
                        </v-form>
                    </v-card-text>
                    <loader v-else></loader>
                </v-card>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
  export default {
    name: "CreateBaseView"
  }
</script>

<style scoped>

</style>
