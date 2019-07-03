@component('mail::message')
# {{__("email.welcome_header")}}

{{__("email.welcome.info")}}

@component('mail::button', ['url' => url('/')])
    {{__("email.go_to_page")}}
@endcomponent

{{__("email.thanks")}},<br>
{{ config('app.name') }}
@endcomponent
