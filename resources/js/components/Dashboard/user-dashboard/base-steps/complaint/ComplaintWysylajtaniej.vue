<template>
  <section>
    <v-row>
      <v-col cols="12" class="pa-5 mx-5">
        <h1 class="mb-5">Reklamacja - ComplaintWysylajtaniej</h1>
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
                <div class="dpdlogo">dpd</div>
                <h3 class="text-center">Regulamin świadczenia Usług</h3>
                <p><small>Otwórz w nowym oknie stronę DPD z aktualnymi regulaminami usług.</small></p>
                <v-btn class="my-3" color="primary" small target="_blank" href="https://www.dpd.com/pl/pl/regulaminy-dpd-pickup/">Przejdź do regulaminu »</v-btn>
              </ActionCard>
              <ActionCard height="220" :big="true">
                <div class="dpdlogo">dpd</div>
                <h3 class="text-center">DPD - Generator Reklamacji</h3>
                <p><small>Otwórz w nowym oknie stronę DPD<br />z formularzem reklamacji.</small></p>
                <v-btn class="my-3" color="primary" small target="_blank" href="https://www.dpd.com/pl/pl/moje-dpd/zloz-reklamacje/">Złóż reklamację »</v-btn>
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
                <p>Usługa, do której znajduje zastosowanie Prawo pocztowe uznana będzie za niewykonaną w przypadku, gdy:</p>

                <ol type="a">
                  <li>przesyłka zaginie z przyczyn leżących po stronie DPD, w trakcie świadczenia usługi;</li>
                  <li>przesyłka nie zostanie doręczona Odbiorcy w terminie 30 dni od upływu przewidzianego terminu wykonania usługi.</li>
                </ol>

                <p>Usługi, do których znajduje zastosowanie Prawo pocztowe mogą zostać uznane za nienależycie wykonane w przypadku uszkodzenia, ubytku przesyłki lub niedostarczenia przesyłki w gwarantowanym terminie z winy DPD oraz w przypadkach określonych w bezwzględnie obowiązujących przepisach prawa.</p>

                <p>W przypadku opóźnienia w doręczeniu przesyłki, Odbiorca musi zaznaczyć ten fakt na liście przewozowym w obecności przedstawiciela DPD. Wymagane jest podanie daty i godziny doręczenia oraz przyczyny opóźnienia doręczenia przesyłki (podana przez przedstawiciela DPD). W przypadku udokumentowanej odmowy przyjęcia przesyłki przez Odbiorcę przesyłka jest zwracana do Nadawcy na koszt Zleceniodawcy.</p>

                <p>Przesyłkę, która nie nadeszła do miejsca przeznaczenia wskazanego w liście przewozowym w ciągu 30 dni od upływu terminu wykonania usługi, uważa się za utraconą.</p>

                <p>Roszczenie z tytułu nienależytego wykonania usługi wygasa wskutek przyjęcia przesyłki bez zastrzeżeń. Nie dotyczy to jednak roszczeń z tytułu niewidocznych ubytków lub uszkodzeń przesyłki zgłoszonych przez Odbiorcę do DPD nie później niż w terminie 7 dni od przyjęcia przesyłki.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-user-edit"></i> &nbsp; 2. Kto może złożyć reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Podmiotami uprawnionymi do zgłoszenia reklamacji są:</p>

                <ol>
                  <li>Zleceniodawca;</li>
                  <li>Odbiorca w przypadku, gdy zleceniodawca zrzeknie się na jego rzecz swego prawa do dochodzenia roszczeń; z zastrzeżeniem lit c) i d);</li>
                  <li>Odbiorca, któremu przysługuje prawo rozporządzania przesyłką i będący jednocześnie konsumentem;</li>
                  <li>Odbiorca, gdy przesyłka do której zastosowanie mają przepisy Prawa pocztowego zostanie mu doręczona;</li>
                </ol>

                <p>zwani dalej Reklamującym.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-clock"></i> &nbsp; 3. Ile mam czasu na złożenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Wszelkie reklamacje dotyczące niewykonania lub nienależytego wykonania Umowy, winny być zgłoszone:</p>

                <ol>
                  <li>w odniesieniu do pocztowej usługi kurierskiej - nie później niż w terminie 12 miesięcy od dnia nadania pocztowej przesyłki kurierskiej</li>
                  <li>w odniesieniu do pozostałych przesyłek – nie później niż w terminie roku od dnia, w którym zaistniało zdarzenie uzasadniające ich złożenie, a w przypadku niewykonania usługi licząc od dnia, w ciągu 30 dni od upływu terminu wykonania usługi, z zastrzeżeniem, iż w przypadku, o którym mowa w art. 77 ust. 2 ustawy Prawo przewozowe (tj. w przypadku zwłoki w przewozie, która nie spowodowała ubytku lub uszkodzenia przesyłki) - nie później niż w terminie dwóch miesięcy od dnia, w którym zaistniało zdarzenie uzasadniające ich złożenie. Reklamujący zobowiązany jest dostarczyć wszelkie dokumenty niezbędne do rozpatrzenia jego reklamacji w terminie 14 dni od dnia doręczenia wezwania przez DPD.</li>
                </ol>

                <p>Prawo do dochodzenia roszczeń wynikających z reklamacji ulega zawieszeniu do czasu uregulowania przez zleceniodawcę wszelkich należności, opłat, kosztów i innych wydatków poniesionych przez DPD z zachowaniem warunków.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-list"></i> &nbsp; 4. Co jest potrzebne do zgłoszenia reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Zgłoszenie reklamacji powinno zawierać:</p>

                <ol type="a">
                  <li>nazwę albo imię i nazwisko oraz adres Reklamującego;</li>
                  <li>tytuł reklamacji;</li>
                  <li>udokumentowane uprawnienie do dochodzenia roszczenia w zgłoszonej wysokości:
                  <ul>
                    <li>w postaci faktury zakupu przedmiotu szkody (dotyczy również przypadku przesyłek szczególnie wartościowych); lub</li>
                    <li>kalkulacji kosztów jego wytworzenia sporządzoną przez głównego księgowego lub osób uprawnionych do reprezentacji</li>
                    <li>w przypadku producentów; lub</li>
                    <li>faktury za naprawę lub szczegółowego kosztorysu naprawy, w przypadku gdy naprawa została wykonana;</li>
                  </ul>
                  </li>
                  <li>potwierdzenie nadania przesyłki (list przewozowy);</li>
                  <li>udokumentowaną kwotę roszczenia, dane rachunku bankowego, na który ma zostać przekazana kwota odszkodowania;</li>
                  <li>dowody uiszczenia wszelkich opłat i należności;</li>
                  <li>wykaz załączonych dokumentów;</li>
                  <li>kopie protokołu szkody sporządzonego na wniosek i w obecności Nadawcy lub Odbiorcy przez przedstawiciela DPD, w przypadku reklamacji z tytułu ubytku lub uszkodzenia przesyłki;</li>
                  <li>podpis Reklamującego, z zastrzeżeniem lit. k);</li>
                  <li>dokument wykazujący umocowanie w przypadku złożenia reklamacji przez pełnomocnika Reklamującego;</li>
                  <li>adres mailowy Reklamującego, w przypadku złożenia reklamacji za pośrednictwem formularza elektronicznego dostępnego na stronie www.dpd.com.pl. Dla uniknięcia wątpliwości, uznaje się, że podanie adresu mailowego Reklamującego jest równoznaczne z wyrażeniem przez niego zgody na prowadzenie korespondencji z DPD z wykorzystaniem środków komunikacji elektronicznej, w szczególności odpowiedzi na reklamację oraz wezwania.</li>
                </ol>

                <p>Dokumentacja, o której mowa w ust. 7 lit. c), d), e), f), h), j) może być złożona w formie kopii, z zastrzeżeniem, że w uzasadnionych przypadkach DPD jest&nbsp; uprawniona do żądania złożenia przez Reklamującego dokumentacji w oryginale lub poświadczonych kopiach.</p>

              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-money-bill-alt"></i> &nbsp; 5. Jak oszacować realną stratę?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Odpowiedzialność DPD za utratę, ubytek lub uszkodzenie przesyłki, w stosunku do której zastosowanie mają przepisy Prawa przewozowego ograniczona jest do wartości deklarowanej, nie większej niż wartości rzeczywista. Do odpowiedzialności za utratę, ubytek lub uszkodzenie przesyłek o szczególnej wartości, mają zastosowanie przepisy art. 80 ust.3 Prawa przewozowego.</p>

                <p>Przy ocenie realnej straty decyduje rzeczywista wartość przesyłki, może być udowodniona paragonem, rachunkiem, może być sprawdzona za pomocą portali typu np. allegro.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-plane"></i> &nbsp; 6. W jaki sposób mogę złożyć reklamację?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Wszelkie reklamacje związane z niewykonaniem usługi, opóźnieniem, zagubieniem, uszkodzeniem, ubytkiem przesyłki, przyjmuje Centrala DPD.</p>

                <p>W przypadku pocztowej usługi kurierskiej oraz usługi przewozowej reklamacja może być wniesiona pisemnie lub poprzez formularz elektroniczny dostępny na stronie <a href="https://www.dpd.com/pl/pl/moje-dpd/zloz-reklamacje/">www.dpd.com.pl</a>. W przypadku pocztowej usługi kurierskiej reklamacja może być także wniesiona w formie ustnej do protokołu w Centrali DPD.</p>

                <p>W formie papierowej na adres DPD Polska Sp. z o.o. Dział Reklamacji, ul. Mineralna 15, 02-274 Warszawa.</p>

                <p>Reklamujący zobowiązany jest dostarczyć wszelkie dokumenty niezbędne do rozpatrzenia jego reklamacji w terminie 14 dni od dnia doręczenia wezwania przez DPD.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-hourglass"></i> &nbsp; 7. Ile trwa rozpatrzenie reklamacji?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>DPD lub Ubezpieczyciel w imieniu DPD rozpatruje reklamację niezwłocznie i udziela odpowiedzi na reklamację w terminie nie dłuższym niż 30 dni od dnia otrzymania pełnej dokumentacji reklamacji. Terminu na uzupełnienie reklamacji, nie wlicza się do terminu rozpatrzenia reklamacji. Po rozpatrzeniu reklamacji Reklamujący jest powiadamiany pisemnie lub za pośrednictwem środków komunikacji elektronicznej o uznaniu, częściowym uznaniu lub oddaleniu reklamacji. W każdym z powyższych przypadków powiadomienie zawiera w szczególności:</p>

                <ol type="a">
                  <li>określenie sposobu załatwienia reklamacji, w tym ewentualną kwotę odszkodowania oraz termin jej przekazania;</li>
                  <li>uzasadnienie sposobu załatwienia reklamacji, w przypadku nie uznania części lub całości roszczeń Reklamującego.</li>
                </ol>

                <p>Termin na udzielenie odpowiedzi na reklamację uważa się za zachowany w przypadku nadania odpowiedzi do Reklamującego w ostatnim dniu terminu za pośrednictwem operatora publicznego lub innego operatora pocztowego lub za pośrednictwem środków komunikacji elektronicznej.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-calendar-times"></i> &nbsp; 8. Dlaczego moja reklamacja została uznana za niebyłą?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Reklamacje zgłoszone po terminie, reklamacje nieścisłe lub niekompletne, reklamacje uzupełnione po terminie lub reklamacje wniesione przez osobę nieuprawnioną traktuje się jak niewniesione.</p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-ban"></i> &nbsp; 9. Jakich rzeczy nie wolno przesyłać i gdzie?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Wyłączenia, czego nie można wysyłać:<br>
                DPD odmawia zawarcia Umowy albo może odstąpić od wykonania usługi po zawarciu Umowy, jeżeli Zleceniodawca lub Nadawca naruszy niniejszy Regulamin, w szczególności:</p>

                <ol>
                  <li>przesyłka zawiera rzeczy niebezpieczne lub mogące wyrządzić szkodę osobom lub w mieniu, w tym w szczególności: materiały łatwopalne, wybuchowe lub radioaktywne, substancje żrące lub cuchnące, broń i amunicję;</li>
                  <li>przesyłka zawiera narkotyki lub leki i środki psychotropowe, substancje odurzające i inne o działaniu psychoaktywnym, w tym popularnie nazwane dopalaczami, za wyjątkiem przedmiotów wysyłanych w celach naukowych lub medycznych przez ustawowo do tego upoważnione instytucje;</li>
                  <li>przesyłka zawiera żywe rośliny lub zwierzęta;</li>
                  <li>przesyłka zawiera wyroby tytoniowe, wyroby alkoholowe lub inne wyroby akcyzowe, żywność, której przewóz jest wyłączony przepisami prawa lub wymaga stosowania specjalnych środków i urządzeń transportowych;</li>
                  <li>przesyłka zawiera zwłoki, szczątki ludzkie lub zwierzęce;</li>
                  <li>przesyłka ma na opakowaniu lub w widocznej części zawartości napisy lub rysunki naruszające dobra chronione przez prawo;</li>
                  <li>przesyłka, która ze względu na swoje właściwości uniemożliwia wykonanie usługi przy użyciu posiadanych środków i urządzeń transportowych;</li>
                  <li>przesyłka zawiera dzieła sztuki, antyki, biżuterię, kamienie i metale szlachetne w jakiejkolwiek postaci lub formie, waluty, zbywalne papiery wartościowe, znaki legitymacyjne, dokumenty potwierdzające tożsamość lub posiadanie uprawnień, bony towarowe, certyfikaty i jakiekolwiek inne walory zbywalne;</li>
                  <li>przesyłka zawiera dokumenty przetargowe, o ile strony nie postanowiły inaczej;</li>
                  <li>przesyłka, która z mocy ogólnych przepisów prawa nie może być przewożona albo przepisy prawa przewidują ograniczenia w przewozie takiej przesyłki lub wymagają spełnienia szczególnych warunków i procedur przewozu dla takiej przesyłki;</li>
                  <li>przesyłka zawiera rzeczy wymienione na stronie www.dpd.com.pl;</li>
                  <li>przesyłka jest w opakowaniu mogącym zabrudzić lub w inny sposób uszkodzić pozostałe przesyłki;</li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2><i class="fa fa-file-excel"></i> &nbsp; 10. Co jeśli moja reklamacja została odrzucona?</h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Drogę postępowania reklamacyjnego uważa się za wyczerpaną w przypadku odmowy uznania reklamacji przez DPD lub Ubezpieczyciela w imieniu DPD, albo niezapłacenia dochodzonej należności:</p>

                <ol>
                  <li>w odniesieniu do usług pocztowych - w terminie 30 dni od dnia uznania reklamacji,</li>
                  <li>w odniesieniu do innych usług - w terminie 3 miesięcy od dnia wniesienia kompletnej reklamacji.</li>
                </ol>

                <p>Spór może być zakończony ugodą w drodze postępowania w sprawie pozasądowego rozwiązywania sporów konsumenckich.<br>
                Postępowanie w sprawie pozasądowego rozwiązywania sporów konsumenckich prowadzi Prezes Urzędu Komunikacji Elektronicznej (dalej: UKE). Prezes UKE może odmówić rozwiązania sporu konsumenckiego w przypadku, gdy wartość przedmiotu sporu jest niższa niż 10 zł.</p>

                <p>Kurier nie może uniknąć odpowiedzialności za niezrealizowanie przesyłki z przyczyn technicznych np. z powodu nieprawidłowego funkcjonowania serwisu.</p>

                <p>Sąd Ochrony Konkurencji i konsumentów uznał za niedozwolone następujące klauzule umowne:</p>

                <ul>
                  <li>Zleceniobiorca i DPD Polska sp. z o.o. nie ponosi odpowiedzialności za utratę/ubytek/uszkodzenie Przesyłki lub opóźnienie jej doręczenia jeżeli zaistniały one z przyczyn: (…) c) spowodowanych siłą wyższą lub innych zdarzeń losowych niezawinionych przez Zleceniobiorcę czy DPD (strajki, spory pracownicze, blokady, złe warunki atmosferyczne, natężenie ruchu, mechaniczne uszkodzenia lub korki na drogach, autostradach lub jakiejkolwiek przyczyny poza kontrolą Zleceniobiorcy i DPD)</li>
                  <li>Zleceniobiorca i DPD Polska sp. z o.o. nie ponosi odpowiedzialności za opóźnienia lub zwrot Przesyłki jeśli: (…) c) zawartość Przesyłki nie odpowiada deklaracji zawartej na Liście przewozowym</li>
                  <li>DPD ponosi odpowiedzialność jedynie za zawinioną przez siebie utratę, ubytek lub uszkodzenie przesyłki (…)</li>
                </ul>

                <p><br>
                Postępowanie w sprawie pozasądowego rozwiązywania sporów konsumenckich prowadzi się w formie papierowej lub elektronicznej. Wniosek o wszczęcie takiego postępowania wnosi się w postaci papierowej na adres UKE albo zamiejscowej jednostki organizacyjnej UKE właściwej miejscowo ze względu na miejsce zamieszkania albo adres siedziby wnioskodawcy lub w postaci elektronicznej za pośrednictwem elektronicznej platformy usług administracji publicznej albo zamieszczonego na stronie podmiotowej Biuletynu Informacji Publicznej UKE formularza kontaktowego dedykowanego do składania wniosków. Szczegółowy zakres i formy prowadzenia postępowania w sprawie pozasądowego rozwiązywania sporów konsumenckich określa rozdział 5 ustawy z dnia 23 września 2016 r. o pozasądowym rozwiązywaniu sporów konsumenckich (Dz. U. z 2016 poz. 1823) z uwzględnieniem art. 95 ust. 1-12 Prawa pocztowego oraz Rozporządzenie Ministra Infrastruktury i Budownictwa z dnia 17 stycznia 2017 r. w sprawie postępowania w sprawie pozasądowego rozwiązywania sporów konsumenckich z zakresu usług pocztowych prowadzonego przez Prezesa UKE.</p>

                <p>Spory wynikające z umowy i regulaminu rozpatrywane będą przez sądy powszechne właściwe dla siedziby DPD.</p>
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
  name: 'ComplaintWysylajtaniej',
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
