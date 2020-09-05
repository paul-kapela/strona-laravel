@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profil</div>

                <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                        <img src="{{ $user->profileImage() }}" class="rounded-circle mr-3" style="width: 5em;">

                        <div class="d-flex flex-row align-items-center">
                            <h3 class="mr-3">{{ $user->username }}</h3>

                            @can('update', $user)
                                <a href="/user/{{ $user->id }}/edit">Edytuj profil</a>
                            @endcan
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex flex-row align-items-center col-md-4 text-center justify-content-center">
                        <div>
                            <h5>{{ $user->created_at }}</h5>
                            <h6>Dołączenie do serwisu</h6>
                        </div>
                    </div>

                    <!--<div class="d-flex flex-row align-items-center">
                        @can('view', $user)

                        @endcan
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
