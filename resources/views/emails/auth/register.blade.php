@component('mail::message')
# {{__('lang.hillo')}} {{$name}}

{{ config('app.name') }} - {{__('lang.email_description_register')}}

<a href="{{route('home')}}" class="button  button-primary">{{ config('app.name') }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
