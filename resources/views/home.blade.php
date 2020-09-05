@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @component('components.subject-select')
        @endcomponent

        <div class="col-md-8">
            @component('components.search-bar')
            @endcomponent

            <div class="card">
                <div class="card-header">{{ __('Pulpit') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Jesteś zalogowany/a!') }}

                    <br/>

                    <a href="{{ route('assignments.create') }}">Prześlij zadanie</a>
                </div>
            </div>
        </div>

        <div class="col-md-2">

        </div>
    </div>
</div>
@endsection
