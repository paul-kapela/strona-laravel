@extends('layouts.app')

@section('content')
<div class="col-span-12">
  <div class="flex mb-5 items-center">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('actions.delete').' '.__('create.assignment') }}</h1>

    @component('components/close-button', [
      'url' => route('assignments.show', $assignment)
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

    <form method="POST" action="{{ route('assignments.destroy', $assignment) }}">
      @csrf
      @method('DELETE')

      <label for="delete-confirm">{{ __('actions.delete_confirmation').__('create.assignment').'?' }}</label>

      <div class="form-group row mb-0">
        <div class="col-md-6">
          <button id="delete-confirm" type="submit" class="btn btn-danger">
            {{ __('actions.delete') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
