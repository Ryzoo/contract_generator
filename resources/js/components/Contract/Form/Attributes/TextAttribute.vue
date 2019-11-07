<template>
    <v-col sm="12">
        <v-text-field
            :label="attribute.name"
            :value="attribute.value"
            :placeholder="String(attribute.placeholder)"
            :error="validationError.length > 0"
            :error-messages="validationError"
            outlined
            filled
            append-outer-icon="fa-question-circle"
            @change="changeValue"
        >
            <template v-slot:append-outer v-if="attribute.additionalInformation">
                <v-tooltip right>
                    <template v-slot:activator="{ on }">
                        <v-icon dark v-on="on">fa-question-circle</v-icon>
                    </template>
                    <span>{{attribute.additionalInformation}}</span>
                </v-tooltip>
            </template>
        </v-text-field>
    </v-col>
</template>

<script>
export default {
    name: "NumberAttribute",
    props: ["attribute", "validationError"],
    methods: {
        changeValue(newValue) {
            this.$emit("change-value", newValue)
        }
    }
};
</script>

<style scoped></style>
