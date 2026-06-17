@extends('frontend.master')

@section('title', $syllabusDocument->title . ' - Ganga Devi Mahila Mahavidyalaya')

@section('content')

<section class="syllabus-detail-section">
    <div class="container">

        <div class="syllabus-detail-card">

            <span class="syllabus-section-badge">
                <i class="bi bi-folder-fill"></i>
                {{ $syllabusDocument->document_type ?: 'Syllabus Document' }}
            </span>

            <h1>
                {{ $syllabusDocument->title }}
            </h1>

            @if($syllabusDocument->short_description)

                <p>
                    {{ $syllabusDocument->short_description }}
                </p>

            @endif

            <div class="syllabus-detail-meta">

                <span>
                    <i class="bi bi-mortarboard-fill"></i>
                    {{ optional($syllabusDocument->course)->name }}
                </span>

                @if($syllabusDocument->subject)

                    <span>
                        <i class="bi bi-book-half"></i>
                        {{ $syllabusDocument->subject->name }}
                    </span>

                @endif

                <span>
                    <i class="bi bi-calendar3"></i>
                    {{ $syllabusDocument->academic_session }}
                </span>

                @if($syllabusDocument->semester)

                    <span>
                        <i class="bi bi-layers-fill"></i>
                        {{ $syllabusDocument->semester }}
                    </span>

                @endif

            </div>

            @if($syllabusDocument->download_url)

                <a href="{{ $syllabusDocument->download_url }}"
                   target="_blank"
                   rel="noopener"
                   class="syllabus-detail-download">

                    <i class="bi bi-download"></i>

                    {{ $syllabusDocument->button_text ?: 'Download Syllabus' }}
                </a>

            @endif

            <a href="{{ route('frontend.syllabus.index') }}"
               class="syllabus-detail-back">

                <i class="bi bi-arrow-left"></i>

                Back to Syllabus
            </a>

        </div>

    </div>
</section>

<style>
    .syllabus-detail-section {
        padding: 90px 0;
        background: #f8fafc;
    }

    .syllabus-detail-card {
        max-width: 900px;
        padding: 36px;
        margin: 0 auto;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
    }

    .syllabus-detail-card h1 {
        margin: 18px 0 12px;
        color: #0f172a;
        font-size: 34px;
        font-weight: 800;
        line-height: 1.25;
    }

    .syllabus-detail-card p {
        color: #475569;
        font-size: 15px;
        line-height: 1.8;
    }

    .syllabus-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 24px 0;
    }

    .syllabus-detail-meta span {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 12px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
    }

    .syllabus-detail-download,
    .syllabus-detail-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 46px;
        padding: 0 18px;
        border-radius: 11px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }

    .syllabus-detail-download {
        margin-right: 10px;
        background: #173f73;
        color: #ffffff;
    }

    .syllabus-detail-back {
        border: 1px solid #dbe2ea;
        background: #ffffff;
        color: #475569;
    }

    @media(max-width: 576px) {
        .syllabus-detail-section {
            padding: 55px 0;
        }

        .syllabus-detail-card {
            padding: 24px;
        }

        .syllabus-detail-card h1 {
            font-size: 26px;
        }

        .syllabus-detail-download,
        .syllabus-detail-back {
            width: 100%;
            margin: 8px 0 0;
        }
    }
</style>

@endsection
