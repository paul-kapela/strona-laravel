<div class="mb-5 p-5 border-2 dark:border-opacity-10 rounded-xl">
  <h6 class="mb-5 text-sm font-semibold">
    {{ $request->user->username }} &bull;
    {{ $request->created_at }}
  </h6>

  @if($display_assignment ?? true)
    @component('components.assignment', [
      'assignment' => $request->assignment
    ])  
    @endcomponent
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