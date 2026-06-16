@extends('layouts.admin')

@section('page-title', 'Faculty Member Profile')

@section('content')

@php
    $activeQualifications = collect(
        $facultyMember->qualifications ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeSpecializations = collect(
        $facultyMember->specializations ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeSubjectsTaught = collect(
        $facultyMember->subjects_taught ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeResearchInterests = collect(
        $facultyMember->research_interests ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activePublications = collect(
        $facultyMember->publications ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeAwards = collect(
        $facultyMember->awards ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeResponsibilities = collect(
        $facultyMember->responsibilities ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeMemberships = collect(
        $facultyMember->memberships ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });

    $activeSeminars = collect(
        $facultyMember->seminars ?? []
    )->filter(function ($item) {
        return is_array($item)
            && !empty($item['text'])
            && !empty($item['status']);
    });
@endphp

<div class="admin-page-head">

    <div>
        <a href="{{ route('admin.faculty-members.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Faculty Member Profile
        </h2>

        <p class="admin-page-subtitle">
            Complete academic, professional and departmental information
        </p>
    </div>

    <div class="show-actions">

        @can('faculty_member_edit')
            <a href="{{ route('admin.faculty-members.edit', $facultyMember->id) }}"
               class="btn-primary">

                <i class="fas fa-pencil-alt"></i>
                Edit Faculty
            </a>
        @endcan

        @can('faculty_member_delete')
            <form action="{{ route('admin.faculty-members.destroy', $facultyMember->id) }}"
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

        {{-- PROFILE CARD --}}
        <div class="detail-card mb-3">

            <div class="profile-hero faculty-profile-hero">

                @if($facultyMember->image)

                    <img src="{{ $facultyMember->image }}"
                         alt="{{ $facultyMember->name }}"
                         class="faculty-profile-avatar">

                @else

                    <div class="profile-avatar-lg faculty-avatar-placeholder">
                        {{ strtoupper(substr($facultyMember->name, 0, 1)) }}
                    </div>

                @endif

                <p class="profile-title">
                    {{ $facultyMember->name }}
                </p>

                <p class="profile-subtitle">
                    {{ $facultyMember->designation ?: 'Faculty Member' }}
                </p>

                @if($facultyMember->subject)
                    <span class="faculty-department-pill">
                        <i class="fas fa-university"></i>

                        {{ $facultyMember->subject->department_name
                            ?: $facultyMember->subject->name }}
                    </span>
                @endif

                @if($facultyMember->status)
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

            </div>

            <div class="detail-section-pad-sm">

                <div class="faculty-mini-stats">

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Faculty ID
                        </p>

                        <p class="stat-mini-value">
                            #{{ $facultyMember->id }}
                        </p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Employee ID
                        </p>

                        <p class="stat-mini-value-sm">
                            {{ $facultyMember->employee_id ?: '—' }}
                        </p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Teaching Experience
                        </p>

                        <p class="stat-mini-value-sm">
                            {{ $facultyMember->teaching_experience ?: '—' }}
                        </p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Research Experience
                        </p>

                        <p class="stat-mini-value-sm">
                            {{ $facultyMember->research_experience ?: '—' }}
                        </p>
                    </div>

                    <div class="stat-mini faculty-stat-full">
                        <p class="stat-mini-label">
                            Faculty Since
                        </p>

                        <p class="stat-mini-value-sm">
                            @if($facultyMember->joining_date)
                                {{ $facultyMember->joining_date->format('d M Y') }}
                            @else
                                —
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

                @can('faculty_member_edit')
                    <a href="{{ route('admin.faculty-members.edit', $facultyMember->id) }}"
                       class="quick-link primary">

                        <i class="fas fa-user-edit"></i>
                        Edit Faculty Profile
                    </a>
                @endcan

                <a href="{{ route('admin.faculty-members.index') }}"
                   class="quick-link">

                    <i class="fas fa-list"></i>
                    All Faculty Members
                </a>

                @can('faculty_member_create')
                    <a href="{{ route('admin.faculty-members.create') }}"
                       class="quick-link">

                        <i class="fas fa-user-plus"></i>
                        Add New Faculty
                    </a>
                @endcan

                @if($facultyMember->cv)
                    <a href="{{ $facultyMember->cv['url'] }}"
                       target="_blank"
                       rel="noopener"
                       class="quick-link">

                        <i class="fas fa-file-pdf"></i>
                        Download Faculty CV
                    </a>
                @endif

                @if($facultyMember->email)
                    <a href="mailto:{{ $facultyMember->email }}"
                       class="quick-link">

                        <i class="fas fa-envelope"></i>
                        Send Email
                    </a>
                @endif

            </div>

        </div>

    </div>

    {{-- RIGHT CONTENT --}}
    <div>

        {{-- FACULTY DETAILS --}}
        <div class="detail-card mb-3">

            <div class="detail-section-head">

                <div class="detail-section-icon">
                    <i class="fas fa-id-card"></i>
                </div>

                <p class="detail-section-title">
                    Faculty Details
                </p>

            </div>

            <div class="detail-section-body">

                <div class="detail-row">
                    <span class="detail-label">
                        Faculty ID
                    </span>

                    <span class="detail-value code-pill">
                        #{{ $facultyMember->id }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Full Name
                    </span>

                    <span class="detail-value">
                        {{ $facultyMember->name }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Profile Slug
                    </span>

                    <span class="detail-value code-pill">
                        {{ $facultyMember->slug }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Designation
                    </span>

                    <span class="detail-value">
                        {{ $facultyMember->designation ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Employee ID
                    </span>

                    <span class="detail-value">
                        {{ $facultyMember->employee_id ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Department
                    </span>

                    <span class="detail-value">
                        @if($facultyMember->subject)
                            {{ $facultyMember->subject->department_name
                                ?: $facultyMember->subject->name }}
                        @else
                            Not assigned
                        @endif
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Faculty Category
                    </span>

                    @if($facultyMember->faculty_category)
                        <span class="role-tag">
                            {{ $facultyMember->faculty_category }}
                        </span>
                    @else
                        <span class="detail-value">—</span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Email Address
                    </span>

                    <div>
                        <span class="detail-value">
                            {{ $facultyMember->email ?: '—' }}
                        </span>

                        @if($facultyMember->email)
                            <a href="mailto:{{ $facultyMember->email }}"
                               class="send-mail-link">
                                Send Email
                            </a>
                        @endif
                    </div>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Phone Number
                    </span>

                    <div>
                        <span class="detail-value">
                            {{ $facultyMember->phone ?: '—' }}
                        </span>

                        @if($facultyMember->phone)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $facultyMember->phone) }}"
                               class="send-mail-link">
                                Call
                            </a>
                        @endif
                    </div>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Joining Date
                    </span>

                    <span class="detail-value">
                        @if($facultyMember->joining_date)
                            {{ $facultyMember->joining_date->format('d M Y') }}
                        @else
                            —
                        @endif
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Teaching Experience
                    </span>

                    <span class="detail-value">
                        {{ $facultyMember->teaching_experience ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Research Experience
                    </span>

                    <span class="detail-value">
                        {{ $facultyMember->research_experience ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Profile Status
                    </span>

                    @if($facultyMember->status)
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
                                  style="color:#92400E;">
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
                        {{ $facultyMember->sort_order ?? 0 }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Created At
                    </span>

                    <span class="detail-value">
                        {{ optional($facultyMember->created_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Updated At
                    </span>

                    <span class="detail-value">
                        {{ optional($facultyMember->updated_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

        {{-- SHORT DESCRIPTION --}}
        @if($facultyMember->short_description)

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-align-left"></i>
                    </div>

                    <p class="detail-section-title">
                        Short Introduction
                    </p>

                </div>

                <div class="detail-content-box">
                    <p>
                        {{ $facultyMember->short_description }}
                    </p>
                </div>

            </div>

        @endif

        {{-- BIOGRAPHY --}}
        @if($facultyMember->biography)

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>

                    <p class="detail-section-title">
                        Faculty Biography
                    </p>

                </div>

                <div class="detail-content-box faculty-rich-content">
                    {!! $facultyMember->biography !!}
                </div>

            </div>

        @endif

        {{-- QUALIFICATIONS --}}
        @if($activeQualifications->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>

                        <p class="detail-section-title">
                            Qualifications
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeQualifications->count() }}
                        {{ $activeQualifications->count() === 1 ? 'item' : 'items' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-detail-list">

                        @foreach($activeQualifications as $qualification)

                            <div class="faculty-detail-item">
                                <i class="fas fa-check-circle"></i>

                                <span>
                                    {{ $qualification['text'] }}
                                </span>
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endif

        {{-- SPECIALIZATIONS --}}
        @if($activeSpecializations->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-star"></i>
                        </div>

                        <p class="detail-section-title">
                            Specializations
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeSpecializations->count() }}
                        {{ $activeSpecializations->count() === 1 ? 'item' : 'items' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-tag-list">

                        @foreach($activeSpecializations as $specialization)
                            <span class="faculty-profile-tag">
                                <i class="fas fa-star"></i>
                                {{ $specialization['text'] }}
                            </span>
                        @endforeach

                    </div>
                </div>

            </div>

        @endif

        {{-- SUBJECTS TAUGHT --}}
        @if($activeSubjectsTaught->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-book-open"></i>
                        </div>

                        <p class="detail-section-title">
                            Subjects Taught
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeSubjectsTaught->count() }}
                        {{ $activeSubjectsTaught->count() === 1 ? 'subject' : 'subjects' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-detail-list">

                        @foreach($activeSubjectsTaught as $subjectItem)

                            <div class="faculty-detail-item">
                                <i class="fas fa-book"></i>

                                <span>
                                    {{ $subjectItem['text'] }}
                                </span>
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endif

        {{-- RESEARCH INTERESTS --}}
        @if($activeResearchInterests->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-microscope"></i>
                        </div>

                        <p class="detail-section-title">
                            Research Interests
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeResearchInterests->count() }}
                        {{ $activeResearchInterests->count() === 1 ? 'area' : 'areas' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-tag-list">

                        @foreach($activeResearchInterests as $researchInterest)
                            <span class="faculty-profile-tag research">
                                <i class="fas fa-microscope"></i>
                                {{ $researchInterest['text'] }}
                            </span>
                        @endforeach

                    </div>
                </div>

            </div>

        @endif

        {{-- PUBLICATIONS --}}
        @if($activePublications->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>

                        <p class="detail-section-title">
                            Publications
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activePublications->count() }}
                        {{ $activePublications->count() === 1 ? 'publication' : 'publications' }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-numbered-list">

                        @foreach($activePublications as $index => $publication)

                            <div class="faculty-numbered-item">

                                <span class="faculty-number">
                                    {{ $index + 1 }}
                                </span>

                                <p>
                                    {{ $publication['text'] }}
                                </p>

                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endif

        {{-- AWARDS --}}
        @if($activeAwards->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-award"></i>
                        </div>

                        <p class="detail-section-title">
                            Awards & Achievements
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeAwards->count() }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-detail-list">

                        @foreach($activeAwards as $award)

                            <div class="faculty-detail-item award">
                                <i class="fas fa-trophy"></i>

                                <span>
                                    {{ $award['text'] }}
                                </span>
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endif

        {{-- RESPONSIBILITIES --}}
        @if($activeResponsibilities->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-tasks"></i>
                        </div>

                        <p class="detail-section-title">
                            Administrative Responsibilities
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeResponsibilities->count() }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-detail-list">

                        @foreach($activeResponsibilities as $responsibility)

                            <div class="faculty-detail-item">
                                <i class="fas fa-check-circle"></i>

                                <span>
                                    {{ $responsibility['text'] }}
                                </span>
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endif

        {{-- MEMBERSHIPS --}}
        @if($activeMemberships->isNotEmpty())

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-users"></i>
                        </div>

                        <p class="detail-section-title">
                            Professional Memberships
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeMemberships->count() }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-detail-list">

                        @foreach($activeMemberships as $membership)

                            <div class="faculty-detail-item">
                                <i class="fas fa-user-check"></i>

                                <span>
                                    {{ $membership['text'] }}
                                </span>
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endif

        {{-- SEMINARS --}}
        @if($activeSeminars->isNotEmpty())

            <div class="detail-card">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>

                        <p class="detail-section-title">
                            Seminars & Conferences
                        </p>

                    </div>

                    <span class="status-pill success">
                        {{ $activeSeminars->count() }}
                    </span>

                </div>

                <div class="detail-section-pad-sm">
                    <div class="faculty-numbered-list">

                        @foreach($activeSeminars as $index => $seminar)

                            <div class="faculty-numbered-item">

                                <span class="faculty-number">
                                    {{ $index + 1 }}
                                </span>

                                <p>
                                    {{ $seminar['text'] }}
                                </p>

                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endif

    </div>

</div>

<style>
    .faculty-profile-hero {
        padding-bottom: 24px;
    }

    .faculty-profile-avatar {
        width: 118px;
        height: 138px;
        display: block;
        margin: 0 auto 16px;
        object-fit: cover;
        object-position: top center;
        border: 5px solid #ffffff;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .14);
    }

    .faculty-avatar-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: #ffffff;
    }

    .faculty-department-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        max-width: 100%;
        margin: 8px auto 12px;
        padding: 7px 11px;
        border-radius: 999px;
        background: #eef2ff;
        color: #4338ca;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.4;
        text-align: center;
    }

    .faculty-mini-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .faculty-stat-full {
        grid-column: 1 / -1;
    }

    .detail-content-box {
        padding: 20px;
        color: #475569;
        font-size: 14px;
        line-height: 1.8;
    }

    .detail-content-box p:last-child {
        margin-bottom: 0;
    }

    .faculty-rich-content ul,
    .faculty-rich-content ol {
        padding-left: 20px;
    }

    .faculty-detail-list {
        display: grid;
        gap: 10px;
    }

    .faculty-detail-item {
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

    .faculty-detail-item > i {
        flex: 0 0 auto;
        margin-top: 3px;
        color: #10b981;
    }

    .faculty-detail-item.award {
        border-color: #fde68a;
        background: #fffbeb;
    }

    .faculty-detail-item.award > i {
        color: #d97706;
    }

    .faculty-tag-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .faculty-profile-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 11px;
        border: 1px solid #ddd6fe;
        border-radius: 999px;
        background: #f5f3ff;
        color: #6d28d9;
        font-size: 12px;
        font-weight: 700;
    }

    .faculty-profile-tag.research {
        border-color: #bae6fd;
        background: #f0f9ff;
        color: #0369a1;
    }

    .faculty-numbered-list {
        display: grid;
        gap: 12px;
    }

    .faculty-numbered-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 13px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 13px;
        background: #f8fafc;
    }

    .faculty-number {
        width: 27px;
        height: 27px;
        flex: 0 0 27px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #4f46e5;
        color: #ffffff;
        font-size: 11px;
        font-weight: 800;
    }

    .faculty-numbered-item p {
        margin: 2px 0 0;
        color: #475569;
        font-size: 13px;
        line-height: 1.6;
    }

    @media (max-width: 575px) {
        .faculty-mini-stats {
            grid-template-columns: 1fr;
        }

        .faculty-stat-full {
            grid-column: auto;
        }

        .faculty-profile-avatar {
            width: 105px;
            height: 125px;
        }
    }
</style>

@endsection