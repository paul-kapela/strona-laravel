@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="text-white mb-4">Użytkownicy</h1>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="table table-hover rounded bg-white">
        <thead>
          <tr>
            <th>Nazwa użytkownika</th>
            <th>Role</th>
            <th>E-mail</th>
          </tr>
        </thead>
        
        @foreach ($users as $user)
          @component('components/user', [
            'user' => $user
          ])
          @endcomponent
        @endforeach
      </table>
    </div>

    <div class="col-md-4 card card-body">

    </div>
  </div>
</div>
@endsection