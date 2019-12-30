<template>
  <v-card>
    <v-card-title>Block configuration:
    <small class="pl-3" style="color: #7a7a7a">{{block.blockName}}</small></v-card-title>
    <v-divider/>
    <v-tabs background-color="secondary" v-model="currentTab" dark grow>
      <v-tabs-slider color="primary" />

      <v-tab :key="0" href="#tab-0">Basic</v-tab>
      <v-tab :key="1" href="#tab-1">Logic</v-tab>

      <v-tab-item :key="0" value="tab-0">
        <v-col sm="12">
          <v-text-field v-model="block.blockName" label="Block name" outline/>
        </v-col>
      </v-tab-item>

      <v-tab-item :key="1" value="tab-1">
        <QueryBuilder
          :conditionals="block.conditionals"
          @conditional-change="onConditionalChange"
        />
      </v-tab-item>
    </v-tabs>
    <v-card-actions>
      <v-spacer/>
      <v-btn color="primary" outlined @click="pushCloseEvent">Cancel</v-btn>
      <v-btn color="primary" @click="saveBlockConfiguration">Save</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import QueryBuilder from '../../../common/QueryBuilder'

export default {
  name: 'SelectedBlockView',
  components: { QueryBuilder },
  data () {
    return {
      currentTab: null
    }
  },
  computed: {
    block () {
      return {
        ...this.$store.state.builder.builder.activeBlock
      }
    }
  },
  methods: {
    pushCloseEvent () {
      this.$emit('close')
    },
    saveBlockConfiguration () {
      this.pushCloseEvent()
      this.$store.dispatch('builder_changeActiveBlock', this.block)
    },
    onConditionalChange (newConditionalValue) {
      this.block.conditionals = newConditionalValue
    }
  }
}
</script>
