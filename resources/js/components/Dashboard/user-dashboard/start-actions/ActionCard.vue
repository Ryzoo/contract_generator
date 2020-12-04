<template>
  <v-col :cols="small ? 6 : 12" :sm="small ? 6 : 12" :md="small ? 3 : 6" :lg="big ? 6 : 3">
    <v-card :style="`min-height: ${height || 100}px`" :class="'action-card' + (inProgress ? ' action-in-progress' : '')">
      <div v-show="title" class="action-title">
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
  props: ['number', 'inProgress', 'title', 'small', 'big', 'height']
}
</script>

<style scoped>
  .action-card{
    padding: 15px;
    border: 2px solid #d4d4d4;
    margin: 5px;
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
    bottom: -12px;
    transform: translate(-50%, -50%);
    color: red;
    font-size: 22px;
    width: 100%;
    text-align: center;
    font-weight: 900;
  }
</style>