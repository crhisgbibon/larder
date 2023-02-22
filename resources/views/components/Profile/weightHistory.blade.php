<div id="WeightScreen" class="w-full max-w-xl flex flex-col justify-start items-center mx-auto" style="max-height:calc(var(--vh) * 77)">

  <div class="my-2 w-full max-w-xl flex justify-center items-center font-bold"style="max-height:calc(var(--vh) * 7.5)">
    {{ __('Weight Log') }}
  </div>

  <div class="w-full max-w-xl flex flex-col justify-start items-center">

    <div class="w-full max-w-xl flex flex-row justify-center items-center"style="max-height:calc(var(--vh) * 7.5)">
      <input class="text-center mx-2 w-24" type="number" step="0.01" min="0" value="0" id="WeightInput">
      <div>{{ __('kg') }}</div>
      <button class="w-16 m-2 p-2 flex justify-center items-center" id="SaveWeightButton">
        <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
    </div>

    <div id="WeightOutput" class="w-full max-w-md overflow-y-auto" style="max-height:calc(var(--vh) * 62)">

      <x-Profile.weightLog :weights="$weights"></x-Profile.weightLog>

    </div>
  
  </div>

</div>