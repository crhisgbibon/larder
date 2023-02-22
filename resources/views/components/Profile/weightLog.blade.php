@isset($weights)

@foreach($weights as $weight)

  <div class="w-full max-w-xl flex flex-row justify-center items-center">
    <div class="w-1/2 text-center">
      {{ date("Y-m-d", $weight->logTime) }}
    </div>
    <div class="w-1/2 w-1/3 text-center">
      {{ number_format( $weight->weight, 2) }}{{ __('kg') }}
    </div>
    <button class="deleteweights w-16 mx-4 p-2 flex justify-center items-center" data-i={{$weight->id}}>
      <img src="{{ asset('storage/Assets/eraseLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

@endforeach

@endisset