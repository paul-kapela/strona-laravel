<div>
  <p class="mb-0">
    {{
      __('notification.request_rejected', [
        'date' => $notification->data['due_date']
      ])
    }}
  </p>

  <hr>

  @component('components/assignment', [
    'assignment' => \App\Assignment::findOrFail($notification->data['assignment_id'])
  ])
  @endcomponent
</div>