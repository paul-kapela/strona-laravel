@can('view', $answer)
  <div class="d-flex align-items-baseline">
    <h6 class="mr-auto text-secondary" style="font-size: 0.8em;">
      {{ __('content.'.($answer->user->belongsToRoles('user') ? 'user' : 'editor')) }}: {{ $answer->user->username }} <br/>
      {{ __('content.date') }}: {{ $answer->created_at }} <br/>

      @if($answer->user->id == Auth::user()->id || Auth::user()->belongsToRoles('editor', 'admin'))
        {{ __('content.status') }}: {{ __('content.'.($answer->accepted ? 'approved' : 'unapproved')) }}
      @endif
    </h6>

    @if(!($withoutActions ?? false))
      @if(!$answer->accepted && Auth::user()->belongsToRoles('editor', 'admin'))
        <a href="{{ route('answers.approve', $answer) }}" class="mr-2">{{ __('request.accept')}}</a>

        <a href="{{ route('answers.destroy', $answer) }}" onclick="event.preventDefault(); document.getElementById('reject-form').submit();" class="mr-2">{{ __('request.reject') }}</a>

        <form id="reject-form" action="{{ route('answers.destroy', $answer) }}" method="POST" class="d-none">
          @csrf
          @method('DELETE')
        </form>
      @endif
    
      @can('delete', $answer)
        <a href="{{ route('answers.delete', $answer) }}" class="mr-2">{{ __('actions.delete') }}</a>
      @endcan

      @can('update', $answer)
        <a href="{{ route('answers.edit', $answer) }}">{{ __('actions.edit') }}</a>
      @endcan
    @endif
  </div>

  @if($multilang ?? false)
    <h6>{{ __('language.pl') }}</h6>

    @if($answer->content_pl)
      {!! $answer->content_pl !!}
    @else
      <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
    @endif

    <hr>

    <h6>{{ __('language.en') }}</h6>

    @if($answer->content_en)
      {!! $answer->content_en !!}
    @else
      <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
    @endif
  @else
    @if($answer->content())
      {!! $answer->content() !!}
    @else
      <p class="text-center text-secondary">{{ __('content.no_content') }}</p>
    @endif
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
    
    @if($answer->requestResponse()->exists() && !$answer->requestResponse->paid)
      <h4>{{ __('content.pay_request') }}</h4>
    @elseif(!$answer->accepted)
      <h4>{{ __('content.waiting_for_approval') }}</h4>
    @else
      <h4>{{ __('content.buy_plan') }}</h4>
    @endif
    
  </div>
@endcan