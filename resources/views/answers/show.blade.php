@extends('layouts.app')

@section('content')
<div class="col-span-12">
  <div class="flex mb-5 items-center">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('content.answer') }}</h1>

    @can('delete', $answer)
      <a href="{{ route('answers.delete', $answer) }}" class="mr-2 text-xl font-light">{{ __('actions.delete') }}</a>
    @endcan

    @can('update', $answer)
      <a href="{{ route('answers.edit', $answer) }}" class="text-xl font-light">{{ __('actions.edit') }}</a>
    @endcan

    <div class="ml-2">
      @component('components.close-button', [
        'url' => route('answers.index')
      ])
      @endcomponent
    </div>
  </div>

  @component('components.answer', [
    'answer' => $answer,
    'multilang' => Auth::user()->belongsToRoles('editor', 'admin'),
    'withoutActions' => true
  ])
  @endcomponent

  <div class="d-flex align-items-baseline text-white">
    <h5>{{ __('content.assignment') }}</h5>
  </div>

  <hr>

  <div class="card mt-3">
    <div class="card-body">
      @component('components.assignment', [
        'assignment' => $answer->assignment()->get()->first(),
        'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
      ])
      @endcomponent

      <div class="d-flex flex-column-reverse">
        <a href="{{ route('assignments.show', $answer->assignment()->get()->first()) }}" class="btn btn-primary align-self-end mt-3">{{ __('content.more') }}...</a>
      </div>
    </div>
  </div>
</div>
@endsection