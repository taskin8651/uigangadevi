@extends('layouts.admin')

@section('page-title', 'Edit Subject')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.subjects.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Subject
        </h2>

        <p class="admin-page-subtitle">
            Update subject details, course mapping, media and academic information
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
      action="{{ route('admin.subjects.update', $subject->id) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="admin-form-grid">

        {{-- SUBJECT INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-layer-group"></i>
                </div>

                <div>
                    <p class="form-card-title">Subject Information</p>
                    <p class="form-card-subtitle">
                        Basic subject and department details
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="name">
                        Subject Name <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-book icon"></i>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $subject->name) }}"
                               required
                               placeholder="History"
                               class="field-input {{ $errors->has('name') ? 'error' : '' }}">
                    </div>

                    @error('name')
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
                               value="{{ old('slug', $subject->slug) }}"
                               placeholder="history"
                               class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>

                    @error('slug')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="department_name">
                        Department Name
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-university icon"></i>

                        <input type="text"
                               name="department_name"
                               id="department_name"
                               value="{{ old('department_name', $subject->department_name) }}"
                               placeholder="Department of History"
                               class="field-input {{ $errors->has('department_name') ? 'error' : '' }}">
                    </div>

                    @error('department_name')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="short_name">
                        Short Name
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-font icon"></i>

                        <input type="text"
                               name="short_name"
                               id="short_name"
                               value="{{ old('short_name', $subject->short_name) }}"
                               placeholder="HIST"
                               class="field-input {{ $errors->has('short_name') ? 'error' : '' }}">
                    </div>

                    @error('short_name')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="short_description">
                        Short Description
                    </label>

                    <textarea name="short_description"
                              id="short_description"
                              rows="6"
                              placeholder="Enter a short subject description"
                              class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $subject->short_description) }}</textarea>

                    @error('short_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- MEDIA AND SETTINGS --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-photo-video"></i>
                </div>

                <div>
                    <p class="form-card-title">Media & Settings</p>
                    <p class="form-card-subtitle">
                        Subject image, syllabus, order and visibility
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="subject_image">
                        Subject Image
                    </label>

                    <input type="file"
                           name="subject_image"
                           id="subject_image"
                           accept=".jpg,.jpeg,.png,.webp"
                           class="field-input {{ $errors->has('subject_image') ? 'error' : '' }}">

                    @error('subject_image')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            Upload only when replacing the current image.
                        </p>
                    @enderror
                </div>

                @if($subject->image)
                    <div class="subject-image-preview current-subject-image">

                        <p class="subject-preview-label">
                            Current Image
                        </p>

                        <img src="{{ $subject->image }}"
                             alt="{{ $subject->name }}">

                        <label class="remove-media-option">
                            <input type="checkbox"
                                   name="remove_subject_image"
                                   value="1"
                                   {{ old('remove_subject_image') ? 'checked' : '' }}>

                            <span>Remove current image</span>
                        </label>

                    </div>
                @endif

                <div id="subjectImagePreview"
                     class="subject-image-preview"
                     style="display:none;">

                    <p class="subject-preview-label">
                        New Image Preview
                    </p>

                    <img id="subjectPreviewImage"
                         src=""
                         alt="New subject image preview">
                </div>

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
                    @enderror
                </div>

                @if($subject->syllabus)
                    <div class="current-syllabus-box">
                        <div>
                            <i class="fas fa-file-pdf"></i>

                            <div>
                                <strong>Current Syllabus</strong>

                                <a href="{{ $subject->syllabus['url'] }}"
                                   target="_blank"
                                   rel="noopener">
                                    {{ $subject->syllabus['name'] ?? 'View PDF' }}
                                </a>
                            </div>
                        </div>

                        <label class="remove-media-option">
                            <input type="checkbox"
                                   name="remove_syllabus_file"
                                   value="1"
                                   {{ old('remove_syllabus_file') ? 'checked' : '' }}>

                            <span>Remove syllabus</span>
                        </label>
                    </div>
                @endif

                <div class="field-group">
                    <label class="field-label" for="sort_order">
                        Sort Order
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-sort-numeric-down icon"></i>

                        <input type="number"
                               name="sort_order"
                               id="sort_order"
                               value="{{ old('sort_order', $subject->sort_order ?? 0) }}"
                               min="0"
                               class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                    </div>

                    @error('sort_order')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label">
                        Subject Status
                    </label>

                    <label class="subject-status-box">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               {{ old('status', $subject->status) ? 'checked' : '' }}>

                        <div>
                            <strong>Active Subject</strong>

                            <p>
                                Active subjects will appear on the frontend.
                            </p>
                        </div>
                    </label>
                </div>

            </div>
        </div>

        {{-- ASSIGNED COURSES --}}
        <div class="form-card">

            <div class="form-card-header between">
                <div class="form-card-head-left">
                    <div class="form-card-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>

                    <div>
                        <p class="form-card-title">Assigned Courses</p>
                        <p class="form-card-subtitle">
                            Update programmes offering this subject
                        </p>
                    </div>
                </div>

                <div class="form-mini-actions">
                    <button type="button"
                            class="btn-mini-primary"
                            data-check-all=".course-checkbox-item">
                        All
                    </button>

                    <button type="button"
                            class="btn-mini-ghost"
                            data-uncheck-all=".course-checkbox-item">
                        None
                    </button>
                </div>
            </div>

            <div class="form-card-body">

                @php
                    $selectedCourses = old(
                        'courses',
                        $subject->courses->pluck('id')->toArray()
                    );

                    $selectedCourses = array_map(
                        'intval',
                        $selectedCourses
                    );
                @endphp

                <div class="checkbox-grid">

                    @forelse($courses as $id => $course)
                        @php
                            $isSelected = in_array(
                                (int) $id,
                                $selectedCourses,
                                true
                            );
                        @endphp

                        <label class="course-checkbox-item {{ $isSelected ? 'checked' : '' }}">

                            <input type="checkbox"
                                   name="courses[]"
                                   value="{{ $id }}"
                                   class="course-checkbox"
                                   {{ $isSelected ? 'checked' : '' }}>

                            <div class="check-icon"></div>

                            <span class="checkbox-text">
                                {{ $course }}
                            </span>

                        </label>
                    @empty
                        <div class="subject-empty-box">
                            <i class="fas fa-info-circle"></i>
                            No active courses are available.
                        </div>
                    @endforelse

                </div>

                @error('courses')
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        This subject will appear under all selected courses.
                    </p>
                </div>

            </div>
        </div>

        {{-- SUBJECT OVERVIEW --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-align-left"></i>
                </div>

                <div>
                    <p class="form-card-title">Subject Overview</p>
                    <p class="form-card-subtitle">
                        Complete subject and department description
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="description">
                        Detailed Description
                    </label>

                    <textarea name="description"
                              id="description"
                              class="field-input {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $subject->description) }}</textarea>

                    @error('description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        @php
            $dynamicGroups = [
                'academic_areas' => [
                    'title'       => 'Academic Areas',
                    'subtitle'    => 'Topics and fields covered in this subject',
                    'icon'        => 'fas fa-book-reader',
                    'placeholder' => 'Ancient Indian History',
                    'items'       => old(
                        'academic_areas',
                        $subject->academic_areas ?? []
                    ),
                ],

                'learning_outcomes' => [
                    'title'       => 'Learning Outcomes',
                    'subtitle'    => 'Knowledge and skills students will develop',
                    'icon'        => 'fas fa-lightbulb',
                    'placeholder' => 'Develop analytical and critical understanding',
                    'items'       => old(
                        'learning_outcomes',
                        $subject->learning_outcomes ?? []
                    ),
                ],

                'career_opportunities' => [
                    'title'       => 'Career Opportunities',
                    'subtitle'    => 'Career and higher-study possibilities',
                    'icon'        => 'fas fa-briefcase',
                    'placeholder' => 'Teaching and academic research',
                    'items'       => old(
                        'career_opportunities',
                        $subject->career_opportunities ?? []
                    ),
                ],
            ];
        @endphp

        @foreach($dynamicGroups as $fieldName => $group)

            <div class="form-card subject-full-card">

                <div class="form-card-header between">
                    <div class="form-card-head-left">
                        <div class="form-card-icon">
                            <i class="{{ $group['icon'] }}"></i>
                        </div>

                        <div>
                            <p class="form-card-title">
                                {{ $group['title'] }}
                            </p>

                            <p class="form-card-subtitle">
                                {{ $group['subtitle'] }}
                            </p>
                        </div>
                    </div>

                    <div class="form-mini-actions">
                        <button type="button"
                                class="btn-mini-primary addGroupItem"
                                data-group="{{ $fieldName }}"
                                data-title="{{ $group['title'] }}"
                                data-placeholder="{{ $group['placeholder'] }}">

                            <i class="fas fa-plus"></i>
                            Add Item
                        </button>
                    </div>
                </div>

                <div class="form-card-body">

                    <div id="{{ $fieldName }}Wrapper">

                        @if(!empty($group['items']))
                            @foreach($group['items'] as $index => $item)

                                <div class="subject-list-row">

                                    <div class="field-group mb-0">
                                        <label class="field-label">
                                            {{ $group['title'] }} Item
                                        </label>

                                        <div class="input-icon-wrap">
                                            <i class="fas fa-check-circle icon"></i>

                                            <input type="text"
                                                   name="{{ $fieldName }}[{{ $index }}][text]"
                                                   value="{{ is_array($item) ? ($item['text'] ?? '') : $item }}"
                                                   placeholder="{{ $group['placeholder'] }}"
                                                   class="field-input">
                                        </div>
                                    </div>

                                    <label class="subject-list-status">
                                        <input type="checkbox"
                                               name="{{ $fieldName }}[{{ $index }}][status]"
                                               value="1"
                                               {{ is_array($item) ? (!empty($item['status']) ? 'checked' : '') : 'checked' }}>

                                        <span>Active</span>
                                    </label>

                                    <button type="button"
                                            class="remove-subject-item">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </div>

                            @endforeach
                        @else

                            <div class="subject-list-row">

                                <div class="field-group mb-0">
                                    <label class="field-label">
                                        {{ $group['title'] }} Item
                                    </label>

                                    <div class="input-icon-wrap">
                                        <i class="fas fa-check-circle icon"></i>

                                        <input type="text"
                                               name="{{ $fieldName }}[0][text]"
                                               placeholder="{{ $group['placeholder'] }}"
                                               class="field-input">
                                    </div>
                                </div>

                                <label class="subject-list-status">
                                    <input type="checkbox"
                                           name="{{ $fieldName }}[0][status]"
                                           value="1"
                                           checked>

                                    <span>Active</span>
                                </label>

                                <button type="button"
                                        class="remove-subject-item">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </div>

                        @endif

                    </div>

                    @error($fieldName)
                        <p class="field-error mt-2">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>
            </div>

        @endforeach

    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            {{ trans('global.save') }}
        </button>

        <a href="{{ route('admin.subjects.index') }}"
           class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>
    </div>

</form>
<style


@endsection