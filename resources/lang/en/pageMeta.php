<?php

return [
    'appTitle' => 'Contract Generator',
    'copyright' => 'All rights reserved - Contract Generator',
    'auth' => [
        'login' => [
            'title' => 'Login',
        ],
        'register' => [
            'title' => 'Register account',
        ],
        'resetPassword' => [
            'title' => 'Reset password',
        ],
        'sendResetPasswordToken' => [
            'title' => 'Reset password token',
        ],
    ],
    'panel' => [
        'dashboard' => [
            'title' => 'Panel - Dashboard',
        ],
        'profile' => [
            'title' => 'Panel - My Profile',
            'info' => 'After update, all data will change after you refresh the page',
            'tabs' => [
                'basic_data' => [
                    'name' => "Basic data"
                ]
            ]
        ],
        'accounts' => [
            'title' => 'Panel - Accounts',
            'create' => [
                'title' => 'Create new account',
            ],
        ],
        'agreements' => [
            'title' => 'Panel - Agreements',
            'button' => [
                'newAgreement' => 'Add agreement',
            ],
            'headers' => [
                'name' => 'Name',
                'status' => 'Status',
                'dateAdd' => 'Add date',
                'actions' => 'Actions',
            ],
            'create' => [
                'title' => 'Create new agreement',
            ],
        ],
    ]
];
