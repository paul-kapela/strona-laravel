@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-baseline">
                        <span class="mr-auto">{{ __('actions.delete').' '.__('create.answer') }}</span>

                        @component('components.close-button', [
                            'url' => route('assignments.show', $answer->assignment()->get()->first())
                        ])
                        @endcomponent
                    </div>

                    <div class="card-body">
                        @component('components.answer', [
                            'answer' => $answer,
                            'multilang' => policy(\App\Answer::class)->create(Auth::user()),
                            'withoutActions' => true
                        ])
                        @endcomponent

                        <hr>

                        <form method="POST" action="{{ route('answers.destroy', $answer) }}">
                            @csrf
                            @method('DELETE')

                            <label for="delete-confirm">{{ __('actions.delete_confirmation').__('create.assignment').'?' }}</label>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <button id="delete-confirm" type="submit" class="btn btn-primary">
                                        {{ __('actions.delete') }}
                                    </button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection