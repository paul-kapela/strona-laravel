@if($requests->first())
  @if(request('assignment') != null)
    @component('components.assignment', [
      'assignment' => \App\Assignment::findOrFail(request('assignment'))
    ])
    @endcomponent
  @endif

  @foreach($requests as $request)
    <div class="mb-4 card card-body">
      @component('components.request', [
        'request' => $request,
        'display_assignment' => request('assignment') == null
      ])          
      @endcomponent

      <div class="text-right">
        @if(policy(\App\RequestResponse::class)->create(Auth::user()))
          @switch($request->status())
            @case('pending')
                <a href="{{ route('requests.accept', $request) }}" class="mr-1 btn btn-primary">{{ __('request.accept') }}</a>
                <a href="{{ route('requests.reject', $request) }}" onclick="event.preventDefault(); document.getElementById('reject-form').submit();" class="mr-1 btn btn-primary">{{ __('request.reject') }}</a>
    
                <form id="reject-form" action="{{ route('requests.reject', $request) }}" method="POST" class="d-none">
                  @csrf
                </form>
              @break
            @case('accepted_by_user')
                @if($request->requestResponse->answer()->exists())
                  <a href="{{ route('assignments.show', $request->assignment) }}" class="mr-1 btn btn-primary">{{ __('actions.show').' '.lcfirst(__('content.answer')) }}</a>
                @else
                  @if(Auth::user()->id == $request->requestResponse->user->id)
                    <a href="{{ route('answers.create', [ 'assignment' => $request->assignment->id, 'request_response' => $request->requestResponse->id ]) }}" class="mr-1 btn btn-primary">{{ __('create.send').' '.lcfirst(__('content.answer')) }}</a>
                  @endif
                @endif
              @break
            @case('ready')
                
              @break
            @default
              @break
          @endswitch
        @else
          @switch($request->status())
            @case('pending')
                <a href="{{ route('requests.edit', $request) }}" class="mr-1 btn btn-primary">{{ __('actions.edit') }}</a>
              @break
            @case('accepted_by_editor')
                <a href="{{ route('requests.accept_offer', $request) }}" onclick="event.preventDefault(); document.getElementById('accept-form').submit();" class="mr-1 btn btn-primary">{{ __('request.accept_offer') }}</a>
                <a href="{{ route('requests.reject_offer', $request) }}" onclick="event.preventDefault(); document.getElementById('reject-form').submit();" class="btn btn-primary">{{ __('request.reject_offer') }}</a>

                <form id="accept-form" action="{{ route('requests.accept_offer', $request) }}" method="POST" class="d-none">
                  @csrf
                </form>
                
                <form id="reject-form" action="{{ route('requests.reject_offer', $request) }}" method="POST" class="d-none">
                  @csrf
                </form>
              @break
            @case('ready')
                <a href="{{ route('requests.test_pay', $request) }}" onclick="event.preventDefault(); document.getElementById('test-pay-form').submit();" class="mr-1 btn btn-primary">Zapłać testowo</a>

                <form id="test-pay-form" action="{{ route('requests.test_pay', $request) }}" method="POST" class="d-none">
                  @csrf
                </form>
              @break
            @default
              @break
          @endswitch
        @endif

        @if(policy(\App\Request::class)->delete(Auth::user(), $request))
          <a href="{{ route('requests.delete', $request) }}" class="btn btn-primary">{{ __('actions.delete') }}</a>
        @endif
      </div>
    </div>
  @endforeach
@else
  <h1 class="text-center text-2xl font-light">{{ __('request.no').' '.__('request.requests') }}</h1>
@endif