@extends('layouts.admin')

@section('page-title', 'Hero Slide Details')

@section('content')

@php
    $slideTitle = $heroSlide->title ?: 'Untitled Hero Slide';

    $hasPrimaryButton = !empty($heroSlide->primary_button_text)
        || !empty($heroSlide->primary_button_url);

    $hasSecondaryButton = !empty($heroSlide->secondary_button_text)
        || !empty($heroSlide->secondary_button_url);
@endphp

<div class="admin-page-head">

    <div>
        <a href="{{ route('admin.hero-slides.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Hero Slide Details
        </h2>

        <p class="admin-page-subtitle">
            Full preview, content, buttons, ordering and visibility information
        </p>
    </div>

    <div class="show-actions">

        @can('hero_slide_edit')
            <a href="{{ route('admin.hero-slides.edit', $heroSlide->id) }}"
               class="btn-primary">

                <i class="fas fa-pencil-alt"></i>
                Edit Slide
            </a>
        @endcan

        @can('hero_slide_delete')
            <form action="{{ route('admin.hero-slides.destroy', $heroSlide->id) }}"
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

    {{-- LEFT COLUMN --}}
    <div>

        {{-- HERO PROFILE CARD --}}
        <div class="detail-card mb-3">

            <div class="profile-hero hero-profile-card">

                @if($heroSlide->image)

                    <img src="{{ $heroSlide->image }}"
                         alt="{{ $slideTitle }}"
                         class="hero-profile-image">

                @else

                    <div class="hero-profile-placeholder">
                        <i class="fas fa-image"></i>
                    </div>

                @endif

                <p class="profile-title">
                    {{ $slideTitle }}
                </p>

                <p class="profile-subtitle">
                    {{ $heroSlide->badge_text ?: 'Homepage Hero Slide' }}
                </p>

                <div class="hero-profile-pills">

                    @if($heroSlide->status)

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

                    <span class="hero-order-pill">
                        <i class="fas fa-sort-numeric-down"></i>
                        Order {{ $heroSlide->sort_order ?? 0 }}
                    </span>

                </div>

            </div>

            <div class="detail-section-pad-sm">

                <div class="hero-mini-stats">

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Slide ID
                        </p>

                        <p class="stat-mini-value">
                            #{{ $heroSlide->id }}
                        </p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">
                            Buttons
                        </p>

                        <p class="stat-mini-value">
                            {{ collect([
                                $hasPrimaryButton,
                                $hasSecondaryButton
                            ])->filter()->count() }}
                        </p>
                    </div>

                    <div class="stat-mini hero-stat-full">
                        <p class="stat-mini-label">
                            Created On
                        </p>

                        <p class="stat-mini-value-sm">
                            {{ optional($heroSlide->created_at)->format('d M Y') ?? '—' }}
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

                @can('hero_slide_edit')
                    <a href="{{ route('admin.hero-slides.edit', $heroSlide->id) }}"
                       class="quick-link primary">

                        <i class="fas fa-edit"></i>
                        Edit Slide
                    </a>
                @endcan

                <a href="{{ route('admin.hero-slides.index') }}"
                   class="quick-link">

                    <i class="fas fa-list"></i>
                    All Hero Slides
                </a>

                @can('hero_slide_create')
                    <a href="{{ route('admin.hero-slides.create') }}"
                       class="quick-link">

                        <i class="fas fa-plus-circle"></i>
                        Add New Slide
                    </a>
                @endcan

                @if($heroSlide->image)
                    <a href="{{ $heroSlide->image }}"
                       target="_blank"
                       rel="noopener"
                       class="quick-link">

                        <i class="fas fa-external-link-alt"></i>
                        Open Full Image
                    </a>
                @endif

                @if($heroSlide->primary_button_url)
                    <a href="{{ $heroSlide->primary_button_url }}"
                       target="_blank"
                       rel="noopener"
                       class="quick-link">

                        <i class="fas fa-link"></i>
                        Open Primary Link
                    </a>
                @endif

            </div>

        </div>

    </div>

    {{-- RIGHT COLUMN --}}
    <div>

        {{-- LIVE HERO PREVIEW --}}
        <div class="detail-card mb-3">

            <div class="detail-section-head between">

                <div class="d-flex align-items-center gap-2">

                    <div class="detail-section-icon">
                        <i class="fas fa-desktop"></i>
                    </div>

                    <p class="detail-section-title">
                        Hero Slide Preview
                    </p>

                </div>

                @if($heroSlide->image)
                    <a href="{{ $heroSlide->image }}"
                       target="_blank"
                       rel="noopener"
                       class="hero-open-media">

                        <i class="fas fa-external-link-alt"></i>
                        Open Image
                    </a>
                @endif

            </div>

            <div class="hero-preview-wrapper">

                <div class="hero-show-preview">

                    @if($heroSlide->image)

                        <img src="{{ $heroSlide->image }}"
                             alt="{{ $slideTitle }}">

                    @else

                        <div class="hero-show-placeholder">
                            <i class="fas fa-image"></i>
                        </div>

                    @endif

                    <div class="hero-show-overlay"></div>

                    <div class="hero-show-content">

                        @if($heroSlide->badge_text)

                            <span class="hero-show-badge">

                                @if($heroSlide->badge_icon)
                                    <i class="bi {{ $heroSlide->badge_icon }}"></i>
                                @else
                                    <i class="bi bi-stars"></i>
                                @endif

                                {{ $heroSlide->badge_text }}
                            </span>

                        @endif

                        <h2>
                            {{ $slideTitle }}
                        </h2>

                        @if($heroSlide->description)

                            <p>
                                {{ $heroSlide->description }}
                            </p>

                        @endif

                        @if($hasPrimaryButton || $hasSecondaryButton)

                            <div class="hero-preview-actions">

                                @if($hasPrimaryButton)

                                    @if($heroSlide->primary_button_url)
                                        <a href="{{ $heroSlide->primary_button_url }}"
                                           target="_blank"
                                           rel="noopener"
                                           class="hero-preview-btn primary">

                                            {{ $heroSlide->primary_button_text ?: 'Primary Button' }}
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @else
                                        <span class="hero-preview-btn primary">
                                            {{ $heroSlide->primary_button_text ?: 'Primary Button' }}
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                    @endif

                                @endif

                                @if($hasSecondaryButton)

                                    @if($heroSlide->secondary_button_url)
                                        <a href="{{ $heroSlide->secondary_button_url }}"
                                           target="_blank"
                                           rel="noopener"
                                           class="hero-preview-btn secondary">

                                            {{ $heroSlide->secondary_button_text ?: 'Secondary Button' }}
                                        </a>
                                    @else
                                        <span class="hero-preview-btn secondary">
                                            {{ $heroSlide->secondary_button_text ?: 'Secondary Button' }}
                                        </span>
                                    @endif

                                @endif

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        {{-- SLIDE INFORMATION --}}
        <div class="detail-card mb-3">

            <div class="detail-section-head">

                <div class="detail-section-icon">
                    <i class="fas fa-id-card"></i>
                </div>

                <p class="detail-section-title">
                    Slide Information
                </p>

            </div>

            <div class="detail-section-body">

                <div class="detail-row">
                    <span class="detail-label">
                        Slide ID
                    </span>

                    <span class="detail-value code-pill">
                        #{{ $heroSlide->id }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Title
                    </span>

                    <span class="detail-value">
                        {{ $slideTitle }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Badge Text
                    </span>

                    @if($heroSlide->badge_text)

                        <span class="hero-badge-value">
                            <i class="fas fa-star"></i>
                            {{ $heroSlide->badge_text }}
                        </span>

                    @else

                        <span class="hero-empty-value">
                            Not set
                        </span>

                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Badge Icon
                    </span>

                    @if($heroSlide->badge_icon)

                        <div class="d-flex align-items-center gap-2">
                            <i class="bi {{ $heroSlide->badge_icon }}"></i>

                            <span class="detail-value code-pill">
                                {{ $heroSlide->badge_icon }}
                            </span>
                        </div>

                    @else

                        <span class="hero-empty-value">
                            Default: bi-stars
                        </span>

                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Sort Order
                    </span>

                    <span class="hero-order-value">
                        {{ $heroSlide->sort_order ?? 0 }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Visibility
                    </span>

                    @if($heroSlide->status)

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
                        {{ optional($heroSlide->created_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Updated At
                    </span>

                    <span class="detail-value">
                        {{ optional($heroSlide->updated_at)->format('d M Y, H:i') ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

        {{-- DESCRIPTION --}}
        @if($heroSlide->description)

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-align-left"></i>
                    </div>

                    <p class="detail-section-title">
                        Slide Description
                    </p>

                </div>

                <div class="hero-description-box">
                    <p>
                        {{ $heroSlide->description }}
                    </p>
                </div>

            </div>

        @endif

        {{-- BUTTON INFORMATION --}}
        <div class="detail-card">

            <div class="detail-section-head between">

                <div class="d-flex align-items-center gap-2">

                    <div class="detail-section-icon">
                        <i class="fas fa-mouse-pointer"></i>
                    </div>

                    <p class="detail-section-title">
                        Button Information
                    </p>

                </div>

                <span class="status-pill success">
                    {{ collect([
                        $hasPrimaryButton,
                        $hasSecondaryButton
                    ])->filter()->count() }}
                    configured
                </span>

            </div>

            <div class="detail-section-pad-sm">

                @if($hasPrimaryButton)

                    <div class="hero-button-detail-card primary">

                        <div class="hero-button-detail-icon">
                            <i class="fas fa-arrow-right"></i>
                        </div>

                        <div class="hero-button-detail-content">

                            <span>
                                Primary Button
                            </span>

                            <strong>
                                {{ $heroSlide->primary_button_text ?: 'Button text not set' }}
                            </strong>

                            @if($heroSlide->primary_button_url)

                                <a href="{{ $heroSlide->primary_button_url }}"
                                   target="_blank"
                                   rel="noopener">

                                    {{ $heroSlide->primary_button_url }}
                                </a>

                            @else

                                <small>
                                    URL not configured
                                </small>

                            @endif

                        </div>

                        @if($heroSlide->primary_button_url)

                            <a href="{{ $heroSlide->primary_button_url }}"
                               target="_blank"
                               rel="noopener"
                               class="hero-button-open">

                                <i class="fas fa-external-link-alt"></i>
                            </a>

                        @endif

                    </div>

                @endif

                @if($hasSecondaryButton)

                    <div class="hero-button-detail-card secondary">

                        <div class="hero-button-detail-icon">
                            <i class="fas fa-link"></i>
                        </div>

                        <div class="hero-button-detail-content">

                            <span>
                                Secondary Button
                            </span>

                            <strong>
                                {{ $heroSlide->secondary_button_text ?: 'Button text not set' }}
                            </strong>

                            @if($heroSlide->secondary_button_url)

                                <a href="{{ $heroSlide->secondary_button_url }}"
                                   target="_blank"
                                   rel="noopener">

                                    {{ $heroSlide->secondary_button_url }}
                                </a>

                            @else

                                <small>
                                    URL not configured
                                </small>

                            @endif

                        </div>

                        @if($heroSlide->secondary_button_url)

                            <a href="{{ $heroSlide->secondary_button_url }}"
                               target="_blank"
                               rel="noopener"
                               class="hero-button-open">

                                <i class="fas fa-external-link-alt"></i>
                            </a>

                        @endif

                    </div>

                @endif

                @if(!$hasPrimaryButton && !$hasSecondaryButton)

                    <div class="assign-empty">

                        <div class="assign-empty-icon">
                            <i class="fas fa-mouse-pointer"></i>
                        </div>

                        <p class="assign-empty-title">
                            No buttons configured
                        </p>

                        <p class="assign-empty-text">
                            This hero slide does not currently have any call-to-action buttons.
                        </p>

                        @can('hero_slide_edit')
                            <a href="{{ route('admin.hero-slides.edit', $heroSlide->id) }}"
                               class="btn-primary mt-3">

                                <i class="fas fa-plus"></i>
                                Configure Buttons
                            </a>
                        @endcan

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

<style>
    .hero-profile-card {
        padding-bottom: 24px;
    }

    .hero-profile-image {
        width: 100%;
        max-width: 280px;
        height: 175px;
        display: block;
        margin: 0 auto 18px;
        object-fit: cover;
        object-position: center;
        border: 5px solid #ffffff;
        border-radius: 22px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .15);
    }

    .hero-profile-placeholder {
        width: 130px;
        height: 130px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        border: 5px solid #ffffff;
        border-radius: 30px;
        background: linear-gradient(135deg, #4f46e5, #0f172a);
        color: #ffffff;
        font-size: 38px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .15);
    }

    .hero-profile-pills {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 7px;
        margin-top: 10px;
    }

    .hero-order-pill,
    .hero-order-value,
    .hero-badge-value {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
    }

    .hero-order-pill,
    .hero-order-value {
        border: 1px solid #ddd6fe;
        background: #f5f3ff;
        color: #6d28d9;
    }

    .hero-badge-value {
        border: 1px solid #fde68a;
        background: #fffbeb;
        color: #b45309;
    }

    .hero-mini-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .hero-stat-full {
        grid-column: 1 / -1;
    }

    .hero-preview-wrapper {
        padding: 18px;
    }

    .hero-show-preview {
        position: relative;
        min-height: 390px;
        overflow: hidden;
        border-radius: 18px;
        background: #0f172a;
    }

    .hero-show-preview > img,
    .hero-show-placeholder {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }

    .hero-show-preview > img {
        object-fit: cover;
        object-position: center;
    }

    .hero-show-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #334155, #0f172a);
        color: rgba(255, 255, 255, .28);
        font-size: 64px;
    }

    .hero-show-overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                90deg,
                rgba(2, 6, 23, .88) 0%,
                rgba(2, 6, 23, .63) 50%,
                rgba(2, 6, 23, .18) 100%
            );
    }

    .hero-show-content {
        position: absolute;
        z-index: 2;
        left: 34px;
        bottom: 34px;
        max-width: 720px;
        padding-right: 34px;
        color: #ffffff;
    }

    .hero-show-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        margin-bottom: 14px;
        border: 1px solid rgba(255, 255, 255, .22);
        border-radius: 999px;
        background: rgba(255, 255, 255, .12);
        font-size: 12px;
        font-weight: 800;
        backdrop-filter: blur(8px);
    }

    .hero-show-content h2 {
        max-width: 650px;
        margin: 0 0 12px;
        color: #ffffff;
        font-size: clamp(28px, 4vw, 44px);
        font-weight: 900;
        line-height: 1.12;
    }

    .hero-show-content p {
        max-width: 620px;
        margin: 0;
        color: rgba(255, 255, 255, .86);
        font-size: 14px;
        line-height: 1.75;
    }

    .hero-preview-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    .hero-preview-btn {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 16px;
        border: 1px solid transparent;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 800;
        text-decoration: none;
    }

    .hero-preview-btn.primary {
        background: #ffffff;
        color: #173f73;
    }

    .hero-preview-btn.secondary {
        border-color: rgba(255, 255, 255, .45);
        background: rgba(255, 255, 255, .08);
        color: #ffffff;
    }

    .hero-open-media {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .hero-description-box {
        padding: 20px;
        color: #475569;
        font-size: 14px;
        line-height: 1.8;
    }

    .hero-description-box p {
        margin: 0;
    }

    .hero-button-detail-card {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 15px;
        margin-bottom: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
    }

    .hero-button-detail-card:last-child {
        margin-bottom: 0;
    }

    .hero-button-detail-card.primary {
        border-color: #bbf7d0;
        background: #f0fdf4;
    }

    .hero-button-detail-card.secondary {
        border-color: #ddd6fe;
        background: #f5f3ff;
    }

    .hero-button-detail-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 16px;
    }

    .hero-button-detail-card.primary .hero-button-detail-icon {
        background: #dcfce7;
        color: #15803d;
    }

    .hero-button-detail-card.secondary .hero-button-detail-icon {
        background: #ede9fe;
        color: #7c3aed;
    }

    .hero-button-detail-content {
        min-width: 0;
        flex: 1;
    }

    .hero-button-detail-content span,
    .hero-button-detail-content strong,
    .hero-button-detail-content a,
    .hero-button-detail-content small {
        display: block;
    }

    .hero-button-detail-content span {
        margin-bottom: 3px;
        color: #64748b;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .hero-button-detail-content strong {
        color: #1f2937;
        font-size: 13px;
    }

    .hero-button-detail-content a,
    .hero-button-detail-content small {
        margin-top: 4px;
        overflow: hidden;
        color: #4f46e5;
        font-size: 11.5px;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .hero-button-open {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #ffffff;
        color: #4f46e5;
        text-decoration: none;
    }

    .hero-empty-value {
        color: #94a3b8;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .hero-show-preview {
            min-height: 420px;
        }

        .hero-show-content {
            right: 22px;
            left: 22px;
            bottom: 24px;
            padding-right: 0;
        }

        .hero-show-overlay {
            background:
                linear-gradient(
                    0deg,
                    rgba(2, 6, 23, .94) 0%,
                    rgba(2, 6, 23, .52) 72%,
                    rgba(2, 6, 23, .18) 100%
                );
        }
    }

    @media (max-width: 575px) {
        .hero-mini-stats {
            grid-template-columns: 1fr;
        }

        .hero-stat-full {
            grid-column: auto;
        }

        .hero-profile-image {
            height: 160px;
        }

        .hero-show-preview {
            min-height: 450px;
        }

        .hero-show-content h2 {
            font-size: 27px;
        }

        .hero-preview-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .hero-preview-btn {
            width: 100%;
        }

        .hero-button-detail-card {
            align-items: flex-start;
        }

        .detail-section-head.between {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

@endsection