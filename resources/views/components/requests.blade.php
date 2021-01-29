@if($requests->first())
  @foreach($requests as $request)
    <div class="mb-4 card card-body">
      @component('components.request', [
        'request' => $request
      ])          
      @endcomponent

      <div class="text-white text-right">
        @if(policy(\App\RequestResponse::class)->create(Auth::user()))
          <a href="{{ route('requests.accept', $request) }}" class="mr-1 btn btn-primary">{{ __('request.accept') }}</a>
          <a href="{{ route('requests.reject', $request) }}" onclick="event.preventDefault(); document.getElementById('reject-form').submit();" class="mr-1 btn btn-primary">{{ __('request.reject') }}</a>

          <form id="reject-form" action="{{ route('requests.reject', $request) }}" method="POST" class="d-none">
            @csrf
          </form>
        @endif

        <a href="{{ route('requests.edit', $request) }}" class="mr-1 btn btn-primary">Edytuj</a>
        <a href="{{ route('requests.delete', $request) }}" class="btn btn-primary">Usuń</a>
      </div>
    </div>
  @endforeach
@else
  <div class="mt-5 text-white text-center justify-content-center">
    <h3>{{ __('request.no').' '.__('request.requests') }}</h3>
  </div>
@endif