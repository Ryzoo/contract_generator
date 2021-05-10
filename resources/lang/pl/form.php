<?php

return [
    'variableForm' => [
        'new' => [
            'title' => 'Dodaj nową zmienną'
        ],
        'update' => [
            'title' => 'Aktualizuj zmienną'
        ],
        'isMultiUse' => 'Użyj wielu wartości',
        'forAnonymise' => 'Do anonimizacji?',
        'additionalInformation' => 'Dodatkowe informacje',
        'defaultValue' => 'Domyślna wartość',
        'defaultValueHint' => [
            'dateTime' => 'Używaj tylko tekstu, który jest dozwolony w metodzie strtotime'
        ],
        'label' => 'Etykieta',
        'placeholder' => 'Placeholder',
        'name' => 'Nazwa',
        'type' => 'Typ',
        'isRequired' => 'Czy wymagane?',
        'multiRenderType' => 'Typ renderu',
        'isMultiSelect' => 'Czy pole wielokrotne?',
        'isInline' => 'W lini?',
        'lengthMin' => 'Min długość',
        'lengthMax' => 'Maks długość',
        'valueMin' => 'Min wartość',
        'valueMax' => 'Max wartość',
        'items' => 'Opcje do wyboru',
        'itemsHint' => 'wpisz słowo i kliknij enter',
        'selectVariables' => 'Wybierz zmienne do grupy'
    ],
    'login' => [
        'title' => 'Formularz logowania',
        'text' => [
            'forgotPassword' => 'Zapomniałeś hasła?'
        ],
        'link' => [
            'resetPassword' => 'Resetowanie hasła'
        ],
        'notify' => [
            'success' => 'Zalogowano pomyślnie'
        ]
    ],
    'register' => [
        'title' => 'Formularz rejestracji',
        'link' => [
            'rodo' => ' Polityka rodo',
            'regulations' => ' Regulamin strony'
        ],
        'button' => [
            'login' => 'Mam już konto'
        ],
        'notify' => [
            'success' => 'Konto dodane pomyślnie. Sprawdź swoją skrzynkę pocztową, aby potwierdzić.'
        ]
    ],
    'sendResetTokenForm' => [
        'title' => 'Wyślij token resetowania hasła',
        'notify' => [
            'success' => 'Tokene resetowania hasła został wysłany. Sprawdź swoją skrzynkę pocztową i użyj go aby zresetować hasło.'
        ]
    ],
    'resetPasswordForm' => [
        'title' => 'Formularz resetowania hasła',
        'notify' => [
            'success' => 'Twoje hasło zostało pomyślnie zmienione. Możesz się teraz zalogować'
        ]
    ],
    'profileEditForm' => [
        'button' => [
            'change_img' => 'Zmień zdjęcie profilowe',
            'save_img' => 'Zapisz aktualne zdjęcie',
        ],
        'notify' => [
            'success' => 'Twoje podstawowe dane zostały zapisane.'
        ]
    ],
    'accountAddForm' => [
        'title' => "Dodaj nowe konto",
        'button' => [
            'prev' => 'Powrót do konta',
        ],
        'notify' => [
            'success' => 'Nowe konto utworzone'
        ]
    ],
    'roleAddForm' => [
        'title' => "Dodaj nową rolę",
        'notify' => [
            'success' => 'Nowa rola utworzona'
        ]
    ],
    'roleEditForm' => [
        'title' => "Zmień rolę",
        'notify' => [
            'success' => 'Rola zmieniona'
        ]
    ],
    'categoryAddForm' => [
        'title' => "Dodaj nową kategorię",
        'notify' => [
            'success' => 'Kategoria dodana'
        ]
    ],
    'categoryEditForm' => [
        'title' => "Edytuj kategorię",
        'notify' => [
            'success' => 'Kategoria zmieniona'
        ]
    ],
    'accountEditForm' => [
        'title' => "Zmień konto",
        'button' => [
            'prev' => 'Powrót do kont',
        ],
        'notify' => [
            'success' => 'Konto zmienione',
            'success_img' => 'Zdjęcie zmienione'
        ]
    ],
    'accountChangePasswordForm' => [
        'notify' => [
            'success' => 'Hasło zmienione',
        ]
    ],
    'accountRemoveForm' => [
        'title' => "Usuń hasło",
    ],
    'roleRemoveForm' => [
        'title' => "Usuń role",
        'notify' => [
            'successRemove' => "Rola usunięta"
        ]
    ],
    'categoryRemoveForm' => [
        'title' => "Usuń kategorię",
        'notify' => [
            'successRemove' => "Kategoria usunięta"
        ]
    ],
    'removeContractForm' => [
        'title' => "Usuń formularz"
    ],
    'contractAddForm' => [
        'title' => "Dodaj formularz",
        'title_modules' => 'Wybierz moduły do formularza',
        'description' => [
            'modules' => "Każdy moduł to pewna odpowiedzialność. Możesz wybrać, które moduły mają być aktywne i przejść do konfiguracji każdego z nich, aby je spersonalizować."
        ],
        'field' => [
            "contract_name" => "Nazwa formularza",
            "contract_description" => "Opis formularza",
            "contract_categories" => "Kategorie formularza",
        ],
        'notify' => [
            'success' => "Formularz zapisany"
        ]
    ]
];
