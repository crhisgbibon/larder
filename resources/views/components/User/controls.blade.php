<div class="flex flex-row justify-evenly items-center w-full max-w-2xl mx-auto" style="height:calc(var(--vh) * 7.5)">
  <button class="rounded-lg p-2 mx-2 flex justify-center items-center" id="Summary">
    <img src="{{ asset('storage/Assets/chartLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>
  <button class="rounded-lg p-2 mx-2 flex justify-center items-center" id="Profile">
    <img src="{{ asset('storage/Assets/profileLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>
  <button class="rounded-lg p-2 mx-2 flex justify-center items-center" id="Nutrient">
    <img src="{{ asset('storage/Assets/barChart.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>
  <button class="rounded-lg p-2 mx-2 flex justify-center items-center" id="WeightB">
    <img src="{{ asset('storage/Assets/listLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
  </button>
</div>

<div id="SummaryScreen">
  <x-User.summary :chartdata="$chartdata"></x-User.summary>
</div>

<div id="ProfileScreen" class="w-full max-w-xl flex flex-col justify-start items-center mx-auto overflow-y-auto" style="max-height:calc(var(--vh) * 77)">
  <x-User.user :profile="$profile" :lastweight="$lastweight" :bmr="$bmr"></x-User.user>
</div>

<x-User.nutrientGoal :goal="$goal"></x-User.nutrientGoal>

<x-User.weightHistory :weights="$weights"></x-User.weightHistory>