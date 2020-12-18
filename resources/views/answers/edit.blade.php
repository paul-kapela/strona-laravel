@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-baseline">
                        <span class="mr-auto">{{ __('actions.edit').' '.__('create.answer') }}</span>
    
                        @component('components/close-button', [
                                'url' => route('assignments.show', $answer->assignment()->get()->first())
                        ])
                        @endcomponent
                    </div>

                    <div class="card-body">
                        @component('components/answer', [
                            'answer' => $answer,
                            'multilang' => policy(\App\Answer::class)->create(Auth::user()),
                            'withoutActions' => true
                        ])
                        @endcomponent

                        <hr>

                        <form method="POST" action="{{ route('answers.update', $answer) }}" enctype="multipart/form-data" id="update-form">
                            @csrf
                            @method('PATCH')

                            @component('components/editor', [
                                'model' => 'answer',
                                'entry' => $answer,
                                'multilang' => policy(\App\Answer::class)->create(Auth::user()),
                            ])
                            @endcomponent
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection