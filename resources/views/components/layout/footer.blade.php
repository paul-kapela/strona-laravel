<footer class="w-100 mt-4 p-5 text-white bg-dark">
    <div class="pb-5 d-flex flex-wrap">
      <div class="d-flex flex-column mb-4 px-4">
        <h3 class="mr-3 chalk">{{ config('app.name', 'Laravel') }}</h3>
      
        <p class="text-secondary">&copy; 2021 Obliczamy.pl <br/> Wszelkie prawa zastrzeżone.</p>
      </div>
    
      <div class="mb-4 px-4 d-flex flex-column">
        <h5>Przydatne linki</h5>
        
        <a href="{{ route('welcome') }}">Strona główna</a>
        <a href="{{ route('terms') }}">Regulamin</a>
      </div>
    
      <div class="px-4 d-flex flex-column">
        <h5>Kontakt</h5>
    
        <p class="mb-0">Zespół Obliczamy.pl</p>
        <p class="mb-0">Adres e-mail: kontakt@obliczamy.pl</p>
        <p class="mb-0">Numer telefonu: +48 123 456 789</p>
      </div>
    </div>
</footer>