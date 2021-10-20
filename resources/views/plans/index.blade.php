@extends('layouts.app')

@section('content')
<div class="col-span-12 mb-5 flex">
  <h1 class="mr-auto text-2xl font-semibold">{{ ucfirst(__('plan.plan')) }}</h1>

  @component('components.close-button', [
    'back' => true
  ])
  @endcomponent
</div>

<div class="col-span-8">
  <h3 class="pb-5 text-2xl">Dostępne pakiety</h3>

  <div class="flex space-x-5">
    @foreach(\App\Plan::all() as $plan)
      @component('components.plan', [
        'plan' => $plan
      ])                                    
      @endcomponent
    @endforeach
  </div>
</div>

<div class="lg:col-span-1"></div>

<div class="lg:mt-0 mt-5 col-span-3">
  <h3 class="pb-5 text-2xl">Mój pakiet</h3>
  
  <div>
    @if(auth()->user()->plan()->exists())
      @component('components.plan', [
        'plan' => auth()->user()->plan()->exists()
      ])
      @endcomponent
    @else
      <h6 class="text-2xl font-light">Brak pakietu</h6>
    @endif
  </div>
</div>
@endsection