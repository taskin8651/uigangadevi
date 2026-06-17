@extends('layouts.admin')

@section('page-title', 'Notice Details')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.notices.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>
        <h2 class="admin-page-title">Notice Details</h2>
        <p class="admin-page-subtitle">{{ $notice->title }}</p>
    </div>

    @can('notice_edit')
        <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn-primary">
            <i class="fas fa-pencil-alt"></i>
            Edit Notice
        </a>
    @endcan
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">{{ $notice->title }}</p>
        <span class="page-card-note">{{ $notice->category ?: 'Other' }}</span>
    </div>

    <div class="admin-show-grid">
        <div class="admin-show-item">
            <span>Date</span>
            <strong>{{ optional($notice->notice_date)->format('d M Y') ?: 'Not set' }}</strong>
        </div>

        <div class="admin-show-item">
            <span>Status</span>
            <strong>{{ $notice->status ? 'Active' : 'Inactive' }}</strong>
        </div>

        <div class="admin-show-item">
            <span>Latest</span>
            <strong>{{ $notice->is_latest ? 'Yes' : 'No' }}</strong>
        </div>

        <div class="admin-show-item">
            <span>Sort Order</span>
            <strong>{{ $notice->sort_order }}</strong>
        </div>
    </div>

    @if($notice->short_description)
        <div class="admin-show-content">
            <h3>Description</h3>
            <p>{{ $notice->short_description }}</p>
        </div>
    @endif

    @if($notice->download_url)
        <div class="admin-show-content">
            <h3>Document</h3>
            <a href="{{ $notice->download_url }}" target="_blank" rel="noopener" class="btn-outline">
                <i class="fas fa-external-link-alt"></i>
                {{ $notice->button_text ?: 'Open Notice' }}
            </a>
        </div>
    @endif
</div>

<style>
    .admin-show-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        padding: 22px;
    }

    .admin-show-item {
        padding: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f8fafc;
    }

    .admin-show-item span {
        display: block;
        margin-bottom: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .admin-show-item strong {
        color: #111827;
        font-size: 14px;
    }

    .admin-show-content {
        padding: 0 22px 22px;
    }

    .admin-show-content h3 {
        margin: 0 0 8px;
        color: #111827;
        font-size: 16px;
        font-weight: 800;
    }

    .admin-show-content p {
        margin: 0;
        color: #475569;
        line-height: 1.7;
    }

    @media(max-width: 991px) {
        .admin-show-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 575px) {
        .admin-show-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@endsection
