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

      <div class="card">
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
    </div>

    <div class="col-md-2">

    </div>
  </div>
</div>
@endsection
