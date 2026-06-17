@extends('layouts.admin')

@section('page-title', 'Add Syllabus Document')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.syllabus-documents.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Add Syllabus Document
        </h2>

        <p class="admin-page-subtitle">
            Create course-wise or subject-wise syllabus download
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
      action="{{ route('admin.syllabus-documents.store') }}"
      enctype="multipart/form-data">

    @csrf

    <div class="admin-form-grid">

        {{-- COURSE AND SUBJECT --}}
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
                                    {{ (string) old('course_id') === (string) $id ? 'selected' : '' }}>

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
                                        ->implode(',');
                                @endphp

                                <option value="{{ $subject->id }}"
                                        data-course-ids="{{ $courseIds }}"
                                    {{ (string) old('subject_id') === (string) $subject->id ? 'selected' : '' }}>

                                    {{ $subject->name }}
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
                            Leave blank for complete course syllabus.
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
                               value="{{ old('academic_session') }}"
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
                               value="{{ old('semester') }}"
                               placeholder="Semester I / Part I / All Semesters"
                               class="field-input {{ $errors->has('semester') ? 'error' : '' }}">
                    </div>

                    @error('semester')
                        <p class="field-error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- DOCUMENT INFORMATION --}}
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
                        Document title, slug and curriculum information
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
                               value="{{ old('title') }}"
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
                               value="{{ old('slug') }}"
                               placeholder="ba-semester-one-syllabus"
                               class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>

                    @error('slug')
                        <p class="field-error">
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            Leave blank to generate automatically.
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
                                class="field-input">

                            <option value="">
                                Select document type
                            </option>

                            @foreach($documentTypes as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('document_type') === $value ? 'selected' : '' }}>

                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="curriculum_type">
                        Curriculum Type
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-university icon"></i>

                        <select name="curriculum_type"
                                id="curriculum_type"
                                class="field-input">

                            <option value="">
                                Select curriculum
                            </option>

                            @foreach($curriculumTypes as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('curriculum_type') === $value ? 'selected' : '' }}>

                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>
                    </div>
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
                               value="{{ old('effective_from') }}"
                               placeholder="Session 2026-2027"
                               class="field-input">
                    </div>
                </div>

            </div>
        </div>

        {{-- FILE AND LINK --}}
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
                        Upload PDF or provide external syllabus URL
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
                            PDF only. Maximum 15 MB.
                        </p>
                    @enderror
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
                               value="{{ old('external_url') }}"
                               placeholder="https://university.example/syllabus.pdf"
                               class="field-input {{ $errors->has('external_url') ? 'error' : '' }}">
                    </div>

                    @error('external_url')
                        <p class="field-error">
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            Uploaded PDF gets priority over external URL.
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
                               value="{{ old('button_text') }}"
                               placeholder="Download BA Syllabus"
                               class="field-input">
                    </div>
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
                        Card description, ordering and visibility
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
                              class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description') }}</textarea>

                    @error('short_description')
                        <p class="field-error">
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
                               value="{{ old('sort_order', 0) }}"
                               min="0"
                               class="field-input">
                    </div>
                </div>

                <div class="syllabus-toggle-grid">

                    <label class="syllabus-status-box">
                        <input type="checkbox"
                               name="is_featured"
                               value="1"
                               {{ old('is_featured') ? 'checked' : '' }}>

                        <div>
                            <strong>Featured Syllabus</strong>

                            <p>
                                Featured syllabus appears first.
                            </p>
                        </div>
                    </label>

                    <label class="syllabus-status-box">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               {{ old('status', 1) ? 'checked' : '' }}>

                        <div>
                            <strong>Active Syllabus</strong>

                            <p>
                                Active syllabus appears on frontend.
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
            Save Syllabus
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
        resize: vertical;
        padding-top: 14px;
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
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    .syllabus-status-box input {
        width: 17px;
        height: 17px;
        margin-top: 3px;
    }

    .syllabus-status-box strong {
        display: block;
        color: #1f2937;
        font-size: 14px;
    }

    .syllabus-status-box p {
        margin: 3px 0 0;
        color: #64748b;
        font-size: 12px;
    }
</style>

@endsection

@section('scripts')
@parent

<script>
document.addEventListener('DOMContentLoaded', function () {

    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (titleInput && slugInput) {
        let slugManual = slugInput.value.trim() !== '';

        slugInput.addEventListener('input', function () {
            slugManual = this.value.trim() !== '';
        });

        titleInput.addEventListener('input', function () {
            if (slugManual) {
                return;
            }

            slugInput.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        });
    }

    const courseSelect =
        document.getElementById('course_id');

    const subjectSelect =
        document.getElementById('subject_id');

    function filterSubjects() {
        if (!courseSelect || !subjectSelect) {
            return;
        }

        const courseId = courseSelect.value;

        Array.from(subjectSelect.options)
            .forEach(function (option, index) {
                if (index === 0) {
                    option.hidden = false;
                    return;
                }

                const courseIds = (
                    option.dataset.courseIds || ''
                ).split(',').filter(Boolean);

                option.hidden =
                    courseId !== ''
                    && !courseIds.includes(courseId);

                if (
                    option.hidden
                    && option.selected
                ) {
                    subjectSelect.value = '';
                }
            });
    }

    courseSelect?.addEventListener(
        'change',
        filterSubjects
    );

    filterSubjects();

    const syllabusFile =
        document.getElementById('syllabus_file');

    syllabusFile?.addEventListener(
        'change',
        function () {
            const file = this.files[0];

            if (!file) {
                return;
            }

            const validPdf =
                file.type === 'application/pdf'
                || file.name.toLowerCase()
                    .endsWith('.pdf');

            if (!validPdf) {
                alert('Please select a valid PDF file.');
                this.value = '';
                return;
            }

            if (file.size > 15 * 1024 * 1024) {
                alert(
                    'Syllabus PDF must not exceed 15 MB.'
                );

                this.value = '';
            }
        }
    );

});
</script>

@endsection