<?php

return [
    'login' => [
        'title' => 'Login form',
        'field' => [
            'email' => 'Email',
            'password' => 'Password',
        ],
        'text' => [
            'forgotPassword' => 'Forgot password?'
        ],
        'link' => [
            'resetPassword' => 'Reset password'
        ],
        'button' => [
            'login' => 'Login',
            'register' => 'Create new account'
        ],
        'notify' => [
            'success' => 'Logged successfully'
        ]
    ],

    'register' => [
        'title' => 'Register form',
        'field' => [
            'firstName' => 'FirstName',
            'lastName' => 'LastName',
            'email' => 'Email',
            'password' => 'Password',
            'rePassword' => 'Retype password',
        ],
        'button' => [
            'login' => 'I have account',
            'register' => 'Register account'
        ],
        'notify' => [
            'success' => 'Account added successful. Please check your email to confirm.'
        ]
    ],

    'sendResetTokenForm' => [
        'title' => 'Send reset password token form',
        'field' => [
            'email' => 'Email',
        ],
        'button' => [
            'cancel' => 'Cancel',
            'remind' => 'Remind'
        ],
        'notify' => [
            'success' => 'Reset token send to your email. Check your email and use url to reset password.'
        ]
    ],

    'resetPasswordForm' => [
        'title' => 'Reset password form',
        'field' => [
            'password' => 'Password',
            'rePassword' => 'Retype password',
        ],
        'button' => [
            'cancel' => 'Cancel',
            'reset' => 'Reset password'
        ],
        'notify' => [
            'success' => 'Your password was changed successfully. You can login now'
        ]
    ]

];
