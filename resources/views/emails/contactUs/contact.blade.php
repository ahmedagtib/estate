@component('mail::message')
# {{__('lang.hillo')}} {{$data['name']}}

{{$data['email']}}<br><br>
{{$data['subject']}}.
<br>
{{$data['message']}}


{{__('lang.thanks')}},<br>
{{ config('app.name') }}
@endcomponent
