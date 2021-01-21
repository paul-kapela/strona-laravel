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
            {!! $assignment->shortContent('pl') !!}
        @else
            {!! $assignment->content('pl') !!}
        @endif

        <hr>

        <h6>{{ __('language.en') }}</h6>
        
        @if($thumb ?? '')
            {!! $assignment->shortContent('en') !!}
        @else
            {!! $assignment->content('en') !!}
        @endif
    @else
        @if($thumb ?? '')
            {!! $assignment->shortContent() !!}
        @else
            {!! $assignment->content() !!}
        @endif
    @endif

    @component('components/images', [
        'images' => unserialize($assignment->attachments)
    ])
    @endcomponent
</div>
