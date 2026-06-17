@extends('layouts.admin')

@section('page-title', 'Edit Student Activity')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.student-activities.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Student Activity
        </h2>

        <p class="admin-page-subtitle">
            Update activity information, media, gallery, document and student outcomes
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
      action="{{ route('admin.student-activities.update', $studentActivity->id) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="admin-form-grid">

        {{-- ACTIVITY INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Activity Information
                    </p>

                    <p class="form-card-subtitle">
                        Update activity title, category and date
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="title">
                        Activity Title <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $studentActivity->title) }}"
                               required
                               placeholder="Seminars & Workshops"
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
                               value="{{ old('slug', $studentActivity->slug) }}"
                               placeholder="seminars-workshops"
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
                            Slug is used in the frontend activity detail URL.
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="category">
                        Activity Category
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-tags icon"></i>

                        <select name="category"
                                id="category"
                                class="field-input {{ $errors->has('category') ? 'error' : '' }}">

                            <option value="">
                                Select activity category
                            </option>

                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('category', $studentActivity->category) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @error('category')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="activity_date">
                        Activity Date
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-calendar-alt icon"></i>

                        <input type="date"
                               name="activity_date"
                               id="activity_date"
                               value="{{ old(
                                   'activity_date',
                                   $studentActivity->activity_date
                                       ? $studentActivity->activity_date->format('Y-m-d')
                                       : ''
                               ) }}"
                               class="field-input {{ $errors->has('activity_date') ? 'error' : '' }}">
                    </div>

                    @error('activity_date')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- ORGANIZATION DETAILS --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Organization Details
                    </p>

                    <p class="form-card-subtitle">
                        Venue, organizer and guest information
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="venue">
                        Venue
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-map-marker-alt icon"></i>

                        <input type="text"
                               name="venue"
                               id="venue"
                               value="{{ old('venue', $studentActivity->venue) }}"
                               placeholder="College Auditorium"
                               class="field-input {{ $errors->has('venue') ? 'error' : '' }}">
                    </div>

                    @error('venue')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="organizer">
                        Organizer / Committee
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-users-cog icon"></i>

                        <input type="text"
                               name="organizer"
                               id="organizer"
                               value="{{ old('organizer', $studentActivity->organizer) }}"
                               placeholder="Academic Committee"
                               class="field-input {{ $errors->has('organizer') ? 'error' : '' }}">
                    </div>

                    @error('organizer')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="guest_name">
                        Guest / Speaker Name
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-user-tie icon"></i>

                        <input type="text"
                               name="guest_name"
                               id="guest_name"
                               value="{{ old('guest_name', $studentActivity->guest_name) }}"
                               placeholder="Dr. Guest Speaker"
                               class="field-input {{ $errors->has('guest_name') ? 'error' : '' }}">
                    </div>

                    @error('guest_name')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Organizer can be a department, committee, cell, NSS unit or college authority.
                    </p>
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
                        Replace image, gallery, document and update visibility
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                {{-- MAIN IMAGE --}}
                <div class="field-group">
                    <label class="field-label" for="activity_image">
                        Main Activity Image
                    </label>

                    <input type="file"
                           name="activity_image"
                           id="activity_image"
                           accept=".jpg,.jpeg,.png,.webp"
                           class="field-input {{ $errors->has('activity_image') ? 'error' : '' }}">

                    @error('activity_image')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Upload a new image only when replacing the existing image.
                        </p>
                    @enderror
                </div>

                @if($studentActivity->image)
                    <div class="activity-image-preview">

                        <p class="activity-preview-title">
                            Current Main Image
                        </p>

                        <img src="{{ $studentActivity->image }}"
                             alt="{{ $studentActivity->title }}">

                        <label class="remove-media-option">
                            <input type="checkbox"
                                   name="remove_activity_image"
                                   value="1"
                                   {{ old('remove_activity_image') ? 'checked' : '' }}>

                            <span>Remove current main image</span>
                        </label>

                    </div>
                @endif

                <div id="activityImagePreview"
                     class="activity-image-preview"
                     style="display:none;">

                    <p class="activity-preview-title">
                        New Main Image Preview
                    </p>

                    <img id="activityPreviewImage"
                         src=""
                         alt="Activity image preview">
                </div>

                {{-- GALLERY --}}
                <div class="field-group">
                    <label class="field-label" for="gallery_images">
                        Add Gallery Images
                    </label>

                    <input type="file"
                           name="gallery_images[]"
                           id="gallery_images"
                           accept=".jpg,.jpeg,.png,.webp"
                           multiple
                           class="field-input {{ $errors->has('gallery_images') ? 'error' : '' }}">

                    @error('gallery_images')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-images"></i>
                            New images will be added to the existing gallery.
                        </p>
                    @enderror

                    @error('gallery_images.*')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                @if(!empty($studentActivity->gallery))
                    <div class="current-gallery-box">

                        <p class="activity-preview-title">
                            Current Gallery
                        </p>

                        <div class="current-gallery-grid">

                            @foreach($studentActivity->gallery as $galleryImage)

                                <label class="current-gallery-item">

                                    <img src="{{ $galleryImage['url'] }}"
                                         alt="{{ $studentActivity->title }} gallery">

                                    <span class="gallery-remove-option">
                                        <input type="checkbox"
                                               name="remove_gallery_ids[]"
                                               value="{{ $galleryImage['id'] }}"
                                               {{ in_array(
                                                   $galleryImage['id'],
                                                   old('remove_gallery_ids', [])
                                               ) ? 'checked' : '' }}>

                                        Remove
                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>
                @endif

                <div id="activityGalleryPreview"
                     class="activity-gallery-preview"
                     style="display:none;"></div>

                {{-- DOCUMENT --}}
                <div class="field-group">
                    <label class="field-label" for="activity_document">
                        Activity Document / PDF
                    </label>

                    <input type="file"
                           name="activity_document"
                           id="activity_document"
                           accept=".pdf,application/pdf"
                           class="field-input {{ $errors->has('activity_document') ? 'error' : '' }}">

                    @error('activity_document')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-file-pdf"></i>
                            Upload a new PDF only when replacing the current document.
                        </p>
                    @enderror
                </div>

                @if($studentActivity->document)
                    <div class="activity-document-box">

                        <div class="activity-document-main">
                            <i class="fas fa-file-pdf"></i>

                            <div>
                                <strong>Current Document</strong>

                                <a href="{{ $studentActivity->document['url'] }}"
                                   target="_blank"
                                   rel="noopener">
                                    {{ $studentActivity->document['name'] ?? 'View Document' }}
                                </a>
                            </div>
                        </div>

                        <label class="remove-media-option">
                            <input type="checkbox"
                                   name="remove_activity_document"
                                   value="1"
                                   {{ old('remove_activity_document') ? 'checked' : '' }}>

                            <span>Remove current document</span>
                        </label>

                    </div>
                @endif

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
                               value="{{ old('sort_order', $studentActivity->sort_order ?? 0) }}"
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
                            Lower values will appear first.
                        </p>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div class="activity-toggle-grid">

                    <label class="activity-status-box">
                        <input type="checkbox"
                               name="is_featured"
                               value="1"
                               {{ old(
                                   'is_featured',
                                   $studentActivity->is_featured
                               ) ? 'checked' : '' }}>

                        <div>
                            <strong>Featured Activity</strong>

                            <p>
                                Featured activity receives priority on the frontend.
                            </p>
                        </div>
                    </label>

                    <label class="activity-status-box">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               {{ old(
                                   'status',
                                   $studentActivity->status
                               ) ? 'checked' : '' }}>

                        <div>
                            <strong>Active Activity</strong>

                            <p>
                                Active activity will appear on the frontend website.
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
                        Short Introduction
                    </p>

                    <p class="form-card-subtitle">
                        Short content displayed on activity cards
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
                              placeholder="Enter a short activity introduction"
                              class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old(
                                  'short_description',
                                  $studentActivity->short_description
                              ) }}</textarea>

                    @error('short_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            This description will appear on the activity listing card.
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- FULL DESCRIPTION --}}
        <div class="form-card activity-full-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Complete Activity Description
                    </p>

                    <p class="form-card-subtitle">
                        Detailed information about the programme or activity
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
                              class="field-input {{ $errors->has('description') ? 'error' : '' }}">{{ old(
                                  'description',
                                  $studentActivity->description
                              ) }}</textarea>

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
            $activityGroups = [
                'activity_highlights' => [
                    'title' => 'Activity Highlights',
                    'subtitle' => 'Important features and programme highlights',
                    'icon' => 'fas fa-star',
                    'placeholder' => 'Guest lecture and interactive session',
                    'items' => old(
                        'activity_highlights',
                        $studentActivity->activity_highlights ?? []
                    ),
                ],

                'learning_outcomes' => [
                    'title' => 'Learning Outcomes',
                    'subtitle' => 'Skills and knowledge gained by students',
                    'icon' => 'fas fa-lightbulb',
                    'placeholder' => 'Improved communication and presentation skills',
                    'items' => old(
                        'learning_outcomes',
                        $studentActivity->learning_outcomes ?? []
                    ),
                ],

                'participants' => [
                    'title' => 'Participant Groups',
                    'subtitle' => 'Students, volunteers and coordinators involved',
                    'icon' => 'fas fa-users',
                    'placeholder' => 'Undergraduate students',
                    'items' => old(
                        'participants',
                        $studentActivity->participants ?? []
                    ),
                ],
            ];
        @endphp

        @foreach($activityGroups as $fieldName => $group)

            <div class="form-card activity-full-card">

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
                                class="btn-mini-primary addActivityItem"
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

                                <div class="activity-dynamic-row">

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

                                    <label class="activity-item-status">

                                        <input type="checkbox"
                                               name="{{ $fieldName }}[{{ $index }}][status]"
                                               value="1"
                                               {{ $itemStatus ? 'checked' : '' }}>

                                        <span>Active</span>
                                    </label>

                                    <button type="button"
                                            class="activity-remove-btn removeActivityItem">

                                        <i class="fas fa-trash"></i>
                                    </button>

                                </div>

                            @endforeach

                        @else

                            <div class="activity-dynamic-row">

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

                                <label class="activity-item-status">

                                    <input type="checkbox"
                                           name="{{ $fieldName }}[0][status]"
                                           value="1"
                                           checked>

                                    <span>Active</span>
                                </label>

                                <button type="button"
                                        class="activity-remove-btn removeActivityItem">

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

                    <div class="form-info-box">
                        <p>
                            <i class="fas fa-info-circle"></i>
                            Only active items will appear on the frontend activity detail page.
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

        <a href="{{ route('admin.student-activities.index') }}"
           class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>

    </div>

