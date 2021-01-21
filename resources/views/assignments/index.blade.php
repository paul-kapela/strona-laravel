@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    @component('components.subject-select')
    @endcomponent

    <div class="col-md-8">
      @component('components.search-bar', [
        'route_name' => 'assignments.index'
      ])
      @endcomponent

      @component('components.grade-select')
      @endcomponent

      {{-- TODO: show if localization available --}}

      @if($assignments->first())
        @foreach($assignments as $assignment)
          @if(!empty($assignment->content()) || $user->belongsToRoles('admin', 'editor'))
            <div class="card mb-3">
              <div class="card-body">
                @component('components.assignment', [
                  'assignment' => $assignment,
                  'multilang' => policy(\App\Answer::class)->create(Auth::user()),
                  'thumb' => true
                ])
                @endcomponent

                <div class="d-flex flex-column-reverse">
                  <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-primary align-self-end mt-3">{{ __('content.more') }}...</a>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      @else
        <div class="mt-5 text-white text-center justify-content-center">
          <h3>{{ __('search.empty_result') }}</h3>
          <p>{{ __('search.try_again') }}</p>
          <a href="{{ route('assignments.create') }}">
            <u class="text-white font-weight-bold">{{ __('create.send').' '.__('create.assignment') }}</u>
          </a>
        </div>
      @endif
    </div>

    <div class="col-md-2">

    </div>
  </div>

  <div class="row justify-content-center">
      {{ $assignments->appends(request()->all())->links() }}
  </div>
</div>
@endsection
