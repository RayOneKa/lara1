<div class="container">
    <h1> {{ $test }} </h1>
    <h3> ID категории: {{ $category->id }} </h3>
    <h3> Название категории: {{ $category->name }} </h3>

    <a href="{{ route('home') }}">HOME</a>
</div>