@extends('layouts.admin')

@section('page-title', 'Hero Slides')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Hero Slides
        </h2>

        <p class="admin-page-subtitle">
            Manage homepage hero slider images, content, buttons, display order and visibility
        </p>
    </div>

    @can('hero_slide_create')
        <a href="{{ route('admin.hero-slides.create') }}"
           class="btn-primary">

            <i class="fas fa-plus"></i>
            Add Hero Slide
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
            Total Slides
        </p>

        <p class="stat-value">
            {{ $heroSlides->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Active Slides
        </p>

        <p class="stat-value">
            {{ $heroSlides->where('status', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            Inactive Slides
        </p>

        <p class="stat-value">
            {{ $heroSlides->where('status', false)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">
            With Images
        </p>

        <p class="stat-value">
            {{ $heroSlides->filter(function ($heroSlide) {
                return !empty($heroSlide->image);
            })->count() }}
        </p>
    </div>

</div>

{{-- HERO SLIDES TABLE --}}
<div class="page-card">

    <div class="page-card-header">

        <p class="page-card-title">
            All Hero Slides
        </p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>

    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-HeroSlide">

            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Hero Slide</th>
                    <th>Badge</th>
                    <th>Buttons</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="text-align:right;">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach($heroSlides as $heroSlide)

                    <tr data-entry-id="{{ $heroSlide->id }}">

                        <td></td>

                        {{-- ID --}}
                        <td>
                            <span class="id-text">
                                #{{ $heroSlide->id }}
                            </span>
                        </td>

                        {{-- IMAGE + TITLE --}}
                        <td>
                            <div class="inline-flex-center">

                                <div class="hero-table-media">

                                    @if($heroSlide->image)

                                        <img src="{{ $heroSlide->image }}"
                                             alt="{{ $heroSlide->title ?: 'Hero Slide' }}"
                                             class="hero-table-image">

                                    @else

                                        <div class="hero-table-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>

                                    @endif

                                    @if($heroSlide->status)
                                        <span class="hero-image-status active"
                                              title="Active slide">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    @else
                                        <span class="hero-image-status inactive"
                                              title="Inactive slide">
                                            <i class="fas fa-pause"></i>
                                        </span>
                                    @endif

                                </div>

                                <div class="hero-table-content">

                                    <p class="table-main-text">
                                        {{ $heroSlide->title ?: 'Untitled Hero Slide' }}
                                    </p>

                                    <p class="table-sub-text">
                                        @if($heroSlide->description)
                                            {{ \Illuminate\Support\Str::limit(
                                                strip_tags($heroSlide->description),
                                                75
                                            ) }}
                                        @else
                                            No description available
                                        @endif
                                    </p>

                                </div>

                            </div>
                        </td>

                        {{-- BADGE --}}
                        <td>
                            @if($heroSlide->badge_text)

                                <span class="hero-badge-pill">
                                    <i class="fas fa-star"></i>
                                    {{ $heroSlide->badge_text }}
                                </span>

                            @else

                                <span class="hero-empty-text">
                                    No badge
                                </span>

                            @endif
                        </td>

                        {{-- BUTTONS --}}
                        <td>
                            <div class="hero-button-list">

                                @if(!empty($heroSlide->button_one_text))
                                    <span class="hero-button-pill primary">
                                        <i class="fas fa-mouse-pointer"></i>
                                        {{ $heroSlide->button_one_text }}
                                    </span>
                                @endif

                                @if(!empty($heroSlide->button_two_text))
                                    <span class="hero-button-pill secondary">
                                        <i class="fas fa-link"></i>
                                        {{ $heroSlide->button_two_text }}
                                    </span>
                                @endif

                                @if(
                                    empty($heroSlide->button_one_text)
                                    && empty($heroSlide->button_two_text)
                                )
                                    <span class="hero-empty-text">
                                        No buttons
                                    </span>
                                @endif

                            </div>
                        </td>

                        {{-- SORT ORDER --}}
                        <td>
                            <span class="hero-sort-order">
                                {{ $heroSlide->sort_order ?? 0 }}
                            </span>
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($heroSlide->status)

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>

                                    <span class="hero-status-text active">
                                        Active
                                    </span>
                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>

                                    <span class="hero-status-text inactive">
                                        Inactive
                                    </span>
                                </div>

                            @endif
                        </td>

                        {{-- ACTIONS --}}
                        <td>
                            <div class="action-row">

                                @can('hero_slide_show')
                                    <a href="{{ route('admin.hero-slides.show', $heroSlide->id) }}"
                                       class="btn-outline">

                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('hero_slide_edit')
                                    <a href="{{ route('admin.hero-slides.edit', $heroSlide->id) }}"
                                       class="btn-outline btn-outline-edit">

                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('hero_slide_delete')
                                    <form action="{{ route('admin.hero-slides.destroy', $heroSlide->id) }}"
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
       HERO TABLE MEDIA
    ========================================================= */

    .hero-table-media {
        position: relative;
        width: 86px;
        height: 50px;
        flex: 0 0 86px;
    }

    .hero-table-image,
    .hero-table-placeholder {
        width: 86px;
        height: 50px;
        display: block;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #f8fafc;
    }

    .hero-table-image {
        object-fit: cover;
        object-position: center;
    }

    .hero-table-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f46e5;
        font-size: 18px;
        background: #eef2ff;
    }

    .hero-image-status {
        position: absolute;
        right: -5px;
        bottom: -5px;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
        border-radius: 50%;
        color: #fff;
        font-size: 8px;
        box-shadow: 0 4px 10px rgba(15, 23, 42, .18);
    }

    .hero-image-status.active {
        background: #10b981;
    }

    .hero-image-status.inactive {
        background: #f59e0b;
    }

    .hero-table-content {
        min-width: 210px;
    }

    /* =========================================================
       BADGE
    ========================================================= */

    .hero-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        max-width: 190px;
        padding: 6px 10px;
        overflow: hidden;
        border: 1px solid #bfdbfe;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.2;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .hero-badge-pill i {
        color: #f59e0b;
        font-size: 10px;
    }

    /* =========================================================
       BUTTON DETAILS
    ========================================================= */

    .hero-button-list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        max-width: 230px;
    }

    .hero-button-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        max-width: 160px;
        padding: 5px 8px;
        overflow: hidden;
        border-radius: 999px;
        font-size: 10.5px;
        font-weight: 700;
        line-height: 1.2;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .hero-button-pill.primary {
        background: #ecfdf5;
        color: #047857;
    }

    .hero-button-pill.secondary {
        background: #f3e8ff;
        color: #7e22ce;
    }

    /* =========================================================
       SORT ORDER
    ========================================================= */

    .hero-sort-order {
        min-width: 36px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 9px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #475569;
        font-size: 12px;
        font-weight: 800;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .hero-status-text {
        font-size: 12.5px;
        font-weight: 600;
    }

    .hero-status-text.active {
        color: #166534;
    }

    .hero-status-text.inactive {
        color: #92400e;
    }

    .hero-empty-text {
        color: #94a3b8;
        font-size: 12px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {
        .hero-table-media,
        .hero-table-image,
        .hero-table-placeholder {
            width: 68px;
            height: 44px;
        }

        .hero-table-media {
            flex-basis: 68px;
        }

        .hero-table-content {
            min-width: 170px;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-HeroSlide', {
        canDelete:
            @can('hero_slide_delete')
                true
            @else
                false
            @endcan,

        massDeleteUrl:
            "{{ route('admin.hero-slides.massDestroy') }}",

        deleteText:
            "{{ trans('global.datatables.delete') }}",

        zeroSelectedText:
            "{{ trans('global.datatables.zero_selected') }}",

        confirmText:
            "{{ trans('global.areYouSure') }}",

        searchPlaceholder:
            'Search hero slides...',

        infoText:
            'Showing _START_–_END_ of _TOTAL_ hero slides'
    });
});
</script>

@endsection