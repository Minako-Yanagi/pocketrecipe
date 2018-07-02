@if (Auth::user()->is_madeing($recipe->categoryId,'code'))
    {!! Form::open(['route' => 'recipe_user.dont_made', 'method' => 'delete']) !!}
        {!! Form::hidden('categoryId', $recipe->categoryId) !!}
        {!! Form::submit('Made it', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'recipe_user.made']) !!}
        {!! Form::hidden('categoryType', $recipe->categoryType) !!}
        {!! Form::hidden('categoryId', $recipe->categoryId) !!}
        {!! Form::hidden('categoryName', $recipe->categoryName) !!}
        {!! Form::hidden('categoryUrl', $recipe->categoryUrl) !!}
        {!! Form::hidden('parentCategoryId', $recipe->parentCategoryId) !!}
        {!! Form::submit('Made', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endif