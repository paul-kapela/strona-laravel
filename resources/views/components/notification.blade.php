<div class="{{ $tab ? 'px-4 py-2' : 'mb-4 card card-body' }}">
  <div>
    <h6 class="text-secondary">{{ $notification->created_at }}</h6>
  
    @switch($notification->type)
      @case('App\Notifications\EmailChange')
          @component('notifications/types/email_change', [
            'notification' => $notification
          ])
          @endcomponent
        @break
  
      @case('App\Notifications\EmailChanged')
          @component('notifications/types/email_changed', [
            'notification' => $notification
          ])
          @endcomponent
        @break
  
      @case('App\Notifications\EmailVerified')
          @component('notifications/types/email_verified', [
            'notification' => $notification
          ])
          @endcomponent
        @break
  
      @case('App\Notifications\NewAnswer')
        @break
  
      @case('App\Notifications\ResetPassword')
        @break
  
      @case('App\Notifications\VerifyEmail')
          @component('notifications/types/verify_email', [
            'notification' => $notification
          ])
          @endcomponent
        @break
      
      @case('App\Notifications\RequestRejected')
          @component('notifications/types/request_rejected', [
            'notification' => $notification
          ])
          @endcomponent
        @break
      
      @case('App\Notifications\RequestResponded')
          @component('notifications/types/request_responded', [
            'notification' => $notification
          ])
          @endcomponent  
        @break

      @case('App\Notifications\OfferAccepted')
          @component('notifications/types/offer_accepted', [
            'notification' => $notification
          ])
          @endcomponent
        @break

      @case('App\Notifications\OfferRejected')
          @component('notifications/types/offer_rejected', [
            'notification' => $notification
          ])
          @endcomponent
        @break

      @default
        @break
    @endswitch
  </div>
</div>