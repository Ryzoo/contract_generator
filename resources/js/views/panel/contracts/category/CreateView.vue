<template>
  <v-flex xs12>
    <v-layout row wrap>
      <v-flex xs12 sm10 lg8 offset-sm1 offset-lg2>
        <v-card class="pb-3">
          <v-toolbar dark color="primary">
            <v-toolbar-title class="white--text">{{ $t("form.categoryAddForm.title") }}</v-toolbar-title>
          </v-toolbar>
          <v-card-text v-if="isLoaded">
            <v-form>
              <v-container>
                <v-row row wrap>
                  <v-col cols="12" md="7" class="pa-1">
                    <v-text-field
                      prepend-icon="fa-user-tag"
                      v-model="category.name"
                      :label="$t('base.field.name')"
                      required
                    />
                  </v-col>
                </v-row>
                <v-row align="end" justify="end">
                  <v-btn
                    color="primary"
                    text
                    @click="$router.push('/panel/contracts/category')"
                  >
                    {{ $t("base.button.back") }}
                  </v-btn>
                  <v-btn
                    color="success"
                    @click="addCategory()"
                  >
                    {{ $t("base.button.save") }}
                  </v-btn>
                </v-row>
              </v-container>
            </v-form>
          </v-card-text>
          <loader v-else/>
        </v-card>
      </v-flex>
    </v-layout>
  </v-flex>
</template>

<script>
export default {
  name: 'CreateView',
  data: function () {
    return {
      isLoaded: true,
      category: {
        name: null
      },
      permissionList: []
    }
  },
  methods: {
    addCategory () {
      try {
        const validationArray = []

        validationArray[this.$t('base.field.name')] = this.category.name

        const valid = new window.Validator(validationArray)

        valid.get(this.$t('base.field.name'))
          .length(3, 255)
      } catch (e) {
        return
      }

      this.isLoaded = false
      axios
        .post('/categories', this.category)
        .then(response => {
          notify.push(
            this.$t('form.categoryAddForm.notify.success'),
            notify.SUCCESS
          )
          this.$router.push('/panel/contracts/category')
        })
        .finally(() => {
          this.isLoaded = true
        })
    }
  }
}
</script>

<style scoped lang="scss"/>
