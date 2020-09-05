<form action="{{ route('assignments.index', request()->all()) }}" method="GET" role="search">
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="query" placeholder="{{ __('search.search') }}" value="{{ request('query') }}">

        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">
                <span class="icon-search"></span>
            </button>
        </div>
    </div>
</form>
