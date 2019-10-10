<template>
    <div class="loader-container">
        <v-progress-circular
            indeterminate
            :size="80"
            color="cyan"
        ></v-progress-circular>
        <vcl-code
            class="placeholder-loader"
            primary="#6b8a9c"
            secondary="#a9c9dc"
        ></vcl-code>
    </div>
</template>

<script>
import VclCode from "vue-content-loading";

export default {
    name: "Loader",
    components: {
        VclCode
    }
};
</script>

<style lang="scss">
.loader-container {
    width: 100%;
    display: flex;
    position: relative;
    justify-content: center;
    min-height: 200px;
    align-items: center;

    .v-progress-circular {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .placeholder-loader {
        padding: 25px;
        width: 100%;
        height: 100%;
    }
}
</style>
