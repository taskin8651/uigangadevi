@extends('layouts.admin')

@section('page-title', 'Disclosure Document Details')

@section('content')

@php
    $section = strtolower($disclosureDocument->section ?: 'rti');

    $sectionConfig = [
        'rti' => [
            'label'      => 'RTI',
            'icon'       => 'fas fa-balance-scale',
            'color'      => '#1D4ED8',
            'background' => '#EFF6FF',
            'border'     => '#BFDBFE',
        ],

        'naac' => [
            'label'      => 'NAAC / IQAC',
            'icon'       => 'fas fa-award',
            'color'      => '#7E22CE',
            'background' => '#F3E8FF',
            'border'     => '#E9D5FF',
        ],
    ];

    $sectionStyle = $sectionConfig[$section] ?? [
        'label'      => ucfirst($section),
        'icon'       => 'fas fa-file-alt',
        'color'      => '#475569',
        'background' => '#F1F5F9',
        'border'     => '#E2E8F0',
    ];

    $documentTitle = $disclosureDocument->title ?: 'Untitled Disclosure Document';

    $documentFile = $disclosureDocument->document ?? null;

    $downloadUrl = $disclosureDocument->download_url
        ?: $disclosureDocument->external_url;

    $hasUploadedFile = !empty($documentFile);
    $hasExternalUrl = !empty($disclosureDocument->external_url);
@endphp

