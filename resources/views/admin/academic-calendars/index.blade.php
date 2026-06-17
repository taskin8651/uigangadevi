@extends('layouts.admin')

@section('page-title', 'Academic Calendars')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Academic Calendars
        </h2>

        <p class="admin-page-subtitle">
            Manage academic sessions, monthly schedules and official calendar documents
        </p>
    </div>

    @can('academic_calendar_create')
        <a href="{{ route('admin.academic-calendars.create') }}"
           class="btn-primary">

            <i class="fas fa-plus"></i>
            Add Academic Calendar
        </a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="stats-grid">

    <div class="stat-card">
        <p class="stat-label">Total Calendars</p>
        <p class="stat-value">
            {{ $academicCalendars->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active Calendars</p>
        <p class="stat-value">
            {{ $academicCalendars->where('status', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Total Months</p>
        <p class="stat-value">
            {{ $academicCalendars->sum('months_count') }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">With Document</p>
        <p class="stat-value">
            {{ $academicCalendars->filter(function ($calendar) {
                return !empty($calendar->document);
            })->count() }}
        </p>
    </div>

</div>

<div class="page-card">

    <div class="page-card-header">
        <p class="page-card-title">
            All Academic Calendars
        </p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-AcademicCalendar">

            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Calendar</th>
                    <th>Academic Session</th>
                    <th>Months</th>
                    <th>Document</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($academicCalendars as $academicCalendar)

                    <tr data-entry-id="{{ $academicCalendar->id }}">

                        <td></td>

                        <td>
                            <span class="id-text">
                                #{{ $academicCalendar->id }}
                            </span>
                        </td>

                        <td>
                            <div class="inline-flex-center">

                                <div class="calendar-table-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>

                                <div>
                                    <p class="table-main-text">
                                        {{ $academicCalendar->title }}
                                    </p>

                                    <p class="table-sub-text">
                                        Created:
                                        {{ optional($academicCalendar->created_at)->format('d M Y') }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td>
                            <span class="calendar-session-tag">
                                {{ $academicCalendar->academic_session }}
                            </span>
                        </td>

                        <td>
                            <span class="calendar-month-count">
                                <i class="fas fa-calendar-week"></i>
                                {{ $academicCalendar->months_count }}
                                Months
                            </span>
                        </td>

                        <td>
                            @if($academicCalendar->document)

                                <a href="{{ $academicCalendar->document['url'] }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="calendar-document-status available">

                                    <i class="fas fa-file-pdf"></i>
                                    Available
                                </a>

                            @else

                                <span class="calendar-document-status unavailable">
                                    <i class="fas fa-file"></i>
                                    Not Uploaded
                                </span>

                            @endif
                        </td>

                        <td>
                            @if($academicCalendar->status)

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>
                                    <span class="calendar-status-text active">
                                        Active
                                    </span>
                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>
                                    <span class="calendar-status-text inactive">
                                        Inactive
                                    </span>
                                </div>

                            @endif
                        </td>

                        <td>
                            <div class="action-row">

                                @can('academic_calendar_show')
                                    <a href="{{ route('admin.academic-calendars.show', $academicCalendar->id) }}"
                                       class="btn-outline">

                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('academic_calendar_edit')
                                    <a href="{{ route('admin.academic-calendars.edit', $academicCalendar->id) }}"
                                       class="btn-outline btn-outline-edit">

                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('academic_calendar_delete')
                                    <form action="{{ route('admin.academic-calendars.destroy', $academicCalendar->id) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}')">

                                        @method('DELETE')
                                        @csrf

                                        <button type="submit"
                                                class="btn-outline btn-outline-danger">

                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>

                                    </form>
                                @endcan

                            </div>
                        </td>

                    </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</div>

<style>
    .calendar-table-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 17px;
    }

    .calendar-session-tag {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
    }

    .calendar-month-count {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #475569;
        font-size: 12.5px;
    }

    .calendar-document-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .calendar-document-status.available {
        color: #166534;
        background: #dcfce7;
    }

    .calendar-document-status.unavailable {
        color: #92400e;
        background: #fef3c7;
    }

    .calendar-status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .calendar-status-text.active {
        color: #166534;
    }

    .calendar-status-text.inactive {
        color: #92400e;
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-AcademicCalendar', {
        canDelete: @can('academic_calendar_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.academic-calendars.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search academic calendars...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ calendars'
    });
});
</script>

@endsection