<?php

return [
    'login' => [
        'title' => 'Login form',
        'text' => [
            'forgotPassword' => 'Forgot password?'
        ],
        'link' => [
            'resetPassword' => 'Reset password'
        ],
        'notify' => [
            'success' => 'Logged successfully'
        ]
    ],
    'register' => [
        'title' => 'Register form',
        'link' => [
            'rodo' => ' Rodo policy',
            'regulations' => ' Site regulations'
        ],
        'button' => [
            'login' => 'I have account'
        ],
        'notify' => [
            'success' => 'Account added successful. Please check your email to confirm.'
        ]
    ],
    'sendResetTokenForm' => [
        'title' => 'Send reset password token form',
        'notify' => [
            'success' => 'Reset token send to your email. Check your email and use url to reset password.'
        ]
    ],
    'resetPasswordForm' => [
        'title' => 'Reset password form',
        'notify' => [
            'success' => 'Your password was changed successfully. You can login now'
        ]
    ],
    'profileEditForm' => [
        'button' => [
            'change_img' => 'Change profile image',
            'save_img' => 'Save current image',
        ],
        'notify' => [
            'success' => 'Your basic data are updated now.'
        ]
    ],
    'accountAddForm' => [
        'title' => "Add new account",
        'button' => [
            'prev' => 'Back to accounts',
        ],
        'notify' => [
            'success' => 'New account added.'
        ]
    ],
    'accountEditForm' => [
        'title' => "Edit account",
        'button' => [
            'prev' => 'Back to accounts',
        ],
        'notify' => [
            'success' => 'Account updated!',
            'success_img' => 'Image updated!'
        ]
    ],
    'accountRemoveForm' => [
        'title' => "Remove account",
    ],
    'roleRemoveForm' => [
        'title' => "Remove role",
    ],
    'removeContractForm' => [
        'title' => "Remove contract",
        'notify' => [
            'success' => "Role removed!"
        ]
    ],
    'contractAddForm' => [
        'title' => "Add contract",
        'title_modules' => 'Wybierz moduły które będą dostępne dla tej umowy',
        'description' => [
            'modules' => "Każdy moduł to pewna odpowiedzialność. Możesz wybrac które moduły maja być aktywne, oraz przejść do konfiguracji każdego z nich w celu ich spersonalizowania."
        ],
        'field' => [
            "contract_name" => "Contract name"
        ],
        'notify' => [
            'success' => "Contract saved!"
        ]
    ]
];
