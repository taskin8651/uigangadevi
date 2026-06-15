@extends('layouts.admin')

@section('page-title', 'Principal Message')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Principal Message
        </h2>

        <p class="admin-page-subtitle">
            Manage principal details, image, message heading and description
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
      action="{{ route('admin.principal-messages.update') }}"
      enctype="multipart/form-data">

    @csrf

    <div class="admin-form-grid">

        {{-- PRINCIPAL DETAILS --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-user-tie"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Principal Details
                    </p>

                    <p class="form-card-subtitle">
                        Manage principal name and college name
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="principal_name">
                        Principal Name
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-user-tie icon"></i>

                        <input type="text"
                               name="principal_name"
                               id="principal_name"
                               value="{{ old('principal_name', $principalMessage->principal_name ?? '') }}"
                               placeholder="Prof. Dr. Shyama Roy"
                               class="field-input {{ $errors->has('principal_name') ? 'error' : '' }}">
                    </div>

                    @error('principal_name')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="college_name">
                        College Name
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-university icon"></i>

                        <input type="text"
                               name="college_name"
                               id="college_name"
                               value="{{ old('college_name', $principalMessage->college_name ?? '') }}"
                               placeholder="Ganga Devi Mahila Mahavidyalaya"
                               class="field-input {{ $errors->has('college_name') ? 'error' : '' }}">
                    </div>

                    @error('college_name')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- PRINCIPAL IMAGE --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-image"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Principal Image
                    </p>

                    <p class="form-card-subtitle">
                        Upload principal photograph
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="principal_image">
                        Principal Image
                    </label>

                    <input type="file"
                           name="principal_image"
                           id="principal_image"
                           accept=".jpg,.jpeg,.png,.webp"
                           class="field-input {{ $errors->has('principal_image') ? 'error' : '' }}">

                    @php
                        $principalImage = null;

                        if (!empty($principalMessage)) {
                            $principalImage = $principalMessage->getFirstMediaUrl(
                                'principal_image'
                            );
                        }
                    @endphp

                    @if($principalImage)
                        <div class="principal-image-preview">

                            <img src="{{ $principalImage }}"
                                 alt="{{ $principalMessage->principal_name ?? 'Principal' }}">

                            <label class="remove-image-option">
                                <input type="checkbox"
                                       name="remove_principal_image"
                                       value="1"
                                       {{ old('remove_principal_image') ? 'checked' : '' }}>

                                <span>Remove current image</span>
                            </label>

                        </div>
                    @endif

                    @error('principal_image')
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

            </div>
        </div>

        {{-- PRINCIPAL MESSAGE --}}
        <div class="form-card principal-message-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-quote-left"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Principal Message
                    </p>

                    <p class="form-card-subtitle">
                        Manage message heading and complete content
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="title">
                        Message Heading
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $principalMessage->title ?? '') }}"
                               placeholder="Dear Students, Parents and Stakeholders,"
                               class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                    </div>

                    @error('title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="description">
                        Message Description
                    </label>

                    <textarea name="description"
                              id="description"
                              rows="12"
                              class="field-input {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $principalMessage->description ?? '') }}</textarea>

                    @error('description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- STATUS --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-toggle-on"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Section Visibility
                    </p>

                    <p class="form-card-subtitle">
                        Show or hide principal message section
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <label class="principal-status-box">

                    <input type="checkbox"
                           name="status"
                           value="1"
                           {{ old('status', $principalMessage->status ?? true) ? 'checked' : '' }}>

                    <span class="principal-status-content">
                        <strong>Show Principal Message Section</strong>

                        <small>
                            Disable this option to hide the section from the website.
                        </small>
                    </span>

                </label>

            </div>
        </div>

    </div>

    <div class="form-actions">

        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save Principal Message
        </button>

        <a href="{{ url()->previous() }}" class="btn-ghost">
            Cancel
        </a>

    </div>

</form>

<style>
    .principal-message-card {
        grid-column: 1 / -1;
    }

    .principal-image-preview {
        margin-top: 14px;
        padding: 14px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
    }

    .principal-image-preview img {
        width: 180px;
        height: 210px;
        display: block;
        object-fit: cover;
        object-position: top center;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
    }

    .remove-image-option {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 12px;
        color: #dc2626;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .remove-image-option input {
        width: 16px;
        height: 16px;
        accent-color: #dc2626;
    }

    .principal-status-box {
        min-height: 72px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        margin: 0;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        background: #f9fafb;
        color: #374151;
        cursor: pointer;
    }

    .principal-status-box > input {
        width: 17px;
        height: 17px;
        margin-top: 3px;
        flex-shrink: 0;
        accent-color: var(--accent, #4f46e5);
    }

    .principal-status-content {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .principal-status-content strong {
        color: #1f2937;
        font-size: 14px;
    }

    .principal-status-content small {
        color: #64748b;
        font-size: 12px;
        font-weight: 500;
        line-height: 1.5;
    }

    textarea.field-input {
        min-height: 220px;
        padding-top: 14px;
        resize: vertical;
    }

    .ck-editor__editable_inline {
        min-height: 320px;
    }

    .ck.ck-editor {
        width: 100%;
    }

    .ck.ck-toolbar {
        border-color: var(--border-color, #e5e7eb) !important;
        border-radius: 12px 12px 0 0 !important;
    }

    .ck.ck-editor__main > .ck-editor__editable {
        border-color: var(--border-color, #e5e7eb) !important;
        border-radius: 0 0 12px 12px !important;
    }

    @media (max-width: 768px) {
        .principal-message-card {
            grid-column: auto;
        }

        .principal-image-preview img {
            width: 150px;
            height: 180px;
        }
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editorElement = document.getElementById('description');

        if (editorElement && typeof ClassicEditor !== 'undefined') {
            ClassicEditor
                .create(editorElement, {
                    toolbar: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        '|',
                        'bulletedList',
                        'numberedList',
                        'blockQuote',
                        '|',
                        'undo',
                        'redo'
                    ]
                })
                .catch(function (error) {
                    console.error('CKEditor error:', error);
                });
        }

        const imageInput = document.getElementById('principal_image');

        if (imageInput) {
            imageInput.addEventListener('change', function () {
                const file = this.files[0];

                if (!file) {
                    return;
                }

                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                if (!allowedTypes.includes(file.type)) {
                    alert('Please select a JPG, JPEG, PNG or WEBP image.');
                    this.value = '';
                    return;
                }

                const maxSize = 5 * 1024 * 1024;

                if (file.size > maxSize) {
                    alert('Image size must not exceed 5 MB.');
                    this.value = '';
                }
            });
        }
    });
</script>

@endsection