<div>
    <div class="form-group">
        <label class="col-form-label text-md-right">{{ __('content.content') }}</label>

        <rich-text-input
            initial-content-pl="{{ isset($assignment) ? $assignment->content_pl : '' }}"
            initial-content-en="{{ isset($assignment) ? $assignment->content_en : '' }}"
            language="{{ App::getLocale() }}"
            multilang="{{ $multilang ?? false }}"
        >
        </rich-text-input>
    </div>

    @if($dropzone ?? true)
        <div class="form-group">
            <label class="col-form-label text-md-right">{{ __('content.images') }}</label>

            <alternative-file-input
                upload-url="{{ isset($assignment) ? route("assignments.imageUploadStore", $assignment->id) : route("imageUpload.store") }}"
                existing-assignment-id="{{ isset($assignment) ? $assignment->id : '' }}"
                attachments="{{  isset($assignment) ? attachments_to_json($assignment->id) : '' }}"
                language="{{ App::getLocale() }}"
            >
            </alternative-file-input>
        </div>
    @endif

    <div class="form-group row mb-0">
        <div class="col-md-6">
            <submit-button language="{{ App::getLocale() }}" editing="{{ isset($assignment) }}"/>
        </div>
    </div>
</div>
