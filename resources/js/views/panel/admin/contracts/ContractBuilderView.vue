<template>
    <v-row>
        <v-col sm="12">
            <Header></Header>
        </v-col>
        <v-col sm="12">
            <v-divider class="mb-3"></v-divider>
        </v-col>
        <v-col sm="12">
            <BlockLayout></BlockLayout>
        </v-col>
    </v-row>
</template>

<script>
  import Header from "../../../../components/Contract/Builder/Header";
  import ContainerBlock from "../../../../components/Contract/Builder/Blocks/ContainerBlock";
  import BlockLayout from "../../../../components/Contract/Builder/BlockLayout";

  export default {
    name: "CreateAgreementView",
    components:{
      Header,
      BlockLayout,
      ContainerBlock
    }
  };
</script>
