@extends('layouts.admin')

@section('page-title', 'Courses')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Courses
        </h2>

        <p class="admin-page-subtitle">
            Manage academic programmes, course information and assigned subjects
        </p>
    </div>

    @can('course_create')
        <a href="{{ route('admin.courses.create') }}"
           class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Course
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
        <p class="stat-label">Total Courses</p>
        <p class="stat-value">{{ $courses->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active Courses</p>
        <p class="stat-value">
            {{ $courses->where('status', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Inactive Courses</p>
        <p class="stat-value">
            {{ $courses->where('status', false)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Added Today</p>
        <p class="stat-value">
            {{ $courses->where('created_at', '>=', now()->startOfDay())->count() }}
        </p>
    </div>

</div>

<div class="page-card">

    <div class="page-card-header">
        <p class="page-card-title">
            All Courses
        </p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-Course">

            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Duration</th>
                    <th>Subjects</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($courses as $course)
                    <tr data-entry-id="{{ $course->id }}">

                        <td></td>

                        <td>
                            <span class="id-text">
                                #{{ $course->id }}
                            </span>
                        </td>

                        <td>
                            <div class="inline-flex-center">

                                @if($course->image)
                                    <img src="{{ $course->image }}"
                                         alt="{{ $course->name }}"
                                         class="course-table-image">
                                @else
                                    <div class="course-table-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                @endif

                                <div>
                                    <p class="table-main-text">
                                        {{ $course->name }}
                                    </p>

                                    <p class="table-sub-text">
                                        {{ $course->short_name ?: ($course->slug ?: 'Academic Programme') }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td>
                            @if($course->level)
                                <span class="role-tag">
                                    {{ $course->level }}
                                </span>
                            @else
                                <span class="table-empty">—</span>
                            @endif
                        </td>

                        <td>
                            <span class="table-value-text">
                                {{ $course->duration ?: '—' }}
                            </span>
                        </td>

                        <td>
                            <div class="subject-count-badge">
                                <i class="fas fa-layer-group"></i>

                                {{ $course->subjects_count ?? $course->subjects->count() }}

                                {{ ($course->subjects_count ?? $course->subjects->count()) === 1 ? 'Subject' : 'Subjects' }}
                            </div>
                        </td>

                        <td>
                            @if($course->status)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>

                                    <span class="status-text active">
                                        Active
                                    </span>
                                </div>
                            @else
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>

                                    <span class="status-text inactive">
                                        Inactive
                                    </span>
                                </div>
                            @endif
                        </td>

                        <td>
                            <div class="action-row">

                                @can('course_show')
                                    <a href="{{ route('admin.courses.show', $course->id) }}"
                                       class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('course_edit')
                                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                                       class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('course_delete')
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}"
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
    .course-table-image,
    .subject-table-image {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        border-radius: 11px;
    }

    .course-table-icon,
    .subject-table-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 16px;
    }

    .subject-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
    }

    .table-value-text {
        color: #475569;
        font-size: 13px;
    }

    .table-empty {
        color: #94a3b8;
        font-size: 12px;
    }

    .status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .status-text.active {
        color: #166534;
    }

    .status-text.inactive {
        color: #92400e;
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-Course', {
        canDelete: @can('course_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.courses.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search courses...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ courses'
    });
});
</script>
@endsection