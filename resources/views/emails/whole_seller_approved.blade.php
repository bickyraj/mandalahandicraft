@extends('emails.email_layout')
@section('content')
        Hi {{ $data['name'] }},<br/>

        Your request for whole seller is successfully approved by administrator,an account has been created for you. Please take note of your username and password.<br/>
        <br/>
        Email : {{ $data['email'] }}<br/>
        Password : {{ $data['password'] }}<br/>
        Login Url: <a href="{{ url('login') }}">{{ url('login') }}</a>
        <br/>
        <br/>
        If you are having problems logging into your account, please notify your Administrator.
@stop
