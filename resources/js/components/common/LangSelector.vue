<template>
  <v-menu offset-y
          style="width: 95px; flex: unset;">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
          color="secondary"
          dark
          small
          v-bind="attrs"
          v-on="on"
      >
        {{$t('navigation.lang')}}
      </v-btn>
    </template>
    <v-list>
      <v-list-item href="/lang/pl"><v-list-item-title>PL</v-list-item-title></v-list-item>
      <v-list-item href="/lang/en"><v-list-item-title>EN</v-list-item-title></v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  name: 'LangSelector'
}
</script>

<style scoped>

</style>
