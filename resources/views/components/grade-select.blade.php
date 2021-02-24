<div class="text-white">
    <h6 class="font-weight-bold">{{ __('grade.grades') }}</h6>

    <hr>

    <div class="d-flex flex-column flex-md-row justify-content-md-between mb-sm-3 mb-md-0">
        <a href="{{ route('assignments.index', array_filter(array_merge(request()->all(), [ 'grade' => '' ]))) }}" class="btn {{ !request('grade') ? 'btn-light' : 'btn-outline-light' }} mb-2 col-md-3">{{ __('subject.all') }}</a>

        @foreach(\App\Grade::all() as $grade)
            <a href="{{ route('assignments.index', array_merge([ 'grade' => $grade->name ], request()->all())) }}" class="btn {{ request('grade') == $grade->name ? 'btn-light' : 'btn-outline-light' }} mb-2 col-md-3">{{ __('grade.'.$grade->name) }}</a>
        @endforeach
    </div>
</div>
