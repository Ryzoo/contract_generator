<template>
    <section>
        <v-row>
            <v-col cols="12" class="pa-5 mx-5">
                <h1 class="mb-5">Reklamacja - Kurjerzy</h1>
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
                                <div class="regkujerzy">
                                    <span style="color: #000000">Kur</span
                                    >Jerzy<span style="color: #000000"
                                        >.pl</span
                                    >
                                </div>
                                <h3 class="text-center">
                                    Regulamin świadczenia Usług
                                </h3>
                                <p>
                                    <small
                                        >Otwórz w nowym oknie stronę KurJerzy z
                                        aktualnymi regulaminami usług.</small
                                    >
                                </p>
                                <v-btn
                                    class="my-3"
                                    color="primary"
                                    small
                                    target="_blank"
                                    href="https://www.kurjerzy.pl/regulamin"
                                    >Przejdź do regulaminu »</v-btn
                                >
                            </ActionCard>
                            <ActionCard height="220" :big="true">
                                <div class="regkujerzy">
                                    <span style="color: #000000">Kur</span
                                    >Jerzy<span style="color: #000000"
                                        >.pl</span
                                    >
                                </div>
                                <h3 class="text-center">
                                    KurJerzy - Formularz Reklamacji
                                </h3>
                                <p>
                                    <small
                                        >Otwórz w nowym oknie plik<br />z
                                        formularzem reklamacji.</small
                                    >
                                </p>
                                <v-btn
                                    class="my-3"
                                    color="primary"
                                    small
                                    target="_blank"
                                    href="https://static.kurjerzy.pl/web-latest/files/protokol_reklamacji_11_10_2019.pdf"
                                    >Pobierz plik »</v-btn
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
                                    <i class="fa fa-question-circle"></i> &nbsp;
                                    Czy broker "KurJerzy" ponosi
                                    odpowiedzialność za uszkodzenie lub
                                    zgubienie paczki?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p><strong>NIE</strong></p>

                                <p>
                                    Zgodnie z § 15 ust. 1 Regulaminu
                                    (https://www.kurjerzy.pl/regulamin),
                                    reklamacje z powodu uszkodzenia lub
                                    zgubienia paczki należy kierować do firmy
                                    kurierskiej – „Zleceniobiorca nie świadczy
                                    usług przewozu przesyłek. Usługi przewozu
                                    wykonywane są przez Kurierów, którzy ponoszą
                                    własną odpowiedzialność za swoje działania”
                                </p>

                                <p>
                                    Dodatkowo, w § 13 ust. 2 zapisano -
                                    „Zleceniobiorca, jako strona zawartej z
                                    Kurierem umowy Przewozu, przenosi na
                                    Zleceniodawcę, na podstawie niniejszego
                                    Regulaminu, wynikające z umowy przewozu
                                    uprawnienia Nadawcy względem Kuriera, w tym
                                    prawo do składania Reklamacji Przesyłki
                                    bezpośrednio u Kuriera.”
                                </p>

                                <p>
                                    <strong>Wyjaśnienie:</strong><br />
                                    Brokerzy pośredniczą jedynie przy zawarciu
                                    umowy z firmą kurierską, sami nie świadczą
                                    usług przewozowych. Oznacza to, że brokerzy
                                    nie ponoszą odpowiedzialności za uszkodzenie
                                    lub zagubienie przesyłki. Wszelkie
                                    reklamacje należy kierować bezpośrednio do
                                    tej firmy kurierskiej, przez którą paczka
                                    została przesłana. Kierowanie reklamacji do
                                    brokera zamiast do przewoźnika jest
                                    nieskuteczne, w konsekwencji takie błędne
                                    działanie może skutkować upływem terminu, w
                                    którym możliwa jest reklamacja uszkodzonej
                                    lub zgubionej przesyłki.
                                </p>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>
                                <h2>
                                    <i class="fa fa-file-upload"></i> &nbsp; 2.
                                    Jak mogę złożyć reklamację?
                                </h2>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <p>
                                    Wszelkie reklamacje powinno kierować się
                                    bezpośrednio do tej firmy kurierskiej, przez
                                    którą paczka została przesłana.
                                </p>

                                <p>
                                    Kierowanie reklamacji do brokera zamiast do
                                    przewoźnika jest nieskuteczne, w
                                    konsekwencji takie błędne działanie może
                                    skutkować upływem terminu, w którym możliwa
                                    jest reklamacja uszkodzonej lub zgubionej
                                    przesyłki.
                                </p>

                                <p>&nbsp;</p>

                                <p>
                                    Aby samodzielnie złożyć reklamację, ustal
                                    jaka firma kurierska faktycznie wykonywała
                                    usługę. Następnie sprawdź w jaki sposób
                                    możesz dochodzić swoich praw, wybierając
                                    konkretnego kuriera na stronie:
                                    <a
                                        href="https://odszkodowanieodkuriera.pl/regulaminy"
                                        >https://odszkodowanieodkuriera.pl/regulaminy</a
                                    >.
                                </p>

                                <p>&nbsp;</p>

                                <p>
                                    Zgodnie z § 13 ust. 4, broker Richert
                                    KurJerzy sp. k. może pośredniczyć w procesie
                                    złożenia reklamacji - „Zarówno Nadawca jak i
                                    Odbiorca mogą składać reklamacje Przesyłek
                                    za pośrednictwem Zleceniobiorcy. Złożenie
                                    reklamacji za pośrednictwem Zleceniobiorcy
                                    równoznaczne jest z udzieleniem
                                    Zleceniobiorcy upoważnienia do wykonywania
                                    uprawnień z tytułu reklamacji wobec
                                    Kuriera.„
                                </p>

                                <p>
                                    <strong
                                        >Powyższego zapisu nie należy
                                        interpretować w ten sposób, że to
                                        pośrednik odpowiada za uszkodzenie lub
                                        zgubienie paczki.</strong
                                    >
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
    name: 'ComplaintKurjerzy',
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
