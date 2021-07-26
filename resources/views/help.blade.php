@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card card-body">
        <ul class="nav nav-pills">
          <li class="active">
            <a href="#introduction" data-toggle="tab">Wstęp</a>
          </li>

          <li>
            <a href="#assignments" data-toggle="tab">Zadania</a>
          </li>
        </ul>

        <div class="tab-content clearfix">
          <div id="introduction" class="tab-pane active">
            Wprowadzenie
          </div>

          <div id="assignments" class="tab-pane">
            Zadania
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection