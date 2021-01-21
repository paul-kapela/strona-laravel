@if(!Request::is('notifications'))
  <li class="nav-item dropdown d-md-down-none">
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <span class="icon-bell"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right w-20" style="min-width: 40vw;">
      @component('notifications/notifications', [
        'notifications' => $notifications,
        'tab' => true
      ])
      @endcomponent
      
      <div class="dropdown-divider"></div>
      
      <a href="{{ route('notifications') }}" class="dropdown-item text-center">{{ __('notification.show_all') }}</a>
    </div>
  </li>
@endif