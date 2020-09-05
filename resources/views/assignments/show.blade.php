@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    <span class="mr-auto">{{ __('content.assignment') }}</span>

                    @can('delete', $assignment)
                        <a href="{{ route('assignments.delete', $assignment) }}" class="mr-2">{{ __('actions.delete') }}</a>
                    @endcan

                    @can('update', $assignment)
                        <a href="{{ route('assignments.edit', $assignment) }}">{{ __('actions.edit') }}</a>
                    @endcan
                </div>

                <div class="card-body">
                    @component('components/assignment', [
                        'assignment' => $assignment
                    ])
                    @endcomponent

                    <hr>

                    <div class="d-flex align-items-baseline">
                        <h6>{{ __('content.answers') }}</h6>

                        @if(policy(\App\Answer::class)->create(Auth::user()))
                            <a href="{{ route('answers.create', $assignment) }}" class="ml-auto mr-0">{{ __('create.send').' '.__('create.answer') }}</a>
                        @endif
                    </div>

                    @if($assignment->answers()->get()->first())
                        @foreach($assignment->answers()->get() as $answer)
                            @component('components/answer', [
                                'answer' => $answer
                            ])
                            @endcomponent

                            <hr>
                        @endforeach
                    @else
                        <p class="text-center text-secondary">{{ __('content.no_answers') }}</p>
                    @endif
                </div>
            <div>
        </div>
    </div>
</div>
@endsection
