@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('email/verify_email.title') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('email/verify_email.sent') }}
                        </div>
                    @endif

                    {{ __('email/verify_email.check') }}
                    {{ __('email/verify_email.not_received') }}

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('email/verify_email.click_here') }}</button>{{ __('email/verify_email.request_another') }}.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
