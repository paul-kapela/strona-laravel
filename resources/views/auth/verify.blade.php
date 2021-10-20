@extends('layouts.app')

@section('content')
<div class="col-span-12">
  <h1 class="mb-5 text-2xl font-semibold">{{ __('email/verify_email.title') }}</h1>

  @if (session('resent'))
      <div class="alert alert-success" role="alert">
          {{ __('email/verify_email.sent') }}
      </div>
  @endif

  {{ __('email/verify_email.check') }}
  {{ __('email/verify_email.not_received') }}

  <form class="inline" method="POST" action="{{ route('verification.resend') }}">
      @csrf
      <button type="submit" class="hover:underline">{{ __('email/verify_email.click_here') }}</button>{{ __('email/verify_email.request_another') }}.
  </form>
</div>
@endsection
