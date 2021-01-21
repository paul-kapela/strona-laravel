<div>
  <p class="mb-0">
    {{
      __('notification.email_changed', [
        'oldEmail' => $notification->data['oldEmail'],
        'newEmail' => $notification->data['newEmail']
      ])
    }}
  </p>
</div>