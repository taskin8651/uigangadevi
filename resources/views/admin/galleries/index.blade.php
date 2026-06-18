@extends('layouts.admin')

@section('page-title', 'Gallery')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Gallery
        </h2>

        <p class="admin-page-subtitle">
            Manage gallery images, videos, albums, categories and frontend visibility
        </p>
    </div>

    @can('gallery_create')
        <a href="{{ route('admin.galleries.create') }}"
           class="btn-primary">

            <i class="fas fa-plus"></i>
            Add Gallery
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
            Total Items
        </p>

        <p class="stat-value">
            {{ $galleries->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Images
        </p>

        <p class="stat-value">
            {{ $galleries->where('type', 'image')->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Videos
        </p>

        <p class="stat-value">
            {{ $galleries->where('type', 'video')->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Active Items
        </p>

        <p class="stat-value">
            {{ $galleries->where('status', true)->count() }}
        </p>
    </div>

</div>

<div class="page-card">

    <div class="page-card-header">
        <p class="page-card-title">
            All Gallery Items
        </p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-Gallery">

            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Gallery Item</th>
                    <th>Category</th>
                    <th>Media Type</th>
                    <th>Featured</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th style="text-align:right;">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach($galleries as $gallery)

                    @php
                        $typeColors = [
                            'image' => [
                                'background' => '#eff6ff',
                                'color' => '#1d4ed8',
                                'icon' => 'fas fa-image',
                            ],

                            'video' => [
                                'background' => '#fef2f2',
                                'color' => '#dc2626',
                                'icon' => 'fas fa-video',
                            ],

                            'album' => [
                                'background' => '#f3e8ff',
                                'color' => '#7e22ce',
                                'icon' => 'fas fa-images',
                            ],
                        ];

                        $typeStyle = $typeColors[$gallery->type] ?? [
                            'background' => '#f1f5f9',
                            'color' => '#475569',
                            'icon' => 'fas fa-photo-video',
                        ];
                    @endphp

                    <tr data-entry-id="{{ $gallery->id }}">

                        <td></td>

                        <td>
                            <span class="id-text">
                                #{{ $gallery->id }}
                            </span>
                        </td>

                        <td>
                            <div class="inline-flex-center">

                                <div class="gallery-table-media">

                                    @if($gallery->image)

                                        <img src="{{ $gallery->image }}"
                                             alt="{{ $gallery->title }}"
                                             class="gallery-table-image">

                                        @if($gallery->type === 'video')
                                            <span class="gallery-video-indicator">
                                                <i class="fas fa-play"></i>
                                            </span>
                                        @endif

                                    @else

                                        <div class="gallery-table-placeholder"
                                             style="
                                                 background: {{ $typeStyle['background'] }};
                                                 color: {{ $typeStyle['color'] }};
                                             ">

                                            <i class="{{ $typeStyle['icon'] }}"></i>
                                        </div>

                                    @endif

                                </div>

                                <div class="gallery-table-content">

                                    <p class="table-main-text">
                                        {{ $gallery->title }}
                                    </p>

                                    <p class="table-sub-text">
                                        @if($gallery->description)
                                            {{ \Illuminate\Support\Str::limit(
                                                strip_tags($gallery->description),
                                                65
                                            ) }}
                                        @else
                                            No description available
                                        @endif
                                    </p>

                                </div>

                            </div>
                        </td>

                        <td>
                            @if($gallery->category)

                                <span class="gallery-category-pill">
                                    <i class="fas fa-tag"></i>
                                    {{ $gallery->category }}
                                </span>

                            @else

                                <span class="gallery-empty-text">
                                    Uncategorized
                                </span>

                            @endif
                        </td>

                        <td>
                            <span class="gallery-type-pill"
                                  style="
                                      background: {{ $typeStyle['background'] }};
                                      color: {{ $typeStyle['color'] }};
                                  ">

                                <i class="{{ $typeStyle['icon'] }}"></i>

                                {{ ucfirst($gallery->type ?: 'media') }}
                            </span>
                        </td>

                        <td>
                            @if($gallery->is_featured)

                                <span class="gallery-featured-pill active">
                                    <i class="fas fa-star"></i>
                                    Featured
                                </span>

                            @else

                                <span class="gallery-featured-pill">
                                    <i class="far fa-star"></i>
                                    Normal
                                </span>

                            @endif
                        </td>

                        <td>
                            <span class="gallery-sort-order">
                                {{ $gallery->sort_order ?? 0 }}
                            </span>
                        </td>

                        <td>
                            @if($gallery->status)

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>

                                    <span class="gallery-status-text active">
                                        Active
                                    </span>
                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>

                                    <span class="gallery-status-text inactive">
                                        Inactive
                                    </span>
                                </div>

                            @endif
                        </td>

                        <td>
                            <div class="action-row">

                                @can('gallery_show')
                                    <a href="{{ route('admin.galleries.show', $gallery->id) }}"
                                       class="btn-outline">

                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('gallery_edit')
                                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                                       class="btn-outline btn-outline-edit">

                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('gallery_delete')
                                    <form action="{{ route('admin.galleries.destroy', $gallery->id) }}"
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
    .gallery-table-media {
        position: relative;
        width: 58px;
        height: 44px;
        flex: 0 0 58px;
    }

    .gallery-table-image,
    .gallery-table-placeholder {
        width: 58px;
        height: 44px;
        display: block;
        border: 1px solid #e5e7eb;
        border-radius: 11px;
    }

    .gallery-table-image {
        object-fit: cover;
        object-position: center;
        background: #f8fafc;
    }

    .gallery-table-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .gallery-video-indicator {
        position: absolute;
        right: -4px;
        bottom: -4px;
        width: 21px;
        height: 21px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
        border-radius: 50%;
        background: #dc2626;
        color: #ffffff;
        font-size: 7px;
        box-shadow: 0 3px 8px rgba(15, 23, 42, .18);
    }

    .gallery-table-content {
        min-width: 190px;
    }

    .gallery-category-pill,
    .gallery-type-pill,
    .gallery-featured-pill,
    .gallery-sort-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.2;
        white-space: nowrap;
    }

    .gallery-category-pill {
        border: 1px solid #bfdbfe;
        background: #eff6ff;
        color: #1d4ed8;
    }

    .gallery-featured-pill {
        border: 1px solid #e2e8f0;
        background: #f1f5f9;
        color: #64748b;
    }

    .gallery-featured-pill.active {
        border-color: #fde68a;
        background: #fffbeb;
        color: #b45309;
    }

    .gallery-sort-order {
        min-width: 34px;
        background: #f1f5f9;
        color: #475569;
    }

    .gallery-status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .gallery-status-text.active {
        color: #166534;
    }

    .gallery-status-text.inactive {
        color: #92400e;
    }

    .gallery-empty-text {
        color: #94a3b8;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .gallery-table-media,
        .gallery-table-image,
        .gallery-table-placeholder {
            width: 52px;
            height: 40px;
        }

        .gallery-table-media {
            flex-basis: 52px;
        }

        .gallery-table-content {
            min-width: 150px;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {

    initAdminDataTable('.datatable-Gallery', {

        canDelete:
            @can('gallery_delete')
                true
            @else
                false
            @endcan,

        massDeleteUrl:
            "{{ route('admin.galleries.massDestroy') }}",

        deleteText:
            "{{ trans('global.datatables.delete') }}",

        zeroSelectedText:
            "{{ trans('global.datatables.zero_selected') }}",

        confirmText:
            "{{ trans('global.areYouSure') }}",

        searchPlaceholder:
            'Search gallery items...',

        infoText:
            'Showing _START_–_END_ of _TOTAL_ gallery items'
    });

});
</script>

@endsection