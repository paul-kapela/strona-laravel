@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        @component('components.subject-select')
        @endcomponent

        <div class="col-md-8">
            @component('components.search-bar')
            @endcomponent

            @component('components.grade-select')
            @endcomponent

            @if($assignments->first())
                @foreach($assignments as $assignment)
                    <div class="card mb-3">
                        <div class="card-body">
                            @component('components/assignment', [
                                'assignment' => $assignment
                            ])
                            @endcomponent

                            <div class="d-flex flex-column-reverse">
                                <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-primary align-self-end mt-3">{{ __('content.more') }}...</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mt-5 text-white text-center justify-content-center">
                    <h3>{{ __('search.empty_result') }}</h3>
                    <p>{{ __('search.try_again') }}</p>
  					<a href="{{ route('assignments.create') }}">Prześlij zadanie</a>
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
