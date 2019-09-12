<template>
    <v-col sm="12">
        <v-text-field
            :label="attribute.name"
            :value="attribute.value"
            :placeholder="String(attribute.defaultValue)"
            :min="attribute.settings.min"
            :max="attribute.settings.max"
            outlined
            filled
            type="number"
            @change="changeValue"
        ></v-text-field>
    </v-col>
</template>

<script>
export default {
    name: "NumberAttribute",
    props: ["attribute"],
    methods: {
        changeValue(newValue) {
            this.$store.dispatch("formAttributes_changeAttributeValue", {
                id: this.attribute.id,
                value: parseInt(newValue)
            });
        }
    }
};
</script>

<style scoped></style>
