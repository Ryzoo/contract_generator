<template>
    <section>
        <v-list-item
            v-show="value.length > 0"
            v-for="(element, index) in value" :key="index"
        >
            <v-list-item-content v-if="!Array.isArray(element)">
              <v-list-item-title v-text="element"/>
            </v-list-item-content>
            <v-list-item-content v-else>
                <v-list-item-title v-text="element.map(x => x.value).join(', ')"/>
            </v-list-item-content>
            <v-list-item-action>
                <v-btn icon @click="removeElement(index)">
                    <v-icon color="red lighten-1">fa-trash</v-icon>
                </v-btn>
            </v-list-item-action>
        </v-list-item>

        <v-alert
          dense
          text
          v-show="value.length === 0"
          class="mt-5 mb-0"
          type="info"
        >
          {{$t("base.description.noElements")}}
        </v-alert>
    </section>
</template>

<script>
export default {
  name: 'ValueList',
  props: ['attribute'],
  data () {
    return {
      value: this.attribute.value || []
    }
  },
  methods: {
    removeElement (index) {
      this.$store.dispatch('formElements_remove_attribute_row', {
        id: this.attribute.id,
        index
      })
    }
  }
}
</script>

<style scoped>

</style>
