@isset($logs)

<div class="w-full flex flex-col items-start">

@foreach($logs as $log)

<div class="flex flex-col justify-center items-center w-full max-w-2xl mx-auto my-2">

  <div class="flex flex-col justify-center items-center w-full max-w-2xl mx-auto">
    <div class="flex flex-row justify-center items-center w-full mx-2 bg-zinc-100 border-y md:border-x border-zinc-400">
      <button class="togglepanelwithid w-12 mx-2 flex justify-center items-center" data-i={{$log->id}}>
        <img src="{{ asset('storage/Assets/eyeLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
      <div class="w-full text-left mx-2 p-2 bg-transparent border-0">
        {{$log->name}}
      </div>
      <input class="changetime w-60 text-left mx-2 p-2 bg-transparent border-0 text-right" type="time" data-i={{$log->id}} id="{{$log->id}}Time" value={{date("H:i", $log->logTime)}}>
      <button class="deleteLog w-12 mx-2 flex justify-center items-center" data-i={{$log->id}}>
        <img src="{{ asset('storage/Assets/eraseLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
    </div>
  </div>

  <div id="{{$log->id}}Log" class="flex flex-col justify-start items-center w-full max-w-md mx-auto mb-2 bg-gray-50" style="display:none;">

    <div class="my-2 p-2 w-full flex flex-col justify-evenly items-center border-y md:border-x border-zinc-400">
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center my-2">
        <div class="w-1/3 text-center">
          {{ __('Amount:') }}
        </div>
        <input class="changeamount w-36 mx-2 p-2 bg-transparent border-0 text-center" type="number" step="1" data-i={{$log->id}} 
        min="0" id="{{$log->id}}Amount" value={{ number_format( $log->amount, 2) }}>
        <div class="w-1/3 text-center">
          {{ __('g') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Calories:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->calories, 2) }}{{ __('c') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($profile)) 
            { 
              echo number_format( ( (100 / $profile->caloryGoal) * $log->calories), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Price:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ __('£') }}{{ number_format($log->price, 2) }}
        </div>
        <div class="w-1/3 text-center">
          {{ __('n/a') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Carbohydrate:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->carbohydrate, 2) }}{{ __('g') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($targets)) 
            { 
              echo number_format( ( (100 / $targets->carbohydrate) * $log->carbohydrate), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Sugar:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->sugar, 2) }}{{ __('g') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($targets)) 
            { 
              echo number_format( ( (100 / $targets->sugar) * $log->sugar), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Fat:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->fat, 2) }}{{ __('g') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($targets)) 
            { 
              echo number_format( ( (100 / $targets->fat) * $log->fat), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Saturated:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->saturated, 2) }}{{ __('g') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($targets)) 
            { 
              echo number_format( ( (100 / $targets->saturated) * $log->saturated), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Protein:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->protein, 2) }}{{ __('g') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($targets)) 
            { 
              echo number_format( ( (100 / $targets->protein) * $log->protein), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Fibre:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->fibre, 2) }}{{ __('g') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($targets)) 
            { 
              echo number_format( ( (100 / $targets->fibre) * $log->fibre), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Salt:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->salt, 2) }}{{ __('g') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($targets)) 
            { 
              echo number_format( ( (100 / $targets->salt) * $log->salt), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <div class="w-full max-w-xl flex flex-row justify-evenly items-center">
        <div class="w-1/3 text-center">
          {{ __('Alcohol:') }}
        </div>
        <div class="w-1/3 text-center">
          {{ number_format($log->alcohol, 2) }}{{ __('g') }}
        </div>
        <div class="w-1/3 text-center">
          <?php 
            if(isset($targets)) 
            { 
              echo number_format( ( (100 / $targets->alcohol) * $log->alcohol), 2);
            }
            else echo 0; 
          ?>{{ __('%') }}
        </div>
      </div>
      <input class="changedate w-60 text-left my-2 p-2 bg-transparent border-0 text-center" type="date" data-i={{$log->id}} id="{{$log->id}}Date" value={{date("Y-m-d", $log->logTime)}}>
      <button class="relog w-12 my-2 flex justify-center items-center" data-i={{$log->id}}>
        <img src="{{ asset('storage/Assets/undoLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
      </button>
    </div>

  </div>

</div>

@endforeach

</div>

@endisset