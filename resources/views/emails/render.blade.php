@component('mail::message')
# {{__("email.base.welcome_contract")}}

{{__("email.render.info")}}

@component('mail::button', ['url' => url('/')])
    {{__("email.base.go_to_page")}}
@endcomponent

{{__("email.base.thanks")}},<br>
{{ config('app.name') }}
@endcomponent
