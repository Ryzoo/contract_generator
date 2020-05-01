<?php

$paragraf=1;

$nid = arg(1);
$trySID = (int)arg(3);

$stack = debug_backtrace();
$firstFrame = $stack[count($stack) - 1];
$initialFile = $firstFrame['file'];

include_once './includes/bootstrap.inc';
//drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

if ($trySID>0) {

  $ssid = $trySID;

} else {

  ini_set('display_errors', 1);
  $query = "SELECT MAX(sid) AS mmax FROM webform_submissions WHERE nid=".$nid;
  $result = db_query($query);
  foreach ($result as $record) {
    $ssid=$record->mmax;
  }
}

include_once(drupal_get_path('module', 'webform') .'/includes/webform.submissions.inc');
$subff = webform_get_submission($nid, $ssid);

$tabelaWyposaz = array ("alufelgi" => "alufelg", "autoalarm" => "autoalarmu", "autoskrzynia" => "automatycznej skrzyni biegów", "bagadach" => "bagażnika dachowego", "bocznetylpoduszki" => "bocznych tylnych poduszek gazowych", "centralny" => "centralnego zamka", "cisnienieopony" => "czujników ciśnienia w oponach", "czujnikdeszczu" => "czujników deszczu", "martwepole" => "czujników martwego pola", "parkowania" => "czujników parkowania", "zmierzchu" => "czujników zmierzchu", "panorama" => "dachu panoramicznego", "dywanikiguma" => "dywaników gumowych", "dywanikiwelur" => "dywaników welurowych", "elefotel" => "elektrycznie ustawianych foteli", "elelusterka" => "elektrycznych lusterek bocznych", "eleszybyf" => "elektrycznych szyb przednich", "eleszybyr" => "elektrycznych szyb tylnich", "aux" => "gniazda AUX", "sd" => "gniazda SD", "usb" => "gniazda USB", "grill" => "grilla przedniego", "halogeny" => "halogenowych lamp", "przeciwmgnielne" => "halogenów przeciwmgielnych", "hud" => "HUD", "immo" => "immobilizera ", "isofix" => "isofixa", "kameracof" => "kamery cofania", "klimatronic" => "klimatronica", "autoklima" => "klimatyzacji automatycznej", "klimamanual" => "klimatyzacji manualnej", "klimapolauto" => "klimatyzacji półautomatycznej ", "kompas" => "kompasu", "kompoklad" => "komputera pokładowego", "ksenony" => "ksenonowych lamp", "kurtyny" => "kurtyn powietrznych", "lampkiczyt" => "lampek do czytania", "lopatzmianybieg" => "łopatek zmiany biegów", "cd" => "odtwarzacza CD", "mp3" => "odtwarzacza MP3", "tape" => "odtwarzacza TAPE", "oslonyprzednie" => "osłon pod zderzakiem przednim", "oslonytylnie" => "osłon pod zderzakiem tylnym", "podgrzeprzod" => "podgrzewania siedzeń przednich", "podgrzetyl" => "podgrzewania siedzeń tylnych", "podgrzelust" => "podgrzewanych lusterek bocznych", "podgrzeszyby" => "podgrzewanych szyb", "podlokietbocznef" => "podłokietników przednich bocznych", "podlokietprzednie" => "podłokietników przednich centralnych", "podlokietboczner" => "podłokietników tylnich bocznych", "polokiettylnie" => "podłokietników tylnich centralnych", "podgazpasaz" => "poduszek gazowych pasażerów", "podgazkier" => "poduszki gazowej kierowcy", "eco" => "przełącznika właściwości jezdnych z trybem ECO PRO", "ciemneszyby" => "przyciemnych szyb", "radianiefab" => "radia niefabrycznego", "radiafab" => "radia wbudowanego", "regulzawiesz" => "regulowanego zawieszenia", "relingi" => "relingów dachowych", "roleta" => "rolety bagażnika", "samosciemlust" => "samościemniających się lusterek", "dzielonesiedz" => "siedzeń tylnych dzielonych", "spoiler" => "spoilera tylnego", "spryskiwaczeref" => "spryskiwaczy reflektorów", "szybhhydro" => "szyb hydrofobowych", "szybtermo" => "szyb termicznych", "szberdach" => "szyberdachu", "skora" => "tapicerki skórzanej", "tempomat" => "tempomatu", "termowew" => "termometru temperatury wewnętrznej", "termozew" => "termometru temperatury zewnętrznej", "tv" => "tunera TV", "webasto" => "webasto", "wielofunkier" => "wielofunkcyjnej kierownicy", "wspomaganie" => "wspomagania kierownicy", "wycieraczkiprzed" => "wycieraczek przednich", "wycieraczkityl" => "wycieraczki tylnej ", "hakprzod" => "zaczepu  holowniczego przedniego", "haktyl" => "zaczepu holowniczego tylnego", "zegaraanalog" => "zegara analogowego", "zegarcyfra" => "zegara cyfrowego", "zintegrfotdzieci" => "zintegrowanych siedzeń dla dzieci", "zaluzja" => "żaluzji dla przestrzeni bagażowej");

$tabelaTechno = array ("abs" => "ABS (system zapobiegania blokowaniu kół)", "aeb" => "AEB (autonomiczny system hamowania awaryjnego)", "asr" => "ASR (system kontroli trakcji)", "asyspark" => "asystent parkowania", "asyspasa" => "asystent pasa ruchu", "asysholder" => "asystent ruszania na wzniesieniach", "autohold" => "auto hold ", "autoswiatla" => "automatyczne światła", "ba" => "BA (system wspomagania hamowania awaryjnego)", "bluetooth" => "bluetooth ", "bsd" => "BSD (system monitujący martwe pole)", "cbc" => "CBC (system kontrolujący siłę hamowania poszczególnych kół)", "dbc" => "DBC&HAC (system wspomagania zjazdu i wjazdu pod górę)", "dsr" => "DSR (system podpowiadający ruchy kierownicy)", "ebd" => "EBD (system rozdzielający siłę hamowania)", "ebv" => "EBV (korektor siły hamowania)", "edc" => "EDC (system dozowania paliwa)", "eds" => "EDS (elektroniczna blokada mechanizmu różnicowego)", "epb" => "EPB (elektryczny hamulec postojowy)", "esc" => "ESC (system elektronicznej kontroli stabilności)", "esp" => "ESP (system stabilizujący tor jazdy)", "ess" => "ESS (dynamiczne światło stop)", "flex" => "Flex Steer", "followme" => "follow me home", "hba" => "HBA (zwiększenie ciśnienia w przewodach hamulcowych)", "inetlialarm" => "inteligentne połączenie alarmowe ", "keyless" => "Key Less Go", "lkas" => "LKAS (system utrzymywania na pasie ruchu)", "msr" => "MSR (system przeciwdziałający poślizgowi kół napędowych w czasie hamowania silnikiem)", "gps" => "nawigacja GPS", "kers" => "odzysk energii hamowania", "speedlimit" => "ogranicznik prędkości", "sight" => "pakiet sight", "rcta" => "RCTA (system monitorowania ruchu poprzecznego przy cofaniu)", "racelogic" => "selektor trybów jazdy", "slif" => "SLIF (system informacji o znakach ograniczenia prędkości)", "spas" => "SPAS (system inteligentnego parkowania)", "speedinfo" => "Speed Limit Info", "domykdrzwi" => "system domykania drzwi", "dowszakret" => "system doświetlania zakrętów", "starstop" => "system Start-Stop", "tpms" => "TPMS (system ostrzegania o niskim ciśnieniu w oponach)", "trc" => "TRC (system kontroli trakcji)", "tsa" => "TSA (system stabilizujący tor jazdy z przyczepą)", "conecteddrive" => "usługi Conected Drive");

$tabelaDodatkow = array ("apteczka" => "apteczkę", "gasnica" => "gaśnicę przeciwpożarową", "zapas" => "koło zapasowe", "letnie" => "komplet opon letnich", "zimowe" => "komplet opon zimowych", "zarowki" => "komplet żarówek zamiennych", "lewarek" => "lewarek", "ladowarka" => "ładowarkę samochodową", "trojkat" => "trójkąt ostrzegawczy z homologacją", "uchwyt" => "uchwyt na telefon", "kluczyki" => "zapasowy komplet kluczyków");

$liczbaOsobObciaz = count($subff->data[54]);

$tabelaStanu  = array ("niekompletny" => "jest niekompletny — brakuje", "uszkodzony" => "jest poważnie uszkodzony", "wypadek" => "jest po wypadku", "naprawa" => "wymaga pilnej naprawy, bez której jazda samochodem stwarza zagrożenie w ruchu drogowym", "wyposazenie" => "nie posiada wyposażenia wymaganego prawem", "cele" => "nie jest dostosowany zgodnie z prawem do celów, jakie ma spełniać", "dokumentacja" => "nie posiada dokumentacji w postaci", "badania" => "nie posiada badań w postaci");

$tabelaObciazSprzed = array ("sprowadzenie" => "załatwienie formalności związanych ze sprowadzeniem samochodu zza granicy", "tlumaczenie" => "dokonanie tłumaczeń zagranicznych dokumentów", "oplaty" => "uiszczenie wszystkich należności publicznoprawnych wymaganych przy sprowadzaniu samochodu zza granicy;", "dostawa" => "dostarczenie przedmiotu sprzedaży do miejsca wskazanego przez Kupującego", "rozliczenie" => "przyjęcie w rozliczeniu samochodu");

$tabelaObciazKupu = array ("rejestracja" => "dokonanie rejestracji samochodu", "oplaty" => "uiszczenie należności publicznoprawnych", "naprawy" => "dokonanie wymaganych napraw i wymian we własnym zakresie");

include_once('sites/all/libraries/zlotowy/zloty.php');

$liczbaTekst = array(1 => "jednym", 2 => "dwóch", 3 => "trzech", 4 => "czterech", 5 => "pięciu", 6 => "sześciu", 7 => "siedmiu", 8 => "ośmiu", 9 => "dziewięciu", 10 => "dziesięciu", 11 => "jedenastu", 12 => "dwunastu", 13 => "trzynastu", 14 => "czternastu", 15 => "piętnastu", 16 => "szesnastu", 17 => "siedemnastu", 18 => "osiemnastu", 19 => "dziewiętnastu", 20 => "dwudzistu", 21 => "dwudziestu jeden", 22 => "dwudziestu dwuch", 23 => "dwudziestu trzech", 24 => "dwudziestu czterech", 25 => "dwudziestu pięciu", 26 => "dwudziestu sześciu", 27 => "dwudziestu siedmiu", 28 => "dwudziestu ośmiu", 29 => "dwudziestu dziewięciu", 30 => "trzydziestu", 31 => "trzydziestu jeden", 32 => "trzydziestu dwuch", 33 => "trzydziestu trzech", 34 => "trzydziestu czterech", 35 => "trzydziestu pięciu", 36 => "trzydziestu sześciu");

$tabelaDokumentow = array ("dr" => "dowód rejestracyjny", "kp" => "kartę pojazdu", "gwars" => "kartę gwarancyjną samochodu", "gwari" => "inne karty gwarancyjne w postaci:", "ks" => "książkę serwisową", "io" => "instrukcję obsługi", "lpg" => "dokumenty dotyczące instalacji LPG", "aku" => "dokumenty dotyczące akumulatora", "cert" => "certyfikaty w postaci:", "obez" => "wyciąg z warunków ubezpieczenia", "oc" => "polisę OC", "ac" => "polisę AC", "tlu" => "tłumaczenia następujących dokumentów:", "inne" => "inne dokumenty w postaci:");

$odstKupujacy = array ("wadyfizyczne" => "wykonywania uprawnień z rękojmi za wady fizyczne", "wadyprawne" => "wykonywania uprawnień z rękojmi za wady prawne", "podatki" => "ukrycia przed Kupującym konieczności uiszczenia dodatkowych należności publicznoprawnych", "kraj" => "wprowadzenia Kupującego w błąd co do kraju pierwszej rejestracji przedmiotu sprzedaży", "dokumenty" => "nieprzekazania Kupującemu wszystkich potrzebnych dokumentów", "przestepstwo" => "stwierdzenia, że przedmiot sprzedaży pochodzi z przestępstwa", "uszkodzenia" => "uszkodzenia lub utraty przedmiotu sprzedaży, w okresie do chwili przeniesienia jego własności na Kupującego", "kredyt" => "odmowy udzielenia kredytu przez bank, który miał sfinansować cenę", "inne" => "w innych przypadkach naruszenia istotnych postanowień niniejszej Umowy przez Sprzedawcę");

$tabelaKar1 = array("odbior1" => "zwłoki Kupującego w odebraniu  przedmiotu sprzedaży w sposób ustalony  zgodnie z § 7", "zwrot2" => "zwłoki Kupującego w zwrocie przedmiotu sprzedaży w przypadku odstąpienia od Umowy przez którąkolwiek ze Stron", "kontakt3" => "wskazania przez Kupującego nieprawdziwych danych kontaktowych, uniemożliwiający kontakt pomiędzy Stronami w celu wykonania Umowy", "odstapieniesprzeda4" => "odstąpienia przez Sprzedawcę od Umowy z przyczyn leżących po Stronie Kupującego", "odstapieniekupuj5" => "odstąpienia przez Kupującego od Umowy z przyczyn niezależnych od Sprzedawcy", "poufnosc6" => "naruszenia poufności niniejszej Umowy");

$tabEndKar1 = array("odbior1" => " za każdy dzień zwłoki", "zwrot2" => " za każdy dzień zwłoki");

