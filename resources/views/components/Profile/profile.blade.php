<div class="my-2 w-full flex justify-center items-center font-bold">
  {{ __('Profile') }}
</div>

<div class="w-full max-w-md flex flex-col justify-center items-center">

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-1/2 flex justify-center items-center mx-2" for="Gender">{{ __('Gender:') }}</label>
    <select id="Gender" class="text-center mx-2 w-36">
      <option <?php if(isset($profile->gender)) if($profile->gender === 1) echo "selected"; ?> value="M">{{ __('Male') }}</option>
      <option <?php if(isset($profile->gender)) if($profile->gender === 0) echo "selected"; ?> value="F">{{ __('Female') }}</option>
    </select>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-1/2 flex justify-center items-center mx-2" for="DOB">{{ __('Birthdate:') }}</label>
    <input class="text-center mx-2 w-36" type="date" 
    value="<?php if(isset($profile->dateofbirth)) echo date('Y-m-d', $profile->dateofbirth); else echo "2000-01-01"; ?>" id="DOB">
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-44 flex justify-center items-center mx-2" for="Height">{{ __('Height:') }}</label>
    <input class="text-center mx-2 w-32" type="number" step="0.1" min="0" 
    value="<?php if(isset($profile->height)) echo $profile->height; else echo 100; ?>" id="Height">
    <div class="w-12">{{ __('cm') }}</div>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-44 flex justify-center items-center mx-2" for="Weight">{{ __('Weight Target:') }}</label>
    <input class="text-center mx-2 w-32" type="number" step="0.1" min="0" 
    value="<?php if(isset($profile->weightTarget)) echo $profile->weightTarget; else echo 60; ?>" id="Weight">
    <div class="w-12">{{ __('kg') }}</div>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-44 flex justify-center items-center mx-2" for="Burn">{{ __('Calory Burn:') }}</label>
    <input class="text-center mx-2 w-32" type="number" step="1" min="0" max="100000"
    value="<?php if(isset($profile->caloryBurn)) echo $profile->caloryBurn; else echo 2500; ?>" id="Burn">
    <button class="mx-2 w-16 flex justify-center items-center" id="ShowBmrButton">
      <img src="{{ asset('storage/Assets/infoLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-44 flex justify-center items-center mx-2" for="Goal">{{ __('Calory Goal:') }}</label>
    <input class="text-center mx-2 w-32" type="number" step="1" min="0" max="100000"
    value="<?php if(isset($profile->caloryGoal)) echo $profile->caloryGoal; else echo 2500; ?>" id="Goal">
    <button class="mx-2 w-16 flex justify-center items-center" id="ShowGoalButton">
      <img src="{{ asset('storage/Assets/infoLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-4 w-full  flex flex-row justify-center items-center">
    <button class="mx-2 w-16 flex justify-center items-center" id="saveprofilebutton">
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

</div>

<div id="BmrPanel" class="w-full max-w-md flex flex-col justify-center items-center" style="max-height:calc(var(--vh) * 77)">

  <div class="w-1/2 flex justify-center items-center my-2 font-bold">{{ __('Daily Calory Estimates') }}</div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="BMR">{{ __('Basal Metabolic Rate:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="BMR"><?php if(isset($bmr)) echo $bmr['BMR'] ?></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="setbmrbutton" data-bmr=<?php if(isset($bmr)) echo $bmr["BMR"] ?>>
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="noExercise">{{ __('Little/No Exercise:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="noExercise"><?php if(isset($bmr)) echo $bmr['noExercise'] ?></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="noexercisebutton" data-bmr=<?php if(isset($bmr)) echo $bmr["noExercise"] ?>>
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="lightExercise">{{ __('Light Exercise:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="lightExercise"><?php if(isset($bmr)) echo $bmr['lightExercise'] ?></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="lightexercisebutton" data-bmr=<?php if(isset($bmr)) echo $bmr["lightExercise"] ?>>
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="moderateExercise">{{ __('Moderate Exercise:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="moderateExercise"><?php if(isset($bmr)) echo $bmr['moderateExercise'] ?></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="moderateExercisebutton" data-bmr=<?php if(isset($bmr)) echo $bmr["moderateExercise"] ?>>
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="veryActive">{{ __('Very Active:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="veryActive"><?php if(isset($bmr)) echo $bmr['veryActive'] ?></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="veryActivebutton" data-bmr=<?php if(isset($bmr)) echo $bmr["veryActive"] ?>>
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="extraActive">{{ __('Extra Active:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="extraActive"><?php if(isset($bmr)) echo $bmr['extraActive'] ?></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="extraActivebutton" data-bmr=<?php if(isset($bmr)) echo $bmr["extraActive"] ?>>
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <button class="mx-2 w-1/6 flex justify-center items-center" id="CloseBmrButton">
      <img src="{{ asset('storage/Assets/xLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

</div>

<div id="GoalPanel" class="w-full max-w-md flex flex-col justify-center items-center" style="max-height:calc(var(--vh) * 77)">

  <div class="w-1/2 flex justify-center items-center my-2 font-bold">{{ __('Daily Difference Estimates') }}</div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="minusOne">{{ __('Lose 1kg/week:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="minusOne"></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="minusOnebutton">
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="minusHalf">{{ __('Lose 0.5kg/week:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="minusHalf"></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="minusHalfbutton">
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="maintain">{{ __('Maintain Weight:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="maintain"></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="maintainbutton">
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="gainHalf">{{ __('Gain 0.5kg/week:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="gainHalf"></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="gainHalfbutton">
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <label class="w-2/3 flex justify-center items-center mx-2" for="gainOne">{{ __('Gain 1kg/week:') }}</label>
    <div class="w-1/6 flex justify-center items-center mx-2" id="gainOne"></div>
    <button class="mx-2 w-1/6 flex justify-center items-center" id="gainOnebutton">
      <img src="{{ asset('storage/Assets/saveLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

  <div class="my-2 w-full flex flex-row justify-center items-center">
    <button class="mx-2 w-1/6 flex justify-center items-center" id="CloseGoalButton">
      <img src="{{ asset('storage/Assets/xLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

</div>