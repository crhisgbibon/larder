@vite(['resources/js/profile.js'])

<x-app-layout>

  <style>
    :root{
      --background: rgba(255, 255, 255, 1);
      --foreground: rgba(50, 50, 50, 1);

      --buttonBackground: rgba(240, 240, 240, 1);
      --buttonBackgroundHover: rgba(150, 150, 150, 1);
      --buttonBorder: rgba(75,75,75,1);

      --green: rgba(125, 200, 125, 1);
      --orange: rgba(225, 175, 125, 1);
      --red: rgb(200, 125, 125);
    }

    body{
      max-width: 100%;
      overflow-x: hidden;
    }

    .selected{
      background-color: var(--buttonBackground);
    }

    #messageBoxHolder{
      position: absolute;
      z-index: 200;
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

    #BmrPanel{
      z-index: 1;
      position: fixed;
      background-color: var(--background);
      width: 100%;
      height: calc(var(--vh) * 80);
      top: calc(var(--vh) * 22.5);
      margin: 0;
      padding: 0;
      padding-bottom: 8px;
      overflow-y: auto;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      flex-direction: column;
    }

    #GoalPanel{
      z-index: 1;
      position: fixed;
      background-color: var(--background);
      width: 100%;
      height: calc(var(--vh) * 80);
      top: calc(var(--vh) * 22.5);
      margin: 0;
      padding: 0;
      padding-bottom: 8px;
      overflow-y: auto;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      flex-direction: column;
    }
    
  </style>

  <x-slot name="appTitle">
    {{ __('larder : profile') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('larder : profile') }}
  </x-slot>

  <x-headerMenu></x-headerMenu>

  <x-Profile.controls :profile="$profile" :weights="$weights" :goal="$goal" :lastweight="$lastweight" :bmr="$bmr" :chartdata="$chartdata"></x-Profile.controls>

  <div id="messageBoxHolder"><div id="messageBox"></div></div>

</x-app-layout>