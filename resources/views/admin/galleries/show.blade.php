@extends('layouts.admin')

@section('page-title', 'Gallery Details')

@section('content')

@php
    $typeColors = [
        'image' => '#4F46E5',
        'video' => '#EF4444',
        'album' => '#8B5CF6',
    ];

    $typeColor = $typeColors[$gallery->type] ?? '#0EA5E9';

    $typeIcons = [
        'image' => 'fas fa-image',
        'video' => 'fas fa-video',
        'album' => 'fas fa-images',
    ];

    $typeIcon = $typeIcons[$gallery->type] ?? 'fas fa-photo-video';
@endphp

<div class="admin-page-head">

    <div>
        <a href="{{ route('admin.galleries.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Gallery Details
        </h2>

        <p class="admin-page-subtitle">
            Complete gallery media, category and visibility information
        </p>
    </div>

    <div class="show-actions">

        @can('gallery_edit')
            <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
               class="btn-primary">

                <i class="fas fa-pencil-alt"></i>
                Edit Gallery
            </a>
        @endcan

        @can('gallery_delete')
            <form action="{{ route('admin.galleries.destroy', $gallery->id) }}"
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

    {{-- LEFT SIDEBAR --}}
    <div>

        {{-- PROFILE CARD --}}
        <div class="detail-card mb-3">

            <div class="profile-hero gallery-profile-hero">

                @if($gallery->type === 'video' && $gallery->video_embed_url)

                    <div class="gallery-profile-video">
                        <iframe
                            src="{{ $gallery->video_embed_url }}"
                            title="{{ $gallery->title }}"
                            loading="lazy"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>

                @elseif($gallery->image)

                    <img src="{{ $gallery->image }}"
                         alt="{{ $gallery->title }}"
                         class="gallery-profile-image">

                @else

                    <div class="gallery-profile-placeholder"
                         style="background: linear-gradient(
                            135deg,
                            {{ $typeColor }},
                            #0f172a
                         );">

                        <i class="{{ $typeIcon }}"></i>
                    </div>

                @endif

                <p class="profile-title">
                    {{ $gallery->title }}
                </p>

                <p class="profile-subtitle">
                    {{ $gallery->category ?: 'Uncategorized Gallery' }}
                </p>

                <span class="gallery-type-pill"
                      style="
                          color: {{ $typeColor }};
                          border-color: {{ $typeColor }}33;
                          background: {{ $typeColor }}12;
                      ">

                    <i class="{{ $typeIcon }}"></i>
                    {{ ucfirst($gallery->type ?: 'media') }}
                </span>

                <div class="gallery-profile-statuses">

                    @if($gallery->status)

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

                    @if($gallery->is_featured)

                        <span class="status-pill gallery-featured-pill">
                            <i class="fas fa-star"></i>
                            Featured
                        </span>

                    @endif

                </div>

            </div>

            <div class="detail-section-pad-sm">

                <div class="gallery-mini-stats">

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Gallery ID
                        </p>

                        <p class="stat-mini-value">
                            #{{ $gallery->id }}
                        </p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Sort Order
                        </p>

                        <p class="stat-mini-value">
                            {{ $gallery->sort_order ?? 0 }}
                        </p>
                    </div>

                    <div class="stat-mini gallery-stat-full">
                        <p class="stat-mini-label">
                            Added On
                        </p>

                        <p class="stat-mini-value-sm">
                            {{ optional($gallery->created_at)->format('d M Y') ?? '—' }}
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

                @can('gallery_edit')
                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                       class="quick-link primary">

                        <i class="fas fa-edit"></i>
                        Edit Gallery
                    </a>
                @endcan

                <a href="{{ route('admin.galleries.index') }}"
                   class="quick-link">

                    <i class="fas fa-list"></i>
                    All Gallery Items
                </a>

                @can('gallery_create')
                    <a href="{{ route('admin.galleries.create') }}"
                       class="quick-link">

                        <i class="fas fa-plus-circle"></i>
                        Add New Gallery
                    </a>
                @endcan

                @if($gallery->image)
                    <a href="{{ $gallery->image }}"
                       target="_blank"
                       rel="noopener"
                       class="quick-link">

                        <i class="fas fa-external-link-alt"></i>
                        Open Full Image
                    </a>
                @endif

                @if($gallery->video_url)
                    <a href="{{ $gallery->video_url }}"
                       target="_blank"
                       rel="noopener"
                       class="quick-link">

                        <i class="fab fa-youtube"></i>
                        Open Video
                    </a>
                @endif

            </div>

        </div>

    </div>

    {{-- RIGHT CONTENT --}}
    <div>

        {{-- GALLERY INFORMATION --}}
        <div class="detail-card mb-3">

            <div class="detail-section-head">

                <div class="detail-section-icon">
                    <i class="fas fa-id-card"></i>
                </div>

                <p class="detail-section-title">
                    Gallery Information
                </p>

            </div>

            <div class="detail-section-body">

                <div class="detail-row">
                    <span class="detail-label">
                        Gallery ID
                    </span>

                    <span class="detail-value code-pill">
                        #{{ $gallery->id }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Title
                    </span>

                    <span class="detail-value">
                        {{ $gallery->title }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Category
                    </span>

                    @if($gallery->category)

                        <span class="gallery-category-pill">
                            <i class="fas fa-tag"></i>
                            {{ $gallery->category }}
                        </span>

                    @else

                        <span class="detail-value">
                            Uncategorized
                        </span>

                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Media Type
                    </span>

                    <span class="gallery-type-value"
                          style="
                              color: {{ $typeColor }};
                              border-color: {{ $typeColor }}33;
                              background: {{ $typeColor }}12;
                          ">

                        <i class="{{ $typeIcon }}"></i>
                        {{ ucfirst($gallery->type ?: 'media') }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Sort Order
                    </span>

                    <span class="detail-value">
                        {{ $gallery->sort_order ?? 0 }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Featured Status
                    </span>

                    @if($gallery->is_featured)

                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-star gallery-star-icon"></i>

                            <span class="detail-value">
                                Featured Gallery Item
                            </span>
                        </div>

                    @else

                        <div class="d-flex align-items-center gap-2">
                            <i class="far fa-star"
                               style="color:#94a3b8;"></i>

                            <span class="detail-value">
                                Normal Gallery Item
                            </span>
                        </div>

                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Visibility
                    </span>

                    @if($gallery->status)

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
                        {{ optional($gallery->created_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Updated At
                    </span>

                    <span class="detail-value">
                        {{ optional($gallery->updated_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

        {{-- DESCRIPTION --}}
        @if($gallery->description)

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-align-left"></i>
                    </div>

                    <p class="detail-section-title">
                        Gallery Description
                    </p>

                </div>

                <div class="gallery-description-box">
                    <p>
                        {{ $gallery->description }}
                    </p>
                </div>

            </div>

        @endif

        {{-- IMAGE PREVIEW --}}
        @if($gallery->type !== 'video' && $gallery->image)

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-image"></i>
                        </div>

                        <p class="detail-section-title">
                            Gallery Image
                        </p>

                    </div>

                    <a href="{{ $gallery->image }}"
                       target="_blank"
                       rel="noopener"
                       class="gallery-open-media">

                        <i class="fas fa-external-link-alt"></i>
                        Open Full Image
                    </a>

                </div>

                <div class="gallery-main-media-box">

                    <a href="{{ $gallery->image }}"
                       target="_blank"
                       rel="noopener">

                        <img src="{{ $gallery->image }}"
                             alt="{{ $gallery->title }}">
                    </a>

                </div>

            </div>

        @endif

        {{-- VIDEO PREVIEW --}}
        @if($gallery->type === 'video')

            <div class="detail-card mb-3">

                <div class="detail-section-head between">

                    <div class="d-flex align-items-center gap-2">

                        <div class="detail-section-icon">
                            <i class="fas fa-video"></i>
                        </div>

                        <p class="detail-section-title">
                            Video Preview
                        </p>

                    </div>

                    @if($gallery->video_url)
                        <a href="{{ $gallery->video_url }}"
                           target="_blank"
                           rel="noopener"
                           class="gallery-open-media">

                            <i class="fab fa-youtube"></i>
                            Open Original Video
                        </a>
                    @endif

                </div>

                <div class="gallery-main-media-box">

                    @if($gallery->video_embed_url)

                        <div class="gallery-main-video-frame">

                            <iframe
                                src="{{ $gallery->video_embed_url }}"
                                title="{{ $gallery->title }}"
                                loading="lazy"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>

                        </div>

                    @else

                        <div class="gallery-no-media">

                            <i class="fas fa-video-slash"></i>

                            <h3>Video Not Available</h3>

                            <p>
                                A valid video URL has not been provided.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        @endif

        {{-- VIDEO URL DETAILS --}}
        @if($gallery->video_url)

            <div class="detail-card">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-link"></i>
                    </div>

                    <p class="detail-section-title">
                        Video URL Information
                    </p>

                </div>

                <div class="detail-section-pad-sm">

                    <div class="gallery-url-box">

                        <div class="gallery-url-icon">
                            <i class="fab fa-youtube"></i>
                        </div>

                        <div class="gallery-url-info">

                            <strong>
                                Original Video URL
                            </strong>

                            <a href="{{ $gallery->video_url }}"
                               target="_blank"
                               rel="noopener">

                                {{ $gallery->video_url }}
                            </a>

                        </div>

                        <a href="{{ $gallery->video_url }}"
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

        {{-- EMPTY MEDIA STATE --}}
        @if(!$gallery->image && !$gallery->video_url)

            <div class="detail-card">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-photo-video"></i>
                    </div>

                    <p class="detail-section-title">
                        Gallery Media
                    </p>

                </div>

                <div class="gallery-no-media">

                    <i class="fas fa-image"></i>

                    <h3>No Media Uploaded</h3>

                    <p>
                        Upload an image or add a valid video URL to display media.
                    </p>

                    @can('gallery_edit')
                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                           class="btn-primary">

                            <i class="fas fa-upload"></i>
                            Add Media
                        </a>
                    @endcan

                </div>

            </div>

        @endif

    </div>

</div>

<style>
    .gallery-profile-hero {
        padding-bottom: 24px;
    }

    .gallery-profile-image {
        width: 100%;
        max-width: 260px;
        height: 175px;
        display: block;
        margin: 0 auto 18px;
        object-fit: cover;
        object-position: center;
        border: 5px solid #ffffff;
        border-radius: 22px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .14);
    }

    .gallery-profile-video {
        width: 100%;
        max-width: 280px;
        aspect-ratio: 16 / 9;
        margin: 0 auto 18px;
        overflow: hidden;
        border: 5px solid #ffffff;
        border-radius: 22px;
        background: #0f172a;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .14);
    }

    .gallery-profile-video iframe {
        width: 100%;
        height: 100%;
        display: block;
        border: 0;
    }

    .gallery-profile-placeholder {
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        border: 5px solid #ffffff;
        border-radius: 28px;
        color: #ffffff;
        font-size: 36px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .14);
    }

    .gallery-type-pill,
    .gallery-type-value,
    .gallery-category-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border: 1px solid;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.2;
    }

    .gallery-type-pill {
        margin: 8px auto 12px;
    }

    .gallery-category-pill {
        color: #1d4ed8;
        border-color: #bfdbfe;
        background: #eff6ff;
    }

    .gallery-profile-statuses {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }

    .gallery-featured-pill {
        color: #b45309;
        background: #fef3c7;
    }

    .gallery-star-icon {
        color: #f59e0b;
    }

    .gallery-mini-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .gallery-stat-full {
        grid-column: 1 / -1;
    }

    .gallery-description-box {
        padding: 20px;
        color: #475569;
        font-size: 14px;
        line-height: 1.8;
    }

    .gallery-description-box p {
        margin: 0;
    }

    .gallery-open-media {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .gallery-open-media:hover {
        color: #3730a3;
    }

    .gallery-main-media-box {
        padding: 18px;
    }

    .gallery-main-media-box img {
        width: 100%;
        max-height: 520px;
        display: block;
        object-fit: cover;
        object-position: center;
        border-radius: 16px;
    }

    .gallery-main-video-frame {
        width: 100%;
        overflow: hidden;
        aspect-ratio: 16 / 9;
        border-radius: 16px;
        background: #0f172a;
    }

    .gallery-main-video-frame iframe {
        width: 100%;
        height: 100%;
        display: block;
        border: 0;
    }

    .gallery-url-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border: 1px solid #fecaca;
        border-radius: 14px;
        background: #fff7f7;
    }

    .gallery-url-icon {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #fee2e2;
        color: #dc2626;
        font-size: 21px;
    }

    .gallery-url-info {
        min-width: 0;
        flex: 1;
    }

    .gallery-url-info strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 13px;
    }

    .gallery-url-info a {
        display: block;
        overflow: hidden;
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .gallery-no-media {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        min-height: 270px;
        padding: 35px 20px;
        text-align: center;
        color: #64748b;
    }

    .gallery-no-media > i {
        margin-bottom: 14px;
        color: #94a3b8;
        font-size: 46px;
    }

    .gallery-no-media h3 {
        margin: 0 0 7px;
        color: #334155;
        font-size: 17px;
    }

    .gallery-no-media p {
        max-width: 420px;
        margin: 0 0 16px;
        font-size: 13px;
        line-height: 1.6;
    }

    @media (max-width: 575px) {
        .gallery-mini-stats {
            grid-template-columns: 1fr;
        }

        .gallery-stat-full {
            grid-column: auto;
        }

        .gallery-profile-image {
            height: 160px;
        }

        .gallery-url-box {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .gallery-url-box .btn-primary {
            width: 100%;
            justify-content: center;
        }

        .detail-section-head.between {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

@endsection