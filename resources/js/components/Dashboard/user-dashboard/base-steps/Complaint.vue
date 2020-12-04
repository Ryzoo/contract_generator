<template>
  <v-row>
    <v-col cols="12" sm="12">
      <div class="text-center">
        <h1>Wybierz dostawcę spornej paczki</h1>
        <p>Znajdź w poniższych blokach firmę, z której usług korzystałeś i chcesz złożyć reklamację  </p>
      </div>
    </v-col>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/gls.png" alt="gls">
      <p>General Logistics Systems<br/>
        Poland sp. z o.o.<br/>
        ul. Tęczowa 10, 62-052 Głuchowo
      </p>
      <v-btn class="my-3" color="primary" small @click="() => showComplaint('gls')">Wybierz</v-btn>
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/inpost.png" alt="inpost">
      <p>InPost sp. z o.o.<br/>
        ul. Wielicka 28, 30-552 Kraków
      </p>
      <v-btn class="my-3" color="primary" small @click="() => showComplaint('inpost')">Wybierz</v-btn>
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/dpd.png" alt="gls">
      <p>DPD Polska sp. z o.o.<br/>
        ul. Mineralna 15, 02–274 Warszawa
      </p>
      <v-btn class="my-3" color="primary" small @click="() => showComplaint('dpd')">Wybierz</v-btn>
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/geis.png" alt="geis">
      <p>Geis Parcel Sp. z o.o.<br/>
        Sosnowiec-Pieńki, 95–010 Stryków
      </p>
      <v-btn class="my-3" color="primary" small @click="() => showComplaint('geis')">Wybierz</v-btn>
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/ups.png" alt="ups">
      <p>UPS Polska sp. z o.o.<br/>
        ul. Prądzyńskiego 1/3,<br/>
        01-222 Warszawa
      </p>
      <v-btn class="my-3" color="primary" small @click="() => showComplaint('ups')">Wybierz</v-btn>
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/dhl.png" alt="dhl">
      <p>DHL Parcel Polska sp. z o.o.<br/>
        ul. Osmańska 2, 02-823 Warszawa
      </p>
      <v-btn class="my-3" color="primary" small @click="() => showComplaint('dhl')">Wybierz</v-btn>
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/fedex.png" alt="fedex">
      <p>FedEx Express Polska Sp. z o.o.<br/>
        ul. Krucza 16/22, 00-526 Warszawa
      </p>
      <v-btn class="my-3" color="primary" small @click="() => showComplaint('fedex')">Wybierz</v-btn>
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/tnt.png" alt="tnt">
      <p>TNT Express Worldwide<br/>
        (Poland) Sp. z o.o.<br/>
        ul. Annopol 19, 03-236 Warszawa
      </p>
      <v-btn class="my-3" color="primary" small @click="() => showComplaint('tnt')">Wybierz</v-btn>
    </ActionCard>
  </v-row>
</template>

<script>
import ActionCard from "../start-actions/ActionCard";

export default {
  name: "Complaint.vue",
  components: {
    ActionCard
  },
  methods: {
    showComplaint(name){
      this.$emit('complaint', name)
    }
  }
}
</script>

<style scoped>
  .action-card-img{
    margin-bottom: 15px;
  }
</style>