@extends('layouts.app')

@section('title')
    {{$title}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

    @auth
        Вы это читаете, потому что вы авторизованы
    @endauth

    @guest
        Пожалуйста, авторизуйтесь
    @endguest

    @if ($showTitle)
        <h1>{{$title}}</h1>
    @else
        Нет заголовка
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>Название</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <ul>
    @for ($i = 0; $i < 5; $i++)
        <li>{{$i}}</li>
    @endfor
    </ul>



    </div>
</div>
@endsection