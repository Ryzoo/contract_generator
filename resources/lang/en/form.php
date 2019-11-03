<?php

return [
    'base' => [
        'field' => [
            'email' => 'Email',
            'password' => 'Password',
            'firstName' => 'FirstName',
            'lastName' => 'LastName',
            'role' => 'Role',
            'rePassword' => 'Retype password',
            'regulationsAccept' => 'I accept the Regulations',
            'rodoAccept' => 'I accept the RODO',
        ],
        'button' => [
            'login' => 'Login',
            'register' => 'Create new account',
            'reset' => 'Reset',
            'cancel' => 'Cancel',
            'remind' => 'Remind',
            'save' => 'Save',
            'add' => 'Add'
        ],
    ],
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
            'success' => 'Account updated!'
        ]
    ]
];
