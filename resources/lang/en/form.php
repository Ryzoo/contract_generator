<?php

return [
    'variableForm' =>[
        'new' => [
            'title' => 'Add new variable'
        ],
        'update' => [
            'title' => 'Update variable'
        ],
        'forAnonymise' => 'For anonymise?',
        'additionalInformation' => 'Additional Information',
        'defaultValue' => 'Default value',
        'label' => 'Label',
        'placeholder' => 'Placeholder',
        'name' => 'Name',
        'type' => 'Type',
        'isRequired' => 'Is required?',
        'isMultiSelect' => 'Is multi select?',
        'lengthMin' => 'Min length',
        'lengthMax' => 'Max length',
        'valueMin' => 'Min value',
        'valueMax' => 'Max value',
        'items' => 'Items to select in',
        'itemsHint' => 'Enter word and click enter to add next'
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
            'success' => 'New account created.'
        ]
    ],
    'roleAddForm' => [
        'title' => "Add new role",
        'notify' => [
            'success' => 'New role created.'
        ]
    ],
    'roleEditForm' => [
        'title' => "Edit role",
        'notify' => [
            'success' => 'Role updated.'
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
    'accountChangePasswordForm' => [
        'notify' => [
            'success' => 'Password changed!',
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
        'title_modules' => 'Select modules for this contract',
        'description' => [
            'modules' => "Each module is a certain responsibility. You can choose which modules are to be active, and go to the configuration of each one to personalize them."
        ],
        'field' => [
            "contract_name" => "Contract name",
            "contract_description" => "Contract description",
            "contract_categories" => "Contract categories",
        ],
        'notify' => [
            'success' => "Contract saved!"
        ]
    ]
];
