@if($requests->first())
  @foreach($collection as $item)
      
  @endforeach
@else
  <div class="mt-5 text-white text-center justify-content-center">
    <h3>{{ __('request.no').' '.__('request.requests') }}</h3>
  </div>
@endif