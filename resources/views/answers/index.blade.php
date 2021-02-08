@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @component('components.subject-select')
        @endcomponent

        <div class="col-md-8">
            @component('components.search-bar', [
                'route_name' => 'answers.index'
            ])
            @endcomponent

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
    </div>
</div>
@endsection