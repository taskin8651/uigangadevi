@extends('layouts.admin')

@section('page-title', 'Student Activities')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Student Activities
        </h2>

        <p class="admin-page-subtitle">
            Manage academic, cultural, sports, social and student development activities
        </p>
    </div>

    @can('student_activity_create')
        <a href="{{ route('admin.student-activities.create') }}"
           class="btn-primary">

            <i class="fas fa-plus"></i>
            Add Student Activity
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
        <p class="stat-label">
            Total Activities
        </p>

        <p class="stat-value">
            {{ $studentActivities->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Active Activities
        </p>

        <p class="stat-value">
            {{ $studentActivities->where('status', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Featured Activities
        </p>

        <p class="stat-value">
            {{ $studentActivities->where('is_featured', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            With Gallery
        </p>

        <p class="stat-value">
            {{ $studentActivities->filter(function ($activity) {
                return !empty($activity->gallery);
            })->count() }}
        </p>
    </div>

</div>

<div class="page-card">

    <div class="page-card-header">
        <p class="page-card-title">
            All Student Activities
        </p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-StudentActivity">

            <thead>
                <tr>
                    <th style="width:40px;"></th>

                    <th>
                        ID
                    </th>

                    <th>
                        Activity
                    </th>

                    <th>
                        Category
                    </th>

                    <th>
                        Activity Date
                    </th>

                    <th>
                        Venue
                    </th>

                    <th>
                        Media
                    </th>

                    <th>
                        Featured
                    </th>

                    <th>
                        Status
                    </th>

                    <th style="text-align:right;">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach($studentActivities as $studentActivity)

                    <tr data-entry-id="{{ $studentActivity->id }}">

                        <td></td>

                        <td>
                            <span class="id-text">
                                #{{ $studentActivity->id }}
                            </span>
                        </td>

                        <td>
                            <div class="inline-flex-center">

                                @if($studentActivity->image)

                                    <img src="{{ $studentActivity->image }}"
                                         alt="{{ $studentActivity->title }}"
                                         class="activity-table-image">

                                @else

                                    <div class="activity-table-icon">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>

                                @endif

                                <div>
                                    <p class="table-main-text">
                                        {{ $studentActivity->title }}
                                    </p>

                                    <p class="table-sub-text">
                                        {{ $studentActivity->organizer ?: $studentActivity->slug }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td>
                            @if($studentActivity->category)

                                <span class="activity-category-tag">
                                    {{ $studentActivity->category }}
                                </span>

                            @else

                                <span class="table-empty">
                                    —
                                </span>

                            @endif
                        </td>

                        <td>
                            @if($studentActivity->activity_date)

                                <div class="activity-date-box">
                                    <i class="fas fa-calendar-alt"></i>

                                    <span>
                                        {{ $studentActivity->activity_date->format('d M Y') }}
                                    </span>
                                </div>

                            @else

                                <span class="table-empty">
                                    Not specified
                                </span>

                            @endif
                        </td>

                        <td>
                            @if($studentActivity->venue)

                                <span class="table-value-text">
                                    {{ $studentActivity->venue }}
                                </span>

                            @else

                                <span class="table-empty">
                                    —
                                </span>

                            @endif
                        </td>

                        <td>
                            <div class="activity-media-list">

                                @if($studentActivity->image)
                                    <span class="activity-media-pill image">
                                        <i class="fas fa-image"></i>
                                        Image
                                    </span>
                                @endif

                                @if(!empty($studentActivity->gallery))
                                    <span class="activity-media-pill gallery">
                                        <i class="fas fa-images"></i>

                                        {{ count($studentActivity->gallery) }}
                                        Photos
                                    </span>
                                @endif

                                @if($studentActivity->document)
                                    <a href="{{ $studentActivity->document['url'] }}"
                                       target="_blank"
                                       rel="noopener"
                                       class="activity-media-pill document">

                                        <i class="fas fa-file-pdf"></i>
                                        Document
                                    </a>
                                @endif

                                @if(
                                    !$studentActivity->image
                                    && empty($studentActivity->gallery)
                                    && !$studentActivity->document
                                )
                                    <span class="table-empty">
                                        No media
                                    </span>
                                @endif

                            </div>
                        </td>

                        <td>
                            @if($studentActivity->is_featured)

                                <span class="featured-status active">
                                    <i class="fas fa-star"></i>
                                    Featured
                                </span>

                            @else

                                <span class="featured-status inactive">
                                    <i class="far fa-star"></i>
                                    Normal
                                </span>

                            @endif
                        </td>

                        <td>
                            @if($studentActivity->status)

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>

                                    <span class="activity-status-text active">
                                        Active
                                    </span>
                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>

                                    <span class="activity-status-text inactive">
                                        Inactive
                                    </span>
                                </div>

                            @endif
                        </td>

                        <td>
                            <div class="action-row">

                                @can('student_activity_show')
                                    <a href="{{ route(
                                            'admin.student-activities.show',
                                            $studentActivity->id
                                        ) }}"
                                       class="btn-outline">

                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('student_activity_edit')
                                    <a href="{{ route(
                                            'admin.student-activities.edit',
                                            $studentActivity->id
                                        ) }}"
                                       class="btn-outline btn-outline-edit">

                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('student_activity_delete')
                                    <form action="{{ route(
                                            'admin.student-activities.destroy',
                                            $studentActivity->id
                                        ) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm(
                                              '{{ trans('global.areYouSure') }}'
                                          )">

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
    .activity-table-image {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        display: block;
        object-fit: cover;
        object-position: center;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
    }

    .activity-table-icon {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 17px;
    }

    .table-value-text {
        display: inline-block;
        max-width: 170px;
        color: #475569;
        font-size: 13px;
        line-height: 1.5;
    }

    .table-empty {
        color: #94a3b8;
        font-size: 12px;
    }

    .activity-category-tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border: 1px solid #dbeafe;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .activity-date-box {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #475569;
        font-size: 12.5px;
        white-space: nowrap;
    }

    .activity-date-box i {
        color: #6366f1;
    }

    .activity-media-list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        min-width: 130px;
    }

    .activity-media-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        line-height: 1;
        text-decoration: none;
        white-space: nowrap;
    }

    .activity-media-pill.image {
        background: #ecfdf5;
        color: #047857;
    }

    .activity-media-pill.gallery {
        background: #f5f3ff;
        color: #6d28d9;
    }

    .activity-media-pill.document {
        background: #fef2f2;
        color: #dc2626;
    }

    .activity-media-pill.document:hover {
        background: #fee2e2;
        color: #b91c1c;
    }

    .featured-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        white-space: nowrap;
    }

    .featured-status.active {
        background: #fffbeb;
        color: #b45309;
    }

    .featured-status.inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .activity-status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .activity-status-text.active {
        color: #166534;
    }

    .activity-status-text.inactive {
        color: #92400e;
    }

    @media (max-width: 768px) {
        .activity-table-image,
        .activity-table-icon {
            width: 40px;
            height: 40px;
            flex-basis: 40px;
        }

        .table-value-text {
            max-width: 130px;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-StudentActivity', {
        canDelete: @can('student_activity_delete') true @else false @endcan,

        massDeleteUrl:
            "{{ route('admin.student-activities.massDestroy') }}",

        deleteText:
            "{{ trans('global.datatables.delete') }}",

        zeroSelectedText:
            "{{ trans('global.datatables.zero_selected') }}",

        confirmText:
            "{{ trans('global.areYouSure') }}",

        searchPlaceholder:
            'Search student activities...',

        infoText:
            'Showing _START_–_END_ of _TOTAL_ activities'
    });
});
</script>

@endsection