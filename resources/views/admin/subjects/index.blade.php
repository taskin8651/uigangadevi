@extends('layouts.admin')

@section('page-title', 'Subjects')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Subjects
        </h2>

        <p class="admin-page-subtitle">
            Manage academic subjects, departments, assigned courses and syllabus
        </p>
    </div>

    @can('subject_create')
        <a href="{{ route('admin.subjects.create') }}"
           class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Subject
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
        <p class="stat-label">Total Subjects</p>

        <p class="stat-value">
            {{ $subjects->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active Subjects</p>

        <p class="stat-value">
            {{ $subjects->where('status', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Inactive Subjects</p>

        <p class="stat-value">
            {{ $subjects->where('status', false)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">With Syllabus</p>

        <p class="stat-value">
            {{ $subjects->filter(function ($subject) {
                return !empty($subject->syllabus);
            })->count() }}
        </p>
    </div>

</div>

<div class="page-card">

    <div class="page-card-header">
        <p class="page-card-title">
            All Subjects
        </p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-Subject">

            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Department</th>
                    <th>Courses</th>
                    <th>Syllabus</th>
                    <th>Status</th>
                    <th style="text-align:right;">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach($subjects as $subject)

                    <tr data-entry-id="{{ $subject->id }}">

                        <td></td>

                        <td>
                            <span class="id-text">
                                #{{ $subject->id }}
                            </span>
                        </td>

                        <td>
                            <div class="inline-flex-center">

                                @if($subject->image)
                                    <img src="{{ $subject->image }}"
                                         alt="{{ $subject->name }}"
                                         class="subject-table-image">
                                @else
                                    <div class="subject-table-icon">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                @endif

                                <div>
                                    <p class="table-main-text">
                                        {{ $subject->name }}
                                    </p>

                                    <p class="table-sub-text">
                                        {{ $subject->short_name ?: $subject->slug }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td>
                            @if($subject->department_name)
                                <span class="table-value-text">
                                    {{ $subject->department_name }}
                                </span>
                            @else
                                <span class="table-empty">
                                    —
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="tag-wrap">

                                @forelse($subject->courses as $course)
                                    <span class="role-tag">
                                        {{ $course->short_name ?: $course->name }}
                                    </span>
                                @empty
                                    <span class="table-empty">
                                        Not assigned
                                    </span>
                                @endforelse

                            </div>
                        </td>

                        <td>
                            @if($subject->syllabus)
                                <a href="{{ $subject->syllabus['url'] }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="syllabus-status available">

                                    <i class="fas fa-file-pdf"></i>
                                    Available
                                </a>
                            @else
                                <span class="syllabus-status unavailable">
                                    <i class="fas fa-file"></i>
                                    Not Uploaded
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($subject->status)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>

                                    <span class="subject-status-text active">
                                        Active
                                    </span>
                                </div>
                            @else
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>

                                    <span class="subject-status-text inactive">
                                        Inactive
                                    </span>
                                </div>
                            @endif
                        </td>

                        <td>
                            <div class="action-row">

                                @can('subject_show')
                                    <a href="{{ route('admin.subjects.show', $subject->id) }}"
                                       class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('subject_edit')
                                    <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                                       class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('subject_delete')
                                    <form action="{{ route('admin.subjects.destroy', $subject->id) }}"
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
    .subject-table-image {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        object-fit: cover;
        object-position: center;
        border: 1px solid #e5e7eb;
        border-radius: 11px;
    }

    .subject-table-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #ecfdf5;
        color: #059669;
        font-size: 16px;
    }

    .table-value-text {
        color: #475569;
        font-size: 13px;
        line-height: 1.5;
    }

    .table-empty {
        color: #94a3b8;
        font-size: 12px;
    }

    .syllabus-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .syllabus-status.available {
        color: #166534;
        background: #dcfce7;
    }

    .syllabus-status.available:hover {
        color: #14532d;
        background: #bbf7d0;
    }

    .syllabus-status.unavailable {
        color: #92400e;
        background: #fef3c7;
    }

    .subject-status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .subject-status-text.active {
        color: #166534;
    }

    .subject-status-text.inactive {
        color: #92400e;
    }

    .tag-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    @media (max-width: 768px) {
        .subject-table-image,
        .subject-table-icon {
            width: 38px;
            height: 38px;
            flex-basis: 38px;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-Subject', {
        canDelete: @can('subject_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.subjects.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search subjects...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ subjects'
    });
});
</script>
@endsection