</form>

<style>
    .activity-full-card {
        grid-column: 1 / -1;
    }

    .activity-image-preview,
    .current-gallery-box {
        margin: 0 0 20px;
        padding: 14px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
    }

    .activity-preview-title {
        margin: 0 0 10px;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
    }

    .activity-image-preview img {
        width: 100%;
        max-width: 280px;
        height: 180px;
        display: block;
        object-fit: cover;
        object-position: center;
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

    .current-gallery-grid,
    .activity-gallery-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 10px;
    }

    .current-gallery-item {
        position: relative;
        display: block;
        margin: 0;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #ffffff;
        cursor: pointer;
    }

    .current-gallery-item img {
        width: 100%;
        height: 105px;
        display: block;
        object-fit: cover;
    }

    .gallery-remove-option {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 8px;
        color: #dc2626;
        background: #ffffff;
        font-size: 11px;
        font-weight: 700;
    }

    .gallery-remove-option input {
        width: 14px;
        height: 14px;
        accent-color: #dc2626;
    }

    .activity-gallery-preview {
        margin: 0 0 20px;
        padding: 12px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
    }

    .activity-gallery-preview img {
        width: 100%;
        height: 95px;
        display: block;
        object-fit: cover;
        border-radius: 10px;
    }

    .activity-document-box {
        margin-bottom: 20px;
        padding: 14px;
        border: 1px solid #fecaca;
        border-radius: 14px;
        background: #fff7f7;
    }

    .activity-document-main {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .activity-document-main > i {
        color: #dc2626;
        font-size: 28px;
    }

    .activity-document-main strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 13px;
    }

    .activity-document-main a {
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .activity-toggle-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .activity-status-box {
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

    .activity-status-box > input {
        width: 17px;
        height: 17px;
        flex: 0 0 17px;
        margin-top: 3px;
        accent-color: var(--accent, #4f46e5);
    }

    .activity-status-box strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 14px;
    }

    .activity-status-box p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .activity-dynamic-row {
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

    .activity-item-status {
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

    .activity-item-status input {
        width: 16px;
        height: 16px;
        accent-color: var(--accent, #4f46e5);
    }

    .activity-remove-btn {
        width: 48px;
        height: 48px;
        border: 0;
        border-radius: 12px;
        background: #fee2e2;
        color: #dc2626;
        cursor: pointer;
        transition: .25s ease;
    }

    .activity-remove-btn:hover {
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
        .activity-full-card {
            grid-column: auto;
        }

        .activity-dynamic-row {
            grid-template-columns: 1fr;
            align-items: stretch;
        }

        .activity-item-status {
            justify-content: flex-start;
            padding: 0 14px;
        }

        .activity-remove-btn {
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
    const descriptionElement = document.getElementById('description');

    if (
        descriptionElement &&
        typeof ClassicEditor !== 'undefined'
    ) {
        ClassicEditor
            .create(descriptionElement, {
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

    /* Name/title to slug */
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (titleInput && slugInput) {
        let slugManuallyChanged = slugInput.value.trim() !== '';

        slugInput.addEventListener('input', function () {
            slugManuallyChanged = this.value.trim() !== '';
        });

        titleInput.addEventListener('input', function () {
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
    document.querySelectorAll('.addActivityItem').forEach(function (button) {
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
                <div class="activity-dynamic-row">

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

                    <label class="activity-item-status">

                        <input type="checkbox"
                               name="${group}[${index}][status]"
                               value="1"
                               checked>

                        <span>Active</span>
                    </label>

                    <button type="button"
                            class="activity-remove-btn removeActivityItem">

                        <i class="fas fa-trash"></i>
                    </button>

                </div>
            `);
        });
    });

    /* Remove dynamic item */
    document.addEventListener('click', function (event) {
        const removeButton = event.target.closest(
            '.removeActivityItem'
        );

        if (!removeButton) {
            return;
        }

        removeButton
            .closest('.activity-dynamic-row')
            ?.remove();
    });

    /* Main image preview */
    const imageInput = document.getElementById('activity_image');
    const previewBox = document.getElementById(
        'activityImagePreview'
    );
    const previewImage = document.getElementById(
        'activityPreviewImage'
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
            alert('Please select a JPG, JPEG, PNG or WEBP image.');

            this.value = '';
            previewBox.style.display = 'none';
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('Main activity image must not exceed 5 MB.');

            this.value = '';
            previewBox.style.display = 'none';
            return;
        }

        previewImage.src = URL.createObjectURL(file);
        previewBox.style.display = 'block';
    });

    /* Gallery preview */
    const galleryInput = document.getElementById('gallery_images');
    const galleryPreview = document.getElementById(
        'activityGalleryPreview'
    );

    galleryInput?.addEventListener('change', function () {
        galleryPreview.innerHTML = '';

        const files = Array.from(this.files || []);

        if (!files.length) {
            galleryPreview.style.display = 'none';
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        const invalidFile = files.some(function (file) {
            return !allowedTypes.includes(file.type)
                || file.size > 5 * 1024 * 1024;
        });

        if (invalidFile) {
            alert(
                'Every gallery image must be JPG, JPEG, PNG or WEBP and not exceed 5 MB.'
            );

            this.value = '';
            galleryPreview.style.display = 'none';
            return;
        }

        files.forEach(function (file) {
            const image = document.createElement('img');

            image.src = URL.createObjectURL(file);
            image.alt = 'New activity gallery preview';

            galleryPreview.appendChild(image);
        });

        galleryPreview.style.display = 'grid';
    });

    /* PDF validation */
    const documentInput = document.getElementById(
        'activity_document'
    );

    documentInput?.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            return;
        }

        if (
            file.type !== 'application/pdf'
            && !file.name.toLowerCase().endsWith('.pdf')
        ) {
            alert('Please select a valid PDF document.');

            this.value = '';
            return;
        }

        if (file.size > 10 * 1024 * 1024) {
            alert('Activity document must not exceed 10 MB.');

            this.value = '';
        }
    });

});
</script>

@endsection