@if (Auth::user()->is_madeing($recipe->code))
    {!! Form::open(['route' => 'recipe_user.dont_made', 'method' => 'delete']) !!}
        {!! Form::hidden('recipeCode', $recipe->code) !!}
        {!! Form::submit('Made', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'recipe_user.made']) !!}
        {!! Form::hidden('recipeCode', $recipe->code) !!}
        {!! Form::submit('Made it', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endif