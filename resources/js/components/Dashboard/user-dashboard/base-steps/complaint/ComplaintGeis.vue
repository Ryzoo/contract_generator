<template>
  <section>
    <v-row>
      <v-col cols="12" class="pa-5 mx-5">
        <h1 class="mb-5">Reklamacja - Geis</h1>
        <p>
          Na <b>nadawcy</b> przesyłki spoczywa kilka <b>obowiązków</b>, których
          spełnienie umożliwi
          <b>skuteczniejsze dochodzenie odszkodowania.</b>
        </p>
        <ul>
          <li>
            Pierwszym z takich obowiązków jest obowiązek
            <b>zapoznania się z regulaminem</b> firmy transportowej.
          </li>
          <li>
            Drugim obowiązkiem nadawcy (odbiorcy) jest dokonanie szeregu
            czynności przed wysłaniem i w trakcie odbioru przesyłki.
          </li>
        </ul>
        <p class="mb-5">
          Pozwoli to na złożenie reklamacji w sposób, jaki przewiduje to
          regulamin firmy.
        </p>
        <v-row class="d-flex justify-center align-center">
          <v-col class="complaintlinks" cols="12" md="6">
            <h2 class="mb-5">Gdzie znajdę regulamin i procedurę reklamacji?</h2>
            <v-row>
              <ActionCard height="220" :big="true">
                <div class="geislogo">Geis</div>
                <h3 class="text-center">Regulamin świadczenia Usług</h3>
                <p>
                  <small
                    >Otwórz w nowym oknie stronę Geis z aktualnymi regulaminami
                    usług.</small
                  >
                </p>
                <v-btn
                  class="my-3"
                  color="primary"
                  small
                  target="_blank"
                  href="https://www.geis.pl/pl/dokumenty-przesylki-paletowe"
                  >Przejdź do regulaminu »</v-btn
                >
              </ActionCard>
              <ActionCard height="220" :big="true">
                <div class="geislogo">Geis</div>
                <h3 class="text-center">Geis - Generator Reklamacji</h3>
                <p>
                  <small
                    >Otwórz w nowym oknie stronę Geis<br />z formularzem
                    reklamacji.</small
                  >
                </p>
                <v-btn
                  class="my-3"
                  color="primary"
                  small
                  target="_blank"
                  href="https://www.geis.pl/pl/dokumenty-przesylki-paletowe"
                  >Złóż reklamację »</v-btn
                >
              </ActionCard>
            </v-row>
            <p>
              Zanim przystąpisz do złożenia reklamacji,
              <b>zapoznaj się z poniższymi punktami.</b><br />
              Ułatwi Ci to poprawne złożenie reklamacji.
            </p>
          </v-col>
          <v-col cols="12" md="6">
            <img
              class="action-card-img"
              src="/images/courier/complaint.png"
              alt="complaint"
            />
          </v-col>
        </v-row>
      </v-col>
      <div class="background-grey">
        <v-col cols="12" class="pa-5 mx-5">
          <v-expansion-panels>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-calendar"></i> &nbsp; 1. Kiedy mogę składać
                  reklamację?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>
                  W przypadku niewykonania lub nienależytego wykonania usług
                  spedycyjnych.
                </p>

                <p>
                  Jeżeli z treści Ramowej Umowy Spedycji, Oferty Spedycyjnej lub
                  Zlecenia Spedycyjnego nie wynika termin wykonania usługi
                  spedycyjnej, Spedytor dołoży starań, aby przystąpić do
                  realizacji usługi spedycyjnej następnego dnia roboczego po
                  dniu potwierdzenia przyjęcia do realizacji Zlecenia
                  Spedycyjnego. Zlecenia Spedycyjne, bez względu na sposób ich
                  złożenia, powinny być doręczone Spedytorowi w terminie
                  określonym w Ramowej Umowie Spedycji lub Ofercie Spedycyjnej.
                </p>

                <p>
                  Niewykonanie w całości lub części usługi spedycyjnej
                  <strong
                    >nieprzekraczające dwóch dni roboczych w stosunku do
                    ustalonych terminów nie stanowi opóźnienia</strong
                  >.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-user-edit"></i> &nbsp; 2. Kto może złożyć
                  reklamację?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>
                  Reklamację może złożyć zleceniodawca czyli nadawca, odbiorca
                  lub inny podmiot, który zleca spedytorowi świadczenie usług
                  spedycyjnych.
                </p>

                <p>
                  W przypadku szkody w przesyłce lub szkody powstałej wskutek
                  opóźnienia w realizacji usługi spedycyjnej, Zleceniodawca
                  zapewnia, że protokół szkodowy, zostanie sporządzony nie
                  później niż w chwili dostarczenia przesyłki odbiorcy w
                  przypadku usług podstawowych lub nie później niż w chwili
                  wydania przesyłki z magazynu spedytora podmiotowi wskazanemu
                  przez zleceniodawcę, w przypadku usługi spedycyjnej obsługa
                  magazynowa, pod rygorem zwolnienia spedytora z
                  odpowiedzialności za szkodę powstałą wskutek opóźnienia w
                  realizacji usług spedycyjnych, zaginięcia, utraty lub
                  uszkodzenia Przesyłki podczas świadczenia usług spedycyjnych.
                </p>

                <p>
                  Zleceniodawca
                  <strong>w ciągu 7 dni od odbioru przesyłki</strong>
                  przez odbiorcę lub wydania przesyłki z magazynu spedytora
                  podmiotowi wskazanemu przez zleceniodawcę, może zgłosić
                  spedytorowi utratę, zaginięcie lub uszkodzenie przesyłki,
                  które nie były widoczne w chwili odbioru przesyłki przez
                  odbiorcę.
                  <strong>Protokół szkodowy</strong>, musi zawierać czytelne
                  podpisy oraz pieczęć przewoźnika spedytora i osoby działającej
                  w imieniu odbiorcy w przypadku usług podstawowych lub osoby
                  działającej w imieniu spedytora i przewoźnika w przypadku
                  usługi spedycyjnej obsługa magazynowa, pod rygorem zwolnienia
                  spedytora z odpowiedzialności za zaginięcie, utratę lub
                  uszkodzenie przesyłki.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-clock"></i> &nbsp; 3. Ile mam czasu na
                  złożenie reklamacji?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Reklamację należy złożyć nie później niż:</p>

                <ol>
                  <li>
                    w ciągu 14 dni od chwili przyjęcia Przesyłki przez Odbiorcę,
                    jeżeli szkoda polega na ubytku lub uszkodzeniu Przesyłki;
                  </li>
                  <li>
                    w ciągu 21 dni od chwili, w której miała nastąpić dostawa,
                    jeżeli szkoda polega na opóźnieniu w wykonaniu usługi
                    spedycyjnej;
                  </li>
                  <li>
                    w ciągu 30 dni od daty uznania Przesyłki za utraconą, jeśli
                    reklamacja dotyczy utraty Przesyłki.
                  </li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-list"></i> &nbsp; 4. Co jest potrzebne do
                  zgłoszenia reklamacji?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Reklamacja powinna zawierać w szczególności:</p>

                <ol>
                  <li>
                    nazwę podmiotu reklamującego oraz jego dane adresowe i
                    kontaktowe;
                  </li>
                  <li>tytuł reklamacji z uzasadnieniem;</li>
                  <li>przedmiot reklamacji;</li>
                  <li>
                    numer identyfikacyjny Przesyłki nadany przez Spedytora,
                    jeżeli został nadany Przesyłce;
                  </li>
                  <li>wysokość roszczenia;</li>
                  <li>
                    masę brutto całej Przesyłki lub jej części, jeśli szkoda w
                    Przesyłce wynika z ubytku lub uszkodzenia;
                  </li>
                  <li>
                    numer rachunku bankowego uprawnionego, na który ma zostać
                    przekazana kwota odszkodowania;
                  </li>
                  <li>podpis podmiotu składającego reklamację.</li>
                </ol>

                <p>
                  Do reklamacji należy załączyć w szczególności następujące
                  dokumenty:
                </p>

                <ol>
                  <li>
                    kopię Krajowego Listu Przewozowego lub Międzynarodowego
                    Listu Przewozowego CMR, jeżeli został wystawiony;
                  </li>
                  <li>
                    kopia dokumentu potwierdzającego wartość zakupu lub koszt
                    wytworzenia utraconego, zaginionego lub uszkodzonego towaru
                    będącego przedmiotem Przesyłki, tj. dowody księgowe
                    potwierdzające wartość zakupu lub koszt wytworzenia
                    utraconego, zaginionego lub uszkodzonego towaru będącego
                    przedmiotem Przesyłki, m.in. oryginalne faktury VAT lub
                    równoważne dokumenty księgowe wykazujące wartość utraconego,
                    zaginionego lub uszkodzonego towaru będącego przedmiotem
                    Przesyłki;
                  </li>
                  <li>
                    protokół szkodowy, którego wzór stanowi Załącznik nr 2 do
                    Regulaminu;
                  </li>
                  <li>
                    formularz zgłoszenia reklamacji, którego wzór stanowi
                    Załącznik nr&nbsp; 3 do Regulaminu;
                  </li>
                  <li>
                    fotografie, z datą i godziną ich wykonania, potwierdzające
                    fakt zaistnienia szkody oraz jej zakres.
                  </li>
                </ol>

                <p>
                  Spedytor może również wezwać Zleceniodawcę do przekazania
                  dokumentów (oryginałów lub kopii potwierdzonych za zgodność z
                  oryginałem przez uprawniony podmiot), wymienionych lub
                  dodatkowych dokumentów, niewymienionych, jeżeli jest to
                  niezbędne do prawidłowego zakończenia postępowania
                  reklamacyjnego.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-money-bill-alt"></i> &nbsp; 5. Jak oszacować
                  realną stratę?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>
                  Zleceniodawca zrzeka się roszczeń względem Spedytora
                  wynikających ze szkody w Przesyłce powyżej kwoty:
                </p>

                <ol>
                  <li>
                    500 PLN, w przypadku niezadeklarowania przez Zleceniodawcę
                    wartości Przesyłki w Zleceniu Spedycyjnym;
                  </li>
                  <li>
                    zadeklarowanej w Zleceniu Spedycyjnym, w przypadku, gdy
                    rzeczywista wartość szkody w Przesyłce przewyższa kwotę
                    zadeklarowaną w Zleceniu Spedycyjnym;
                  </li>
                  <li>
                    100000 PLN, nawet w przypadku zadeklarowania przez
                    Zleceniodawcę wyższej wartości Przesyłki w Zleceniu
                    Spedycyjnym.
                  </li>
                </ol>

                <p>&nbsp;</p>

                <p>
                  W przypadku szkody w Przesyłce powstałej podczas świadczenia
                  usługi spedycyjnej:
                </p>

                <ol>
                  <li>
                    wartość szkody ustalana jest na podstawie dokumentu
                    potwierdzającego wartość zakupu lub koszt wytworzenia
                    utraconego, zaginionego lub uszkodzonego towaru będącego
                    przedmiotem przesyłki, tj. dowody księgowe potwierdzające
                    wartość zakupu lub koszt wytworzenia utraconego, zaginionego
                    lub uszkodzonego towaru będącego przedmiotem Przesyłki,
                    m.in. oryginalne faktury VAT lub równoważne dokumenty
                    księgowe wykazujące wartość utraconego, zaginionego lub
                    uszkodzonego towaru będącego przedmiotem Przesyłki;
                  </li>
                  <li>
                    zakres szkody będzie ustalany w oparciu o protokół szkodowy,
                    którego wzór stanowi Załącznik nr 2 do Regulaminu,
                    sporządzony, zgodnie z postanowieniami, zawierającego opis
                    utraconego, zaginionego lub uszkodzonego towaru będącego
                    przedmiotem przesyłki.
                  </li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-plane"></i> &nbsp; 6. W jaki sposób mogę
                  złożyć reklamację?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>
                  Dochodzenie roszczeń z tytułu niewykonania lub nienależytego
                  wykonania usług spedycyjnych wymaga złożenia przez
                  Zleceniodawcę reklamacji w formie pisemnej lub elektronicznej.
                  Reklamację w formie pisemnej należy składać w siedzibie
                  Spedytora na adres ujawniony w rejestrze przedsiębiorców, z
                  adnotacją „Dział Reklamacji”.
                </p>

                <p>
                  Reklamację w formie elektronicznej należy przesłać za
                  pośrednictwem poczty elektronicznej na adres:
                  reklamacje@geis.pl.<br />
                  Adres: Geis PL sp. z o.o., Sosnowiec-Pieńki 7, 95-010 Stryków,
                  z dopiskiem "dział reklamacji".
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-hourglass"></i> &nbsp; 7. Ile trwa
                  rozpatrzenie reklamacji?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Spedytor rozpoznaje reklamację niezwłocznie.</p>

                <p>
                  Postępowanie reklamacyjne zostaje zakończone decyzją Spedytora
                  uwzględniającą reklamację w całości lub części albo uznającą
                  reklamację za bezzasadną.
                </p>

                <p>
                  Spedytor zawiadamia podmiot składający reklamację o decyzji w
                  przedmiocie reklamacji w taki sposób, w jaki reklamacja
                  została złożona.
                </p>

                <p>
                  Spedytor zastrzega sobie prawo do przekazania reklamacji
                  ubezpieczycielowi Spedytora, który likwiduje szkodę.
                  Postępowanie reklamacyjne nie może się zakończyć przed
                  podjęciem przez ubezpieczyciela Spedytora ostatecznej decyzji
                  w przedmiocie likwidacji szkody będącej przedmiotem wszczętego
                  postępowania reklamacyjnego. O przekazaniu sprawy do
                  ubezpieczyciela Spedytor poinformuje podmiot składający
                  reklamację.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-calendar-times"></i> &nbsp; 8. Dlaczego moja
                  reklamacja została uznana za niebyłą?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>
                  Spedytor wzywa Zleceniodawcę do uzupełnienia braków reklamacji
                  lub załączenia dokumentów, w terminie 14 dni od doręczenia
                  wezwania. Wówczas za datę wniesienia reklamacji przyjmuje się
                  datę otrzymania przez Spedytora uzupełnionej reklamacji. W
                  przypadku nieuzupełnienia braków reklamacji, nieprzekazania
                  dokumentów, lub uzupełnienia braków po upływie terminu,
                  reklamacja zostanie pozostawiona bez rozpoznania, bez
                  możliwości ponownego jej wniesienia.
                </p>

                <p>
                  Spedytor pozostawia Reklamację bez rozpoznania, jeśli nie
                  spełnia ona wymagań określonych w Regulaminie.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-ban"></i> &nbsp; 9. Jakich rzeczy nie wolno
                  przesyłać i gdzie?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>Spedytor nie świadczy usług spedycyjnych w zakresie:</p>

                <ol>
                  <li>przesyłek pocztowych;</li>
                  <li>
                    dokumentów i korespondencji pisemnej w rozumieniu przepisów
                    prawa;
                  </li>
                  <li>mienia osobistego;</li>
                  <li>żywych zwierząt;</li>
                  <li>szczątków ludzkich i zwierzęcych;</li>
                  <li>
                    środków odurzających i substancji psychotropowych, w
                    szczególności narkotyków, substancji psychotropowych,
                    środków zastępczych oraz leków lub preparatów wymagających
                    specjalnych warunków przewozu;
                  </li>
                  <li>
                    towarów wymagających zachowania szczególnych warunków
                    przewozu, przeładunku lub przechowania, w szczególności w
                    zakresie temperatury, wilgotności lub warunków
                    higienicznych;
                  </li>
                  <li>
                    towarów podwójnego zastosowania, towarów o znaczeniu
                    strategicznym i uzbrojenia;
                  </li>
                  <li>odpadów;</li>
                  <li>makiet architektonicznych;</li>
                  <li>
                    towarów o szczególnej wartości, w szczególności wartości i
                    środków pieniężnych, wyrobów jubilerskich, metali
                    szlachetnych, kamieni szlachetnych i półszlachetnych, znaków
                    legitymacyjnych, papierów wartościowych, dzieł sztuki, w tym
                    rzeźb, obrazów i instalacji artystycznych, niezależnie od
                    ich wartości artystycznej, antyków, przedmiotów wytworzonych
                    przed rokiem 1945, przedmiotów stylizowanych na antyki,
                    numizmatów, zbiorów kolekcjonerskich;
                  </li>
                  <li>
                    towarów, które swoimi właściwościami mogą stanowić
                    zagrożenie dla zdrowia lub życia ludzi lub zwierząt mających
                    z nimi styczność lub mogą uszkodzić inne przesyłki lub
                    pojazd przewoźnika Spedytora lub narzędzia używane do ich
                    obsługi, za wyjątkiem przesyłek zawierających Towary
                    Niebezpieczne, których przewóz lub przechowanie są
                    organizowane, zgodnie z postanowieniami Regulaminu;
                  </li>
                  <li>
                    przesyłek zawierających inne towary, których przewóz jest
                    zabroniony na podstawie obowiązujących przepisów prawa;
                  </li>
                  <li>
                    przesyłek, których przewóz jest zabroniony przez prawo.
                  </li>
                </ol>

                <p>
                  Istnieją przypadki gdy spedytor może świadczyć usługi
                  spedycyjne wyłącznie za uprzednim, pisemnym potwierdzeniem
                  możliwości ich wykonania, w określonych w regulaminie np. gdy
                  wartości brzegowe przekraczają te wymienione w regulaminie.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-file-excel"></i> &nbsp; 10. Co jeśli moja
                  reklamacja została odrzucona?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>
                  W przypadku odmowy wypłaty odszkodowania przez Spedytora lub
                  jego ubezpieczyciela, Zleceniodawca zachowuje prawo do
                  wystąpienia z roszczeniem na drogę sądową o zapłatę kwoty
                  odszkodowania.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
          <p>
            <small
              >Ostatnia aktualizacja treści: 20.01.2020. Jeśli uważasz, że
              powyższa treść nie jest już aktualna
              <a href="https://odszkodowanieodkuriera.pl/kontakt"
                ><b>skontaktuj się z nami.</b></a
              ></small
            >
          </p>
        </v-col>
      </div>
    </v-row>
  </section>
</template>

<script>
import ActionCard from "../../start-actions/ActionCard";

export default {
  name: "ComplaintGeis",
  components: {
    ActionCard,
  },
};
</script>

<style scoped>
.background-grey {
  padding: 25px;
  background: #f2f2f2;
  width: 100%;
}
</style>
