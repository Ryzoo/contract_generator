<?php

return [
    'provider' => [
        'title' => 'Provide contract',
        'description' => 'Actual mode is render to pdf',
        'descriptionConfig' => 'This module determine hom the rendered contract should be provided to user',
        'successNotify' => 'Render success',
        'type' => [
            'renderAfterFinish' => 'Render to pdf after finish',
            'renderToEmail' => 'Send to user email',
        ]
    ],
    'auth' => [
        'title' => 'Authorization for contract',
        'authOptions' => 'Authorization options',
        'pwdToAccess' => 'Password to access',
        'descriptionAuth' => 'Only person that know the password can access this contract form',
        'description' => 'Only logged user can access this contract',
        'descriptionConfig' => 'Auth provide some options to determine client access. Choose one:',
        'successNotify' => 'Render success',
        'type' => [
            'accessForLogged' => 'Access for logged user',
            'accessWithPwd' => 'Access with password'
        ]
    ],
    'header' => [
        'moduleConfiguration' => 'Configuration of the module:'
    ],
    'base' => [
        'step' => 'Step:'
    ],
    'notify' => [
        'completeAllElement' => 'Fill properly all inputs on this page to go next!'
    ]
];
