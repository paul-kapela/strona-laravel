<div>
  <h6 class="text-secondary" style="font-size: 0.8em;">
    {{ __('content.user') }}: {{ $assignment->user->username }}<br/>
    {{ __('subject.'.$assignment->subject()->get()->first()->name) }} &bull;
    {{ __('grade.'.$assignment->grade()->get()->first()->name) }} &bull;
    {{ $assignment->created_at }}
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

  @component('components/attachments', [
    'attachments' => unserialize($assignment->attachments)
  ])
  @endcomponent

  @if($thumb ?? false)
    <div class="d-flex flex-column-reverse">
      <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-primary align-self-end mt-3">{{ __('content.more') }}...</a>
    </div>
  @endif
</div>
