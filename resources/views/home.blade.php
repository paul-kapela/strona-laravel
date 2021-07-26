@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-2">
      @component('components.subject-select')
      @endcomponent
    </div>

    <div class="col-md-8">
      @component('components.search-bar', [
        'route_name' => 'assignments.index'
      ])
      @endcomponent

      <div class="card mb-3">
        <div class="card-header">{{ __('Pulpit') }}</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          {{ __('auth.logged_in') }}

          <br/>

          <a href="{{ route('assignments.create') }}">{{ __('create.send').' '.__('create.assignment')}}</a>
        </div>
      </div>

      <div class="d-flex align-items-baseline text-white">
        <h6 class="font-weight-bold">{{ __('content.recent').' '.lcfirst(__('content.unsolved')).' '.lcfirst(__('content.assignments')) }}</h6>

        <a data-toggle="collapse" href="#recentAssignments" class="ml-auto text-white text-decoration-none" aria-expanded="true">
          <span class="icon-sort"></span>
        </a>
      </div>

      <hr>

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
    </div>

    <div class="col-md-2">

    </div>
  </div>
</div>
@endsection
