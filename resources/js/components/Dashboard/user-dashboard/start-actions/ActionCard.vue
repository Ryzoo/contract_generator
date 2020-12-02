<template>
  <v-col cols="12" sm="12" md="6" lg="3">
    <v-card :class="'action-card' + (inProgress ? ' action-in-progress' : '')">
      <div class="action-title">
        <span>{{ number }}</span>
        <span>
          {{title}}
        </span>
      </div>
      <div class="action-content">
        <slot/>
      </div>
    </v-card>
  </v-col>
</template>

<script>
export default {
  name: "ActionCard",
  props: ['number', 'inProgress', 'title']
}
</script>

<style scoped>
  .action-card{
    padding: 25px;
  }

  .action-title span:nth-child(1){
    font-weight: 700;
    font-size: 20px;
    width: 30px;
    display: inline-block;
    text-align: center;
    margin-right: 5px;
    border-radius: 50%;
    height: 30px;
    color: white;
    background: rgb(154,92,255);
    background: linear-gradient(190deg, rgba(154,92,255,1) 0%, rgba(64,89,191,1) 100%);
  }

  .action-title span:nth-child(2){
    color: #4C2E80;
    font-weight: 700;
    font-size: 20px;
  }

  .action-content{
    padding-top: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .action-in-progress {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .action-in-progress:after{
    content: "W przygotowaniu";
    position: absolute;
    left: 50%;
    top: 0;
    transform: translate(-50%, -50%);
    color: red;
    font-size: 22px;
    width: 100%;
    text-align: center;
    font-weight: 900;
  }
</style>