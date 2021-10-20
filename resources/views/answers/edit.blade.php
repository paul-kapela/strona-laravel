@extends('layouts.app')

@section('content')
<div class="col-span-12">
  <div class="mb-5 flex">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('actions.edit').' '.__('create.answer') }}</h1>

    @component('components/close-button', [
      'url' => route('assignments.show', $answer->assignment()->get()->first())
    ])
    @endcomponent
  </div>

  @if ($errors->any())
    <div class="col-span-12 p-5 bg-red-400 rounded-xl">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @component('components/answer', [
    'answer' => $answer,
    'multilang' => Auth::user()->belongsToRoles('editor', 'admin'),
    'withoutActions' => true
  ])
  @endcomponent


  <form method="POST" action="{{ route('answers.update', $answer) }}" enctype="multipart/form-data" id="update-form">
    @csrf
    @method('PATCH')

    @component('components/editor', [
      'model' => 'answer',
      'entry' => $answer,
      'multilang' => Auth::user()->belongsToRoles('editor', 'admin'),
    ])
    @endcomponent
  </form>
</div>
@endsection