<div class="admin-page-head">

    <div>
        <a href="{{ route('admin.disclosure-documents.index') }}"
           class="admin-back-link">

            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Disclosure Document Details
        </h2>

        <p class="admin-page-subtitle">
            Complete document, section, category, file and visibility information
        </p>
    </div>

    <div class="show-actions">

        @can('disclosure_document_edit')
            <a href="{{ route('admin.disclosure-documents.edit', $disclosureDocument->id) }}"
               class="btn-primary">

                <i class="fas fa-pencil-alt"></i>
                Edit Document
            </a>
        @endcan

        @can('disclosure_document_delete')
            <form action="{{ route('admin.disclosure-documents.destroy', $disclosureDocument->id) }}"
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

    {{-- =====================================================
         LEFT COLUMN
    ====================================================== --}}
    <div>

        {{-- DOCUMENT PROFILE CARD --}}
        <div class="detail-card mb-3">

            <div class="profile-hero disclosure-profile-hero">

                <div class="disclosure-profile-icon"
                     style="
                        color: {{ $sectionStyle['color'] }};
                        background: {{ $sectionStyle['background'] }};
                        border-color: {{ $sectionStyle['border'] }};
                     ">

                    <i class="{{ $sectionStyle['icon'] }}"></i>
                </div>

                <p class="profile-title">
                    {{ $documentTitle }}
                </p>

                <p class="profile-subtitle">
                    {{ $disclosureDocument->category ?: 'General Document' }}
                </p>

                <span class="disclosure-section-badge"
                      style="
                        color: {{ $sectionStyle['color'] }};
                        background: {{ $sectionStyle['background'] }};
                        border-color: {{ $sectionStyle['border'] }};
                      ">

                    <i class="{{ $sectionStyle['icon'] }}"></i>
                    {{ $sectionStyle['label'] }}
                </span>

                <div class="disclosure-profile-status">

                    @if($disclosureDocument->status)

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

                    @if($hasUploadedFile)

                        <span class="status-pill disclosure-file-pill">
                            <i class="fas fa-file-pdf"></i>
                            PDF Uploaded
                        </span>

                    @elseif($hasExternalUrl)

                        <span class="status-pill disclosure-link-pill">
                            <i class="fas fa-external-link-alt"></i>
                            External Link
                        </span>

                    @endif

                </div>

            </div>

            <div class="detail-section-pad-sm">

                <div class="disclosure-mini-stats">

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Document ID
                        </p>

                        <p class="stat-mini-value">
                            #{{ $disclosureDocument->id }}
                        </p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Year
                        </p>

                        <p class="stat-mini-value">
                            {{ $disclosureDocument->year ?: '—' }}
                        </p>
                    </div>

                    <div class="stat-mini disclosure-stat-full">
                        <p class="stat-mini-label">
                            Added On
                        </p>

                        <p class="stat-mini-value-sm">
                            {{ optional($disclosureDocument->created_at)->format('d M Y') ?? '—' }}
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

                @can('disclosure_document_edit')
                    <a href="{{ route('admin.disclosure-documents.edit', $disclosureDocument->id) }}"
                       class="quick-link primary">

                        <i class="fas fa-edit"></i>
                        Edit Document
                    </a>
                @endcan

                <a href="{{ route('admin.disclosure-documents.index') }}"
                   class="quick-link">

                    <i class="fas fa-list"></i>
                    All Disclosure Documents
                </a>

                @can('disclosure_document_create')
                    <a href="{{ route('admin.disclosure-documents.create') }}"
                       class="quick-link">

                        <i class="fas fa-plus-circle"></i>
                        Add New Document
                    </a>
                @endcan

                @if($downloadUrl)

                    <a href="{{ $downloadUrl }}"
                       target="_blank"
                       rel="noopener"
                       class="quick-link">

                        <i class="fas fa-download"></i>
                        Open Document
                    </a>

                @endif

            </div>

        </div>

    </div>

    {{-- =====================================================
         RIGHT COLUMN
    ====================================================== --}}
    <div>

        {{-- DOCUMENT DETAILS --}}
        <div class="detail-card mb-3">

            <div class="detail-section-head">

                <div class="detail-section-icon">
                    <i class="fas fa-id-card"></i>
                </div>

                <p class="detail-section-title">
                    Document Information
                </p>

            </div>

            <div class="detail-section-body">

                <div class="detail-row">
                    <span class="detail-label">
                        Document ID
                    </span>

                    <span class="detail-value code-pill">
                        #{{ $disclosureDocument->id }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Title
                    </span>

                    <span class="detail-value">
                        {{ $documentTitle }}
                    </span>
                </div>

                @if(!empty($disclosureDocument->slug))

                    <div class="detail-row">
                        <span class="detail-label">
                            Slug
                        </span>

                        <span class="detail-value code-pill">
                            {{ $disclosureDocument->slug }}
                        </span>
                    </div>

                @endif

                <div class="detail-row">
                    <span class="detail-label">
                        Section
                    </span>

                    <span class="disclosure-detail-section"
                          style="
                            color: {{ $sectionStyle['color'] }};
                            background: {{ $sectionStyle['background'] }};
                            border-color: {{ $sectionStyle['border'] }};
                          ">

                        <i class="{{ $sectionStyle['icon'] }}"></i>
                        {{ $sectionStyle['label'] }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Category
                    </span>

                    @if($disclosureDocument->category)

                        <span class="disclosure-category-badge">
                            <i class="fas fa-tag"></i>
                            {{ $disclosureDocument->category }}
                        </span>

                    @else

                        <span class="disclosure-empty-value">
                            General
                        </span>

                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Year
                    </span>

                    @if($disclosureDocument->year)

                        <span class="disclosure-year-badge">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $disclosureDocument->year }}
                        </span>

                    @else

                        <span class="disclosure-empty-value">
                            Not specified
                        </span>

                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Sort Order
                    </span>

                    <span class="disclosure-order-badge">
                        {{ $disclosureDocument->sort_order ?? 0 }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Visibility
                    </span>

                    @if($disclosureDocument->status)

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
                        Created At
                    </span>

                    <span class="detail-value">
                        {{ optional($disclosureDocument->created_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Updated At
                    </span>

                    <span class="detail-value">
                        {{ optional($disclosureDocument->updated_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

        {{-- DESCRIPTION --}}
        @if(!empty($disclosureDocument->description))

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-align-left"></i>
                    </div>

                    <p class="detail-section-title">
                        Document Description
                    </p>

                </div>

                <div class="disclosure-description-box">
                    {!! $disclosureDocument->description !!}
                </div>

            </div>

        @endif

        {{-- DOWNLOAD INFORMATION --}}
        <div class="detail-card mb-3">

            <div class="detail-section-head between">

                <div class="d-flex align-items-center gap-2">

                    <div class="detail-section-icon">
                        <i class="fas fa-file-download"></i>
                    </div>

                    <p class="detail-section-title">
                        Download Information
                    </p>

                </div>

                @if($downloadUrl)

                    <span class="status-pill success">
                        <i class="fas fa-check-circle"></i>
                        Available
                    </span>

                @else

                    <span class="status-pill warning">
                        <i class="fas fa-exclamation-circle"></i>
                        Missing
                    </span>

                @endif

            </div>

            <div class="detail-section-pad-sm">

                @if($hasUploadedFile)

                    <div class="disclosure-document-card">

                        <div class="disclosure-document-icon pdf">
                            <i class="fas fa-file-pdf"></i>
                        </div>

                        <div class="disclosure-document-content">

                            <span>
                                Uploaded PDF Document
                            </span>

                            <strong>
                                {{ $documentFile['name'] ?? 'Disclosure Document.pdf' }}
                            </strong>

                            @if(!empty($documentFile['size']))

                                <small>
                                    {{ number_format(
                                        $documentFile['size'] / 1024,
                                        1
                                    ) }} KB
                                </small>

                            @endif

                        </div>

                        <a href="{{ $documentFile['url'] ?? $downloadUrl }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-primary">

                            <i class="fas fa-download"></i>
                            {{ $disclosureDocument->button_text ?: 'Open Document' }}
                        </a>

                    </div>

                @elseif($hasExternalUrl)

                    <div class="disclosure-document-card">

                        <div class="disclosure-document-icon external">
                            <i class="fas fa-external-link-alt"></i>
                        </div>

                        <div class="disclosure-document-content">

                            <span>
                                External Document Link
                            </span>

                            <strong>
                                University or official document URL
                            </strong>

                            <a href="{{ $disclosureDocument->external_url }}"
                               target="_blank"
                               rel="noopener">

                                {{ $disclosureDocument->external_url }}
                            </a>

                        </div>

                        <a href="{{ $disclosureDocument->external_url }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-primary">

                            <i class="fas fa-external-link-alt"></i>
                            {{ $disclosureDocument->button_text ?: 'Open Link' }}
                        </a>

                    </div>

                @elseif($downloadUrl)

                    <div class="disclosure-document-card">

                        <div class="disclosure-document-icon available">
                            <i class="fas fa-download"></i>
                        </div>

                        <div class="disclosure-document-content">
                            <span>Document Available</span>
                            <strong>{{ $documentTitle }}</strong>
                        </div>

                        <a href="{{ $downloadUrl }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-primary">

                            <i class="fas fa-download"></i>
                            {{ $disclosureDocument->button_text ?: 'Open Document' }}
                        </a>

                    </div>

                @else

                    <div class="assign-empty">

                        <div class="assign-empty-icon">
                            <i class="fas fa-file-excel"></i>
                        </div>

                        <p class="assign-empty-title">
                            No document available
                        </p>

                        <p class="assign-empty-text">
                            No PDF file or external document URL has been added.
                        </p>

                        @can('disclosure_document_edit')
                            <a href="{{ route('admin.disclosure-documents.edit', $disclosureDocument->id) }}"
                               class="btn-primary mt-3">

                                <i class="fas fa-upload"></i>
                                Add Document
                            </a>
                        @endcan

                    </div>

                @endif

            </div>

        </div>

        {{-- EXTERNAL URL --}}
        @if($disclosureDocument->external_url)

            <div class="detail-card">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-link"></i>
                    </div>

                    <p class="detail-section-title">
                        External URL
                    </p>

                </div>

                <div class="detail-section-pad-sm">

                    <div class="disclosure-url-box">

                        <div class="disclosure-url-icon">
                            <i class="fas fa-external-link-alt"></i>
                        </div>

                        <div class="disclosure-url-content">

                            <strong>
                                Official Document Link
                            </strong>

                            <a href="{{ $disclosureDocument->external_url }}"
                               target="_blank"
                               rel="noopener">

                                {{ $disclosureDocument->external_url }}
                            </a>

                        </div>

                        <a href="{{ $disclosureDocument->external_url }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-primary">

                            <i class="fas fa-external-link-alt"></i>
                            Open
                        </a>

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>

<style>
    /* =========================================================
       PROFILE
    ========================================================= */

    .disclosure-profile-hero {
        padding-bottom: 24px;
    }

    .disclosure-profile-icon {
        width: 126px;
        height: 126px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        border: 5px solid;
        border-radius: 30px;
        font-size: 40px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .12);
    }

    .disclosure-section-badge,
    .disclosure-detail-section,
    .disclosure-category-badge,
    .disclosure-year-badge,
    .disclosure-order-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 7px 11px;
        border: 1px solid;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.2;
    }

    .disclosure-section-badge {
        margin: 9px auto 12px;
    }

    .disclosure-category-badge {
        border-color: #DBEAFE;
        background: #F8FAFC;
        color: #475569;
    }

    .disclosure-year-badge {
        border-color: #BBF7D0;
        background: #ECFDF5;
        color: #047857;
    }

    .disclosure-order-badge {
        min-width: 36px;
        border-color: #E2E8F0;
        background: #F1F5F9;
        color: #475569;
    }

    .disclosure-profile-status {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }

    .disclosure-file-pill {
        background: #FEE2E2;
        color: #B91C1C;
    }

    .disclosure-link-pill {
        background: #E0F2FE;
        color: #0369A1;
    }

    .disclosure-mini-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .disclosure-stat-full {
        grid-column: 1 / -1;
    }

    /* =========================================================
       DESCRIPTION
    ========================================================= */

    .disclosure-description-box {
        padding: 20px;
        color: #475569;
        font-size: 14px;
        line-height: 1.8;
    }

    .disclosure-description-box p:last-child {
        margin-bottom: 0;
    }

    /* =========================================================
       DOCUMENT CARD
    ========================================================= */

    .disclosure-document-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border: 1px solid #E2E8F0;
        border-radius: 15px;
        background: #F8FAFC;
    }

    .disclosure-document-icon {
        width: 52px;
        height: 52px;
        flex: 0 0 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 22px;
    }

    .disclosure-document-icon.pdf {
        background: #FEE2E2;
        color: #DC2626;
    }

    .disclosure-document-icon.external {
        background: #E0F2FE;
        color: #0369A1;
    }

    .disclosure-document-icon.available {
        background: #DCFCE7;
        color: #166534;
    }

    .disclosure-document-content {
        min-width: 0;
        flex: 1;
    }

    .disclosure-document-content span,
    .disclosure-document-content strong,
    .disclosure-document-content small,
    .disclosure-document-content a {
        display: block;
    }

    .disclosure-document-content span {
        margin-bottom: 3px;
        color: #64748B;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .disclosure-document-content strong {
        color: #1F2937;
        font-size: 13px;
        word-break: break-word;
    }

    .disclosure-document-content small {
        margin-top: 4px;
        color: #94A3B8;
        font-size: 11px;
    }

    .disclosure-document-content a {
        margin-top: 4px;
        overflow: hidden;
        color: #4F46E5;
        font-size: 11.5px;
        font-weight: 600;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* =========================================================
       EXTERNAL URL
    ========================================================= */

    .disclosure-url-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border: 1px solid #BAE6FD;
        border-radius: 15px;
        background: #F0F9FF;
    }

    .disclosure-url-icon {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #E0F2FE;
        color: #0369A1;
        font-size: 19px;
    }

    .disclosure-url-content {
        min-width: 0;
        flex: 1;
    }

    .disclosure-url-content strong {
        display: block;
        margin-bottom: 4px;
        color: #1F2937;
        font-size: 13px;
    }

    .disclosure-url-content a {
        display: block;
        overflow: hidden;
        color: #0369A1;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .disclosure-empty-value {
        color: #94A3B8;
        font-size: 12px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {
        .disclosure-document-card,
        .disclosure-url-box {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .disclosure-document-card > .btn-primary,
        .disclosure-url-box > .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 575px) {
        .disclosure-mini-stats {
            grid-template-columns: 1fr;
        }

        .disclosure-stat-full {
            grid-column: auto;
        }

        .disclosure-profile-icon {
            width: 105px;
            height: 105px;
            font-size: 34px;
        }

        .detail-section-head.between {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

@endsection