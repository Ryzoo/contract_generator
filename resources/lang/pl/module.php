<?php

return [
    'provider' => [
        'title' => 'Dostarczenie',
        'description' => 'Dostarcza plik pdf z umową',
        'descriptionConfig' => 'Ten moduł określa, gdzie renderowana umowa powinna być dostarczona użytkownikowi',
        'successNotify' => 'Pomyślnie wyrenderowano',
        'type' => [
            'renderAfterFinish' => 'Renderuj do pdf po zakończeniu',
            'renderToEmail' => 'Wyślij na e-mail użytkownika',
        ]
    ],
    'payment' => [
        'title' => 'Płatności',
        'description' => 'Ta umowa wymaga zapłaty. Zostanie wyrenderowany tylko wtedy, gdy zostanie opłacony. Szczegóły znajdziesz pod przyciskiem płatności po wypełnieniu tego formularza.',
        'descriptionConfig' => 'Moduł ten określa ustawienia płatności dla klienta.',
    ],
    'auth' => [
        'title' => 'Upoważnienie',
        'authOptions' => 'Opcje autoryzacji',
        'pwdToAccess' => 'Hasło dostępu',
        'descriptionAuth' => 'Tylko osoba znająca hasło może uzyskać dostęp do tego formularza umowy',
        'description' => 'Tylko zalogowany użytkownik może uzyskać dostęp do tej umowy',
        'descriptionConfig' => 'Auth udostępnia kilka opcji określania dostępu klienta. Wybierz jeden:',
        'successNotify' => 'Autoryzacja pomyślna',
        'type' => [
            'accessForLogged' => 'Dostęp dla zalogowanego użytkownika',
            'accessWithPwd' => 'Dostęp z hasłem'
        ]
    ],
    'header' => [
        'moduleConfiguration' => 'Konfiguracja modułu:'
    ],
    'base' => [
        'step' => 'Krok:'
    ],
    'notify' => [
        'completeAllElement' => 'Wypełnij poprawnie wszystkie dane na tej stronie, aby przejść dalej!'
    ]
];
