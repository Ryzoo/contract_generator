<template>
    <v-row>
        <v-col v-if="isLoaded">
            <v-row>
                <v-col cols="12">
                    <v-data-table
                        class="elevation-2"
                        :headers="headers"
                        :items="items"
                    >
                        <template v-slot:item.id="{ item }">
                            <a :href="`/api/debug/render/${item.id}`">{{
                                item.id
                            }}</a>
                        </template>
                        <template v-slot:item.status="{ item }">
                            <v-chip
                                class="ma-1"
                                :color="getColorFromStatus(item.status)"
                                small
                                label
                            >
                                {{ $t('enums.contractStatus.' + item.status) }}
                            </v-chip>
                        </template>
                        <template v-slot:item.action="{ item }">
                            <div class="table-icons">
                                <v-btn
                                    color="primary"
                                    small
                                    v-if="
                                        (item.status === 3 ||
                                            item.status === 2) &&
                                        item.render_url
                                    "
                                    type="application/octet-stream"
                                    :href="item.render_url"
                                    download
                                >
                                    <v-icon small>fas fa-download</v-icon>
                                    {{ $t('base.button.download') }}
                                </v-btn>
                                <v-btn
                                    color="error"
                                    small
                                    v-if="item.status === 4"
                                    @click="tryOneMoreTime(item.id)"
                                >
                                    <v-icon small>fas fa-retweet</v-icon>
                                    {{ $t('base.button.try_again') }}
                                </v-btn>
                                <span
                                    v-if="
                                        item.status === 5 &&
                                        item &&
                                        item.action_details
                                    "
                                >
                                    <v-btn
                                        color="primary"
                                        small
                                        v-if="
                                            item.action_details
                                                .payment_is_pending === true
                                        "
                                        @click="
                                            goToPayment(
                                                item.action_details.payment_url
                                            )
                                        "
                                    >
                                        <v-icon small
                                            >fas fa-dollar-sign</v-icon
                                        >
                                        {{ $t('base.button.pay') }}
                                    </v-btn>
                                    <v-btn
                                        color="primary"
                                        small
                                        v-if="
                                            item.action_details
                                                .payment_is_pending === false
                                        "
                                        disabled
                                    >
                                        <v-icon small
                                            >fas fa-spinner fa-spin</v-icon
                                        >
                                        {{ $t('base.button.pay_waiting') }}
                                    </v-btn>
                                </span>
                            </div>
                        </template>
                    </v-data-table>
                </v-col>
            </v-row>
        </v-col>
        <loader v-else />
    </v-row>
</template>

<script>
export default {
    name: 'AccountsView',
    components: {},
    data() {
        return {
            isLoaded: true,
            headers: [
                {
                    text: 'ID',
                    value: 'id',
                },
                {
                    text: this.$t('base.headers.name'),
                    value: 'name',
                },
                {
                    text: this.$t('base.headers.status'),
                    value: 'status',
                },
                {
                    text: this.$t('base.headers.updated'),
                    value: 'updated_at',
                },
                {
                    text: this.$t('base.headers.actions'),
                    value: 'action',
                    sortable: false,
                    width: '100px',
                },
            ],
            items: [],
        }
    },
    methods: {
        goToPayment(url) {
            window.open(url, '_blank')
        },
        tryOneMoreTime(id) {
            this.isLoaded = false
            axios
                .post(`/contract/${id}/retry`)
                .then((response) => {
                    this.getSubmissionList()
                })
                .finally(() => {
                    this.isLoaded = true
                })
        },
        getColorFromStatus(status) {
            switch (parseInt(status)) {
                case 0:
                    return 'primary'
                case 1:
                    return 'warning'
                case 2:
                    return 'success'
                case 3:
                    return 'success'
                case 4:
                    return 'error'
                case 5:
                    return 'warning'
            }
        },
        getSubmissionList() {
            this.isLoaded = false
            axios
                .get('/contract/submissions')
                .then((response) => {
                    this.items = response.data
                })
                .finally(() => {
                    this.isLoaded = true
                })
        },
    },
    mounted() {
        this.getSubmissionList()

        this.getInterval = setInterval(() => {
            this.getSubmissionList()
        }, 10000)
    },
    destroyed() {
        if (this.getInterval) {
            clearInterval(this.getInterval)
        }
    },
}
</script>
