<template>
    <v-card>
        <v-tabs v-model="tabModel" background-color="primary" grow show-arrows>
            <v-tabs-slider></v-tabs-slider>
            <v-tab
                v-for="(tab, index) in tabsItem"
                v-if="!tab.editOnly || editable"
                :key="index"
                :href="`#tab-${index}`"
            >
                <v-icon class="pr-2">{{ tab.icon }}</v-icon>
                {{ tab.name }}
            </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tabModel">
            <v-tab-item
                v-if="!tab.editOnly || editable"
                v-for="(tab, index) in tabsItem"
                :key="index"
                :value="'tab-' + index"
            >
                <component
                    :user-data="user"
                    :editable="editable"
                    :is="tab.component"
                ></component>
            </v-tab-item>
        </v-tabs-items>
    </v-card>
</template>

<script>
import BasicDataTab from "./Tabs/BasicDataTab";

export default {
    name: "ProfileDataTabs",
    components: {
        BasicDataTab
    },
    props: ["userData", "editable"],
    data() {
        return {
            user: this.userData,
            tabModel: null,
            tabsItem: [
                {
                    name: this.$t(
                        "pageMeta.panel.profile.tabs.basic_data.name"
                    ),
                    icon: "fa-id-card",
                    editOnly: true,
                    component: "BasicDataTab"
                }
            ]
        };
    }
};
</script>

<style scoped></style>
