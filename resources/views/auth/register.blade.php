@extends('layouts.app')

@section('content')
<div class="container">
    <register-component
        route-register="{{route('register')}}"
    >
    </register-component>
</div>
@endsection
