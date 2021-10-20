@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/mathquill4quill.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-span-12">
  <div class="flex mb-5">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('create.send').' '.__('request.request') }}</h1>

    @component('components.close-button', [
      'back' => true
    ])  
    @endcomponent
  </div>

  <div class="card-body">
    @component('components.assignment', [
      'assignment' => $assignment
    ])  
    @endcomponent

    <hr>

    <form method="POST" action="{{ route('requests.store', $assignment) }}" enctype="multipart/form-data" id="create-form">
      @csrf

      <div class="form-group row">
        <label for="dueDate" class="col-md-4 col-form-label">{{ __('request.due_date') }}: </label>

        <div class="col-md-6">
          <input
            id="dueDate"
            type="date"
            min="{{ (new DateTime('tomorrow'))->format('Y-m-d') }}"
            class="form-control{{ $errors->has('due_date') ? ' is-invalid' : '' }}"
            name="due_date"
            value="{{ old('due_date') }}"
          >  
        </div>
      </div>

      <div class="form-group row mb-0">
        <div class="col-md-6">
          <button class="btn btn-primary" type="submit">
            {{ __('create.send') }}
          </button>
        </div>
      </div>
    </form>

    @if($errors->any())
      <div class="alert alert-danger mt-3">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>
@endsection