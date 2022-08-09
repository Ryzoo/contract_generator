<template>
  <section>
    <v-row>
      <v-col cols="12" class="pa-5 mx-5">
        <h1 class="mb-5">Reklamacja - DHL</h1>
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
                <div class="dhllogo">DHL</div>
                <h3 class="text-center">Regulamin świadczenia Usług</h3>
                <p>
                  <small
                    >Otwórz w nowym oknie stronę DHL z aktualnymi regulaminami
                    usług.</small
                  >
                </p>
                <v-btn
                  class="my-3"
                  color="primary"
                  small
                  target="_blank"
                  href="https://www.dhl.com/pl-pl/home/nasze-dywizje/parcel/dla-ciebie/obsluga/dokumenty.html"
                  >Przejdź do regulaminu »</v-btn
                >
              </ActionCard>
              <ActionCard height="220" :big="true">
                <div class="dhllogo">DHL</div>
                <h3 class="text-center">DHL - Generator Reklamacji</h3>
                <p>
                  <small
                    >Otwórz w nowym oknie stronę DHL<br />z formularzem
                    reklamacji.</small
                  >
                </p>
                <v-btn
                  class="my-3"
                  color="primary"
                  small
                  target="_blank"
                  href="https://www.dhl.com/pl-pl/home/nasze-dywizje/parcel/dla-ciebie/obsluga/kontakt/reklamacje.html"
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
                  Podstawą do wszczęcia postępowania reklamacyjnego jest
                  złożenie przez uprawnionego reklamacji.
                </p>

                <p>Reklamację można wnieść:</p>

                <ol>
                  <li>
                    z tytułu ubytku lub uszkodzenia przesyłki pocztowej
                    niebędącej przesyłką z korespondencją:
                    <ul>
                      <li>
                        bezpośrednio przy przyjęciu przesyłki uszkodzonej lub z
                        ubytkiem zawartości - jeżeli został sporządzony protokół
                        szkodowy przy przyjęciu przesyłki,
                      </li>
                      <li>
                        po przyjęciu przesyłki - jeżeli bezpośrednio przy
                        przyjęciu zostało złożone pisemne oświadczenie o
                        stwierdzeniu ubytków lub uszkodzeń przesyłki albo został
                        sporządzony protokół szkodowy,&nbsp;
                        <strong>w terminie 7 dni</strong>
                        od daty przyjęcia przesyłki
                      </li>
                      <li>
                        w przypadku uszkodzeń i ubytków niedających się zauważyć
                        z zewnątrz, stwierdzonych po przyjęciu przesyłki;
                      </li>
                    </ul>
                  </li>
                  <li>
                    z tytułu utraty przesyłki - w dniu następnym po upływie
                    terminu określonego w Usługę pocztową uważa się za
                    nienależycie wykonaną, jeśli nastąpiło opóźnienie w
                    doręczeniu przesyłki albo w przypadku ubytku lub uszkodzenia
                    przesyłki. Usługę pocztową uważa się za niewykonaną w
                    przypadku utraty przesyłki. Za utraconą uważa się przesyłkę,
                    która nie doszła do miejsca przeznaczenia wskazanego w
                    liście przewozowym w ciągu 30 dni od upływu terminu
                    doręczenia. W przypadku niewykonania Usługi pocztowej
                    niezależnie od należnego odszkodowania DHL zwraca w całości
                    pobraną opłatę za Usługę pocztową.
                  </li>
                  <li>
                    z tytułu opóźnienia w doręczeniu przesyłki w stosunku do
                    gwarantowanego terminu doręczenia - po upływie tego terminu.
                    Jednakże w żadnym przypadku wniesienie
                    <strong
                      >reklamacji nie może nastąpić później niż 12 miesięcy od
                      dnia nadania przesyłki</strong
                    >.
                  </li>
                </ol>
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
                <p>Uprawnionymi do wniesienia reklamacji są:</p>

                <ol>
                  <li>Nadawca, lub</li>
                  <li>
                    Odbiorca –w przypadku, gdy Nadawca zrzeknie się na jego
                    rzecz prawa dochodzenia roszczeń albo gdy przesyłka zostanie
                    doręczona Odbiorcy.
                  </li>
                </ol>
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
                <p>
                  Fakt uszkodzenia przesyłki zgłoś w ciągu 7 dni kalendarzowych
                  od daty doręczenia przesyłki.<br />
                  Z tytułu opóźnienia w doręczeniu przesyłki w stosunku do
                  gwarantowanego terminu doręczenia - po upływie tego terminu.
                </p>

                <p>
                  Jednakże w żadnym przypadku
                  <strong
                    >wniesienie reklamacji nie może nastąpić później niż 12
                    miesięcy od dnia nadania przesyłki</strong
                  >.
                </p>
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
                <p>
                  Szczegółowy tryb składania i rozpatrywania reklamacji (w tym
                  treść reklamacji oraz wymagane dokumenty) regulują:
                </p>

                <ol>
                  <li>
                    w zakresie Usług przewozowych: rozporządzenie Ministra
                    Transportu i Budownictwa z dnia 24 lutego 2006r. w sprawie
                    ustalania stanu przesyłek oraz postępowania reklamacyjnego
                    (Dz. U. z 2006 r. Nr 38, poz. 266.);
                  </li>
                  <li>
                    w zakresie Usług pocztowych: rozporządzenie Ministra
                    Administracji i Cyfryzacji w sprawie reklamacji usługi
                    pocztowej z dnia 26 listopada 2013 r. (Dz.U. z 2013 r. poz.
                    1468):
                  </li>
                </ol>

                <p>&nbsp;</p>

                <h4>Reklamacja zawiera:</h4>

                <ol>
                  <li>
                    imię i nazwisko nadawcy albo adresata albo nazwę oraz adres
                    do korespondencji albo adres siedziby nadawcy albo adresata,
                    zwanego dalej ,,reklamującym”;
                  </li>
                  <li>przedmiot reklamacji;</li>
                  <li>
                    datę i miejsce nadania przesyłki pocztowej albo przekazu
                    pocztowego;
                  </li>
                  <li>
                    numer dokumentu potwierdzającego nadanie lub numer przesyłki
                    pocztowej – w przypadku przesyłki rejestrowanej albo
                    przekazu pocztowego;
                  </li>
                  <li>uzasadnienie reklamacji;</li>
                  <li>
                    kwotę odszkodowania – w przypadku gdy reklamujący żąda
                    odszkodowania;
                  </li>
                  <li>
                    podpis reklamującego – w przypadku reklamacji wnoszonej w
                    postaci pisemnej;
                  </li>
                  <li>datę sporządzenia reklamacji;</li>
                  <li>wykaz załączonych dokumentów.</li>
                </ol>

                <h4>
                  Do reklamacji wnoszonej w postaci innej niż za pomocą środków
                  komunikacji elektronicznej należy dołączyć:
                </h4>

                <ol>
                  <li>
                    <p>
                      oryginał dokumentu potwierdzającego nadanie przesyłki
                      rejestrowanej lub przekazu pocztowego albo oryginał
                      pokwitowania nadania takiej przesyłki lub takiego
                      przekazu, jeżeli taki dokument jest wydawany przez
                      operatora pocztowego nadawcy – do wglądu;
                    </p>
                  </li>
                  <li>
                    <p>
                      oświadczenie nadawcy o zrzeczeniu się prawa do dochodzenia
                      roszczeń w przypadku jej złożenia przez inną osobę
                    </p>
                  </li>
                  <li>
                    <p>
                      kopię protokołu sporządzonego przez operatora pocztowego
                      bezpośrednio przy przyjęciu uszkodzonej przesyłki
                      rejestrowanej lub stwierdzonych ubytkach jej zawartości –
                      w przypadku przyjęcia tej przesyłki przez adresata – albo
                    </p>
                  </li>
                  <li>
                    <p>
                      oświadczenie o stwierdzonych ubytkach lub uszkodzeniach
                      przesyłki rejestrowanej złożone przez przyjmującego tę
                      przesyłkę bezpośrednio przy przyjęciu przesyłki;
                    </p>
                  </li>
                  <li>
                    <p>
                      opakowanie uszkodzonej przesyłki, jeżeli operator pocztowy
                      tego zażąda;
                    </p>
                  </li>
                  <li>
                    <p>
                      oświadczenie o stwierdzeniu niewidocznych ubytków lub
                      uszkodzeń przesyłki pocztowej, z zachowaniem terminu, wraz
                      ze wskazaniem okoliczności bądź dowodów potwierdzających
                      zaistnienie okoliczności warunkujących dochodzenie
                      odszkodowania, o których mowa w art.87 ust.6 ustawy;
                    </p>
                  </li>
                  <li>
                    <p>
                      przytoczenie okoliczności potwierdzających nadanie lub
                      doręczenie przesyłki pocztowej albo przekazu pocztowego
                      oraz wskazanie dowodów potwierdzających ten fakt;
                    </p>
                  </li>
                  <li>
                    <p>
                      dokumenty potwierdzające nienależyte wykonanie usługi
                      doręczenia przesyłek pocztowych
                    </p>
                  </li>
                </ol>

                <p>
                  Należy pamiętać, aby wskazać jak najwięcej informacji o
                  przesyłce, numer listu przewozowego, dane odbiorcy,
                  udokumentować przesyłkę za pomocą zdjęć.
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
                  Zadeklarowana wartość przesyłki nie może przewyższać jej
                  zwykłej wartości i na żądanie DHL powinna być potwierdzona
                  stosownymi dokumentami (np. faktury, rachunki). Jeżeli nie
                  zadeklarowano wartości przesyłki, przyjmuje się, że
                  zadeklarowana wartość wynosi 500 złotych. W przypadku Usługi
                  pocztowej deklaracja wartości przesyłki dokonywana jest
                  wyłącznie na potrzeby ubezpieczenia przesyłki i
                  <strong>nie wpływa na zakres odpowiedzialności DHL</strong>.
                </p>

                <p>
                  <strong
                    >Sąd Ochrony Konkurencji i Konsumentów wyrokiem z dnia&nbsp;
                    31.01.2008 r. uznał za niedozwolone i zakazał
                    wykorzystywania w obrocie z konsumentami</strong
                  >
                  postanowienia wzorca umownego o treści:<br />
                  ‘’Odpowiedzialność DHL Express z tytułu utraty, ubytku lub
                  uszkodzenia przesyłki jest ograniczona do kwoty 500 zł.’’
                </p>

                <p>
                  <strong
                    >Natomiast wyrokiem 9.09.2008 r. Sąd Ochrony Konkurencji i
                    Konsumentów uznał za niedozwolone i zakazał stosowania
                    klauzuli o treści</strong
                  >:<br />
                  „Jeżeli nadawca nie zadeklarował wartości przesyłki przyjmuje
                  się, że zadeklarowana wartość wynosi 500 zł i odpowiedzialność
                  DHL Express ograniczona jest jak w ust. 7".
                </p>
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
                  Reklamację można wnieść w każdej placówce DHL. Reklamację
                  można wnieść w formie pisemnej, elektronicznej na adresy
                  wskazane na stronie
                  <a href="http://www.dhlparcel.com.pl"
                    >http://www.dhlparcel.com.pl</a
                  >
                  albo ustnej do protokołu.
                </p>

                <p>
                  Adres:<br />
                  DHL Parcel Polska Sp. z o.o.<br />
                  Dział Reklamacji<br />
                  ul. Targowa 35<br />
                  90-043 Łódź
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
                <p>
                  DHL rozpatruje reklamację oraz odwołanie w terminie nie
                  dłuższym niż 30 dni od dnia ich otrzymania.
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
                  Nie spełniała wymogów, była zbyt mało szczegółowa, nie
                  wykazywała szkody w prawidłowy sposób. Zgłoszona po upływie
                  roku, złożona przez nieuprawnioną osobę.
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
                <p>DHL nie przyjmuje przesyłek zawierających:</p>

                <ul>
                  <li>
                    gotówkę, papiery wartościowe, inne dokumenty o charakterze
                    płatniczym;
                  </li>
                  <li>
                    przedmioty wartościowe (tj. wyroby jubilerskie, dzieła
                    sztuki, antyki, numizmatyki itp.);
                  </li>
                  <li>broń i amunicję;</li>
                  <li>wyroby pirotechniczne;</li>
                  <li>
                    artykuły szybko psujące się, wymagające specjalnych warunków
                    przewozu;
                  </li>
                  <li>towary chemicznie i biologicznie aktywne;</li>
                  <li>zwierzęta, szczątki ludzkie i zwierzęce;</li>
                  <li>narkotyki i substancje psychotropowe;</li>
                  <li>leki wymagające specjalnych warunków przewozu;</li>
                  <li>
                    inne towary, które swoimi właściwościami mogą stanowić
                    zagrożenie dla zdrowia osób mających z nimi styczność, bądź
                    mogące uszkodzić lub zniszczyć inne przesyłki;
                  </li>
                  <li>
                    towary, które podlegają ustawie z dnia 09.03.2017 r. o
                    systemie monitorowania drogowego przewozu towarów;
                  </li>
                  <li>
                    wyroby tytoniowe podlegające ustawie z dnia 05.07.2018 r. o
                    ochronie zdrowia przed następstwami używania tytoniu i
                    wyrobów tytoniowych;
                  </li>
                  <li>
                    inne towary, których przewóz jest zabroniony na podstawie
                    obowiązujących przepisów prawa.
                  </li>
                </ul>

                <p>
                  DHL nie przyjmuje do przewozu przesyłek, jeżeli naruszałoby to
                  przepisy prawa, a w szczególności Prawa przewozowego lub Prawa
                  pocztowego.
                </p>

                <p>
                  W przypadku nadania przesyłki, której DHL nie przyjmuje do
                  przewozu, Nadawca zobowiązany jest do naprawienia powstałej na
                  skutek tego szkody (w szczególności związanej ze skażeniem
                  środowiska) w pełnej wysokości.
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
                  W przypadku odmowy uznania reklamacji, uprawniony może wnieść
                  odwołanie w terminie 14 dni od dnia doręczenia odpowiedzi na
                  reklamację.
                </p>

                <p>
                  DHL nie ma możliwości uchylić się od odpowiedzialności
                  posługując się takimi postanowieniami uznanymi za zakazane
                  przez Sąd Ochrony Konkurencji i Konsumentów :
                </p>

                <ul>
                  <li>
                    zgodnie z wyrokiem z dnia 08.04.2008 r. ‘’DHL Express nie
                    ponosi odpowiedzialności za naruszenie opakowania jako
                    części rzeczy stanowiącej substancję przesyłki, jeśli
                    opakowanie to jest jedynym opakowaniem przesyłki a
                    uszkodzenie powstało jako normalne następstwo czynności
                    ładunkowych oraz innych czynności dokonanych przez
                    przewoźnika i związanych z wykonywaniem usług.’’
                  </li>
                  <li>
                    ‘’DHL Express nie ponosi odpowiedzialności za ubytek w
                    przesyłce w przypadku, gdy przesyłka została dostarczona do
                    Odbiorcy lub zwrócona do Nadawcy w nieuszkodzonym opakowaniu
                    zewnętrznym.’’ Wyrok z dnia 28.03.2008 r.
                  </li>
                </ul>

                <p>
                  Istnieje możliwość ugody lub sporu przed właściwym sądem
                  powszechnym.
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
  name: "ComplaintDhl",
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
