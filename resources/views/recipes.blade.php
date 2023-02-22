@vite(['resources/js/recipes.js'])

<x-app-layout>

  <style>
    :root{
      --background: var(--backgroundLight);
      --foreground: var(--foregroundLight);

      --buttonBackground: var(--buttonBackgroundLight);
      --buttonBorder: var(--buttonBorderLight);

      --buttonBackgroundLight: rgba(240, 240, 240, 1);
      --buttonBackgroundHover: rgba(150, 150, 150, 1);
      --buttonBorderLight: rgba(75,75,75,1);

      --foregroundLight: rgba(50, 50, 50, 1);
      --backgroundLight: rgba(255, 255, 255, 1);
      
      --green: rgba(125, 200, 125, 1);
      --red: rgba(200, 125, 125, 1);
    }

    body{
      max-width: 100%;
      overflow-x: hidden;
    }

    #messageBoxHolder{
      position: absolute;
      z-index: 100;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(var(--vh) * 10);
      bottom: calc(var(--vh) * 20);
      pointer-events: none;
    }

    #messageBox{
      background-color: var(--foreground);
      color: var(--background);
      width: 100%;
      max-width: 300px;
      height: 100%;
      max-height: 100px;
      border-radius: 6px;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      pointer-events: default;
    }

    #NewEntry{
      z-index: 1;
      position: fixed;
      background-color: var(--background);
      width: 100%;
      height: calc(var(--vh) * 77);
      top: calc(var(--vh) * 22.5);
      margin: 0;
      padding: 0;
      overflow-y: auto;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      flex-direction: column;
    }
    
  </style>

  <x-slot name="appTitle">
    {{ __('larder : recipes') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('larder : recipes') }}
  </x-slot>

  <x-headerMenu></x-headerMenu>

  <x-Recipes.controls :recipes="$recipes" :foods="$foods"></x-Recipes.controls>

  <div id="messageBoxHolder"><div id="messageBox"></div></div>

</x-app-layout>