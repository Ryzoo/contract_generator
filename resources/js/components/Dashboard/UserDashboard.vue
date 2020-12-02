<template>
  <v-row>
    <ActionCard title="Reklamacja" number="1" :in-progress="false">
      <p>Twoim pierwszym krokiem powinno być samodzielne <strong>złożenie reklamacji</strong>.<br/><br/>
        Uzyskasz tu wszystkie informację potrzebne w prawidłowym przeprowadzeniu tego procesu.<br/><br/>
        Przejdź dalej aby rozpocząć proces reklamacji na stronach poszczegolnych dostawców paczek.
      </p>
      <v-btn class="my-5" color="primary" small>Rozpocznij reklamację</v-btn>
      <p>Jeżeli juz złożyłes reklamację albo Twoja sprawa jest skomplikowana możesz od razu przejść do <b>kroku 2</b> i zlecić nam analizę szans uzyskania odszkodowania.</p>
    </ActionCard>
    <ActionCard title="Zleć analizę online" number="2" :in-progress="true">
      <p>Jeżeli złożyłeś reklamację za zniszczoną, zgubioną lub niedostarczoną paczkę, a <strong>dostawca jej nie uznał</strong>,
        możesz zlecić nam odpłatną analizę szans uzyskania odszkodowania.
      </p>
      <v-btn class="my-5" color="primary" small>Zleć analizę online</v-btn>
    </ActionCard>
    <ActionCard title="Wezawanie do zapłaty" number="3" :in-progress="true">
      <p>
        Możesz zlecić nam wysłanie w Twoim imieniu <strong>przedsądowego wezwania do zapłaty</strong>.
        Wezwanie to można poprzedzić analizą online przeprowadzaną przez prawników z wieloletnim doświadczeniem w tej tematyce.
      </p>
    </ActionCard>
    <ActionCard title="Pozew do Sądu" number="4" :in-progress="true">
      <p>
        Możesz zlecić nam odpłatną analizę szans uzyskania odszkodowania.
      </p>
    </ActionCard>
  </v-row>
</template>

<script>
import ActionCard from "./user-dashboard/start-actions/ActionCard";

export default {
  name: 'UserDashboard',
  components: {
    ActionCard
  }
}
</script>

<style scoped>

</style>
