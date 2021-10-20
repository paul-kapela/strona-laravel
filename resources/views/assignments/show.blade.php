@extends('layouts.app')

@section('content')
<div class="col-span-12">
  {{-- <div class="absolute z-1 mx-auto">
    Hello
  </div> --}}

  <div class="flex mb-5 items-center">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('content.assignment') }}</h1>

    @can('delete', $assignment)
      <a href="{{ route('assignments.delete', $assignment) }}" class="mr-2 text-xl font-light">{{ __('actions.delete') }}</a>
    @endcan

    @can('update', $assignment)
      <a href="{{ route('assignments.edit', $assignment) }}" class="text-xl font-light">{{ __('actions.edit') }}</a>
    @endcan

    <div class="ml-2">
      @component('components.close-button', [
        'url' => route('assignments.index')
      ])
      @endcomponent
    </div>
  </div>

  @component('components.assignment', [
    'assignment' => $assignment,
    'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
  ])
  @endcomponent

  <div class="flex mb-5 items-center">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('content.answers') }}</h1>

    @if(policy(\App\Answer::class)->create(Auth::user()))
      <a href="{{ route('answers.create', $assignment) }}" class="mr-2 text-xl font-light">{{ __('create.send').' '.__('create.answer') }}</a>
    @endif

    @if(policy(\App\Request::class)->create(Auth::user(), $assignment))
      <a href="{{ route('requests.create', ['assignment' => $assignment->id]) }}" class="mr-2 text-xl font-light">{{ __('request.add').' '.__('request.request') }}</a>
    @endif

    @if(policy(\App\Request::class)->viewAny(Auth::user()))
      <a href="{{ route('requests.index', ['assignment' => $assignment->id]) }}" class="text-xl font-light">{{ __('request.show_all').' '.lcfirst(__('request.title')) }}</a>
    @endif
  </div>

  @if($assignment->answers()->exists())
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
    <h1 class="text-center text-2xl font-light">{{ __('content.no_answers') }}</h1>
  @endif
</div>
@endsection
