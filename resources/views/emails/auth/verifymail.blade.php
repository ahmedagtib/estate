@component('mail::message')
# Introduction

The body of your message.

<a href="{{route('email.verify.back',$token)}}" class="button  button-success">verify</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
