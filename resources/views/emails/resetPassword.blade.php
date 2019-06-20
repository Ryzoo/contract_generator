@component('mail::message')
# {{__("email.welcome_header")}}

{{__("email.resetPassword.info")}}

@component('mail::button', ['url' => url('/auth/passwordReset?token='.$user->passwordResetToken)])
    {{__("email.go_to_page")}}
@endcomponent

{{__("email.thanks")}},<br>
{{ config('app.name') }}
@endcomponent
