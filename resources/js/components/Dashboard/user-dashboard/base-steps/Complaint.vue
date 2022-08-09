<template>
  <v-row class="wantbigbuttons">
    <v-col cols="12" sm="12">
      <div class="text-center">
        <h1>Wybierz dostawcę spornej paczki</h1>
        <p>
          Znajdź w poniższych blokach firmę kurierską, z której usług
          korzystałeś i chcesz złożyć reklamację.
        </p>
      </div>
    </v-col>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/gls.png" alt="gls" />
      <p>
        General Logistics Systems<br />
        Poland sp. z o.o.<br />
        ul. Tęczowa 10, 62-052 Głuchowo
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('gls')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img
        class="action-card-img"
        src="/images/courier/inpost.png"
        alt="inpost"
      />
      <p>
        InPost sp. z o.o.<br />
        ul. Wielicka 28, 30-552 Kraków
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('inpost')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/dpd.png" alt="dpd" />
      <p>
        DPD Polska sp. z o.o.<br />
        ul. Mineralna 15, 02–274 Warszawa
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('dpd')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/geis.png" alt="geis" />
      <p>
        Geis Parcel Sp. z o.o.<br />
        Sosnowiec-Pieńki, 95–010 Stryków
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('geis')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/ups.png" alt="ups" />
      <p>
        UPS Polska sp. z o.o.<br />
        ul. Prądzyńskiego 1/3,<br />
        01-222 Warszawa
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('ups')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/dhl.png" alt="dhl" />
      <p>
        DHL Parcel Polska sp. z o.o.<br />
        ul. Osmańska 2, 02-823 Warszawa
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('dhl')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img
        class="action-card-img"
        src="/images/courier/fedex.png"
        alt="fedex"
      />
      <p>
        FedEx Express Polska Sp. z o.o.<br />
        ul. Krucza 16/22, 00-526 Warszawa
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('fedex')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <img class="action-card-img" src="/images/courier/tnt.png" alt="tnt" />
      <p>
        TNT Express Worldwide<br />
        (Poland) Sp. z o.o.<br />
        ul. Annopol 19, 03-236 Warszawa
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('tnt')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <v-divider class="fchr"></v-divider>
    <v-col cols="12" sm="12">
      <div class="text-center">
        <h2>Brokerzy - pośrednicy</h2>
        <p>
          Możliwe jest, że w poszukiwaniu lepszej ceny, skorzystaliście Państwo
          z jednego z wielu pośredników zwanymi brokerami.<br />Brokerzy
          pośredniczą jedynie przy zawarciu umowy z firmą kurierską, sami nie
          świadczą usług przewozowych. Możliwe, że składanie reklamacji jest
          wymagane za pośrednictwem brokera.
        </p>
        <p>
          Znajdź w poniższych blokach firmę brokerską, z której usług
          korzystałeś i chcesz złożyć reklamację.
        </p>
      </div>
    </v-col>
    <ActionCard height="280" :small="true">
      <h3 id="regfurgonetka">
        <a @click="() => showComplaint('furgonetka')">Furgonetka</a>
      </h3>
      <p>
        Furgonetka<br />
        sp. z o.o. sp. k.<br />
        ul. Inżynierska 8, 03-422 Warszawa
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('furgonetka')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <h3 id="regkujerzy">
        <a @click="() => showComplaint('kurjerzy')"
          ><span style="color: #000000">Kur</span>Jerzy<span
            style="color: #000000"
            >.pl</span
          ></a
        >
      </h3>
      <p>
        Richert KurJerzy sp. k.<br />
        ul. Prezydenta L. Kaczyńskiego 1/108, 80-374 Gdańsk
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('kurjerzy')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <h3 id="reginsendit">
        <a @click="() => showComplaint('sendit')"
          ><span style="color: #999999">SEND</span>IT</a
        >
      </h3>
      <p>
        Sendit Sp. z o. o.<br />
        ul. Wagonowa 2, 53-609 Wrocław
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('sendit')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <h3 id="regprzesylarka">
        <a @click="() => showComplaint('przesylarka')"
          >Przesyłarka<span style="color: #f6af19">.pl</span></a
        >
      </h3>
      <p>
        Efero Sp. z o.o. Sp.k.<br />
        ul. Grabiszyńska 151, 53-439 Wrocław
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('przesylarka')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <h3 id="regwysylajtaniej">
        <a @click="() => showComplaint('wysylajtaniej')"
          >Wysylaj<span style="color: #707070">Taniej</span>.pl</a
        >
      </h3>
      <p>
        wysyłajtaniej.pl Andrzej Sosnowski<br />
        ul. Suwalska 84/215, 19-300 Ełk
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('wysylajtaniej')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <h3 id="regepaka">
        <a @click="() => showComplaint('epaka')"
          ><span style="color: #000000">epaka.pl</span></a
        >
      </h3>
      <p>
        Epaka sp. z o.o. s.k.<br />
        Sochacz 16a, 21-400 Łuków
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('epaka')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <h3 id="regapaczka">
        <a @click="() => showComplaint('apaczka')"
          ><span style="color: #ee9935">a</span>paczka</a
        >
      </h3>
      <p>
        R2G Polska Sp. z o.o.<br />
        ul. F. Klimczaka 1, 02-797 Warszawa
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('apaczka')"
        >Wybierz</v-btn
      >
    </ActionCard>
    <ActionCard height="280" :small="true">
      <h3 id="regbrokerkurier">
        <a @click="() => showComplaint('brokerkurier')"
          >BrokerKurier<span style="color: #aa425c">.pl</span></a
        >
      </h3>
      <p>
        Efero Sp. z o.o. Sp.k.<br />
        ul. Grabiszyńska 151, 53-439 Wrocław
      </p>
      <v-btn
        class="my-3"
        color="primary"
        small
        @click="() => showComplaint('brokerkurier')"
        >Wybierz</v-btn
      >
    </ActionCard>
  </v-row>
</template>

<script>
import ActionCard from "../start-actions/ActionCard";

export default {
  name: "Complaint",
  components: {
    ActionCard,
  },
  methods: {
    showComplaint(name) {
      this.$emit("complaint", name);
    },
  },
};
</script>

<style scoped>
.action-card-img {
  margin-bottom: 15px;
}
</style>
