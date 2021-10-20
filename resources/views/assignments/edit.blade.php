@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/mathquill4quill.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-span-12">
  <div class="flex mb-5">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('actions.edit').' '.__('create.assignment') }}</h1>

    @component('components/close-button', [
      'url' => route('assignments.show', $assignment)
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

  @component('components/assignment', [
    'assignment' => $assignment,
    'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
  ])
  @endcomponent

  <form method="POST" action="{{ route('assignments.update', $assignment) }}" enctype="multipart/form-data" id="update-form">
    @csrf
    @method('PATCH')

    <div class="lg:grid lg:grid-cols-2 lg:gap-x-5">
      <div class="mt-5 mb-2">
        <h3 class="text-xl font-semibold">{{ __('content.subject') }}</h3>
    
        <hr class="my-3 dark:opacity-10 border-t-2">
    
        <div class="picker">
          @foreach (\App\Subject::all() as $subject)
            <input type="radio" name="subject" id="{{ $subject->name }}" value="{{ $subject->id }}" class="hidden" {{ $assignment->subject_id == $subject->id ? "checked" : "" }}>
            <label for="{{ $subject->name }}" class="mr-1 text-xl cursor-pointer">{{ __('subject.'.$subject->name) }}</label>
          @endforeach
        </div>

        <option-picker name="subject" initial="{{ $assignment->subject_id }}" :options="{{ json_encode(\App\Subject::all()) }}" :labels="{{ json_encode(Lang::get('subject')) }}"/>
      </div>
  
      <div class="mt-5 mb-2">
        <h3 class="text-xl font-semibold">{{ __('content.grade') }}</h3>
    
        <hr class="my-3 dark:opacity-10 border-t-2">
        
        <option-picker name="grade" initial="{{ $assignment->grade_id }}" :options="{{ json_encode(\App\Grade::all()) }}" :labels="{{ json_encode(Lang::get('grade')) }}"/>
      </div>
    </div>

    @component('components/editor', [
      'model' => 'assignment',
      'entry' => $assignment,
      'multilang' => Auth::user()->belongsToRoles('editor', 'admin'),
    ])
    @endcomponent
  </form>

  @if ($errors->any())
    <div class="alert alert-danger mt-3">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/mathquill4quill.min.js') }}" defer></script>
@endsection
