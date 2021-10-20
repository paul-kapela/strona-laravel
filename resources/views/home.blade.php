@extends('layouts.app')

@section('content')
{{-- <div class="col-md-8">
  <div class="d-flex align-items-baseline">
    <h6 class="font-weight-bold">{{ __('content.recent').' '.lcfirst(__('content.unsolved')).' '.lcfirst(__('content.assignments')) }}</h6>

    <a data-toggle="collapse" href="#recentAssignments" class="ml-auto text-decoration-none" aria-expanded="true">
      <span class="icon-sort"></span>
    </a>
  </div>

  <div id="recentAssignments" class="collapse show">
    @foreach(\App\Assignment::recentUnsolved() as $assignment)
      <div class="card">          
        <div class="card-body">
          @component('components.assignment', [
            'assignment' => $assignment,
            'multilang' => Auth::user()->belongsToRoles('editor', 'admin'),
            'thumb' => true
          ])
          @endcomponent            
        </div>
      </div>
    @endforeach
  </div>
</div> --}}

<div class="lg:col-span-2">
  @component('components.subject-select')
  @endcomponent
</div>          

<div class="lg:col-span-8 lg:mx-10">
  @if (session('status'))
    <div class="p-5 mb-5 text-gray-800 bg-green-300 rounded-xl" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="p-5 rounded-border">
    <h1 class="lg:text-4xl text-2xl font-semibold">Witamy na pokładzie!</h1>
  
    <h2 class="mt-3 lg:text-2xl text-xl">Co chcesz dzisiaj zrobić?</h2>
  
    <div class="mt-6 lg:grid lg:grid-cols-3 text-center text-gray-700 dark:text-gray-300">
      <a href="{{ route('assignments.create') }}" class="p-2 uppercase text-xl font-semibold hover:underline">{{ __('create.send').__('create.an').__('create.assignment') }}</a>
      <a href="#" class="p-2 uppercase text-xl font-semibold hover:underline">Odpowiedz na zadanie</a>
      <a href="#" class="p-2 uppercase text-xl font-semibold hover:underline">Zobacz swoje zadania</a>
    </div>
    
    <div class="mt-3 lg:grid lg:grid-cols-3 text-center text-gray-700 dark:text-gray-300">
      <a href="#" class="py-2 uppercase text-xl font-semibold hover:underline">Sprawdź swoje zapytania</a>
    </div>
  </div>
</div>

<div class="lg:col-span-2 lg:block hidden rounded-border">
  {{-- <h3 class="font-semibold">mysio17</h3> --}}
</div>
@endsection
