@if(count(config('app.languages')) > 1)
  <div id="languagesDropdown" class="relative">
    <a id="languagesDropdownButton" onclick="dropdownClick(event, 'languages')" href="#" class="flex">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 flex text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
      </svg>

      <h3 class="ml-2 lg:hidden font-semibold leading-9">Język</h3>
    </a>

    <div id="languagesDropdownContent" class="lg:absolute lg:right-0.5 lg:z-10 lg:mt-3 lg:my-0 my-3 lg:p-4 flex-col bg-white dark:bg-gray-800 font-semibold lg:shadow-md lg:rounded-lg hidden lg:space-y-4">
      @foreach(config('app.languages') as $langLocale => $langName)
        <a href="{{ url()->current() }}?change_language={{ $langLocale }}" class="p-2">{{ $langName }}</a>
      @endforeach
    </div>
  </div>
@endif