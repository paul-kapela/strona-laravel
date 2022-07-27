@extends('layouts.app')

@section('content')
<div class="lg:col-span-2 lg:mb-0 mb-5">
  @component('components.subject-select', [
    'route_base' => 'answers'
  ])
  @endcomponent

  <div class="mt-5">
    @component('components.grade-select', [
      'route_base' => 'answers'
    ])
    @endcomponent
  </div>

  <div class="mt-5">
    @component('components.status-select', [
      'route_base' => 'answers'
    ])
    @endcomponent
  </div>
</div>

<div class="lg:col-span-8 lg:mx-10">
  @if($answers->first())
    @foreach ($answers as $answer)
      @component('components.answer', [
        'answer' => $answer,
        'multilang' => Auth::user()->belongsToRoles('editor', 'admin'),
        'withoutActions' => true,
        'thumb' => true
      ])
      @endcomponent
    @endforeach
  @else
    <div class="mt-36 text-center">
      <h3 class="text-2xl font-semibold">{{ __('search.empty_result') }}</h3>
      <p>{{ __('search.try_again') }}</p>
    </div>
  @endif

  {{ $answers->appends(request()->all())->links() }}
</div>
@endsection