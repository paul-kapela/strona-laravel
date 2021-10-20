<form action="{{ route($route_name, request()->all()) }}" method="GET" role="search" class="sm:w-auto w-100 lg:mr-4 lg:mt-0 mt-4 flex flex-grow align-middle h-10">
  <input type="text" name="query" placeholder="{{ __('search.search') }}" value="{{ request('query') }}" class="mr-0 flex-grow input">

  <button type="submit" class="ml-0 pr-3 search-button">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
  </button>
</form>