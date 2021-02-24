<div class="text-white">
  @if(Request::url() != route('home'))
    @component('components/clear-criteria-button')
    @endcomponent
  @endif

  <h6 class="font-weight-bold">{{ __('subject.subjects') }}</h6>

  <hr>

  <div class="d-flex flex-column mb-sm-3 mb-md-0">
    <a href="{{ route('assignments.index', array_filter(array_merge(request()->all(), [ 'subject' => '' ]))) }}" class="btn {{ !request('subject') && Request::url() != route('home') ? 'btn-light' : 'btn-outline-light' }} mb-2">{{ __('subject.all') }}</a>

    @foreach(\App\Subject::all() as $subject)
      <a href="{{ route('assignments.index', array_merge([ 'subject' => $subject->name ], request()->all())) }}" class="btn {{ request('subject') == $subject->name ? 'btn-light' : 'btn-outline-light' }} mb-2">{{ __('subject.'.$subject->name) }}</a>
    @endforeach
  </div>
</div>
