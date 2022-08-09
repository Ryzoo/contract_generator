<template>
    <v-col>
        <v-row>
            <v-col cols="12" md="4">
                <UserRegistrations />
            </v-col>
            <v-col cols="12" md="4">
                <FormSubmissions />
            </v-col>
            <v-col cols="12" md="4">
                <NewContracts />
            </v-col>
        </v-row>
    </v-col>
</template>

<script>
import UserRegistrations from './StatisticChart/UserRegistrations'
import FormSubmissions from './StatisticChart/FormSubmissions'
import NewContracts from './StatisticChart/NewContracts'

export default {
    name: 'AdminDashboard',
    components: {
        UserRegistrations,
        FormSubmissions,
        NewContracts,
    },
}
</script>

<style scoped></style>
