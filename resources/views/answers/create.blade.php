@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/mathquill4quill.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-span-12">
  <div class="mb-5 flex">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('create.send').' '.__('create.an').__('create.answer') }}</h1>

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

  @component('components/assignment', [
    'assignment' => $assignment,
    'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
  ])
  @endcomponent

  <form method="POST" action="{{ route('answers.store', [ 'assignment' => $assignment->id, '' ] + (request('request_response') ? [ 'request_response' => request('request_response') ] : [])) }}" enctype="multipart/form-data" id="create-form">
    @csrf

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
