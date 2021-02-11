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
                <v-btn class="my-3" color="primary" small href="https://gls-group.eu/PL/pl/regulamin">Otwórz w nowym oknie</v-btn>
              </ActionCard>
              <ActionCard height="220" :big="true">
                <img class="action-card-img mb-2" src="/images/courier/gls-logo.png" alt="gls">
                <h3 class="text-center">GLS - Generator Reklamacji</h3>
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
              <v-expansion-panel-content>
                <p>Roszczenia z tytułu <strong>niewidocznych w chwili wydania ubytków lub uszkodzeń paczki</strong>, są aktualne tylko w przypadku ich zgłoszenia GLS Poland przez odbiorcę (lub nadawcę w przypadku zwrotu paczki). Powinny być <strong>złożone na piśmie</strong>, nie później niż w ciągu <strong>siedmiu (7) dni</strong> od dnia przyjęcia paczki, pod warunkiem jednak, że klient udowodni, że do szkody doszło w czasie od przyjęcia paczki przez GLS do chwili jej wydania odbiorcy. W takim przypadku sporządza się protokół szkodowy, który jest potrzebny do zgłoszenia reklamacji.</p>
                <p><strong>Reklamacje z tytułu niewykonania lub nienależytego wykonania umowy</strong> może składać wyłącznie klient (lub osoba upoważniona przez klienta jw. ), w terminie <strong>trzydziestu (30) dni</strong>>, a w razie <strong>utraty paczki – w terminie czterdziestu pięciu (45) dni</strong> licząc od dnia przyjęcia przesyłki przez GLS Poland do przemieszczania, jednak nie później niż w terminie 12 miesięcy od dnia nadania przesyłki.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>3. Co jest potrzebne do zgłoszenia reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Reklamacja powinna zawierać:</p>
                  <ol type="a">
                    <li>oznaczenie firmy, siedziby i adresu reklamującego oraz numer rachunku bankowego, na który należy przesłać ewentualne odszkodowanie,</li>
                    <li>kwotę roszczenia wraz z uzasadnieniem,</li>
                    <li>odpowiednie dokumenty uzasadniające wysokość roszczenia (oryginał faktury VAT zakupu lub kopia potwierdzona za zgodność z oryginałem, kalkulacja kosztów wytworzenia, inne dokumenty potwierdzające wysokość roszczenia),</li>
                    <li>kopię potwierdzenia nadania,</li>
                    <li>kopię protokołu o stanie przesyłki/kopię protokołu szkody. GLS Poland może zażądać od reklamującego dodatkowych dokumentów koniecznych do rozpatrzenia reklamacji, w szczególności dokumentacji zdjęciowej.</li>
                  </ol>
                  <p>W przypadku, gdy wyżej wymienione dokumenty okażą się niewystarczające do rozpoznania reklamacji ze względu na ich jakość lub treść, GLS Poland może zażądać od reklamującego dodatkowych dokumentów związanych z rodzajem i wysokością roszczenia. Jeżeli reklamację wniosła osoba nieuprawniona, albo reklamacja nie odpowiada warunkom określonym powyżej, GLS Poland wezwie reklamującego do jej uzupełnienia. Terminy w czasie którego reklamacja ma być rozpatrzona przez GLS tj. 30 dni ulega zawieszeniu do czasu uzupełnienia reklamacji przez reklamującego.</p>
                  <p>Dodatkowo:</p>
                  <ul>
                    <li>jeśli posiadasz dokumentację zdjęciową paczki, zdjęcia wykonane przed wysłaniem, zdjęcia uszkodzenia paczki, dołącz je do reklamacji,</li>
                    <li>w przypadku reklamacji wnoszonej w postaci pisemnej reklamację podpisz odręcznie;</li>
                    <li>w przypadku uszkodzenia paczki jeśli była ona pakowana w materiały operacyjne pochodzące od GLS, wpisz o tym uwagę do reklamacji;</li>
                    <li>jeśli regularnie wysyłasz takie paczki i są one zawsze w ten sam sposób solidnie zapakowane i do tej pory nie dochodziło do żadnych uszkodzeń, wpisz o tym uwagę do reklamacji;</li>
                  </ul>
                  <p>Dnia 16.06.2010 r. Sąd OKiK wydał wyrok w którym uznaje za niedozwolone i zakazuje wykorzystywania w obrocie z konsumentami postanowień wzorca umowy o treści: „GLS Poland zastrzega sobie prawo żądania innych dokumentów niezbędnych do zamknięcia postępowania reklamacyjnego, w szczególności przesłania dowodu uiszczenia opłaty za wykonanie Usługi.”, tak samo jak postanowienie - „Wniesienie reklamacji nie zwalnia klienta z obowiązku zapłaty należności z tytułu świadczenia przez GLS usług i usług dodatkowych oraz opłat i dopłat.”,</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>4. Jak oszacować realną stratę?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>W obrocie krajowym, ( z zastrzeżeniem ust. 6 regulaminu) wysokość odszkodowania za utratę lub ubytek paczki nie może przewyższać zwykłej wartości rzeczy zawartych w paczce, chyba że do szkody doszło wskutek winy umyślnej, rażącego niedbalstwa lub czynu niedozwolonego GLS Poland. Wartości rzeczy ustala się na podstawie i w następującej kolejności:</p>
                <ol type="1">
                  <li>ceny określonej w fakturze (rachunku) zakupu,</li>
                  <li>ceny wynikającej z oficjalnego cennika obowiązującego w dniu przyjęcia paczki do przemieszczenia,</li>
                  <li>wartości rzeczy tego samego rodzaju i gatunku w czasie i w miejscu przyjęcia Paczki przez GLS Poland do przemieszczania.</li>
                </ol>
                <p>W przypadku szkody w obrocie krajowym w walucie obcej, odszkodowanie zostanie obliczone wg średniego kursu NBP tej waluty z dnia nadania paczki. W obrocie międzynarodowym odpowiedzialność GLS Poland za utratę lub ubytek Paczki nie może przewyższać kwoty 8.33 SDR za każdy kilogram brakującej wagi brutto, jednakże nie więcej niż rzeczywista wartość paczki, chyba że do szkody doszło wskutek winy umyślnej, rażącego niedbalstwa lub czynu niedozwolonego GLS Poland. Przeliczenie powyższej kwoty na złote następuje według średniego kursu NBP z dnia nadania paczki do przemieszczania.</p>
                <p>W razie uszkodzenia paczki odszkodowanie ustala się w wysokości odpowiadającej procentowemu zmniejszeniu się jej wartości.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>5. W jaki sposób mogę złożyć reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                  <p>Reklamacje należy składać na piśmie, na adres siedziby GLS Poland lub drogą elektroniczną za pośrednictwem systemu ADE+.</p>
                  <p>Drogą e-mailową na adres: <a href="mailto:reklamacje@gls-poland.com">reklamacje@gls-poland.com</a>.</p>
                  <p>Adres na który należy składać reklamację na piśmie:<br />
                  General Logistics Systems Poland Sp. z o. o.<br />
                  ul. Tęczowa 10,<br />
                  62-052 Głuchow</p>

                  <p>Możesz skorzystać z opracowanego przez nas generatora reklamacji<br />
                  <v-btn class="my-3" color="primary" small href="https://google.pl">przejdź do generatora</v-btn>
                  </p>

                  <p>Do system ADE+ można się zalogować ze strony: <a href="https://adeplus.gls-poland.com/adeplus/lm/index.php">https://adeplus.gls-poland.com/adeplus/lm/index.php</a>.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>6. Ile trwa rozpatrzenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Reklamacja powinna być rozpatrzona w terminie 30 dni licząc od dnia wniesienia reklamacji.</p>
                <p>Termin ten może ulec wydłużeniu:<br />
                Jeżeli reklamację wniosła osoba nieuprawniona, albo reklamacja nie odpowiada określonym warunkom, GLS Poland wezwie reklamującego do jej uzupełnienia. Termin, na rozpatrzenie reklamacji ulega zawieszeniu do czasu uzupełnienia reklamacji przez reklamującego.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>7. Dlaczego moja reklamacja została uznana za niebyłą?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Reklamacje z tytułu niewykonania lub nienależytego wykonania umowy może składać wyłącznie klient. Reklamacje złożone przez inne osoby bez upoważnienia zostaną im zwrócone. Ponadto może być to również reklamacja, która nie została uzupełniona w przypadku braków lub wniesiona po terminie.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>8. Co jeśli moja reklamacja została odrzucona?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>W zakresie nieuregulowanym w regulaminie, w odniesieniu do przesyłek kurierskich zastosowanie znajdą właściwe przepisy Prawa pocztowego i aktów wykonawczych wydanych na podstawie ustawy Prawo pocztowe oraz właściwe przepisy Prawa przewozowego i Rozporządzenia MTiB w sprawie ustalania stanu przesyłek oraz postępowania reklamacyjnego – w odniesieniu do paczek towarowych.</p>
                <p>Spory wynikające z umowy i regulaminu rozpatrywane będą przede wszystkim na drodze polubownej między klientem a GLS Poland, w przypadku niemożności polubownego rozwiązania sporu między stronami, spór może być zakończony ugodą w drodze postępowania mediacyjnego przed Prezesem UKE, a w ostateczności przez sądy powszechne właściwe miejscowo według przepisów ogólnych.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
          <p><small>Ostatnia aktualizacja treści: 20.01.2020. Jeśli uważasz, że powyższa treść nie jest już aktualna <a href="https://odszkodowanieodkuriera.pl/kontakt"><b>skontaktuj się z nami.</b></a></small></p>
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