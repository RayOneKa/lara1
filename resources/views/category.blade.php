@extends('layouts.app')

@section('content')
    <div class="container">
        <h3> ID категории: {{ $category->id }} </h3>
        <h3> Название категории: {{ $category->name }} </h3>

        <ul>
        @foreach ($category->products as $product)
            <li>
                {{$product->name}}, {{$product->price}}
            </li>
        @endforeach
        </ul>
    </div>
@endsection