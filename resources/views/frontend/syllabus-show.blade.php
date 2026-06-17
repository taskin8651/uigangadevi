@extends('frontend.master')

@section('title', $syllabusDocument->title . ' - Ganga Devi Mahila Mahavidyalaya')

@section('content')

<main class="syllabus-detail-page">
    <section class="syllabus-detail-hero">
        <div class="container">
            <a href="{{ route('frontend.syllabus.index') }}" class="syllabus-detail-back-link">
                <i class="bi bi-arrow-left"></i>
                Back to Syllabus
            </a>

            <div class="syllabus-detail-hero-grid">
                <div class="syllabus-detail-hero-content">
                    <span class="syllabus-section-badge">
                        <i class="bi bi-folder-fill"></i>
                        {{ $syllabusDocument->document_type ?: 'Syllabus Document' }}
                    </span>

                    <h1>{{ $syllabusDocument->title }}</h1>

                    <p>
                        {{ $syllabusDocument->short_description ?: 'View complete syllabus details, course information, academic session and download the official document for reference.' }}
                    </p>

                    <div class="syllabus-detail-actions">
                        @if($syllabusDocument->download_url)
                            <a href="{{ $syllabusDocument->download_url }}"
                               target="_blank"
                               rel="noopener"
                               class="syllabus-detail-download">
                                <i class="bi bi-download"></i>
                                {{ $syllabusDocument->button_text ?: 'Download Syllabus' }}
                            </a>
                        @else
                            <span class="syllabus-detail-download disabled">
                                <i class="bi bi-file-earmark-x"></i>
                                Document Not Available
                            </span>
                        @endif

                        <a href="{{ route('frontend.courses') }}" class="syllabus-detail-outline">
                            <i class="bi bi-journal-bookmark-fill"></i>
                            Courses Offered
                        </a>
                    </div>
                </div>

                <div class="syllabus-detail-summary">
                    <div class="summary-icon">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                    </div>
                    <span>Academic Session</span>
                    <strong>{{ $syllabusDocument->academic_session }}</strong>
                    <p>{{ optional($syllabusDocument->course)->name ?: 'Academic Programme' }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="syllabus-detail-section">
        <div class="container">
            <div class="syllabus-detail-layout">
                <div class="syllabus-detail-main">
                    <div class="syllabus-info-panel">
                        <div class="syllabus-panel-head">
                            <span>Document Information</span>
                            @if($syllabusDocument->is_featured)
                                <small><i class="bi bi-star-fill"></i> Featured</small>
                            @endif
                        </div>

                        <div class="syllabus-info-grid">
                            <div class="syllabus-info-item">
                                <i class="bi bi-mortarboard-fill"></i>
                                <div>
                                    <span>Course</span>
                                    <strong>{{ optional($syllabusDocument->course)->name ?: 'Not assigned' }}</strong>
                                </div>
                            </div>

                            <div class="syllabus-info-item">
                                <i class="bi bi-book-half"></i>
                                <div>
                                    <span>Subject</span>
                                    <strong>{{ optional($syllabusDocument->subject)->name ?: 'All subjects' }}</strong>
                                </div>
                            </div>

                            <div class="syllabus-info-item">
                                <i class="bi bi-calendar3"></i>
                                <div>
                                    <span>Session</span>
                                    <strong>{{ $syllabusDocument->academic_session }}</strong>
                                </div>
                            </div>

                            <div class="syllabus-info-item">
                                <i class="bi bi-layers-fill"></i>
                                <div>
                                    <span>Semester / Year</span>
                                    <strong>{{ $syllabusDocument->semester ?: 'Complete course' }}</strong>
                                </div>
                            </div>

                            <div class="syllabus-info-item">
                                <i class="bi bi-diagram-3-fill"></i>
                                <div>
                                    <span>Curriculum Type</span>
                                    <strong>{{ $syllabusDocument->curriculum_type ?: 'Regular Curriculum' }}</strong>
                                </div>
                            </div>

                            <div class="syllabus-info-item">
                                <i class="bi bi-clock-history"></i>
                                <div>
                                    <span>Effective From</span>
                                    <strong>{{ $syllabusDocument->effective_from ?: 'Current session' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="syllabus-info-panel">
                        <div class="syllabus-panel-head">
                            <span>Course & Department Details</span>
                        </div>

                        <div class="syllabus-rich-content">
                            @if(optional($syllabusDocument->course)->short_description)
                                <h3>{{ $syllabusDocument->course->name }}</h3>
                                <p>{{ $syllabusDocument->course->short_description }}</p>
                            @endif

                            @if(optional($syllabusDocument->course)->duration || optional($syllabusDocument->course)->level || optional($syllabusDocument->course)->course_type)
                                <div class="syllabus-chip-row">
                                    @if($syllabusDocument->course->level)
                                        <span>{{ $syllabusDocument->course->level }}</span>
                                    @endif

                                    @if($syllabusDocument->course->duration)
                                        <span>{{ $syllabusDocument->course->duration }}</span>
                                    @endif

                                    @if($syllabusDocument->course->course_type)
                                        <span>{{ $syllabusDocument->course->course_type }}</span>
                                    @endif
                                </div>
                            @endif

                            @if(optional($syllabusDocument->subject)->short_description)
                                <h3>{{ $syllabusDocument->subject->department_name ?: $syllabusDocument->subject->name }}</h3>
                                <p>{{ $syllabusDocument->subject->short_description }}</p>
                            @endif

                            @unless(optional($syllabusDocument->course)->short_description || optional($syllabusDocument->subject)->short_description)
                                <p>
                                    This syllabus document is published for students to verify the prescribed curriculum,
                                    plan their study schedule and prepare according to the current academic session.
                                </p>
                            @endunless
                        </div>
                    </div>
                </div>

                <aside class="syllabus-detail-sidebar">
                    <div class="syllabus-side-card">
                        <h3>Download File</h3>
                        <div class="syllabus-file-box">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            <div>
                                <strong>{{ $syllabusDocument->document['name'] ?? 'Syllabus Document' }}</strong>
                                <span>
                                    @if($syllabusDocument->document['size'] ?? null)
                                        {{ number_format($syllabusDocument->document['size'] / 1024, 1) }} KB
                                    @else
                                        External or uploaded file
                                    @endif
                                </span>
                            </div>
                        </div>

                        @if($syllabusDocument->download_url)
                            <a href="{{ $syllabusDocument->download_url }}"
                               target="_blank"
                               rel="noopener"
                               class="syllabus-side-download">
                                <i class="bi bi-box-arrow-up-right"></i>
                                Open Document
                            </a>
                        @endif
                    </div>

                    <div class="syllabus-side-card">
                        <h3>Quick Facts</h3>
                        <ul class="syllabus-fact-list">
                            <li>
                                <span>Document Type</span>
                                <strong>{{ $syllabusDocument->document_type ?: 'Syllabus' }}</strong>
                            </li>
                            <li>
                                <span>Sort Order</span>
                                <strong>{{ $syllabusDocument->sort_order }}</strong>
                            </li>
                            <li>
                                <span>Updated On</span>
                                <strong>{{ optional($syllabusDocument->updated_at)->format('d M Y') }}</strong>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @if($relatedSyllabusDocuments->isNotEmpty())
        <section class="syllabus-related-section">
            <div class="container">
                <div class="syllabus-related-head">
                    <span class="syllabus-section-badge">
                        <i class="bi bi-link-45deg"></i>
                        Related Syllabus
                    </span>
                    <h2>More Academic Documents</h2>
                </div>

                <div class="syllabus-related-grid">
                    @foreach($relatedSyllabusDocuments as $relatedSyllabus)
                        <a href="{{ route('frontend.syllabus.show', $relatedSyllabus->slug) }}" class="syllabus-related-card">
                            <i class="bi bi-journal-richtext"></i>
                            <span>{{ $relatedSyllabus->academic_session }}</span>
                            <h3>{{ $relatedSyllabus->title }}</h3>
                            <p>{{ optional($relatedSyllabus->course)->name ?: 'Academic Programme' }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</main>

<style>
    .syllabus-detail-page {
        background: #f8fafc;
    }

    .syllabus-detail-hero {
        padding: 64px 0 54px;
        background: linear-gradient(135deg, #0f2f57 0%, #174879 58%, #0f766e 100%);
        color: #ffffff;
    }

    .syllabus-detail-back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
        color: rgba(255, 255, 255, .88);
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }

    .syllabus-detail-hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 310px;
        gap: 28px;
        align-items: stretch;
    }

    .syllabus-detail-hero-content h1 {
        max-width: 860px;
        margin: 18px 0 14px;
        color: #ffffff;
        font-size: 44px;
        font-weight: 900;
        line-height: 1.15;
    }

    .syllabus-detail-hero-content p {
        max-width: 790px;
        color: rgba(255, 255, 255, .84);
        font-size: 16px;
        line-height: 1.8;
    }

    .syllabus-detail-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 26px;
    }

    .syllabus-detail-download,
    .syllabus-detail-outline,
    .syllabus-side-download {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 46px;
        padding: 0 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }

    .syllabus-detail-download {
        background: #f4b400;
        color: #1f2937;
    }

    .syllabus-detail-download.disabled {
        background: rgba(255, 255, 255, .18);
        color: rgba(255, 255, 255, .8);
    }

    .syllabus-detail-outline {
        border: 1px solid rgba(255, 255, 255, .34);
        color: #ffffff;
    }

    .syllabus-detail-summary {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 28px;
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 18px;
        background: rgba(255, 255, 255, .12);
    }

    .summary-icon {
        width: 64px;
        height: 64px;
        display: grid;
        place-items: center;
        margin-bottom: 18px;
        border-radius: 16px;
        background: #ffffff;
        color: #174879;
        font-size: 32px;
    }

    .syllabus-detail-summary span {
        color: rgba(255, 255, 255, .7);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .syllabus-detail-summary strong {
        margin: 7px 0;
        color: #ffffff;
        font-size: 25px;
        line-height: 1.2;
    }

    .syllabus-detail-summary p {
        margin: 0;
        color: rgba(255, 255, 255, .78);
    }

    .syllabus-detail-section,
    .syllabus-related-section {
        padding: 64px 0;
    }

    .syllabus-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 330px;
        gap: 24px;
        align-items: start;
    }

    .syllabus-detail-main,
    .syllabus-detail-sidebar {
        display: grid;
        gap: 20px;
    }

    .syllabus-info-panel,
    .syllabus-side-card,
    .syllabus-related-card {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 16px 38px rgba(15, 23, 42, .06);
    }

    .syllabus-info-panel {
        padding: 26px;
    }

    .syllabus-panel-head,
    .syllabus-related-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 20px;
    }

    .syllabus-panel-head span {
        color: #0f172a;
        font-size: 20px;
        font-weight: 900;
    }

    .syllabus-panel-head small {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #b45309;
        font-size: 11px;
        font-weight: 900;
    }

    .syllabus-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .syllabus-info-item {
        display: flex;
        gap: 13px;
        padding: 16px;
        border: 1px solid #edf2f7;
        border-radius: 14px;
        background: #f8fafc;
    }

    .syllabus-info-item > i {
        width: 42px;
        height: 42px;
        display: grid;
        flex: 0 0 auto;
        place-items: center;
        border-radius: 12px;
        background: #e0f2fe;
        color: #0369a1;
        font-size: 20px;
    }

    .syllabus-info-item span,
    .syllabus-fact-list span,
    .syllabus-file-box span {
        display: block;
        margin-bottom: 4px;
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
    }

    .syllabus-info-item strong,
    .syllabus-fact-list strong {
        color: #0f172a;
        font-size: 14px;
    }

    .syllabus-rich-content h3 {
        margin: 0 0 9px;
        color: #0f172a;
        font-size: 20px;
        font-weight: 900;
    }

    .syllabus-rich-content p {
        margin-bottom: 18px;
        color: #475569;
        font-size: 15px;
        line-height: 1.8;
    }

    .syllabus-chip-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 0 0 22px;
    }

    .syllabus-chip-row span {
        padding: 7px 10px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #047857;
        font-size: 12px;
        font-weight: 800;
    }

    .syllabus-side-card {
        padding: 22px;
    }

    .syllabus-side-card h3 {
        margin: 0 0 16px;
        color: #0f172a;
        font-size: 18px;
        font-weight: 900;
    }

    .syllabus-file-box {
        display: flex;
        gap: 13px;
        padding: 16px;
        border-radius: 14px;
        background: #f8fafc;
    }

    .syllabus-file-box > i {
        color: #dc2626;
        font-size: 30px;
    }

    .syllabus-file-box strong {
        display: block;
        color: #0f172a;
        font-size: 13px;
        word-break: break-word;
    }

    .syllabus-side-download {
        width: 100%;
        margin-top: 14px;
        background: #173f73;
        color: #ffffff;
    }

    .syllabus-fact-list {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .syllabus-fact-list li {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #edf2f7;
    }

    .syllabus-fact-list li:last-child {
        border-bottom: 0;
    }

    .syllabus-related-section {
        padding-top: 0;
    }

    .syllabus-related-head {
        margin-bottom: 22px;
    }

    .syllabus-related-head h2 {
        margin: 0;
        color: #0f172a;
        font-size: 28px;
        font-weight: 900;
    }

    .syllabus-related-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .syllabus-related-card {
        display: block;
        padding: 20px;
        color: inherit;
        text-decoration: none;
    }

    .syllabus-related-card > i {
        color: #173f73;
        font-size: 30px;
    }

    .syllabus-related-card span {
        display: block;
        margin: 14px 0 7px;
        color: #047857;
        font-size: 12px;
        font-weight: 900;
    }

    .syllabus-related-card h3 {
        margin: 0 0 8px;
        color: #0f172a;
        font-size: 16px;
        font-weight: 900;
        line-height: 1.35;
    }

    .syllabus-related-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
    }

    @media(max-width: 991px) {
        .syllabus-detail-hero-grid,
        .syllabus-detail-layout {
            grid-template-columns: 1fr;
        }

        .syllabus-related-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 576px) {
        .syllabus-detail-hero {
            padding: 42px 0;
        }

        .syllabus-detail-hero-content h1 {
            font-size: 30px;
        }

        .syllabus-info-grid,
        .syllabus-related-grid {
            grid-template-columns: 1fr;
        }

        .syllabus-info-panel,
        .syllabus-side-card {
            padding: 20px;
        }

        .syllabus-detail-download,
        .syllabus-detail-outline {
            width: 100%;
        }
    }
</style>

@endsection
