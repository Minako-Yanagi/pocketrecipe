@if (Auth::user()->is_madeing($recipe->categoryId,'code'))
    {!! Form::open(['route' => 'recipe_user.dont_made', 'method' => 'delete']) !!}
        {!! Form::hidden('categoryId', $recipe->categoryId) !!}
        {!! Form::submit('Interested', ['class' => 'btn btn-success btn-small']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'recipe_user.made']) !!}
        {!! Form::hidden('categoryType', $recipe->categoryType) !!}
        {!! Form::hidden('categoryId', $recipe->categoryId) !!}
        {!! Form::hidden('categoryName', $recipe->categoryName) !!}
        {!! Form::hidden('categoryUrl', $recipe->categoryUrl) !!}
        {!! Form::hidden('parentCategoryId', $recipe->parentCategoryId) !!}
        {!! Form::submit('Interesting', ['class' => 'btn btn-primary btn-small']) !!}
    {!! Form::close() !!}
@endif