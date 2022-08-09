<template>
    <section>
        <v-list-item
            v-show="value.length > 0"
            v-for="(element, index) in value"
            :key="index"
        >
            <v-list-item-content v-if="!Array.isArray(element)">
                <v-list-item-title v-text="element" />
            </v-list-item-content>
            <v-list-item-content v-else>
                <v-list-item-title
                    v-text="element.map((x) => x.value).join(', ')"
                />
            </v-list-item-content>
            <v-list-item-action>
                <v-btn icon @click="removeElement(index)">
                    <v-icon color="red lighten-1">fa-trash</v-icon>
                </v-btn>
            </v-list-item-action>
        </v-list-item>
    </section>
</template>

<script>
export default {
    name: 'ValueList',
    props: ['attribute'],
    data() {
        return {
            value: (this.attribute.value || []).slice(1).reverse(),
        }
    },
    watch: {
        attribute(newValue) {
            this.value = (newValue.value || []).slice(1).reverse()
        },
    },
    methods: {
        removeElement(index) {
            this.$store.dispatch('formElements_remove_attribute_row', {
                id: this.attribute.id,
                index: this.value.length - 1 - index,
            })
        },
    },
}
</script>

<style scoped></style>
