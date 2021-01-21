<a class="btn bg-transparent" style="padding: 0 !important; font-size: 1.3em;" href="{{ $url ?? '#' }}" onclick="{{ $back ?? '' ? 'window.history.back()' : 'null' }}">
    <span class="{{ $white ?? '' ? 'text-white' : '' }} icon-remove"></span>
</a>
