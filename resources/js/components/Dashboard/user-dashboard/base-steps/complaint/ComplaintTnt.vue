<template>
  <section>
    <v-row>
      <v-col cols="12" class="pa-5 mx-5">
        <h1 class="mb-5">Reklamacja - TNT</h1>
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
                <div class="tntlogo">TNT</div>
                <h3 class="text-center">Regulamin świadczenia Usług</h3>
                <p><small>Otwórz w nowym oknie stronę TNT z aktualnymi regulaminami usług.</small></p>
                <v-btn class="my-3" color="primary" small target="_blank" href="https://www.tnt.com/express/pl_pl/site/terms-conditions.html">Przejdź do regulaminu »</v-btn>
              </ActionCard>
              <ActionCard height="220" :big="true">
                <div class="tntlogo">TNT</div>
                <h3 class="text-center">TNT - Generator Reklamacji</h3>
                <p><small>Otwórz w nowym oknie stronę TNT<br />z formularzem reklamacji.</small></p>
                <v-btn class="my-3" color="primary" small target="_blank" href="https://www.tnt.com/express/pl_pl/site/support/contact.html">Złóż reklamację »</v-btn>
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
                <p>W miejscu dotyczącym reklamacji są dwa rodzaje przesyłek – towarowe i pocztowe.</p>

                <p>Warunkiem rozpatrzenia każdej reklamacji z tytułu uszkodzenia lub ubytku zawartości przesyłki jest udostępnienie TNT do sprawdzenia zarówno zawartości jak i oryginalnego opakowania przesyłki; nie dotyczy to konsumentów.</p>

                <p>W przypadku przesyłek towarowych są 2 rodzaje podmiotów:</p>

                <ul>
                  <li><strong>Konsumenci</strong> - Zgłaszanie reklamacji i dochodzenie roszczeń z tytułu odszkodowania przez konsumentów w razie zlecenia przewozu Przesyłki Towarowej odbywa się na podstawie ustawy z dnia 15 listopada 1984r. Prawo przewozowe (Dz.U.z1984r.Nr53,poz.272zezm.) oraz rozporządzenia Ministra Transportu i Budownictwa w sprawie ustalania stanu przesyłek oraz postępowania reklamacyjnego (Dz.U.z2006r.,Nr38,poz.266zezm.).</li>
                  <li>Do innych klientów odnoszą się te same akty prawne z tym, że o ile obowiązujące akty nie stanowią inaczej regulamin ustala pewne zasady (pkt. 8 ust. 1 lit. b. )</li>
                </ul>

                <p>Zgłaszanie reklamacji i dochodzenie roszczeń z tytułu odszkodowania przez konsumentów oraz pozostałych Klientów w razie zlecenia przewozu <strong>Przesyłki Pocztowej</strong> odbywa się na podstawie ustawy z dnia 23 listopada 2012r. Prawo pocztowe (Dz.U.z2012r.,poz.1529 ) oraz Rozporządzenia Ministra Administracjii Cyfryzacji z dnia 26 listopada 2013 roku w sprawie reklamacji usługi pocztowej (Dz.U.z2013r.,poz.1466zezm.).</p>

                <p>O ile bezwzględnie obowiązujące przepisy prawa nie stanowią inaczej, Usługa może być uznana za nienależycie wykonaną w razie ubytku lub uszkodzenia przesyłki oraz opóźnienia w doręczeniu przesyłki, a za niewykonaną - w razie utraty przesyłki. Przesyłkę uważa się za utraconą w razie braku doręczenia w terminie 30 dni od terminu doręczenia przewidzianego umową.</p>

                <p>W przypadku szkód dających się z zewnątrz zauważyć(jawnych), odbiór przesyłki przez&nbsp; odbiorcę bez zastrzeżeń powoduje wygaśnięcie wszelkich roszczeń wobec TNT.</p>

                <p>Szkody nie dające się z zewnątrz zauważyć (niejawne, ukryte), winny zostać niezwłocznie, nie później jednak niż w ciągu siedmiu dni od chwili odbioru przesyłki, zgłoszone przez odbiorcę do Działu Obsługi Klienta TNT wraz z udowodnieniem, że ubytki lub uszkodzenia przesyłki powstały w czasie między przyjęciem przesyłki przez TNT w celu realizacji usługi a jej doręczeniem adresatowi.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-user-edit"></i> &nbsp; 2. Kto może złożyć reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>Do zgłaszania <strong>reklamacji towarowej</strong>&nbsp; i dochodzenia roszczeń z tytułu odszkodowania uprawniony jest <strong>jedynie płatnik usługi</strong>.</p>

                <p>Przesyłka <strong>pocztowa</strong>: W przypadku niewykonania lub nienależytego wykonania usługi pocztowej prawo wniesienia reklamacji przysługuje:</p>

                <ol>
                  <li>nadawcy;</li>
                  <li>adresatowi– w przypadku gdy nadawca zrzeknie się na jego rzecz prawa dochodzenia roszczeń albo gdy przesyłka pocztowa zostanie doręczona adresatowi.</li>
                </ol>

                <p>Reklamację wniesioną przez osobę nieuprawnioną traktuje się jak nie wniesioną,&nbsp; o czym TNT niezwłocznie zawiadamia reklamującego, informując go o możliwości wniesienia reklamacji przez osobę uprawnioną.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-clock"></i> &nbsp; 3. Ile mam czasu na złożenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p><strong>Przesyłka Towarowa</strong>:</p>

                <ul>
                  <li>reklamację składa się nie później niż w terminie roku od dnia, w którym zaistniało zdarzenie uzasadniające jej złożenie.</li>
                  <li>w przypadku, o którym mowa w art. 77 ust. 2 ustawy z dnia 15 listopada 1984 r. -Prawo przewozowe, reklamację składa się nie później niż w terminie dwóch miesięcy od dnia, w którym zaistniało zdarzenie uzasadniające jej złożenie.</li>
                </ul>

                <p><strong>Przesyłka pocztowa</strong>:<br>
                Reklamacja może zostać wniesiona nie później niż w terminie 12 miesięcy od dnia nadania przesyłki pocztowej, przy czym reklamację z tytułu niewykonania lub nienależytego wykonania usługi można zgłosić:</p>

                <ul>
                  <li>bezpośrednio przy przyjęciu przesyłki uszkodzonej lub z ubytkiem zawartości jeżeli został sporządzony protokół uszkodzeń,</li>
                  <li>po przyjęciu przesyłki, jeżeli bezpośrednio przy przyjęciu zostało złożone pisemne oświadczenie o stwierdzeniu ubytków lub uszkodzeń przesyłki albo sporządzony został protokół uszkodzeń,</li>
                  <li>w razie przyjęcia przesyłki bez zastrzeżeń – w terminie 7 dni od dnia przyjęcia przesyłki;</li>
                  <li>z tytułu utraty przesyłki pocztowej– w dniu następnym po upływie terminu w jakim dana usługa pocztowa powinna być wykonana</li>
                  <li>z tytułu opóźnienia w doręczeniu przesyłki w stosunku do gwarantowanego terminu doręczenia, jeżeli taki termin został określony przez TNT</li>
                  <li>po upływie tego terminu.</li>
                </ul>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-list"></i> &nbsp; 4. Co jest potrzebne do zgłoszenia reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>Wszystkie reklamacje powinny zawierać następujące dane:</p>

                <ul>
                  <li>datę sporządzenia reklamacji;</li>
                  <li>numer listu przewozowego;</li>
                  <li>dane (imię i nazwisko lub nazwa przedsiębiorstwa oraz adres) reklamującego;</li>
                  <li>powód i uzasadnienie reklamacji;</li>
                  <li>kwotę odszkodowania w przypadku żądania odszkodowania i numer rachunku bankowego;</li>
                  <li>wykaz załączonych dokumentów;</li>
                  <li>podpis osoby uprawnionej do wniesienia reklamacji (w przypadku reklamacji złożonej w formie innej niż pisemna reklamacja powinna zawierać dane identyfikujące reklamującego);</li>
                  <li>do reklamacji powinien być dołączony oryginał dokumentu potwierdzającego nadanie albo oryginał pokwitowania nadania przesyłki (np. oryginał listu przewozowego lub kopia potwierdzona przez pracownika TNT); w przypadku przesyłki pocztowej – oryginał ten jest składany tylko w wypadku wnoszenia reklamacji w postaci pisemnej, i do wglądu.</li>
                </ul>

                <p>Reklamacja <strong>przesyłki towarowej</strong>&nbsp; powinna zawierać min. :</p>

                <ol>
                  <li>imię i nazwisko (nazwę) i adres zamieszkania (siedziby) przewoźnika;</li>
                  <li>imię i nazwisko (nazwę) i adres zamieszkania (siedziby) uprawnionego;</li>
                  <li>załączoną kopię dokumentu dotyczącego zawarcia umowy przewozu lub dane określone przez przewoźnika, pozwalające zidentyfikować zawartą umowę przewozu;</li>
                  <li>uzasadnienie reklamacji;</li>
                  <li>kwotę roszczenia (oddzielnie dla każdego dokumentu przewozowego);</li>
                  <li>numer rachunku bankowego lub adres właściwy do wypłaty odszkodowania lub innej należności;</li>
                  <li>podpis uprawnionego-w przypadku reklamacji wnoszonej w formie pisemnej</li>
                </ol>

                <p>Reklamacja pisemna <strong>przesyłki pocztowej</strong> powinna zawierać dodatkowe dane:</p>

                <ol>
                  <li>oświadczenie nadawcy o zrzeczeniu się prawa do dochodzenia roszczeń- w przypadku gdy nadawca zrzeknie się na rzecz adresata prawa dochodzenia roszczeń;</li>
                  <li>kopię protokołu uszkodzeń lub ubytków sporządzonego przez TNT</li>
                  <li>opakowanie uszkodzonej przesyłki</li>
                  <li>oświadczenie o stwierdzeniu niewidocznych&nbsp; ubytków lub uszkodzeń przesyłki pocztowej złożone w terminie 7 dni od przyjęcia przesyłki bez zastrzeżeń w raz ze wskazaniem okoliczności bądź dowodów potwierdzających, że ubytki lub uszkodzenia przesyłki powstały w czasie między przyjęciem przesyłki przez TNT a jej doręczeniem;</li>
                  <li>oryginały lub potwierdzone urzędowo za zgodność z oryginałem kopie dokumentów stanowiących dowód wysokości dochodzonego roszczenia;</li>
                  <li>przytoczenie okoliczności potwierdzających nadanie lub doręczenie przesyłki pocztowej oraz wskazanie dowodów potwierdzających ten fakt.</li>
                </ol>

                <p>Do reklamacji wnoszonej w postaci innej niż pisemna reklamujący powinien załączyć kopię dokumentów,&nbsp; o których mowa powyżej oraz kopię dokumentu potwierdzającego nadanie albo kopię pokwitowania nadania przesyłki, przy czym TNT może zażądać przekazania oryginałów.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-money-bill-alt"></i> &nbsp; 5. Jak oszacować realną stratę?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>Zadeklarowana wartość przesyłki jak również wartość przesyłki zgłoszona do ubezpieczenia, nie może przewyższać jej zwykłej wartości. Na żądanie TNT zadeklarowana wartość przesyłki jak również wartość przesyłki zgłoszona do ubezpieczenia powinna być potwierdzona przy zleceniu usługi lub w przypadku złożenia reklamacji stosownymi dokumentami (np. faktury, rachunki); niniejsze postanowienie nie dotyczy Konsumentów. W sytuacji, gdy Klient przekaże TNT w swoich oświadczeniach informację, z której wynikają różne wartości przesyłki, za wartość zadeklarowaną przesyłki uznaje się wartość najniższą.</p>

                <p>W przypadku <strong>przesyłki towarowej</strong> kwota roszczenia powinna być udokumentowana(oddzielnie dla każdego dokumentu przewozowego); do reklamacji należy dołączyć ponadto potwierdzone kopie innych dokumentów związanych z rodzajem i wysokością roszczenia, jeżeli takie dokumenty występują;</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-plane"></i> &nbsp; 6. W jaki sposób mogę złożyć reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p><strong>Przesyłki towarowe</strong>: Mogą być wniesione w formie pisemnej, ustnej do protokołu, dokumentowej z wykorzystaniem środków komunikacji elektronicznej. &nbsp;</p>

                <p><strong>Przesyłki pocztowe</strong>: Wnosi się w placówce operatora w postaci pisemnej, elektronicznej lub ustnej do protokołu.<br>
                Za pomocą formularza <a href="https://www.tnt.com/express/pl_pl/site/support/contact.html">https://www.tnt.com/express/pl_pl/site/support/contact.html.</a></p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-hourglass"></i> &nbsp; 7. Ile trwa rozpatrzenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>TNT zobowiązane jest do powiadomienia reklamującego o sposobie załatwienia reklamacji w ciągu 30 dni od daty przyjęcia reklamacji do rozpatrzenia, z zastrzeżeniem sytuacji, gdy reklamacja nie spełnia warunków reklamacji.</p>

                <p>W razie nie spełnienia przez reklamującego wymogów reklamacji przesyłki pocztowej, TNT wezwie go do usunięcia braków w terminie 7 dni od doręczenia wezwania. Nie uzupełnienie braków w terminie spowoduje pozostawienie reklamacji bez rozpoznania.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-calendar-times"></i> &nbsp; 8. Dlaczego moja reklamacja została uznana za niebyłą?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>W przypadku przesyłki towarowej:</p>

                <ol>
                  <li>Przewoźnik potwierdza uprawnionemu wpływ reklamacji przesyłki towarowej, jeśli osoba składająca reklamację nie otrzymała potwierdzenia, przewoźnik prawdopodobnie jej nie otrzymał.</li>
                  <li>Kwota roszczenia powinna być udokumentowana(oddzielnie dla każdego dokumentu przewozowego); do reklamacji należy dołączyć ponadto potwierdzone kopie innych dokumentów związanych z rodzajem i wysokością roszczenia, jeżeli takie dokumenty występują;</li>
                </ol>

                <p>Brak dołączenia do reklamacji dokumentów wymienionych w niniejszym punkcie skutkować będzie brakiem <strong>rozpatrzenia reklamacji towarowej</strong>.</p>

                <p>Nie uzupełnienie dokumentów w terminie 7 (przesyłka pocztowa) lub 14 dni (towarowa)&nbsp; od dnia otrzymania wezwania do uzupełnienia.</p>

                <p>&nbsp;</p>

                <p>Reklamację <strong>przesyłki pocztowej</strong> zgłoszoną po upływie 12 miesięcy od dnia nadania przesyłki lub po terminie 7 dni od przyjęcia przesyłki w razie przyjęcia przesyłki bez zastrzeżeń, TNT pozostawia bez rozpoznania, o czym niezwłocznie informuje reklamującego.</p>

                <p>Reklamację wniesioną przez osobę nieuprawnioną traktuje się jak nie wniesioną, o czym TNT niezwłocznie zawiadamia reklamującego przesyłkę.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-ban"></i> &nbsp; 9. Jakich rzeczy nie wolno przesyłać i gdzie?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <ol>
                  <li>Zawartością przesyłki ogólnie nie mogą być:
                  <ul>
                    <li>rzeczy, których przewóz zabroniony jest na podstawie odrębnych przepisów;</li>
                    <li>towary niebezpieczne w rozumieniu odrębnych przepisów, w tym w szczególności materiały łatwopalne, wybuchowe lub radioaktywne, broń i amunicja;</li>
                    <li>rzeczy, które z powodu swoich rozmiarów, masy lub innych właściwości nie nadają się do przewozu środkami transportowymi;</li>
                    <li>rzeczy, które ze względu na swoje właściwości mogą stanowić zagrożenie dla zdrowia osób lub mienia z którymi mają styczność;</li>
                    <li>rośliny, zwierzęta</li>
                  </ul>
                  </li>
                  <li>TNT nie przyjmuje przesyłek:
                  <ul>
                    <li>których wartość przekracza kwotę 100 000 PLN, o ile nie zostały ubezpieczone w sieci TNT</li>
                    <li>zawierających dzieła sztuki, antyki, kamienie i metale szlachetne, biżuterię, środki pieniężne, karty kredytowe i bankomatowe, czeki, weksle, bony towarowe, pieniężne i inne papiery wartościowe. W wyjątkowych przypadkach niektóre przesyłki mogą być przyjęte na podstawie odrębnej umowy i złożeniu przez nadawcę przesyłki oświadczenia ograniczającego odpowiedzialność TNT za utratę, uszkodzenie lub braki w przesyłce</li>
                    <li>zawierających produkty pochodzenia zwierzęcego.</li>
                  </ul>
                  </li>
                </ol>

              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-file-excel"></i> &nbsp; 10. Co jeśli moja reklamacja została odrzucona?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>

                <p>W przypadku odmowy uwzględnienia reklamacji w całości lub w części reklamującemu przysługuje odwołanie w terminie 14 dni od dnia jej doręczenia. TNT rozpatruje odwołanie w terminie nie dłuższym niż 30 dni od jego otrzymania. Dotyczy to <strong>przesyłki pocztowej</strong>.<br>
                &nbsp;&nbsp; &nbsp;<br>
                Nie udzielenie odpowiedzi na reklamację w przedmiocie <strong>przesyłki pocztowej</strong> w terminie 30 dni od jej otrzymania lub nie udzielenie odpowiedzi na odwołanie od odmowy przyjęcia reklamacji w całości lub części w terminie 30 dni od otrzymania odwołania jest równoznaczne z uznaniem reklamacji.</p>

                <p>Sąd Konkurencji i Konsumentów wyrokiem z dnia 18.04.2012 r.&nbsp; uznał za niedozwolone i zakazał wykorzystywania w <strong>obrocie z konsumentami</strong> postanowienia wzorca umowy o treści: „Złożenie reklamacji nie uprawnia płatnika do dokonywania jakichkolwiek potrąceń z należności za wykonany przewóz.”</p>

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
  name: 'ComplaintTnt',
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
