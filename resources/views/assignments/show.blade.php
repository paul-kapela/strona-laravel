@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex align-items-baseline">
          <h5 class="mr-auto">{{ __('content.assignment') }}</h5>

          @can('delete', $assignment)
            <a href="{{ route('assignments.delete', $assignment) }}" class="mr-2">{{ __('actions.delete') }}</a>
          @endcan

          @can('update', $assignment)
            <a href="{{ route('assignments.edit', $assignment) }}">{{ __('actions.edit') }}</a>
          @endcan

          <div class="ml-2">
            @component('components.close-button', [
              'url' => route('assignments.index')
            ])
            @endcomponent
          </div>
        </div>

        <div class="card-body">
          @component('components.assignment', [
            'assignment' => $assignment,
            'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
          ])
          @endcomponent
        </div>
      </div>

      <hr>

      <div class="d-flex align-items-baseline text-white">
        <h5>{{ __('content.answers') }}</h5>

        <div class="ml-auto mr-0">
          @if(policy(\App\Answer::class)->create(Auth::user()))
            <a href="{{ route('answers.create', $assignment) }}" class="mr-2 text-white">{{ __('create.send').' '.__('create.answer') }}</a>
          @endif
  
          @if(policy(\App\Request::class)->create(Auth::user(), $assignment))
            <a href="{{ route('requests.create', ['assignment' => $assignment->id]) }}" class="mr-2 text-white">{{ __('request.add').' '.__('request.request') }}</a>
          @endif

          @if(policy(\App\Request::class)->viewAny(Auth::user()))
            <a href="{{ route('requests.index', ['assignment' => $assignment->id]) }}" class="text-white">{{ __('request.show_all').' '.lcfirst(__('request.title')) }}</a>
          @endif
        </div>
      </div>

      <hr>

      @if($assignment->answers()->get()->first())
        @foreach($assignment->answers()->get() as $answer)
          <div class="card mt-3">
            <div class="card-body">
              @component('components.answer', [
                'answer' => $answer,
                'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
              ])
              @endcomponent
            </div>
          </div>
        @endforeach
      @else
        <div class="text-center text-secondary">
          <p>{{ __('content.no_answers') }}</p>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
