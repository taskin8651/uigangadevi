@extends('layouts.admin')

@section('page-title', 'Edit Syllabus Document')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.syllabus-documents.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Syllabus Document
        </h2>

        <p class="admin-page-subtitle">
            Update course-wise or subject-wise syllabus document and download settings
        </p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST"
      action="{{ route('admin.syllabus-documents.update', $syllabusDocument->id) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="admin-form-grid">

        {{-- PROGRAMME INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Programme Information
                    </p>

                    <p class="form-card-subtitle">
                        Select course, subject and academic session
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="course_id">
                        Course <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-book icon"></i>

                        <select name="course_id"
                                id="course_id"
                                required
                                class="field-input {{ $errors->has('course_id') ? 'error' : '' }}">

                            <option value="">
                                Select course
                            </option>

                            @foreach($courses as $id => $course)
                                <option value="{{ $id }}"
                                    {{ (string) old('course_id', $syllabusDocument->course_id) === (string) $id ? 'selected' : '' }}>

                                    {{ $course }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @error('course_id')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="subject_id">
                        Subject / Department
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-layer-group icon"></i>

                        <select name="subject_id"
                                id="subject_id"
                                class="field-input {{ $errors->has('subject_id') ? 'error' : '' }}">

                            <option value="">
                                Complete course syllabus
                            </option>

                            @foreach($subjects as $subject)
                                @php
                                    $courseIds = $subject->courses
                                        ->pluck('id')
                                        ->map(fn ($id) => (string) $id)
                                        ->implode(',');
                                @endphp

                                <option value="{{ $subject->id }}"
                                        data-course-ids="{{ $courseIds }}"
                                    {{ (string) old('subject_id', $syllabusDocument->subject_id) === (string) $subject->id ? 'selected' : '' }}>

                                    {{ $subject->name }}

                                    @if($subject->department_name)
                                        — {{ $subject->department_name }}
                                    @endif
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @error('subject_id')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Leave blank when this PDF contains the complete course syllabus.
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="academic_session">
                        Academic Session <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-calendar-alt icon"></i>

                        <input type="text"
                               name="academic_session"
                               id="academic_session"
                               value="{{ old('academic_session', $syllabusDocument->academic_session) }}"
                               required
                               placeholder="2026-2027"
                               class="field-input {{ $errors->has('academic_session') ? 'error' : '' }}">
                    </div>

                    @error('academic_session')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="semester">
                        Semester / Year
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-layer-group icon"></i>

                        <input type="text"
                               name="semester"
                               id="semester"
                               value="{{ old('semester', $syllabusDocument->semester) }}"
                               placeholder="Semester I / Part I / All Semesters"
                               class="field-input {{ $errors->has('semester') ? 'error' : '' }}">
                    </div>

                    @error('semester')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- SYLLABUS INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Syllabus Information
                    </p>

                    <p class="form-card-subtitle">
                        Update document title, slug and curriculum information
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="title">
                        Syllabus Title <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $syllabusDocument->title) }}"
                               required
                               placeholder="B.A. Semester I Syllabus"
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
                    <label class="field-label" for="slug">
                        Slug
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>

                        <input type="text"
                               name="slug"
                               id="slug"
                               value="{{ old('slug', $syllabusDocument->slug) }}"
                               placeholder="ba-semester-one-syllabus"
                               class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>

                    @error('slug')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            This value is used in the frontend syllabus URL.
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="document_type">
                        Document Type
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-file-signature icon"></i>

                        <select name="document_type"
                                id="document_type"
                                class="field-input {{ $errors->has('document_type') ? 'error' : '' }}">

                            <option value="">
                                Select document type
                            </option>

                            @foreach($documentTypes as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('document_type', $syllabusDocument->document_type) === $value ? 'selected' : '' }}>

                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @error('document_type')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="curriculum_type">
                        Curriculum Type
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-university icon"></i>

                        <select name="curriculum_type"
                                id="curriculum_type"
                                class="field-input {{ $errors->has('curriculum_type') ? 'error' : '' }}">

                            <option value="">
                                Select curriculum
                            </option>

                            @foreach($curriculumTypes as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('curriculum_type', $syllabusDocument->curriculum_type) === $value ? 'selected' : '' }}>

                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @error('curriculum_type')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="effective_from">
                        Effective From
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-clock icon"></i>

                        <input type="text"
                               name="effective_from"
                               id="effective_from"
                               value="{{ old('effective_from', $syllabusDocument->effective_from) }}"
                               placeholder="Session 2026-2027"
                               class="field-input {{ $errors->has('effective_from') ? 'error' : '' }}">
                    </div>

                    @error('effective_from')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- PDF AND EXTERNAL LINK --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        PDF & Download Link
                    </p>

                    <p class="form-card-subtitle">
                        Replace PDF or update the external syllabus URL
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="syllabus_file">
                        Syllabus PDF
                    </label>

                    <input type="file"
                           name="syllabus_file"
                           id="syllabus_file"
                           accept=".pdf,application/pdf"
                           class="field-input {{ $errors->has('syllabus_file') ? 'error' : '' }}">

                    @error('syllabus_file')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Upload a new PDF only when replacing the current file. Maximum 15 MB.
                        </p>
                    @enderror
                </div>

                @if($syllabusDocument->document)

                    <div class="syllabus-current-document">

                        <div class="syllabus-current-main">

                            <div class="syllabus-current-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>

                            <div class="syllabus-current-info">

                                <strong>
                                    Current Syllabus PDF
                                </strong>

                                <a href="{{ $syllabusDocument->document['url'] }}"
                                   target="_blank"
                                   rel="noopener">

                                    {{ $syllabusDocument->document['name'] ?? 'View current PDF' }}
                                </a>

                                @if(!empty($syllabusDocument->document['size']))
                                    <span>
                                        {{ number_format(
                                            $syllabusDocument->document['size'] / 1024,
                                            1
                                        ) }} KB
                                    </span>
                                @endif

                            </div>

                        </div>

                        <label class="syllabus-remove-file">

                            <input type="checkbox"
                                   name="remove_syllabus_file"
                                   value="1"
                                   {{ old('remove_syllabus_file') ? 'checked' : '' }}>

                            <span>
                                Remove current PDF
                            </span>

                        </label>

                    </div>

                @endif

                <div id="newPdfPreview"
                     class="syllabus-new-file-preview"
                     style="display:none;">

                    <div>
                        <i class="fas fa-file-pdf"></i>

                        <span>
                            Selected PDF:
                            <strong id="newPdfName"></strong>
                        </span>
                    </div>

                    <small id="newPdfSize"></small>
                </div>

                <div class="field-group">
                    <label class="field-label" for="external_url">
                        External URL
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-external-link-alt icon"></i>

                        <input type="url"
                               name="external_url"
                               id="external_url"
                               value="{{ old('external_url', $syllabusDocument->external_url) }}"
                               placeholder="https://university.example/syllabus.pdf"
                               class="field-input {{ $errors->has('external_url') ? 'error' : '' }}">
                    </div>

                    @error('external_url')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Uploaded PDF receives priority over the external URL.
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="button_text">
                        Download Button Text
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-mouse-pointer icon"></i>

                        <input type="text"
                               name="button_text"
                               id="button_text"
                               value="{{ old('button_text', $syllabusDocument->button_text) }}"
                               placeholder="Download BA Syllabus"
                               class="field-input {{ $errors->has('button_text') ? 'error' : '' }}">
                    </div>

                    @error('button_text')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- DESCRIPTION AND SETTINGS --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-cog"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Description & Settings
                    </p>

                    <p class="form-card-subtitle">
                        Card description, display priority and visibility
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="short_description">
                        Short Description
                    </label>

                    <textarea name="short_description"
                              id="short_description"
                              rows="7"
                              placeholder="Enter short syllabus information"
                              class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $syllabusDocument->short_description) }}</textarea>

                    @error('short_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="sort_order">
                        Sort Order
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-sort-numeric-down icon"></i>

                        <input type="number"
                               name="sort_order"
                               id="sort_order"
                               value="{{ old('sort_order', $syllabusDocument->sort_order ?? 0) }}"
                               min="0"
                               class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                    </div>

                    @error('sort_order')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            Lower values appear first after featured syllabus documents.
                        </p>
                    @enderror
                </div>

                <div class="syllabus-toggle-grid">

                    <label class="syllabus-status-box">

                        <input type="checkbox"
                               name="is_featured"
                               value="1"
                               {{ old('is_featured', $syllabusDocument->is_featured) ? 'checked' : '' }}>

                        <div>
                            <strong>
                                Featured Syllabus
                            </strong>

                            <p>
                                Featured syllabus documents receive priority on the frontend.
                            </p>
                        </div>

                    </label>

                    <label class="syllabus-status-box">

                        <input type="checkbox"
                               name="status"
                               value="1"
                               {{ old('status', $syllabusDocument->status) ? 'checked' : '' }}>

                        <div>
                            <strong>
                                Active Syllabus
                            </strong>

                            <p>
                                Active syllabus documents appear on the frontend website.
                            </p>
                        </div>

                    </label>

                </div>

            </div>
        </div>

    </div>

    <div class="form-actions">

        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Update Syllabus
        </button>

        <a href="{{ route('admin.syllabus-documents.index') }}"
           class="btn-ghost">
            Cancel
        </a>

    </div>

</form>

<style>
    textarea.field-input {
        min-height: 140px;
        padding-top: 14px;
        resize: vertical;
    }

    .syllabus-toggle-grid {
        display: grid;
        gap: 12px;
    }

    .syllabus-status-box {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px;
        margin: 0;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
        transition: .25s ease;
    }

    .syllabus-status-box:hover {
        border-color: #c7d2fe;
        background: #f8faff;
    }

    .syllabus-status-box > input {
        width: 17px;
        height: 17px;
        flex: 0 0 17px;
        margin-top: 3px;
        accent-color: var(--accent, #4f46e5);
    }

    .syllabus-status-box strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 14px;
    }

    .syllabus-status-box p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .syllabus-current-document {
        margin: 0 0 18px;
        padding: 14px;
        border: 1px solid #fecaca;
        border-radius: 14px;
        background: #fff7f7;
    }

    .syllabus-current-main {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .syllabus-current-icon {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #fee2e2;
        color: #dc2626;
        font-size: 21px;
    }

    .syllabus-current-info {
        min-width: 0;
        flex: 1;
    }

    .syllabus-current-info strong,
    .syllabus-current-info a,
    .syllabus-current-info span {
        display: block;
    }

    .syllabus-current-info strong {
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 13px;
    }

    .syllabus-current-info a {
        overflow: hidden;
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .syllabus-current-info a:hover {
        text-decoration: underline;
    }

    .syllabus-current-info span {
        margin-top: 3px;
        color: #64748b;
        font-size: 11px;
    }

    .syllabus-remove-file {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 12px;
        color: #dc2626;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .syllabus-remove-file input {
        width: 16px;
        height: 16px;
        accent-color: #dc2626;
    }

    .syllabus-new-file-preview {
        margin: 0 0 18px;
        padding: 13px 14px;
        border: 1px solid #bbf7d0;
        border-radius: 13px;
        background: #f0fdf4;
    }

    .syllabus-new-file-preview > div {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #166534;
        font-size: 12px;
    }

    .syllabus-new-file-preview > div > i {
        color: #dc2626;
        font-size: 18px;
    }

    .syllabus-new-file-preview strong {
        word-break: break-word;
    }

    .syllabus-new-file-preview small {
        display: block;
        margin-top: 5px;
        color: #64748b;
    }

    @media (max-width: 575px) {
        .syllabus-current-main {
            align-items: flex-start;
        }

        .syllabus-current-icon {
            width: 42px;
            height: 42px;
            flex-basis: 42px;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Slug Generation
    |--------------------------------------------------------------------------
    */

    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (titleInput && slugInput) {
        const originalSlug = slugInput.value.trim();

        let slugManuallyChanged = originalSlug !== '';

        slugInput.addEventListener('input', function () {
            slugManuallyChanged = this.value.trim() !== '';
        });

        /*
         * Existing slug ko automatically overwrite nahi kiya jayega.
         * Slug field manually blank karne ke baad title type karenge to
         * naya slug generate hoga.
         */
        titleInput.addEventListener('input', function () {
            if (slugManuallyChanged) {
                return;
            }

            slugInput.value = generateSlug(this.value);
        });
    }

    function generateSlug(value) {
        return String(value || '')
            .toLowerCase()
            .trim()
            .replace(/['’]/g, '')
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
    }


    /*
    |--------------------------------------------------------------------------
    | Course-wise Subject Filtering
    |--------------------------------------------------------------------------
    */

    const courseSelect = document.getElementById('course_id');
    const subjectSelect = document.getElementById('subject_id');

    function filterSubjects() {
        if (!courseSelect || !subjectSelect) {
            return;
        }

        const selectedCourseId = String(
            courseSelect.value || ''
        );

        const currentlySelectedSubjectId = String(
            subjectSelect.value || ''
        );

        let selectedSubjectAvailable = false;

        Array.from(subjectSelect.options).forEach(function (option, index) {

            /*
             * First option: Complete course syllabus
             */
            if (index === 0) {
                option.hidden = false;
                option.disabled = false;
                return;
            }

            const courseIds = String(
                option.dataset.courseIds || ''
            )
                .split(',')
                .map(function (id) {
                    return id.trim();
                })
                .filter(Boolean);

            const shouldShow =
                selectedCourseId === ''
                || courseIds.includes(selectedCourseId);

            option.hidden = !shouldShow;
            option.disabled = !shouldShow;

            if (
                shouldShow
                && String(option.value) === currentlySelectedSubjectId
            ) {
                selectedSubjectAvailable = true;
            }
        });

        if (
            currentlySelectedSubjectId !== ''
            && !selectedSubjectAvailable
        ) {
            subjectSelect.value = '';
        }
    }

    courseSelect?.addEventListener(
        'change',
        filterSubjects
    );

    filterSubjects();


    /*
    |--------------------------------------------------------------------------
    | PDF Validation and Preview
    |--------------------------------------------------------------------------
    */

    const syllabusFileInput =
        document.getElementById('syllabus_file');

    const newPdfPreview =
        document.getElementById('newPdfPreview');

    const newPdfName =
        document.getElementById('newPdfName');

    const newPdfSize =
        document.getElementById('newPdfSize');

    syllabusFileInput?.addEventListener(
        'change',
        function () {
            const file = this.files[0];

            if (!file) {
                hidePdfPreview();
                return;
            }

            const fileName = String(file.name || '');
            const validPdf =
                file.type === 'application/pdf'
                || fileName.toLowerCase().endsWith('.pdf');

            if (!validPdf) {
                alert('Please select a valid PDF file.');

                this.value = '';
                hidePdfPreview();
                return;
            }

            const maxSize = 15 * 1024 * 1024;

            if (file.size > maxSize) {
                alert(
                    'Syllabus PDF must not exceed 15 MB.'
                );

                this.value = '';
                hidePdfPreview();
                return;
            }

            if (
                newPdfPreview
                && newPdfName
                && newPdfSize
            ) {
                newPdfName.textContent = file.name;

                newPdfSize.textContent =
                    formatFileSize(file.size);

                newPdfPreview.style.display = 'block';
            }
        }
    );

    function hidePdfPreview() {
        if (newPdfPreview) {
            newPdfPreview.style.display = 'none';
        }

        if (newPdfName) {
            newPdfName.textContent = '';
        }

        if (newPdfSize) {
            newPdfSize.textContent = '';
        }
    }

    function formatFileSize(bytes) {
        const size = Number(bytes || 0);

        if (size < 1024) {
            return size + ' bytes';
        }

        if (size < 1024 * 1024) {
            return (size / 1024).toFixed(1) + ' KB';
        }

        return (
            size / (1024 * 1024)
        ).toFixed(2) + ' MB';
    }


    /*
    |--------------------------------------------------------------------------
    | PDF Remove and Replace Behaviour
    |--------------------------------------------------------------------------
    */

    const removeFileCheckbox =
        document.querySelector(
            'input[name="remove_syllabus_file"]'
        );

    /*
     * New PDF select karne par remove checkbox uncheck hoga,
     * kyunki new file current file ko replace karegi.
     */
    syllabusFileInput?.addEventListener(
        'change',
        function () {
            if (
                this.files.length
                && removeFileCheckbox
            ) {
                removeFileCheckbox.checked = false;
            }
        }
    );

    /*
     * Remove checkbox select karne par selected replacement PDF clear hoga.
     */
    removeFileCheckbox?.addEventListener(
        'change',
        function () {
            if (
                this.checked
                && syllabusFileInput
            ) {
                syllabusFileInput.value = '';
                hidePdfPreview();
            }
        }
    );


    /*
    |--------------------------------------------------------------------------
    | External URL Basic Validation
    |--------------------------------------------------------------------------
    */

    const externalUrlInput =
        document.getElementById('external_url');

    externalUrlInput?.addEventListener(
        'blur',
        function () {
            const value = this.value.trim();

            if (value === '') {
                return;
            }

            try {
                const url = new URL(value);

                if (
                    url.protocol !== 'http:'
                    && url.protocol !== 'https:'
                ) {
                    throw new Error('Invalid protocol');
                }

                this.classList.remove('error');
            } catch (error) {
                this.classList.add('error');
            }
        }
    );

});
</script>

@endsection