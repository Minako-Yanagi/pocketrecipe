@extends('layouts.app')

@section('content')
    <h1>Madeランキング</h1>
    @include('recipes.recipes', ['recipes' => $recipes])
@endsection