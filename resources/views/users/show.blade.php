@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="img-circle">
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="status text-center">
            <ul>
                <li>
                    <div class="status-label">INTEREST</div>
                    <div id="made_count" class="status-value">
                        {{ $count_made }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @include('recipes.recipes', ['recipes' => $recipes])
    {!! $recipes->render() !!}
@endsection