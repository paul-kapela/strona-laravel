<div class="mb-5 p-5 border-2 dark:border-opacity-10 rounded-xl">
  @can('view', $answer)
    <h6 class="text-sm font-semibold">
      {{ $answer->user->username }} ({{  __('content.'.($answer->user->belongsToRoles('user') ? 'user' : 'editor')) }}) &bull;
      {{ $answer->created_at }} &bull;

      @if($answer->user->id == Auth::user()->id || Auth::user()->belongsToRoles('editor', 'admin'))
        {{ __('content.'.($answer->accepted ? 'approved' : 'unapproved')) }}
      @endif
    </h6>
  
    @if($multilang ?? false)
      <h6 class="my-3 text-2xl font-semibold">{{ __('language.pl') }}</h6>
  
      @if($answer->content_pl)
        {!! $answer->content_pl !!}
      @else
        <p class="text-center text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
  
      <h6 class="my-3 text-2xl font-semibold">{{ __('language.en') }}</h6>
  
      @if($answer->content_en)
        {!! $answer->content_en !!}
      @else
        <p class="text-center text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
    @else
      @if($answer->content())
        {!! $answer->content() !!}
      @else
        <p class="text-center text-2xl font-light">{{ __('content.no_content') }}</p>
      @endif
    @endif
  
    <h1 class="my-3 text-2xl font-semibold">{{ __('content.attachments') }}</h1>

    @component('components/attachments', [
      'attachments' => unserialize($answer->attachments)
    ])
    @endcomponent
    
    @if(!($withoutActions ?? false))
      <div class="w-full flex justify-end">
        @if(!$answer->accepted && Auth::user()->belongsToRoles('editor', 'admin'))
          <a href="{{ route('answers.approve', $answer) }}" class="mr-2">{{ __('request.accept')}}</a>
  
          <a href="{{ route('answers.destroy', $answer) }}" onclick="event.preventDefault(); document.getElementById('reject-form').submit();" class="mr-2">{{ __('request.reject') }}</a>
  
          <form id="reject-form" action="{{ route('answers.destroy', $answer) }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
          </form>
        @endif
      
        @can('delete', $answer)
          <a href="{{ route('answers.delete', $answer) }}" class="ml-auto mr-2 px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full">{{ __('actions.delete') }}</a>
        @endcan
  
        @can('update', $answer)
          <a href="{{ route('answers.edit', $answer) }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full">{{ __('actions.edit') }}</a>
        @endcan
      </div>
    @endif
  @else
    <div class="flex flex-col items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-3" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
      </svg>
      
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

  @if($thumb ?? false)
    <div class="w-full flex justify-end">
      <a href="{{ route('answers.show', $answer) }}" class="ml-auto px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full">{{ __('content.more') }}...</a>
    </div>
  @endif
</div>