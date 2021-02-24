<div>
  <h6 class="text-secondary" style="font-size: 0.8em;">
    {{ __('content.user') }}: {{ $assignment->user->username }}<br/>
    {{ __('content.subject') }}: {{ __('subject.'.$assignment->subject()->get()->first()->name) }}<br/>
    {{ __('content.grade') }}: {{ __('grade.'.$assignment->grade()->get()->first()->name) }}<br/>
    {{ __('content.date') }}: {{ $assignment->created_at }}
  </h6>

  @if($multilang ?? '')
    <h6>{{ __('language.pl') }}</h6>

    @if($thumb ?? '')
      @if($assignment->shortContent('pl'))
        {!! $assignment->shortContent('pl') !!}
      @else
        <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
      @endif
    @else
      @if($assignment->content('pl'))
        {!! $assignment->content('pl') !!}
      @else
        <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
      @endif
    @endif

    <hr>

    <h6>{{ __('language.en') }}</h6>
    
    @if($thumb ?? '')
      @if($assignment->shortContent('en'))
        {!! $assignment->shortContent('en') !!}
      @else
        <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
      @endif
    @else
      @if($assignment->content('en'))
        {!! $assignment->content('en') !!}
      @else
        <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
      @endif
    @endif
  @else
    @if($thumb ?? '')
      @if($assignment->shortContent())
        {!! $assignment->shortContent() !!}
      @else
        <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
      @endif
    @else
      @if($assignment->content())
        {!! $assignment->content() !!}
      @else
        <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
      @endif
    @endif
  @endif

  <hr>

  @component('components/images', [
    'images' => unserialize($assignment->attachments)
  ])
  @endcomponent
</div>
