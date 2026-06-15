@extends('layouts.admin')

@section('page-title', 'College Profile')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            College Profile
        </h2>

        <p class="admin-page-subtitle">
            Manage about college, profile image, vision, mission and core values
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
      action="{{ route('admin.college-profiles.update') }}"
      enctype="multipart/form-data">

    @csrf

    <div class="admin-form-grid">

        {{-- =========================================================
             ABOUT COLLEGE CONTENT
        ========================================================== --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-university"></i>
                </div>

                <div>
                    <p class="form-card-title">About the College</p>
                    <p class="form-card-subtitle">
                        Manage college introduction and main content
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                {{-- ABOUT BADGE --}}
                <div class="field-group">
                    <label class="field-label" for="about_badge">
                        Section Badge
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-tag icon"></i>

                        <input type="text"
                               name="about_badge"
                               id="about_badge"
                               value="{{ old('about_badge', $collegeProfile->about_badge ?? '') }}"
                               placeholder="About the College"
                               class="field-input {{ $errors->has('about_badge') ? 'error' : '' }}">
                    </div>

                    @error('about_badge')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ABOUT TITLE --}}
                <div class="field-group">
                    <label class="field-label" for="about_title">
                        Main Heading
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="about_title"
                               id="about_title"
                               value="{{ old('about_title', $collegeProfile->about_title ?? '') }}"
                               placeholder="Empowering Women Through Education, Values and Academic Excellence."
                               class="field-input {{ $errors->has('about_title') ? 'error' : '' }}">
                    </div>

                    @error('about_title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- DESCRIPTION ONE --}}
                <div class="field-group">
                    <label class="field-label" for="about_description_one">
                        Description One
                    </label>

                    <textarea name="about_description_one"
                              id="about_description_one"
                              rows="5"
                              placeholder="Enter first college profile paragraph"
                              class="field-input {{ $errors->has('about_description_one') ? 'error' : '' }}">{{ old('about_description_one', $collegeProfile->about_description_one ?? '') }}</textarea>

                    @error('about_description_one')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- DESCRIPTION TWO --}}
                <div class="field-group">
                    <label class="field-label" for="about_description_two">
                        Description Two
                    </label>

                    <textarea name="about_description_two"
                              id="about_description_two"
                              rows="5"
                              placeholder="Enter second college profile paragraph"
                              class="field-input {{ $errors->has('about_description_two') ? 'error' : '' }}">{{ old('about_description_two', $collegeProfile->about_description_two ?? '') }}</textarea>

                    @error('about_description_two')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- =========================================================
             PROFILE IMAGE AND IMAGE BADGE
        ========================================================== --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-image"></i>
                </div>

                <div>
                    <p class="form-card-title">Profile Image & Badge</p>
                    <p class="form-card-subtitle">
                        Manage college profile image and floating badge
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                {{-- IMAGE UPLOAD --}}
                <div class="field-group">
                    <label class="field-label" for="profile_image">
                        College Profile Image
                    </label>

                    <input type="file"
                           name="profile_image"
                           id="profile_image"
                           accept=".jpg,.jpeg,.png,.webp"
                           class="field-input {{ $errors->has('profile_image') ? 'error' : '' }}">

                    @php
                        $profileMedia = !empty($collegeProfile)
                            ? $collegeProfile->getFirstMedia('college_profile_image')
                            : null;
                    @endphp

                    @if($profileMedia)
                        <div class="image-preview-box">
                            <img src="{{ $profileMedia->getUrl() }}"
                                 alt="{{ $collegeProfile->about_title ?? 'College Profile' }}">

                            <div class="image-preview-info">
                                <span>
                                    <i class="fas fa-image"></i>
                                    Current profile image
                                </span>

                                <label class="remove-image-check">
                                    <input type="checkbox"
                                           name="remove_profile_image"
                                           value="1"
                                           {{ old('remove_profile_image') ? 'checked' : '' }}>

                                    <span>Remove image</span>
                                </label>
                            </div>
                        </div>
                    @endif

                    @error('profile_image')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Recommended: JPG, JPEG, PNG or WEBP. Maximum 5 MB.
                        </p>
                    @enderror
                </div>

                {{-- IMAGE BADGE TITLE --}}
                <div class="field-group">
                    <label class="field-label" for="image_badge_title">
                        Image Badge Title
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-award icon"></i>

                        <input type="text"
                               name="image_badge_title"
                               id="image_badge_title"
                               value="{{ old('image_badge_title', $collegeProfile->image_badge_title ?? '') }}"
                               placeholder="Since 1971"
                               class="field-input {{ $errors->has('image_badge_title') ? 'error' : '' }}">
                    </div>

                    @error('image_badge_title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- IMAGE BADGE SUBTITLE --}}
                <div class="field-group">
                    <label class="field-label" for="image_badge_subtitle">
                        Image Badge Subtitle
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-graduation-cap icon"></i>

                        <input type="text"
                               name="image_badge_subtitle"
                               id="image_badge_subtitle"
                               value="{{ old('image_badge_subtitle', $collegeProfile->image_badge_subtitle ?? '') }}"
                               placeholder="Women’s Higher Education"
                               class="field-input {{ $errors->has('image_badge_subtitle') ? 'error' : '' }}">
                    </div>

                    @error('image_badge_subtitle')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Image will be stored using Spatie Media Library in
                        <strong>college_profile_image</strong> collection.
                    </p>
                </div>

            </div>
        </div>

        {{-- =========================================================
             ABOUT HIGHLIGHT POINTS
        ========================================================== --}}
        <div class="form-card">

            <div class="form-card-header between">

                <div class="form-card-head-left">
                    <div class="form-card-icon">
                        <i class="fas fa-list-check"></i>
                    </div>

                    <div>
                        <p class="form-card-title">About Highlight Points</p>
                        <p class="form-card-subtitle">
                            Add, remove and activate college highlight points
                        </p>
                    </div>
                </div>

                <div class="form-mini-actions">
                    <button type="button"
                            class="btn-mini-primary"
                            id="addAboutPointBtn">
                        <i class="fas fa-plus"></i>
                        Add Point
                    </button>
                </div>

            </div>

            <div class="form-card-body">

                @php
                    $aboutPoints = old(
                        'about_points',
                        $collegeProfile->about_points ?? []
                    );
                @endphp

                <div id="aboutPointsWrapper">

                    @forelse($aboutPoints as $index => $point)
                        <div class="dynamic-point-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Point Text
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="about_points[{{ $index }}][text]"
                                           value="{{ $point['text'] ?? '' }}"
                                           placeholder="Enter about highlight point"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="point-status">
                                <input type="checkbox"
                                       name="about_points[{{ $index }}][status]"
                                       value="1"
                                       {{ !array_key_exists('status', $point) || !empty($point['status']) ? 'checked' : '' }}>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="btn-point-remove removeDynamicPoint">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @empty
                        <div class="dynamic-point-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Point Text
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="about_points[0][text]"
                                           placeholder="NAAC accredited institution"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="point-status">
                                <input type="checkbox"
                                       name="about_points[0][status]"
                                       value="1"
                                       checked>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="btn-point-remove removeDynamicPoint">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @endforelse

                </div>

                @error('about_points')
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror

                @error('about_points.*.text')
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Frontend check icon will remain static. Only point text and status are dynamic.
                    </p>
                </div>

            </div>
        </div>

        {{-- =========================================================
             VISION
        ========================================================== --}}
        <div class="form-card">

            <div class="form-card-header between">

                <div class="form-card-head-left">
                    <div class="form-card-icon">
                        <i class="fas fa-eye"></i>
                    </div>

                    <div>
                        <p class="form-card-title">Our Vision</p>
                        <p class="form-card-subtitle">
                            Manage vision title, description and points
                        </p>
                    </div>
                </div>

                <div class="form-mini-actions">
                    <button type="button"
                            class="btn-mini-primary"
                            id="addVisionPointBtn">
                        <i class="fas fa-plus"></i>
                        Add Point
                    </button>
                </div>

            </div>

            <div class="form-card-body">

                {{-- VISION TITLE --}}
                <div class="field-group">
                    <label class="field-label" for="vision_title">
                        Vision Title
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="vision_title"
                               id="vision_title"
                               value="{{ old('vision_title', $collegeProfile->vision_title ?? '') }}"
                               placeholder="Our Vision"
                               class="field-input {{ $errors->has('vision_title') ? 'error' : '' }}">
                    </div>

                    @error('vision_title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- VISION DESCRIPTION --}}
                <div class="field-group">
                    <label class="field-label" for="vision_description">
                        Vision Description
                    </label>

                    <textarea name="vision_description"
                              id="vision_description"
                              rows="5"
                              placeholder="Enter college vision"
                              class="field-input {{ $errors->has('vision_description') ? 'error' : '' }}">{{ old('vision_description', $collegeProfile->vision_description ?? '') }}</textarea>

                    @error('vision_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                @php
                    $visionPoints = old(
                        'vision_points',
                        $collegeProfile->vision_points ?? []
                    );
                @endphp

                <div id="visionPointsWrapper">

                    @forelse($visionPoints as $index => $point)
                        <div class="dynamic-point-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Vision Point
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="vision_points[{{ $index }}][text]"
                                           value="{{ $point['text'] ?? '' }}"
                                           placeholder="Enter vision point"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="point-status">
                                <input type="checkbox"
                                       name="vision_points[{{ $index }}][status]"
                                       value="1"
                                       {{ !array_key_exists('status', $point) || !empty($point['status']) ? 'checked' : '' }}>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="btn-point-remove removeDynamicPoint">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @empty
                        <div class="dynamic-point-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Vision Point
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="vision_points[0][text]"
                                           placeholder="Quality higher education"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="point-status">
                                <input type="checkbox"
                                       name="vision_points[0][status]"
                                       value="1"
                                       checked>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="btn-point-remove removeDynamicPoint">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @endforelse

                </div>

                @error('vision_points')
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Frontend Vision icon <strong>bi-eye-fill</strong> will remain static.
                    </p>
                </div>

            </div>
        </div>

        {{-- =========================================================
             MISSION
        ========================================================== --}}
        <div class="form-card">

            <div class="form-card-header between">

                <div class="form-card-head-left">
                    <div class="form-card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>

                    <div>
                        <p class="form-card-title">Our Mission</p>
                        <p class="form-card-subtitle">
                            Manage mission title, description and points
                        </p>
                    </div>
                </div>

                <div class="form-mini-actions">
                    <button type="button"
                            class="btn-mini-primary"
                            id="addMissionPointBtn">
                        <i class="fas fa-plus"></i>
                        Add Point
                    </button>
                </div>

            </div>

            <div class="form-card-body">

                {{-- MISSION TITLE --}}
                <div class="field-group">
                    <label class="field-label" for="mission_title">
                        Mission Title
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="mission_title"
                               id="mission_title"
                               value="{{ old('mission_title', $collegeProfile->mission_title ?? '') }}"
                               placeholder="Our Mission"
                               class="field-input {{ $errors->has('mission_title') ? 'error' : '' }}">
                    </div>

                    @error('mission_title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- MISSION DESCRIPTION --}}
                <div class="field-group">
                    <label class="field-label" for="mission_description">
                        Mission Description
                    </label>

                    <textarea name="mission_description"
                              id="mission_description"
                              rows="5"
                              placeholder="Enter college mission"
                              class="field-input {{ $errors->has('mission_description') ? 'error' : '' }}">{{ old('mission_description', $collegeProfile->mission_description ?? '') }}</textarea>

                    @error('mission_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                @php
                    $missionPoints = old(
                        'mission_points',
                        $collegeProfile->mission_points ?? []
                    );
                @endphp

                <div id="missionPointsWrapper">

                    @forelse($missionPoints as $index => $point)
                        <div class="dynamic-point-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Mission Point
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="mission_points[{{ $index }}][text]"
                                           value="{{ $point['text'] ?? '' }}"
                                           placeholder="Enter mission point"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="point-status">
                                <input type="checkbox"
                                       name="mission_points[{{ $index }}][status]"
                                       value="1"
                                       {{ !array_key_exists('status', $point) || !empty($point['status']) ? 'checked' : '' }}>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="btn-point-remove removeDynamicPoint">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @empty
                        <div class="dynamic-point-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Mission Point
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="mission_points[0][text]"
                                           placeholder="Student-centered learning"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="point-status">
                                <input type="checkbox"
                                       name="mission_points[0][status]"
                                       value="1"
                                       checked>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="btn-point-remove removeDynamicPoint">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @endforelse

                </div>

                @error('mission_points')
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Frontend Mission icon <strong>bi-bullseye</strong> will remain static.
                    </p>
                </div>

            </div>
        </div>

        {{-- =========================================================
             CORE VALUES
        ========================================================== --}}
        <div class="form-card">

            <div class="form-card-header between">

                <div class="form-card-head-left">
                    <div class="form-card-icon">
                        <i class="fas fa-gem"></i>
                    </div>

                    <div>
                        <p class="form-card-title">Our Core Values</p>
                        <p class="form-card-subtitle">
                            Manage core value title, description and points
                        </p>
                    </div>
                </div>

                <div class="form-mini-actions">
                    <button type="button"
                            class="btn-mini-primary"
                            id="addCoreValuePointBtn">
                        <i class="fas fa-plus"></i>
                        Add Point
                    </button>
                </div>

            </div>

            <div class="form-card-body">

                {{-- CORE VALUE TITLE --}}
                <div class="field-group">
                    <label class="field-label" for="core_value_title">
                        Core Value Title
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="core_value_title"
                               id="core_value_title"
                               value="{{ old('core_value_title', $collegeProfile->core_value_title ?? '') }}"
                               placeholder="Our Core Values"
                               class="field-input {{ $errors->has('core_value_title') ? 'error' : '' }}">
                    </div>

                    @error('core_value_title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- CORE VALUE DESCRIPTION --}}
                <div class="field-group">
                    <label class="field-label" for="core_value_description">
                        Core Value Description
                    </label>

                    <textarea name="core_value_description"
                              id="core_value_description"
                              rows="5"
                              placeholder="Enter institutional core value description"
                              class="field-input {{ $errors->has('core_value_description') ? 'error' : '' }}">{{ old('core_value_description', $collegeProfile->core_value_description ?? '') }}</textarea>

                    @error('core_value_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                @php
                    $coreValuePoints = old(
                        'core_value_points',
                        $collegeProfile->core_value_points ?? []
                    );
                @endphp

                <div id="coreValuePointsWrapper">

                    @forelse($coreValuePoints as $index => $point)
                        <div class="dynamic-point-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Core Value Point
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="core_value_points[{{ $index }}][text]"
                                           value="{{ $point['text'] ?? '' }}"
                                           placeholder="Enter core value point"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="point-status">
                                <input type="checkbox"
                                       name="core_value_points[{{ $index }}][status]"
                                       value="1"
                                       {{ !array_key_exists('status', $point) || !empty($point['status']) ? 'checked' : '' }}>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="btn-point-remove removeDynamicPoint">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @empty
                        <div class="dynamic-point-row">

                            <div class="field-group mb-0">
                                <label class="field-label">
                                    Core Value Point
                                </label>

                                <div class="input-icon-wrap">
                                    <i class="fas fa-check-circle icon"></i>

                                    <input type="text"
                                           name="core_value_points[0][text]"
                                           placeholder="Integrity and ethics"
                                           class="field-input">
                                </div>
                            </div>

                            <label class="point-status">
                                <input type="checkbox"
                                       name="core_value_points[0][status]"
                                       value="1"
                                       checked>

                                <span>Active</span>
                            </label>

                            <button type="button"
                                    class="btn-point-remove removeDynamicPoint">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @endforelse

                </div>

                @error('core_value_points')
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Frontend Core Values icon <strong>bi-gem</strong> will remain static.
                    </p>
                </div>

            </div>
        </div>

        {{-- =========================================================
             SECTION STATUS
        ========================================================== --}}
        <div class="form-card full-width-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-toggle-on"></i>
                </div>

                <div>
                    <p class="form-card-title">Section Visibility</p>
                    <p class="form-card-subtitle">
                        Control whether the college profile section appears on frontend
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <label class="main-status-switch">

                    <input type="checkbox"
                           name="status"
                           value="1"
                           {{ old('status', $collegeProfile->status ?? true) ? 'checked' : '' }}>

                    <span class="main-status-slider"></span>

                    <span class="main-status-content">
                        <strong>Show College Profile Section</strong>
                        <small>
                            Disable this option to temporarily hide the complete section.
                        </small>
                    </span>

                </label>

            </div>
        </div>

    </div>

    {{-- =============================================================
         FORM ACTIONS
    ============================================================== --}}
    <div class="form-actions">

        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save College Profile
        </button>

        <a href="{{ url()->previous() }}" class="btn-ghost">
            Cancel
        </a>

    </div>

</form>

<style>
    .dynamic-point-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 120px 48px;
        gap: 12px;
        align-items: end;
        padding: 14px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
        margin-bottom: 12px;
    }

    .point-status {
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

    .point-status input {
        width: 16px;
        height: 16px;
        accent-color: var(--accent, #4f46e5);
    }

    .btn-point-remove {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 12px;
        background: #fee2e2;
        color: #dc2626;
        cursor: pointer;
        transition:
            background .25s ease,
            color .25s ease,
            transform .25s ease;
    }

    .btn-point-remove:hover {
        color: #ffffff;
        background: #dc2626;
        transform: translateY(-2px);
    }

    .btn-mini-primary {
        min-height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 8px 14px;
        border: 0;
        border-radius: 10px;
        background: var(--accent, #4f46e5);
        color: #ffffff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition:
            opacity .25s ease,
            transform .25s ease;
    }

    .btn-mini-primary:hover {
        opacity: .9;
        transform: translateY(-1px);
    }

    .form-card-header.between {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .form-card-head-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .image-preview-box {
        margin-top: 14px;
        padding: 12px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
    }

    .image-preview-box img {
        width: 100%;
        max-width: 260px;
        height: 170px;
        display: block;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
    }

    .image-preview-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 12px;
    }

    .image-preview-info > span {
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .image-preview-info > span i {
        margin-right: 5px;
    }

    .remove-image-check {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin: 0;
        color: #dc2626;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .remove-image-check input {
        width: 15px;
        height: 15px;
        accent-color: #dc2626;
    }

    .full-width-card {
        grid-column: 1 / -1;
    }

    .main-status-switch {
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 0;
        padding: 18px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 16px;
        background: #f9fafb;
        cursor: pointer;
    }

    .main-status-switch > input {
        position: absolute;
        width: 0;
        height: 0;
        opacity: 0;
    }

    .main-status-slider {
        position: relative;
        width: 48px;
        height: 26px;
        flex: 0 0 48px;
        border-radius: 30px;
        background: #cbd5e1;
        transition: .25s ease;
    }

    .main-status-slider::before {
        content: "";
        position: absolute;
        top: 3px;
        left: 3px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 2px 6px rgba(15, 23, 42, .2);
        transition: .25s ease;
    }

    .main-status-switch input:checked + .main-status-slider {
        background: var(--accent, #4f46e5);
    }

    .main-status-switch input:checked + .main-status-slider::before {
        transform: translateX(22px);
    }

    .main-status-content {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .main-status-content strong {
        color: #1f2937;
        font-size: 14px;
    }

    .main-status-content small {
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    .mt-2 {
        margin-top: 8px !important;
    }

    textarea.field-input {
        min-height: 120px;
        padding-top: 14px;
        resize: vertical;
    }

    @media (max-width: 991px) {
        .form-card-header.between {
            align-items: flex-start;
            flex-direction: column;
        }

        .form-mini-actions,
        .btn-mini-primary {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .dynamic-point-row {
            grid-template-columns: 1fr;
            align-items: stretch;
        }

        .point-status {
            justify-content: flex-start;
            padding: 0 14px;
        }

        .btn-point-remove {
            width: 100%;
        }

        .image-preview-info {
            align-items: flex-start;
            flex-direction: column;
        }

        .main-status-switch {
            align-items: flex-start;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const dynamicGroups = [
            {
                buttonId: 'addAboutPointBtn',
                wrapperId: 'aboutPointsWrapper',
                inputName: 'about_points',
                label: 'Point Text',
                placeholder: 'Enter about highlight point'
            },
            {
                buttonId: 'addVisionPointBtn',
                wrapperId: 'visionPointsWrapper',
                inputName: 'vision_points',
                label: 'Vision Point',
                placeholder: 'Enter vision point'
            },
            {
                buttonId: 'addMissionPointBtn',
                wrapperId: 'missionPointsWrapper',
                inputName: 'mission_points',
                label: 'Mission Point',
                placeholder: 'Enter mission point'
            },
            {
                buttonId: 'addCoreValuePointBtn',
                wrapperId: 'coreValuePointsWrapper',
                inputName: 'core_value_points',
                label: 'Core Value Point',
                placeholder: 'Enter core value point'
            }
        ];

        function getNextIndex(wrapper, inputName) {
            const inputs = wrapper.querySelectorAll(
                `input[name^="${inputName}["][name$="[text]"]`
            );

            let maximumIndex = -1;

            inputs.forEach(function (input) {
                const match = input.name.match(/\[(\d+)\]\[text\]$/);

                if (match) {
                    maximumIndex = Math.max(
                        maximumIndex,
                        parseInt(match[1], 10)
                    );
                }
            });

            return maximumIndex + 1;
        }

        function createPointRow(config, index) {
            return `
                <div class="dynamic-point-row">

                    <div class="field-group mb-0">
                        <label class="field-label">
                            ${config.label}
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-check-circle icon"></i>

                            <input type="text"
                                   name="${config.inputName}[${index}][text]"
                                   placeholder="${config.placeholder}"
                                   class="field-input">
                        </div>
                    </div>

                    <label class="point-status">
                        <input type="checkbox"
                               name="${config.inputName}[${index}][status]"
                               value="1"
                               checked>

                        <span>Active</span>
                    </label>

                    <button type="button"
                            class="btn-point-remove removeDynamicPoint">
                        <i class="fas fa-trash"></i>
                    </button>

                </div>
            `;
        }

        dynamicGroups.forEach(function (config) {
            const button = document.getElementById(config.buttonId);
            const wrapper = document.getElementById(config.wrapperId);

            if (!button || !wrapper) {
                return;
            }

            button.addEventListener('click', function () {
                const index = getNextIndex(wrapper, config.inputName);

                wrapper.insertAdjacentHTML(
                    'beforeend',
                    createPointRow(config, index)
                );
            });
        });

        document.addEventListener('click', function (event) {
            const removeButton = event.target.closest(
                '.removeDynamicPoint'
            );

            if (!removeButton) {
                return;
            }

            const pointRow = removeButton.closest(
                '.dynamic-point-row'
            );

            if (pointRow) {
                pointRow.remove();
            }
        });

        const profileImageInput = document.getElementById(
            'profile_image'
        );

        if (profileImageInput) {
            profileImageInput.addEventListener('change', function () {
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
                    alert(
                        'Please select a JPG, JPEG, PNG or WEBP image.'
                    );

                    this.value = '';
                    return;
                }

                const maximumSize = 5 * 1024 * 1024;

                if (file.size > maximumSize) {
                    alert('Image size must not exceed 5 MB.');

                    this.value = '';
                }
            });
        }

    });
</script>

@endsection