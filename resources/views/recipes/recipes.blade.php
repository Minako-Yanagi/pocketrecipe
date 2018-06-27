@if ($recipes)
    <div class="row">
        @foreach ($recipes as $recipe)
            <div class="recipe">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <img src="{{ $recipe->image_url }}" alt="" class="">
                        </div>
                        <div class="panel-body">
                            @if ($recipe->id)
                                <p class="recipe-title"><a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->name }}</a></p>
                            @else
                                <p class="recipe-title">{{ $recipe->name }}</p>
                            @endif
                            <div class="buttons text-center">
                                @if (Auth::check())
                                    @include('recipes.made_button', ['recipe' => $recipe])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif