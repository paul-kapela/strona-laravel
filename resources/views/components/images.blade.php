<div>
  @if($images)
    @foreach($images as $image)
      <a data-fancybox href="{{ asset('/storage/app/'.$image) }}">
        <img style="width: 20% !important;" src="{{ asset('/storage/app/'.$image) }}"/>
      </a>
    @endforeach
  @else
    <p class="text-center text-secondary">{{ __('content.no_images') }}</p>
  @endif
</div>
