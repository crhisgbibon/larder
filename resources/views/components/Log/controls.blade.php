@isset($logs)

<div class="flex flex-row justify-center items-center w-full max-w-2xl mx-auto" style="height:calc(var(--vh) * 7.5)">
  <button class="w-12 my-2 flex justify-center items-center" id="lastdaybutton">
    <img src="{{ asset('storage/Assets/chevronLeftLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>
  <input class="w-40 h-11/12" type="date" id="Day" value={{$day}}>
  <button class="w-12 my-2 flex justify-center items-center" id="nextdaybutton">
    <img src="{{ asset('storage/Assets/chevronRightLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>
  <x-secondary-button class="mx-2 p-2 flex justify-center items-center w-32" id="Breakdown">
    <?php if(isset($totals['calories'])) echo number_format($totals['calories'], 2); ?>
  </x-secondary-button>
</div>

<div id="Display" class="overflow-y-auto" style="min-height:calc(var(--vh) * 85);max-height:calc(var(--vh) * 85);top:calc(var(--vh) * 15)">
  @isset($logs)
    <x-Log.data :logs="$logs" :targets="$targets" :profile="$profile"></x-Log.data>
  @endisset
</div>

<div id="BreakdownScreen" style="min-height:calc(var(--vh) * 85);top:calc(var(--vh) * 15)">

  <div class="my-2 w-full max-w-xl flex justify-center items-center font-bold">{{ __('Summary') }}</div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center mb-2">
    <div class="w-1/3 text-center mx-2">
      {{ __('Category') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownPrice">
      &sum;
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownPrice">
      {{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Price:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownPrice">
      {{ __('£') }}<?php if(isset($totals['price'])) echo number_format($totals['price'], 2); else echo 100; ?>
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownPrice">
      {{ __('-') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Calories:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownCalories">
      {{number_format($totals['calories'], 2)}}{{ __('c') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($profile->caloryGoal) && isset($totals['calories'])) echo number_format( ( 100 / $profile->caloryGoal ) * $totals['calories'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Carbohydrate:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownCarbohydrate">
      {{number_format($totals['carbohydrate'], 2)}}{{ __('g') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($targets->carbohydrate) && isset($totals['carbohydrate'])) echo number_format( ( 100 / $targets->carbohydrate ) * $totals['carbohydrate'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Sugar:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownSugar">
      {{number_format($totals['sugar'], 2)}}{{ __('g') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($targets->sugar) && isset($totals['sugar'])) echo number_format( ( 100 / $targets->sugar ) * $totals['sugar'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Fat:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownFat">
      {{number_format($totals['fat'], 2)}}{{ __('g') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($targets->fat) && isset($totals['fat'])) echo number_format( ( 100 / $targets->fat ) * $totals['fat'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Saturated:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownSaturated">
      {{number_format($totals['saturated'], 2)}}{{ __('g') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($targets->saturated) && isset($totals['saturated'])) echo number_format( ( 100 / $targets->saturated ) * $totals['saturated'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Protein:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownProtein">
      {{number_format($totals['protein'], 2)}}{{ __('g') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($targets->protein) && isset($totals['protein'])) echo number_format( ( 100 / $targets->protein ) * $totals['protein'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Fibre:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownFibre">
      {{number_format($totals['fibre'], 2)}}{{ __('g') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($targets->fibre) && isset($totals['fibre'])) echo number_format( ( 100 / $targets->fibre ) * $totals['fibre'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Salt:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownSalt">
      {{number_format($totals['salt'], 2)}}{{ __('g') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($targets->salt) && isset($totals['salt'])) echo number_format( ( 100 / $targets->salt ) * $totals['salt'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/3 text-center mx-2">
      {{ __('Alcohol:') }}
    </div>
    <div class="w-1/3 text-center mx-2" id="BreakdownAlcohol">
      {{number_format($totals['alcohol'], 2)}}{{ __('g') }}
    </div>
    <div class="w-1/3 text-center mx-2">
      <?php if(isset($targets->alcohol) && isset($totals['alcohol'])) echo number_format( ( 100 / $targets->alcohol ) * $totals['alcohol'], 2 ); else echo 0; ?>{{ __('%') }}
    </div>
  </div>
  
</div>

@endisset