@extends('layouts.admin')

@section('page-title', 'Admission Popup')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Admission Popup
        </h2>

        <p class="admin-page-subtitle">
            Manage homepage admission popup title, image and destination URL
        </p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST"
      action="{{ route('admin.admission-popups.update') }}"
      enctype="multipart/form-data">

    @csrf

    <div class="admin-form-grid">

        {{-- POPUP INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">

                <div class="form-card-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Popup Information
                    </p>

                    <p class="form-card-subtitle">
                        Manage popup title and admission URL
                    </p>
                </div>

            </div>

            <div class="form-card-body">

                <div class="field-group">

                    <label class="field-label"
                           for="title">

                        Popup Title
                        <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">

                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $admissionPopup->title ?? '') }}"
                               required
                               placeholder="Admission Open"
                               class="field-input {{ $errors->has('title') ? 'error' : '' }}">

                    </div>

                    @error('title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            This title will be used as image alt text and link label.
                        </p>
                    @enderror

                </div>

                <div class="field-group">

                    <label class="field-label"
                           for="url">

                        Admission URL
                        <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">

                        <i class="fas fa-link icon"></i>

                        <input type="url"
                               name="url"
                               id="url"
                               value="{{ old('url', $admissionPopup->url ?? '') }}"
                               required
                               placeholder="https://gdmm.tcspatna.in/"
                               class="field-input {{ $errors->has('url') ? 'error' : '' }}">

                    </div>

                    @error('url')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Visitors will open this URL after clicking the popup image.
                        </p>
                    @enderror

                </div>

                @if(!empty($admissionPopup->url))

                    <div class="popup-current-link">

                        <div class="popup-current-link-icon">
                            <i class="fas fa-external-link-alt"></i>
                        </div>

                        <div>
                            <strong>
                                Current Admission Link
                            </strong>

                            <a href="{{ $admissionPopup->url }}"
                               target="_blank"
                               rel="noopener">

                                {{ $admissionPopup->url }}
                            </a>
                        </div>

                    </div>

                @endif

            </div>

        </div>

        {{-- POPUP IMAGE --}}
        <div class="form-card">

            <div class="form-card-header">

                <div class="form-card-icon">
                    <i class="fas fa-image"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Popup Image
                    </p>

                    <p class="form-card-subtitle">
                        Upload or replace the admission popup image
                    </p>
                </div>

            </div>

            <div class="form-card-body">

                <div class="field-group">

                    <label class="field-label"
                           for="popup_image">

                        Admission Popup Image
                    </label>

                    <input type="file"
                           name="popup_image"
                           id="popup_image"
                           accept=".jpg,.jpeg,.png,.webp"
                           class="field-input {{ $errors->has('popup_image') ? 'error' : '' }}">

                    @error('popup_image')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            JPG, JPEG, PNG or WEBP. Maximum file size 5 MB.
                        </p>
                    @enderror

                </div>

                @if(!empty($admissionPopup->image))

                    <div class="popup-current-image">

                        <div class="popup-current-image-head">

                            <div>
                                <strong>
                                    Current Popup Image
                                </strong>

                                <span>
                                    Upload a new image to replace this image.
                                </span>
                            </div>

                            <a href="{{ $admissionPopup->image }}"
                               target="_blank"
                               rel="noopener">

                                <i class="fas fa-external-link-alt"></i>
                                Open Image
                            </a>

                        </div>

                        <img src="{{ $admissionPopup->image }}"
                             alt="{{ $admissionPopup->title ?: 'Admission Popup' }}">

                    </div>

                @else

                    <div class="popup-empty-image">

                        <i class="fas fa-image"></i>

                        <h3>
                            No Popup Image Uploaded
                        </h3>

                        <p>
                            Select an admission popup image from the field above.
                        </p>

                    </div>

                @endif

                <div id="popupNewImagePreview"
                     class="popup-new-image-preview"
                     style="display:none;">

                    <div class="popup-new-image-head">
                        <strong>
                            New Selected Image
                        </strong>

                        <span id="popupNewImageName"></span>
                    </div>

                    <img id="popupNewImage"
                         src=""
                         alt="New popup image preview">

                </div>

            </div>

        </div>

        {{-- LIVE PREVIEW --}}
        <div class="form-card popup-full-card">

            <div class="form-card-header">

                <div class="form-card-icon">
                    <i class="fas fa-desktop"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Popup Preview
                    </p>

                    <p class="form-card-subtitle">
                        Preview of the admission popup shown on the frontend
                    </p>
                </div>

            </div>

            <div class="form-card-body">

                <div class="popup-admin-preview">

                    <div class="popup-admin-overlay"></div>

                    <div class="popup-admin-box">

                        <span class="popup-admin-close">
                            <i class="fas fa-times"></i>
                        </span>

                        @if(!empty($admissionPopup->image))

                            <a href="{{ $admissionPopup->url }}"
                               target="_blank"
                               rel="noopener"
                               aria-label="{{ $admissionPopup->title }}">

                                <img src="{{ $admissionPopup->image }}"
                                     alt="{{ $admissionPopup->title }}">

                            </a>

                        @else

                            <div class="popup-admin-placeholder">

                                <i class="fas fa-image"></i>

                                <strong>
                                    {{ $admissionPopup->title ?: 'Admission Open' }}
                                </strong>

                                <span>
                                    Popup image preview will appear here
                                </span>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

    @can('admission_popup_edit')

        <div class="form-actions">

            <button type="submit"
                    class="btn-primary">

                <i class="fas fa-check"></i>
                Save Admission Popup
            </button>

            <a href="{{ route('admin.admission-popups.index') }}"
               class="btn-ghost">

                Cancel
            </a>

        </div>

    @endcan

</form>

<style>
    .popup-full-card {
        grid-column: 1 / -1;
    }

    .popup-current-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        border: 1px solid #bae6fd;
        border-radius: 14px;
        background: #f0f9ff;
    }

    .popup-current-link-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #e0f2fe;
        color: #0369a1;
    }

    .popup-current-link strong,
    .popup-current-link a {
        display: block;
    }

    .popup-current-link strong {
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 13px;
    }

    .popup-current-link a {
        max-width: 430px;
        overflow: hidden;
        color: #0369a1;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .popup-current-image {
        padding: 14px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #f8fafc;
    }

    .popup-current-image-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 13px;
    }

    .popup-current-image-head strong,
    .popup-current-image-head span {
        display: block;
    }

    .popup-current-image-head strong {
        color: #1f2937;
        font-size: 13px;
    }

    .popup-current-image-head span {
        margin-top: 3px;
        color: #64748b;
        font-size: 11px;
    }

    .popup-current-image-head a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .popup-current-image img,
    .popup-new-image-preview img {
        width: 100%;
        max-height: 430px;
        display: block;
        object-fit: contain;
        border-radius: 13px;
        background: #ffffff;
    }

    .popup-empty-image {
        min-height: 260px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 25px;
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        background: #f8fafc;
        text-align: center;
    }

    .popup-empty-image i {
        margin-bottom: 13px;
        color: #94a3b8;
        font-size: 40px;
    }

    .popup-empty-image h3 {
        margin: 0 0 6px;
        color: #334155;
        font-size: 15px;
    }

    .popup-empty-image p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
    }

    .popup-new-image-preview {
        margin-top: 15px;
        padding: 14px;
        border: 1px solid #bbf7d0;
        border-radius: 16px;
        background: #f0fdf4;
    }

    .popup-new-image-head {
        margin-bottom: 12px;
    }

    .popup-new-image-head strong,
    .popup-new-image-head span {
        display: block;
    }

    .popup-new-image-head strong {
        color: #166534;
        font-size: 13px;
    }

    .popup-new-image-head span {
        margin-top: 3px;
        color: #64748b;
        font-size: 11px;
    }

    .popup-admin-preview {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 32px;
        border-radius: 18px;
        background:
            linear-gradient(
                135deg,
                #0f172a,
                #1e293b
            );
    }

    .popup-admin-overlay {
        position: absolute;
        inset: 0;
        background: rgba(2, 6, 23, .55);
    }

    .popup-admin-box {
        position: relative;
        z-index: 2;
        width: min(100%, 600px);
        padding: 8px;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 30px 70px rgba(0, 0, 0, .35);
    }

    .popup-admin-box img {
        width: 100%;
        max-height: 470px;
        display: block;
        object-fit: contain;
        border-radius: 14px;
    }

    .popup-admin-close {
        position: absolute;
        z-index: 3;
        top: -14px;
        right: -14px;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 4px solid #ffffff;
        border-radius: 50%;
        background: #dc2626;
        color: #ffffff;
        font-size: 13px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, .25);
    }

    .popup-admin-placeholder {
        min-height: 380px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-radius: 14px;
        background: #f8fafc;
        text-align: center;
    }

    .popup-admin-placeholder i {
        margin-bottom: 14px;
        color: #94a3b8;
        font-size: 50px;
    }

    .popup-admin-placeholder strong {
        color: #1e293b;
        font-size: 20px;
    }

    .popup-admin-placeholder span {
        margin-top: 7px;
        color: #64748b;
        font-size: 12px;
    }

    @media(max-width: 768px) {
        .popup-full-card {
            grid-column: auto;
        }

        .popup-current-image-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .popup-admin-preview {
            min-height: 390px;
            padding: 22px;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script>
document.addEventListener('DOMContentLoaded', function () {

    const imageInput =
        document.getElementById('popup_image');

    const previewWrapper =
        document.getElementById('popupNewImagePreview');

    const previewImage =
        document.getElementById('popupNewImage');

    const previewName =
        document.getElementById('popupNewImageName');

    imageInput?.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            hidePreview();
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert(
                'Please select a JPG, JPEG, PNG or WEBP image.'
            );

            this.value = '';
            hidePreview();
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert(
                'Popup image must not exceed 5 MB.'
            );

            this.value = '';
            hidePreview();
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            previewImage.src = event.target.result;
            previewName.textContent = file.name;
            previewWrapper.style.display = 'block';
        };

        reader.readAsDataURL(file);
    });

    function hidePreview() {
        if (previewWrapper) {
            previewWrapper.style.display = 'none';
        }

        if (previewImage) {
            previewImage.src = '';
        }

        if (previewName) {
            previewName.textContent = '';
        }
    }

});
</script>

@endsection