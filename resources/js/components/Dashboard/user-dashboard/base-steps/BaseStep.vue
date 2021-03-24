<template>
  <v-row>
    <v-col cols="12" sm="12">
      <div class="text-center">
        <h1>W czym możemy Ci pomóc?</h1>
        <p>Zakres naszej pomocy obejmuje kolejno:</p>
      </div>
    </v-col>
    <ActionCard class="wantbigbuttons" height="385" title="Reklamacja" number="1" :in-progress="false">
      <p>Twoim pierwszym krokiem powinno być samodzielne <strong>złożenie reklamacji</strong>.<br/><br/>
        Uzyskasz tu wszystkie informację potrzebne w prawidłowym przeprowadzeniu tego procesu.<br/><br/>
        Przejdź dalej aby rozpocząć proces reklamacji na stronach poszczegolnych dostawców paczek.
      </p>
      <v-btn class="my-3" color="primary" small @click="()=>showPage('complaint')">Rozpocznij reklamację</v-btn>
      <p>Jeżeli juz złożyłes reklamację albo Twoja sprawa jest skomplikowana możesz od razu przejść do <b>kroku 2</b> i
        zlecić nam analizę szans uzyskania odszkodowania.</p>
    </ActionCard>
    <ActionCard height="385" title="Zleć analizę online" number="2" :in-progress="true">
      <p>Jeżeli złożyłeś reklamację za zniszczoną, zgubioną lub niedostarczoną paczkę, a <strong>dostawca jej nie
        uznał</strong>,
        możesz zlecić nam odpłatną analizę szans uzyskania odszkodowania.
      </p>
      <v-btn class="my-5" color="primary" small>Zleć analizę online</v-btn>
    </ActionCard>
    <ActionCard height="385" title="Wezwanie do zapłaty" number="3" :in-progress="true">
      <p>
        Możesz zlecić nam wysłanie w Twoim imieniu <strong>przedsądowego wezwania do zapłaty</strong>.
        Wezwanie to można poprzedzić analizą online przeprowadzaną przez prawników z wieloletnim doświadczeniem w tej
        tematyce.
      </p>
    </ActionCard>
    <ActionCard height="385" title="Pozew do Sądu" number="4" :in-progress="true">
      <p>
        Możesz zlecić nam odpłatną analizę szans uzyskania odszkodowania.
      </p>
    </ActionCard>
  </v-row>
</template>

<script>
import ActionCard from "../start-actions/ActionCard";

export default {
  name: "BaseStep.vue",
  components: {
    ActionCard
  },
  methods: {
    showPage(step){
      this.$emit('step', step)
    }
  }
}
</script>

<style scoped>

</style>