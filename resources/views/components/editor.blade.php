<div>
    <div class="form-group">
        <label class="col-form-label text-md-right">{{ __('content.content') }}</label>

        <rich-text-input initial-content="{{ $content ?? '' }}" language="{{ App::getLocale() }}" multilang="{{ $multilang }}"/>
    </div>

    <div class="form-group">
        <label class="col-form-label text-md-right">{{ __('content.images') }}</label>

        <alternative-file-input existing-assignment-id="{{ $assignment_id ?? '' }}" attachments="{{ $attachments ?? '' }}" existing-image-upload-token="{{ $image_upload_token ?? '' }}" language="{{ App::getLocale() }}"/>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6">
            <submit-button language="{{ App::getLocale() }}"/>
        </div>
    </div>
</div>
