<div>
  <span class="text-secondary">
    <h6>{{ __('content.user') }}: {{ $request->user->username }}</h6>
    <h6>{{ __('content.date') }}: {{ $request->created_at }}</h6>
  </span>

  <hr>

  @component('components.assignment', [
    'assignment' => $request->assignment
  ])  
  @endcomponent

  <hr>

  {{ __('request.due_date') }}: {{ $request->due_date }}
</div>