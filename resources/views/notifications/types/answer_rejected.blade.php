<div>
  <p class="mb-0">
    {{ __('notification.answer_rejected') }}
  </p>

  <hr>

  @component('components.assignment', [
    'assignment' => \App\Assignment::findOrFail($notification->data['assignment_id'])->assignment
  ])
</div>