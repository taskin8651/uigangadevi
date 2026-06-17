@extends('layouts.admin')

@section('page-title', 'Student Activity Details')

@section('content')

@php
    $activeHighlights = collect(
        $studentActivity->activity_highlights ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeOutcomes = collect(
        $studentActivity->learning_outcomes ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeParticipants = collect(
        $studentActivity->participants ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $categoryColors = [
        'Academic'       => '#4F46E5',
        'Cultural'       => '#EC4899',
        'Social'         => '#0EA5E9',
        'Sports'         => '#10B981',
        'Empowerment'    => '#8B5CF6',
        'Career'         => '#F59E0B',
        'NSS'            => '#EF4444',
        'NCC'            => '#14B8A6',
        'Awareness'      => '#2563EB',
        'Workshop'       => '#7C3AED',
        'Seminar'        => '#DB2777',
        'Administration' => '#475569',
        'Other'          => '#64748B',
    ];

    $categoryColor = $categoryColors[$studentActivity->category] ?? '#4F46E5';
@endphp

<div class="admin-page-head">

    <div>
        <a href="{{ route('admin.student-activities.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Student Activity Details
        </h2>

        <p class="admin-page-subtitle">
            Complete programme, media, organizer and student outcome information
        </p>
    </div>

    <div class="show-actions">

        @can('student_activity_edit')
            <a href="{{ route('admin.student-activities.edit', $studentActivity->id) }}"
               class="btn-primary">

                <i class="fas fa-pencil-alt"></i>
                Edit Activity
            </a>
        @endcan

        @can('student_activity_delete')
            <form action="{{ route('admin.student-activities.destroy', $studentActivity->id) }}"
                  method="POST"
                  onsubmit="return confirm('{{ trans('global.areYouSure') }}')">

                @method('DELETE')
                @csrf

                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash-alt"></i>
                    Delete
                </button>

            </form>
        @endcan

    </div>

</div>

<div class="show-grid">

    {{-- LEFT SIDEBAR --}}
    <div>

        {{-- ACTIVITY PROFILE CARD --}}
        <div class="detail-card mb-3">

            <div class="profile-hero activity-profile-hero">

                @if($studentActivity->image)

                    <img src="{{ $studentActivity->image }}"
                         alt="{{ $studentActivity->title }}"
                         class="activity-profile-image">

                @else

                    <div class="activity-image-placeholder"
                         style="background: linear-gradient(
                            135deg,
                            {{ $categoryColor }},
                            #0f172a
                         );">

                        <i class="fas fa-calendar-check"></i>
                    </div>

                @endif

                <p class="profile-title">
                    {{ $studentActivity->title }}
                </p>

                <p class="profile-subtitle">
                    {{ $studentActivity->organizer ?: 'Student Activity' }}
                </p>

                @if($studentActivity->category)
                    <span class="activity-category-pill"
                          style="
                              color: {{ $categoryColor }};
                              border-color: {{ $categoryColor }}33;
                              background: {{ $categoryColor }}12;
                          ">

                        <i class="fas fa-tag"></i>
                        {{ $studentActivity->category }}
                    </span>
                @endif

                <div class="activity-profile-statuses">

                    @if($studentActivity->status)
                        <span class="status-pill success">
                            <i class="fas fa-check-circle"></i>
                            Active
                        </span>
                    @else
                        <span class="status-pill warning">
                            <i class="fas fa-clock"></i>
                            Inactive
                        </span>
                    @endif

                    @if($studentActivity->is_featured)
                        <span class="status-pill activity-featured-pill">
                            <i class="fas fa-star"></i>
                            Featured
                        </span>
                    @endif

                </div>

            </div>

            <div class="detail-section-pad-sm">

                <div class="activity-mini-stats">

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Activity ID
                        </p>

                        <p class="stat-mini-value">
                            #{{ $studentActivity->id }}
                        </p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Gallery Photos
                        </p>

                        <p class="stat-mini-value">
                            {{ count($studentActivity->gallery ?? []) }}
                        </p>
                    </div>

                    <div class="stat-mini activity-stat-full">
                        <p class="stat-mini-label">
                            Activity Date
                        </p>

                        <p class="stat-mini-value-sm">
                            @if($studentActivity->activity_date)
                                {{ $studentActivity->activity_date->format('d M Y') }}
                            @else
                                Not specified
                            @endif
                        </p>
                    </div>

                </div>

            </div>

        </div>

        {{-- QUICK ACTIONS --}}
        <div class="detail-card detail-card-pad">

            <p class="quick-title">
                Quick Actions
            </p>

            <div class="quick-list">

                @can('student_activity_edit')
                    <a href="{{ route('admin.student-activities.edit', $studentActivity->id) }}"
                       class="quick-link primary">

                        <i class="fas fa-edit"></i>
                        Edit Activity
                    </a>
                @endcan

                <a href="{{ route('admin.student-activities.index') }}"
                   class="quick-link">

                    <i class="fas fa-list"></i>
                    All Activities
                </a>

                @can('student_activity_create')
                    <a href="{{ route('admin.student-activities.create') }}"
                       class="quick-link">

                        <i class="fas fa-plus-circle"></i>
                        Add New Activity
                    </a>
                @endcan

                @if($studentActivity->document)
                    <a href="{{ $studentActivity->document['url'] }}"
                       target="_blank"
                       rel="noopener"
                       class="quick-link">

                        <i class="fas fa-file-pdf"></i>
                        Download Document
                    </a>
                @endif

                @if(Route::has('frontend.activities.show'))
                    <a href="{{ route(
                            'frontend.activities.show',
                            $studentActivity->slug
                        ) }}"
                       target="_blank"
                       rel="noopener"
                       class="quick-link">

                        <i class="fas fa-external-link-alt"></i>
                        View Frontend Page
                    </a>
                @endif

            </div>

        </div>

    </div>

    {{-- RIGHT CONTENT --}}
    <div>

        {{-- ACTIVITY DETAILS --}}
        <div class="detail-card mb-3">

            <div class="detail-section-head">

                <div class="detail-section-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>

                <p class="detail-section-title">
                    Activity Information
                </p>

            </div>

            <div class="detail-section-body">

                <div class="detail-row">
                    <span class="detail-label">
                        Activity ID
                    </span>

                    <span class="detail-value code-pill">
                        #{{ $studentActivity->id }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Activity Title
                    </span>

                    <span class="detail-value">
                        {{ $studentActivity->title }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Activity Slug
                    </span>

                    <span class="detail-value code-pill">
                        {{ $studentActivity->slug }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Category
                    </span>

                    @if($studentActivity->category)
                        <span class="activity-category-value"
                              style="
                                  color: {{ $categoryColor }};
                                  border-color: {{ $categoryColor }}33;
                                  background: {{ $categoryColor }}12;
                              ">

                            <i class="fas fa-tag"></i>
                            {{ $studentActivity->category }}
                        </span>
                    @else
                        <span class="detail-value">
                            —
                        </span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Activity Date
                    </span>

                    <span class="detail-value">
                        @if($studentActivity->activity_date)
                            {{ $studentActivity->activity_date->format('d M Y') }}
                        @else
                            Not specified
                        @endif
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Venue
                    </span>

                    <span class="detail-value">
                        {{ $studentActivity->venue ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Organizer / Committee
                    </span>

                    <span class="detail-value">
                        {{ $studentActivity->organizer ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Guest / Speaker
                    </span>

                    <span class="detail-value">
                        {{ $studentActivity->guest_name ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Featured Status
                    </span>

                    @if($studentActivity->is_featured)

                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-star activity-star-icon"></i>

                            <span class="detail-value">
                                Featured Activity
                            </span>
                        </div>

                    @else

                        <div class="d-flex align-items-center gap-2">
                            <i class="far fa-star"
                               style="color:#94a3b8;"></i>

                            <span class="detail-value">
                                Normal Activity
                            </span>
                        </div>

                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Visibility
                    </span>

                    @if($studentActivity->status)

                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success"></i>

                            <span class="detail-value">
                                Active
                            </span>
                        </div>

                    @else

                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-exclamation-circle text-warning"></i>

                            <span class="detail-value"
                                  style="color:#92400e;">
                                Inactive
                            </span>
                        </div>

                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Sort Order
                    </span>

                    <span class="detail-value">
                        {{ $studentActivity->sort_order ?? 0 }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Created At
                    </span>

                    <span class="detail-value">
                        {{ optional($studentActivity->created_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Updated At
                    </span>

                    <span class="detail-value">
                        {{ optional($studentActivity->updated_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

        {{-- SHORT DESCRIPTION --}}
        @if($studentActivity->short_description)

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-align-left"></i>
                    </div>

                    <p class="detail-section-title">
                        Short Introduction
                    </p>

                </div>

                <div class="activity-content-box">
                    <p>
                        {{ $studentActivity->short_description }}
                    </p>
                </div>

            </div>

        @endif

        {{-- FULL DESCRIPTION --}}
        @if($studentActivity->description)

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>

                    <p class="detail-section-title">
                        Complete Activity Description
                    </p>

                </div>

                <div class="activity-content-box activity-rich-content">
                    {!! $studentActivity->description !!}
                </div>

            </div>

        @endif

        {{-- ACTIVITY HIGHLIGHTS --}}
        @if($activeHighlights->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-star"></i>
                        </div>

                        <p class="detail-section-title">
                            Activity Highlights
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeHighlights->count() }}
                        {{ $activeHighlights->count() === 1 ? 'item' : 'items' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">

                    <div class="activity-detail-list">

                        @foreach($activeHighlights as $highlight)

                            <div class="activity-detail-item highlight">

                                <i class="fas fa-star"></i>

                                <span>
                                    {{ $highlight['text'] }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif

        {{-- LEARNING OUTCOMES --}}
        @if($activeOutcomes->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>

                        <p class="detail-section-title">
                            Learning Outcomes
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeOutcomes->count() }}
                        {{ $activeOutcomes->count() === 1 ? 'outcome' : 'outcomes' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">

                    <div class="activity-detail-list">

                        @foreach($activeOutcomes as $outcome)

                            <div class="activity-detail-item outcome">

                                <i class="fas fa-check-circle"></i>

                                <span>
                                    {{ $outcome['text'] }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif

        {{-- PARTICIPANTS --}}
        @if($activeParticipants->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-users"></i>
                        </div>

                        <p class="detail-section-title">
                            Participant Groups
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeParticipants->count() }}
                        {{ $activeParticipants->count() === 1 ? 'group' : 'groups' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">

                    <div class="activity-participant-tags">

                        @foreach($activeParticipants as $participant)

                            <span class="activity-participant-tag">

                                <i class="fas fa-user-check"></i>
                                {{ $participant['text'] }}

                            </span>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif

        {{-- MAIN IMAGE --}}
        @if($studentActivity->image)

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-image"></i>
                    </div>

                    <p class="detail-section-title">
                        Main Activity Image
                    </p>

                </div>

                <div class="activity-main-image-box">

                    <a href="{{ $studentActivity->image }}"
                       target="_blank"
                       rel="noopener">

                        <img src="{{ $studentActivity->image }}"
                             alt="{{ $studentActivity->title }}">
                    </a>

                </div>

            </div>

        @endif

        {{-- ACTIVITY GALLERY --}}
        @if(!empty($studentActivity->gallery))

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-images"></i>
                        </div>

                        <p class="detail-section-title">
                            Activity Gallery
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ count($studentActivity->gallery) }}
                        {{ count($studentActivity->gallery) === 1 ? 'photo' : 'photos' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">

                    <div class="activity-admin-gallery">

                        @foreach($studentActivity->gallery as $galleryImage)

                            <a href="{{ $galleryImage['url'] }}"
                               target="_blank"
                               rel="noopener"
                               class="activity-admin-gallery-item">

                                <img src="{{ $galleryImage['url'] }}"
                                     alt="{{ $studentActivity->title }} gallery">

                                <span>
                                    <i class="fas fa-search-plus"></i>
                                    View
                                </span>

                            </a>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif

        {{-- ACTIVITY DOCUMENT --}}
        @if($studentActivity->document)

            <div class="detail-card">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>

                    <p class="detail-section-title">
                        Activity Document
                    </p>

                </div>

                <div class="detail-section-pad-sm">

                    <div class="activity-document-detail">

                        <div class="activity-document-detail-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>

                        <div class="activity-document-info">

                            <strong>
                                {{ $studentActivity->document['name']
                                    ?? 'Activity Document' }}
                            </strong>

                            @if(!empty($studentActivity->document['size']))
                                <span>
                                    {{ number_format(
                                        $studentActivity->document['size'] / 1024,
                                        1
                                    ) }} KB
                                </span>
                            @endif

                        </div>

                        <a href="{{ $studentActivity->document['url'] }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-primary">

                            <i class="fas fa-download"></i>
                            Download
                        </a>

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>

<style>
    .activity-profile-hero {
        padding-bottom: 24px;
    }

    .activity-profile-image {
        width: 100%;
        max-width: 260px;
        height: 175px;
        display: block;
        margin: 0 auto 18px;
        object-fit: cover;
        object-position: center;
        border: 5px solid #ffffff;
        border-radius: 22px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .14);
    }

    .activity-image-placeholder {
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        border: 5px solid #ffffff;
        border-radius: 28px;
        color: #ffffff;
        font-size: 36px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .14);
    }

    .activity-category-pill,
    .activity-category-value {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border: 1px solid;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.2;
    }

    .activity-category-pill {
        margin: 8px auto 12px;
    }

    .activity-profile-statuses {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }

    .activity-featured-pill {
        color: #b45309;
        background: #fef3c7;
    }

    .activity-star-icon {
        color: #f59e0b;
    }

    .activity-mini-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .activity-stat-full {
        grid-column: 1 / -1;
    }

    .activity-content-box {
        padding: 20px;
        color: #475569;
        font-size: 14px;
        line-height: 1.8;
    }

    .activity-content-box p:last-child {
        margin-bottom: 0;
    }

    .activity-rich-content ul,
    .activity-rich-content ol {
        padding-left: 20px;
    }

    .activity-rich-content img {
        max-width: 100%;
        height: auto;
    }

    .activity-detail-list {
        display: grid;
        gap: 10px;
    }

    .activity-detail-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #f8fafc;
        color: #475569;
        font-size: 13px;
        line-height: 1.6;
    }

    .activity-detail-item > i {
        flex: 0 0 auto;
        margin-top: 3px;
    }

    .activity-detail-item.highlight {
        border-color: #fde68a;
        background: #fffbeb;
    }

    .activity-detail-item.highlight > i {
        color: #d97706;
    }

    .activity-detail-item.outcome {
        border-color: #bbf7d0;
        background: #f0fdf4;
    }

    .activity-detail-item.outcome > i {
        color: #16a34a;
    }

    .activity-participant-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .activity-participant-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 11px;
        border: 1px solid #dbeafe;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
    }

    .activity-main-image-box {
        padding: 18px;
    }

    .activity-main-image-box img {
        width: 100%;
        max-height: 470px;
        display: block;
        object-fit: cover;
        object-position: center;
        border-radius: 16px;
    }

    .activity-admin-gallery {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .activity-admin-gallery-item {
        position: relative;
        display: block;
        min-height: 150px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f8fafc;
    }

    .activity-admin-gallery-item img {
        width: 100%;
        height: 170px;
        display: block;
        object-fit: cover;
        transition: transform .3s ease;
    }

    .activity-admin-gallery-item span {
        position: absolute;
        right: 8px;
        bottom: 8px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 999px;
        color: #ffffff;
        background: rgba(15, 23, 42, .78);
        font-size: 11px;
        font-weight: 700;
    }

    .activity-admin-gallery-item:hover img {
        transform: scale(1.05);
    }

    .activity-document-detail {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border: 1px solid #fecaca;
        border-radius: 14px;
        background: #fff7f7;
    }

    .activity-document-detail-icon {
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

    .activity-document-info {
        min-width: 0;
        flex: 1;
    }

    .activity-document-info strong {
        display: block;
        overflow: hidden;
        color: #1f2937;
        font-size: 13px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .activity-document-info span {
        display: block;
        margin-top: 3px;
        color: #64748b;
        font-size: 11px;
    }

    @media (max-width: 991px) {
        .activity-admin-gallery {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575px) {
        .activity-mini-stats {
            grid-template-columns: 1fr;
        }

        .activity-stat-full {
            grid-column: auto;
        }

        .activity-profile-image {
            height: 160px;
        }

        .activity-admin-gallery {
            grid-template-columns: 1fr;
        }

        .activity-document-detail {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .activity-document-detail .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

@endsection