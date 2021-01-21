@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/mathquill4quill.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-baseline">
                        <span class="mr-auto">{{ __('actions.edit').' '.__('create.assignment') }}</span>

                        @component('components/close-button', [
                            'url' => route('assignments.show', $assignment)
                        ])
                        @endcomponent
                    </div>

                    <div class="card-body">
                        @component('components/assignment', [
                            'assignment' => $assignment,
                            'multilang' => policy(\App\Answer::class)->create(Auth::user())
                        ])
                        @endcomponent

                        <hr>

                        <form method="POST" action="{{ route('assignments.update', $assignment) }}" enctype="multipart/form-data" id="update-form">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="subject">{{ __('content.subject') }}</label>
                                <select name="subject" id="subject" class="form-control">
                                    @foreach(\App\Subject::all() as $subject)
                                        <option
                                            value="{{ $subject->id }}"
                                            @if($assignment->subject == $subject)
                                                selected
                                            @endif
                                        >
                                            {{ __('subject.'.$subject->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="grade">{{ __('content.grade') }}</label>
                                <select name="grade" id="grade" class="form-control">
                                    @foreach(\App\Grade::all() as $grade)
                                        <option
                                            value="{{ $grade->id }}"
                                            @if($assignment->subject == $subject)
                                                selected
                                            @endif
                                        >
                                            {{ __('grade.'.$grade->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @component('components/editor', [
                                'model' => 'assignment',
                                'entry' => $assignment,
                                'multilang' => policy(\App\Answer::class)->create(Auth::user()),
                            ])
                            @endcomponent
                        </form>

{{--                        @component('components/images', [--}}
{{--                            'images' => unserialize($assignment->attachments)--}}
{{--                        ])--}}
{{--                        @endcomponent--}}

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/mathquill4quill.min.js') }}" defer></script>
@endsection
