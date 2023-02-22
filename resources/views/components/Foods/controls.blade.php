@isset($foods)

<div class="flex flex-row justify-center items-center w-full max-w-2xl mx-auto" style="height:calc(var(--vh) * 7.5)">
  <input class="w-full h-11/12" type="text" id="Find" placeholder="Search..." style="width:45%">
  <button class="mx-2 flex justify-center items-center" id="New" style="width:10%">
    <img src="{{ asset('storage/Assets/plusLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>
</div>

<div id="Display" class="overflow-y-auto" style="height:calc(var(--vh) * 75)">
  @isset($foods)
    <x-Foods.data :foods="$foods"></x-Foods.data>
  @endisset
</div>

<div id="EditScreen">

  <div class="my-2 w-full max-w-xl flex justify-center items-center font-bold">{{ __('New Food') }}</div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <input class="text-left" type="text" id="EditScreenName" placeholder="Name...">
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <input class="text-left" type="text" id="EditScreenVendor" placeholder="Vendor...">
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <input class="text-left" type="text" id="EditScreenURL" placeholder="URL...">
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenPrice">{{ __('Price:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenPrice">
    <div class="ml-2">{{ __('£') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenWeight">{{ __('Weight:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenWeight">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenServings">{{ __('Servings:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenServings">
    <div class="ml-2">{{ __('s') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenExpiry">{{ __('Expiry:') }}</label>
    <input class="text-center w-24" type="number" step="1" min="0" value="0" id="EditScreenExpiry">
    <div class="ml-2">{{ __('d') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenPer">{{ __('Per:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenPer">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenCalories">{{ __('Calories:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenCalories">
    <div class="ml-2">{{ __('c') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenCarbohydrate">{{ __('Carbohydrate:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenCarbohydrate">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenSugar">{{ __('Sugar:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenSugar">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenFat">{{ __('Fat:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenFat">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenSaturated">{{ __('Saturated:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenSaturated">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenProtein">{{ __('Protein:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenProtein">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenFibre">{{ __('Fibre:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenFibre">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenSalt">{{ __('Salt:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenSalt">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
    <label class="flex justify-center items-center mx-2 w-32" for="EditScreenAlcohol">{{ __('Alcohol:') }}</label>
    <input class="text-center w-24" type="number" step="0.01" min="0" value="0" id="EditScreenAlcohol">
    <div class="ml-2">{{ __('g') }}</div>
  </div>

  <x-primary-button class="my-4 w-full max-w-xs flex justify-center items-center" id="Add">{{ __('Add') }}</x-primary-button>
  <x-primary-button class="my-4 w-full max-w-xs flex justify-center items-center" id="Close">{{ __('Close') }}</x-primary-button>
  
</div>

@endisset