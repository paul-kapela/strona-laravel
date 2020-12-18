@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('profile.profile') }}</div>

                <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                        <img src="{{ $user->profileImage() }}" class="rounded-circle mr-3" style="width: 5em;">

                        <div class="d-flex flex-row align-items-center">
                            <h3 class="mr-3">{{ $user->username }}</h3>

                            @can('update', $user)
                                <a href="{{ route('users.edit', $user) }}">{{ __('profile.edit') }}</a>
                            @endcan
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex flex-row align-items-center text-center justify-content-center">
                        <div class="col-md-4">
                            <h5>{{ $user->created_at ?? 'N/A' }}</h5>
                            <h6>{{ __('profile.joined') }}</h6>
                        </div>

                        <div class="col-md-4">
                            <h5>{{ $user->assignments()->count() }}</h5>
                            <h6>{{ __('profile.added').' '.__('profile.assignments') }}</h6>
                        </div>

                        <div class="col-md-4">
                            @if(policy(\App\Answer::class)->create($user))
                                <h5>{{ $user->answers()->count() }}</h5>
                                <h6>{{ __('profile.added').' '.__('profile.answers') }}</h6>
                            @endif
                        </div>
                    </div>

                    <!--
                        Informacje o mnie
                        <div class="d-flex flex-row align-items-center">
                        @can('view', $user)
                            email?
                        @endcan
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
