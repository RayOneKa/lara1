@extends('layouts.app')


@section('title')
    Личный кабинет
@endsection

@section('content')
    <div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form method="POST" action="{{ route('profileUpdate') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">
                    Почта
                </label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}">
                <div id="emailHelp" class="form-text">
                    We'll never share your email with anyone else.
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">
                    Имя
                </label>
                <input
                class="form-control @if ($errors->has('name')) text-danger @endif" 
                name="name"
                value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Изображение
                </label>
                <br>
                <img style="height:100px;margin-bottom: 10px;" src="{{asset('storage/users/')}}/{{$user->picture}}">
                <input class="form-control" name="picture" type="file">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection