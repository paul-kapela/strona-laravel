@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/mathquill4quill.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-span-12">
  <div class="flex mb-5">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('create.send').' '.__('create.an').__('create.assignment') }}</h1>
  
    @component('components.close-button', [
      'back' => true
    ])
    @endcomponent
  </div>

  @if ($errors->any())
    <div class="col-span-12 p-5 bg-red-400 rounded-xl">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('assignments.store') }}" enctype="multipart/form-data" id="create-form">
    @csrf
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-5">
      <div class="mt-5 mb-2">
        <h3 class="text-xl font-semibold">{{ __('content.subject') }}</h3>
    
        <hr class="my-3 dark:opacity-10 border-t-2">

        <option-picker name="subject" :options="{{ json_encode(\App\Subject::all()) }}" :labels="{{ json_encode(Lang::get('subject')) }}"/>
      </div>
  
      <div class="mt-5 mb-2">
        <h3 class="text-xl font-semibold">{{ __('content.grade') }}</h3>
    
        <hr class="my-3 dark:opacity-10 border-t-2">
        
        <option-picker name="grade" :options="{{ json_encode(\App\Grade::all()) }}" :labels="{{ json_encode(Lang::get('grade')) }}"/>
      </div>
    </div>

    @component('components/editor', [
      'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
    ])
    @endcomponent
  </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/mathquill4quill.min.js') }}" defer></script>
@endsection
