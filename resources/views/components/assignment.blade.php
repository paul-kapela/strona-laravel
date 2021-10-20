<div class="mb-5 p-5 rounded-border">
  <h6 class="mb-3 text-sm font-semibold">
    {{ $assignment->user->username }} &bull;
    {{ __('subject.'.$assignment->subject()->get()->first()->name) }} &bull;
    {{ __('grade.'.$assignment->grade()->get()->first()->name) }} &bull;
    {{ $assignment->created_at }}
  </h6>

  @if($multilang ?? '')
    <h1 class="mb-3 text-2xl font-semibold">{{ __('language.pl') }}</h1>

    @if($thumb ?? '')
      @if($assignment->shortContent('pl'))
        {!! $assignment->shortContent('pl') !!}
      @else
        <p class="text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
    @else
      @if($assignment->content('pl'))
        {!! $assignment->content('pl') !!}
      @else
        <p class="text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
    @endif

    <h1 class="my-3 text-2xl font-semibold">{{ __('language.en') }}</h1>
    
    @if($thumb ?? '')
      @if($assignment->shortContent('en'))
        {!! $assignment->shortContent('en') !!}
      @else
        <p class="text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
    @else
      @if($assignment->content('en'))
        {!! $assignment->content('en') !!}
      @else
        <p class="text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
    @endif
  @else
    @if($thumb ?? '')
      @if($assignment->shortContent())
        {!! $assignment->shortContent() !!}
      @else
        <p class="text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
    @else
      @if($assignment->content())
        {!! $assignment->content() !!}
      @else
        <p class="text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
    @endif
  @endif

  <h1 class="my-3 text-2xl font-semibold">{{ __('content.attachments') }}</h1>

  @component('components/attachments', [
    'attachments' => unserialize($assignment->attachments)
  ])
  @endcomponent

  @if($thumb ?? false)
    <div class="w-full flex justify-end">
      <a href="{{ route('assignments.show', $assignment) }}" class="ml-auto px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full">{{ __('content.more') }}...</a>
    </div>
  @endif
</div>
