@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-2">
      @component('components.subject-select')
      @endcomponent

      <div class="text-white mt-2">
        <h6 class="font-weight-bold">{{ __('content.status') }}</h6>

        <hr>

        <div class="d-flex flex-column mb-sm-3 mb-md-0">
          <a href="{{ route('answers.index', array_filter(array_merge(request()->all(), [ 'unapproved' => '' ]))) }}" class="btn {{ !request('unapproved') ? 'btn-light' : 'btn-outline-light' }} mb-2">{{ __('content.all') }}</a>

          <a href="{{ route('answers.index', array_merge([ 'unapproved' => 1 ], request()->all())) }}" class="btn {{ request('unapproved') ? 'btn-light' : 'btn-outline-light' }} mb-2">{{ __('content.unapproved') }}</a>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      @component('components.grade-select')
      @endcomponent

      @if($answers->first())
        @foreach ($answers as $answer)
          <div class="card mb-3">
            <div class="card-body">
              @component('components.answer', [
                'answer' => $answer,
                'multilang' => Auth::user()->belongsToRoles('editor', 'admin'),
                'withoutActions' => true
              ])
              @endcomponent

              <div class="d-flex flex-column-reverse">
                <a href="{{ route('answers.show', $answer) }}" class="btn btn-primary align-self-end mt-3">{{ __('content.more') }}...</a>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="mt-5 text-white text-center justify-content-center">
          <h3>{{ __('search.empty_result') }}</h3>
          <p>{{ __('search.try_again') }}</p>
        </div
      @endif
    </div>

    <div class="col-md-2">

    </div>
  </div>
</div>
@endsection