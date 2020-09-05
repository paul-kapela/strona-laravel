@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/mathquill4quill.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('actions.edit').' '.__('create.assignment') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('assignments.store') }}" enctype="multipart/form-data" id="create-form">
                            @csrf

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
                                'assignment_id' => $assignment->id,
                                'content' => $assignment->content,
                                'attachments' => json_encode(unserialize($assignment->attachments)),
                                'image_upload_token' => $assignment->image_upload_token,
                            ])
                            @endcomponent
                        </form>

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
