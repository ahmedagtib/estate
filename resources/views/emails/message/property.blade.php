@component('mail::message')
# {{__('lang.hillo')}} {{$name}}

{{__('lang.email')}} : {{$data['email']}}<br><br>
{{__('lang.phone')}} : {{$data['phoneclient']}}<br><br>
{{__('lang.propertytitle')}} :  {{$titleprop}}
<br>
{{$data['messageproperty']}}


{{__('lang.thanks')}},<br>
{{ config('app.name') }}
@endcomponent
