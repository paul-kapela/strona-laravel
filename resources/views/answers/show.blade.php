@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-baseline">
                    <h5 class="mr-auto">{{ __('content.answer') }}</h5>

                    @can('delete', $answer)
                        <a href="{{ route('answers.delete', $answer) }}" class="mr-2">{{ __('actions.delete') }}</a>
                    @endcan

                    @can('update', $answer)
                        <a href="{{ route('answers.edit', $answer) }}">{{ __('actions.edit') }}</a>
                    @endcan

                    <div class="ml-2">
                        @component('components.close-button', [
                            'url' => route('answers.index')
                        ])
                        @endcomponent
                    </div>
                </div>

                <div class="card-body">
                    @component('components.answer', [
                        'answer' => $answer,
                        'multilang' => policy(\App\Answer::class)->create(Auth::user()),
                        'withoutActions' => true
                    ])
                    @endcomponent
                </div>
            </div>

            <hr>

            <div class="d-flex align-items-baseline text-white">
                <h5>{{ __('content.assignment') }}</h5>
            </div>

            <hr>

            <div class="card mt-3">
                <div class="card-body">
                    @component('components.assignment', [
                        'assignment' => $answer->assignment()->get()->first(),
                        'multilang' => policy(\App\Answer::class)->create(Auth::user())
                    ])
                    @endcomponent

                    <div class="d-flex flex-column-reverse">
                        <a href="{{ route('assignments.show', $answer->assignment()->get()->first()) }}" class="btn btn-primary align-self-end mt-3">{{ __('content.more') }}...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection