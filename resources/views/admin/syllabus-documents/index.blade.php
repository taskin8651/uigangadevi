@extends('layouts.admin')

@section('page-title', 'Syllabus Documents')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Syllabus Documents
        </h2>

        <p class="admin-page-subtitle">
            Manage course-wise, subject-wise and academic session syllabus documents
        </p>
    </div>

    @can('syllabus_document_create')
        <a href="{{ route('admin.syllabus-documents.create') }}"
           class="btn-primary">

            <i class="fas fa-plus"></i>
            Add Syllabus
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
            Total Documents
        </p>

        <p class="stat-value">
            {{ $syllabusDocuments->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Active Documents
        </p>

        <p class="stat-value">
            {{ $syllabusDocuments->where('status', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Featured Documents
        </p>

        <p class="stat-value">
            {{ $syllabusDocuments->where('is_featured', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            PDF Uploaded
        </p>

        <p class="stat-value">
            {{ $syllabusDocuments->filter(function ($item) {
                return !empty($item->document);
            })->count() }}
        </p>
    </div>

</div>

<div class="page-card">

    <div class="page-card-header">
        <p class="page-card-title">
            All Syllabus Documents
        </p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-SyllabusDocument">

            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Syllabus</th>
                    <th>Course / Subject</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>Document</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th style="text-align:right;">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach($syllabusDocuments as $syllabusDocument)

                    <tr data-entry-id="{{ $syllabusDocument->id }}">

                        <td></td>

                        <td>
                            <span class="id-text">
                                #{{ $syllabusDocument->id }}
                            </span>
                        </td>

                        <td>
                            <div class="inline-flex-center">

                                <div class="syllabus-table-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>

                                <div>
                                    <p class="table-main-text">
                                        {{ $syllabusDocument->title }}
                                    </p>

                                    <p class="table-sub-text">
                                        {{ $syllabusDocument->document_type ?: $syllabusDocument->slug }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td>
                            <p class="table-main-text">
                                {{ optional($syllabusDocument->course)->name ?: '—' }}
                            </p>

                            <p class="table-sub-text">
                                {{ optional($syllabusDocument->subject)->name ?: 'Complete Course Syllabus' }}
                            </p>
                        </td>

                        <td>
                            <span class="syllabus-session-tag">
                                {{ $syllabusDocument->academic_session }}
                            </span>
                        </td>

                        <td>
                            @if($syllabusDocument->semester)
                                <span class="table-value-text">
                                    {{ $syllabusDocument->semester }}
                                </span>
                            @else
                                <span class="table-empty">
                                    All / Not specified
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($syllabusDocument->document)

                                <a href="{{ $syllabusDocument->document['url'] }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="syllabus-file-status uploaded">

                                    <i class="fas fa-file-pdf"></i>
                                    PDF
                                </a>

                            @elseif($syllabusDocument->external_url)

                                <a href="{{ $syllabusDocument->external_url }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="syllabus-file-status external">

                                    <i class="fas fa-external-link-alt"></i>
                                    External
                                </a>

                            @else

                                <span class="syllabus-file-status missing">
                                    <i class="fas fa-file"></i>
                                    Missing
                                </span>

                            @endif
                        </td>

                        <td>
                            @if($syllabusDocument->is_featured)

                                <span class="syllabus-featured active">
                                    <i class="fas fa-star"></i>
                                    Featured
                                </span>

                            @else

                                <span class="syllabus-featured inactive">
                                    <i class="far fa-star"></i>
                                    Normal
                                </span>

                            @endif
                        </td>

                        <td>
                            @if($syllabusDocument->status)

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>

                                    <span class="syllabus-status-text active">
                                        Active
                                    </span>
                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>

                                    <span class="syllabus-status-text inactive">
                                        Inactive
                                    </span>
                                </div>

                            @endif
                        </td>

                        <td>
                            <div class="action-row">

                                @can('syllabus_document_show')
                                    <a href="{{ route('admin.syllabus-documents.show', $syllabusDocument->id) }}"
                                       class="btn-outline">

                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('syllabus_document_edit')
                                    <a href="{{ route('admin.syllabus-documents.edit', $syllabusDocument->id) }}"
                                       class="btn-outline btn-outline-edit">

                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('syllabus_document_delete')
                                    <form action="{{ route('admin.syllabus-documents.destroy', $syllabusDocument->id) }}"
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
    .syllabus-table-icon {
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

    .syllabus-session-tag {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .table-value-text {
        color: #475569;
        font-size: 13px;
    }

    .table-empty {
        color: #94a3b8;
        font-size: 12px;
    }

    .syllabus-file-status,
    .syllabus-featured {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .syllabus-file-status.uploaded {
        background: #dcfce7;
        color: #166534;
    }

    .syllabus-file-status.external {
        background: #e0f2fe;
        color: #0369a1;
    }

    .syllabus-file-status.missing {
        background: #fef3c7;
        color: #92400e;
    }

    .syllabus-featured.active {
        background: #fffbeb;
        color: #b45309;
    }

    .syllabus-featured.inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .syllabus-status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .syllabus-status-text.active {
        color: #166534;
    }

    .syllabus-status-text.inactive {
        color: #92400e;
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-SyllabusDocument', {
        canDelete: @can('syllabus_document_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.syllabus-documents.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search syllabus documents...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ syllabus documents'
    });
});
</script>

@endsection