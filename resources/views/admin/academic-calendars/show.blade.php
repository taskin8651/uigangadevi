@extends('layouts.admin')

@section('page-title', 'Academic Calendar Details')

@section('content')

<div class="admin-page-head">

    <div>
        <a href="{{ route('admin.academic-calendars.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Academic Calendar Details
        </h2>

        <p class="admin-page-subtitle">
            Complete academic session and monthly plan information
        </p>
    </div>

    <div class="show-actions">

        @can('academic_calendar_edit')
            <a href="{{ route('admin.academic-calendars.edit', $academicCalendar->id) }}"
               class="btn-primary">

                <i class="fas fa-pencil-alt"></i>
                Edit Calendar
            </a>
        @endcan

        @can('academic_calendar_delete')
            <form action="{{ route('admin.academic-calendars.destroy', $academicCalendar->id) }}"
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

    <div>

        <div class="detail-card mb-3">

            <div class="profile-hero">

                <div class="profile-avatar-lg"
                     style="background:#4f46e5;">

                    <i class="fas fa-calendar-alt"></i>
                </div>

                <p class="profile-title">
                    {{ $academicCalendar->title }}
                </p>

                <p class="profile-subtitle">
                    Session:
                    {{ $academicCalendar->academic_session }}
                </p>

                @if($academicCalendar->status)
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

                <div class="d-grid gap-2"
                     style="grid-template-columns:1fr 1fr;">

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Calendar ID
                        </p>

                        <p class="stat-mini-value">
                            #{{ $academicCalendar->id }}
                        </p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Total Months
                        </p>

                        <p class="stat-mini-value">
                            {{ $academicCalendar->months->count() }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

        <div class="detail-card detail-card-pad">

            <p class="quick-title">
                Quick Actions
            </p>

            <div class="quick-list">

                @can('academic_calendar_edit')
                    <a href="{{ route('admin.academic-calendars.edit', $academicCalendar->id) }}"
                       class="quick-link primary">

                        <i class="fas fa-edit"></i>
                        Edit Calendar
                    </a>
                @endcan

                <a href="{{ route('admin.academic-calendars.index') }}"
                   class="quick-link">

                    <i class="fas fa-list"></i>
                    All Calendars
                </a>

                @if($academicCalendar->document)
                    <a href="{{ $academicCalendar->document['url'] }}"
                       target="_blank"
                       class="quick-link">

                        <i class="fas fa-file-pdf"></i>
                        Download PDF
                    </a>
                @endif

            </div>

        </div>

    </div>

    <div>

        <div class="detail-card mb-3">

            <div class="detail-section-head">

                <div class="detail-section-icon">
                    <i class="fas fa-id-card"></i>
                </div>

                <p class="detail-section-title">
                    Calendar Information
                </p>

            </div>

            <div class="detail-section-body">

                <div class="detail-row">
                    <span class="detail-label">
                        Title
                    </span>

                    <span class="detail-value">
                        {{ $academicCalendar->title }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Academic Session
                    </span>

                    <span class="detail-value code-pill">
                        {{ $academicCalendar->academic_session }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Status
                    </span>

                    <span class="detail-value">
                        {{ $academicCalendar->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Created At
                    </span>

                    <span class="detail-value">
                        {{ optional($academicCalendar->created_at)->format('d M Y, H:i') }}
                    </span>
                </div>

            </div>

        </div>

        @if($academicCalendar->short_description)

            <div class="detail-card mb-3">

                <div class="detail-section-head">
                    <div class="detail-section-icon">
                        <i class="fas fa-align-left"></i>
                    </div>

                    <p class="detail-section-title">
                        Description
                    </p>
                </div>

                <div style="padding:20px;">
                    {{ $academicCalendar->short_description }}
                </div>

            </div>

        @endif

        <div class="detail-card">

            <div class="detail-section-head between">

                <div class="d-flex align-items-center gap-2">
                    <div class="detail-section-icon">
                        <i class="fas fa-calendar-week"></i>
                    </div>

                    <p class="detail-section-title">
                        Monthly Plans
                    </p>
                </div>

                <span class="status-pill success">
                    {{ $academicCalendar->months->count() }}
                    Months
                </span>

            </div>

            <div class="detail-section-pad-sm">

                @foreach($academicCalendar->months as $month)

                    @php
                        $activeActivities = collect(
                            $month->activities ?? []
                        )->filter(function ($activity) {
                            return !empty($activity['text'])
                                && !empty($activity['status']);
                        });
                    @endphp

                    <div class="admin-calendar-month-view">

                        <div class="admin-calendar-month-title">

                            <span>
                                {{ str_pad(
                                    $month->display_number,
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                ) }}
                            </span>

                            <div>
                                <strong>
                                    {{ $month->month_name }}
                                </strong>

                                <small>
                                    {{ $month->status ? 'Active' : 'Inactive' }}
                                </small>
                            </div>

                        </div>

                        @if($activeActivities->isNotEmpty())
                            <ul>
                                @foreach($activeActivities as $activity)
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        {{ $activity['text'] }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No active activities.</p>
                        @endif

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

<style>
    .admin-calendar-month-view {
        padding: 16px;
        margin-bottom: 14px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f8fafc;
    }

    .admin-calendar-month-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .admin-calendar-month-title > span {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #4f46e5;
        color: #fff;
        font-weight: 800;
    }

    .admin-calendar-month-title strong,
    .admin-calendar-month-title small {
        display: block;
    }

    .admin-calendar-month-title small {
        margin-top: 3px;
        color: #64748b;
    }

    .admin-calendar-month-view ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .admin-calendar-month-view li {
        display: flex;
        gap: 8px;
        margin-top: 8px;
        color: #475569;
        font-size: 13px;
    }

    .admin-calendar-month-view li i {
        margin-top: 3px;
        color: #10b981;
    }
</style>

@endsection