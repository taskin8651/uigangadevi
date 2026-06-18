@extends('layouts.admin')

@section('page-title', 'Disclosure Documents')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Disclosure Documents
        </h2>

        <p class="admin-page-subtitle">
            Manage RTI, NAAC, IQAC, statutory disclosure and public information documents
        </p>
    </div>

    @can('disclosure_document_create')
        <a href="{{ route('admin.disclosure-documents.create') }}"
           class="btn-primary">

            <i class="fas fa-plus"></i>
            Add Document
        </a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

{{-- STATISTICS --}}
<div class="stats-grid">

    <div class="stat-card">
        <p class="stat-label">
            Total Documents
        </p>

        <p class="stat-value">
            {{ $documents->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            RTI Documents
        </p>

        <p class="stat-value">
            {{ $documents->where('section', 'rti')->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            NAAC / IQAC
        </p>

        <p class="stat-value">
            {{ $documents->where('section', 'naac')->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Active Documents
        </p>

        <p class="stat-value">
            {{ $documents->where('status', true)->count() }}
        </p>
    </div>

</div>

{{-- DOCUMENT TABLE --}}
<div class="page-card">

    <div class="page-card-header">

        <p class="page-card-title">
            All Disclosure Documents
        </p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>

    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-DisclosureDocument">

            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Document</th>
                    <th>Section</th>
                    <th>Category</th>
                    <th>Year</th>
                    <th>File</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="text-align:right;">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach($documents as $document)

                    @php
                        $section = strtolower($document->section ?: 'other');

                        $sectionConfig = [
                            'rti' => [
                                'label' => 'RTI',
                                'icon' => 'fas fa-balance-scale',
                                'background' => '#eff6ff',
                                'color' => '#1d4ed8',
                            ],

                            'naac' => [
                                'label' => 'NAAC / IQAC',
                                'icon' => 'fas fa-award',
                                'background' => '#f3e8ff',
                                'color' => '#7e22ce',
                            ],
                        ];

                        $sectionStyle = $sectionConfig[$section] ?? [
                            'label' => ucfirst($section),
                            'icon' => 'fas fa-file-alt',
                            'background' => '#f1f5f9',
                            'color' => '#475569',
                        ];

                        $hasUploadedDocument = !empty($document->document);
                        $hasExternalUrl = !empty($document->external_url);
                    @endphp

                    <tr data-entry-id="{{ $document->id }}">

                        <td></td>

                        {{-- ID --}}
                        <td>
                            <span class="id-text">
                                #{{ $document->id }}
                            </span>
                        </td>

                        {{-- TITLE --}}
                        <td>
                            <div class="inline-flex-center">

                                <div class="disclosure-table-icon"
                                     style="
                                         background: {{ $sectionStyle['background'] }};
                                         color: {{ $sectionStyle['color'] }};
                                     ">

                                    <i class="{{ $sectionStyle['icon'] }}"></i>
                                </div>

                                <div class="disclosure-table-content">

                                    <p class="table-main-text">
                                        {{ $document->title ?: 'Untitled Document' }}
                                    </p>

                                    <p class="table-sub-text">
                                        @if($document->description)
                                            {{ \Illuminate\Support\Str::limit(
                                                strip_tags($document->description),
                                                70
                                            ) }}
                                        @elseif($document->button_text)
                                            {{ $document->button_text }}
                                        @else
                                            Public disclosure document
                                        @endif
                                    </p>

                                </div>

                            </div>
                        </td>

                        {{-- SECTION --}}
                        <td>
                            <span class="disclosure-section-pill"
                                  style="
                                      background: {{ $sectionStyle['background'] }};
                                      color: {{ $sectionStyle['color'] }};
                                  ">

                                <i class="{{ $sectionStyle['icon'] }}"></i>
                                {{ $sectionStyle['label'] }}
                            </span>
                        </td>

                        {{-- CATEGORY --}}
                        <td>
                            @if($document->category)

                                <span class="disclosure-category-pill">
                                    <i class="fas fa-tag"></i>
                                    {{ $document->category }}
                                </span>

                            @else

                                <span class="disclosure-empty-text">
                                    General
                                </span>

                            @endif
                        </td>

                        {{-- YEAR --}}
                        <td>
                            @if($document->year)

                                <span class="disclosure-year-pill">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $document->year }}
                                </span>

                            @else

                                <span class="disclosure-empty-text">
                                    —
                                </span>

                            @endif
                        </td>

                        {{-- FILE --}}
                        <td>
                            @if($hasUploadedDocument)

                                <a href="{{ $document->document['url'] ?? $document->download_url }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="disclosure-file-pill pdf">

                                    <i class="fas fa-file-pdf"></i>
                                    PDF
                                </a>

                            @elseif($hasExternalUrl)

                                <a href="{{ $document->external_url }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="disclosure-file-pill external">

                                    <i class="fas fa-external-link-alt"></i>
                                    External
                                </a>

                            @elseif($document->download_url)

                                <a href="{{ $document->download_url }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="disclosure-file-pill available">

                                    <i class="fas fa-download"></i>
                                    Open
                                </a>

                            @else

                                <span class="disclosure-file-pill missing">
                                    <i class="fas fa-file"></i>
                                    Missing
                                </span>

                            @endif
                        </td>

                        {{-- SORT ORDER --}}
                        <td>
                            <span class="disclosure-sort-order">
                                {{ $document->sort_order ?? 0 }}
                            </span>
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($document->status)

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>

                                    <span class="disclosure-status-text active">
                                        Active
                                    </span>
                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>

                                    <span class="disclosure-status-text inactive">
                                        Inactive
                                    </span>
                                </div>

                            @endif
                        </td>

                        {{-- ACTIONS --}}
                        <td>
                            <div class="action-row">

                                @can('disclosure_document_show')
                                    <a href="{{ route('admin.disclosure-documents.show', $document->id) }}"
                                       class="btn-outline">

                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('disclosure_document_edit')
                                    <a href="{{ route('admin.disclosure-documents.edit', $document->id) }}"
                                       class="btn-outline btn-outline-edit">

                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('disclosure_document_delete')
                                    <form action="{{ route('admin.disclosure-documents.destroy', $document->id) }}"
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
    /* =========================================================
       DOCUMENT INFORMATION
    ========================================================= */

    .disclosure-table-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 17px;
    }

    .disclosure-table-content {
        min-width: 210px;
    }

    /* =========================================================
       PILLS
    ========================================================= */

    .disclosure-section-pill,
    .disclosure-category-pill,
    .disclosure-year-pill,
    .disclosure-file-pill,
    .disclosure-sort-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.2;
        text-decoration: none;
        white-space: nowrap;
    }

    .disclosure-category-pill {
        border: 1px solid #dbeafe;
        background: #f8fafc;
        color: #475569;
    }

    .disclosure-year-pill {
        background: #ecfdf5;
        color: #047857;
    }

    .disclosure-file-pill.pdf {
        background: #fee2e2;
        color: #b91c1c;
    }

    .disclosure-file-pill.external {
        background: #e0f2fe;
        color: #0369a1;
    }

    .disclosure-file-pill.available {
        background: #dcfce7;
        color: #166534;
    }

    .disclosure-file-pill.missing {
        background: #fef3c7;
        color: #92400e;
    }

    .disclosure-sort-order {
        min-width: 34px;
        background: #f1f5f9;
        color: #475569;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .disclosure-status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .disclosure-status-text.active {
        color: #166534;
    }

    .disclosure-status-text.inactive {
        color: #92400e;
    }

    .disclosure-empty-text {
        color: #94a3b8;
        font-size: 12px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {
        .disclosure-table-icon {
            width: 40px;
            height: 40px;
            flex-basis: 40px;
        }

        .disclosure-table-content {
            min-width: 170px;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-DisclosureDocument', {
        canDelete:
            @can('disclosure_document_delete')
                true
            @else
                false
            @endcan,

        massDeleteUrl:
            "{{ route('admin.disclosure-documents.massDestroy') }}",

        deleteText:
            "{{ trans('global.datatables.delete') }}",

        zeroSelectedText:
            "{{ trans('global.datatables.zero_selected') }}",

        confirmText:
            "{{ trans('global.areYouSure') }}",

        searchPlaceholder:
            'Search disclosure documents...',

        infoText:
            'Showing _START_–_END_ of _TOTAL_ disclosure documents'
    });
});
</script>

@endsection