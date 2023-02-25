<div id="NutrientScreen" class="w-full max-w-xl flex flex-col justify-start items-center mx-auto overflow-y-auto" style="max-height:calc(var(--vh) * 77)">

  <div class="my-2 w-full max-w-xl flex justify-center items-center font-bold">
    {{ __('Daily Nutrient Goal') }}
  </div>

  <div class="w-full max-w-xl flex flex-col justify-center items-center">

    <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
      <label class="w-32 flex justify-center items-center mx-2" for="Carbohydrate">{{ __('Carbohydrate:') }}</label>
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" 
      value="<?php if(isset($goal->carbohydrate)) echo $goal->carbohydrate; else echo 100; ?>" id="Carbohydrate">
      <div>{{ __('g') }}</div>
    </div>

    <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
      <label class="w-32 flex justify-center items-center mx-2" for="Sugar">{{ __('Sugar:') }}</label>
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" 
      value="<?php if(isset($goal->sugar)) echo $goal->sugar; else echo 100; ?>" id="Sugar">
      <div>{{ __('g') }}</div>
    </div>

    <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
      <label class="w-32 flex justify-center items-center mx-2" for="Fat">{{ __('Fat:') }}</label>
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" 
      value="<?php if(isset($goal->fat)) echo $goal->fat; else echo 100; ?>" id="Fat">
      <div>{{ __('g') }}</div>
    </div>

    <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
      <label class="w-32 flex justify-center items-center mx-2" for="Saturated">{{ __('Saturated:') }}</label>
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" 
      value="<?php if(isset($goal->saturated)) echo $goal->saturated; else echo 100; ?>" id="Saturated">
      <div>{{ __('g') }}</div>
    </div>

    <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
      <label class="w-32 flex justify-center items-center mx-2" for="Protein">{{ __('Protein:') }}</label>
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" 
      value="<?php if(isset($goal->protein)) echo $goal->protein; else echo 100; ?>" id="Protein">
      <div>{{ __('g') }}</div>
    </div>

    <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
      <label class="w-32 flex justify-center items-center mx-2" for="Fibre">{{ __('Fibre:') }}</label>
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" 
      value="<?php if(isset($goal->fibre)) echo $goal->fibre; else echo 100; ?>" id="Fibre">
      <div>{{ __('g') }}</div>
    </div>

    <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
      <label class="w-32 flex justify-center items-center mx-2" for="Salt">{{ __('Salt:') }}</label>
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" 
      value="<?php if(isset($goal->salt)) echo $goal->salt; else echo 100; ?>" id="Salt">
      <div>{{ __('g') }}</div>
    </div>

    <div class="my-2 w-full max-w-xl flex flex-row justify-center items-center">
      <label class="w-32 flex justify-center items-center mx-2" for="Alcohol">{{ __('Alcohol:') }}</label>
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" 
      value="<?php if(isset($goal->alcohol)) echo $goal->alcohol; else echo 100; ?>" id="Alcohol">
      <div>{{ __('g') }}</div>
    </div>

    <button class="w-32 m-2 p-2 flex justify-center items-center" id="savenutrientgoal">
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  
  </div>

</div>