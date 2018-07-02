@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="recipe">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                    </div>
                    <div class="panel-body">
                        <p class="recipe-title"><a href='{{ $recipe->categoryUrl }}' target='_blank'>{{ $recipe->categoryName }}</a></p>
                        <div class="buttons text-center">
                            @if (Auth::check())
                                @include('recipes.made_button', ['recipe' => $recipe])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="made-users">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Madeしたユーザ
                    </div>
                    <div class="panel-body">
                        @foreach ($made_users as $user)
                            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    <div>

@endsection