<div>
    <h6 class="text-secondary" style="font-size: 0.8em;">
        {{ __('content.editor') }}: {{ $answer->user->username }} <br/>
        {{ __('content.date') }}: {{ $answer->created_at }} <br/>
    </h6>

    {!! $answer->content() !!}

    @component('components/images', [
        'images' => unserialize($answer->attachments)
    ])
    @endcomponent
</div>