$tabelaKar2 = array("wydnanie1" => "zwłoki Sprzedawcy w wydaniu  przedmiotu sprzedaży w sposób ustalony  zgodnie z § 7", "dokumenty2" => "zwłoki Sprzedawcy w wydaniu  dokumentów wskazanych w § 7", "przedmioty3" => "zwłoki Sprzedawcy w wydaniu przedmiotów dodatkowych wskazanych w § 1 ust. 4", "odciazenie4" => "zwłoki Sprzedawcy w odciążeniu przedmiotu sprzedaży w sposób ustalony  zgodnie z § 2 ust. 3", "wady5" => "zwłoki Sprzedawcy w usuwaniu wady przedmiotu sprzedaży (przy świadczeniach niepieniężnych)", "zwrot6" => "zwłoki Sprzedawcy w zwrocie samochodu pozostawionego w rozliczeniu w przypadku odstąpienia od Umowy przez którąkolwiek ze Stron", "podatki7" => "wprowadzenia Kupującego w błąd co do istniejących należności publicznoprawnych", "dg8" => "wprowadzenia Kupującego w błąd co do wcześniejszego wykorzystywania przedmiotu sprzedaży w działalności gospodarczej", "licznik9" => "wprowadzenia Kupującego w błąd co do cofania licznika", "aso10" => "wprowadzenia Kupującego w błąd co do serwisowania w ASO", "kraj11" => "wprowadzenia Kupującego w błąd co do kraju pierwszej rejestracji", "bezwypadkowosc12" => "wprowadzenia Kupującego w błąd co do bezwypadkowości przedmiotu sprzedaży", "tuning13" => "wprowadzenia Kupującego w błąd co do tego, że samochód był przerabiany lub poddawany tuningowi", "oc14" => "wprowadzenia Kupującego w błąd co do opłacenia ubezpieczenia", "stan15" => "pogorszenia stanu przedmiotu sprzedaży do chwili wydania go Kupującemu", "zniszczenie16" => "zniszczenia lub utraty przedmiotu sprzedaży do chwili wydania go Kupującemu", "przestepstwo17" => "stwierdzenia, że przedmiot sprzedaży pochodzi z przestępstwa", "kontakt18" => "wskazania przez Sprzedawcę nieprawdziwych danych kontaktowych, uniemożliwiający kontakt pomiędzy Stronami w celu wykonania Umowy", "odstkup19" => "odstąpienia przez Kupującego od Umowy z przyczyn leżących po Stronie Sprzedawcy", "odstsprz20" => "odstąpienia przez Sprzedawcę od Umowy z przyczyn niezależnych od Kupującego", "poufnosc21" => "naruszenia poufności niniejszej Umowy");

$tabEndKar2 = array("wydnanie1" => " za każdy dzień zwłoki", "dokumenty2" => " za każdy dzień zwłoki", "przedmioty3" => " za każdy dzień zwłoki", "odciazenie4" => " za każdy dzień zwłoki", "wady5" => " za każdy dzień zwłoki", "zwrot6" => " za każdy dzień zwłoki");

$tabReprezentacji = array("wspolnik" => "wspólnikiem", "prezesem" => "prezesem zarządu", "wice" => "wiceprezesem zarządu", "czlonkiem" => "członkiem zarządu", "pelnomocnikiem" => "pełnomocnikiem", "prokurentem" => "prokurentem", "kuratorem" => "kuratorem", "komplementariuszem" => "komplementariuszem", "partnerem" => "partnerem");



?>
<h1 style="text-align: center;">UMOWA SPRZEDAŻY</h1>

<p style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">zawarta w dniu <?php echo date("d.m.Y", strtotime($subff->data[257][0])); ?>r. w [submission:values:miejsce:nolabel], pomiędzy:</p>

<?php

// ---------------------------------------------------- SPRZEDAJĄCY ----------------------------------------------------- //

