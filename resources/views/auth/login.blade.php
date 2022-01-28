@extends('layouts.app')

@section('content')
<div class="container">
    <login-component
        route-password-request="{{route('password.request')}}"
        route-login="{{route('login')}}"
    >
    </login-component>
</div>
@endsection
