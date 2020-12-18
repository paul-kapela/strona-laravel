@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-baseline">
                    <span class="mr-auto">{{ ucfirst(__('plan.plan')) }}</span>

                    @component('components.close-button', [
                        'back' => true
                    ])
                    @endcomponent
                </div>
                    
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h5 class="pb-1">Mój pakiet</h5>
                            
                            @if(auth()->user()->plan()->exists())
                                @component('components.plan', [
                                    'plan' => auth()->user()->plan()->exists()
                                ])
                                @endcomponent
                            @else
                                <h6 class="text-secondary">Brak pakietu</h6>
                            @endif
                        </div>
    
                        <div class="col-md-6">
                            <h5 class="pb-1">Dostępne pakiety</h5>

                            @foreach(\App\Plan::all() as $plan)
                                @component('components.plan', [
                                    'plan' => $plan
                                ])                                    
                                @endcomponent
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection