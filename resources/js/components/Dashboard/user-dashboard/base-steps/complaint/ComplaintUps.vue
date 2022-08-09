<template>
    <section>
        <v-row>
            <v-col cols="12" class="pa-5 mx-5">
                <h1 class="mb-5">Reklamacja - UPS</h1>
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
                                <div class="upslogo">ups</div>
                                <h3 class="text-center">
                                    Regulamin świadczenia Usług
                                </h3>
                                <p>
                                    <small
                                        >Otwórz w nowym oknie stronę UPS z
                                        aktualnymi regulaminami usług.</small
                                    >
                                </p>
                                <v-btn
                                    class="my-3"
                                    color="primary"
                                    small
                                    target="_blank"
                                    href="https://www.ups.com/pl/pl/help-center/legal-terms-conditions/service.page"
                                    >Przejdź do regulaminu »</v-btn
                                >
                            </ActionCard>
                            <ActionCard height="220" :big="true">
                                <div class="upslogo">ups</div>
                                <h3 class="text-center">
                                    UPS - Generator Reklamacji
                                </h3>
                                <p>
                                    <small
                                        >Otwórz w nowym oknie stronę UPS<br />z
                                        formularzem reklamacji.</small
                                    >
                                </p>
                                <v-btn
                                    class="my-3"
                                    color="primary"
                                    small
                                    target="_blank"
                                    href="https://www.ups.com/pl/pl/help-center/claims-support.page"
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
                                    Wg strony internetowej ups: Możesz rozpocząć
                                    procedurę reklamacyjną dla uszkodzonych lub
                                    zagubionych paczek:
                                </p>

                                <ol>
                                    <li>
                                        <b>Zagubienie</b>: Możesz wypełnić
                                        wniosek reklamacyjny dla paczki, jeżeli
                                        nie została dostarczona w ciągu 24
                                        godzin od spodziewanej daty i godziny
                                        dostawy. Przed wypełnieniem wniosku
                                        sprawdź wszystkie zewnętrzne drzwi i
                                        inne miejsca, w których paczka mogła
                                        zostać umieszczona: przedsionek, tylne
                                        patio, garaż i wszystkie inne miejsca
                                        wolne od działania czynników pogodowych.
                                        Porozmawiaj także z każdą osobą, która
                                        potencjalnie mogła odebrać paczkę. Jeśli
                                        wciąż nie możesz zlokalizować paczki,
                                        nadawca lub odbiorca może złożyć wniosek
                                        reklamacyjny;
                                    </li>
                                    <li>
                                        <b>Uszkodzenie</b>: Zarówno nadawca, jak
                                        i odbiorca przesyłki może zgłosić
                                        uszkodzoną paczkę, natomiast firma UPS
                                        zaleca, aby takie problemy zgłaszali
                                        nadawcy;
                                    </li>
                                </ol>
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
                                    <b>Kto składa?</b>: Reklamację składa
                                    nadawca (tj. strona umowy zawartej z UPS), a
                                    adresat wyłącznie w przypadku gdy:
                                </p>

                                <ul>
                                    <li>
                                        nadawca zrzeknie się na jego rzecz prawa
                                        dochodzenia roszczeń albo
                                    </li>
                                    <li>
                                        gdy została mu doręczona przesyłka
                                        kurierska albo
                                    </li>
                                    <li>
                                        gdy przysługuje mu prawo rozporządzania
                                        przesyłką inną niż przesyłka
                                        kurierska.<br />
                                        W zakresie zwrotu należności lub jej
                                        części z tytułu Usług dotyczących
                                        przesyłek innych niż przesyłki
                                        kurierskie reklamację składa nadawca
                                        albo odbiorca, w zależności od tego
                                        który z nich dokonał zapłaty. W
                                        indywidualnej umowie zawartej przez UPS
                                        z klientem, strony takiej umowy mogą
                                        przyznać prawo do złożenia reklamacji
                                        dotyczącej Gwarancji Zwrotu Pieniędzy
                                        innemu podmiotowi niż nadawca i adresat.
                                        W takim przypadku, do takiego podmiotu
                                        znają zastosowanie odpowiednio
                                        postanowienia dotyczące adresata.
                                    </li>
                                </ul>

                                <p>
                                    Sporządza się zawsze do celów reklamacyjnych
                                    protokół szkody.
                                </p>
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
                                    Wszelkie roszczenia przeciwko UPS muszą
                                    zostać zgłoszone na piśmie w możliwie jak
                                    najkrótszym terminie,
                                    <strong
                                        >jednakże nie dłuższym niż 14 dni od
                                        otrzymania w przypadku uszkodzenia (w
                                        tym częściowej utraty przesyłki), a w
                                        przypadku utraty, nie dłuższym niż 60
                                        dni od przekazania towarów UPS w celu
                                        ich transportu (przesyłkę uważa się za
                                        utraconą po 30 dniach od jej
                                        przewidywanego terminu
                                        doręczenia)</strong
                                    >. Ponadto, roszczenia z tytułu świadczenia
                                    Usług przedawniają się z upływem jednego
                                    roku. Termin, o którym mowa powyżej nie ma
                                    wpływu na prawa, jakie przysługują nadawcy
                                    zgodnie z Przepisami Konwencyjnymi lub
                                    innymi bezwzględnie obowiązującymi
                                    przepisami prawa. Szczegółowe zasady
                                    zgłaszania roszczeń są określone w
                                    procedurze reklamacyjnej.
                                </p>

                                <p>
                                    Ponadto, roszczenia z tytułu świadczenia
                                    Usług przedawniają się z upływem jednego
                                    roku. Termin, o którym mowa powyżej nie ma
                                    wpływu na prawa, jakie przysługują nadawcy
                                    zgodnie z Przepisami Konwencyjnymi lub
                                    innymi bezwzględnie obowiązującymi
                                    przepisami prawa. Szczegółowe zasady
                                    zgłaszania roszczeń są określone w
                                    procedurze reklamacyjnej.
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
                                    <li>datę sporządzenia reklamacji;</li>
                                    <li>
                                        imię i nazwisko (nazwę) i adres do
                                        korespondencji (siedziby) osoby
                                        składającej reklamację;
                                    </li>
                                    <li>
                                        przedmiot oraz uzasadnienie reklamacji;
                                    </li>
                                    <li>
                                        kwotę roszczenia (oddzielnie dla każdego
                                        dowodu nadania) chyba że wnoszący
                                        reklamację nie domaga się naprawienia
                                        szkody, oraz dokumentację potwierdzającą
                                        wysokość poniesionej szkody – za
                                        wyjątkiem sytuacji, gdy reklamacja
                                        dotyczy wyłącznie zwrotu opłat za
                                        przewóz w ramach Gwarancji Zwrotu
                                        Pieniędzy;
                                    </li>
                                    <li>datę i miejsce nadania przesyłki;</li>
                                    <li>numer przesyłki kurierskiej;</li>
                                    <li>wykaz załączonych dokumentów;</li>
                                    <li>
                                        podpis osoby uprawnionej do wniesienia
                                        reklamacji – w przypadku reklamacji
                                        zgłoszonej w formie papierowej, albo
                                        dane identyfikujące adresata w przypadku
                                        złożenia reklamacji w innej formie.
                                    </li>
                                </ol>

                                <p>Można dopisać:</p>

                                <ul>
                                    <li>
                                        <strong>Dane kontaktowe odbiorcy</strong
                                        >: W tym imię, nazwisko, numer telefonu
                                        i adres e-mail. W ten sposób firma UPS
                                        będzie mogła szybciej zgłosić się po
                                        dodatkowe dane, poinformować o zmianie
                                        statusu zgłoszenia lub dalszych etapach
                                        procedury reklamacyjnej.
                                    </li>
                                    <li><strong>Data odbioru</strong></li>
                                    <li>
                                        <strong>Waga paczki</strong> (tylko dla
                                        pojedynczych paczek)
                                    </li>
                                    <li>
                                        <strong
                                            >Opis problemu, wraz z
                                            fotografiami</strong
                                        >
                                    </li>
                                    <li>
                                        <strong
                                            >Liczba zagubionych lub uszkodzonych
                                            towarów</strong
                                        >
                                    </li>
                                    <li>
                                        <strong
                                            >Numery referencyjne/monitorowania
                                            paczki</strong
                                        >
                                    </li>
                                    <li>
                                        <strong>Wartość towaru i waluta</strong>
                                    </li>
                                </ul>

                                <p>&nbsp;</p>

                                <p>
                                    Do reklamacji powinny być dołączone,
                                    odpowiednio do przedmiotu roszczenia:
                                </p>

                                <ol>
                                    <li>
                                        dokumenty dotyczące zawarcia umowy (w
                                        szczególności dowód nadania, kopia
                                        faktury w przypadku płatności gotówką);
                                    </li>
                                    <li>
                                        inne dokumenty związane z rodzajem i
                                        wysokością roszczenia; Składa się
                                        oryginały lub kopie poświadczona przez
                                        UPC gdy forma papierowa.
                                    </li>
                                </ol>

                                <p>&nbsp;</p>

                                <p>
                                    Do reklamacji dotyczącej przesyłki
                                    kurierskiej powinny być, dodatkowo do
                                    dokumentów wskazanych w ust. 1, dołączone:
                                </p>

                                <ol>
                                    <li>
                                        oświadczenie nadawcy jeżeli zrzeka się
                                        swoich praw do dochodzenia roszczeń na
                                        rzecz adresata przesyłki kurierskiej;
                                    </li>
                                    <li>
                                        kopię
                                        <strong>protokołu</strong> sporządzonego
                                        przez UPS bezpośrednio przy przyjęciu
                                        uszkodzonej przesyłki kurierskiej lub
                                        stwierdzonych ubytkach w jej zawartości
                                        – w przypadku przyjęcia przesyłki
                                        kurierskiej przez adresata, albo
                                        oświadczenie przyjmującego przesyłkę
                                        kurierską o stwierdzonych ubytkach lub
                                        uszkodzeniach tej przesyłki złożone
                                        bezpośrednio przy przyjęciu
                                        przesyłki;<br />
                                        (Dokumenty z punktu 1 i 2 podpunkt 1 i 2
                                        powinny być złożone w oryginale lub
                                        kopii poświadczonej przez UPS – w
                                        przypadku reklamacji składanych w formie
                                        papierowej oraz w kopiach – w przypadku
                                        składania reklamacji w innej formie.
                                        Pozostałe dokumenty mogą być składane w
                                        kopiach. W celu prawidłowego
                                        rozpatrzenia reklamacji, UPS może w
                                        każdym czasie zażądać przekazania mu
                                        oryginałów takich dokumentów lub ich
                                        poświadczonych kopii. )
                                    </li>
                                    <li>
                                        oświadczenie o stwierdzeniu
                                        niewidocznych ubytków lub uszkodzeń
                                        przesyłki kurierskiej złożone w ciągu 7
                                        dni od przyjęcia przesyłki , wraz z
                                        przedstawieniem dowodów, że ubytki lub
                                        uszkodzenia przesyłki powstały w czasie
                                        między przyjęciem przesyłki przez UPS w
                                        celu wykonania usługi a jej doręczeniem
                                        adresatowi;
                                    </li>
                                    <li>
                                        przytoczenie okoliczności
                                        potwierdzających nadanie lub doręczenie
                                        przesyłki kurierskiej oraz wskazanie
                                        dowodów potwierdzających ten fakt.
                                    </li>
                                </ol>

                                <p>
                                    UPS ma prawo zażądać dołączenia do
                                    reklamacji składanej w formie pisemnej
                                    również opakowania przesyłki.
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
                                    O wysokości odszkodowania za poniesione
                                    straty decyduje realna wartość uszkodzonego
                                    towaru, na której udowodnienie powinniśmy
                                    przedstawić jakiś dokument, np. fakturę czy
                                    paragon.<br />
                                    Jeżeli uszkodzeniu uległ tylko jeden z
                                    elementów towaru, powinniśmy ubiegać się o
                                    odszkodowanie częściowe. Chyba że jesteśmy w
                                    stanie dowieść, że pozostały towar
                                    (nieuszkodzony) bez tego jednego elementu
                                    stał się bezużyteczny, wówczas możemy
                                    wnioskować o całościowe odszkodowanie.
                                </p>

                                <p>
                                    Co do zasady UPS wg ogólnych warunków
                                    świadczenia usług nie odpowiada w zakresie
                                    lucrum cessans, ani za szkody pośrednie lub
                                    wynikowe takie jak np. strata szans
                                    biznesowych. Nie ponosi także
                                    odpowiedzialności za szkodę dotyczącą
                                    opakowania lub jego utratę.
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
                                    W formie pisemnej, elektronicznej (w tym
                                    faksowej, na adres e-mail bądź poprzez
                                    wypełnienie formularza kontaktowego na
                                    stronie www.ups.com) lub ustnej do
                                    protokołu. Reklamacja z tytułu opóźnienia w
                                    doręczeniu przesyłki objętej Gwarancją
                                    Zwrotu Pieniędzy (w rozumieniu pkt 7
                                    Ogólnych Warunków Świadczenia Usług) może
                                    być także zgłoszona w formie telefonicznej
                                    do Działu Obsługi Klienta UPS i jest
                                    rozpatrywana w takim przypadku niezwłocznie
                                    także w formie telefonicznej. W przypadku
                                    nieuznania reklamacji telefonicznej w
                                    całości lub części, UPS udziela odpowiedzi
                                    na reklamację w formie pisemnej.
                                </p>

                                <p>
                                    Reklamację składa się na:<br />
                                    adres siedziby
                                    <strong
                                        >UPS Polska Sp. z o.o. ul. Prądzyńskiego
                                        1/3, 01-222 Warszawa</strong
                                    >
                                    lub
                                    <strong
                                        >siedziby lokalnych oddziałów
                                        UPS</strong
                                    >
                                    na terenie Polski lub adresy
                                    email:dipl@ups.com(reklamacja na zaginięcie
                                    i uszkodzenie), custsvcplpl@ups.com
                                    (nieterminowe doręczenie), faksem na numer:
                                    +48-22-534-08-01 oraz billingpoland@ups.com
                                    (reklamacje finansowe), a w odniesieniu do
                                    reklamacji dotyczących Gwarancji Zwrotu
                                    Pieniędzy – pod numerem + 48 22 534 00 00.
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
                                    UPS rozpatruje reklamację niezwłocznie.
                                    Termin udzielenia odpowiedzi na prawidłowo
                                    sporządzoną i zawierającą wszelkie wymagane
                                    dokumenty reklamację nie może przekroczyć 30
                                    dni od dnia otrzymania takiej reklamacji w
                                    odniesieniu do przesyłek krajowych (termin
                                    ten uważa się za zachowany jeżeli odpowiedź
                                    na reklamację zostanie wysłane w tym
                                    terminie).
                                </p>

                                <p>
                                    UPS wzywa reklamującego, aby usunął braki w
                                    terminie:
                                </p>

                                <ol>
                                    <li>
                                        7 dni od dnia otrzymania wezwania, w
                                        przypadku przesyłki kurierskiej, z
                                        pouczeniem reklamującego, że
                                        nieuzupełnienie braków w tym terminie
                                        spowoduje pozostawienie reklamacji bez
                                        rozpoznania;, powyższego terminu nie
                                        wlicza się do terminu rozpatrzenia
                                        reklamacji; albo
                                    </li>
                                    <li>
                                        14 dni, od dnia otrzymania wezwania, w
                                        przypadku innej przesyłki, z pouczeniem
                                        reklamującego, że za datę wniesienia
                                        reklamacji przyjmuje się datę otrzymania
                                        przez UPS uzupełnionej reklamacji.
                                    </li>
                                </ol>
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
                                    Reklamację zgłoszoną przez osobę
                                    nieuprawnioną traktuje się jak nie wniesioną
                                    o czym UPS powiadomi niezwłocznie
                                    reklamującego informując go o możliwości
                                    zgłoszenia reklamacji przez osobę
                                    uprawnioną.
                                </p>

                                <ul>
                                    <li>
                                        W przypadku jej niekompletności&nbsp;
                                        i&nbsp; nieuzupełnienia braków
                                        formalnych.
                                    </li>
                                    <li>Nie została wniesiona w terminie.</li>
                                </ul>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-ban"></i> &nbsp; 9. Kiedy
                                    UPS nie ponosi odpowiedzialności?
                                    (wyłączenia odpowiedzialności)?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    UPS opisuje warunki, rozmiary i zakazy
                                    dotyczące przesyłek w regulaminie.
                                </p>

                                <p>
                                    <i
                                        >UPS nie ponosi odpowiedzialności jeżeli
                                        niewykonanie lub nienależyte wykonanie
                                        usługi nastąpiło:</i
                                    >
                                </p>

                                <ol>
                                    <li>wskutek siły wyższej,</li>
                                    <li>
                                        z przyczyn występujących po stronie
                                        nadawcy lub odbiorcy, niewywołanych winą
                                        UPS,
                                    </li>
                                    <li>
                                        z powodu naruszenia prawa lub warunków
                                        przez nadawcę,
                                    </li>
                                    <li>z powodu właściwości przesyłki</li>
                                </ol>

                                <p>
                                    Chyba, że UPS popełniło czyn niedozwolony,
                                    działanie nastąpiło z winy umyślnej lub jest
                                    wynikiem rażącego niedbalstwa. W takich
                                    przypadkach UPS ponosi odpowiedzialność z
                                    KC.
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
                                    Każda reklamacja zawiera pouczenie o prawie
                                    odwołania od wydanej decyzji (wraz ze
                                    wskazaniem adresu na jaki należy złożyć
                                    odwołanie) lub wniesienia pozwu do
                                    właściwego miejscowo sądu, a w przypadku
                                    przesyłek kurierskich o możliwości
                                    dochodzenia roszczeń również w postępowaniu
                                    mediacyjnym przed Prezesem Urzędu
                                    Komunikacji Elektronicznej, albo przed
                                    stałym polubownym sądem konsumenckim przy
                                    Prezesie Urzędu Komunikacji Elektronicznej.
                                </p>

                                <p>
                                    W przypadku odmowy uwzględnienia reklamacji
                                    dotyczącej krajowych przesyłek kurierskich w
                                    całości lub w części, reklamujący może
                                    wnieść odwołanie do UPS w terminie
                                    <strong>14 dni od jej doręczenia</strong>.
                                    UPS rozpoznaje takie odwołanie niezwłocznie
                                    i informuje reklamującego o wyniku
                                    rozpatrzenia odwołania w terminie nie
                                    dłuższym niż 30 dni od dnia otrzymania
                                    takiego odwołania. Informacja o wyniku
                                    rozpatrzenia odwołania powinna również
                                    zawierać pouczenie o wyczerpaniu drogi
                                    postępowania reklamacyjnego i prawie
                                    dochodzenia odszkodowania w postępowaniu
                                    sądowym, albo mediacyjnym przed Prezesem
                                    Urzędu Komunikacji Elektronicznej albo przed
                                    stałym polubownym sądem konsumenckim przy
                                    Prezesie Urzędu Komunikacji Elektronicznej.
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
    name: 'ComplaintUps',
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
