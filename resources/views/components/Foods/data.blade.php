@isset($foods)

<div class="w-full flex flex-col items-start">

@foreach($foods as $food)

<div class="flex flex-col justify-center items-center w-full max-w-2xl mx-auto my-2">

  <div class="food flex flex-col justify-center items-center w-full max-w-2xl mx-auto" data-search='{{$food->id}}' data-name='{{$food->name}}'>
    <div class="flex flex-row justify-center items-center w-full mx-2 bg-zinc-100 border-y md:border-x border-zinc-400">
      <button class="togglepanelwithid mx-2 flex justify-center items-center" data-i={{$food->id}}>
        <img src="{{ asset('storage/Assets/eyeLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      <input class="text-left mx-2 w-full p-2 bg-transparent border-0" type="text" id="{{$food->id}}EditScreenName" value="{{$food->name}}">
      <input class="text-left mx-2 w-32 p-2 bg-transparent border-0" type="text" id="{{$food->id}}EditScreenName" value="{{$food->vendor}}">
      <button class="updatefood mx-2 flex justify-center items-center" data-i={{$food->id}}>
        <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
    </div>
  </div>

  <div id="{{$food->id}}Food" class="flex flex-col justify-center items-center w-full max-w-2xl mx-auto mb-2" style="display:none;">

    <div class="flex flex-row justify-evenly items-center w-full max-w-2xl mx-auto border-b md:border-x border-zinc-400" style="height:calc(var(--vh) * 7.5)">
      <button class="togglefoodpanel2 mx-2 flex justify-center items-center" data-i={{$food->id}}>
        <img src="{{ asset('storage/Assets/chartLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      <button class="togglefoodpanel1 mx-2 flex justify-center items-center" data-i={{$food->id}}>
        <img src="{{ asset('storage/Assets/barChart.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
    </div>

    <div id="{{$food->id}}Options" class="flex flex-col justify-center items-center w-full mx-2 border-b md:border-x border-zinc-400">

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
          <div class="w-1/3 text-center" id="{{$food->id}}CountCalories">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentCalories">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Price:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountPrice">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentPrice">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Carbohydrate:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountCarbohydrate">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentCarbohydrate">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Sugar:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountSugar">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentSugar">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Fat:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountFat">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentFat">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Saturated:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountSaturated">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentSaturated">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Protein:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountProtein">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentProtein">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Fibre:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountFibre">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentFibre">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Salt:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountSalt">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentSalt">
            {{ __('0') }}
          </div>
        </div>

        <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
          <div class="w-1/3 text-center">
            {{ __('Alcohol:') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}CountAlcohol">
            {{ __('0') }}
          </div>
          <div class="w-1/3 text-center" id="{{$food->id}}PercentAlcohol">
            {{ __('0') }}
          </div>
        </div>
      </div>

      <div class="my-2 w-full max-w-xl flex flex-row justify-evenly items-center">
        <input class="updatestat text-center mx-2" type="number" data-mode="S" step="1" min="0" id="{{$food->id}}Amount" placeholder="Servings..." data-i={{$food->id}}>
        <button class="switchfood m-2 p-2 rounded-lg flex justify-center items-center border border-zinc-400" data-i={{$food->id}}>
          <img src="{{ asset('storage/Assets/undoLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
      </div>

      <div class="my-2 w-full flex flex-row justify-evenly items-center border-t border-zinc-400" style="height:calc(var(--vh) * 7.5)">
        <button class="logfood mx-2 flex justify-center items-center" data-i={{$food->id}}>
          <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
        <button class="shopfood mx-2 flex justify-center items-center" data-i={{$food->id}}>
          <img src="{{ asset('storage/Assets/listLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
        <button class="larderfood mx-2 flex justify-center items-center" data-i={{$food->id}}>
          <img src="{{ asset('storage/Assets/cartLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
      </div>
    </div>

    <div id="{{$food->id}}Edit" class="flex flex-col justify-center items-center w-full mx-2 border-b md:border-x border-zinc-400" style="display:none;">
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenVendor">{{ __('Vendor:') }}</label>
        <input class="text-center mx-2 w-24" type="text" value="{{$food->vendor}}" id="{{$food->id}}EditScreenVendor">
        <div class="ml-2">{{ __('£') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenURL">{{ __('URL:') }}</label>
        <input class="text-center mx-2 w-24" type="text" value="{{$food->url}}" id="{{$food->id}}EditScreenURL">
        <div class="ml-2">{{ __('£') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenPrice">{{ __('Price:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->price}}" id="{{$food->id}}EditScreenPrice">
        <div class="ml-2">{{ __('£') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenWeight">{{ __('Weight:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->weight}}" id="{{$food->id}}EditScreenWeight">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenServings">{{ __('Servings:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->servings}}" id="{{$food->id}}EditScreenServings">
        <div class="ml-2">{{ __('s') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenExpiry">{{ __('Expiry:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->expiry}}" id="{{$food->id}}EditScreenExpiry">
        <div class="ml-2">{{ __('d') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenPer">{{ __('Per:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="1" min="0" value="{{$food->per}}" id="{{$food->id}}EditScreenPer">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenCalories">{{ __('Calories:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->calories}}" id="{{$food->id}}EditScreenCalories">
        <div class="ml-2">{{ __('c') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenCarbohydrate">{{ __('Carbohydrate:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->carbohydrate}}" id="{{$food->id}}EditScreenCarbohydrate">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenSugar">{{ __('Sugar:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->sugar}}" id="{{$food->id}}EditScreenSugar">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenFat">{{ __('Fat:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->fat}}" id="{{$food->id}}EditScreenFat">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenSaturated">{{ __('Saturated:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->saturated}}" id="{{$food->id}}EditScreenSaturated">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenProtein">{{ __('Protein:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->protein}}" id="{{$food->id}}EditScreenProtein">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenFibre">{{ __('Fibre:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->fibre}}" id="{{$food->id}}EditScreenFibre">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenSalt">{{ __('Salt:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->salt}}" id="{{$food->id}}EditScreenSalt">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
        <label class="flex justify-center items-center mx-2 w-24" for="{{$food->id}}EditScreenAlcohol">{{ __('Alcohol:') }}</label>
        <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="{{$food->alcohol}}" id="{{$food->id}}EditScreenAlcohol">
        <div class="ml-2">{{ __('g') }}</div>
      </div>
      <div class="my-2 w-full max-w-xl flex flex-row justify-evenly items-center">
        <button class="updatefood m-2 flex justify-center items-center" data-i={{$food->id}}>
          <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
        <button class="deletefood m-2 flex justify-center items-center" data-i={{$food->id}}>
          <img src="{{ asset('storage/Assets/eraseLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
        </button>
      </div>
    </div>

  </div>

</div>

@endforeach

</div>

@endisset