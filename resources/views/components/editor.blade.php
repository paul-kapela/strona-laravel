<div>
    <div class="form-group">
        <label class="col-form-label text-md-right">{{ __('content.content') }}</label>

        <rich-text-input
            initial-content-pl="{{ isset($entry) ? $entry->content_pl : '' }}"
            initial-content-en="{{ isset($entry) ? $entry->content_en : '' }}"
            language="{{ App::getLocale() }}"
            multilang="{{ $multilang ?? false }}"
        >
        </rich-text-input>
    </div>

    @if($dropzone ?? true)
        <div class="form-group">
            <label class="col-form-label text-md-right">{{ __('content.images') }}</label>

            <alternative-file-input
                upload-url="{{ isset($entry) ? route($model == 'assignment' ? "assignments.imageUploadStore" : "answers.imageUploadStore", $entry->id) : route("imageUpload.store") }}"
                existing-assignment-id="{{ isset($entry) ? $entry->id : '' }}"
                attachments="{{ isset($entry) ? attachments_to_json($entry->id, $model) : '' }}"
                language="{{ App::getLocale() }}"
            >
            </alternative-file-input>
        </div>
    @endif

    <div class="form-group row mb-0">
        <div class="col-md-6">
            <submit-button language="{{ App::getLocale() }}" editing="{{ isset($entry) }}"/>
        </div>
    </div>
</div>