if ($subff->data[41][0] == 'osfizyczna') {

  for ($j=0; $j<count($subff->data[329]);$j++) {
    if ($subff->data[276][$j] == 'pan') {
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">Panem '.$subff->wfm_data[329][261][303][$j][394][0].' zamieszkałym: '.$subff->wfm_data[283][261][303][$j][253][0].' '.$subff->wfm_data[281][261][303][$j][252][0].' przy ul. '.$subff->wfm_data[282][261][303][$j][251][0].'  '.$subff->wfm_data[278][261][303][$j][386][0].', wydanym przez '.$subff->wfm_data[279][261][303][$j][387][0].', posługującym się numerem PESEL '.$subff->wfm_data[288][261][303][$j][306][0].',</p>';
      if (count($subff->data[329])==1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwanego w dalszej części „<b>Sprzedawcą</b>”,</p>';
    } else {
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">Panią '.$subff->wfm_data[329][261][303][$j][394][0].' zamieszkałą: '.$subff->wfm_data[283][261][303][$j][253][0].' '.$subff->wfm_data[281][261][303][$j][252][0].' przy ul. '.$subff->wfm_data[282][261][303][$j][251][0].', legitymującą się dowodem osobistym numer '.$subff->wfm_data[278][261][303][$j][386][0].', wydanym przez '.$subff->wfm_data[279][261][303][$j][387][0].', posługującą się numerem PESEL '.$subff->wfm_data[288][261][303][$j][306][0].',</p>';
      if (count($subff->data[329])==1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Sprzedawcą</b>”,</p>';
    }

    if ($j<count($subff->data[329])-1) echo '<p style="text-align:justify; font-size:40px; margin:0; padding:0;">i</p>';
  }

  if (count($subff->data[329])>1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwanymi w dalszej części „<b>Sprzedawcą</b>”,</p>';
}


if ($subff->data[41][0] == 'dg') {

  for ($j=0; $j<count($subff->data[364]);$j++) {

    if ($subff->data[333][$j] == 'pan') {
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">Panem '.$subff->wfm_data[364][261][332][$j][385][0].' zamieszkałym: '.$subff->wfm_data[343][261][332][$j][253][0].' '.$subff->wfm_data[341][261][332][$j][252][0].' przy ul. '.$subff->wfm_data[342][261][332][$j][251][0].', legitymującym się dowodem osobistym numer '.$subff->wfm_data[338][261][332][$j][386][0].', wydanym przez '.$subff->wfm_data[339][261][332][$j][387][0];
      if ($subff->data[320][0] == 'indywidualnie') echo ', prowadzącym działalność gospodarczą indywidualnie pod firmą: '.$subff->data[273][0].', z siedzibą '.$subff->data[267][0].' '.$subff->data[266][0].' przy ul. '.$subff->data[265][0].', wpisanym do centralnej ewidencji i informacji o działalności gospodarczej, posługującym się numerami: NIP '.$subff->data[268][0].' oraz REGON '.$subff->data[269][0];
      echo ',</p>';
      if (count($subff->data[364])==1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwanego w dalszej części „<b>Sprzedawcą</b>”,</p>';
    } else {
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">Panią '.$subff->wfm_data[364][261][332][$j][385][0].' zamieszkałą: '.$subff->wfm_data[343][261][332][$j][253][0].' '.$subff->wfm_data[341][261][332][$j][252][0].' przy ul. '.$subff->wfm_data[342][261][332][$j][251][0].', legitymującą się dowodem osobistym numer '.$subff->wfm_data[338][261][332][$j][386][0].', wydanym przez '.$subff->wfm_data[339][261][332][$j][387][0];
      if ($subff->data[320][0] == 'indywidualnie') echo ', prowadzącą działalność gospodarczą indywidualnie pod firmą: '.$subff->data[273][0].', z siedzibą '.$subff->data[267][0].' '.$subff->data[266][0].' przy ul. '.$subff->data[265][0].', wpisaną do centralnej ewidencji i informacji o działalności gospodarczej, posługującą się numerami: NIP '.$subff->data[268][0].' oraz REGON '.$subff->data[269][0];
      echo ',</p>';
      if (count($subff->data[364])==1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Sprzedawcą</b>”,</p>';
    }

    if ($j<count($subff->data[364])-1) echo '<p style="text-align:justify; font-size:40px; margin:0; padding:0;">i</p>';
  }

  if ($subff->data[320][0] != 'indywidualnie') echo '<p style="text-align:justify; font-size:40px; line-height:60px;">prowadzącymi działalność gospodarczą w formie spółki cywilnej pod firmą: '.$subff->data[273][0].', z siedzibą '.$subff->data[267][0].' '.$subff->data[266][0].' przy ul. '.$subff->data[265][0].', wpisaną do centralnej ewidencji i informacji o działalności gospodarczej, posługującą się numerami: NIP '.$subff->data[268][0].' oraz REGON '.$subff->data[269][0].',</p>';

  if (count($subff->data[364])>1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwanymi w dalszej części „<b>Sprzedawcą</b>”,</p>';
}


if ($subff->data[41][0] == 'osprawna') {
  switch ($subff->data[262][0]) {
    case 'handlowy':
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">'.$subff->data[273][0].' Spółka ';?>[submission:values:kontakt_sprzedajacego:rodzaj_handlowy:nolabel] z siedzibą: <?php
      echo $subff->data[267][0].' '.$subff->data[266][0].' przy ul. '.$subff->data[265][0].', wpisaną do rejestru Krajowego Rejestru Sądowego pod nr KRS '.$subff->data[270][0].' przez '.$subff->data[271][0].' w '.$subff->data[272][0].', o numerze NIP '.$subff->data[268][0].' i o numerze REGON '.$subff->data[269][0].', reprezentowaną przez:<br />- '.$subff->data[351][0];
      if ($subff->data[350][0] == 'pan') echo ' – będącego '; else echo ' – będącą ';
      switch ($subff->data[263][0]) {
        case 'jawna':
          echo ' '; ?>[submission:values:kontakt_sprzedajacego:dane_osobowe_op:funkcja_reprezentanta4:nolabel]<?php
          break;
        case 'partnerska':
          echo ' '; ?>[submission:values:kontakt_sprzedajacego:dane_osobowe_op:funkcja_reprezentanta3:nolabel]<?php
          break;
        case 'komandytowa':
          echo ' '; ?>[submission:values:kontakt_sprzedajacego:dane_osobowe_op:funkcja_reprezentanta2:nolabel]<?php
          break;
        default:
          echo ' '; ?>[submission:values:kontakt_sprzedajacego:dane_osobowe_op:funkcja_reprezentanta_1:nolabel]<?php
      }

      echo ',';
      if ($subff->data[373][0] == 'tak') {

        switch ($subff->data[263][0]) {
          case 'jawna':
            for ($j=0; $j<count($subff->data[437]);$j++) {
              echo '<br />- '.$subff->wfm_data[437][261][434][435][$j][410][0];
              if ($subff->data[436][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
              if (array_key_exists($subff->data[441][$j], $tabReprezentacji)) {
                echo $tabReprezentacji[$subff->data[441][$j]].',';
              } else echo $subff->data[441][$j].',';
            }
            break;
          case 'partnerska':
            for ($j=0; $j<count($subff->data[430]);$j++) {
              echo '<br />- '.$subff->wfm_data[430][261][427][435][$j][410][0];
              if ($subff->data[429][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
              if (array_key_exists($subff->data[433][$j], $tabReprezentacji)) {
                echo $tabReprezentacji[$subff->data[433][$j]].',';
              } else echo $subff->data[433][$j].',';
            }
            break;
          case 'komandytowa':
            for ($j=0; $j<count($subff->data[424]);$j++) {
              echo '<br />- '.$subff->wfm_data[424][261][420][435][$j][410][0];
              if ($subff->data[423][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
              if (array_key_exists($subff->data[426][$j], $tabReprezentacji)) {
                echo $tabReprezentacji[$subff->data[426][$j]].',';
              } else echo $subff->data[426][$j].',';
            }
            break;
          default:
            for ($j=0; $j<count($subff->data[367]);$j++) {
              echo '<br />- '.$subff->wfm_data[367][261][374][435][$j][410][0];
              if ($subff->data[381][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
              if (array_key_exists($subff->data[412][$j], $tabReprezentacji)) {
                echo $tabReprezentacji[$subff->data[412][$j]].',';
              } else echo $subff->data[412][$j].',';
            }
        }
      }
      echo '</p>';
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Sprzedawcą</b>”,</p>';
      break;




    case 'podmiotkrs':
      if ($subff->data[317][0]=='tak') {
        echo '<p style="text-align:justify; font-size:40px; line-height:60px;">'.$subff->data[273][0].' z siedzibą: '.$subff->data[267][0].' '.$subff->data[266][0].' przy ul. '.$subff->data[265][0].', wpisaną do rejestru Krajowego Rejestru Sądowego pod nr KRS '.$subff->data[270][0].' przez '.$subff->data[271][0].' w '.$subff->data[272][0].', o numerze NIP '.$subff->data[268][0].' i o numerze REGON '.$subff->data[269][0].', reprezentowaną przez:<br />- '.$subff->data[351][0];
        if ($subff->data[350][0] == 'pan') echo ' – będącego '; else echo ' – będącą ';
        echo $subff->data[363][0];
        echo ',';
        if ($subff->data[373][0] == 'tak') {
          for ($j=0; $j<count($subff->data[378]);$j++) {
            echo '<br />- '.$subff->wfm_data[378][261][375][376][$j][410][0];
            if ($subff->data[377][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
            echo $subff->wfm_data[380][261][375][376][$j][411][0].',';
          }
        }


      } else {
        echo '<p style="text-align:justify; font-size:40px; line-height:60px;">'.$subff->data[273][0].' z siedzibą: '.$subff->data[267][0].' '.$subff->data[266][0].' przy ul. '.$subff->data[265][0].', wpisaną do rejestru Krajowego Rejestru Sądowego pod nr KRS '.$subff->data[270][0].' przez '.$subff->data[271][0].' w '.$subff->data[272][0].', o numerze NIP '.$subff->data[268][0].', reprezentowaną przez:<br />- '.$subff->data[351][0];
        if ($subff->data[350][0] == 'pan') echo ' – będącego '; else echo ' – będącą ';
        echo $subff->data[363][0];
        echo ',';
        if ($subff->data[373][0] == 'tak') {
          for ($j=0; $j<count($subff->data[378]);$j++) {
            echo '<br />- '.$subff->wfm_data[378][261][375][376][$j][410][0];
            if ($subff->data[377][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
            echo $subff->wfm_data[380][261][375][376][$j][411][0].',';
          }
        }

      }
      echo '</p>';
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Sprzedawcą</b>”,</p>';

      break;

    case 'inny':
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">'.$subff->data[273][0].' z siedzibą: '.$subff->data[267][0].' '.$subff->data[266][0].' przy ul. '.$subff->data[265][0].', o numerze NIP '.$subff->data[268][0].', reprezentowaną przez:<br />- '.$subff->data[351][0];
      if ($subff->data[350][0] == 'pan') echo ' – będącego '; else echo ' – będącą ';
      echo $subff->data[363][0];
      echo ',';
      if ($subff->data[373][0] == 'tak') {
        for ($j=0; $j<count($subff->data[378]);$j++) {
          echo '<br />- '.$subff->wfm_data[378][261][375][376][$j][378][0];
          if ($subff->data[377][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
          echo $subff->wfm_data[380][261][375][376][$j][322][0].',';
        }
      }

      echo '</p>';
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Sprzedawcą</b>”,</p>';

      break;
  }
}

// ------------------------------------- KUPUJĄCY ----------------------------------------- //

?>


<p style="text-align:justify; font-size:40px; line-height:60px;">a</p>

<?php

if ($subff->data[42][0] == 'osfizyczna') {

  for ($j=0; $j<count($subff->data[330]);$j++) {
    if ($subff->data[304][$j] == 'pan') {
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">Panem '.$subff->wfm_data[330][289][303][$j][394][0].' zamieszkałym: '.$subff->wfm_data[312][289][303][$j][253][0].' '.$subff->wfm_data[310][289][303][$j][252][0].' przy ul. '.$subff->wfm_data[311][289][303][$j][251][0].', legitymującym się dowodem osobistym numer '.$subff->wfm_data[307][289][303][$j][386][0].', wydanym przez '.$subff->wfm_data[308][289][303][$j][387][0].', posługującym się numerem PESEL '.$subff->wfm_data[306][289][303][$j][306][0].',</p>';
      if (count($subff->data[330])==1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwanego w dalszej części „<b>Kupującym</b>”.</p>';
    } else {
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">Panią '.$subff->wfm_data[330][289][303][$j][394][0].' zamieszkałą: '.$subff->wfm_data[312][289][303][$j][253][0].' '.$subff->wfm_data[310][289][303][$j][252][0].' przy ul. '.$subff->wfm_data[311][289][303][$j][251][0].', legitymującą się dowodem osobistym numer '.$subff->wfm_data[307][289][303][$j][386][0].', wydanym przez '.$subff->wfm_data[308][289][303][$j][387][0].', posługującą się numerem PESEL '.$subff->wfm_data[306][289][303][$j][306][0].',</p>';
      if (count($subff->data[330])==1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Kupującym</b>”.</p>';
    }

    if ($j<count($subff->data[330])-1) echo '<p style="text-align:justify; font-size:40px; margin:0; padding:0;">i</p>';
  }

  if (count($subff->data[330])>1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwanymi w dalszej części „<b>Kupującym</b>”.</p>';
}

// - działalność gospodarcza - //
if ($subff->data[42][0] == 'dg') {

  for ($j=0; $j<count($subff->data[385]);$j++) {

    if ($subff->data[384][$j] == 'pan') {
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">Panem '.$subff->wfm_data[385][289][383][$j][385][0].' zamieszkałym: '.$subff->wfm_data[391][289][383][$j][253][0].' '.$subff->wfm_data[389][289][383][$j][252][0].' przy ul. '.$subff->wfm_data[390][289][383][$j][251][0].', legitymującym się dowodem osobistym numer '.$subff->wfm_data[386][289][383][$j][386][0].', wydanym przez '.$subff->wfm_data[387][289][383][$j][387][0];
      if ($subff->data[319][0] == 'indywidualnie') echo ', prowadzącym działalność gospodarczą indywidualnie pod firmą: '.$subff->data[293][0].', z siedzibą '.$subff->data[296][0].' '.$subff->data[295][0].' przy ul. '.$subff->data[294][0].', wpisanym do centralnej ewidencji i informacji o działalności gospodarczej, posługującym się numerami: NIP '.$subff->data[297][0].' oraz REGON '.$subff->data[298][0];
      echo ',</p>';
      if (count($subff->data[385])==1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwanego w dalszej części „<b>Kupującym</b>”.</p>';
    } else {
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">Panią '.$subff->wfm_data[385][289][383][$j][385][0].' zamieszkałą: '.$subff->wfm_data[391][289][383][$j][253][0].' '.$subff->wfm_data[389][289][383][$j][252][0].' przy ul. '.$subff->wfm_data[390][289][383][$j][251][0].', legitymującą się dowodem osobistym numer '.$subff->wfm_data[386][289][383][$j][386][0].', wydanym przez '.$subff->wfm_data[387][289][383][$j][387][0];
      if ($subff->data[319][0] == 'indywidualnie') echo ', prowadzącą działalność gospodarczą indywidualnie pod firmą: '.$subff->data[293][0].', z siedzibą '.$subff->data[296][0].' '.$subff->data[295][0].' przy ul. '.$subff->data[294][0].', wpisaną do centralnej ewidencji i informacji o działalności gospodarczej, posługującą się numerami: NIP '.$subff->data[297][0].' oraz REGON '.$subff->data[298][0];
      echo ',</p>';
      if (count($subff->data[385])==1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Kupującym</b>”.</p>';
    }

    if ($j<count($subff->data[385])-1) echo '<p style="text-align:justify; font-size:40px; margin:0; padding:0;">i</p>';
  }

  if ($subff->data[319][0] != 'indywidualnie') echo '<p style="text-align:justify; font-size:40px; line-height:60px;">prowadzącymi działalność gospodarczą w formie spółki cywilnej pod firmą: '.$subff->data[293][0].', z siedzibą '.$subff->data[296][0].' '.$subff->data[295][0].' przy ul. '.$subff->data[294][0].', wpisaną do centralnej ewidencji i informacji o działalności gospodarczej, posługującą się numerami: NIP '.$subff->data[297][0].' oraz REGON '.$subff->data[298][0].',</p>';

  if (count($subff->data[385])>1) echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwanymi w dalszej części „<b>Kupującym</b>”.</p>';
}


// - os prawna - //
if ($subff->data[42][0] == 'osprawna') {
  switch ($subff->data[290][0]) {
    case 'handlowy':
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">'.$subff->data[293][0].' Spółka ';?>[submission:values:kontakt_kupujacego:rodzaj_handlowy:nolabel] z siedzibą: <?php
      echo $subff->data[296][0].' '.$subff->data[295][0].' przy ul. '.$subff->data[294][0].', wpisaną do rejestru Krajowego Rejestru Sądowego pod nr KRS '.$subff->data[299][0].' przez '.$subff->data[300][0].' w '.$subff->data[301][0].', o numerze NIP '.$subff->data[297][0].' i o numerze REGON '.$subff->data[298][0].', reprezentowaną przez:<br />- '.$subff->data[394][0];
      if ($subff->data[393][0] == 'pan') echo ' – będącego '; else echo ' – będącą ';
      switch ($subff->data[291][0]) {
        case 'jawna':
          echo ' '; ?>[submission:values:kontakt_kupujacego:dane_osobowe_opk:funkcja_reprezentanta4:nolabel]<?php
          break;
        case 'partnerska':
          echo ' '; ?>[submission:values:kontakt_kupujacego:dane_osobowe_opk:funkcja_reprezentanta3:nolabel]<?php
          break;
        case 'komandytowa':
          echo ' '; ?>[submission:values:kontakt_kupujacego:dane_osobowe_opk:funkcja_reprezentanta2:nolabel]<?php
          break;
        default:
          echo ' '; ?>[submission:values:kontakt_kupujacego:dane_osobowe_opk:funkcja_reprezentanta_1:nolabel]<?php
      }

      echo ',';
      if ($subff->data[400][0] == 'tak') {

        switch ($subff->data[291][0]) {
          case 'jawna':
            for ($j=0; $j<count($subff->data[458]);$j++) {
              echo '<br />- '.$subff->wfm_data[458][289][455][408][$j][410][0];
              if ($subff->data[457][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
              if (array_key_exists($subff->data[459][$j], $tabReprezentacji)) {
                echo $tabReprezentacji[$subff->data[459][$j]].',';
              } else echo $subff->data[459][$j].',';
            }
            break;
          case 'partnerska':
            for ($j=0; $j<count($subff->data[453]);$j++) {
              echo '<br />- '.$subff->wfm_data[453][289][450][408][$j][410][0];
              if ($subff->data[452][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
              if (array_key_exists($subff->data[433][$j], $tabReprezentacji)) {
                echo $tabReprezentacji[$subff->data[454][$j]].',';
              } else echo $subff->data[454][$j].',';
            }
            break;
          case 'komandytowa':
            for ($j=0; $j<count($subff->data[448]);$j++) {
              echo '<br />- '.$subff->wfm_data[448][289][445][408][$j][410][0];
              if ($subff->data[447][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
              if (array_key_exists($subff->data[449][$j], $tabReprezentacji)) {
                echo $tabReprezentacji[$subff->data[449][$j]].',';
              } else echo $subff->data[449][$j].',';
            }
            break;
          default:
            for ($j=0; $j<count($subff->data[405]);$j++) {
              echo '<br />- '.$subff->wfm_data[405][289][401][408][$j][410][0];
              if ($subff->data[404][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
              if (array_key_exists($subff->data[412][$j], $tabReprezentacji)) {
                echo $tabReprezentacji[$subff->data[406][$j]].',';
              } else echo $subff->data[406][$j].',';
            }
        }
      }
      echo '</p>';
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Kupującym</b>”.</p>';
      break;




    case 'podmiotkrs':
      if ($subff->data[318][0]=='tak') {
        echo '<p style="text-align:justify; font-size:40px; line-height:60px;">'.$subff->data[293][0].' z siedzibą: '.$subff->data[296][0].' '.$subff->data[295][0].' przy ul. '.$subff->data[294][0].', wpisaną do rejestru Krajowego Rejestru Sądowego pod nr KRS '.$subff->data[299][0].' przez '.$subff->data[300][0].' w '.$subff->data[301][0].', o numerze NIP '.$subff->data[297][0].' i o numerze REGON '.$subff->data[298][0].', reprezentowaną przez:<br />- '.$subff->data[394][0];
        if ($subff->data[393][0] == 'pan') echo ' – będącego '; else echo ' – będącą ';
        echo $subff->data[399][0];
        echo ',';
        if ($subff->data[400][0] == 'tak') {
          for ($j=0; $j<count($subff->data[410]);$j++) {
            echo '<br />- '.$subff->wfm_data[410][289][407][408][$j][410][0];
            if ($subff->data[409][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
            echo $subff->wfm_data[411][289][407][408][$j][411][0].',';
          }
        }


      } else {
        echo '<p style="text-align:justify; font-size:40px; line-height:60px;">'.$subff->data[293][0].' z siedzibą: '.$subff->data[296][0].' '.$subff->data[295][0].' przy ul. '.$subff->data[294][0].', wpisaną do rejestru Krajowego Rejestru Sądowego pod nr KRS '.$subff->data[299][0].' przez '.$subff->data[300][0].' w '.$subff->data[301][0].', o numerze NIP '.$subff->data[297][0].', reprezentowaną przez:<br />- '.$subff->data[394][0];
        if ($subff->data[393][0] == 'pan') echo ' – będącego '; else echo ' – będącą ';
        echo $subff->data[399][0];
        echo ',';
        if ($subff->data[400][0] == 'tak') {
          for ($j=0; $j<count($subff->data[410]);$j++) {
            echo '<br />- '.$subff->wfm_data[410][289][407][408][$j][410][0];
            if ($subff->data[409][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
            echo $subff->wfm_data[411][289][407][408][$j][411][0].',';
          }
        }

      }
      echo '</p>';
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Kupującym</b>”.</p>';

      break;

    case 'inny':
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">'.$subff->data[293][0].' z siedzibą: '.$subff->data[296][0].' '.$subff->data[295][0].' przy ul. '.$subff->data[294][0].', o numerze NIP '.$subff->data[297][0].', reprezentowaną przez:<br />- '.$subff->data[394][0];
      if ($subff->data[393][0] == 'pan') echo ' – będącego '; else echo ' – będącą ';
      echo $subff->data[399][0];
      echo ',';
      if ($subff->data[400][0] == 'tak') {
        for ($j=0; $j<count($subff->data[410]);$j++) {
          echo '<br />- '.$subff->wfm_data[410][289][407][408][$j][410][0];
          if ($subff->data[409][$j] == 'pan') echo ' – będącego '; else echo ' – będącą ';
          echo $subff->wfm_data[411][289][407][408][$j][411][0].',';
        }
      }

      echo '</p>';
      echo '<p style="text-align:justify; font-size:40px; line-height:60px;">zwaną w dalszej części „<b>Kupującym</b>”.</p>';

      break;
  }
}

?>


<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Przedmiot sprzedaży</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Przedmiotem niniejszej umowy sprzedaży jest samochód używany o następujących parametrach („przedmiot sprzedaży”):
    <ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
      <li>dane techniczne:
        <ol type="i">
          <li>marka: <?php echo strtoupper($subff->data[1][0]); ?>;</li>
          <li>model: <?php echo strtoupper($subff->data[2][0]); ?>;</li>
          <?php if ($subff->data[24][0]!=''): ?>
            <li>wersja: [submission:values:dane_pojazdu:wersja_samochodu:nolabel];</li>
          <?php endif; ?>
          <li>liczba drzwi: [submission:values:dane_pojazdu:liczba_drzwi:nolabel];</li>
          <li>rok produkcji: [submission:values:dane_pojazdu:rok_produkcji:nolabel];</li>
          <li>kolor: [submission:values:dane_pojazdu:lakier:kolor:nolabel], [submission:values:dane_pojazdu:lakier:rodzaj_lakieru:nolabel];</li>
          <li>przebieg: [submission:values:dane_pojazdu:przebieg:nolabel] km;</li>
          <li>pojemność silnika: [submission:values:dane_pojazdu:pojemnosc:nolabel] cm3;</li>
          <li>moc: [submission:values:dane_pojazdu:moc:nolabel] koni mechanicznych;</li>
          <li>numer nadwozia VIN: [submission:values:dane_pojazdu:vin:nolabel];</li>
          <?php if ($subff->data[14][0]!=''): ?>
            <li>numer rejestracyjny: [submission:values:dane_pojazdu:numer_rejestracyjny:nolabel];</li>
          <?php endif; ?>
          <?php if ($subff->data[15][0]!=''): ?>
            <li>masa własna: [submission:values:dane_pojazdu:masa_wlasna:nolabel] kg;</li>
          <?php endif; ?>
          <?php if ($subff->data[16][0]!=''): ?>
            <li>masa całkowita: [submission:values:dane_pojazdu:masa_calkowita:nolabel] kg;</li>
          <?php endif; ?>
          <?php if ($subff->data[17][0]!=''): ?>
            <li>liczba miejsc: [submission:values:dane_pojazdu:liczba_miejsc:nolabel] miejsc;</li>
          <?php endif; ?>
        </ol>
      </li>
      <li>rodzaj: <?php if ($subff->data[18][0]!='inny'): ?>[submission:values:dane_pojazdu:rodzaj_pojazdu:rodzaj_samochodu:nolabel]<?php if (($subff->data[18][0]=='osobowy')&&($subff->data[20][0]!='')): ?> - [submission:values:dane_pojazdu:rodzaj_pojazdu:typ_nadwozia_osobowy:nolabel]<?php endif; ?><?php if (($subff->data[18][0]=='ciezarowy')&&($subff->data[21][0]!='')): ?> - [submission:values:dane_pojazdu:rodzaj_pojazdu:typ_nadwozia_ciezarowy:nolabel]<?php endif; ?><?php if (($subff->data[18][0]=='sinny')&&($subff->data[22][0]!='')): ?> - [submission:values:dane_pojazdu:rodzaj_pojazdu:typ_nadwozia_sinny:nolabel]<?php endif; ?><?php else: ?>inny, tzn. pojazd na podstawie wyciągu ze świadectwa homologacji lub zaświadczenia z badania technicznego zakwalifikowano do danego podrodzaju nie określonego w zasadniczym podziale<?php endif; ?>;</li>
      <li>rodzaj paliwa: [submission:values:dane_pojazdu:rodzaj_paliwa:nolabel];</li>
      <li>rodzaj napędu: [submission:values:dane_pojazdu:rodzaj_napedu:nolabel];</li>
    </ol>
  </li>
  <?php if ($subff->data[28][0]!=''): ?><li>Samochód, o którym mowa w ust. 1, posiada wyposażenie w postaci: <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;"><?php
      for ($i=0; $i<count($subff->data[28]); $i++){
        if ('bocznetylpoduszki' == $subff->data[28][$i]) {
          echo '<li>'.$tabelaWyposaz[$subff->data[28][$i]].' — w liczbie '.$subff->data[30][0].';</li>';
        } elseif ('dywanikiguma' == $subff->data[28][$i]) {
          echo '<li>'.$tabelaWyposaz[$subff->data[28][$i]].' — w liczbie '.$subff->data[31][0].';</li>';
        } elseif ('dywanikiwelur' == $subff->data[28][$i]) {
          echo '<li>'.$tabelaWyposaz[$subff->data[28][$i]].' — w liczbie '.$subff->data[32][0].';</li>';
        } elseif ('elefotel' == $subff->data[28][$i]) {
          echo '<li>'.$tabelaWyposaz[$subff->data[28][$i]].' — w liczbie '.$subff->data[33][0].';</li>';
        } elseif ('podgazpasaz' == $subff->data[28][$i]) {
          echo '<li>'.$tabelaWyposaz[$subff->data[28][$i]].' — w liczbie '.$subff->data[34][0].';</li>';
        } elseif ('zintegrfotdzieci' == $subff->data[28][$i]) {
          echo '<li>'.$tabelaWyposaz[$subff->data[28][$i]].' — w liczbie '.$subff->data[35][0].';</li>';
        } else {
          if (array_key_exists($subff->data[28][$i], $tabelaWyposaz)) {
            echo '<li>'.$tabelaWyposaz[$subff->data[28][$i]].';</li>';
          } else echo '<li>'.$subff->data[28][$i].';</li>';
        }
      }

      ?></ol></li><?php endif; ?>
  <?php if ($subff->data[37][0]!=''): ?><li>W samochodzie, o którym mowa w ust. 1, są wykorzystane następujące technologie: <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;"><?php
      for ($i=0; $i<count($subff->data[37]); $i++){
        if (array_key_exists($subff->data[37][$i], $tabelaTechno)) {
          echo '<li>'.$tabelaTechno[$subff->data[37][$i]].';</li>';
        } else  echo '<li>'.$subff->data[37][$i].';</li>';
      }
      ?></ol></li><?php endif; ?>
  <?php if ($subff->data[38][0]!=''): ?><li>Razem z samochodem, o którym mowa w ust. 1, Sprzedawca przekazuje Kupującemu w ramach ceny: <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;"><?php
      for ($i=0; $i<count($subff->data[38]); $i++){
        if (array_key_exists($subff->data[38][$i], $tabelaDodatkow)) {
          echo '<li>'.$tabelaDodatkow[$subff->data[38][$i]].';</li>';
        } else  echo '<li>'.$subff->data[38][$i].';</li>';
      }
      ?></ol></li><?php endif; ?>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Oświadczenia</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Sprzedawca oświadcza, że posiada prawo własności samochodu używanego określonego w § 1 ust. 1 niniejszej Umowy.</li>
  <?php if (($subff->data[41][0]=='osfizyczna')||($subff->data[41][0]=='dg')){
    if ($subff->data[45][0]=='tak'){
      echo '<li>Sprzedawca oświadcza, że pozostaje w związku małżeńskim, a&nbsp;przedmiot sprzedaży stanowi';
      if ($subff->data[46][0]=='odrebny'){
        echo ' jego/jej majątek odrębny.</li>';
      } else {
        echo ' majątek wspólny.</li>';
      }
    } else {
      echo '<li>Sprzedawca oświadcza, że nie pozostaje w związku małżeńskim.</li>';
    }
  }?>
  <li>Sprzedawca oświadcza, <?php if ($subff->data[49][0]=='nie'): ?>że  przedmiot sprzedaży nie jest obciążony prawami na rzecz osoby trzeciej, które mogłyby uniemożliwić lub utrudnić wykonywanie przez Kupującego jego uprawnień wynikających z niniejszej Umowy.</li>
<?php else: ?>iż przedmiot sprzedaży jest obciążony prawami na rzecz osób trzecich w postaci [submission:values:obciazenia:rodzaj_obciazenia:nolabel].<br />
  Wskazane powyżej prawo [submission:values:obciazenia:rodzaj_obciazenia:nolabel] zostało ustanowione na rzecz:<?php
  if ($liczbaOsobObciaz>0) {

    if ($subff->data[52][0] == 'oso_ fiz_obc') {
      if ($subff->data[327][0] == 'pan') $zamieszkanieOBC = ' zamieszkałego przy ul.'; else $zamieszkanieOBC = ' zamieszkałej przy ul.';
    } else {
      $zamieszkanieOBC = ' z siedzibą przy ul.';
    }

    echo '<ul>';

    for ($i=0; $i<$liczbaOsobObciaz;$i++) {
      echo '<li>'.$subff->wfm_data[54][51][$i][54][0].$zamieszkanieOBC.$subff->wfm_data[56][51][$i][56][0].' '.$subff->wfm_data[57][51][$i][57][0].', '.$subff->wfm_data[58][51][$i][58][0].';</li>';
    }

    echo '</ul><br />o czym Kupujący został poinformowany i na co Kupujący wyraził zgodę. <br />Sprzedawca ';
    if ($subff->data[60][0] == 'tak') {
      echo ' jest zobowiązany do odciążenia przedmiotu sprzedaży z w/w praw — w terminie do '.date("d.m.Y", strtotime($subff->data[61][0])).'r.';
    } else {
      echo 'nie jest zobowiązany do odciążenia przedmiotu sprzedaży z w/w praw.';
    }
  }
  ?></li>
<?php endif; ?>
  <?php if ($subff->data[62][0]!='nieznany'): ?><li>Sprzedawca oświadcza, że kraj pierwszej rejestracji przedmiotu sprzedaży to [submission:values:dane_pojazdu:kraj_pierwszej_rejestracji:nolabel].</li><?php endif; ?>
  <li>Sprzedawca oświadcza, że w związku z przedmiotem sprzedaży <?php
    if ($subff->data[64][0]=='tak'){
      echo 'pozostały do uregulowania należności publicznoprawne (opłaty rejestracyjne, podatki, cła) w kwocie '.str_replace(".",",",$subff->data[65][0]).' zł.';
    } else {
      echo ' nie ma do uregulowania żadnych należności publicznoprawnych.';
    }
    ?></li>
  <?php if ($subff->data[66][0]!='nieznane'): ?><li>Sprzedawca oświadcza, że jest [submission:values:ktorym_wlascicielem_samochodu:nolabel] właścicielem samochodu od pierwszej rejestracji.</li><?php endif; ?>
  <?php if ($subff->data[67][0]!='nieznana'): ?><li>Sprzedawca oświadcza, że przedmiot sprzedaży <?php
    if ($subff->data[67][0]=='tak'){
      echo 'był wykorzystywany w działalności gospodarczej.';
    } else {
      echo 'nie był wykorzystywany w działalności gospodarczej ani przez obecnego, ani poprzedniego właściciela.';
    }?></li><?php endif; ?>
  <li>Sprzedawca oświadcza, że <?php if ($subff->data[68][0]=='tak'): ?>licznik w przedmiocie sprzedaży był cofany.<?php elseif ($subff->data[68][0]=='nie'): ?>licznik w przedmiocie sprzedaży nie był cofany.<?php else: ?>sam nie cofał licznika, lecz nie wie, czy licznik nie został cofnięty przez poprzedniego właściciela.<?php endif; ?></li>
  <li>Sprzedawca oświadcza, że przedmiot sprzedaży [submission:values:aso:nolabel] serwisowany w ASO.</li>
  <?php if ($subff->data[70][0]!='nieznane'): ?><li>Sprzedawca oświadcza, że przedmiot sprzedaży jest [submission:values:bezwypadkowy:nolabel].</li><?php endif; ?>
  <li><?php if ($subff->data[71][0]=='tak'): ?>Sprzedawca oświadcza, że przedmiot sprzedaży znajduje się w należytym stanie technicznym, zgodnym z właściwymi przepisami prawa, umożliwiającym jego normalne używanie w celach doń przeznaczonych.<?php else: ?>Sprzedawca oświadcza, że przedmiot sprzedaży nie znajduje się w stanie technicznym należytym, zgodnym z właściwymi przepisami prawa, umożliwiającym jego normalne używanie w celach doń przeznaczonych, ponieważ:<?php
      if ($subff->data[72][0]!='') {
        echo '<ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">';
        for ($i=0; $i<count($subff->data[72]); $i++){
          if ('niekompletny' == $subff->data[72][$i]) {
            echo '<li>'.$tabelaStanu[$subff->data[72][$i]].': '.$subff->data[76][0].';</li>';
          } elseif ('dokumentacja' == $subff->data[72][$i]) {
            echo '<li>'.$tabelaStanu[$subff->data[72][$i]].': '.$subff->data[74][0].';</li>';
          } elseif ('badania' == $subff->data[72][$i]) {
            echo '<li>'.$tabelaStanu[$subff->data[72][$i]].': '.$subff->data[75][0].';</li>';
          } else echo '<li>'.$tabelaStanu[$subff->data[72][$i]].';</li>';
        }
        echo '</ol>';
      }
      ?>
    <?php endif; ?></li>
  <li>Sprzedawca oświadcza, że <?php if ($subff->data[77][0]=='nie'): ?>przedmiot sprzedaży nie wymaga nakładów koniecznych do bezpiecznego poruszania się samochodem w ruchu drogowym.<?php else: ?>wymaga dokonania naprawy lub wymiany elementów, które zostaną wskazaną w Załączniku nr 1 do niniejszej Umowy.<?php endif; ?></li>
  <li>Sprzedawca oświadcza, że przedmiot sprzedaży <?php if ($subff->data[78][0]=='tak'): ?>posiada ważny przegląd techniczny — ważny do <?php echo date("d.m.Y", strtotime($subff->data[79][0]));?>r.<?php else: ?>nie posiada ważnego przeglądu technicznego.<?php endif; ?></li>
  <li>Sprzedawca oświadcza, że przedmiot sprzedaży <?php if ($subff->data[80][0]=='tak'): ?>był<?php else: ?>nie był<?php endif; ?> przerabiany lub poddawany poddawany tuningowi.</li>
  <?php if ($subff->data[81][0]=='tak'): ?><li>Sprzedawca oświadcza, że przedmiot sprzedaży jest zarejestrowany jako zabytek.</li><?php endif; ?>
  <li>Sprzedawca oświadcza, iż właściwości, parametry i stan przedmiotu sprzedaży są prawdziwe i zgodne z jego stanem wiedzy.</li>
  <?php
  if (($subff->data[42][0]=='osfizyczna')||($subff->data[42][0]=='dg')){
    if ($subff->data[45][0]=='tak'){
      echo '<li>Kupujący oświadcza, że pozostaje w związku małżeńskim, a&nbsp;przedmiot sprzedaży';
      if ($subff->data[47][0]=='odrebny'){
        echo ' wejdzie w skład jego majątku odrębnego.</li>';
      } else {
        echo ' wejdzie w skład majątku wspólnego.</li>';
      }
    } else {
      echo '<li>Kupujący oświadcza, że nie pozostaje w związku małżeńskim.</li>';
    }
  }
  ?>
  <li>Kupujący oświadcza, że obejrzał przedmiot sprzedaży, o którym mowa w §1 Umowy, i potwierdza, iż stan, w jakim aktualnie się znajduje, jest mu znany i jest on przez niego akceptowany.</li>
  <li>Kupujący oświadcza, że jego sytuacja finansowa jest stabilna i umożliwia terminową realizację zobowiązań wobec Sprzedawcę.</li>





  !!!!!!!!!!!!!!!! - Sprawdź
  <li>Strony oświadczają, iż niniejsza Umowa sprzedaży <?php if (($subff->data[41][0]!='dg')&&($subff->data[42][0]!='dg')): ?>nie zostaje zawarta w ramach działalności gospodarczej prowadzonej przez którąkolwiek ze Stron<?php else: ?>zostaje zawarta w ramach działalności gospodarczej prowadzonej przez <?php if (($subff->data[41][0]=='dg')&&($subff->data[42][0]=='dg')): ?>obie ze Stron<?php else: ?><?php if ($subff->data[41][0]=='dg'): ?>Sprzedawcę<?php else: ?>Kupującego<?php endif; ?><?php endif; ?><?php endif; ?>.</li>
</ol><br />&nbsp;


<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Obowiązki Stron</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Strony w związku z realizacją Umowy zobowiązują się w szczególności do współdziałania oraz zachowania należytej staranności w celu wykonania postanowień niniejszej Umowy.</li>
  <li>Do obowiązków Sprzedawcę w związku z realizacją Umowy należy w szczególności:
    <ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
      <li>wydanie Kupującemu przedmiotu sprzedaży;</li>
      <li>przekazanie Kupującemu dokumentów dotyczących przedmiotu sprzedaży, niezbędnych do jego prawidłowego używania;</li>
      <?php if ($subff->data[84][0]!='') {
        for ($i=0; $i<count($subff->data[84]); $i++){
          echo '<li>'.$tabelaObciazSprzed[$subff->data[84][$i]].';</li>';
        }
      } ?>
    </ol>
  </li>
  <li>Do obowiązków Kupującego w związku z realizacją Umowy należy w szczególności:
    <ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
      <li>terminowa zapłata ceny, o której mowa w  §5 Umowy;</li>
      <li>odebranie przedmiotu sprzedaży od Sprzedawcę z lokalizacji określonej w § 7 ust. 2;</li>
      <?php if ($subff->data[41][0]=='osfizyczna'): ?><li>zapłata podatku od czynności cywilnoprawnych w terminie 14 dni od dnia zawarcia niniejszej Umowy;</li><?php endif; ?>
      <?php if ($subff->data[85][0]!='') {
        for ($i=0; $i<count($subff->data[85]); $i++){
          echo '<li>'.$tabelaObciazKupu[$subff->data[85][$i]].';</li>';
        }
      } ?>
    </ol>
  </li>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Ubezpieczenie</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Sprzedawca oświadcza, iż przedmiot sprzedaży <?php if ($subff->data[86][0]=='tak'): ?>jest ubezpieczony od odpowiedzialności cywilnej do dnia <?php echo date("d.m.Y", strtotime($subff->data[87][0])); ?>r. na podstawie polisy ubezpieczeniowej o numerze [submission:values:polisa_oc:numer_polisy:nolabel], zawartej z [submission:values:polisa_oc:towarzystwo_oc:nolabel].<?php else: ?>nie jest ubezpieczony od odpowiedzialności cywilnej od dnia <?php echo date("d.m.Y", strtotime($subff->data[97][0])); ?>r.<?php endif; ?></li>
  <li>Sprzedawca oświadcza, iż przedmiot sprzedaży <?php if ($subff->data[92][0]=='tak'): ?>posiada ubezpieczenie autocasco do dnia <?php echo date("d.m.Y", strtotime($subff->data[93][0])); ?> na podstawie polisy ubezpieczeniowej o numerze [submission:values:polisa_ac:numer_polisy_ac:nolabel], zawartej z [submission:values:polisa_ac:towarzystwo_ac:nolabel].<?php else: ?>nie posiada ubezpieczenia autocasco.<?php endif; ?></li>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Cena</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">

  <li>Kupujący zapłaci Sprzedawcy cenę w wysokości [submission:values:cena_netto:nolabel] złotych <?php if ( ($subff->data[42][0] == 'osfizyczna')||($subff->data[41][0] == 'osfizyczna')||( ($subff->data[41][0] == 'dg')&&($subff->data[43][0]!='vatowiec') )): ?>brutto <?php else: ?>netto <?php endif; ?>(słownie: <?php echo zmianaNaSlownie($subff->data[99][0]); ?>).<?php if (!( ($subff->data[42][0] == 'osfizyczna')||($subff->data[41][0] == 'osfizyczna')||( ($subff->data[41][0] == 'dg')&&($subff->data[43][0]!='vatowiec') ))): ?> Kwota ta zostanie powiększona o podatek od towarów i usług według obowiązującej stawki.<?php endif; ?></li>
  <li>Cena płatna będzie <?php switch ($subff->data[100][0]) {
      case "dzisiaj":
        echo "jednorazowo w całości w dniu zawarcia niniejszej Umowy.";
        break;
      case "wdniu":
        echo "jednorazowo w całości do dnia ".date("d.m.Y", strtotime($subff->data[101][0])).'r.';
        break;
      case "kredyt":
        echo 'jednorazowo w całości po przyznaniu kredytu przez bank.';
        break;
      case "raty":
        echo 'w ratach w następujący sposób:<ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
	<li>płatność odbywać się będzie w '.$liczbaTekst[$subff->data[102][0]].' równych ratach;</li>
	<li>każda rata w wyskości '.str_replace(".",",",$subff->data[103][0]).' zł płatna bez uprzedniego wezwania, w terminie '.$subff->data[104][0].';</li></ol>';
        break;
    } ?></li>
  <?php if (in_array("rozliczenie", $subff->data[84])): ?>
    <li>W ramach ceny, o której mowa w ust. 1, Kupujący przekaże Sprzedawcy używany samochód o wartości [submission:values:w_rozliczeniu:cena_netto_rozliczenie:nolabel] złotych (słownie: <?php echo zmianaNaSlownie($subff->data[106][0]); ?>), który posiada następujące parametry techniczne:
      <ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
        <li>dane techniczne:
          <ol type="i">
            <li>marka: <?php echo strtoupper($subff->data[116][0]); ?>;</li>
            <li>model: <?php echo strtoupper($subff->data[117][0]); ?>;</li>
            <?php if ($subff->data[118][0]!=''): ?>
              <li>wersja: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:wersja_samochodu:nolabel];</li>
            <?php endif; ?>
            <?php if ($subff->data[119][0]!=''): ?>
              <li>liczba drzwi: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:liczba_drzwi:nolabel];</li>,
            <?php endif; ?>
            <?php if ($subff->data[108][0]!=''): ?>
              <li>rok produkcji: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:rok_produkcji:nolabel]r.;</li>
            <?php endif; ?>
            <?php if ($subff->data[129][0]!=''): ?>
              <li>kolor: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:lakier:kolor:nolabel], [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:lakier:rodzaj_lakieru:nolabel];</li>
            <?php endif; ?>
            <li>przebieg: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:przebieg:nolabel] km;</li>
            <?php if ($subff->data[122][0]!=''): ?>
              <li>pojemność silnika: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:pojemnosc:nolabel] cm3;</li>
            <?php endif; ?>
            <?php if ($subff->data[123][0]!=''): ?>
              <li>moc: [submission:values:dane_pojazdu:w_rozliczeniu:dane_pojazdu_rozliczenie:moc:nolabel] koni mechanicznych;</li>
            <?php endif; ?>
            <li>numer nadwozia VIN: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:vin:nolabel];</li>
            <?php if ($subff->data[131][0]!=''): ?>
              <li>numer rejestracyjny: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:numer_rejestracyjny:nolabel];</li>
            <?php endif; ?>
          </ol>
        </li>
        <li>rodzaj: <?php if ($subff->data[110][0]!='inny'): ?>[submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:rodzaj_pojazdu:rodzaj_samochodu:nolabel]<?php if (($subff->data[111][0]=='osobowy')&&($subff->data[112][0]!='')): ?> - [submission:values:dane_pojazdu:rodzaj_pojazdu:typ_nadwozia_osobowy:nolabel]<?php endif; ?><?php if (($subff->data[111][0]=='ciezarowy')&&($subff->data[113][0]!='')): ?> - [submission:values:dane_pojazdu:rodzaj_pojazdu:typ_nadwozia_ciezarowy:nolabel]<?php endif; ?><?php if (($subff->data[111][0]=='sinny')&&($subff->data[114][0]!='')): ?> - [submission:values:dane_pojazdu:rodzaj_pojazdu:typ_nadwozia_sinny:nolabel]<?php endif; ?><?php else: ?>inny, tzn. pojazd na podstawie wyciągu ze świadectwa homologacji lub zaświadczenia z badania technicznego zakwalifikowano do danego podrodzaju nie określonego w zasadniczym podziale<?php endif; ?>;</li>
        <li>rodzaj paliwa: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:rodzaj_paliwa:nolabel];</li>
        <li>rodzaj napędu: [submission:values:w_rozliczeniu:dane_pojazdu_rozliczenie:rodzaj_napedu:nolabel];</li>
      </ol>
    </li>
    <li>Z dniem zawarcia niniejszej Umowy Kupujący przekazuje powyższy samochód Sprzedawcy i przenosi na niego prawo własności. W przypadku odstąpienia od Umowy przez którąkolwiek ze Stron prawo własności powyższego samochodu z mocy umowy przechodzi z powrotem na Kupującego z chwilą wyznaczoną zgodnie z 61 k.c. Sprzedawca jest zobowiązany do zwrotu samochodu w terminie do 3 dni od dnia wezwania przez Kupującego do zwrotu.</li>
  <?php endif; ?>
  <li>Zapłata ceny nastąpi <?php if ($subff->data[132][0]=='przelew'):?> na rachunek bankowy Sprzedawcy o numerze [submission:values:rachunek_bankowy:nolabel] prowadzony przez bank [submission:values:nazwa_banku:nolabel]<?php else: ?> gotówką do rąk własnych Sprzedawcy<?php endif; ?>.</li>
  <li>Za dzień zapłaty ceny Strony przyjmują dzień<?php if ($subff->data[132][0]=='przelew'):?> obciążenia rachunku bankowego<?php if ($subff->data[135][0]=='sprzedajacego'):?> Sprzedawcę<?php else: ?> Kupującego<?php endif; ?><?php else: ?> przekazania gotówki do rąk własnych Sprzedawcy<?php endif; ?>.</li>
  <?php // !!!!!!!!!!!!!!!!!!!!!!!! ?>
  <li><?php if ($subff->data[100][0]=='raty'):?>Sprzedawca po uiszczeniu przez Kupującego każdej kolejnej raty będzie wystawiał [submission:values:dokument_sprzedazy_raty:nolabel], a po uiszczeniu ostatniej raty wystawi Kupującemu [submission:values:po_ostatnia_rata:nolabel]<?php else: ?>Po otrzymaniu zapłaty całej ceny Sprzedawca wystawi na rzecz Kupującego <?php if ( ($subff->data[41][0] == 'osfizyczna')||( ($subff->data[41][0] == 'dg')&&($subff->data[43][0]!='vatowiec') )):?> pokwitowanie<?php else: ?> [submission:values:dokument_sprzedazy:nolabel]<?php endif; ?><?php endif; ?>.</li>
  <li>W przypadku zwłoki w zapłacie ceny lub innych należności, jak również zwrocie jakiejkolwiek sumy pieniężnej,  Strony posiadają prawo naliczania odsetek maksymalnych zgodnie z art. 359 § 2<sup>1</sup> k.c.</li>
  <li>W ramach niniejszej Umowy Kupujący<?php if (($subff->data[139][0]=='nie')&&($subff->data[140][0]=='nie')):?> nie jest obowiązany uiścić zadatku ani zaliczki.<?php else: ?>
      <?php if ($subff->data[139][0]=='tak'):?>
        <?php if ($subff->data[143][0]=='tak'):?>
          uiścił zadatek w wysokości [submission:values:kwota_zadatku:nolabel] złotych (słownie: <?php echo zmianaNaSlownie($subff->data[141][0]); ?>), który będzie zaliczony na poczet ceny, o jakiej mowa w ust. 1.
        <?php else: ?>
          uiści zadatek w wysokości [submission:values:kwota_zadatku:nolabel] złotych (słownie: <?php echo zmianaNaSlownie($subff->data[141][0]); ?>) do dnia <?php echo date("d.m.Y", strtotime($subff->data[145][0])); ?>r., który będzie zaliczony na poczet ceny, o jakiej mowa w ust. 1.
        <?php endif; ?>
      <?php endif; ?>
      <?php if ($subff->data[140][0]=='tak'):?>
        <?php if ($subff->data[139][0]=='tak'):?> oraz<?php endif; ?>
        <?php if ($subff->data[144][0]=='tak'):?>
          uiścił zaliczkę w wysokości [submission:values:kwota_zaliczki:nolabel] złotych (słownie: <?php echo zmianaNaSlownie($subff->data[142][0]); ?>), która będzie zaliczona na poczet ceny, o jakiej mowa w ust. 1.
        <?php else: ?>
          uiści zaliczkę w wysokości [submission:values:kwota_zaliczki:nolabel] złotych (słownie: <?php echo zmianaNaSlownie($subff->data[142][0]); ?>) do dnia <?php echo date("d.m.Y", strtotime($subff->data[146][0])); ?>r., która będzie zaliczona na poczet ceny, o jakiej mowa w ust. 1.
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?></li>
  <?php if ($subff->data[139][0]=='tak'):?>
    <li>Sprzedawca może od Umowy odstąpić i zatrzymać zadatek w przypadku niewykonania Umowy przez Kupującego z przyczyn przez niego zawinionych.</li>
    <li>W przypadku niewykonania Umowy przez Sprzedawcę z przyczyn przez niego zawinionych zobowiązuje się on do zwrotu zadatku w dwukrotnej wysokości w terminie 14 dni od dnia doręczenia wezwania do zwrotu zadatku.</li>
    <li>W razie rozwiązania Umowy za porozumieniem Stron lub w wyniku okoliczności, za którą żadna za Stron nie ponosi odpowiedzialności lub ponoszą je obie Strony, zadatek podlega zwrotowi w takiej kwocie, w jakiej został dany — w terminie 14 dni od dnia doręczenia wezwania do zwrotu zadatku.</li>
    <li>Jeżeli zadatek zatrzymany lub otrzymany przez którąkolwiek ze Stron jest niższy niż wartość szkody poniesionej przez Stronę, każdej ze Stron przysługuje prawo dochodzenia odszkodowania na zasadach ogólnych prawa cywilnego.</li>
  <?php endif; ?>
  <?php if ($subff->data[140][0]=='tak'):?>
    <li>Sprzedawca może od Umowy odstąpić i zatrzymać zaliczkę w przypadku niewykonania Umowy przez Kupującego z przyczyn przez niego zawinionych.</li>
    <li>W przypadku niewykonania Umowy przez Sprzedawcę z przyczyn przez niego zawinionych, rozwiązania Umowy za porozumieniem Stron lub w wyniku okoliczności, za którą żadna za Stron nie ponosi odpowiedzialności lub ponoszą je obie Strony, zaliczka podlega zwrotowi w takiej kwocie, w jakiej została dana — w terminie 14 dni od dnia doręczenia wezwania do zwrotu zaliczki.</li>
  <?php endif; ?>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Używanie przedmiotu sprzedaży</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Strony oświadczają, że<?php if ($subff->data[147][0]=='nie'):?> do chwili przeniesienia własności przedmiotu sprzedaży na Kupującego Sprzedawca nie będzie go używać.<?php else: ?> do chwili przeniesienia własności przedmiotu sprzedaży na Kupującego Sprzedawca będzie go używał zgodnie z jego przeznaczeniem w taki sposób, aby jego stan techniczny nie uległ pogorszeniu.<?php endif; ?></li>
  <li>Sprzedawca zobowiązuje się do zabezpieczenia przedmiotu sprzedaży, tak aby w chwili przeniesienia własności na Kupującego znajdował się on w stanie technicznym niepogorszonym.</li>
  <li>Sprzedawca zobowiązuje się, że z przedmiotu sprzedaży nie będzie czynić  przedmiotu jakiegokolwiek innego stosunku prawnego z osobami trzecimi.</li>
  <li>Sprzedawca zobowiązuje się, że w przypadku ujawnienia do chwili przeniesienia własności na Kupującego praw osób trzecich obciążających przedmiot sprzedaży, niezwłocznie powiadomi o tym Kupującego.</li>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Wydanie przedmiotu sprzedaży i przejście własności</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Strony ustaliły, iż przedmiot sprzedaży zostanie odebrany przez Kupującego<?php if ($subff->data[149][0]=='0'):?> w dniu zawarcia niniejszej Umowy<?php else: ?> w terminie do [submission:values:terminie_odbioru:nolabel] dni od dnia zawarcia niniejszej Umowy, przy czym dokładny termin odbioru zostanie ustalony przez Strony za pomocą środków porozumiewania się wymienionych w&nbsp;pragrafie <b>Dane kontaktowe</b><?php endif; ?>.</li>
  <li>Odbiór przedmiotu sprzedaży nastąpi <?php if ($subff->data[151][0]=='siedziba'):?> w siedzibie Sprzedawcy<?php endif; ?><?php if ($subff->data[151][0]=='adressprzedajacego'):?> w miejscu wskazanym przez Sprzedawcę: ul.[submission:values:adres_odbioru_samochodu:ulica:nolabel], [submission:values:adres_odbioru_samochodu:kod_pocztowy:nolabel] [submission:values:adres_odbioru_samochodu:miejscowosc:nolabel]<?php endif; ?><?php if ($subff->data[151][0]=='adreskupujacego'):?> w miejscu wskazanym przez Kupującego: ul.[submission:values:adres_odbioru_samochodu:ulica:nolabel], [submission:values:adres_odbioru_samochodu:kod_pocztowy:nolabel] [submission:values:adres_odbioru_samochodu:miejscowosc:nolabel]<?php endif; ?>.</li>
  <li>W przypadku wystąpienia szczególnych okoliczności (np. ciężkie warunki atmosferyczne, choroba, działania lub zaniechania osób trzecich), Strony ustalą inny termin odbioru przedmiotu sprzedaży.</li>
  <li>Odbiór przedmiotu sprzedaży zostanie potwierdzony za pomocą protokołu zdawczo-odbiorczego, który będzie stanowił Załącznik do niniejszej Umowy. Protokół zdawczo-odbiorczy zostanie sporządzony w <?php echo $liczbaTekst[$subff->data[156][0]+$subff->data[157][0]]; ?> jednobrzmiących egzemplarzach, po <?php echo $liczbaTekst[$subff->data[156][0]]; ?> dla Kupującego i <?php echo $liczbaTekst[$subff->data[157][0]]; ?> dla Sprzedawcy oraz będzie podpisany przez każdą ze Stron.</li>

  <?php if ($subff->data[158][0]!=''): ?><li>Razem z samochodem, o którym mowa w ust. 1, Sprzedawca przekaże Kupującemu następujące dokumenty: <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;"><?php
      for ($i=0; $i<count($subff->data[158]); $i++){
        if ('gwari' == $subff->data[158][$i]) {
          echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].' '.$subff->data[160][0].';</li>';
        } elseif ('cert' == $subff->data[158][$i]) {
          echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].' '.$subff->data[161][0].';</li>';
        } elseif ('tlu' == $subff->data[158][$i]) {
          echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].' '.$subff->data[159][0].';</li>';
        } elseif ('inne' == $subff->data[158][$i]) {
          echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].' '.$subff->data[162][0].';</li>';
        } else {
          echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].';</li>';
        }
      }
      ?></ol></li><?php endif; ?>
  <li>Z chwilą odbioru przedmiotu sprzedaży na Kupującego przechodzą:
    <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;">
      <li>Wszystkie korzyści i ciężary związane z przedmiotem sprzedaży;</li>
      <li>Ryzyko przypadkowego uszkodzenia lub jego utraty;</li>
      <li>Odpowiedzialność i wszelkie ryzyka innego rodzaju.</li>
    </ol></li>
  <li>Własność przedmiotu sprzedaży przechodzi na Kupującego [submission:values:przejscie_wlasnosci_samochodu:nolabel].</li>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Odpowiedzialność za wady</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Sprzedawca oświadcza, iż przedmiot sprzedaży <?php if ($subff->data[164][0]=='nie'):?>nie jest objęty gwarancją.<?php else: ?>jest objęty gwarancją do dnia <?php echo date("d.m.Y", strtotime($subff->data[165][0]));?>r.<?php endif; ?></li>
  <?php if ($subff->data[164][0]=='tak'):?>
    <li>Oświadczenie gwarancyjne w dokumencie gwarancyjnym zawiera podstawowe informacje potrzebne do wykonywania uprawnień z gwarancji, w szczególności nazwę i adres gwaranta lub jego przedstawiciela w Rzeczypospolitej Polskiej, czas trwania i terytorialny zasięg ochrony gwarancyjnej, uprawnienia przysługujące w razie stwierdzenia wady, a także stwierdzenie, że gwarancja nie wyłącza, nie ogranicza ani nie zawiesza uprawnień kupującego wynikających z przepisów o rękojmi za wady rzeczy sprzedanej.</li>
    <li>Uprawnienia gwarancyjne są niezależne od uprawnień wynikających z rękojmi.</li>
  <?php endif; ?>


  <?php //!!!!!!!!!!!!!!!!!! ?>


  <?php if ($subff->data[216][0]=='tak'):?>
    <?php if (($subff->data[41][0]!='osfizyczna')&&($subff->data[42][0]=='osfizyczna')):?>
      <li>Sprzedawca odpowiada za wady niezgodności przedmiotu sprzedaży z Umową (wada fizyczna). W szczególności przedmiot sprzedaży jest niezgodny z Umową, jeżeli:
        <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;">
          <li>nie ma właściwości, które rzecz tego rodzaju powinna mieć ze względu na cel w umowie oznaczony albo wynikający z okoliczności lub przeznaczenia;</li>
          <li>nie ma właściwości, o których istnieniu Sprzedawca zapewnił Kupującego;</li>
          <li>nie nadaje się do celu, o którym Kupujący poinformował Sprzedawcę przy zawarciu Umowy, a Sprzedawca nie zgłosił zastrzeżenia co do takiego jej przeznaczenia;</li>
          <li>została Kupującemu wydana w stanie niezupełnym.</li>
        </ol></li>
      <li>Sprzedawca jest odpowiedzialny z tytułu rękojmi za wady fizyczne, które istniały w chwili przejścia niebezpieczeństwa na Kupującego lub wynikły z przyczyny tkwiącej w przedmiocie sprzedaży w tej samej chwili.</li>
      <li>Sprzedawca jest zwolniony od odpowiedzialności z tytułu rękojmi, jeżeli Kupujący wiedział o wadzie w chwili zawarcia Umowy.</li>
      <li>Jeżeli przedmiot sprzedaży ma wadę, Kupujący może złożyć oświadczenie o obniżeniu ceny albo odstąpieniu od Umowy, chyba że Sprzedawca niezwłocznie i bez nadmiernych niedogodności dla Kupującego wymieni przedmiot sprzedaży na wolny od wad albo wadę usunie. Ograniczenie to nie ma zastosowania, jeżeli rzecz była już wymieniona lub naprawiana przez Sprzedawcę albo Sprzedawca nie uczynił zadość obowiązkowi wymiany przedmiotu sprzedaży na wolny od wad lub usunięcia wady.</li>
      <li>W sytuacji wskazanej w ustępie poprzedzającym Kupujący może zamiast zaproponowanego przez Sprzedawcę usunięcia wady żądać wymiany przedmiotu sprzedaży na wolny od wad albo zamiast wymiany przedmiotu sprzedaży żądać usunięcia wady, chyba że doprowadzenie przedmiotu sprzedaży do zgodności z Umową w sposób wybrany przez Kupującego jest niemożliwe albo wymagałoby nadmiernych kosztów w porównaniu ze sposobem proponowanym przez Sprzedawcę. Przy ocenie nadmierności kosztów uwzględnia się wartość przedmiotu sprzedaży wolnego od wad, rodzaj i znaczenie stwierdzonej wady, a także bierze się pod uwagę niedogodności, na jakie narażałby Kupującego inny sposób zaspokojenia.</li>
      <li>Jeżeli przedmiot sprzedaży ma wadę, Kupujący może żądać wymiany przedmiotu sprzedaży na wolny od wad albo usunięcia wady. Sprzedawca jest obowiązany wymienić przedmiot sprzedaży na wolny od wad lub usunąć wadę w rozsądnym czasie bez nadmiernych niedogodności dla Kupującego. Sprzedawca może odmówić zadośćuczynienia żądaniu Kupującego, jeżeli doprowadzenie do zgodności z Umową przedmiotu sprzedaży w sposób wybrany przez Kupującego jest niemożliwe albo w porównaniu z drugim możliwym sposobem doprowadzenia do zgodności z Umową wymagałoby nadmiernych kosztów.</li>
      <li>Obniżona cena powinna pozostawać w takiej proporcji do ceny wynikającej z Umowy, w jakiej wartość przedmiotu sprzedaży z wadą pozostaje do wartości przedmiotu sprzedaży bez wady.</li>
      <li>Kupujący nie może odstąpić od Umowy, jeżeli wada jest nieistotna.</li>
      <li>Sprzedawca jest odpowiedzialny względem Kupującego, jeżeli przedmiot sprzedaży stanowi własność osoby trzeciej albo jeżeli jest obciążona prawem osoby trzeciej, a także jeżeli ograniczenie w korzystaniu lub rozporządzaniu przedmiotem sprzedaży wynika z decyzji lub orzeczenia właściwego organu (wada prawna).</li>
      <li>Sprzedawca odpowiada za wadę przez okres <?php if ($subff->data[219][0]=='rok') echo 'roku'; if ($subff->data[219][0]=='dwa') echo 'dwóch lat'; if ($subff->data[219][0]=='trzy') echo 'trzech lat'; ?> od chwili wydania przedmiotu sprzedaży Kupującemu.</li>
    <?php elseif ($subff->data[39][0]=='sprzedajacy'): ?>
      <li>Odpowiedzialność Sprzedawcy z tytułu odpowiedzialności za wady rzeczy (rękojmia) jest wyłączona, za wyjątkiem podstępnego zatajenia wady przez Sprzedawcę.</li>
    <?php else: ?>
      <?php if ($subff->data[217][0]!=''): ?>
        <li>Sprzedawca odpowiada za wady niezgodności przedmiotu sprzedaży z Umową (wada fizyczna). W szczególności przedmiot sprzedaży jest niezgodny z Umową, jeżeli:
        <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;">
          <?php
          for ($i=0; $i<count($subff->data[217]); $i++){
            if ('powinna' == $subff->data[217][$i]) {
              echo '<li>nie ma właściwości, które rzecz tego rodzaju powinna mieć ze względu na cel w umowie oznaczony albo wynikający z okoliczności lub przeznaczenia;</li>';
            } elseif ('zapewnil' == $subff->data[217][$i]) {
              echo '<li>nie ma właściwości, o których istnieniu Sprzedawca zapewnił Kupującego;</li>';
            } elseif ('przeznaczenie' == $subff->data[217][$i]) {
              echo '<li>nie nadaje się do celu, o którym Kupujący poinformował Sprzedawcę przy zawarciu Umowy, a Sprzedawca nie zgłosił zastrzeżenia co do takiego jej przeznaczenia;</li>';
            } elseif ('stan' == $subff->data[217][$i]) {
              echo '<li>został Kupującemu wydany w stanie niezupełnym;</li>';
            }
          } ?></ol>
        </li><?php endif; ?>
      <li>Sprzedawca jest odpowiedzialny z tytułu rękojmi za wady fizyczne, które istniały w chwili przejścia niebezpieczeństwa na Kupującego lub wynikły z przyczyny tkwiącej w przedmiocie sprzedaży w tej samej chwili.</li>
      <li>Sprzedawca jest zwolniony od odpowiedzialności z tytułu rękojmi, jeżeli Kupujący wiedział o wadzie w chwili zawarcia Umowy.</li>
      <?php $danePropozycje=''; $obnizonaCena=''; $nieistotnaWada=''; if ($subff->data[218][0]!=''): ?>
        <li>Jeżeli przedmiot sprzedaży ma wadę, Kupujący może:
        <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;">
          <?php
          for ($i=0; $i<count($subff->data[218]); $i++){
            if ('cena' == $subff->data[218][$i]) {
              echo '<li>złożyć oświadczenie o obniżeniu ceny;</li>';
              if ($subff->data[225][0]=='tak') $danePropozycje.= '<li>Sprzedawca może zamiast obniżenia ceny — zaproponować usunięcie wady przedmiotu sprzedaży;</li>';
              if ($subff->data[225][0]=='nie') $danePropozycje.= '<li>Sprzedawca nie może zamiast obniżenia ceny — zaproponować usunięcie wady przedmiotu sprzedaży;</li>';
              if ($subff->data[224][0]=='tak') $danePropozycje.= '<li>Sprzedawca może zamiast obniżenia ceny — zaproponować wymianę przedmiotu sprzedaży na przedmiot bez wady;</li>';
              if ($subff->data[224][0]=='nie') $danePropozycje.= '<li>Sprzedawca nie może zamiast obniżenia ceny — zaproponować wymianę przedmiotu sprzedaży na przedmiot bez wady;</li>';
              $obnizonaCena = '<li>Obniżona cena powinna pozostawać w takiej proporcji do ceny wynikającej z Umowy, w jakiej wartość przedmiotu sprzedaży z wadą pozostaje do wartości przedmiotu sprzedaży bez wady.</li>';
            } elseif ('odstapienie' == $subff->data[218][$i]) {
              echo '<li>złożyć oświadczenie o odstąpieniu od Umowy;</li>';
              if ($subff->data[221][0]=='tak') $danePropozycje.= '<li>Sprzedawca może zamiast odstąpienia od Umowy — zaproponować wymianę przedmiotu sprzedaży na przedmiot bez wady;</li>';
              if ($subff->data[221][0]=='nie') $danePropozycje.= '<li>Sprzedawca nie może zamiast odstąpienia od Umowy — zaproponować wymianę przedmiotu sprzedaży na przedmiot bez wady;</li>';
              if ($subff->data[222][0]=='tak') $danePropozycje.= '<li>Sprzedawca może zamiast odstąpienia od Umowy — zaproponować usunięcie wady przedmiotu sprzedaży;</li>';
              if ($subff->data[222][0]=='nie') $danePropozycje.= '<li>Sprzedawca nie może zamiast odstąpienia od Umowy — zaproponować usunięcie wady przedmiotu sprzedaży;</li>';
              if ($subff->data[223][0]=='tak') $danePropozycje.= '<li>Sprzedawca może zamiast odstąpienia od Umowy — zaproponować obniżenie ceny;</li>';
              if ($subff->data[223][0]=='nie') $danePropozycje.= '<li>Sprzedawca nie może zamiast odstąpienia od Umowy — zaproponować obniżenie ceny;</li>';
              $nieistotnaWada = '<li>Kupujący nie może odstąpić od Umowy, jeżeli wada jest nieistotna.</li>';
            } elseif ('wymiana' == $subff->data[218][$i]) {
              echo '<li>żądać wymiany przedmiotu sprzedaży na wolny od wad;</li>';
            } elseif ('usuniecie' == $subff->data[218][$i]) {
              echo '<li>żądać usunięcia wady w rozsądnym terminie;</li>';
              if ($subff->data[226][0]=='tak') $danePropozycje.= '<li>Sprzedawca może zamiast usunięcia wady przedmiotu sprzedaży — zaproponować wymianę przedmiotu sprzedaży na przedmiot bez wady;</li>';
              if ($subff->data[226][0]=='nie') $danePropozycje.= '<li>Sprzedawca nie może zamiast usunięcia wady przedmiotu sprzedaży — zaproponować wymianę przedmiotu sprzedaży na przedmiot bez wady;</li>';
              if ($subff->data[227][0]=='tak') $danePropozycje.= '<li>Sprzedawca może zamiast usunięcia wady przedmiotu sprzedaży — zaproponować obniżenie ceny;</li>';
              if ($subff->data[227][0]=='nie') $danePropozycje.= '<li>Sprzedawca nie może zamiast usunięcia wady przedmiotu sprzedaży — zaproponować obniżenie ceny;</li>';
            }

          } ?></ol>
        </li><?php endif; ?>
      <li>Sprzedawca <?php if ($subff->data[220][0]=='tak'): ?>może<?php else: ?>nie może<?php endif; ?> nie zgodzić się na wybrany przez Kupującego sposób usunięcia wady i zaproponować inne rozwiązanie.</li>
      <?php if ($danePropozycje!='') echo $danePropozycje; ?>
      <li>Jeżeli przedmiot sprzedaży był już wymieniony lub naprawiany przez Sprzedawcę, Kupujący <?php if ($subff->data[228][0]=='tak'): ?>może<?php else: ?>nie może<?php endif; ?> odstąpić od Umowy.</li>
      <?php echo $obnizonaCena.$nieistotnaWada; ?>
      <? //!!!!!!!!!!!!!!! ?>
      <li>Jeżeli rzecz sprzedana stanowi własność osoby trzeciej albo jeżeli jest obciążona prawem osoby trzeciej, a także jeżeli ograniczenie w korzystaniu lub rozporządzaniu rzeczą wynika z decyzji lub orzeczenia właściwego organu (wada prawna), Sprzedawca ponosi odpowiedzialność(ci) za taką wadę.</li>
      <li>Sprzedawca odpowiada za wadę przez okres <?php if ($subff->data[219][0]=='rok') echo 'roku'; if ($subff->data[219][0]=='dwa') echo 'dwóch lat'; if ($subff->data[219][0]=='trzy') echo 'trzech lat'; ?> od chwili wydania przedmiotu sprzedaży Kupującemu.</li>
    <?php endif; ?>
  <?php endif; ?>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Odstąpienie od Umowy</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Stronom przysługuje prawo do odstąpienia od niniejszej Umowy ze skutkiem natychmiastowym na zasadach określonych w niniejszym paragrafie.</li>
  <?php if ($subff->data[166][0]!='nikomu'):?>
    <li>Strony oświadczają, iż [submission:values:prawo_odstapienia_bez_przyczyny:nolabel] przysługuje prawo odstąpienia od Umowy bez podania przyczyny w okresie [submission:values:terminie_odstapienia:nolabel] dni od zawarcia Umowy bez podania przyczyny. Warunkiem skuteczności oświadczenia o odstąpieniu jest zapłata kwoty [submission:values:kwota_odstepnego:nolabel] złotych tytułem odstępnego.</li>
  <?php endif; ?>
  <?php if ($subff->data[169][0]!=''): ?><li>Sprzedawcy przysługuje prawo odstąpienia od Umowy ze skutkiem natychmiastowym w przypadku:<ol type="a" style="margin-left:0; padding-left:0; text-align:justify;"><?php
      for ($i=0; $i<count($subff->data[169]); $i++){
        if ('zwloki' == $subff->data[169][$i]) {
          echo '<li>zwłoki Kupującego w uiszczeniu ustalonej przez Strony ceny w sposób wskazany w § 5 niniejszej Umowy, po wyznaczeniu mu dodatkowego terminu na uiszczenie ceny, nie krótszego niż '.$subff->data[170][0].' dni;</li>';
        } elseif ('zadaku' == $subff->data[169][$i]) {
          echo '<li>nieuiszczenia przez Kupującego zadatku w umówionej wysokości i umówionym terminie;</li>';
        } elseif ('odbiorze' == $subff->data[169][$i]) {
          echo '<li>zwłoki Kupującego w odbiorze przedmiotu sprzedaży w sposób ustalony  zgodnie z § 7 niniejszej Umowy, po wyznaczeniu mu dodatkowego terminu na jego wydanie, nie krótszego niż '.$subff->data[171][0].' dni;</li>';
        } elseif ('innych' == $subff->data[169][$i]) {
          echo '<li>w innych przypadkach naruszenia istotnych postanowień niniejszej Umowy przez Kupującego;</li>';
        }
      }
      ?></ol></li><?php endif; ?>
  <?php if ($subff->data[172][0]!=''): ?><li>Kupującemu przysługuje umowne prawo odstąpienia od Umowy ze skutkiem natychmiastowym w przypadku:<ol type="a" style="margin-left:0; padding-left:0; text-align:justify;"><?php
      for ($i=0; $i<count($subff->data[172]); $i++){
        if ('zwloki' == $subff->data[172][$i]) {
          echo '<li>zwłoki Sprzedawcy w wydaniu Kupującemu przedmiotu sprzedaży, uniemożliwiającej Kupującemu skuteczne odebranie rzeczy, po wyznaczeniu mu dodatkowego terminu na jego wydanie, nie krótszego niż '.$subff->data[173][0].' dni;</li>';
        } else {
          echo '<li>'.$odstKupujacy[$subff->data[172][$i]].';</li>';
        }
      }
      ?></ol></li><?php endif; ?>
  <li>Oświadczenie o odstąpieniu od Umowy wymaga zachowania formy pisemnej pod rygorem nieważności i powinno zawierać uzasadnienie, poza odstąpieniem bez podania przyczyny.</li>
  <li>Sprzedawca jest zobowiązany zwrócić Kupującemu całość należności otrzymanych z tytułu uiszczenia ceny, a także zapłacić kary umowne naliczone zgodnie z Umową i zwrócić inne poniesione przez Kupującego koszty – jeżeli od Umowy odstąpił Kupujący z przyczyn leżących po stronie Sprzedawcy albo jeżeli od Umowy odstąpił Sprzedawca z przyczyn niezależnych od Kupującego.</li>
  <li>Sprzedawca jest zobowiązany zwrócić Kupującemu całość należności otrzymanych z tytułu uiszczenia ceny, jeżeli od Umowy odstąpił Kupujący z przyczyn niezależnych od Sprzedawcy.</li>
  <li>Jeżeli odstąpienie następuje po wydaniu przedmiotu sprzedaży, Kupujący ma obowiązek zwrócić Sprzedawcy przedmiot sprzedaży w stanie niepogorszonym, z chwili zaistnienia zdarzenia uzasadniającego odstąpienie od Umowy, a także zapłacić kary umowne naliczone zgodnie z Umową i zwrócić inne poniesione przez Sprzedawcę koszty – jeżeli od Umowy odstąpił Sprzedawca  z przyczyn leżących po stronie Kupującego.</li>
  <li>Jeżeli odstąpienie następuje po wydaniu przedmiotu sprzedaży, Kupujący ma obowiązek zwrócić Sprzedawcy przedmiot sprzedaży w stanie niepogorszonym, z chwili zaistnienia zdarzenia uzasadniającego odstąpienie od Umowy — jeżeli od Umowy odstąpił Kupujący z przyczyn niezależnych od Sprzedawcy.</li>
</ol><br />&nbsp;

<?php if (($subff->data[174][0]!='')||($subff->data[188][0]!='')||($subff->data[175][0]!='')||($subff->data[189][0]!='')): ?>
  <h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Kary umowne</h2>
  <ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">

    <?php if (($subff->data[174][0]!='')||($subff->data[175][0]!='')): ?>
      <li>Sprzedawcy przysługuje względem Kupującego kara umowna w przypadku:
        <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;"><?php
          if ($subff->data[174][0]!='') {
            for ($i=0; $i<count($subff->data[174]); $i++){
              preg_match_all('!\d+!', $subff->data[174][$i], $matches2);
              $wLiczbie = $subff->data[176+$matches2[0][0]][0];
              echo '<li>'.$tabelaKar1[$subff->data[174][$i]].' — w wysokości '.str_replace(".",",",$wLiczbie).' złotych (słownie: '.zmianaNaSlownie($wLiczbie).')'.$tabEndKar1[$subff->data[174][$i]].';</li>';
            }
            if ($subff->data[213][0]!='') echo '<li>naruszenia przez Kupującego obowiązku określonego przez niniejszą Umowę, innego niż poprzednio wymienione – w wysokości '.str_replace(".",",",$subff->data[184][0]).' złotych (słownie: '.zmianaNaSlownie($subff->data[184][0]).');</li>';
          } else {
            echo '<li>naruszenia przez Kupującego jakiegokolwiek obowiązku określonego przez niniejszą Umowę – w wysokości '.str_replace(".",",",$subff->data[183][0]).' złotych (słownie:'.zmianaNaSlownie($subff->data[183][0]).');</li>';
          }
          ?></ol>
      </li>
    <?php endif; ?>
    <?php if (($subff->data[188][0]!='')||($subff->data[189][0]!='')): ?>
      <li>Kupującemu przysługuje względem Sprzedawcy kara umowna w przypadku:
        <ol type="a" style="margin-left:0; padding-left:0; text-align:justify;"><?php
          if ($subff->data[188][0]!='') {
            for ($i=0; $i<count($subff->data[188]); $i++){
              preg_match_all('!\d+!', $subff->data[188][$i], $matches2);
              $wLiczbie = $subff->data[189+$matches2[0][0]][0];
              echo '<li>'.$tabelaKar2[$subff->data[188][$i]].' — w wysokości '.str_replace(".",",",$wLiczbie).' złotych (słownie: '.zmianaNaSlownie($wLiczbie).')'.$tabEndKar2[$subff->data[188][$i]].';</li>';
            }
            if ($subff->data[214][0]!='') echo '<li>naruszenia przez Sprzedawcę obowiązku określonego przez niniejszą Umowę, innego niż poprzednio wymienione — w wysokości '.str_replace(".",",",$subff->data[212][0]).' złotych (słownie: '.zmianaNaSlownie($subff->data[212][0]).');</li>';
          } else {
            echo '<li>naruszenia przez Sprzedawcę jakiegokolwiek obowiązku określonego przez niniejszą Umowę – w wysokości '.str_replace(".",",",$subff->data[211][0]).' złotych (słownie:'.zmianaNaSlownie($subff->data[211][0]).');</li>';
          }
          ?></ol>
      </li>
    <?php endif; ?>
    <li>Naliczone przez Strony kary umowne nie ograniczają ich roszczeń do dochodzenia odszkodowania na zasadach ogólnych prawa cywilnego, jeżeli wysokość kar umownych nie pokrywa poniesionych przez Strony szkód wywołanych przez drugą stronę.</li>
    <li>Kary umowne podlegają kumulowaniu i nie wykluczają się wzajemnie, jednakże ich łączna wysokość nie może być wyższa niż <?php echo str_replace(".",",",$subff->data[215][0]); ?> złotych (słownie: <?php echo zmianaNaSlownie($subff->data[215][0]); ?>);</li>
  </ol><br />&nbsp;
<?php endif; ?>

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Dane kontaktowe</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Strony będą się kontaktować w następujący sposób:
    <ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;"><?php

      for ($i=0; $i<count($subff->data[233]); $i++){

        if ($subff->data[233][$i]=="telefon") {
          echo '<li>telefonicznie:</li>
			<ol type="i" style="margin-left:0; padding-left:0; text-align:justify;"><li>Sprzedawca:<br />';
          for ($j=0; $j<count($subff->data[235]);$j++) {
            echo '<b>'.$subff->wfm_data[235][234][239][$j].'</b>,<br />';
          }

          echo '</li><li>Kupujący:<br />';
          for ($j=0; $j<count($subff->data[236]);$j++) {
            echo '<b>'.$subff->wfm_data[236][234][236][$j].'</b>,<br />';
          }

          echo '</li></ol>';
        }

        if ($subff->data[233][$i]=="sms") {
          echo '<li>SMS:</li>
			<ol type="i" style="margin-left:0; padding-left:0; text-align:justify;"><li>Sprzedawca:<br />';
          for ($j=0; $j<count($subff->data[239]);$j++) {
            echo '<b>'.$subff->wfm_data[239][237][239][$j].'</b>,<br />';
          }

          echo '</li><li>Kupujący:<br />';
          for ($j=0; $j<count($subff->data[238]);$j++) {
            echo '<b>'.$subff->wfm_data[238][237][238][$j].'</b>,<br />';
          }

          echo '</li></ol>';
        }

        if ($subff->data[233][$i]=="email") {
          echo '<li>pocztą elektroniczną:</li>
			<ol type="i" style="margin-left:0; padding-left:0; text-align:justify;"><li>Sprzedawca:<br />';
          for ($j=0; $j<count($subff->data[242]);$j++) {
            echo '<b>'.$subff->wfm_data[242][240][242][$j].'</b>,<br />';
          }

          echo '</li><li>Kupujący:<br />';
          for ($j=0; $j<count($subff->data[241]);$j++) {
            echo '<b>'.$subff->wfm_data[241][240][241][$j].'</b>,<br />';
          }

          echo '</li></ol>';
        }

        if ($subff->data[233][$i]=="poczta") {
          echo '<li>pocztą zwykłą:</li>
			<ol type="i" style="margin-left:0; padding-left:0; text-align:justify;"><li>Sprzedawca:<br />';
          for ($j=0; $j<count($subff->data[250]);$j++) {
            echo '<b>'.$subff->wfm_data[250][243][249][$j][250][0].'<br />'.$subff->wfm_data[251][243][249][$j][251][0].'<br />'.$subff->wfm_data[252][243][249][$j][252][0].' '.$subff->wfm_data[253][243][249][$j][253][0].'</b><br />';
            if ($j<count($subff->data[250])-1) echo '<br />';
          }

          echo '</li><li>Kupujący:<br />';
          for ($j=0; $j<count($subff->data[245]);$j++) {
            echo '<b>'.$subff->wfm_data[245][243][244][$j][250][0].'<br />'.$subff->wfm_data[246][243][244][$j][251][0].'<br />'.$subff->wfm_data[247][243][244][$j][252][0].' '.$subff->wfm_data[248][243][244][$j][253][0].'</b><br />';
            if ($j<count($subff->data[245])-1) echo '<br />';
          }
          echo '</li></ol>';
        }

      }

      ?></ol>
  </li>
  <?php

  for ($i=0; $i<count($subff->data[233]); $i++){
    if ($subff->data[233][$i]=="email") {
      echo '<li>Email zostanie uznany za doręczony w razie otrzymania potwierdzenia jego odczytania (wyświetlenia na ekranie komputera adresata).</li>';
    }

    if ($subff->data[233][$i]=="poczta") {
      echo '<li>Nieodebrany list polecony, skierowany do Strony, zostanie uznany za skutecznie doręczony w dniu powtórnego awizowania.</li>';
    }
  }
  ?>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Poufność</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Strony zobowiązują się, iż będą traktować Umowę jako poufną. Zabronione jest, poza wyjątkami określonymi w przepisach odrębnych:
    <ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
      <li>przekazywanie informacji związanych z treścią Umowy jak i jej realizacją osobom trzecim;</li>
      <li>ujawnianie treści Umowy w części lub w całości osobom trzecim bez pisemnej zgody drugiej Strony.</li>
    </ol></li>
  <li>Ograniczenia, o których mowa w ust.1 nie będą miały zastosowania w przypadku, gdy informacje lub treści objęte klauzulą poufności
    <ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
      <li>staną się publicznie dostępne bez naruszenia postanowień niniejszej Umowy;</li>
      <li>zostaną ujawnione jakiejkolwiek osobie trzeciej po uzyskaniu uprzedniej pisemnej zgody drugiej Strony;</li>
      <li>ich ujawnienie będzie wymagane przepisami prawa lub orzeczeniem właściwego sądu pod warunkiem, że Strona ujawniająca zawiadomi drugą Stronę o tym obowiązku przed takim ujawnieniem.</li>
    </ol></li>
  <li>Postanowienia o poufności, o których mowa  w ust. 1, nie będą stanowiły przeszkody dla którejkolwiek ze Stron w ujawnieniu informacji działającemu w imieniu Strony prawnikowi., z zastrzeżeniem zachowania przez niego wymogów określonych w ust. 1-2.</li>
  <li>Strony zobowiązują się, iż podejmą wszelkie środki niezbędne do dochowania niniejszej klauzuli poufności przez ich pracowników, konsultantów, zastępców, itp.</li>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Siła wyższa</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Strony są zwolnione od odpowiedzialności za niewykonanie lub nienależyte wykonanie Umowy, jeżeli na realizację jej postanowień miała wpływ siła wyższa.</li>
  <li>Przez pojęcie siły wyższej Strony zgodnie rozumieją zdarzenie nagłe, zewnętrzne, niemożliwe do przewidzenia i niezależne od Stron, uniemożliwiające stałą lub czasową realizację postanowień Umowy lub jej części, któremu nie można zapobiec, ani przeciwdziałać przy zachowaniu należytej staranności, a w szczególności:
    <ol type="a" style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
      <li>klęski żywiołowe jak np. pożar, powódź, susza, trzęsienie ziemi, huragany, itd.;</li>
      <li>strajki o zasięgu lokalnym, krajowym;</li>
      <li>działania wojenne, akty sabotażu i terroryzmu.</li>
    </ol></li>
  <li>Strona, która nie może wykonać zobowiązania ze względu na stan określony w ust. 2 jest zobowiązana do poinformowania drugą stronę na piśmie o tym fakcie w okresie 3 dni od dnia wystąpienia niniejszego stanu. Strona ta jest zobowiązana do przedstawienia we wspomnianym piśmie okoliczności niebudzące wątpliwości na potwierdzenie zaistnienia stanu siły wyższej, a także wskazać widoki na realizację świadczenia w przyszłości.</li>
  <li>Strony uzgodnią sposób wykonania postanowień umowy niezwłocznie, nie później jednak niż w terminie 7 dni od dnia otrzymania wskazanego w ust. 3 pisma.</li>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Interpretacja Umowy</h2>
<ol style="margin-left:0; padding-left:0; text-align:justify; font-size:40px; line-height:60px;">
  <li>Użyte w Umowie nagłówki jednostek redakcyjnych (paragrafów) mają charakter informacyjny dla wygody Stron i nie wpływają na interpretację Umowy.</li>
  <li>W przypadku rozbieżności między treścią Umowy a innymi ustaleniami Stron wiążące są postanowienia  niniejszej Umowy.</li>
  <li>Wszystkie załączniki do Umowy stanowią jej integralną część.</li>
</ol><br />&nbsp;

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Zmiany Umowy</h2>
<p style="text-align:justify; line-height:60px; font-size:40px;">Wszelkie zmiany i uzupełnienia niniejszej Umowy wymagają zachowania formy pisemnej pod rygorem nieważności.<br />&nbsp;</p>

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Sprawy nieuregulowane Umową</h2>
<p style="text-align:justify; line-height:60px; font-size:40px;">W kwestiach nieuregulowanych postanowieniami niniejszej Umowy zastosowanie mają przepisy Kodeksu cywilnego z dnia 23 kwietnia 1964 r. (t. j. Dz. U. 2016 poz. 380, z późn. zm.) oraz inne właściwe przepisy prawa.<br />&nbsp;</p>

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Klauzula salwatoryjna</h2>
<p style="text-align:justify; line-height:60px; font-size:40px;">Jeżeli jakiekolwiek postanowienie Umowy zostanie uznane za nieważne, bezskuteczne lub niemożliwe do wyegzekwowania w całości lub części, nie wpłynie to na ważność, skuteczność lub możliwość wyegzekwowania pozostałych postanowień Umowy. Ponadto Strony zgadzają się zastąpić takie postanowienie innym postanowieniem wynegocjowanym w dobrej wierze, które powinno, na ile jest to możliwe, dążyć do osiągnięcia pierwotny celu ekonomicznego zamierzonego przez Strony.<br />&nbsp;</p>

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Sprawy nieuregulowane Umową</h2>
<p style="text-align:justify; line-height:60px; font-size:40px;">Jakiekolwiek spory wynikłe pomiędzy Stronami na tle zawarcia umowy, ustalenia jej treści, ustalenia istnienia umowy oraz jej wykonania, rozwiązania lub unieważnienia, a także ewentualnego odszkodowania z powodu niewykonania lub nienależytego wykonania niniejszej Umowy, Strony zobowiązują się w celu polubownego rozwiązania sporu podjąć w dobrej wierze negocjacje, a jeśli w terminie 30 od dnia powstania sporu nie uda się osiągnąć na drodze polubownej porozumienia,  spór ten zostanie poddany pod rozstrzygnięcie sądu powszechnego  właściwemu <?php if (($subff->data[41][0]!='osfizyczna')&&($subff->data[42][0]=='osfizyczna')):?>zgodnie z przepisami Kodeksu postępowania cywilnego z dnia 17 listopada 1964 r. (t. j. Dz. U. 2014 poz. 101, z późn. zm.)<?php elseif($subff->data[230][0]=='kupujacy'): ?><?php if ($subff->data[42][0] == 'osfizyczna') echo 'miejsca zamieszkania'; else echo 'siedziby';?> Kupującego<?php else: ?><?php if ($subff->data[41][0] == 'osfizyczna') echo 'miejsca zamieszkania'; else echo 'siedziby'; ?> Sprzedawcy<?php endif; ?>.<br />&nbsp;</p>

<h2 style="text-align: center; font-size:46px;">§ <?php echo $paragraf++;?> Liczba egzemplarzy</h2>
<p style="text-align:justify; line-height:60px; font-size:40px;">Umowę sporządzono w <?php echo $liczbaTekst[$subff->data[231][0]+$subff->data[232][0]]; ?> jednobrzmiących egzemplarzach, <?php echo $liczbaTekst[$subff->data[232][0]]; ?> dla Sprzedawcy i <?php echo $liczbaTekst[$subff->data[231][0]]; ?> dla Kupującego.<br />&nbsp;<br />&nbsp;</p>

<p style="line-height:60px;">........................................ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ............................................<br />&nbsp; &nbsp; &nbsp;  &nbsp; Sprzedawca &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Kupujący</p>


<br pagebreak="true"/>
<p style="text-align:right">.................................., dn. ................. r.</p>
<h1 style="text-align:center;">Protokół zdawczo-odbiorczy samochodu</h1>
<p style="text-align:justify; line-height:60px; font-size:40px;">W dniu ………………… Sprzedawca:
<ol style="text-align:justify; line-height:60px; font-size:40px;">
  <li>………………………………., zam./z siedzibą przy ul. ……………………………………., ……………………………………………….,<br /></li>
  <li>………………………………., zam./z siedzibą przy ul. ……………………………………., ……………………………………………….,<br /></li>
  <li>………………………………., zam./z siedzibą przy ul. ……………………………………., ……………………………………………….,<br /></li>
</ol></p>

<p style="text-align:justify; line-height:60px; font-size:40px;">oraz Kupujący:
<ol style="text-align:justify; line-height:60px; font-size:40px;">
  <li>………………………………., zam./z siedzibą przy ul. ……………………………………., ……………………………………………….,<br /></li>
  <li>………………………………., zam./z siedzibą przy ul. ……………………………………., ……………………………………………….,<br /></li>
  <li>………………………………., zam./z siedzibą przy ul. ……………………………………., ……………………………………………….,<br /></li>
</ol></p>
<p style="text-align:justify; line-height:60px; font-size:40px;">sporządzili następujący protokół zdawczo-odbiorczy samochodu marki <?php echo strtoupper($subff->data[1][0]); ?>, model <?php echo strtoupper($subff->data[2][0]); ?>, wersja [submission:values:dane_pojazdu:wersja_samochodu:nolabel], rok produkcji [submission:values:dane_pojazdu:rok_produkcji:nolabel], który jest przedmiotem umowy sprzedaży zawartej w dniu <?php echo date("d.m.Y", strtotime($subff->data[257][0])); ?>r.</p>
<ol style="text-align:justify; line-height:60px; font-size:40px;">
  <li>W dniu .................................. Sprzedawca przekazał Kupującemu samochód oraz:
    <ul>
      <?php if ($subff->data[38][0]!=''): ?><?php
        for ($i=0; $i<count($subff->data[38]); $i++){
          if (array_key_exists($subff->data[38][$i], $tabelaDodatkow)) {
            echo '<li>'.$tabelaDodatkow[$subff->data[38][$i]].';</li>';
          } else  echo '<li>'.$subff->data[38][$i].';</li>';
        }
        ?><?php endif; ?>
      <li> …………………………………………………………………………………..,</li>
      <li> …………………………………………………………………………………..,</li>
      <li> …………………………………………………………………………………..,</li>
      <li> …………………………………………………………………………………..,</li>
      <li> …………………………………………………………………………………..</li>
    </ul>
  </li>




  <li>Kupujący niniejszym potwierdza/ją odbiór:
    <ul>
      <li>samochodu,</li>
      <?php if ($subff->data[38][0]!=''): ?><?php
        for ($i=0; $i<count($subff->data[38]); $i++){
          if (array_key_exists($subff->data[38][$i], $tabelaDodatkow)) {
            echo '<li>'.$tabelaDodatkow[$subff->data[38][$i]].';</li>';
          } else  echo '<li>'.$subff->data[38][$i].';</li>';
        }
        ?><?php endif; ?>
      <li> …………………………………………………………………………………..,</li>
      <li> …………………………………………………………………………………..,</li>
      <li> …………………………………………………………………………………..,</li>
      <li> …………………………………………………………………………………..,</li>
      <li> …………………………………………………………………………………..</li>
    </ul>
  </li>
  <li>Kupujący niniejszym potwierdza/ją odbiór następujących dokumentów:
    <ul>
      <?php if ($subff->data[158][0]!=''): ?><?php
        for ($i=0; $i<count($subff->data[158]); $i++){
          if ('gwari' == $subff->data[158][$i]) {
            echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].' '.$subff->data[160][0].';</li>';
          } elseif ('cert' == $subff->data[158][$i]) {
            echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].' '.$subff->data[161][0].';</li>';
          } elseif ('tlu' == $subff->data[158][$i]) {
            echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].' '.$subff->data[159][0].';</li>';
          } elseif ('inne' == $subff->data[158][$i]) {
            echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].' '.$subff->data[162][0].';</li>';
          } else {
            echo '<li>'.$tabelaDokumentow[$subff->data[158][$i]].';</li>';
          }
        }
        ?><?php endif; ?>
      <li> ..................................................,</li>
      <li> ..................................................,</li>
      <li> ..................................................,</li>
      <li> ..................................................,</li>
      <li> …...............................................</li>
    </ul>
  </li>
  <li>Opis stanu technicznego:<br />
    …........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................
  </li>
  <li>Uwagi i zastrzeżenia do stanu samochodu oraz elementów jego wyposażenia:<br />
    …......................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................
  </li>
  <li>Niniejszy protokół sporządzono w …………… jednobrzmiących egzemplarzach, po …………. dla każdej ze stron.
  </li>
  <li>Strony potwierdzają zgodność protokołu ze stanem faktycznym.<br />&nbsp;
  </li>
</ol>
<p style="line-height:60px;">........................................ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ............................................<br />&nbsp; &nbsp; &nbsp;  &nbsp; Sprzedawca &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Kupujący</p>

<p style="line-height:60px;">........................................ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ............................................<br />&nbsp; &nbsp; &nbsp;  &nbsp; Sprzedawca &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Kupujący</p>

<p style="line-height:60px;">........................................ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ............................................<br />&nbsp; &nbsp; &nbsp;  &nbsp; Sprzedawca &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Kupujący</p>


<pre>
<?php
//print_r($subff->wfm_data[410]);
//print_r($subff->wfm_data[409]);
//print_r($subff->wfm_data[411]);
?></pre>
