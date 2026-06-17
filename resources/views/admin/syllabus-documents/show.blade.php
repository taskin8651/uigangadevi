@extends('layouts.admin')

@section('page-title', 'Syllabus Document Details')

@section('content')

<div class="admin-page-head">

    <div>
        <a href="{{ route('admin.syllabus-documents.index') }}"
           class="admin-back-link">

            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Syllabus Document Details
        </h2>

        <p class="admin-page-subtitle">
            Complete syllabus, course, subject and file information
        </p>
    </div>

    <div class="show-actions">

        @can('syllabus_document_edit')
            <a href="{{ route('admin.syllabus-documents.edit', $syllabusDocument->id) }}"
               class="btn-primary">

                <i class="fas fa-pencil-alt"></i>
                Edit Syllabus
            </a>
        @endcan

        @can('syllabus_document_delete')
            <form action="{{ route('admin.syllabus-documents.destroy', $syllabusDocument->id) }}"
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

    <div>

        <div class="detail-card mb-3">

            <div class="profile-hero">

                <div class="profile-avatar-lg"
                     style="background:#4f46e5;">

                    <i class="fas fa-book-open"></i>
                </div>

                <p class="profile-title">
                    {{ $syllabusDocument->title }}
                </p>

                <p class="profile-subtitle">
                    {{ optional($syllabusDocument->course)->name }}
                </p>

                @if($syllabusDocument->status)

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

            </div>

            <div class="detail-section-pad-sm">

                <div class="d-grid gap-2"
                     style="grid-template-columns:1fr 1fr;">

                    <div class="stat-mini">

                        <p class="stat-mini-label">
                            Document ID
                        </p>

                        <p class="stat-mini-value">
                            #{{ $syllabusDocument->id }}
                        </p>

                    </div>

                    <div class="stat-mini">

                        <p class="stat-mini-label">
                            Academic Session
                        </p>

                        <p class="stat-mini-value-sm">
                            {{ $syllabusDocument->academic_session }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="detail-card detail-card-pad">

            <p class="quick-title">
                Quick Actions
            </p>

            <div class="quick-list">

                @can('syllabus_document_edit')
                    <a href="{{ route('admin.syllabus-documents.edit', $syllabusDocument->id) }}"
                       class="quick-link primary">

                        <i class="fas fa-edit"></i>
                        Edit Syllabus
                    </a>
                @endcan

                <a href="{{ route('admin.syllabus-documents.index') }}"
                   class="quick-link">

                    <i class="fas fa-list"></i>
                    All Syllabus Documents
                </a>

                @if($syllabusDocument->download_url)

                    <a href="{{ $syllabusDocument->download_url }}"
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

    <div>

        <div class="detail-card mb-3">

            <div class="detail-section-head">

                <div class="detail-section-icon">
                    <i class="fas fa-id-card"></i>
                </div>

                <p class="detail-section-title">
                    Syllabus Information
                </p>

            </div>

            <div class="detail-section-body">

                <div class="detail-row">
                    <span class="detail-label">
                        ID
                    </span>

                    <span class="detail-value code-pill">
                        #{{ $syllabusDocument->id }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Title
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->title }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Slug
                    </span>

                    <span class="detail-value code-pill">
                        {{ $syllabusDocument->slug }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Course
                    </span>

                    <span class="detail-value">
                        {{ optional($syllabusDocument->course)->name ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Subject
                    </span>

                    <span class="detail-value">
                        {{ optional($syllabusDocument->subject)->name ?: 'Complete Course Syllabus' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Academic Session
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->academic_session }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Semester / Year
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->semester ?: 'All / Not specified' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Document Type
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->document_type ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Curriculum Type
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->curriculum_type ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Effective From
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->effective_from ?: '—' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Featured
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->is_featured ? 'Yes' : 'No' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Status
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">
                        Sort Order
                    </span>

                    <span class="detail-value">
                        {{ $syllabusDocument->sort_order }}
                    </span>
                </div>

            </div>

        </div>

        @if($syllabusDocument->short_description)

            <div class="detail-card mb-3">

                <div class="detail-section-head">

                    <div class="detail-section-icon">
                        <i class="fas fa-align-left"></i>
                    </div>

                    <p class="detail-section-title">
                        Description
                    </p>

                </div>

                <div style="padding:20px;line-height:1.8;color:#475569;">
                    {{ $syllabusDocument->short_description }}
                </div>

            </div>

        @endif

        <div class="detail-card">

            <div class="detail-section-head">

                <div class="detail-section-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>

                <p class="detail-section-title">
                    Download Information
                </p>

            </div>

            <div class="detail-section-pad-sm">

                @if($syllabusDocument->document)

                    <div class="syllabus-show-file">

                        <i class="fas fa-file-pdf"></i>

                        <div>
                            <strong>
                                {{ $syllabusDocument->document['name'] }}
                            </strong>

                            <span>
                                {{ number_format(
                                    $syllabusDocument->document['size'] / 1024,
                                    1
                                ) }} KB
                            </span>
                        </div>

                        <a href="{{ $syllabusDocument->document['url'] }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-primary">

                            <i class="fas fa-download"></i>
                            Download
                        </a>

                    </div>

                @elseif($syllabusDocument->external_url)

                    <div class="syllabus-show-file">

                        <i class="fas fa-external-link-alt"></i>

                        <div>
                            <strong>
                                External Syllabus Link
                            </strong>

                            <span>
                                {{ $syllabusDocument->external_url }}
                            </span>
                        </div>

                        <a href="{{ $syllabusDocument->external_url }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-primary">

                            <i class="fas fa-external-link-alt"></i>
                            Open
                        </a>

                    </div>

                @else

                    <div class="form-info-box">
                        <p>
                            <i class="fas fa-info-circle"></i>
                            No PDF or external link is available.
                        </p>
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

<style>
    .syllabus-show-file {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f8fafc;
    }

    .syllabus-show-file > i {
        color: #dc2626;
        font-size: 28px;
    }

    .syllabus-show-file > div {
        min-width: 0;
        flex: 1;
    }

    .syllabus-show-file strong,
    .syllabus-show-file span {
        display: block;
    }

    .syllabus-show-file strong {
        color: #1f2937;
        font-size: 13px;
    }

    .syllabus-show-file span {
        margin-top: 4px;
        overflow: hidden;
        color: #64748b;
        font-size: 11px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    @media(max-width:575px) {
        .syllabus-show-file {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .syllabus-show-file .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

@endsection