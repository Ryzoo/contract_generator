<template>
  <section>
    <v-row>
      <v-col cols="12" class="pa-5 mx-5">
        <h1 class="mb-5">Reklamacja - GLS</h1>
        <p>Na <b>nadawcy</b> przesyłki spoczywa kilka <b>obowiązków</b>, których spełnienie umożliwi <b>skuteczniejsze
          dochodzenie odszkodowania.</b></p>
        <ul>
          <li>Pierwszym z takich obowiązków jest obowiązek <b>zapoznania się z regulaminem</b> firmy transportowej.</li>
          <li>Drugim obowiązkiem nadawcy (odbiorcy) jest dokonanie szeregu czynności przed wysłaniem i w trakcie odbioru
            przesyłki.
          </li>
        </ul>
        <p class="mb-5">Pozwoli to na złożenie reklamacji w sposób, jaki przewiduje to regulamin firmy.</p>
        <v-row class="d-flex justify-center align-center">
          <v-col cols="12" md="6">
            <h2 class="mb-5">Gdzie znajdę regulamin i procedurę reklamacji?</h2>
            <v-row>
              <ActionCard height="220" :big="true">
                <img class="action-card-img mb-2" src="/images/courier/gls-logo.png" alt="gls">
                <h3 class="text-center">Regulamin świadczenia Usług</h3>
                <v-btn class="my-3" color="primary" small href="https://google.pl">Otwórz w nowym oknie</v-btn>
              </ActionCard>
              <ActionCard height="220" :big="true">
                <img class="action-card-img mb-2" src="/images/courier/gls-logo.png" alt="gls">
                <h3 class="text-center">GLS - Skargi</h3>
                <v-btn class="my-3" color="primary" small href="https://google.pl">Otwórz w nowym oknie</v-btn>
              </ActionCard>
            </v-row>
            <p>
              Zanim przystąpisz do złożenia reklamacji, <b>zapoznaj się z poniższymi punktami.</b><br/>
              Ułatwi Ci to poprawne złożenie reklamacji.
            </p>
          </v-col>
          <v-col cols="12" md="6">
            <img class="action-card-img" src="/images/courier/complaint.png" alt="complaint">
          </v-col>
        </v-row>
      </v-col>
      <div class="background-grey">
        <v-col cols="12" class="pa-5 mx-5">
          <v-expansion-panels>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>1. Kiedy mogę składać reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Procedurą reklamacyjną GLS objęte są <b>następujące przypadki</b>:</p>
                <ol>
                  <li>- utrata paczki,</li>
                  <li>- ubytek w zawartości paczki,</li>
                  <li>- uszkodzenie paczki powstałe w czasie od jej przyjęcia do przemieszczenia aż do dostarczenia (wydania),</li>
                  <li>- zwłoka w wykonaniu usługi.</li>
                </ol>
                <p>
                  Reklamację należy <b>złożyć w terminie</b>:<br/>
                  Trzydziestu (<b>30</b>) dni, a w razie utraty Paczki – w terminie czterdziestu pięciu (<b>45</b>) dni licząc od dnia przyjęcia Przesyłki przez GLS Poland do przemieszczania, jednak nie później niż w terminie 12 miesięcy od dnia nadania przesyłki.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>2. Ile mam czasu na złożenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content/>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>3. Co jest potrzebne do zgłoszenia reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content/>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>4. Jak oszacować realną stratę?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content/>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>5. W jaki sposób mogę złożyć reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content/>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>6. Ile trwa rozpatrzenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content/>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>7. Dlaczego moja reklamacja została uznana za niebyłą?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content/>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>8. Co jeśli moja reklamacja została odrzucona?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content/>
            </v-expansion-panel>
          </v-expansion-panels>
          <p><small>Ostatnia aktualizacja treści: 20.01.2020. Jeśli uważasz, że powyższa treść nie jest już aktualna <b>skontaktuj się z nami.</b></small></p>
        </v-col>
      </div>
    </v-row>
  </section>
</template>

<script>
import ActionCard from "../../start-actions/ActionCard";

export default {
  name: "ComplaintGls",
  components: {
    ActionCard
  }
}
</script>

<style scoped>
  .background-grey{
    padding: 25px;
    background: #F2F2F2;
    width: 100%;
  }
</style>