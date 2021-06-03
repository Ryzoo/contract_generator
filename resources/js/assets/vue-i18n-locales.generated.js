export default {
    "en": {
        "base": {
            "field": {
                "email": "Email",
                "password": "Password",
                "firstName": "FirstName",
                "lastName": "LastName",
                "role": "Role",
                "name": "Name",
                "slug": "Slug",
                "description": "Description",
                "level": "Level",
                "permission": "Permission",
                "rePassword": "Retype password",
                "newPassword": "New password",
                "actualPassword": "Actual password",
                "regulationsAccept": "I accept the Regulations",
                "rodoAccept": "I accept the RODO"
            },
            "button": {
                "configuration_back": "Back to configuration",
                "login": "Login",
                "addElement": "Add next element",
                "goToLogin": "Go to login page",
                "fillIn": "Fill in",
                "register": "Create new account",
                "reset": "Reset",
                "cancel": "Cancel",
                "close": "Close",
                "ok": "Ok",
                "makeAsRead": "Make as read",
                "download": "Download",
                "remind": "Remind",
                "remove": "Remove",
                "render": "Render",
                "try_again": "Try again",
                "save": "Save",
                "next": "Next",
                "update": "Update",
                "add": "Add",
                "back": "Back",
                "edit": "Edit",
                "save_exit": "Save and exit",
                "save_build": "Save and build",
                "pay": "Pay",
                "pay_waiting": "Waiting for payment"
            },
            "headers": {
                "name": "Name",
                "email": "Email",
                "isAvailable": "",
                "created": "Created",
                "roles": "Roles",
                "status": "Current status",
                "updated": "Last update",
                "actions": "Actions",
                "descriptions": "Descriptions"
            },
            "description": {
                "remove": "Do you want to remove it?",
                "noElements": "No elements in list",
                "inTurn": "In turn"
            },
            "notify": {
                "remove": "Removed successfully!"
            }
        },
        "email": {
            "base": {
                "welcome_contract": "Welcome to Contract Generator",
                "go_to_page": "Go to page",
                "thanks": "Thanks"
            },
            "welcome": {
                "subject": "Welcome to Contract Generator",
                "info": "Your account are created successfully. You can now login and work in app."
            },
            "render": {
                "subject": "New Render from Contract Generator",
                "info": "Our system render your form submission. It is available from your panel on site. We also send it as attachment in this email."
            }
        },
        "enums": {
            "roles": {
                "ADMINISTRATOR": "Admin",
                "CLIENT": "Client"
            },
            "contractStatus": [
                "New",
                "Pending",
                "Available",
                "Delivered",
                "Error",
                "Wait for action"
            ]
        },
        "form": {
            "variableForm": {
                "new": {
                    "title": "Add new variable"
                },
                "update": {
                    "title": "Update variable"
                },
                "isMultiUse": "Use as multiple value",
                "forAnonymise": "For anonymise?",
                "additionalInformation": "Additional Information",
                "defaultValue": "Default value",
                "defaultValueHint": {
                    "dateTime": "Use only text that is allowed in strtotime php method"
                },
                "label": "Label",
                "placeholder": "Placeholder",
                "name": "Name",
                "type": "Type",
                "isRequired": "Is required?",
                "multiRenderType": "Render type",
                "isMultiSelect": "Is multi select?",
                "isInline": "Inline?",
                "lengthMin": "Min length",
                "lengthMax": "Max length",
                "valueMin": "Min value",
                "valueMax": "Max value",
                "items": "Items to select in",
                "itemsHint": "Enter word and click enter to add next",
                "selectVariables": "Select variables to group"
            },
            "login": {
                "title": "Login form",
                "text": {
                    "forgotPassword": "Forgot password?"
                },
                "link": {
                    "resetPassword": "Reset password"
                },
                "notify": {
                    "success": "Logged successfully"
                }
            },
            "register": {
                "title": "Register form",
                "link": {
                    "rodo": " Rodo policy",
                    "regulations": " Site regulations"
                },
                "button": {
                    "login": "I have account"
                },
                "notify": {
                    "success": "Account added successful. Please check your email to confirm."
                }
            },
            "sendResetTokenForm": {
                "title": "Send reset token",
                "notify": {
                    "success": "Reset token send to your email. Check your email and use url to reset password."
                }
            },
            "resetPasswordForm": {
                "title": "Reset password form",
                "notify": {
                    "success": "Your password was changed successfully. You can login now"
                }
            },
            "profileEditForm": {
                "button": {
                    "change_img": "Change profile image",
                    "save_img": "Save current image"
                },
                "notify": {
                    "success": "Your basic data are updated now."
                }
            },
            "accountAddForm": {
                "title": "Add new account",
                "button": {
                    "prev": "Back to accounts"
                },
                "notify": {
                    "success": "New account created."
                }
            },
            "roleAddForm": {
                "title": "Add new role",
                "notify": {
                    "success": "New role created."
                }
            },
            "roleEditForm": {
                "title": "Edit role",
                "notify": {
                    "success": "Role updated."
                }
            },
            "categoryAddForm": {
                "title": "Add new category",
                "notify": {
                    "success": "New category created."
                }
            },
            "categoryEditForm": {
                "title": "Edit category",
                "notify": {
                    "success": "Category updated."
                }
            },
            "accountEditForm": {
                "title": "Edit account",
                "button": {
                    "prev": "Back to accounts"
                },
                "notify": {
                    "success": "Account updated!",
                    "success_img": "Image updated!"
                }
            },
            "accountChangePasswordForm": {
                "notify": {
                    "success": "Password changed!"
                }
            },
            "accountRemoveForm": {
                "title": "Remove account"
            },
            "roleRemoveForm": {
                "title": "Remove role",
                "notify": {
                    "successRemove": "Role removed!"
                }
            },
            "categoryRemoveForm": {
                "title": "Remove category",
                "notify": {
                    "successRemove": "Category removed!"
                }
            },
            "removeContractForm": {
                "title": "Remove contract"
            },
            "contractAddForm": {
                "title": "Add contract",
                "title_modules": "Select modules for this contract",
                "description": {
                    "modules": "Each module is a certain responsibility. You can choose which modules are to be active, and go to the configuration of each one to personalize them."
                },
                "field": {
                    "contract_name": "Contract name",
                    "contract_description": "Contract description",
                    "contract_categories": "Contract categories"
                },
                "notify": {
                    "success": "Contract saved!"
                }
            }
        },
        "module": {
            "provider": {
                "title": "Provide contract",
                "description": "Actual mode is render to pdf",
                "descriptionConfig": "This module determine hom the rendered contract should be provided to user",
                "successNotify": "Render success",
                "type": {
                    "renderAfterFinish": "Render to pdf after finish",
                    "renderToEmail": "Send to user email"
                }
            },
            "payment": {
                "title": "Payment",
                "description": "Allow to get payment before client get rendered contract.",
                "descriptionConfig": "This module determine payment settings for client."
            },
            "auth": {
                "title": "Authorization for contract",
                "authOptions": "Authorization options",
                "pwdToAccess": "Password to access",
                "descriptionAuth": "Only person that know the password can access this contract form",
                "description": "Only logged user can access this contract",
                "descriptionConfig": "Auth provide some options to determine client access. Choose one:",
                "successNotify": "Render success",
                "type": {
                    "accessForLogged": "Access for logged user",
                    "accessWithPwd": "Access with password"
                }
            },
            "header": {
                "moduleConfiguration": "Configuration of the module:"
            },
            "base": {
                "step": "Step:"
            },
            "notify": {
                "completeAllElement": "Fill properly all inputs on this page to go next!"
            }
        },
        "navigation": {
            "lang": "Change language",
            "dashboard": "Dashboard",
            "formContract": "Contract forms",
            "clients": "Clients",
            "contract": {
                "main": "Contracts",
                "contractList": "Full contract project",
                "category": "Categories"
            },
            "library": {
                "main": "Library",
                "attributes": "Attributes",
                "blocks": "Blocks"
            },
            "accounts": "Accounts",
            "settings": {
                "main": "Settings",
                "roles": "Roles",
                "account": "Accounts"
            },
            "profile": {
                "main": "My profile",
                "notifications": "Notifications"
            },
            "formSubmission": "Form Submissions",
            "logout": "Logout"
        },
        "notifications": {
            "title": "Notifications",
            "empty": "You don't have any unread notifications",
            "renderFinish": {
                "status": {
                    "4": "Error occurred when render! You can try again in submission panel.",
                    "2": "Finished successfully. You can download your contract."
                },
                "title": "Your contract form submission render are finished."
            }
        },
        "pageMeta": {
            "appTitle": "Odszkodowanie za paczkę",
            "copyright": "All rights reserved - Contract Generator",
            "common": {
                "notFound": {
                    "title": "404 Not Found"
                },
                "noAccess": {
                    "title": "403 No Access"
                }
            },
            "auth": {
                "login": {
                    "title": "Login"
                },
                "register": {
                    "title": "Register account"
                },
                "resetPassword": {
                    "title": "Reset password"
                },
                "sendResetPasswordToken": {
                    "title": "Reset password token"
                }
            },
            "panel": {
                "dashboard": {
                    "title": "Panel - Dashboard"
                },
                "profile": {
                    "title": "Panel - My Profile"
                },
                "category": {
                    "title": "Panel - Categories",
                    "create": {
                        "title": "Panel - Create category"
                    },
                    "edit": {
                        "title": "Panel - Edit category"
                    }
                },
                "formSubmission": {
                    "title": "Panel - My Submission"
                },
                "roles": {
                    "title": "Panel - Manage roles",
                    "create": {
                        "title": "Panel - Create role"
                    },
                    "edit": {
                        "title": "Panel - Edit role"
                    }
                },
                "accounts": {
                    "title": "Panel - Accounts",
                    "create": {
                        "title": "Panel - Create new account"
                    },
                    "edit": {
                        "title": "Panel - Edit account"
                    },
                    "preview": {
                        "title": "Panel - Preview account"
                    }
                },
                "library": {
                    "title": "Panel - Library",
                    "attributes": {
                        "title": "Panel - Attributes Library"
                    },
                    "blocks": {
                        "title": "Panel - Blocks Library"
                    }
                },
                "contract": {
                    "title": "Panel - Contract list",
                    "builder": {
                        "title": "Panel - Build contract"
                    },
                    "create": {
                        "title": "Panel - Create new contract"
                    },
                    "edit": {
                        "title": "Panel - Edit contract"
                    }
                }
            }
        },
        "pages": {
            "auth": {
                "welcome": "Welcome back,",
                "sigin": "Sign in to continue access page!"
            },
            "panel": {
                "accounts": {
                    "buttons": {
                        "new": "Add new account"
                    },
                    "descriptions": {
                        "user_not_exist": "This user not exist"
                    },
                    "tabs": {
                        "basic_data": "Basic data",
                        "change_password": "Change password"
                    }
                },
                "category": {
                    "buttons": {
                        "new": "Add new category"
                    }
                },
                "roles": {
                    "buttons": {
                        "new": "Add new role"
                    }
                },
                "contracts": {
                    "buttons": {
                        "new_contract": "Add new contract"
                    },
                    "builder": {
                        "header": "You build:",
                        "attributeList": "List of attributes",
                        "savedNotify": "Contract saved successfully",
                        "addBLock": "Add block",
                        "newBlock": "Add new block or use part",
                        "removeAttributeTitle": "Remove attribute",
                        "removeBlockTitle": "Remove selected block",
                        "noVariables": "No variable has been added yet",
                        "noPartToReuse": "No available part to reuse. Create block construction and use save as part button on it first!"
                    }
                }
            },
            "form": {
                "noContract": "No available contract to select!",
                "selectOneContract": "Select one of contract form list on left.",
                "filter": {
                    "main": "Filter categories forms",
                    "text": "Filter by name or description",
                    "categories": "Filter by category"
                }
            }
        },
        "response": {
            "notFoundId": "Object with this id was not found.",
            "emailNotFound": "Account with this email not found.",
            "notFoundStatistic": "This statistic type is not available.",
            "badPassword": "Password for this account didn't match.",
            "notAuthorized": "User are not authorized! Please login.",
            "badResetToken": "Password reset token is incorrect or used before.",
            "badContractCompleteStatusRetry": "Bad status to try render one more time."
        },
        "validation": {
            "accepted": "The {attribute} must be accepted.",
            "active_url": "The {attribute} is not a valid URL.",
            "after": "The {attribute} must be a date after {date}.",
            "after_or_equal": "The {attribute} must be a date after or equal to {date}.",
            "alpha": "The {attribute} may only contain letters.",
            "alpha_dash": "The {attribute} may only contain letters, numbers, dashes and underscores.",
            "alpha_num": "The {attribute} may only contain letters and numbers.",
            "array": "The {attribute} must be an array.",
            "before": "The {attribute} must be a date before {date}.",
            "before_or_equal": "The {attribute} must be a date before or equal to {date}.",
            "between": {
                "numeric": "The {attribute} must be between {min} and {max}.",
                "file": "The {attribute} must be between {min} and {max} kilobytes.",
                "string": "The {attribute} must be between {min} and {max} characters.",
                "array": "The {attribute} must have between {min} and {max} items."
            },
            "boolean": "The {attribute} field must be true or false.",
            "confirmed": "The {attribute} confirmation does not match.",
            "date": "The {attribute} is not a valid date.",
            "date_equals": "The {attribute} must be a date equal to {date}.",
            "date_format": "The {attribute} does not match the format {format}.",
            "different": "The {attribute} and {other} must be different.",
            "digits": "The {attribute} must be {digits} digits.",
            "digits_between": "The {attribute} must be between {min} and {max} digits.",
            "dimensions": "The {attribute} has invalid image dimensions.",
            "distinct": "The {attribute} field has a duplicate value.",
            "email": "The {attribute} must be a valid email address.",
            "exists": "The selected {attribute} is invalid.",
            "file": "The {attribute} must be a file.",
            "filled": "The {attribute} field must have a value.",
            "gt": {
                "numeric": "The {attribute} must be greater than {value}.",
                "file": "The {attribute} must be greater than {value} kilobytes.",
                "string": "The {attribute} must be greater than {value} characters.",
                "array": "The {attribute} must have more than {value} items."
            },
            "gte": {
                "numeric": "The {attribute} must be greater than or equal {value}.",
                "file": "The {attribute} must be greater than or equal {value} kilobytes.",
                "string": "The {attribute} must be greater than or equal {value} characters.",
                "array": "The {attribute} must have {value} items or more."
            },
            "image": "The {attribute} must be an image.",
            "in": "The selected {attribute} is invalid.",
            "in_array": "The {attribute} field does not exist in {other}.",
            "integer": "The {attribute} must be an integer.",
            "ip": "The {attribute} must be a valid IP address.",
            "ipv4": "The {attribute} must be a valid IPv4 address.",
            "ipv6": "The {attribute} must be a valid IPv6 address.",
            "json": "The {attribute} must be a valid JSON string.",
            "lt": {
                "numeric": "The {attribute} must be less than {value}.",
                "file": "The {attribute} must be less than {value} kilobytes.",
                "string": "The {attribute} must be less than {value} characters.",
                "array": "The {attribute} must have less than {value} items."
            },
            "lte": {
                "numeric": "The {attribute} must be less than or equal {value}.",
                "file": "The {attribute} must be less than or equal {value} kilobytes.",
                "string": "The {attribute} must be less than or equal {value} characters.",
                "array": "The {attribute} must not have more than {value} items."
            },
            "max": {
                "numeric": "The {attribute} may not be greater than {max}.",
                "file": "The {attribute} may not be greater than {max} kilobytes.",
                "string": "The {attribute} may not be greater than {max} characters.",
                "array": "The {attribute} may not have more than {max} items."
            },
            "mimes": "The {attribute} must be a file of type: {values}.",
            "mimetypes": "The {attribute} must be a file of type: {values}.",
            "min": {
                "numeric": "The {attribute} must be at least {min}.",
                "file": "The {attribute} must be at least {min} kilobytes.",
                "string": "The {attribute} must be at least {min} characters.",
                "array": "The {attribute} must have at least {min} items."
            },
            "not_in": "The selected {attribute} is invalid.",
            "not_regex": "The {attribute} format is invalid.",
            "numeric": "The {attribute} must be a number.",
            "present": "The {attribute} field must be present.",
            "regex": "The {attribute} format is invalid.",
            "required": "The {attribute} field is required.",
            "required_if": "The {attribute} field is required when {other} is {value}.",
            "required_unless": "The {attribute} field is required unless {other} is in {values}.",
            "required_with": "The {attribute} field is required when {values} is present.",
            "required_with_all": "The {attribute} field is required when {values} are present.",
            "required_without": "The {attribute} field is required when {values} is not present.",
            "required_without_all": "The {attribute} field is required when none of {values} are present.",
            "same": "The {attribute} and {other} must match.",
            "size": {
                "numeric": "The {attribute} must be {size}.",
                "file": "The {attribute} must be {size} kilobytes.",
                "string": "The {attribute} must be {size} characters.",
                "array": "The {attribute} must contain {size} items."
            },
            "starts_with": "The {attribute} must start with one of the following: {values}",
            "string": "The {attribute} must be a string.",
            "timezone": "The {attribute} must be a valid zone.",
            "unique": "The {attribute} has already been taken.",
            "uploaded": "The {attribute} failed to upload.",
            "url": "The {attribute} format is invalid.",
            "uuid": "The {attribute} must be a valid UUID.",
            "custom": {
                "array": {
                    "attributes": "Attributes should be json array",
                    "blocks": "Blocks should be json array"
                },
                "form": {
                    "not_exist": "Form for this contract not exist - this contract is corrupted"
                },
                "attributes": {
                    "not_exist": "Attribute with id: {id} not exist in this contract"
                }
            },
            "attributes": [],
            "bad_object_data": "Data injected to model validator is bad"
        }
    },
    "pl": {
        "form": {
            "variableForm": {
                "new": {
                    "title": "Dodaj nową zmienną"
                },
                "update": {
                    "title": "Aktualizuj zmienną"
                },
                "isMultiUse": "Użyj wielu wartości",
                "forAnonymise": "Do anonimizacji?",
                "additionalInformation": "Dodatkowe informacje",
                "defaultValue": "Domyślna wartość",
                "defaultValueHint": {
                    "dateTime": "Używaj tylko tekstu, który jest dozwolony w metodzie strtotime"
                },
                "label": "Etykieta",
                "placeholder": "Placeholder",
                "name": "Nazwa",
                "type": "Typ",
                "isRequired": "Czy wymagane?",
                "multiRenderType": "Typ renderu",
                "isMultiSelect": "Czy pole wielokrotne?",
                "isInline": "W lini?",
                "lengthMin": "Min długość",
                "lengthMax": "Maks długość",
                "valueMin": "Min wartość",
                "valueMax": "Max wartość",
                "items": "Opcje do wyboru",
                "itemsHint": "wpisz słowo i kliknij enter",
                "selectVariables": "Wybierz zmienne do grupy"
            },
            "login": {
                "title": "Formularz logowania",
                "text": {
                    "forgotPassword": "Zapomniałeś hasła?"
                },
                "link": {
                    "resetPassword": "Resetowanie hasła"
                },
                "notify": {
                    "success": "Zalogowano pomyślnie"
                }
            },
            "register": {
                "title": "Formularz rejestracji",
                "link": {
                    "rodo": " Polityka rodo",
                    "regulations": " Regulamin strony"
                },
                "button": {
                    "login": "Mam już konto"
                },
                "notify": {
                    "success": "Konto dodane pomyślnie. Sprawdź swoją skrzynkę pocztową, aby potwierdzić."
                }
            },
            "sendResetTokenForm": {
                "title": "Wyślij token resetowania hasła",
                "notify": {
                    "success": "Tokene resetowania hasła został wysłany. Sprawdź swoją skrzynkę pocztową i użyj go aby zresetować hasło."
                }
            },
            "resetPasswordForm": {
                "title": "Formularz resetowania hasła",
                "notify": {
                    "success": "Twoje hasło zostało pomyślnie zmienione. Możesz się teraz zalogować"
                }
            },
            "profileEditForm": {
                "button": {
                    "change_img": "Zmień zdjęcie profilowe",
                    "save_img": "Zapisz aktualne zdjęcie"
                },
                "notify": {
                    "success": "Twoje podstawowe dane zostały zapisane."
                }
            },
            "accountAddForm": {
                "title": "Dodaj nowe konto",
                "button": {
                    "prev": "Powrót do konta"
                },
                "notify": {
                    "success": "Nowe konto utworzone"
                }
            },
            "roleAddForm": {
                "title": "Dodaj nową rolę",
                "notify": {
                    "success": "Nowa rola utworzona"
                }
            },
            "roleEditForm": {
                "title": "Zmień rolę",
                "notify": {
                    "success": "Rola zmieniona"
                }
            },
            "categoryAddForm": {
                "title": "Dodaj nową kategorię",
                "notify": {
                    "success": "Kategoria dodana"
                }
            },
            "categoryEditForm": {
                "title": "Edytuj kategorię",
                "notify": {
                    "success": "Kategoria zmieniona"
                }
            },
            "accountEditForm": {
                "title": "Zmień konto",
                "button": {
                    "prev": "Powrót do kont"
                },
                "notify": {
                    "success": "Konto zmienione",
                    "success_img": "Zdjęcie zmienione"
                }
            },
            "accountChangePasswordForm": {
                "notify": {
                    "success": "Hasło zmienione"
                }
            },
            "accountRemoveForm": {
                "title": "Usuń hasło"
            },
            "roleRemoveForm": {
                "title": "Usuń role",
                "notify": {
                    "successRemove": "Rola usunięta"
                }
            },
            "categoryRemoveForm": {
                "title": "Usuń kategorię",
                "notify": {
                    "successRemove": "Kategoria usunięta"
                }
            },
            "removeContractForm": {
                "title": "Usuń formularz"
            },
            "contractAddForm": {
                "title": "Dodaj formularz",
                "title_modules": "Wybierz moduły do formularza",
                "description": {
                    "modules": "Każdy moduł to pewna odpowiedzialność. Możesz wybrać, które moduły mają być aktywne i przejść do konfiguracji każdego z nich, aby je spersonalizować."
                },
                "field": {
                    "contract_name": "Nazwa formularza",
                    "contract_description": "Opis formularza",
                    "contract_categories": "Kategorie formularza"
                },
                "notify": {
                    "success": "Formularz zapisany"
                }
            }
        }
    }
}
