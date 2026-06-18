@extends('layouts.admin')

@section('styles')
<style>
    .dashboard-wrap {
        display: grid;
        gap: 22px;
    }

    .dashboard-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
    }

    .dashboard-head h2 {
        margin: 0;
        color: #0f172a;
        font-size: 26px;
        line-height: 1.15;
        font-weight: 800;
    }

    .dashboard-head p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .dashboard-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 10px 26px rgba(15, 23, 42, 0.05);
        white-space: nowrap;
    }

    .dashboard-hero {
        position: relative;
        overflow: hidden;
        padding: 26px;
        border-radius: 22px;
        color: #ffffff;
        background:
            radial-gradient(circle at 90% 20%, rgba(244, 180, 0, 0.28), transparent 30%),
            linear-gradient(135deg, #0d2d55, #173f73 62%, #24598f);
        box-shadow: 0 24px 55px rgba(13, 45, 85, 0.16);
    }

    .dashboard-hero::after {
        content: "";
        position: absolute;
        right: -80px;
        bottom: -100px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .dashboard-hero-content {
        position: relative;
        z-index: 1;
        max-width: 780px;
    }

    .dashboard-hero h3 {
        margin: 0 0 9px;
        font-size: 24px;
        font-weight: 850;
    }

    .dashboard-hero p {
        margin: 0;
        color: rgba(255, 255, 255, 0.82);
        font-size: 14px;
        line-height: 1.7;
    }

    .dashboard-module-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 14px;
    }

    .dashboard-module-card {
        display: grid;
        gap: 16px;
        min-height: 152px;
        padding: 18px;
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.06);
        transition: all 0.22s ease;
    }

    .dashboard-module-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 44px rgba(15, 23, 42, 0.1);
    }

    .dashboard-module-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .dashboard-module-icon {
        width: 46px;
        height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 18px;
    }

    .dashboard-module-card h4 {
        margin: 0;
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .dashboard-module-card strong {
        display: block;
        margin-top: 7px;
        color: #0f172a;
        font-size: 30px;
        line-height: 1;
        font-weight: 900;
    }

    .dashboard-module-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #173f73;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }

    .dashboard-section-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 16px;
    }

    .dashboard-panel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .dashboard-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 18px 20px;
        border-bottom: 1px solid #eef2f7;
        background: #f8fafc;
    }

    .dashboard-panel-head h3 {
        margin: 0;
        color: #0f172a;
        font-size: 16px;
        font-weight: 850;
    }

    .dashboard-panel-head a {
        color: #173f73;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
    }

    .dashboard-list {
        display: grid;
    }

    .dashboard-list-item {
        display: grid;
        grid-template-columns: 42px 1fr auto;
        align-items: center;
        gap: 12px;
        padding: 15px 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .dashboard-list-item:last-child {
        border-bottom: 0;
    }

    .dashboard-list-icon {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        color: #173f73;
    }

    .dashboard-list-item h4 {
        margin: 0;
        color: #0f172a;
        font-size: 13.5px;
        font-weight: 800;
    }

    .dashboard-list-item p {
        margin: 4px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    .dashboard-pill {
        display: inline-flex;
        padding: 6px 9px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #15803d;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .dashboard-empty {
        padding: 28px 20px;
        text-align: center;
        color: #64748b;
        font-size: 14px;
    }

    .dashboard-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 12px;
    }

    .dashboard-action {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 15px 16px;
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #0f172a;
        text-decoration: none;
        font-size: 13px;
        font-weight: 850;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
    }

    .dashboard-action i {
        color: #173f73;
    }

    @media (max-width: 1280px) {
        .dashboard-module-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 860px) {
        .dashboard-head,
        .dashboard-section-grid {
            grid-template-columns: 1fr;
            display: grid;
        }

        .dashboard-module-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .dashboard-module-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-list-item {
            grid-template-columns: 38px 1fr;
        }

        .dashboard-pill {
            grid-column: 2;
            width: fit-content;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrap">
    <div class="dashboard-head">
        <div>
            <h2>Dashboard</h2>
            <p>Welcome back, <strong>{{ auth()->user()->name }}</strong>. Manage website modules from here.</p>
        </div>
        <span class="dashboard-date">
            <i class="fas fa-calendar-day"></i>
            {{ now()->format('D, d M Y') }}
        </span>
    </div>

    <section class="dashboard-hero">
        <div class="dashboard-hero-content">
            <h3>College Website Overview</h3>
            <p>
                Live summary of public website content modules, notices, academics,
                gallery, disclosures and homepage sections.
            </p>
        </div>
    </section>

    <section class="dashboard-module-grid">
        @foreach($moduleCards as $card)
            @can($card['permission'])
                <a href="{{ route($card['route']) }}" class="dashboard-module-card">
                    <div class="dashboard-module-top">
                        <div>
                            <h4>{{ $card['label'] }}</h4>
                            <strong>{{ $card['count'] }}</strong>
                        </div>
                        <span class="dashboard-module-icon" style="background:{{ $card['bg'] }}; color:{{ $card['color'] }};">
                            <i class="fas {{ $card['icon'] }}"></i>
                        </span>
                    </div>
                    <span class="dashboard-module-link">
                        Manage {{ $card['label'] }} <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
            @endcan
        @endforeach
    </section>

    <section class="dashboard-section-grid">
        <div class="dashboard-panel">
            <div class="dashboard-panel-head">
                <h3>Recent Notices</h3>
                @can('notice_access')
                    <a href="{{ route('admin.notices.index') }}">View all</a>
                @endcan
            </div>
            <div class="dashboard-list">
                @forelse($recentNotices as $notice)
                    <div class="dashboard-list-item">
                        <span class="dashboard-list-icon"><i class="fas fa-bullhorn"></i></span>
                        <div>
                            <h4>{{ $notice->title }}</h4>
                            <p>{{ $notice->category ?: 'Notice' }} | {{ optional($notice->notice_date)->format('d M Y') ?: 'No date' }}</p>
                        </div>
                        <span class="dashboard-pill">{{ $notice->status ? 'Active' : 'Inactive' }}</span>
                    </div>
                @empty
                    <div class="dashboard-empty">No notices added yet.</div>
                @endforelse
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-panel-head">
                <h3>Recent Activities</h3>
                @can('student_activity_access')
                    <a href="{{ route('admin.student-activities.index') }}">View all</a>
                @endcan
            </div>
            <div class="dashboard-list">
                @forelse($recentActivities as $activity)
                    <div class="dashboard-list-item">
                        <span class="dashboard-list-icon"><i class="fas fa-people-group"></i></span>
                        <div>
                            <h4>{{ $activity->title }}</h4>
                            <p>{{ $activity->category ?: 'Activity' }} | {{ optional($activity->activity_date)->format('d M Y') ?: 'No date' }}</p>
                        </div>
                        <span class="dashboard-pill">{{ $activity->status ? 'Active' : 'Inactive' }}</span>
                    </div>
                @empty
                    <div class="dashboard-empty">No activities added yet.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="dashboard-actions">
        @can('notice_create')
            <a href="{{ route('admin.notices.create') }}" class="dashboard-action">
                <i class="fas fa-plus-circle"></i>
                Add Notice
            </a>
        @endcan
        @can('gallery_create')
            <a href="{{ route('admin.galleries.create') }}" class="dashboard-action">
                <i class="fas fa-images"></i>
                Add Gallery
            </a>
        @endcan
        @can('hero_slide_create')
            <a href="{{ route('admin.hero-slides.create') }}" class="dashboard-action">
                <i class="fas fa-images"></i>
                Add Hero Slide
            </a>
        @endcan
        @can('disclosure_document_create')
            <a href="{{ route('admin.disclosure-documents.create') }}" class="dashboard-action">
                <i class="fas fa-file-alt"></i>
                Add RTI / NAAC Document
            </a>
        @endcan
        @can('website_setting_access')
            <a href="{{ route('admin.website-settings.index') }}" class="dashboard-action">
                <i class="fas fa-sliders"></i>
                Website Settings
            </a>
        @endcan
        <a href="{{ route('profile.password.edit') }}" class="dashboard-action">
            <i class="fas fa-key"></i>
            Change Password
        </a>
    </section>
</div>
@endsection
