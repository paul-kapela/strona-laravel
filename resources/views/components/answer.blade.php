<div>
    <h6 class="text-secondary" style="font-size: 0.8em;">
        {{ __('content.editor') }}: {{ $answer->user->username }} <br/>
        {{ __('content.date') }}: {{ $answer->created_at }} <br/>
    </h6>

    @if($multilang)
        {!! $assignment->content_pl !!}

        <hr>

        {!! $assignment->content_en !!}
    @else
        {!! $assignment->content() !!}
    @endif

    @component('components/images', [
        'images' => unserialize($answer->attachments)
    ])
    @endcomponent
</div>
