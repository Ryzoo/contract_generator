<template>
    <section>
        <div class="options-section-1">
            <span class="sub-title">Użyj bloku</span>
            <div class="builder-elements">
                <div class="options" v-for="element in elementsType">
                    <span>{{element.name}}</span>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
  export default {
    name: "BlocksView",
    data(){
      return {
        elementsType: [
          {
            type: "text",
            name: "Tekst"
          },
          {
            type: "variable",
            name: "Zmienna"
          }
        ]
      }
    }
  }
</script>

<style scoped>

</style>
