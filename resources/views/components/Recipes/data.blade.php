@isset($recipes)
@isset($foods)

<div class="w-full flex flex-col items-start">

  @foreach($recipes as $recipe)

    <div class="recipeType flex flex-col justify-center items-center w-full max-w-2xl mx-auto mb-2"
    id="{{$recipe->id}}Meta"
    data-id='{{$recipe->id}}'
    data-search='{{$recipe->name}}'>

      <div class="flex flex-row justify-center items-center w-full mx-2 bg-zinc-100 border-y md:border-x border-zinc-400">
        <x-secondary-button class="togglestack m-2 max-w-xs flex justify-center items-center" data-i='{{$recipe->id}}'>
          <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/eyeLight.svg') }}">
        </x-secondary-button>
        <div class="mx-2 w-full p-2 bg-transparent">{{$recipe->name}}</div>
        <div class="flex flex-row w-full max-w-sm justify-end items-center mx-auto">
          <x-secondary-button class="m-2 max-w-xs flex justify-center items-center" id="{{$recipe->id}}SaveRecipe">
            <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/saveLight.svg') }}">
          </x-secondary-button>
          <x-secondary-button class="m-2 max-w-xs flex justify-center items-center" id="{{$recipe->id}}DeleteRecipe">
            <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/eraseLight.svg') }}">
          </x-secondary-button>
        </div>
      </div>

      <div class="w-full mx-auto" id="{{$recipe->id}}displayStack" style="display:none;">

        <div class="flex flex-row w-full max-w-sm justify-evenly items-center mx-auto">
          <x-secondary-button class="dataviewbutton m-2 p-2 flex justify-center items-center" data-i='{{$recipe->id}}' id="{{$recipe->id}}Options">
            <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/chartLight.svg') }}">
          </x-secondary-button>
          <x-secondary-button class="dataviewbutton m-2 p-2 flex justify-center items-center" data-i='{{$recipe->id}}' id="{{$recipe->id}}Data">
            <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/barChart.svg') }}">
          </x-secondary-button>
          <x-secondary-button class="ingredientviewbutton m-2 p-2 flex justify-center items-center" id="{{$recipe->id}}Ingredients">
            <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/bowl.svg') }}">
          </x-secondary-button>
          <x-secondary-button class="instructionviewbutton m-2 p-2 flex justify-center items-center" id="{{$recipe->id}}Instructions">
            <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/listLight.svg') }}">
          </x-secondary-button>
        </div>

        <div id="{{$recipe->id}}OptionsList" class="w-full max-w-sm overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2 mx-auto">

          <div class="my-2 w-full max-w-xl flex flex-col justify-evenly items-center">
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center mb-2">
              <div class="w-1/3 text-center">
                {{ __('') }}
              </div>
              <div class="w-1/3 text-center">
                &sum;
              </div>
              <div class="w-1/3 text-center">
                {{ __('%') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Calories:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountCalories">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentCalories">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Price:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountPrice">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentPrice">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Carbohydrate:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountCarbohydrate">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentCarbohydrate">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Sugar:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountSugar">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentSugar">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Fat:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountFat">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentFat">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Saturated:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountSaturated">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentSaturated">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Protein:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountProtein">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentProtein">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Fibre:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountFibre">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentFibre">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Salt:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountSalt">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentSalt">
                {{ __('0') }}
              </div>
            </div>
    
            <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
              <div class="w-1/3 text-center">
                {{ __('Alcohol:') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}CountAlcohol">
                {{ __('0') }}
              </div>
              <div class="w-1/3 text-center" id="{{$recipe->id}}PercentAlcohol">
                {{ __('0') }}
              </div>
            </div>
          </div>
    
          <div class="my-2 w-full max-w-xl flex flex-row justify-evenly items-center">
            <input class="updatestat text-center mx-2" type="number" data-mode="S" step="1" min="0" id="{{$recipe->id}}Amount" placeholder="Servings..." data-i={{$recipe->id}}>
            <button class="switchrecipe m-2 p-2 rounded-lg flex justify-center items-center border border-zinc-400" data-i={{$recipe->id}}>
              <img src="{{ asset('storage/Assets/undoLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
            </button>
          </div>
    
          <div class="my-2 w-full flex flex-row justify-evenly items-center border-t border-zinc-400" style="height:calc(var(--vh) * 7.5)">
            <button class="logrecipe mx-2 flex justify-center items-center" data-i='{{$recipe->id}}' id="{{$recipe->id}}AddLog">
              <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
            </button>
            <button class="shoprecipe mx-2 flex justify-center items-center" data-i='{{$recipe->id}}'>
              <img src="{{ asset('storage/Assets/listLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
            </button>
            <button class="larderrecipe mx-2 flex justify-center items-center" data-i='{{$recipe->id}}'>
              <img src="{{ asset('storage/Assets/cartLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
            </button>
          </div>
        </div>
      
        <div class="w-full max-w-sm overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2 mx-auto" id="{{$recipe->id}}DataList" style="display:none;">
      
          <input class="m-2 p-2 flex justify-center items-center border border-black" id="{{$recipe->id}}NewNameExists" value='{{$recipe->name}}'>
          <input class="m-2 flex justify-center items-center" min="0" step="0.1" type="number" placeholder="Servings..." id="{{$recipe->id}}EntryServingsExists" value="{{$recipe->servings}}">
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Category') }}</div>
            <div class="flex justify-center items-center w-full">{{ __('Total') }}</div>
            <div class="flex justify-center items-center w-full">{{ __('Serving') }}</div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Price') }}</div>
            <div id="{{$recipe->id}}RecipeTotalPrice" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingPrice" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Calories') }}</div>
            <div id="{{$recipe->id}}RecipeTotalCalories" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingCalories" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Carbohydrate') }}</div>
            <div id="{{$recipe->id}}RecipeTotalCarbohydrate" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingCarbohydrate" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Sugar') }}</div>
            <div id="{{$recipe->id}}RecipeTotalSugar" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingSugar" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Fat') }}</div>
            <div id="{{$recipe->id}}RecipeTotalFat" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingFat" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Saturated') }}</div>
            <div id="{{$recipe->id}}RecipeTotalSaturated" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingSaturated" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Protein') }}</div>
            <div id="{{$recipe->id}}RecipeTotalProtein" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingProtein" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Fibre') }}</div>
            <div id="{{$recipe->id}}RecipeTotalFibre" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingFibre" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Salt') }}</div>
            <div id="{{$recipe->id}}RecipeTotalSalt" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingSalt" class="flex justify-center items-center w-full"></div>
          </div>
          <div class="w-full flex flex-row justify-center items-center p-2">
            <div class="flex justify-center items-center w-full">{{ __('Alcohol') }}</div>
            <div id="{{$recipe->id}}RecipeTotalAlcohol" class="flex justify-center items-center w-full"></div>
            <div id="{{$recipe->id}}RecipeServingAlcohol" class="flex justify-center items-center w-full"></div>
          </div>
        </div>
      
        <div class="w-full max-w-sm overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2 mx-auto" id="{{$recipe->id}}IngredientList" style="display:none;">
            @foreach(json_decode($recipe->ingredients) as $ingredient)
              @foreach($foods as $food)
                @if((int)$food->id === (int)$ingredient->index && (string)$ingredient->type === "F")
                  <div class="flex flex-row justify-evenly items-center w-full my-2 p-2" style="max-height:calc(var(--vh) * 5)">
                    <div class="w-64 truncate p-2 mx-2 rounded-lg" data-index='{{$ingredient->index}}' data-type='{{$ingredient->type}}'>
                      {{$food->name}}
                    </div>
                    <input type="number" min="0" step="0.1" class="{{$recipe->id}}inputamountExists w-24 h-10/12 p-2 mx-2 text-center" data-type="F" data-index='{{$ingredient->index}}' id="{{$ingredient->index}}foodAmount" value='{{$ingredient->amount}}'>
                  </div>
                @endif
              @endforeach
              @foreach($recipes as $recipe)
                @if((int)$recipe->id === (int)$ingredient->index && (string)$ingredient->type === "R")
                  <div class="flex flex-row justify-evenly items-center w-full my-2 p-2" style="max-height:calc(var(--vh) * 5)">
                    <div class="w-64 truncate p-2 mx-2 rounded-lg" data-index='{{$ingredient->index}}' data-type='{{$ingredient->type}}'>
                      {{$recipe->name}}
                    </div>
                    <input type="number" min="0" step="0.1" class="{{$recipe->id}}inputamountExists w-24 h-10/12 p-2 mx-2 text-center" data-type="R" data-index='{{$ingredient->index}}' id="{{$ingredient->index}}recipeAmount" value='{{$ingredient->amount}}'>
                  </div>
                @endif
              @endforeach
            @endforeach
        </div>
      
        <div class="w-full max-w-xl flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2 mx-auto" id="{{$recipe->id}}InstructionList" style="display:none;">
          <div id="{{$recipe->id}}InstructionBox" class="w-full overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2">
            <div class="w-full flex flex-row justify-between items-center p-2">
              <div class="flex justify-center items-center">{{ __('Step') }}</div>
              <div class="flex justify-center items-center">{{ __('Details') }}</div>
              <div class="flex justify-center items-center">{{ __('Time') }}</div>
            </div>
            @foreach(json_decode($recipe->instructions) as $instruction)
              <div class="w-full flex flex-row justify-evenly items-start p-2" id="{{$recipe->id}}{{$instruction->number}}instructionBox">
                <div class="w-16">{{$instruction->number}}{{ __('.') }}</div>
                <textarea class="{{$recipe->id}}instructionTextExists px-2 mx-2 w-full" data-recipe='{{$recipe->id}}'
                  style="min-height:70px" id="{{$recipe->id}}{{$instruction->number}}instructionExists">{{$instruction->text}}</textarea>
                <input type="number" min="0" step="0.1" style="min-height:30px" class="w-16" id="{{$recipe->id}}{{$instruction->number}}instructionTimerExists" value="{{$instruction->timer}}">
              </div>
            @endforeach
          </div>
        </div>
        
      </div>

    </div>

  @endforeach

</div>

@endisset
@endisset