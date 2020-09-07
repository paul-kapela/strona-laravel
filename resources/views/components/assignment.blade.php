<div>
    <h6 class="text-secondary" style="font-size: 0.8em;">
        {{ __('content.user') }}: {{ $assignment->user->username  }}<br/>
        {{ __('content.subject') }}: {{ __('subject.'.$assignment->subject()->get()->first()->name) }}<br/>
        {{ __('content.grade') }}: {{ __('grade.'.$assignment->grade()->get()->first()->name) }}<br/>
        {{ __('content.date') }}: {{ $assignment->created_at }}
    </h6>

    @if($multilang)
        @if()
        {!! $assignment->content_pl !!}

        <hr>

        {!! $assignment->content_en !!}
    @else
        {!! $assignment->content() !!}
    @endif

    @component('components/images', [
        'images' => unserialize($assignment->attachments)
    ])
    @endcomponent
</div>