<div class="card bg-warning mb-2 p-3">
    <h5>
        Czas dostępu: 
        @if($plan->number_of_days % 31 == 0)
            @if($plan->number_of_days / 31 == 1)    
                {{ ($plan->number_of_days / 31).' '.'miesiąc' }}
            @elseif($plan->number_of_days / 31 > 1 && $plan->number_of_days / 31 < 5)
                {{ ($plan->number_of_days / 31).' '.'miesiące' }}
            @else
                {{ ($plan->number_of_days / 31).' '.'miesięcy' }}
            @endif
        @else
            {{ ($plan->number_of_days).' '.'dni' }}
        @endif
    </h5>

    <h6>Cena: {{ $plan->price }} PLN</h6>

    <a href="#" class="btn btn-primary mt-2">Kup</a>
</div>