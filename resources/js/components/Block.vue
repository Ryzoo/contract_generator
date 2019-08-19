<template>
    <div class="block">
        <details>
            <summary>
                <font-awesome-icon icon="chevron-right" class="mx-3" />
                <h3>{{ name }}</h3>
            </summary>
            <p>Jakies teks</p>
        </details>
    </div>
</template>

<script>
export default {
    name: "Block",
    props: ["name"]
};
</script>

<style lang="scss" scoped>
@import "../../sass/colors";

details {
    padding: 10px 0;
    border: 1px solid $primary;
    border-radius: 5px;
    margin-bottom: 20px;
    transition: all 0.3s;
    &:hover {
        cursor: pointer;
    }
    &[open] {
        &:hover {
            border: 4px solid $primary;
            box-shadow: 0px 3px 6px 0px $primary;
        }
        summary {
            border-bottom: 1px solid $primary;
            padding-bottom: 10px;

            svg {
                transform: rotate(90deg);
            }
        }
        & > *:not(:first-child) {
            padding: 0 15px;
            margin-top: 16px;
        }
    }
    summary {
        display: flex;
        align-items: center;
        text-transform: capitalize;
        svg {
            transition: all 0.2s;
        }
        &:focus {
            outline: none;
        }
    }
}
</style>
