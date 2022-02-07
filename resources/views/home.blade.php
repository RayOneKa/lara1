@extends('layouts.app')

@section('content')

<div class="container">
    @auth
        Вы это читаете, потому что вы авторизованы
    @endauth

    @guest
        Пожалуйста, авторизуйтесь
    @endguest

    <home-component source="blade_templade" ></home-component>

</div>
@endsection