<template>
  <section>
    <v-row>
      <v-col cols="12" class="pa-5 mx-5">
        <h1 class="mb-5">Reklamacja - GLS</h1>
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
                <div class="glslogo">GLS</div>
                <h3 class="text-center">Regulamin świadczenia Usług</h3>
                <p>
                  <small
                    >Otwórz w nowym oknie stronę GLS z aktualnymi regulaminami
                    usług.</small
                  >
                </p>
                <v-btn
                  class="my-3"
                  color="primary"
                  small
                  target="_blank"
                  href="https://gls-group.eu/PL/pl/regulamin"
                  >Przejdź do regulaminu »</v-btn
                >
              </ActionCard>
              <ActionCard height="220" :big="true">
                <div class="glslogo">GLS</div>
                <h3 class="text-center">GLS - Generator Reklamacji</h3>
                <p>
                  <small
                    >Uruchom generator dokumentu reklamacji GLS.<br />&nbsp;</small
                  >
                </p>
                <v-btn
                  class="my-3"
                  color="primary"
                  small
                  href="https://google.pl"
                  >Wygeneruj Reklamację »</v-btn
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
                  Odpowiedzialność GLS za niewykonanie lub nienależyte wykonanie
                  usługi powstaje z chwilą zobowiązania się GLS do świadczenia
                  usług, są to w szczególności przypadki:
                </p>
                <ul>
                  <li>
                    <strong>Zwłoki w jej doręczeniu</strong>, zasadą jest
                    doręczenie najpóźniej w ciągu następnego dnia roboczego po
                    dniu nadania paczki krajowej, nie później jednak niż w ciągu
                    trzech dni roboczych po dniu nadania paczki. Zatem po tym
                    dniu można stwierdzić zwłokę GLS chyba, że wystąpił wyjątek
                    np. w przypadku przyjęcia ustnej dyspozycji zmiany miejsca
                    dostawy, a także w sytuacji, przyjęcia przez GLS przesyłki
                    mimo niespełniania warunków regulaminu (pkt. VI ust. 1. lit.
                    d niewłaściwe opakowanie paczki), w takim przypadku nadawca
                    bierze na siebie odpowiedzialność wynikającą z tego powodu i
                    powodującą uszkodzenie, ubytek zawartości oraz opóźnienie w
                    jej dostarczeniu;
                  </li>
                  <li>
                    <strong>Zagubienia przesyłki</strong>. Za utraconą uważa się
                    paczkę, która nie została doręczona odbiorcy bądź
                    upoważnionej osobie trzeciej w terminie 30 dni od dnia jej
                    przyjęcia przez GLS do dostarczenia;
                  </li>
                  <li>
                    <strong>Niekompletność paczki</strong>, ale GLS nie
                    odpowiada za paczki, której wagi lub liczby sztuk w niej
                    zawartej nie sprawdzał, otwierał od chwili przyjęcia od
                    nadawcy, jeżeli dostarczy ją bez śladów naruszenia trwałych
                    elementów opakowania np. plomby;
                  </li>
                  <li>
                    <strong
                      >Uszkodzenie, ubytek paczki i/lub jej zawartości</strong
                    >. Jeśli dotyczy sytuacji przed dostarczeniem odbiorcy
                    należy wtedy sporządzić protokół szkodowy może to zrobić
                    kurier lub pracownik. Inną sytuacją jest kwestia wręczenia
                    odbiorcy uszkodzonej paczki, wtedy odbiorca ma prawo żądać
                    sporządzenia protokołu szkodowego i otrzymać jego kopie.v<br /><br />
                  </li>
                </ul>
                <p>
                  Roszczenia wygasają wskutek przyjęcia paczki bez zastrzeżeń,
                  oprócz niewidocznych w chwili wydania ubytków lub uszkodzeń
                  zgłoszonych na piśmie przez odbiorcę do GLS nie później niż w
                  ciągu 7 dni od przyjęcia paczki. W tym przypadku klient ma
                  prawo żądać sporządzenia protokołu w obecności przedstawiciela
                  GLS, musi on ponadto udowodnić, że uszkodzenie nastąpiło
                  podczas przewozu przez GLS.
                </p>
                <p>
                  W bazie rejestru klauzul niedozwolonych znajduje się klauzula,
                  którą sąd uznał za niedozwoloną i zakazał jej wykorzystywania
                  przez pozwanego w obrocie z konsumentami w postanowieniach
                  wzorca umowy o treści:<br />
                  ’’Sklep nie ponosi odpowiedzialności za uszkodzenia przesyłki
                  powstałe na skutek działania poczty lub firm kurierskich.’’
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
                <ol>
                  <li>
                    <strong>klient</strong> (wg słowniczka w regulaminie
                    odpowiednio nadawca lub odbiorca - zazwyczaj osoba, która
                    zleciła i opłaciła usługę kurierską)
                  </li>
                  <li>
                    jeżeli z reklamacją występuje inna osoba niż klient, powinna
                    ona dołączyć dokument przelewu praw, albo pełnomocnictwo.
                    Nie dotyczy to zakładu ubezpieczeń występującego wobec GLS z
                    roszczeniem zwrotnym.
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
                <p>W zależności od opisanych poniżej przypadków.</p>
                <p>
                  Obligatoryjnym warunkiem złożenia reklamacji jest zgłoszenie
                  zastrzeżeń, istnieją dwie możliwości.
                </p>
                <ul>
                  <li>
                    Pierwsza to sporządzenie protokołu szkody przez osobę
                    upoważnioną np. kuriera GLS bezpośrednio podczas odbioru
                    paczki.
                  </li>
                  <li>
                    Druga możliwość istnieje właśnie wtedy, gdy przesyłka
                    zawierała uszkodzenia/ubytki niewidoczne w chwili wydania.
                  </li>
                </ul>
                <p>&nbsp;</p>
                <p>
                  Roszczenia z tytułu
                  <strong
                    >niewidocznych w chwili wydania ubytków lub uszkodzeń
                    paczki</strong
                  >, są aktualne tylko w przypadku ich zgłoszenia GLS Poland
                  przez odbiorcę (lub nadawcę w przypadku zwrotu paczki).
                  Powinny być <strong>złożone na piśmie</strong>, nie później
                  niż w ciągu <strong>siedmiu (7) dni</strong> od dnia przyjęcia
                  paczki, pod warunkiem jednak, że klient udowodni, że do szkody
                  doszło w czasie od przyjęcia paczki przez GLS do chwili jej
                  wydania odbiorcy. W takim przypadku sporządza się protokół
                  szkodowy, który jest potrzebny do zgłoszenia reklamacji.
                </p>
                <p>
                  <strong
                    >Reklamacje z tytułu niewykonania lub nienależytego
                    wykonania umowy</strong
                  >
                  może składać wyłącznie klient (lub osoba upoważniona przez
                  klienta jw. ), w terminie
                  <strong>trzydziestu (30) dni</strong>>, a w razie
                  <strong
                    >utraty paczki – w terminie czterdziestu pięciu (45)
                    dni</strong
                  >
                  licząc od dnia przyjęcia przesyłki przez GLS Poland do
                  przemieszczania, jednak nie później niż w terminie 12 miesięcy
                  od dnia nadania przesyłki.
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
                <p>Reklamacja powinna zawierać:</p>
                <ol type="a">
                  <li>
                    oznaczenie firmy, siedziby i adresu reklamującego oraz numer
                    rachunku bankowego, na który należy przesłać ewentualne
                    odszkodowanie,
                  </li>
                  <li>kwotę roszczenia wraz z uzasadnieniem,</li>
                  <li>
                    odpowiednie dokumenty uzasadniające wysokość roszczenia
                    (oryginał faktury VAT zakupu lub kopia potwierdzona za
                    zgodność z oryginałem, kalkulacja kosztów wytworzenia, inne
                    dokumenty potwierdzające wysokość roszczenia),
                  </li>
                  <li>kopię potwierdzenia nadania,</li>
                  <li>
                    kopię protokołu o stanie przesyłki/kopię protokołu szkody.
                    GLS Poland może zażądać od reklamującego dodatkowych
                    dokumentów koniecznych do rozpatrzenia reklamacji, w
                    szczególności dokumentacji zdjęciowej.
                  </li>
                </ol>
                <p>
                  W przypadku, gdy wyżej wymienione dokumenty okażą się
                  niewystarczające do rozpoznania reklamacji ze względu na ich
                  jakość lub treść, GLS Poland może zażądać od reklamującego
                  dodatkowych dokumentów związanych z rodzajem i wysokością
                  roszczenia. Jeżeli reklamację wniosła osoba nieuprawniona,
                  albo reklamacja nie odpowiada warunkom określonym powyżej, GLS
                  Poland wezwie reklamującego do jej uzupełnienia. Terminy w
                  czasie którego reklamacja ma być rozpatrzona przez GLS tj. 30
                  dni ulega zawieszeniu do czasu uzupełnienia reklamacji przez
                  reklamującego.
                </p>
                <p>Dodatkowo:</p>
                <ul>
                  <li>
                    jeśli posiadasz dokumentację zdjęciową paczki, zdjęcia
                    wykonane przed wysłaniem, zdjęcia uszkodzenia paczki, dołącz
                    je do reklamacji,
                  </li>
                  <li>
                    w przypadku reklamacji wnoszonej w postaci pisemnej
                    reklamację podpisz odręcznie;
                  </li>
                  <li>
                    w przypadku uszkodzenia paczki jeśli była ona pakowana w
                    materiały operacyjne pochodzące od GLS, wpisz o tym uwagę do
                    reklamacji;
                  </li>
                  <li>
                    jeśli regularnie wysyłasz takie paczki i są one zawsze w ten
                    sam sposób solidnie zapakowane i do tej pory nie dochodziło
                    do żadnych uszkodzeń, wpisz o tym uwagę do reklamacji;
                  </li>
                </ul>
                <p>
                  Dnia 16.06.2010 r. Sąd OKiK wydał wyrok w którym uznaje za
                  niedozwolone i zakazuje wykorzystywania w obrocie z
                  konsumentami postanowień wzorca umowy o treści: „GLS Poland
                  zastrzega sobie prawo żądania innych dokumentów niezbędnych do
                  zamknięcia postępowania reklamacyjnego, w szczególności
                  przesłania dowodu uiszczenia opłaty za wykonanie Usługi.”, tak
                  samo jak postanowienie - „Wniesienie reklamacji nie zwalnia
                  klienta z obowiązku zapłaty należności z tytułu świadczenia
                  przez GLS usług i usług dodatkowych oraz opłat i dopłat.”,
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
                  W obrocie krajowym, ( z zastrzeżeniem ust. 6 regulaminu)
                  wysokość odszkodowania za utratę lub ubytek paczki nie może
                  przewyższać zwykłej wartości rzeczy zawartych w paczce, chyba
                  że do szkody doszło wskutek winy umyślnej, rażącego
                  niedbalstwa lub czynu niedozwolonego GLS Poland. Wartości
                  rzeczy ustala się na podstawie i w następującej kolejności:
                </p>
                <ol type="1">
                  <li>ceny określonej w fakturze (rachunku) zakupu,</li>
                  <li>
                    ceny wynikającej z oficjalnego cennika obowiązującego w dniu
                    przyjęcia paczki do przemieszczenia,
                  </li>
                  <li>
                    wartości rzeczy tego samego rodzaju i gatunku w czasie i w
                    miejscu przyjęcia Paczki przez GLS Poland do
                    przemieszczania.
                  </li>
                </ol>
                <p>
                  W przypadku szkody w obrocie krajowym w walucie obcej,
                  odszkodowanie zostanie obliczone wg średniego kursu NBP tej
                  waluty z dnia nadania paczki. W obrocie międzynarodowym
                  odpowiedzialność GLS Poland za utratę lub ubytek Paczki nie
                  może przewyższać kwoty 8.33 SDR za każdy kilogram brakującej
                  wagi brutto, jednakże nie więcej niż rzeczywista wartość
                  paczki, chyba że do szkody doszło wskutek winy umyślnej,
                  rażącego niedbalstwa lub czynu niedozwolonego GLS Poland.
                  Przeliczenie powyższej kwoty na złote następuje według
                  średniego kursu NBP z dnia nadania paczki do przemieszczania.
                </p>
                <p>
                  W razie uszkodzenia paczki odszkodowanie ustala się w
                  wysokości odpowiadającej procentowemu zmniejszeniu się jej
                  wartości.
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
                  Reklamacje należy składać
                  <strong>na piśmie</strong>, na adres siedziby GLS Poland
                  <strong>lub drogą elektroniczną</strong> za pośrednictwem
                  systemu ADE+.
                </p>
                <p>
                  Drogą e-mailową na adres:
                  <a href="mailto:reklamacje@gls-poland.com"
                    >reklamacje@gls-poland.com</a
                  >.
                </p>
                <p>
                  Adres na który należy składać reklamację na piśmie:<br />
                  General Logistics Systems Poland Sp. z o. o.<br />
                  ul. Tęczowa 10,<br />
                  62-052 Głuchow
                </p>

                <p>
                  Możesz skorzystać z opracowanego przez nas generatora
                  reklamacji<br />
                  <v-btn
                    class="my-3"
                    color="primary"
                    small
                    href="https://google.pl"
                    >przejdź do generatora</v-btn
                  >
                </p>

                <p>
                  Do system ADE+ można się zalogować ze strony:
                  <a href="https://adeplus.gls-poland.com/adeplus/lm/index.php"
                    >https://adeplus.gls-poland.com/adeplus/lm/index.php</a
                  >.
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
                  Reklamacja powinna być rozpatrzona w terminie
                  <strong>30 dni</strong> licząc od dnia wniesienia reklamacji.
                </p>
                <p>
                  Termin ten może ulec wydłużeniu:<br />
                  Jeżeli reklamację wniosła osoba nieuprawniona, albo reklamacja
                  nie odpowiada określonym warunkom, GLS Poland wezwie
                  reklamującego do jej uzupełnienia. Termin, na rozpatrzenie
                  reklamacji ulega zawieszeniu do czasu uzupełnienia reklamacji
                  przez reklamującego.
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
                  Reklamacje z tytułu niewykonania lub nienależytego wykonania
                  umowy może składać wyłącznie klient. Reklamacje złożone przez
                  inne osoby bez upoważnienia zostaną im zwrócone. Ponadto może
                  być to również reklamacja, która nie została uzupełniona w
                  przypadku braków lub wniesiona po terminie.
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
                <p>
                  W pkt. V znajduje się lista rzeczy wyłączonych z przewozu:
                </p>
                <p>
                  <i
                    >GLS Poland nie przyjmuje do przemieszczania i doręczenia
                    Paczek zawierających:</i
                  >
                </p>
                <ol type="a">
                  <li>
                    rzeczy, których przemieszczanie jest zabronione na podstawie
                    przepisów prawa lub umów, konwencji czy porozumień
                    międzynarodowych, których stroną jest Polska,
                  </li>
                  <li>
                    rzeczy wyłączone z przewozu lotniczego na mocy
                    obowiązujących przepisów prawa w przypadku przemieszczania
                    kombinowanego lotniczo – drogowego,
                  </li>
                  <li>
                    gotówkę, znaki pieniężne, bony towarowe lub inne dokumenty
                    płatnicze, czeki, karty płatnicze lub kredytowe, druki
                    akcyzy, papiery wartościowe, metale lub kamienie szlachetne
                    oraz wyroby z nich, wyroby jubilerskie, dzieła sztuki lub
                    wyroby o wartości artystycznej, antyki, jak i inne rzeczy,
                    których wartość wynika z ich wieku, rzadkości lub cech
                    subiektywnych, przedmioty numizmatyczne lub zbiory
                    filatelistyczne, znaki legitymacyjne, w tym bilety, dowody
                    rejestracyjne lub związane z nimi naklejki,
                  </li>
                  <li>
                    dokumenty przetargowe, oferty handlowe, dokumenty księgowe,
                  </li>
                  <li>
                    telekomunikacyjne karty typu prepaid oraz aktywacyjne lub
                    inne o podobnych funkcjach,
                  </li>
                  <li>
                    rzeczy przewożone na podstawie dokumentu odprawy celnej
                    czasowej bądź na podstawie karnetu ATA,
                  </li>
                  <li>
                    przedmioty, dla których wymagane jest oznakowanie znakami
                    akcyzy,
                  </li>
                  <li>rzeczy przewożone pod plombą celną,</li>
                  <li>żywe zwierzęta lub rośliny,</li>
                  <li>towary wymagające temperatury kontrolowanej,</li>
                  <li>
                    rzeczy łatwo psujące się lub środki spożywcze w rozumieniu
                    Ustawy o bezpieczeństwie żywności i żywienia,
                  </li>
                  <li>
                    produkty lecznicze w rozumieniu ustawy Prawo farmaceutyczne,
                    komponenty do produkcji produktów leczniczych, narkotyki
                    oraz substancje psychotropowe i halucynogenne, z wyjątkiem
                    wysyłanych w celach naukowo-badawczych przez instytucje do
                    tego uprawnione na mocy odrębnych przepisów prawa, z
                    zastrzeżeniem zgody GLS Poland na wykonanie takiej Usługi,
                  </li>
                  <li>
                    rzeczy wymagające specjalistycznych badań fitosanitarnych,
                  </li>
                  <li>
                    materiały łatwopalne lub wybuchowe, substancje żrące oraz
                    inne towary wymienione w Konwencji ADR, broń lub amunicję,
                  </li>
                  <li>
                    susz tytoniowy w rozumieniu ustawy o akcyzie lub alkohol
                    skażony,
                  </li>
                  <li>opony w obrocie międzynarodowym,</li>
                  <li>zwłoki i szczątki zwłok ludzkich lub zwierzęcych,</li>
                  <li>
                    organy ludzkie lub zwierzęce, płyny ustrojowe oraz produkty
                    metabolizmu ludzkiego lub zwierzęcego,
                  </li>
                  <li>rzeczy osobiste lub mienie przesiedleńcze,</li>
                  <li>instrumenty muzyczne smyczkowe lub szarpane,</li>
                  <li>
                    rzeczy, których właściwości mogą stanowić zagrożenie dla
                    ludzi bądź narażać inne Paczki na zniszczenie, uszkodzenie,
                    zabrudzenie, itp.,
                  </li>
                  <li>
                    towary wymagające zachowania szczególnych warunków przy ich
                    przemieszczaniu lub składowaniu (np. przewożenia w
                    określonej pozycji np. poziomo, szkło, ceramika, telewizory,
                    części nadwozia samochodowego, inne towary delikatne),
                  </li>
                  <li>
                    produkty pochodzenia zwierzęcego o których mowa w
                    Rozporządzeniu Komisji (WE) nr 206/2009 z 5 marca 2009 r.,
                  </li>
                  <li>
                    rzeczy lub paczki, których wysyłanie jest zakazane na
                    podstawie jakichkolwiek obowiązujących sankcji prawnych, na
                    przykład z powodu ich zawartości, ze względu na odbiorcę lub
                    państwo do którego lub z którego mają zostać wysłane.
                  </li>
                </ol>
                <p>
                  GLS nie przyjmuje także paczek adresowanych na numery skrytek
                  pocztowych i miejsc wskazujący na tymczasowość adresu m.in.
                  domy studenckie.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-file-excel"></i> &nbsp; 10. Kiedy GLS nie
                  ponosi odpowiedzialności? (wyłączenia odpowiedzialności)
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>
                  GLS Poland nie ponosi odpowiedzialności za niewykonanie lub
                  nienależyte wykonanie usługi jeżeli doszło do niego:
                </p>
                <ol>
                  <li>wskutek działania siły wyższej,</li>
                  <li>
                    z przyczyn występujących po stronie nadawcy lub odbiorcy,
                    lub osoby trzeciej, którą te osoby się posługiwały, nie
                    wywołanych winą GLS ,
                  </li>
                  <li>
                    z powodu właściwości rzeczy nadanych do przemieszczenia,
                  </li>
                  <li>
                    z powodu naruszenia przez nadawcę lub odbiorcę przepisów
                    prawa powszechnie obowiązującego lub postanowień regulaminu.
                  </li>
                </ol>
                <p>
                  GLS wskazuje także na odpowiedzialność nadawcy w pkt. X, m.in.
                  dotyczącą kwestii prawidłowego opakowania przesyłki i
                  zgodności zawartości deklarowanej z rzeczywistą.
                </p>
              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header>
                <h2>
                  <i class="fa fa-file-excel"></i> &nbsp; 11. Co jeśli moja
                  reklamacja została odrzucona?
                </h2>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <p>
                  W zakresie nieuregulowanym w regulaminie, w odniesieniu do
                  przesyłek kurierskich zastosowanie znajdą właściwe przepisy
                  Prawa pocztowego i aktów wykonawczych wydanych na podstawie
                  ustawy Prawo pocztowe oraz właściwe przepisy Prawa
                  przewozowego i Rozporządzenia MTiB w sprawie ustalania stanu
                  przesyłek oraz postępowania reklamacyjnego – w odniesieniu do
                  paczek towarowych.
                </p>
                <p>
                  Spory wynikające z umowy i regulaminu rozpatrywane będą przede
                  wszystkim na drodze polubownej między klientem a GLS Poland, w
                  przypadku niemożności polubownego rozwiązania sporu między
                  stronami, spór może być zakończony ugodą w drodze postępowania
                  mediacyjnego przed Prezesem UKE, a w ostateczności przez sądy
                  powszechne właściwe miejscowo według przepisów ogólnych.
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
  name: "ComplaintGls",
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
