@extends('layouts.app')

@section('content')
<div class="lg:col-span-2 lg:mb-0 mb-5">
  @component('components.subject-select', [
    'route_base' => 'assignments'
  ])
  @endcomponent

  <div class="mt-5">
    @component('components.grade-select', [
      'route_base' => 'assignments'
    ])
    @endcomponent
  </div>
</div>

<div class="lg:col-span-8 lg:mx-10">
  {{-- TODO: show if localization available --}}

  @if($assignments->first())
    @foreach($assignments as $assignment)
      @if(!empty($assignment->content()) || Auth::user()->belongsToRoles('admin', 'editor'))
        @component('components.assignment', [
          'assignment' => $assignment,
          'multilang' => Auth::user()->belongsToRoles('editor', 'admin'),
          'thumb' => true
        ])
        @endcomponent
      @endif
    @endforeach
  @else
    <div class="mt-36 text-center">
      <h3 class="text-2xl font-semibold">{{ __('search.empty_result') }}</h3>
      <p>{{ __('search.try_again') }}</p>
    </div>
  @endif

  {{ $assignments->appends(request()->all())->links() }}
</div>
@endsection
