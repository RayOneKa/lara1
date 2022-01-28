@extends('../layouts.app')

@section('title')
    Админка
@endsection

@section('content')
    <div class="container">
        <admin-users-component
            :users="{{$users}}"
            route-export-categories="{{route('exportCategories')}}"
        >
        </admin-users-component>
    </div>
@endsection