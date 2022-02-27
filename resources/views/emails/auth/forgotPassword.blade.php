@component('mail::message')
# {{$data['name']}}

The body of your message.

<a href="{{route('reset.password',$data['token'])}}" class="button  button-primary">{{ config('app.name') }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
