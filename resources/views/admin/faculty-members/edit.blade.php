@extends('layouts.admin')

@section('page-title', 'Edit Faculty Member')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.faculty-members.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Faculty Member
        </h2>

        <p class="admin-page-subtitle">
            Update complete academic and professional faculty profile
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
      action="{{ route('admin.faculty-members.update', $facultyMember->id) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="admin-form-grid">

        {{-- BASIC INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-user-tie"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Faculty Information
                    </p>

                    <p class="form-card-subtitle">
                        Basic academic and professional details
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="name">
                        Faculty Name <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-user icon"></i>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $facultyMember->name) }}"
                               required
                               placeholder="Dr. Anjali Kumari"
                               class="field-input {{ $errors->has('name') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('name'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="slug">
                        Profile Slug
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>

                        <input type="text"
                               name="slug"
                               id="slug"
                               value="{{ old('slug', $facultyMember->slug) }}"
                               placeholder="dr-anjali-kumari"
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
                            This slug is used in the frontend faculty profile URL.
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="designation">
                        Designation
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-id-badge icon"></i>

                        <input type="text"
                               name="designation"
                               id="designation"
                               value="{{ old('designation', $facultyMember->designation) }}"
                               placeholder="Assistant Professor"
                               class="field-input {{ $errors->has('designation') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('designation'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('designation') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="employee_id">
                        Employee ID
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-id-card icon"></i>

                        <input type="text"
                               name="employee_id"
                               id="employee_id"
                               value="{{ old('employee_id', $facultyMember->employee_id) }}"
                               placeholder="GDMM-FAC-001"
                               class="field-input {{ $errors->has('employee_id') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('employee_id'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('employee_id') }}
                        </p>
                    @endif
                </div>

            </div>
        </div>

        {{-- DEPARTMENT AND CATEGORY --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-university"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Department & Category
                    </p>

                    <p class="form-card-subtitle">
                        Assign faculty department and academic category
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="subject_id">
                        Department / Subject
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-book icon"></i>

                        <select name="subject_id"
                                id="subject_id"
                                class="field-input {{ $errors->has('subject_id') ? 'error' : '' }}">

                            <option value="">
                                Select department
                            </option>

                            @foreach($subjects as $id => $subject)
                                <option value="{{ $id }}"
                                    {{ (string) old('subject_id', $facultyMember->subject_id) === (string) $id ? 'selected' : '' }}>
                                    {{ $subject }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @if($errors->has('subject_id'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('subject_id') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="faculty_category">
                        Faculty Category
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-tags icon"></i>

                        <select name="faculty_category"
                                id="faculty_category"
                                class="field-input {{ $errors->has('faculty_category') ? 'error' : '' }}">

                            <option value="">
                                Select category
                            </option>

                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('faculty_category', $facultyMember->faculty_category) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @if($errors->has('faculty_category'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('faculty_category') }}
                        </p>
                    @endif
                </div>

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Department is connected with the Subject module. Category is used for frontend filtering.
                    </p>
                </div>

            </div>
        </div>

        {{-- CONTACT INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-address-book"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Contact Information
                    </p>

                    <p class="form-card-subtitle">
                        Faculty email and phone information
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="email">
                        Email Address
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-envelope icon"></i>

                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email', $facultyMember->email) }}"
                               placeholder="faculty@gdmm.ac.in"
                               class="field-input {{ $errors->has('email') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('email'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="phone">
                        Phone Number
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-phone icon"></i>

                        <input type="text"
                               name="phone"
                               id="phone"
                               value="{{ old('phone', $facultyMember->phone) }}"
                               placeholder="+91 98765 43210"
                               class="field-input {{ $errors->has('phone') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('phone'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>

            </div>
        </div>

        {{-- EXPERIENCE INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-briefcase"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Experience Information
                    </p>

                    <p class="form-card-subtitle">
                        Joining date and academic experience
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="joining_date">
                        Joining Date
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-calendar-alt icon"></i>

                        <input type="date"
                               name="joining_date"
                               id="joining_date"
                               value="{{ old(
                                   'joining_date',
                                   $facultyMember->joining_date
                                       ? $facultyMember->joining_date->format('Y-m-d')
                                       : ''
                               ) }}"
                               class="field-input {{ $errors->has('joining_date') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('joining_date'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('joining_date') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="teaching_experience">
                        Teaching Experience
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-chalkboard-teacher icon"></i>

                        <input type="text"
                               name="teaching_experience"
                               id="teaching_experience"
                               value="{{ old('teaching_experience', $facultyMember->teaching_experience) }}"
                               placeholder="12 Years"
                               class="field-input {{ $errors->has('teaching_experience') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('teaching_experience'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('teaching_experience') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="research_experience">
                        Research Experience
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-microscope icon"></i>

                        <input type="text"
                               name="research_experience"
                               id="research_experience"
                               value="{{ old('research_experience', $facultyMember->research_experience) }}"
                               placeholder="8 Years"
                               class="field-input {{ $errors->has('research_experience') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('research_experience'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('research_experience') }}
                        </p>
                    @endif
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
                    <p class="form-card-title">
                        Media & Settings
                    </p>

                    <p class="form-card-subtitle">
                        Faculty image, CV and frontend visibility
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="faculty_image">
                        Faculty Photograph
                    </label>

                    <input type="file"
                           name="faculty_image"
                           id="faculty_image"
                           accept=".jpg,.jpeg,.png,.webp"
                           class="field-input {{ $errors->has('faculty_image') ? 'error' : '' }}">

                    @if($errors->has('faculty_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('faculty_image') }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Upload a new image only when replacing the existing photograph.
                        </p>
                    @endif
                </div>

                @if($facultyMember->image)
                    <div class="faculty-image-preview current-faculty-media">

                        <p class="faculty-preview-title">
                            Current Photograph
                        </p>

                        <img src="{{ $facultyMember->image }}"
                             alt="{{ $facultyMember->name }}">

                        <label class="remove-media-option">
                            <input type="checkbox"
                                   name="remove_faculty_image"
                                   value="1"
                                   {{ old('remove_faculty_image') ? 'checked' : '' }}>

                            <span>Remove current photograph</span>
                        </label>

                    </div>
                @endif

                <div id="facultyImagePreview"
                     class="faculty-image-preview"
                     style="display:none;">

                    <p class="faculty-preview-title">
                        New Photograph Preview
                    </p>

                    <img id="facultyPreviewImage"
                         src=""
                         alt="New faculty image preview">
                </div>

                <div class="field-group">
                    <label class="field-label" for="faculty_cv">
                        Faculty CV
                    </label>

                    <input type="file"
                           name="faculty_cv"
                           id="faculty_cv"
                           accept=".pdf,application/pdf"
                           class="field-input {{ $errors->has('faculty_cv') ? 'error' : '' }}">

                    @if($errors->has('faculty_cv'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('faculty_cv') }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-file-pdf"></i>
                            Upload a new PDF only when replacing the current CV.
                        </p>
                    @endif
                </div>

                @if($facultyMember->cv)
                    <div class="faculty-current-cv">

                        <div class="faculty-current-cv-main">
                            <i class="fas fa-file-pdf"></i>

                            <div>
                                <strong>Current CV</strong>

                                <a href="{{ $facultyMember->cv['url'] }}"
                                   target="_blank"
                                   rel="noopener">
                                    {{ $facultyMember->cv['name'] ?? 'View CV' }}
                                </a>
                            </div>
                        </div>

                        <label class="remove-media-option">
                            <input type="checkbox"
                                   name="remove_faculty_cv"
                                   value="1"
                                   {{ old('remove_faculty_cv') ? 'checked' : '' }}>

                            <span>Remove current CV</span>
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
                               min="0"
                               value="{{ old('sort_order', $facultyMember->sort_order ?? 0) }}"
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

                <label class="faculty-status-box">
                    <input type="checkbox"
                           name="status"
                           value="1"
                           {{ old('status', $facultyMember->status) ? 'checked' : '' }}>

                    <div>
                        <strong>Active Faculty Member</strong>

                        <p>
                            Active faculty profiles will appear on the frontend website.
                        </p>
                    </div>
                </label>

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
                        Short Introduction
                    </p>

                    <p class="form-card-subtitle">
                        Short description displayed on faculty cards
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
                              rows="9"
                              placeholder="Enter a short professional introduction"
                              class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $facultyMember->short_description) }}</textarea>

                    @if($errors->has('short_description'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('short_description') }}
                        </p>
                    @else
                        <p class="field-hint">
                            This introduction will appear on faculty listing cards.
                        </p>
                    @endif
                </div>

            </div>
        </div>

        {{-- BIOGRAPHY --}}
        <div class="form-card faculty-full-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Faculty Biography
                    </p>

                    <p class="form-card-subtitle">
                        Complete academic and professional faculty profile
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="biography">
                        Biography
                    </label>

                    <textarea name="biography"
                              id="biography"
                              class="field-input {{ $errors->has('biography') ? 'error' : '' }}">{{ old('biography', $facultyMember->biography) }}</textarea>

                    @if($errors->has('biography'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('biography') }}
                        </p>
                    @endif
                </div>

            </div>
        </div>

        @php
            $facultyGroups = [
                'qualifications' => [
                    'title' => 'Qualifications',
                    'subtitle' => 'Academic degrees and qualifications',
                    'icon' => 'fas fa-graduation-cap',
                    'placeholder' => 'M.A. in Hindi',
                    'items' => old(
                        'qualifications',
                        $facultyMember->qualifications ?? []
                    ),
                ],

                'specializations' => [
                    'title' => 'Specializations',
                    'subtitle' => 'Faculty specialization and expertise',
                    'icon' => 'fas fa-star',
                    'placeholder' => 'Modern Hindi Literature',
                    'items' => old(
                        'specializations',
                        $facultyMember->specializations ?? []
                    ),
                ],

                'subjects_taught' => [
                    'title' => 'Subjects Taught',
                    'subtitle' => 'Subjects and papers taught by faculty',
                    'icon' => 'fas fa-book',
                    'placeholder' => 'Hindi Poetry and Prose',
                    'items' => old(
                        'subjects_taught',
                        $facultyMember->subjects_taught ?? []
                    ),
                ],

                'research_interests' => [
                    'title' => 'Research Interests',
                    'subtitle' => 'Major areas of academic research',
                    'icon' => 'fas fa-microscope',
                    'placeholder' => 'Women in Hindi Literature',
                    'items' => old(
                        'research_interests',
                        $facultyMember->research_interests ?? []
                    ),
                ],

                'publications' => [
                    'title' => 'Publications',
                    'subtitle' => 'Research papers, books and articles',
                    'icon' => 'fas fa-file-alt',
                    'placeholder' => 'Research paper title and publication details',
                    'items' => old(
                        'publications',
                        $facultyMember->publications ?? []
                    ),
                ],

                'awards' => [
                    'title' => 'Awards & Achievements',
                    'subtitle' => 'Academic awards and professional achievements',
                    'icon' => 'fas fa-award',
                    'placeholder' => 'Best Teacher Award',
                    'items' => old(
                        'awards',
                        $facultyMember->awards ?? []
                    ),
                ],

                'responsibilities' => [
                    'title' => 'Administrative Responsibilities',
                    'subtitle' => 'College committees and institutional duties',
                    'icon' => 'fas fa-tasks',
                    'placeholder' => 'Member, Admission Committee',
                    'items' => old(
                        'responsibilities',
                        $facultyMember->responsibilities ?? []
                    ),
                ],

                'memberships' => [
                    'title' => 'Professional Memberships',
                    'subtitle' => 'Memberships in academic organizations',
                    'icon' => 'fas fa-users',
                    'placeholder' => 'Member of Indian History Congress',
                    'items' => old(
                        'memberships',
                        $facultyMember->memberships ?? []
                    ),
                ],

                'seminars' => [
                    'title' => 'Seminars & Conferences',
                    'subtitle' => 'Seminars, workshops and conferences attended',
                    'icon' => 'fas fa-chalkboard-teacher',
                    'placeholder' => 'Presented paper at national seminar',
                    'items' => old(
                        'seminars',
                        $facultyMember->seminars ?? []
                    ),
                ],
            ];
        @endphp

        @foreach($facultyGroups as $fieldName => $group)

            <div class="form-card faculty-full-card">

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
                                class="btn-mini-primary addFacultyItem"
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

                                @php
                                    $itemText = is_array($item)
                                        ? ($item['text'] ?? '')
                                        : $item;

                                    $itemStatus = is_array($item)
                                        ? !empty($item['status'])
                                        : true;
                                @endphp

                                <div class="faculty-dynamic-row">

                                    <div class="field-group mb-0">
                                        <label class="field-label">
                                            {{ $group['title'] }} Item
                                        </label>

                                        <div class="input-icon-wrap">
                                            <i class="fas fa-check-circle icon"></i>

                                            <input type="text"
                                                   name="{{ $fieldName }}[{{ $index }}][text]"
                                                   value="{{ $itemText }}"
                                                   placeholder="{{ $group['placeholder'] }}"
                                                   class="field-input">
                                        </div>
                                    </div>

                                    <label class="faculty-item-status">
                                        <input type="checkbox"
                                               name="{{ $fieldName }}[{{ $index }}][status]"
                                               value="1"
                                               {{ $itemStatus ? 'checked' : '' }}>

                                        <span>Active</span>
                                    </label>

                                    <button type="button"
                                            class="faculty-remove-btn removeFacultyItem">

                                        <i class="fas fa-trash"></i>
                                    </button>

                                </div>

                            @endforeach

                        @else

                            <div class="faculty-dynamic-row">

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

                                <label class="faculty-item-status">
                                    <input type="checkbox"
                                           name="{{ $fieldName }}[0][status]"
                                           value="1"
                                           checked>

                                    <span>Active</span>
                                </label>

                                <button type="button"
                                        class="faculty-remove-btn removeFacultyItem">

                                    <i class="fas fa-trash"></i>
                                </button>

                            </div>

                        @endif

                    </div>

                    @if($errors->has($fieldName))
                        <p class="field-error mt-2">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first($fieldName) }}
                        </p>
                    @endif

                    <div class="form-info-box">
                        <p>
                            <i class="fas fa-info-circle"></i>
                            Only active items will appear on the frontend faculty profile.
                        </p>
                    </div>

                </div>
            </div>

        @endforeach

    </div>

    <div class="form-actions">

        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            {{ trans('global.save') }}
        </button>

        <a href="{{ route('admin.faculty-members.index') }}"
           class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>

    </div>

</form>

<style>
    .faculty-full-card {
        grid-column: 1 / -1;
    }

    .faculty-image-preview {
        margin: 0 0 20px;
        padding: 14px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
    }

    .faculty-preview-title {
        margin: 0 0 10px;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
    }

    .faculty-image-preview img {
        width: 180px;
        height: 210px;
        display: block;
        object-fit: cover;
        object-position: top center;
        border-radius: 14px;
    }

    .remove-media-option {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 12px;
        color: #dc2626;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .remove-media-option input {
        width: 16px;
        height: 16px;
        accent-color: #dc2626;
    }

    .faculty-current-cv {
        margin-bottom: 20px;
        padding: 14px;
        border: 1px solid #fecaca;
        border-radius: 14px;
        background: #fff7f7;
    }

    .faculty-current-cv-main {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .faculty-current-cv-main > i {
        color: #dc2626;
        font-size: 28px;
    }

    .faculty-current-cv-main strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 13px;
    }

    .faculty-current-cv-main a {
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .faculty-status-box {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px;
        margin: 0;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    .faculty-status-box > input {
        width: 17px;
        height: 17px;
        flex: 0 0 17px;
        margin-top: 3px;
        accent-color: var(--accent, #4f46e5);
    }

    .faculty-status-box strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 14px;
    }

    .faculty-status-box p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .faculty-dynamic-row {
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

    .faculty-item-status {
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

    .faculty-item-status input {
        width: 16px;
        height: 16px;
        accent-color: var(--accent, #4f46e5);
    }

    .faculty-remove-btn {
        width: 48px;
        height: 48px;
        border: 0;
        border-radius: 12px;
        background: #fee2e2;
        color: #dc2626;
        cursor: pointer;
        transition: .25s ease;
    }

    .faculty-remove-btn:hover {
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
        min-height: 280px;
    }

    .ck.ck-toolbar {
        border-color: var(--border-color, #e5e7eb) !important;
        border-radius: 12px 12px 0 0 !important;
    }

    .ck.ck-editor__main > .ck-editor__editable {
        border-color: var(--border-color, #e5e7eb) !important;
        border-radius: 0 0 12px 12px !important;
    }

    @media (max-width: 991px) {
        .form-card-header.between {
            align-items: flex-start;
            flex-direction: column;
        }

        .form-mini-actions {
            width: 100%;
        }

        .form-mini-actions button {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .faculty-full-card {
            grid-column: auto;
        }

        .faculty-dynamic-row {
            grid-template-columns: 1fr;
            align-items: stretch;
        }

        .faculty-item-status {
            justify-content: flex-start;
            padding: 0 14px;
        }

        .faculty-remove-btn {
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

    /* Biography CKEditor */
    const biographyElement = document.getElementById('biography');

    if (
        biographyElement &&
        typeof ClassicEditor !== 'undefined'
    ) {
        ClassicEditor
            .create(biographyElement, {
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

    /* Name to slug */
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    if (nameInput && slugInput) {
        let slugManuallyChanged = true;

        slugInput.addEventListener('input', function () {
            slugManuallyChanged = this.value.trim() !== '';
        });

        nameInput.addEventListener('input', function () {
            if (slugManuallyChanged) {
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

    /* Add dynamic item */
    document.querySelectorAll('.addFacultyItem').forEach(function (button) {
        button.addEventListener('click', function () {
            const group = this.dataset.group;
            const title = this.dataset.title;
            const placeholder = this.dataset.placeholder;

            const wrapper = document.getElementById(
                group + 'Wrapper'
            );

            if (!wrapper) {
                return;
            }

            const index =
                Date.now() +
                Math.floor(Math.random() * 1000);

            wrapper.insertAdjacentHTML('beforeend', `
                <div class="faculty-dynamic-row">

                    <div class="field-group mb-0">
                        <label class="field-label">
                            ${title} Item
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-check-circle icon"></i>

                            <input type="text"
                                   name="${group}[${index}][text]"
                                   placeholder="${placeholder}"
                                   class="field-input">
                        </div>
                    </div>

                    <label class="faculty-item-status">
                        <input type="checkbox"
                               name="${group}[${index}][status]"
                               value="1"
                               checked>

                        <span>Active</span>
                    </label>

                    <button type="button"
                            class="faculty-remove-btn removeFacultyItem">

                        <i class="fas fa-trash"></i>
                    </button>

                </div>
            `);
        });
    });

    /* Remove dynamic item */
    document.addEventListener('click', function (event) {
        const removeButton = event.target.closest(
            '.removeFacultyItem'
        );

        if (!removeButton) {
            return;
        }

        removeButton
            .closest('.faculty-dynamic-row')
            ?.remove();
    });

    /* Faculty image preview */
    const imageInput = document.getElementById('faculty_image');
    const previewBox = document.getElementById(
        'facultyImagePreview'
    );
    const previewImage = document.getElementById(
        'facultyPreviewImage'
    );

    imageInput?.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            previewBox.style.display = 'none';
            previewImage.src = '';
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
            previewBox.style.display = 'none';
            previewImage.src = '';
            return;
        }

        const maximumSize = 5 * 1024 * 1024;

        if (file.size > maximumSize) {
            alert('Faculty image must not exceed 5 MB.');

            this.value = '';
            previewBox.style.display = 'none';
            previewImage.src = '';
            return;
        }

        previewImage.src = URL.createObjectURL(file);
        previewBox.style.display = 'block';
    });

    /* CV validation */
    const cvInput = document.getElementById('faculty_cv');

    cvInput?.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            return;
        }

        if (
            file.type !== 'application/pdf' &&
            !file.name.toLowerCase().endsWith('.pdf')
        ) {
            alert('Please select a valid PDF CV file.');
            this.value = '';
            return;
        }

        const maximumSize = 10 * 1024 * 1024;

        if (file.size > maximumSize) {
            alert('Faculty CV must not exceed 10 MB.');
            this.value = '';
        }
    });

});
</script>

@endsection