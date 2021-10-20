<footer class="w-full lg:px-20 px-10 lg:py-10 py-5 bg-gray-200 dark:bg-gray-900">
  <div class="flex lg:flex-row flex-col lg:space-x-10 lg:space-y-0 space-y-5">
    <div class="max-w-xs flex flex-col">
      <h1 class="text-4xl chalk">{{ config('app.name', 'Laravel') }}</h1>

      <p class="max-w-25 mt-4 text-xs">Strona korzysta z plików cookie w celu realizacji usług zgodnie z polityką cookie. Możesz określić warunki przechowywania lub dostępu do cookie w Twojej przeglądarce.</p>
    </div>

    <div class="flex flex-col">
      <h3 class="text-xl font-semibold">Nawigacja</h3>

      <a href="{{ route('welcome') }}" class="mt-4">Strona główna</a>
      <a href="{{ route('help') }}">Pomoc</a>
      <a href="{{ route('terms') }}">Regulamin</a>
    </div>

    <div class="flex flex-col">
      <h3 class="text-xl font-semibold">Kontakt</h3>

      <p class="mt-4">Zespół Obliczamy.pl</p>
      <p>kontakt@obliczamy.pl</p>
      <p>+48 123 456 789</p>
    </div>
  </div>
</footer>