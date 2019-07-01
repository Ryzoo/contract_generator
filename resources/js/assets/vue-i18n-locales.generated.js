export default {
    "en": {
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
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": [],
            "bad_object_data": "Data injected to model validator is bad"
        },
        "pageMeta": {
            "appTitle": "Contract Generator",
            "copyright": "All rights reserved - Contract Generator",
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
                "agreements": {
                    "title": "Panel - Agreements",
                    "button": {
                        "newAgreement": "Add agreement"
                    },
                    "headers": {
                        "name": "Name",
                        "status": "Status",
                        "dateAdd": "Add date",
                        "actions": "Actions"
                    }
                }
            }
        },
        "response": {
            "notFoundId": "Object with this id was not found.",
            "emailNotFound": "Account with this email not found.",
            "badPassword": "Password for this account didn't match.",
            "notAuthorized": "User are not authorized! Please login.",
            "badResetToken": "Password reset token is incorrect or used before."
        },
        "email": {
            "welcome_header": "Welcome to Contract Generator",
            "go_to_page": "Go to page",
            "thanks": "Thanks",
            "welcome": {
                "subject": "Welcome to Contract Generator",
                "info": "Your account are created successfully. You can now login and work in app."
            },
            "resetPassword": {
                "subject": "Reset account password",
                "info": "You send request for reset your password. To end this process please use button below."
            }
        },
        "form": {
            "login": {
                "title": "Login form",
                "field": {
                    "email": "Email",
                    "password": "Password"
                },
                "text": {
                    "forgotPassword": "Forgot password?"
                },
                "link": {
                    "resetPassword": "Reset password"
                },
                "button": {
                    "login": "Login",
                    "register": "Create new account"
                },
                "notify": {
                    "success": "Logged successfully"
                }
            },
            "register": {
                "title": "Register form",
                "field": {
                    "firstName": "FirstName",
                    "lastName": "LastName",
                    "email": "Email",
                    "password": "Password",
                    "rePassword": "Retype password",
                    "regulationsAccept": "I accept the Regulations",
                    "rodoAccept": "I accept the RODO"
                },
                "link": {
                    "rodo": " Rodo policy",
                    "regulations": " Site regulations"
                },
                "button": {
                    "login": "I have account",
                    "register": "Register account"
                },
                "notify": {
                    "success": "Account added successful. Please check your email to confirm."
                }
            },
            "sendResetTokenForm": {
                "title": "Send reset password token form",
                "field": {
                    "email": "Email"
                },
                "button": {
                    "cancel": "Cancel",
                    "remind": "Remind"
                },
                "notify": {
                    "success": "Reset token send to your email. Check your email and use url to reset password."
                }
            },
            "resetPasswordForm": {
                "title": "Reset password form",
                "field": {
                    "password": "Password",
                    "rePassword": "Retype password"
                },
                "button": {
                    "cancel": "Cancel",
                    "reset": "Reset password"
                },
                "notify": {
                    "success": "Your password was changed successfully. You can login now"
                }
            }
        }
    }
}
