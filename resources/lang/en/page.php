<?php

return [
    'panel' => [
        'profile' => [
            'base' => [
              'success_change_img' => 'Your image are successfuly changed.'
            ],
            'tabs' => [

            ]
        ],
        'accounts' => [
            'button' => [
                'newAccount' => "Add new account",
                'cancel' => "Cancel",
                'remove' => "Remove",
            ],
            'headers' => [
                'name' => 'Name',
                'role' => 'Role',
                'email' => 'Email',
                'actions' => 'Actions',
                'created_at' => 'Created',
            ],
            'notify'=>[
                "successRemove" => "Account removed!"
            ],
            'description'=>[
                'remove' => "Sure you want to remove account?",
                'removeTitle' => "Remove account",
            ],
        ],
        'contracts' => [
            'button' => [
                'cancel' => "Cancel",
                'remove' => "Remove",
                'newAgreement' => 'Add contract',
            ],
            'headers' => [
                'name' => 'Name',
                'status' => 'Status',
                'dateAdd' => 'Add date',
                'actions' => 'Actions',
            ],
            'notify'=>[
                "successRemove" => "Contract removed!"
            ],
            'description'=>[
                'remove' => "Sure you want to remove contract?",
                'removeTitle' => "Remove contract",
            ]
        ]
    ]
];
