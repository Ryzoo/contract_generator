<template>
    <v-col sm="12" >
        <v-text-field
            :label="attribute.name"
            :value="attribute.value"
            :placeholder="String(attribute.defaultValue ? attribute.defaultValue : '')"
            :error="validationError.length > 0"
            :error-messages="validationError"
            outlined
            filled
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
          lengthMin: this.attribute.settings.lengthMin,
          lengthMax: this.attribute.settings.lengthMax,
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
              value: newValue
            });
        else
          this.$store.dispatch('formAttributes_setValidError', {
            id: this.attribute.id
          });
      },
      isValid(newValue){
        this.validationError = "";

        if(!newValue) return true;

        if(this.settings.lengthMin && newValue.length < this.settings.lengthMin){
          this.validationError = this.$t('validation.min.string',{attribute: this.attribute.name, min:this.settings.lengthMin});
          return false;
        }

        if(this.settings.lengthMax && newValue.length > this.settings.lengthMax){
          this.validationError = this.$t('validation.max.string',{attribute: this.attribute.name, max:this.settings.lengthMax});
          return false;
        }

        return true;
      }
    }
  }
</script>

<style scoped>

</style>
