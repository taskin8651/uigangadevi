@extends('layouts.admin')

@section('page-title', 'Notices')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Notices</h2>
        <p class="admin-page-subtitle">Manage notice archive, circulars and downloadable PDFs</p>
    </div>

    @can('notice_create')
        <a href="{{ route('admin.notices.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Notice
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
        <p class="stat-label">Total Notices</p>
        <p class="stat-value">{{ $notices->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active Notices</p>
        <p class="stat-value">{{ $notices->where('status', true)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Latest Notices</p>
        <p class="stat-value">{{ $notices->where('is_latest', true)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">PDF Uploaded</p>
        <p class="stat-value">{{ $notices->filter(fn ($notice) => !empty($notice->document))->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Notices</p>
        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">
        <table class="min-w-full datatable datatable-Notice">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Notice</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Document</th>
                    <th>Latest</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($notices as $notice)
                    <tr data-entry-id="{{ $notice->id }}">
                        <td></td>
                        <td><span class="id-text">#{{ $notice->id }}</span></td>
                        <td>
                            <div class="inline-flex-center">
                                <div class="notice-table-icon">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <div>
                                    <p class="table-main-text">{{ $notice->title }}</p>
                                    <p class="table-sub-text">{{ $notice->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="notice-category-tag">
                                {{ $notice->category ?: 'Other' }}
                            </span>
                        </td>
                        <td>
                            @if($notice->notice_date)
                                <span class="table-value-text">
                                    {{ $notice->notice_date->format('d M Y') }}
                                </span>
                            @else
                                <span class="table-empty">Not set</span>
                            @endif
                        </td>
                        <td>
                            @if($notice->document)
                                <a href="{{ $notice->document['url'] }}" target="_blank" rel="noopener" class="notice-file-status uploaded">
                                    <i class="fas fa-file-pdf"></i>
                                    PDF
                                </a>
                            @elseif($notice->external_url)
                                <a href="{{ $notice->external_url }}" target="_blank" rel="noopener" class="notice-file-status external">
                                    <i class="fas fa-external-link-alt"></i>
                                    External
                                </a>
                            @else
                                <span class="notice-file-status missing">
                                    <i class="fas fa-file"></i>
                                    Missing
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($notice->is_latest)
                                <span class="notice-featured active">
                                    <i class="fas fa-star"></i>
                                    Latest
                                </span>
                            @else
                                <span class="notice-featured inactive">
                                    <i class="far fa-star"></i>
                                    Normal
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($notice->status)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>
                                    <span class="notice-status-text active">Active</span>
                                </div>
                            @else
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>
                                    <span class="notice-status-text inactive">Inactive</span>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="action-row">
                                @can('notice_show')
                                    <a href="{{ route('admin.notices.show', $notice->id) }}" class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('notice_edit')
                                    <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('notice_delete')
                                    <form action="{{ route('admin.notices.destroy', $notice->id) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}')">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn-outline btn-outline-danger">
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
    .notice-table-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #fff7ed;
        color: #ea580c;
        font-size: 17px;
    }

    .notice-category-tag,
    .notice-file-status,
    .notice-featured {
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

    .notice-category-tag {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .notice-file-status.uploaded {
        background: #dcfce7;
        color: #166534;
    }

    .notice-file-status.external {
        background: #e0f2fe;
        color: #0369a1;
    }

    .notice-file-status.missing {
        background: #fef3c7;
        color: #92400e;
    }

    .notice-featured.active {
        background: #fffbeb;
        color: #b45309;
    }

    .notice-featured.inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .notice-status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .notice-status-text.active {
        color: #166534;
    }

    .notice-status-text.inactive {
        color: #92400e;
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-Notice', {
        canDelete: @can('notice_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.notices.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search notices...',
        infoText: 'Showing _START_-_END_ of _TOTAL_ notices'
    });
});
</script>

@endsection
