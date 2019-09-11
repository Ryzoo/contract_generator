<template>
    <v-col sm="12" >
        <v-text-field
            :label="attribute.name"
            :value="attribute.value"
            :placeholder="String(attribute.defaultValue)"
            :error="validationError.length > 0"
            :error-messages="validationError"
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
    data(){
      return {
        settings: {
          min: this.attribute.settings.min,
          max: this.attribute.settings.max,
        },
        validationError: ""
      }
    },
    methods: {
      changeValue( newValue ){
        const isValidValue = this.isValid(newValue);

        if(isValidValue)
            this.$store.dispatch('formAttributes_changeAttributeValue', {
              id: this.attribute.id,
              value: parseInt(newValue)
            });
        else
          this.$store.dispatch('formAttributes_setValidError', {
            id: this.attribute.id
          });
      },
      isValid(newValue){
        this.validationError = "";

        if(!newValue) return true;

        const intValue = parseInt(newValue);

        if(this.settings.min && intValue < parseInt(this.settings.min)){
          this.validationError = this.$t('validation.min.numeric',{attribute: this.attribute.name, min:this.settings.min});
          return false;
        }

        if(this.settings.max && intValue > parseInt(this.settings.max)){
          this.validationError = this.$t('validation.max.numeric',{attribute: this.attribute.name, max:this.settings.max});
          return false;
        }

        return true;
      }
    }
  }
</script>

<style scoped>

</style>
