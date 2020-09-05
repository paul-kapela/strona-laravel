<div class="col-md-2 text-white">
    @if(Request::url() == route('assignments.index'))
        @component('components.clear-criteria-button')
        @endcomponent
    @endif

    <h6 class="font-weight-bold">{{ __('subject.subjects') }}</h6>

    <hr>

    <div class="d-flex flex-column mb-sm-3 mb-md-0">
        <a href="{{ route('assignments.index', [ 'grade' => request('grade'), 'query' => request('query') ]) }}" class="btn {{ !request('subject') && Request::url() == route('assignments.index') ? 'btn-light' : 'btn-outline-light' }} mb-2">{{ __('subject.all') }}</a>

        @foreach(\App\Subject::all() as $subject)
            <a href="{{ route('assignments.index', [ 'subject' => $subject->name, 'grade' => request('grade'), 'query' => request('query') ]) }}" class="btn {{ request('subject') == $subject->name ? 'btn-light' : 'btn-outline-light' }} mb-2">{{ __('subject.'.$subject->name) }}</a>
        @endforeach
    </div>
</div>
