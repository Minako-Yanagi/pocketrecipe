@if ($recipes)
    <div class="row">
        @foreach ($recipes as $key => $recipe)
            <div class="recipe">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <img src="{{ $recipe->categoryUrl }}" alt="" class="">
                        </div>
                        <div class="panel-body">
                            @if ($recipe->id)
                            <div class="text-center">
                                <p class="recipe-title"><a href="{{ route('recipes.show', ['recipeId'=> $recipe->id]) }}" target="_blank">{{ $recipe->categoryName }}の詳細ページ</a></p>
                            </div>
                            @else
                            <div class="text-center">
                                <p class="recipe-title"><a href="{{ $recipe->categoryUrl }}" target="_blank">{{ $recipe->categoryName }}の詳細ページ</a></p>
                            </div>
                            @endif
                                <div class= form-center>
                                    <form><div class="buttons text-center btn btn-default btn-small inline">
                                    <p class="recipe-title"><a href="{{ route('recipes.create', ['categoryType'=> $recipe->categoryType,'categoryId'=> $recipe->categoryId,])}}" target="_blank">{{ $recipe->categoryName }}を絞り込む</a></p>
                                </div></form>
                                </div>
                                <div class="buttons text-center">
                                    @if (Auth::check())
                                        @include('recipes.made_button', ['recipe' => $recipe])
                                    @endif
                                </div>
                                
                        </div>
                         @if (isset($recipe->count))
                            <div class="panel-footer">
                                <p class="text-center">{{ 1 }}位: {{ $recipe->count}} Interests</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif