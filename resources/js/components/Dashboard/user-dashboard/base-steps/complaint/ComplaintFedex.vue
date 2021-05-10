<template>
  <section>
    <v-row>
      <v-col cols="12" class="pa-5 mx-5">
        <h1 class="mb-5">Reklamacja - Fedex</h1>
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
          <v-col class="complaintlinks" cols="12" md="6">
            <h2 class="mb-5">Gdzie znajdę regulamin i procedurę reklamacji?</h2>
            <v-row>
              <ActionCard height="220" :big="true">
                <div class="fedexlogo">Fedex</div>
                <h3 class="text-center">Regulamin świadczenia Usług</h3>
                <p><small>Otwórz w nowym oknie stronę Fedex z aktualnymi regulaminami usług.</small></p>
                <v-btn class="my-3" color="primary" small target="_blank" href="https://www.fedex.com/pl-pl/conditions-of-carriage-domestic.html">Przejdź do regulaminu »</v-btn>
              </ActionCard>
              <ActionCard height="220" :big="true">
                <div class="fedexlogo">Fedex</div>
                <h3 class="text-center">Fedex - Generator Reklamacji</h3>
                <p><small>Otwórz w nowym oknie stronę Fedex<br />z formularzem reklamacji.</small></p>
                <v-btn class="my-3" color="primary" small target="_blank" href="https://www.fedex.com/CLAIMS/?locale=pl_pl">Złóż reklamację »</v-btn>
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
                <h2><i class="fa fa-calendar"></i> &nbsp; 1. Kiedy mogę składać reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Usługę, której przedmiotem jest Przesyłka Kurierska uważa się za niewykonaną, gdy nastąpiła jej utrata, przy czym za utraconą uważa się Przesyłkę Kurierską, której nie można Doręczyć w terminie 30 dni od dnia nadania.</p>

                <p>Usługę, której przedmiotem jest Przesyłka Kurierska uważa się za nienależycie wykonaną, gdy nastąpiło:</p>

                <ol>
                  <li>opóźnienie względem Terminu,</li>
                  <li>ubytek w Przesyłce Kurierskiej,</li>
                  <li>uszkodzenie Przesyłki Kurierskiej.</li>
                </ol>

                <p>Z tytułu niewykonania lub nienależytego wykonania Usługi, której przedmiotem jest Przesyłka Kurierska należne jest odszkodowanie:</p>

                <ul>
                  <li>za utratę, ubytek lub uszkodzenie Przesyłki Kurierskiej, nie będącej przesyłką z korespondencją, w wysokości nie wyższej niż zwykła wartość utraconych lub uszkodzonych rzeczy,</li>
                  <li>za utratę, ubytek lub uszkodzenie Przesyłki Kurierskiej z zadeklarowaną wartością w wysokości żądanej przez nadawcę, nie wyższej jednak niż zadeklarowana wartość Przesyłki Kurierskiej,</li>
                  <li>za utratę Przesyłki Kurierskiej z korespondencją w wysokości dziesięciokrotności opłaty za Usługę nie niżej jednak niż pięćdziesięciokrotność opłaty za traktowanie przesyłki listowej jako poleconej, określonej w cenniku usług powszechnych w obrocie krajowym operatora wyznaczonego,</li>
                  <li>za opóźnienie w doręczeniu Przesyłki Kurierskiej w stosunku do gwarantowanego terminu doręczenia, w wysokości nie przekraczającej dwukrotności opłaty za Usługę.</li>
                </ul>

                <p>Odpowiedzialność FedEx za Przesyłkę wygasa wraz z przyjęciem Przesyłki bez zastrzeżeń za wyłączeniem szkód niewidocznych, w tym przypadku roszczenie wygasa po upływie 7 dni od Doręczenia.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-clock"></i> &nbsp; 2. Ile mam czasu na złożenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>W przypadku powstania szkody lub opóźnienia w Doręczeniu należy sporządzić protokół, który powinien być podpisany przez Zleceniodawcę lub Odbiorcę oraz przedstawiciela FedEx. Protokół powinien zostać sporządzony niezwłocznie na formularzu FedEx i zawierać datę i godzinę jego sporządzenia, datę i godzinę Doręczenia oraz zawierać opis szkody i stanu Przesyłki oraz informacje o opakowaniu Przesyłki. Protokół powinien <strong>zostać sporządzony niezwłocznie przy Doręczeniu lub w przypadku uszkodzeń niewidocznych w terminie 7 dni od dnia Doręczenia</strong>.</p>

                <p>Regulamin nie podaje konkretnego terminu <strong>w ustawie jest do 12 miesięcy</strong>.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-list"></i> &nbsp; 3. Co jest potrzebne do zgłoszenia reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>FedEx rozpatruje Reklamacje, które są wniesione w formie elektronicznej, pisemnej lub złożone do protokołu i zawierają komplet dokumentów. Reklamacja powinna zawierać:</p>

                <ol type="a">
                  <li>Datę Reklamacji,</li>
                  <li>Imię i nazwisko albo nazwę lub firmę oraz adres korespondencyjny wnoszącego Reklamację,</li>
                  <li>Numer listu przewozowego,</li>
                  <li>List Przewozowy,</li>
                  <li>Protokół Szkody,</li>
                  <li>Uzasadnienie możliwie precyzyjnie opisujące stan faktyczny,</li>
                  <li>Kwotę odszkodowania w przypadku gdy reklamujący żąda odszkodowania,</li>
                  <li>Dokumenty wskazujące i uzasadniające wysokość roszczenia (rachunek, faktura VAT itp.),</li>
                  <li>Numer konta bankowego, na które FedEx powinien wypłacić odszkodowanie w przypadku uznania Reklamacji,</li>
                  <li>Podpis reklamującego (za wyłączeniem zgłoszeń mailowych),</li>
                  <li>W przypadku zrzeczenia się przez Zleceniodawcę na rzecz Odbiorcy roszczenia: oświadczenie o zrzeczeniu się prawa do dochodzenia roszczeń.</li>
                </ol>

                <p>W celu uchylenia wątpliwości FedEx informuje, że za Reklamację uważa się również zgłoszenie niewykonania lub nienależytego wykonania Usługi, które nie zawiera żądania zapłaty odszkodowania.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-money-bill-alt"></i> &nbsp; 4. Jak oszacować realną stratę?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>Nadanie Przesyłki, której deklarowana wartość przekracza 2500 zł wymaga zgody FedEx.</p>

                <p>Stratę można oszacować wg wartości przesyłki np. z faktury oraz stopnia jej uszkodzenia.</p>

                <p>FedEx nie odpowiada za szkody pośrednie i utracone korzyści (postanowienie nie dotyczy konsumentów).<br>
                FedEx nie ponosi odpowiedzialności za szkody powstałe w opakowaniu Przesyłki, jej zabezpieczeniu, palecie itp. (postanowienie nie dotyczy konsumentów).<br>
                FedEx odpowiada za kwotę pobrania od momentu pokwitowania jego przyjęcia od Odbiorcy i do wysokości kwoty wskazanej na Liście Przewozowym.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-plane"></i> &nbsp; 5. W jaki sposób mogę złożyć reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>Wszelkie roszczenia związane ze świadczeniem Usług powinny być zgłoszone:</p>

                <ol>
                  <li>elektronicznie, przez złożenie Formularza Zgłoszenia Reklamacji (dostępnego pod adresem: <a href="https://www.fedex.com/CLAIMS/?locale=pl_pl">https://www.fedex.com/CLAIMS/?locale=pl_pl</a>&nbsp;&nbsp; lub</li>
                  <li>w formie pisemnej lub</li>
                  <li>do protokołu w Oddziale, w terminach przewidzianych odpowiednio przez Prawo Pocztowe lub Prawo Przewozowe („Reklamacje”).</li>
                </ol>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-hourglass"></i> &nbsp; 6. Ile trwa rozpatrzenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>FedEx w terminie 14 dni od dnia otrzymania Reklamacji:</p>

                <ol type="a">
                  <li>udziela odpowiedzi na Reklamację albo</li>
                  <li>informuje reklamującego o niemożności udzielenia odpowiedzi na Reklamację w terminie 14 dni od dnia jej otrzymania, podając tego przyczynę oraz termin udzielenia odpowiedzi na Reklamację, nie dłuższy niż 30 dni od dnia zgłoszenia Reklamacji.</li>
                </ol>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-calendar-times"></i> &nbsp; 7. Dlaczego moja reklamacja została uznana za niebyłą?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Jeżeli Reklamacja nie spełnia wymogów formalnych wskazanych powyżej FedEx wzywa reklamującego do usunięcia braków w terminie 14 dni od dnia doręczenia wezwania. Na czas usunięcia braków bieg terminów Reklamacji zostaje zawieszony. W przypadku nieuzupełnienia braków, Reklamację pozostawia się bez rozpoznania, o czym FedEx powiadamia na piśmie lub mailem.</p>

                <p>Reklamację zgłoszoną przez osobę nieuprawnioną, tzn.: inną niż Zleceniodawca lub Odbiorca, traktuje się jak niewniesioną, o czym FedEx niezwłocznie powiadamia, informując o możliwości zgłoszenia reklamacji przez uprawnionego.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-ban"></i> &nbsp; 8. Jakich rzeczy nie wolno przesyłać i gdzie?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>FedEx w szczególności nie świadczy Usługi wobec:</p>

                <ol type="a">
                  <li>Przesyłek zawierających rzeczy niebezpieczne lub mogące wyrządzić szkodę na osobie lub mieniu, w tym w szczególności: materiały wybuchowe, łatwopalne, radioaktywne, substancje żrące, cuchnące, broń lub amunicję,</li>
                  <li>Przesyłek zawierających żywe rośliny i zwierzęta,</li>
                  <li>Przesyłek zawierających zwłoki, szczątki ludzkie lub zwierzęce,</li>
                  <li>Przesyłek mających na opakowaniu lub w widocznym miejscu zawartości, treści naruszające dobra chronione przez prawo,</li>
                  <li>Przesyłek, które ze względu na swoje właściwości uniemożliwiają wykonanie Usługi przy użyciu posiadanych przez Zleceniobiorcę środków i urządzeń transportowych,</li>
                  <li>Przesyłek zawierających dzieła sztuki, antyki, kamienie i metale szlachetne w jakiejkolwiek postaci bądź formie, waluty, zbywalne papiery wartościowe, certyfikaty i jakiekolwiek walory zbywalne,</li>
                  <li>Przesyłek, których przewóz jest zakazany w świetle przepisów obowiązującego prawa,</li>
                  <li>Przesyłek w opakowaniach mogących zabrudzić lub uszkodzić w inny sposób pozostałe Przesyłki,</li>
                  <li>Przesyłek szklanych i łatwo tłukących się oraz zawierających elementy szklane,</li>
                  <li>Przesyłek, których zadeklarowana wartość przekracza limity zakładu ubezpieczeń lub budzi wątpliwości, co do zgodności zawartości z deklarowaną wartością,</li>
                </ol>

                <p>Szczegółowy wykaz rzeczy wyłączonych z świadczonej Usługi znajduje się na stronie www.fedex.com/pl</p>

              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-file-excel"></i> &nbsp; 9. Co jeśli moja reklamacja została odrzucona?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Próba polubownego załatwienia sprawy lub spór rozstrzyga właściwy sąd powszechny.</p>
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
import ActionCard from '../../start-actions/ActionCard'

export default {
  name: 'ComplaintFedex',
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
