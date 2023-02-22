<x-slot name="header" class="flex-row items-center">
  <div class="flex w-full max-w-6xl flex-row justify-center mx-auto" style="height:calc(var(--vh) * 7.5)">
    <a id="LogButton" href="{{ url('/larder/log') }}" class="h-full flex justify-center items-center mx-2 active:scale-95">
      <img class="w-3/4 h-3/4" src="{{ asset('storage/Assets/calendarLight.svg') }}">
    </a>
    <a id="FoodsButton" href="{{ url('/larder/foods') }}" class="h-full flex justify-center items-center mx-2 active:scale-95">
      <img class="w-3/4 h-3/4" src="{{ asset('storage/Assets/coffeeLight.svg') }}">
    </a>
    <a id="RecipesButton" href="{{ url('/larder/recipes') }}" class="h-full flex justify-center items-center mx-2 active:scale-95">
      <img class="w-3/4 h-3/4" src="{{ asset('storage/Assets/bowl.svg') }}">
    </a>
    <a id="ProfileButton" href="{{ url('/larder/profile') }}" class="h-full flex justify-center items-center mx-2 active:scale-95">
      <img class="w-3/4 h-3/4" src="{{ asset('storage/Assets/profileLight.svg') }}">
    </a>
  </div>
</x-slot>