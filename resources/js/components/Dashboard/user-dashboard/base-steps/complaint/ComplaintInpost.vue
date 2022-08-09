<template>
    <section>
        <v-row>
            <v-col cols="12" class="pa-5 mx-5">
                <h1 class="mb-5">Reklamacja - InPost</h1>
                <p>
                    Na <b>nadawcy</b> przesyłki spoczywa kilka
                    <b>obowiązków</b>, których spełnienie umożliwi
                    <b>skuteczniejsze dochodzenie odszkodowania.</b>
                </p>
                <ul>
                    <li>
                        Pierwszym z takich obowiązków jest obowiązek
                        <b>zapoznania się z regulaminem</b> firmy transportowej.
                    </li>
                    <li>
                        Drugim obowiązkiem nadawcy (odbiorcy) jest dokonanie
                        szeregu czynności przed wysłaniem i w trakcie odbioru
                        przesyłki.
                    </li>
                </ul>
                <p class="mb-5">
                    Pozwoli to na złożenie reklamacji w sposób, jaki przewiduje
                    to regulamin firmy.
                </p>
                <v-row class="d-flex justify-center align-center">
                    <v-col class="complaintlinks" cols="12" md="6">
                        <h2 class="mb-5">
                            Gdzie znajdę regulamin i procedurę reklamacji?
                        </h2>
                        <v-row>
                            <ActionCard height="220" :big="true">
                                <div class="inpostlogo">InPost</div>
                                <h3 class="text-center">
                                    Regulamin świadczenia Usług
                                </h3>
                                <p>
                                    <small
                                        >Otwórz w nowym oknie stronę InPost z
                                        aktualnymi regulaminami usług.</small
                                    >
                                </p>
                                <v-btn
                                    class="my-3"
                                    color="primary"
                                    small
                                    target="_blank"
                                    href="https://inpost.pl/regulaminy"
                                    >Przejdź do regulaminów »</v-btn
                                >
                            </ActionCard>
                            <ActionCard height="220" :big="true">
                                <div class="inpostlogo">InPost</div>
                                <h3 class="text-center">
                                    InPost - Formularz Reklamacji
                                </h3>
                                <p>
                                    <small
                                        >Otwórz w nowym oknie stronę InPost<br />z
                                        formularzem reklamacji.<br />&nbsp;</small
                                    >
                                </p>
                                <v-btn
                                    class="my-3"
                                    color="primary"
                                    small
                                    target="_blank"
                                    href="https://inpost.pl/kontakt/zloz-reklamacje"
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
                                    <i class="fa fa-calendar"></i> &nbsp; 1.
                                    Kiedy mogę składać reklamację?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    Usługę uważa się za niewykonaną w
                                    szczególności w przypadku utraty
                                    (zagubienia, całkowitego zniszczenia)
                                    przesyłki lub, gdy doręczenie Przesyłki albo
                                    zawiadomienie o próbie jej doręczenia
                                    nastąpiło po upływie 30 dni od dnia nadania.
                                    Usługę uważa się za nienależycie wykonaną w
                                    szczególności w przypadku:
                                </p>

                                <ol>
                                    <li>
                                        opóźnienia w doręczeniu Przesyłki w
                                        stosunku do gwarantowanego terminu; po
                                        14 dniach roboczych, chyba, że umowa
                                        określa inny termin
                                    </li>
                                    <li>
                                        uszkodzenia lub ubytku zawartości
                                        Przesyłki;
                                    </li>
                                    <li>
                                        wykonania usługi niezgodnie ze zleceniem
                                        oraz przepisami Prawa pocztowego lub
                                        Prawa przewozowego (w zależności czy
                                        chodzi o wykonanie Usługi pocztowej, czy
                                        Usługi przewozowej).
                                    </li>
                                </ol>

                                <p>
                                    Roszczenie z tytułu nienależytego wykonania
                                    Usługi pocztowej wygasa wskutek przyjęcia
                                    Przesyłki kurierskiej
                                    <strong>bez zastrzeżeń</strong>, chyba że
                                    ubytki lub uszkodzenia Przesyłki niedające
                                    się z zewnątrz zauważyć uprawniony
                                    stwierdził po przyjęciu Przesyłki i
                                    <strong
                                        >nie później niż po upływie 7
                                        dni</strong
                                    >
                                    od przyjęcia Przesyłki zgłosił Operatorowi
                                    roszczenie z tego tytułu oraz
                                    <strong>udowodnił</strong>, że ubytki lub
                                    uszkodzenia Przesyłki powstały w czasie
                                    między przyjęciem Przesyłki przez Operatora
                                    w celu wykonania Usługi, a jej doręczeniem
                                    Odbiorcy.
                                </p>

                                <p>
                                    Roszczenie z tytułu ubytku lub uszkodzenia
                                    Przesyłki towarowej wygasa wskutek przyjęcia
                                    Przesyłki towarowej bez zastrzeżeń, chyba
                                    że:
                                </p>

                                <ol>
                                    <li>
                                        szkodę stwierdzono protokolarnie przed
                                        przyjęciem Przesyłki towarowej przez
                                        Odbiorcę;
                                    </li>
                                    <li>
                                        zaniechano takiego stwierdzenia z winy
                                        Operatora;
                                    </li>
                                    <li>
                                        ubytek lub uszkodzenie wynikło z winy
                                        umyślnej lub rażącego niedbalstwa
                                        Operatora;
                                    </li>
                                    <li>
                                        szkodę niedającą się z zewnątrz zauważyć
                                        Odbiorca stwierdził po przyjęciu
                                        Przesyłki towarowej i w terminie 7 dni
                                        zażądał ustalenia jej stanu oraz
                                        udowodnił, że szkoda powstała w czasie
                                        między przyjęciem Przesyłki towarowej do
                                        przewozu a jej wydaniem.
                                    </li>
                                </ol>

                                <p>
                                    W przypadku odbioru uszkodzonej przesyłki,
                                    reklamacja powinna być uznana gdy nie
                                    zachodzą pewne okoliczności np. wyłączające
                                    jego odpowiedzialność z par. 11.2.
                                </p>

                                <p>
                                    Niedoręczoną Przesyłkę uważa się za
                                    utraconą, jeżeli doręczenie lub
                                    zawiadomienie o próbie jej doręczenia lub
                                    możliwości odebrania w Punkcie Obsługi
                                    Paczki lub Oddziale nie nastąpiło
                                    <strong
                                        >w terminie 30 dni od dnia jej
                                        nadania</strong
                                    >.
                                </p>

                                <p>
                                    Z zastrzeżeniem przepisów bezwzględnie
                                    obowiązujących oraz obowiązujących zasad
                                    dotyczących składania reklamacji (§ 14
                                    Regulaminu), wszelkie zastrzeżenia dotyczące
                                    wykonania Usług lub stanu Przesyłki powinny
                                    zostać opisane przez Odbiorcę w chwili
                                    przyjęcia Przesyłki na stosowanych przez
                                    Operatora potwierdzeniach odbioru Przesyłki.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-user-edit"></i> &nbsp; 2.
                                    Kto może złożyć reklamację?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    W przypadku niewykonania lub nienależytego
                                    wykonania usługi
                                    <strong
                                        >prawo wniesienia reklamacji
                                        przysługuje</strong
                                    >:
                                </p>

                                <ol>
                                    <li>Nadawcy;</li>
                                    <li>
                                        Odbiorcy - w przypadku gdy Nadawca
                                        zrzeknie się na jego rzecz prawa
                                        dochodzenia roszczeń albo gdy Przesyłka
                                        została doręczona Odbiorcy.
                                    </li>
                                </ol>
                            </v-expansion-panel-content>
                        </v-expansion-panel>

                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-clock"></i> &nbsp; 3. Ile
                                    mam czasu na złożenie reklamacji?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    Reklamacja może zostać wniesiona nie później
                                    niż w terminie 12 miesięcy od dnia nadania
                                    przesyłki.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-list"></i> &nbsp; 4. Co jest
                                    potrzebne do zgłoszenia reklamacji?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>Reklamacja powinna zawierać:</p>

                                <ol>
                                    <li>
                                        imię i nazwisko nadawcy albo adresata
                                        albo nazwę oraz adres do korespondencji
                                        albo adres siedziby nadawcy albo
                                        adresata, zwanego dalej "reklamującym";
                                    </li>
                                    <li>przedmiot reklamacji;</li>
                                    <li>datę i miejsce nadania Przesyłki;</li>
                                    <li>
                                        numer dokumentu potwierdzającego nadanie
                                        lub numer Przesyłki;
                                    </li>
                                    <li>uzasadnienie reklamacji;</li>
                                    <li>
                                        kwotę odszkodowania -w przypadku gdy
                                        reklamujący żąda odszkodowania;
                                    </li>
                                    <li>
                                        podpis reklamującego -w przypadku
                                        reklamacji wnoszonej w postaci pisemnej;
                                    </li>
                                    <li>datę sporządzenia reklamacji;</li>
                                    <li>wykaz załączonych dokumentów.</li>
                                </ol>

                                <p>
                                    W przypadku złożenia reklamacji w formie
                                    pisemnej reklamujący dołącza:
                                </p>

                                <ol>
                                    <li>potwierdzenie nadania;</li>
                                    <li>
                                        oświadczenie Nadawcy o zrzeczeniu się
                                        prawa do dochodzenia roszczeń (jeśli się
                                        zrzekł)
                                    </li>
                                    <li>kopię protokołu, albo</li>
                                    <li>
                                        oświadczenie o stwierdzonych ubytkach
                                        lub uszkodzeniach Przesyłki złożone
                                        przez przyjmującego tę przesyłkę
                                        bezpośrednio przy przyjęciu Przesyłki;
                                    </li>
                                    <li>
                                        przytoczenie okoliczności
                                        potwierdzających nadanie lub doręczenie
                                        Przesyłki;
                                    </li>
                                    <li>
                                        opakowanie uszkodzonej przesyłki, jeżeli
                                        Operator tego zażąda;
                                    </li>
                                    <li>
                                        oświadczenie o stwierdzeniu
                                        niewidocznych ubytków lub uszkodzeń
                                        Przesyłki, z zachowaniem terminu
                                    </li>
                                    <li>
                                        dokumenty potwierdzające nienależyte
                                        wykonanie usługi doręczenia Przesyłki
                                        –do wglądu.
                                    </li>
                                </ol>

                                <p>
                                    Do reklamacji wniesionej za pomocą środków
                                    komunikacji elektronicznej należy dołączyć
                                    kopie dokumentów o których mowa w
                                    Regulaminie. Jeżeli jest to niezbędne dla
                                    prawidłowego rozpatrzenia reklamacji,
                                    Operator może zażądać przekazania mu
                                    oryginałów tych dokumentów.
                                </p>

                                <p>
                                    Oryginały dokumentów są zwracane
                                    reklamującemu za pokwitowaniem, w każdej
                                    chwili na jego wniosek. W przypadku braku
                                    wniosku Operator zwraca je najpóźniej po
                                    zakończeniu postępowania reklamacyjnego.
                                </p>

                                <p>
                                    W przypadku stwierdzenia przez Operatora
                                    niespełniania przez reklamację wymogów, gdy
                                    ich spełnienie jest konieczne do
                                    prawidłowego rozpatrzenia reklamacji,
                                    Operator wezwie reklamującego do usunięcia
                                    braków w terminie 14 dni od dnia doręczenia
                                    wezwania, na wskazany adres w wezwaniu.
                                    Termin ten nie wlicza się do terminu
                                    rozpatrzenia reklamacji.
                                </p>

                                <p>
                                    Za odpowiednio zamknięte, wytrzymałe i
                                    zabezpieczone wewnętrznie zapakowanie paczki
                                    odpowiada Nadawca.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-money-bill-alt"></i> &nbsp;
                                    5. Jak oszacować realną stratę?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    Wskazana przez Nadawcę (Zleceniodawcę)
                                    wartość Przesyłki nie może przewyższać jej
                                    zwykłej wartości i powinna być potwierdzona
                                    stosownymi dowodami (np. faktury, rachunki
                                    lub inne dokumenty). W przypadku Nadawców
                                    niebędących Konsumentami, rzeczy i
                                    jakiekolwiek materiały o wartości
                                    przekraczającej kwotę 200 zł (słownie:
                                    dwieście złotych) lub których utrata czy
                                    uszkodzenie mogłyby powodować powstanie
                                    roszczenia przewyższającego tę kwotę nie
                                    mogą być wysyłane w Przesyłkach innych niż
                                    Przesyłka z wykupioną usługą ubezpieczenia.
                                    W przypadku niewykupienia usługi
                                    ubezpieczenia Przesyłki przez Nadawcę
                                    (Zleceniodawcę), wszelką odpowiedzialność
                                    Operatora związaną ze świadczeniem Usługi
                                    pocztowej lub Usługi przewozowej ogranicza
                                    się
                                    <b>do kwoty 200 zł</b>.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-plane"></i> &nbsp; 6. W jaki
                                    sposób mogę złożyć reklamację?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    Nadawca albo Odbiorca mogą zgłosić
                                    reklamację w każdej placówce Operatora w
                                    formie
                                    <strong
                                        >pisemnej lub ustnie do protokołu oraz
                                        elektronicznie</strong
                                    >
                                    do Działu Reklamacji Operatora pod linkiem
                                    <a
                                        href="https://inpost.pl/kontakt/zloz-reklamacje"
                                        >https://inpost.pl/kontakt/zloz-reklamacje</a
                                    >.
                                </p>

                                <p>
                                    InPost S.A., ul. Wielicka 28, 30-552 Kraków,
                                    z dopiskiem Dział Reklamacji.<br />
                                    Dzwoniąc na Infolinię InPost pod numerem
                                    <em>722 444 000</em> lub
                                    <em>746 600 000</em>.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-hourglass"></i> &nbsp; 7.
                                    Ile trwa rozpatrzenie reklamacji?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    Operator rozpatruje reklamację niezwłocznie
                                    i udziela odpowiedzi na reklamację w
                                    terminie nie dłuższym niż 30 dni od dnia
                                    otrzymania reklamacji.
                                </p>

                                <p>
                                    Termin uważa się za zachowany, jeżeli
                                    Operator w tym terminie nadał (wysłał)
                                    odpowiedź na reklamację.<br />
                                    W przypadku wniesienia reklamacji drogą
                                    elektroniczną ze wskazaniem adresu poczty
                                    elektronicznej przez reklamującego
                                    właściwego dla odpowiedzi, oznacza to zgodę
                                    na doręczanie pism dot. reklamacji drogą
                                    elektroniczną na wskazany adres poczty
                                    elektronicznej.
                                </p>

                                <p>
                                    Nieudzielenie przez Operatora odpowiedzi na
                                    reklamację w terminie skutkuje uznaniem
                                    reklamacji w granicach jego
                                    odpowiedzialności.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-calendar-times"></i> &nbsp;
                                    8. Dlaczego moja reklamacja została uznana
                                    za niebyłą?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    W przypadku złożenia odwołania od
                                    rozstrzygnięcia w sprawie reklamacji po
                                    upływie wyznaczonego terminu pozostawia się
                                    je bez rozpoznania, o czym Operator pocztowy
                                    niezwłocznie powiadamia reklamującego.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-ban"></i> &nbsp; 9. Jakich
                                    rzeczy nie wolno przesyłać i gdzie?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    <strong
                                        >Niedopuszczalne jest umieszczanie w
                                        przesyłce</strong
                                    >
                                    przedmiotów zakazanych przez obowiązujące
                                    prawo m.in. pocztowe, a także zgodnie z
                                    regulaminem:
                                </p>

                                <ol>
                                    <li>
                                        przedmiotów pochodzących z przestępstwa;
                                    </li>
                                    <li>
                                        pieniędzy, papierów wartościowych,
                                        innych dokumentów o charakterze
                                        płatniczym;
                                    </li>
                                    <li>
                                        przedmiotów wartościowych (wyrobów
                                        jubilerskich, dzieł sztuki, antyków,
                                        numizmatyki itp.);
                                    </li>
                                    <li>
                                        broni, na zakup i posiadanie której
                                        wymagane jest pozwolenie, rejestracja
                                        lub karta rejestracyjna, zgodnie z
                                        powszechnie obowiązującymi przepisami
                                        prawa, w tym zgodnie z ustawą z dnia 21
                                        maja 1999 r. o broni i amunicji broni,
                                        amunicji i innych materiałów wybuchowych
                                        lub łatwopalnych (w tym broni w
                                        rozumieniu art. 4 ust. 1 ustawy z dnia
                                        21 maja 1999 r. o broni i amunicji z
                                        wyłączeniem: pistoletów hukowych,
                                        startowych i alarmowych oraz amunicji do
                                        tych pistoletów, o ile nie są bronią
                                        palną w rozumieniu tej ustawy oraz, o
                                        ile Nadawca dostarczy Operatorowi przed
                                        nadaniem takiej Przesyłki wymagane przez
                                        ww. ustawę dokumenty oraz spełni
                                        pozostałe warunki realizacji takiej
                                        usługi);
                                    </li>
                                    <li>
                                        amunicji, z wyłączeniem amunicji hukowej
                                        o kalibrze do 6 mm;
                                    </li>
                                    <li>
                                        rzeczy chemicznie i biologicznie
                                        aktywnych;
                                    </li>
                                    <li>
                                        środków o właściwościach wybuchowych,
                                        łatwopalnych, utleniających,
                                        drażniących, żrących, uczulających,
                                        rakotwórczych, mutagennych oraz
                                        działających szkodliwie na rozrodczość,
                                        mogących spowodować zagrożenie dla
                                        zdrowia, życia ludzkiego lub szkody
                                        majątkowe u Operatora;
                                    </li>
                                    <li>
                                        innych rzeczy, które swoimi
                                        właściwościami mogą stanowić zagrożenie
                                        dla zdrowia osób mających z nimi
                                        styczność, bądź mogących uszkodzić lub
                                        zniszczyć inne Przesyłki;
                                    </li>
                                    <li>
                                        narkotyków, substancji psychotropowych
                                        oraz nowych substancji psychoaktywnych
                                        tzw. „dopalaczy”;
                                    </li>
                                    <li>artykułów szybko psujących się;</li>
                                    <li>
                                        produktów i artykułów wymagających
                                        szczególnych warunków transportu (w tym
                                        wydzielających woń lub płyn);
                                    </li>
                                    <li>
                                        martwych lub żywych zwierząt i roślin;
                                    </li>
                                    <li>
                                        zwłok ludzkich, organów ludzkich lub
                                        zwierzęcych;
                                    </li>
                                    <li>
                                        wyroby tytoniowe, w tym tytoń oraz
                                        papierosy, e-papierosy oraz ich części;
                                    </li>
                                </ol>

                                <p>
                                    przy czym powyższe wyliczenie nie ma
                                    charakteru wyczerpującego.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>

                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-file-excel"></i> &nbsp; 10.
                                    Co jeśli moja reklamacja została odrzucona?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    W przypadku odmowy uznania reklamacji w
                                    całości lub w części reklamujący może wnieść
                                    odwołanie w terminie 14 dni od dnia
                                    doręczenia odpowiedzi na reklamację.
                                </p>

                                <p>
                                    Dochodzenie roszczeń w postępowaniu sądowym
                                    dotyczącym Usługi przewozowej przysługuje
                                    uprawnionemu po bezskutecznym wyczerpaniu
                                    drogi reklamacji.
                                </p>

                                <p>
                                    W przypadku wyczerpania drogi postępowania
                                    reklamacyjnego konsument może skorzystać z
                                    pozasądowej możliwości rozwiązywania sporów
                                    drogą elektroniczną za pośrednictwem
                                    internetowej platformy ODR, która umożliwia
                                    dochodzenie swoich roszczeń w związku z
                                    Usługą. Platforma ODR dostępna jest pod
                                    adresem:
                                    http://ec.europa.eu/consumers/odr/.<br />
                                    W sprawach dotyczących reklamacji Usługi
                                    pocztowej, nieuregulowanych w niniejszym
                                    paragrafie 14, stosuje się przepisy Prawa
                                    pocztowego oraz rozporządzenia Ministra
                                    Administracji i Cyfryzacji z dnia 26
                                    listopada 2013 r. w sprawie reklamacji
                                    usługi pocztowej (Dz. U. z 2018 r. poz.
                                    421).
                                </p>

                                <p>
                                    W sprawach dotyczących reklamacji Usługi
                                    przewozowej stosuje się postanowienia
                                    paragrafu 14 z zastrzeżeniem postanowień
                                    rozporządzenia Ministra Transportu i
                                    Budownictwa z dnia 24 lutego 2006 r. w
                                    sprawie ustalania stanu przesyłek oraz
                                    postępowania reklamacyjnego (Dz.U. 2006 nr
                                    38 poz. 266)
                                </p>

                                <p>
                                    W sprawach nieuregulowanych w Regulaminie
                                    stosuje się przepisy odpowiednio: Prawa
                                    pocztowego (dotyczy Usług Pocztowych), Prawa
                                    przewozowego (dotyczy Usług Przewozowych)
                                    oraz przepisy Kodeksu cywilnego.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                    <p>
                        <small
                            >Ostatnia aktualizacja treści: 20.01.2020. Jeśli
                            uważasz, że powyższa treść nie jest już aktualna
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
import ActionCard from '../../start-actions/ActionCard'

export default {
    name: 'ComplaintInpost',
    components: {
        ActionCard,
    },
}
</script>

<style scoped>
.background-grey {
    padding: 25px;
    background: #f2f2f2;
    width: 100%;
}
</style>
