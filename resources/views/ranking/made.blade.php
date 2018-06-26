@extends('layouts.app')

@section('content')
    <h1>Madeランキング</h1>
    @include('items.items', ['items' => $items])
@endsection