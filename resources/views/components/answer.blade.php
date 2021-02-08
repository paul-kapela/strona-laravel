@can('view', $answer)
  <div class="d-flex align-items-baseline">
    <h6 class="mr-auto text-secondary" style="font-size: 0.8em;">
      {{ __('content.editor') }}: {{ $answer->user->username }} <br/>
      {{ __('content.date') }}: {{ $answer->created_at }} <br/>
    </h6>

    @if(!($withoutActions ?? false))
      @can('delete', $answer)
        <a href="{{ route('answers.delete', $answer) }}" class="mr-2">{{ __('actions.delete') }}</a>
      @endcan

      @can('update', $answer)
        <a href="{{ route('answers.edit', $answer) }}">{{ __('actions.edit') }}</a>
      @endcan
    @endif
  </div>

  @if($multilang)
    <h6>{{ __('language.pl') }}</h6>
    {!! $answer->content_pl !!}

    <hr>

    <h6>{{ __('language.en') }}</h6>
    {!! $answer->content_en !!}
  @else
    {!! $answer->content() !!}
  @endif

  <hr>

  @component('components/images', [
    'images' => unserialize($answer->attachments)
  ])
  @endcomponent
@else
  <div class="d-flex flex-column text-center">
    <span class="icon-lock" style="font-size: 5em;"></span>
    
    <h3>{{ __('content.not_available') }}</h3>
    <h4></h4>
  </div>
@endcan