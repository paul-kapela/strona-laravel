<div>
  <p class="mb-0">
    {{
      __('notification.answer_accepted', [
        'points' => $notification->data['points']
      ])
    }}
  </p>

  <hr>

  @component('components.assignment', [
    'assignment' => \App\Answer::findOrFail($notification->data['answer_id'])->assignment
  ])

  <hr>

  @component('components.answer', [
    'answer' => \App\Answer::findOrFail($notification->data['answer_id'])
  ])  
  @endcomponent
</div>