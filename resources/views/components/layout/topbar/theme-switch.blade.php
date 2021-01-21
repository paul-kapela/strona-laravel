@if(count(config('app.themes')) > 1)
    <li class="nav-item dropdown d-md-down-none">
        <a class="nav-link" href="{{ url()->current() }}?change_theme=@if(session('theme') == config('app.themes')['dark']){{ config('app.themes')['light'] }}@else{{ config('app.themes')['dark'] }}@endif" role="button" aria-haspopup="true" aria-expanded="false">
            @if(session('theme') == config('app.themes')['dark'])
                <span class="icon-sun"></span>
            @else
                <span class="icon-moon"></span>
            @endif
        </a>
    </li>
@endif
