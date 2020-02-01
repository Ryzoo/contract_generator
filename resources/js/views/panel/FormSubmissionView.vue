<template>
  <v-row>
    <v-col v-if="isLoaded">
      <v-row>
        <v-col xs="12">
          <v-data-table
            class="elevation-2"
            :headers="headers"
            :items="items"
          >
            <template v-slot:item.status="{ item }">
              <v-chip
                class="ma-1"
                :color="getColorFromStatus(item.status)"
                small label
              >
                {{$t('enums.contractStatus.'+item.status)}}
              </v-chip>
            </template>
            <template v-slot:item.action="{ item }">
              <v-btn color="success" v-if="item.status == 3 || item.status == 2" type="application/octet-stream" :href="item.render_url" download>{{$t('base.button.render')}}</v-btn>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-col>
    <loader v-else/>
  </v-row>
</template>

<script>
export default {
  name: 'AccountsView',
  components: {},
  data () {
    return {
      isLoaded: true,
      headers: [
        {
          text: this.$t('base.headers.name'),
          value: 'name'
        },
        {
          text: this.$t('base.headers.status'),
          value: 'status'
        },
        {
          text: this.$t('base.headers.updated'),
          value: 'updated_at'
        },
        {
          text: this.$t('base.headers.actions'),
          value: 'action',
          sortable: false
        }
      ],
      items: []
    }
  },
  methods: {
    getColorFromStatus (status) {
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
      }
    },
    getSubmissionList () {
      this.isLoaded = false
      axios
        .get('/contract/submissions')
        .then(response => {
          this.items = response.data
        })
        .finally(() => {
          this.isLoaded = true
        })
    }
  },
  mounted () {
    this.getSubmissionList()
  }
}
</script>
