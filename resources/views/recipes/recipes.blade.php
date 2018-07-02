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
                                <p class="recipe-title"><a href="{{ route('recipes.show', ['recipeId'=> $recipe->id]) }}">{{ $recipe->categoryName }}</a></p>
                            @else
                                <p class="recipe-title"><a href="{{ $recipe->categoryUrl }}" target="_blank">{{ $recipe->categoryName }}</a></p>
                            @endif
                            <div class="buttons text-center">
                                @if (Auth::check())
                                    @include('recipes.made_button', ['recipe' => $recipe])
                                @endif
                            </div>
                        </div>
                         @if (isset($recipe->count))
                            <div class="panel-footer">
                                <p class="text-center">{{ 1 }}位: {{ $recipe->count}} Mades</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif