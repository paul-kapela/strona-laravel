<div>
    <h6 class="text-secondary" style="font-size: 0.8em;">
        {{ __('content.user') }}: {{ $assignment->user->username  }}<br/>
        {{ __('content.subject') }}: {{ __('subject.'.$assignment->subject()->get()->first()->name) }}<br/>
        {{ __('content.grade') }}: {{ __('grade.'.$assignment->grade()->get()->first()->name) }}<br/>
        {{ __('content.date') }}: {{ $assignment->created_at }}
    </h6>

    {!! $assignment->content() !!}

    @component('components/images', [
        'images' => unserialize($assignment->attachments)
    ])
    @endcomponent
</div>
