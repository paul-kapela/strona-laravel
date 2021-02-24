<div>
  <span class="text-secondary">
    <h6>{{ __('content.user') }}: {{ $request->user->username }}</h6>
    <h6>{{ __('content.date') }}: {{ $request->created_at }}</h6>
  </span>

  <hr>

  @if($display_assignment ?? true)
    @component('components.assignment', [
      'assignment' => $request->assignment
    ])  
    @endcomponent

    <hr>
  @endif

  <p class="mb-0">{{ __('request.due_date') }}: {{ $request->due_date }}</p>
  <p class="mb-0">{{ __('content.status') }}: {{ __('request.'.$request->status()) }}</p>

  @if(($request->status() == 'ready' || $request->status() == 'paid') && policy(\App\Answer::class)->view(Auth::user(), $request->requestResponse->answer))
    <hr>

    @component('components.answer', [
      'answer' => $request->requestResponse->answer,
      'multilang' => Auth::user()->belongsToRoles('editor', 'admin')
    ])  
    @endcomponent
    
    <hr>
  @endif

  @if($request->status() != 'pending')
    <p>{{ __('content.price') }}: {{ $request->requestResponse->price }} zł</p>
  @endif
</div>