<h1 class="text-2xl font-semibold">{{ __('content.status') }}</h1>

<hr class="my-3 dark:opacity-10 border-t-2">

<div class="py-2 flex lg:flex-col flex-row lg:space-x-0 space-x-3 lg:space-y-3 lg:overflow-auto overflow-x-scroll">
  <a href="{{ route('answers.index', array_merge(request()->all(), [ 'approved' => 1 ])) }}" class="flex items-center text-xl font-semibold {{ request('approved') == 1 ? 'text-gray-500' : '' }}">
    <h3>{{ __('content.approved') }}</h3>
  </a>

  <a href="{{ route('answers.index', array_merge(request()->all(), [ 'approved' => 0 ])) }}" class="flex items-center text-xl font-semibold {{ request('approved') == 0 && request('approved') !== null ? 'text-gray-500' : '' }}">
    <h3>{{ __('content.unapproved') }}</h3>
  </a>
  
  <a href="{{ route('answers.index', array_filter(array_merge(request()->all(), [ 'approved' => '' ]))) }}" class="flex items-center text-xl font-semibold {{ request('approved') === null ? 'text-gray-500' : '' }}">
    <h3>{{ __('content.all') }}</h3>
  </a>
</div>