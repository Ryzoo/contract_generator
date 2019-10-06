<template>
    <div class="block" :blockid="id">
        <details @click="setActive($event)">
            <summary>
                <v-icon class="mx-3">fa-chevron-right</v-icon>
                <h3 class="pr-2">{{ blockName | truncate}}</h3>
            </summary>
            <div class="hr-line">
                <hr class="line">
                <v-btn @click="$emit('openDialog')" class="mx-3" text icon>
                    <v-icon>fa-plus-circle</v-icon>
                </v-btn>
            </div>
            <slot></slot>
        </details>
        <div class="hr-line">
            <hr class="line">
            <v-btn @click="$emit('openDialog')" class="mx-3" text icon>
                <v-icon>fa-plus-circle</v-icon>
            </v-btn>
        </div>
    </div>
</template>

<script>
  export default {
    name: "EmptyBlock",
    props: {
      id: { required: true },
      content: { required: true },
      blockName: { required: true },
      conditionals: { required: true },
      settings: { required: true }
    },
    methods: {
      setActive(e){
        if(!e.target.closest("details").classList.contains("active")) {
          $('details.active').removeClass("active");
          e.target.closest("details").classList.add("active");
          this.$emit("getAttributes");
        }
      }
    }
  }
</script>

<style scoped>

</style>