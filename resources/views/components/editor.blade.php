<div class="mt-5">
  <div>
    <h3 class="text-xl font-semibold">{{ __('content.content') }}</h3>

    <hr class="my-3 dark:opacity-10 border-t-2">

  <rich-text-input
      initial-content-pl="{{ isset($entry) ? $entry->content_pl : '' }}"
      initial-content-en="{{ isset($entry) ? $entry->content_en : '' }}"
      language="{{ App::getLocale() }}"
      multilang="{{ $multilang ?? false }}"
    >
    </rich-text-input>
  </div>

  @if($dropzone ?? true)
    <div>
      <h3 class="mt-5 mb-2 text-xl font-semibold">{{ __('content.attachments') }}</h3>

      <alternative-file-input
        upload-url="{{ isset($entry) ? route($model == 'assignment' ? "assignments.imageUploadStore" : "answers.imageUploadStore", $entry->id) : route("imageUpload.store") }}"
        existing-assignment-id="{{ isset($entry) ? $entry->id : '' }}"
        attachments="{{ isset($entry) ? attachments_to_json($entry->id, $model) : '' }}"
        language="{{ App::getLocale() }}"
      />
    </div>
  @endif

  <submit-button language="{{ App::getLocale() }}" editing="{{ isset($entry) }}"/>
</div>
