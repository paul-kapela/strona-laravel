@extends('layouts.app')

@section('styles')
  <link href="{{ asset('css/mathquill4quill.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex align-items-baseline">
          <span class="mr-auto">{{ __('create.send').' '.__('create.an').__('create.answer') }}</span>
      
          @component('components.close-button', [
            'back' => true
          ])
          @endcomponent
        </div>

        <div class="card-body">
          @component('components/assignment', [
            'assignment' => $assignment,
            'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
          ])
          @endcomponent

          <hr>

          <form method="POST" action="{{ route('answers.store', [ 'assignment' => $assignment->id, '' ] + (request('request_response') ? [ 'request_response' => request('request_response') ] : [])) }}" enctype="multipart/form-data" id="create-form">
            @csrf

            @component('components/editor', [
              'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
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
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('js/mathquill4quill.min.js') }}" defer></script>
@endsection
