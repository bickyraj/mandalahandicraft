{{--@component('mail::message')--}}
@extends('emails.email_layout')
@section('content')
<h4>Email Verification</h4>

You have successfully created your account with us. Please click on the button below to verify your email.

@component('mail::button', ['url' => route('verify', $user->email_token), 'color' => 'green'])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@stop
{{--@endcomponent--}}
