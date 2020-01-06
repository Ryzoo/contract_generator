<template>
    <section>
        <v-list-item v-show="values.length > 0"
            v-for="(element, index) in values" :key="index"
        >
            <v-list-item-content>
              <v-list-item-title v-text="element.map(x=>x.value).join(', ')"/>
              <v-list-item-subtitle v-text="$t('base.description.inTurn') + element.map(x=>x.attributeName).join(', ')"/>
            </v-list-item-content>

            <v-list-item-action>
                <v-btn icon @click="removeElement(element)">
                    <v-icon color="red lighten-1">fa-trash</v-icon>
                </v-btn>
            </v-list-item-action>
        </v-list-item>

        <p v-show="values.length === 0" class="text-sm-center">
          {{$t("base.description.noElements")}}
        </p>
    </section>
</template>

<script>
export default {
  name: 'ValueList',
  props: ['values'],
  methods: {
    removeElement (element) {
      this.$emit('remove', element)
    }
  }
}
</script>

<style scoped>

</style>
