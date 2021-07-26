<div>
  @if($attachments)
    @foreach($attachments as $attachment)
      @if(is_image($attachment))
        <a data-fancybox href="{{ asset('storage/'.$attachment) }}">
          <img style="width: 20% !important;" src="{{ asset('storage/'.$attachment) }}"/>
        </a>
      @endif
    @endforeach

    @foreach($attachments as $attachment)
      <ul>
        @if(!is_image($attachment))
          <li>
            <a href="{{ asset('storage/'.$attachment) }}">{{ substr($attachment, strrpos($attachment, '.') + 1) }}</a>
          </li>
        @endif
      </ul>
    @endforeach
  @else
    <p class="text-center text-secondary">{{ __('content.no_attachments') }}</p>
  @endif
</div>
