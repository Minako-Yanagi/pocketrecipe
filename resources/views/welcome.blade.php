@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1></h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    ここにレシピとかいろいろ入るよ:D
    9.4
    @include('recipes.recipes')
    {!! $recipes->render() !!}
    
@endsection
