@isset($recipes)
@isset($foods)

<div class="flex flex-row justify-center items-center w-full max-w-xl mx-auto" style="height:calc(var(--vh) * 7.5)">

  <input class="w-full max-w-xs h-11/12" type="text" id="Find" placeholder="Search...">

  <button class="mx-2 flex justify-center items-center" id="New" style="width:10%">
    <img src="{{ asset('storage/Assets/plusLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>

</div>

<div id="Display" class="overflow-y-scroll" style="min-height:calc(var(--vh) * 85);top:calc(var(--vh) * 15)">
  @isset($recipes)
    <x-Recipes.data :recipes="$recipes" :foods="$foods"></x-Recipes.data>
  @endisset
</div>

<div id="NewEntry" style="min-height:calc(var(--vh) * 85);top:calc(var(--vh) * 15);display:none;">

  <div class="my-2 w-full max-w-xl flex justify-center items-center font-bold">{{ __('New Recipe') }}</div>

  <div class="flex flex-row w-full max-w-sm justify-evenly items-center">
    <x-secondary-button class="m-2 p-2 flex justify-center items-center" id="ToggleData">
      <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/chartLight.svg') }}">
    </x-secondary-button>
    <x-secondary-button class="m-2 p-2 flex justify-center items-center" id="ToggleIngredients">
      <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/bowl.svg') }}">
    </x-secondary-button>
    <x-secondary-button class="m-2 p-2 flex justify-center items-center" id="ToggleInstructions">
      <img class="w-3/4 h-3/4 flex justify-center items-center" src="{{ asset('storage/Assets/listLight.svg') }}">
    </x-secondary-button>
  </div>

  <div class="w-full max-w-sm overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2" id="DataList" style="max-height:calc(var(--vh) * 75)">

    <input class="m-2 flex justify-center items-center" type="text" placeholder="Name..." id="NewEntryName">
    <input class="m-2 flex justify-center items-center" min="0" step="0.1" type="number" placeholder="Servings..." id="NewEntryServings">
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Category') }}</div>
      <div class="flex justify-center items-center w-full">{{ __('Total') }}</div>
      <div class="flex justify-center items-center w-full">{{ __('Serving') }}</div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Price') }}</div>
      <div id="NewRecipeTotalPrice" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingPrice" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Calories') }}</div>
      <div id="NewRecipeTotalCalories" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingCalories" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Carbohydrate') }}</div>
      <div id="NewRecipeTotalCarbohydrate" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingCarbohydrate" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Sugar') }}</div>
      <div id="NewRecipeTotalSugar" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingSugar" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Fat') }}</div>
      <div id="NewRecipeTotalFat" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingFat" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Saturated') }}</div>
      <div id="NewRecipeTotalSaturated" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingSaturated" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Protein') }}</div>
      <div id="NewRecipeTotalProtein" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingProtein" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Fibre') }}</div>
      <div id="NewRecipeTotalFibre" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingFibre" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Salt') }}</div>
      <div id="NewRecipeTotalSalt" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingSalt" class="flex justify-center items-center w-full"></div>
    </div>
    <div class="w-full flex flex-row justify-center items-center p-2">
      <div class="flex justify-center items-center w-full">{{ __('Alcohol') }}</div>
      <div id="NewRecipeTotalAlcohol" class="flex justify-center items-center w-full"></div>
      <div id="NewRecipeServingAlcohol" class="flex justify-center items-center w-full"></div>
    </div>
  </div>

  <div class="w-full max-w-sm overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2" id="IngredientList" style="max-height:calc(var(--vh) * 75)">
    <div class="flex flex-row w-full max-w-sm justify-evenly items-center">
      <x-secondary-button class="m-2 p-2 flex justify-center items-center" id="ToggleFoods">{{ __('Foods') }}</x-secondary-button>
      <x-secondary-button class="m-2 p-2 flex justify-center items-center" id="ToggleRecipes">{{ __('Recipes') }}</x-secondary-button>
    </div>

    <div class="w-full max-w-sm overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2" id="FoodList" style="max-height:calc(var(--vh) * 75)">
      <div class="flex flex-row justify-evenly items-center w-full my-2 p-2" style="max-height:calc(var(--vh) * 5)">
        <input class="w-full truncate p-2 mx-2 rounded-lg border border-zinc-300" style='max-width: 95%' id='FilterFood'>
      </div>
      <div class="flex flex-row justify-evenly items-center w-full my-2 p-2" style="max-height:calc(var(--vh) * 5)">
        <div class="w-64 truncate p-2 mx-2 rounded-lg">
          {{ __('Name') }}
        </div>
        <div class="w-24 h-10/12 p-2 mx-2 text-center">
          {{ __('Amount(g)') }}
        </div>
      </div>
      @foreach($foods as $food)
        <div class="toggleFoodDiv flex flex-row justify-evenly items-center w-full my-2 p-2" style="max-height:calc(var(--vh) * 5)" data-search='{{$food->name}}'>
          <div class="toggleFood w-64 truncate p-2 mx-2 rounded-lg" 
          data-index={{$food->id}}
          >
            {{$food->name}}
          </div>
          <input type="number" min="0" step="0.1" class="inputamount w-24 h-10/12 p-2 mx-2 text-center" data-type="F" data-index={{$food->id}} id="{{$food->id}}foodItem" disabled>
        </div>
      @endforeach
    </div>

    <div class="w-full max-w-sm overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2" id="RecipeList" style="max-height:calc(var(--vh) * 75)">
      <div class="flex flex-row justify-evenly items-center w-full my-2 p-2" style="max-height:calc(var(--vh) * 5)">
        <input class="w-full truncate p-2 mx-2 rounded-lg border border-zinc-300" style='max-width: 95%' id='FilterRecipe'>
      </div>
      <div class="flex flex-row justify-evenly items-center w-full my-2 p-2" style="max-height:calc(var(--vh) * 5)">
        <div class="w-64 truncate p-2 mx-2 rounded-lg">
          {{ __('Name') }}
        </div>
        <div class="w-24 h-10/12 p-2 mx-2 text-center">
          {{ __('Amount(g)') }}
        </div>
      </div>
      @foreach($recipes as $recipe)
        <div class="toggleRecipeDiv flex flex-row justify-evenly items-center w-full my-2 p-2" style="max-height:calc(var(--vh) * 5)" data-search='{{$recipe->name}}'>
          <div class="toggleRecipe w-64 truncate p-2 mx-2 rounded-lg" data-index={{$recipe->id}}>
            {{$recipe->name}}
          </div>
          <input type="number" min="0" step="0.1" class="inputamount w-24 h-10/12 p-2 mx-2 text-center" data-type="R" data-index={{$recipe->id}} id="{{$recipe->id}}recipeItem" disabled>
        </div>
      @endforeach
    </div>

  </div>

  <div class="w-full max-w-xl overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2" id="InstructionList">
    <div id="InstructionBox" class="w-full overflow-y-auto flex flex-col justify-start items-center border border-zinc-300 rounded-lg p-2" style="max-height:calc(var(--vh) * 75)">
      <div class="w-full flex flex-row justify-between items-center p-2">
        <div class="flex justify-center items-center">{{ __('Step') }}</div>
        <div class="flex justify-center items-center">{{ __('Details') }}</div>
        <div class="flex justify-center items-center">{{ __('Time') }}</div>
      </div>
      <div class="w-full flex flex-row justify-evenly items-start p-2" id="1instructionBox">
        <div class="w-16">{{ __('1.') }}</div>
        <textarea class="instructionText px-2 mx-2 w-full" style="min-height:70px" id="1instruction"></textarea>
        <input type="number" min="0" step="0.1" style="min-height:70px" class="w-16" id="1instructionTimer">
      </div>
    </div>
    <div class="w-full flex flex-row justify-evenly items-center p-2">
      <x-secondary-button class="m-2 w-24 max-w-xs flex justify-center items-center" id="AddInstructionButton">{{ __('+') }}</x-secondary-button>
      <x-secondary-button class="m-2 w-24 max-w-xs flex justify-center items-center" id="RemoveInstructionButton">{{ __('-') }}</x-secondary-button>
    </div>
  </div>

  <div class="flex flex-row w-full max-w-sm justify-evenly items-center">
    <x-secondary-button class="m-2 max-w-xs flex justify-center items-center" id="AddNew">{{ __('Add') }}</x-secondary-button>
    <x-secondary-button class="m-2 max-w-xs flex justify-center items-center" id="CloseNewEntry">{{ __('Close') }}</x-secondary-button>
  </div>
  
</div>

@endisset
@endisset