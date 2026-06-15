@extends('layouts.admin')

@section('page-title', 'Add Course')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.courses.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Add Course
        </h2>

        <p class="admin-page-subtitle">
            Fill in the details to create a new academic course
        </p>
    </div>
</div>

<form method="POST"
      action="{{ route('admin.courses.store') }}"
      enctype="multipart/form-data">

    @csrf

    <div class="admin-form-grid">

        {{-- COURSE INFORMATION --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Course Information
                    </p>

                    <p class="form-card-subtitle">
                        Basic academic programme details
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                {{-- COURSE NAME --}}
                <div class="field-group">
                    <label class="field-label" for="name">
                        Course Name <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-book-open icon"></i>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               required
                               placeholder="Bachelor of Arts"
                               class="field-input {{ $errors->has('name') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('name'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                {{-- SLUG --}}
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
                               placeholder="bachelor-of-arts"
                               class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('slug'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('slug') }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Leave blank to generate automatically from course name.
                        </p>
                    @endif
                </div>

                {{-- SHORT NAME --}}
                <div class="field-group">
                    <label class="field-label" for="short_name">
                        Short Name
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-font icon"></i>

                        <input type="text"
                               name="short_name"
                               id="short_name"
                               value="{{ old('short_name') }}"
                               placeholder="B.A."
                               class="field-input {{ $errors->has('short_name') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('short_name'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('short_name') }}
                        </p>
                    @endif
                </div>

                {{-- LEVEL --}}
                <div class="field-group">
                    <label class="field-label" for="level">
                        Programme Level
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-layer-group icon"></i>

                        <select name="level"
                                id="level"
                                class="field-input {{ $errors->has('level') ? 'error' : '' }}">

                            <option value="">
                                Select programme level
                            </option>

                            <option value="Undergraduate"
                                {{ old('level') === 'Undergraduate' ? 'selected' : '' }}>
                                Undergraduate
                            </option>

                            <option value="Postgraduate"
                                {{ old('level') === 'Postgraduate' ? 'selected' : '' }}>
                                Postgraduate
                            </option>

                            <option value="Diploma"
                                {{ old('level') === 'Diploma' ? 'selected' : '' }}>
                                Diploma
                            </option>

                            <option value="Certificate"
                                {{ old('level') === 'Certificate' ? 'selected' : '' }}>
                                Certificate
                            </option>

                        </select>
                    </div>

                    @if($errors->has('level'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('level') }}
                        </p>
                    @endif
                </div>

                {{-- DURATION --}}
                <div class="field-group">
                    <label class="field-label" for="duration">
                        Duration
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-clock icon"></i>

                        <input type="text"
                               name="duration"
                               id="duration"
                               value="{{ old('duration') }}"
                               placeholder="4 Years"
                               class="field-input {{ $errors->has('duration') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('duration'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('duration') }}
                        </p>
                    @endif
                </div>

                {{-- COURSE TYPE --}}
                <div class="field-group">
                    <label class="field-label" for="course_type">
                        Course Type
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-book-reader icon"></i>

                        <input type="text"
                               name="course_type"
                               id="course_type"
                               value="{{ old('course_type') }}"
                               placeholder="Regular"
                               class="field-input {{ $errors->has('course_type') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('course_type'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('course_type') }}
                        </p>
                    @endif
                </div>

            </div>
        </div>

        {{-- IMAGE AND SETTINGS --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-image"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Image & Settings
                    </p>

                    <p class="form-card-subtitle">
                        Course image, visibility and display order
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                {{-- COURSE IMAGE --}}
                <div class="field-group">
                    <label class="field-label" for="course_image">
                        Course Image
                    </label>

                    <input type="file"
                           name="course_image"
                           id="course_image"
                           accept=".jpg,.jpeg,.png,.webp"
                           class="field-input {{ $errors->has('course_image') ? 'error' : '' }}">

                    @if($errors->has('course_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('course_image') }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            JPG, JPEG, PNG or WEBP. Maximum size 5 MB.
                        </p>
                    @endif
                </div>

                <div id="courseImagePreview"
                     class="course-image-preview"
                     style="display:none;">

                    <img id="coursePreviewImage"
                         src=""
                         alt="Course image preview">
                </div>

                {{-- SORT ORDER --}}
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
                               placeholder="0"
                               class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('sort_order'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('sort_order') }}
                        </p>
                    @else
                        <p class="field-hint">
                            Lower values will appear first.
                        </p>
                    @endif
                </div>

                {{-- STATUS --}}
                <div class="field-group">
                    <label class="field-label">
                        Course Status
                    </label>

                    <label class="course-status-box">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               {{ old('status', 1) ? 'checked' : '' }}>

                        <div>
                            <strong>Active Course</strong>

                            <p>
                                Active courses will be visible on the frontend.
                            </p>
                        </div>
                    </label>
                </div>

            </div>
        </div>

        {{-- SHORT DESCRIPTION --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-align-left"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Course Summary
                    </p>

                    <p class="form-card-subtitle">
                        Short description displayed on course cards
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
                              rows="8"
                              placeholder="Enter a short description of the course"
                              class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description') }}</textarea>

                    @if($errors->has('short_description'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('short_description') }}
                        </p>
                    @else
                        <p class="field-hint">
                            This content will appear on the frontend course listing card.
                        </p>
                    @endif
                </div>

            </div>
        </div>

        {{-- ASSIGNED SUBJECTS --}}
        <div class="form-card">
            <div class="form-card-header between">

                <div class="form-card-head-left">
                    <div class="form-card-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>

                    <div>
                        <p class="form-card-title">
                            Assigned Subjects
                        </p>

                        <p class="form-card-subtitle">
                            Select subjects available in this course
                        </p>
                    </div>
                </div>

                <div class="form-mini-actions">
                    <button type="button"
                            class="btn-mini-primary"
                            data-check-all=".subject-checkbox-item">
                        All
                    </button>

                    <button type="button"
                            class="btn-mini-ghost"
                            data-uncheck-all=".subject-checkbox-item">
                        None
                    </button>
                </div>
            </div>

            <div class="form-card-body">

                <div class="checkbox-grid">

                    @forelse($subjects as $id => $subject)
                        <label class="subject-checkbox-item {{ in_array($id, old('subjects', [])) ? 'checked' : '' }}">

                            <input type="checkbox"
                                   name="subjects[]"
                                   value="{{ $id }}"
                                   class="subject-checkbox"
                                   {{ in_array($id, old('subjects', [])) ? 'checked' : '' }}>

                            <div class="check-icon"></div>

                            <span class="checkbox-text">
                                {{ $subject }}
                            </span>

                        </label>
                    @empty
                        <div class="course-empty-box">
                            <i class="fas fa-info-circle"></i>
                            No active subjects are available. Create subjects first.
                        </div>
                    @endforelse

                </div>

                @if($errors->has('subjects'))
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('subjects') }}
                    </p>
                @endif

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Selected subjects will appear on this course's frontend detail page.
                    </p>
                </div>

            </div>
        </div>

        {{-- DETAILED COURSE CONTENT --}}
        <div class="form-card course-full-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Detailed Course Content
                    </p>

                    <p class="form-card-subtitle">
                        Course overview, eligibility and admission process
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                {{-- DESCRIPTION --}}
                <div class="field-group">
                    <label class="field-label" for="description">
                        Course Overview
                    </label>

                    <textarea name="description"
                              id="description"
                              class="field-input {{ $errors->has('description') ? 'error' : '' }}">{{ old('description') }}</textarea>

                    @if($errors->has('description'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>

                {{-- ELIGIBILITY --}}
                <div class="field-group">
                    <label class="field-label" for="eligibility">
                        Eligibility
                    </label>

                    <textarea name="eligibility"
                              id="eligibility"
                              class="field-input {{ $errors->has('eligibility') ? 'error' : '' }}">{{ old('eligibility') }}</textarea>

                    @if($errors->has('eligibility'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('eligibility') }}
                        </p>
                    @endif
                </div>

                {{-- ADMISSION PROCESS --}}
                <div class="field-group">
                    <label class="field-label" for="admission_process">
                        Admission Process
                    </label>

                    <textarea name="admission_process"
                              id="admission_process"
                              class="field-input {{ $errors->has('admission_process') ? 'error' : '' }}">{{ old('admission_process') }}</textarea>

                    @if($errors->has('admission_process'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('admission_process') }}
                        </p>
                    @endif
                </div>

            </div>
        </div>

        {{-- COURSE HIGHLIGHTS --}}
        <div class="form-card course-full-card">
            <div class="form-card-header between">

                <div class="form-card-head-left">
                    <div class="form-card-icon">
                        <i class="fas fa-list-check"></i>
                    </div>

                    <div>
                        <p class="form-card-title">
                            Course Highlights
                        </p>

                        <p class="form-card-subtitle">
                            Add important features of this programme
                        </p>
                    </div>
                </div>

                <div class="form-mini-actions">
                    <button type="button"
                            class="btn-mini-primary"
                            id="addHighlightBtn">
                        <i class="fas fa-plus"></i>
                        Add Highlight
                    </button>
                </div>

            </div>

            <div class="form-card-body">

                @php
                    $highlights = old('highlights', []);
                @endphp

                <div id="highlightsWrapper">

                    @if(!empty($highlights))
                        @foreach($highlights as $index => $highlight)

                            <div class="course-highlight-row">

                                <div class="field-group mb-0">
                                    <label class="field-label">
                                        Highlight Text
                                    </label>

                                    <div class="input-icon-wrap">
                                        <i class="fas fa-check-circle icon"></i>

                                        <input type="text"
                                               name="highlights[{{ $index }}][text]"
                                               value="{{ $highlight['text'] ?? '' }}"
                                               placeholder="University prescribed syllabus"
                                               class="field-input">
                                    </div>
                                </div>

                                <label class="highlight-status">
                                    <input type="checkbox"
                                           name="highlights[{{ $index }}][status]"
                                           value="1"
                                           {{ !empty($highlight['status']) ? 'checked' : '' }}>

                                    <span>Active</span>
                                </label>

                                <button type="button"
                                        class="remove-highlight-btn">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </div>

                        @endforeach
                    @else

                        <div class="course-highlight-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Highlight Text
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="highlights[0][text]"
                                           placeholder="University prescribed syllabus"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="highlight-status">
                                <input type="checkbox"
                                       name="highlights[0][status]"
                                       value="1"
                                       checked>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="remove-highlight-btn">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>

                    @endif

                </div>

                @if($errors->has('highlights'))
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('highlights') }}
                    </p>
                @endif

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Active highlights will appear as check-list items on the course card and details page.
                    </p>
                </div>

            </div>
        </div>

    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            {{ trans('global.save') }}
        </button>

        <a href="{{ route('admin.courses.index') }}"
           class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>
    </div>

</form>

<style>
    .course-full-card {
        grid-column: 1 / -1;
    }

    .course-image-preview {
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
    }

    .course-image-preview img {
        width: 100%;
        max-width: 240px;
        height: 160px;
        display: block;
        object-fit: cover;
        border-radius: 12px;
    }

    .course-status-box {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    .course-status-box > input {
        width: 17px;
        height: 17px;
        flex-shrink: 0;
        margin-top: 3px;
        accent-color: var(--accent, #4f46e5);
    }

    .course-status-box strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 14px;
    }

    .course-status-box p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .course-empty-box {
        grid-column: 1 / -1;
        padding: 18px;
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        background: #f8fafc;
        color: #64748b;
        font-size: 13px;
        text-align: center;
    }

    .course-highlight-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 120px 48px;
        gap: 12px;
        align-items: end;
        padding: 14px;
        margin-bottom: 12px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
    }

    .highlight-status {
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        margin: 0;
        padding: 0 12px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 12px;
        background: #ffffff;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .highlight-status input {
        width: 16px;
        height: 16px;
        accent-color: var(--accent, #4f46e5);
    }

    .remove-highlight-btn {
        width: 48px;
        height: 48px;
        border: 0;
        border-radius: 12px;
        background: #fee2e2;
        color: #dc2626;
        cursor: pointer;
        transition: .25s ease;
    }

    .remove-highlight-btn:hover {
        color: #ffffff;
        background: #dc2626;
        transform: translateY(-2px);
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    .mt-2 {
        margin-top: 8px !important;
    }

    textarea.field-input {
        min-height: 130px;
        padding-top: 14px;
        resize: vertical;
    }

    .ck.ck-editor {
        width: 100%;
    }

    .ck-editor__editable_inline {
        min-height: 260px;
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
        .course-full-card {
            grid-column: auto;
        }

        .course-highlight-row {
            grid-template-columns: 1fr;
            align-items: stretch;
        }

        .highlight-status {
            justify-content: flex-start;
            padding: 0 14px;
        }

        .remove-highlight-btn {
            width: 100%;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* CKEditor */
    [
        '#description',
        '#eligibility',
        '#admission_process'
    ].forEach(function (selector) {
        const editorElement = document.querySelector(selector);

        if (
            editorElement &&
            typeof ClassicEditor !== 'undefined'
        ) {
            ClassicEditor
                .create(editorElement, {
                    toolbar: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'blockQuote',
                        'undo',
                        'redo'
                    ]
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    });

    /* Course name to slug */
    const courseName = document.getElementById('name');
    const courseSlug = document.getElementById('slug');
    let slugEdited = courseSlug.value.trim() !== '';

    courseSlug.addEventListener('input', function () {
        slugEdited = this.value.trim() !== '';
    });

    courseName.addEventListener('input', function () {
        if (slugEdited) {
            return;
        }

        courseSlug.value = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    });

    /* Select all and none subjects */
    document.querySelectorAll('[data-check-all]').forEach(function (button) {
        button.addEventListener('click', function () {
            document.querySelectorAll(
                this.dataset.checkAll + ' input[type="checkbox"]'
            ).forEach(function (checkbox) {
                checkbox.checked = true;

                checkbox
                    .closest('.subject-checkbox-item')
                    ?.classList.add('checked');
            });
        });
    });

    document.querySelectorAll('[data-uncheck-all]').forEach(function (button) {
        button.addEventListener('click', function () {
            document.querySelectorAll(
                this.dataset.uncheckAll + ' input[type="checkbox"]'
            ).forEach(function (checkbox) {
                checkbox.checked = false;

                checkbox
                    .closest('.subject-checkbox-item')
                    ?.classList.remove('checked');
            });
        });
    });

    document.addEventListener('change', function (event) {
        if (!event.target.matches('.subject-checkbox')) {
            return;
        }

        event.target
            .closest('.subject-checkbox-item')
            ?.classList.toggle(
                'checked',
                event.target.checked
            );
    });

    /* Add highlights */
    const highlightsWrapper = document.getElementById(
        'highlightsWrapper'
    );

    const addHighlightButton = document.getElementById(
        'addHighlightBtn'
    );

    addHighlightButton.addEventListener('click', function () {
        const index = Date.now();

        highlightsWrapper.insertAdjacentHTML('beforeend', `
            <div class="course-highlight-row">

                <div class="field-group mb-0">
                    <label class="field-label">
                        Highlight Text
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-check-circle icon"></i>

                        <input type="text"
                               name="highlights[${index}][text]"
                               placeholder="Enter course highlight"
                               class="field-input">
                    </div>
                </div>

                <label class="highlight-status">
                    <input type="checkbox"
                           name="highlights[${index}][status]"
                           value="1"
                           checked>

                    <span>Active</span>
                </label>

                <button type="button"
                        class="remove-highlight-btn">
                    <i class="fas fa-trash"></i>
                </button>

            </div>
        `);
    });

    document.addEventListener('click', function (event) {
        const removeButton = event.target.closest(
            '.remove-highlight-btn'
        );

        if (!removeButton) {
            return;
        }

        const highlightRow = removeButton.closest(
            '.course-highlight-row'
        );

        if (highlightRow) {
            highlightRow.remove();
        }
    });

    /* Image preview */
    const imageInput = document.getElementById('course_image');
    const imagePreviewBox = document.getElementById(
        'courseImagePreview'
    );
    const imagePreview = document.getElementById(
        'coursePreviewImage'
    );

    imageInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            imagePreviewBox.style.display = 'none';
            imagePreview.src = '';
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
            imagePreviewBox.style.display = 'none';
            return;
        }

        const maximumSize = 5 * 1024 * 1024;

        if (file.size > maximumSize) {
            alert('Course image must not exceed 5 MB.');

            this.value = '';
            imagePreviewBox.style.display = 'none';
            return;
        }

        imagePreview.src = URL.createObjectURL(file);
        imagePreviewBox.style.display = 'block';
    });

});
</script>
@endsection