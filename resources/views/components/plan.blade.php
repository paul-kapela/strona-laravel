<div class="p-5 flex flex-col space-y-2 text-center rounded-border flex-1">
    <h3 class="text-2xl font-semibold">
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

    <h6>{{ $plan->price }} PLN</h6>

    <a href="#" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 font-semibold rounded-full">Kup</a>
</div>