@extends('frontend.master')
@section('title', 'Syllabus - Ganga Devi Mahila Mahavidyalaya, Patna')
@section('content')


<!-- ================= SYLLABUS PAGE START ================= -->

<main class="syllabus-page">

  <!-- HERO START -->
  <section class="syllabus-hero">
    <div class="syllabus-hero-bg">
      <img src="assets/img/hero.png" alt="Syllabus">
    </div>

    <div class="container">
      <div class="syllabus-hero-content">
        <span class="syllabus-badge">
          <i class="bi bi-file-earmark-text-fill"></i>
          Syllabus
        </span>

        <h1>Course-wise Syllabus & Academic Resources</h1>

        <p>
          Access undergraduate and postgraduate syllabus details, subject-wise academic resources,
          curriculum information and important study documents.
        </p>

        <div class="syllabus-hero-actions">
          <a href="#" class="syllabus-btn primary">
            <i class="bi bi-download"></i>
            Download Syllabus
          </a>

          <a href="{{ route('frontend.courses') }}" class="syllabus-btn light">
            <i class="bi bi-journal-bookmark-fill"></i>
            Courses Offered
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- HERO END -->


  <!-- INTRO START -->
  <section class="syllabus-intro-section">
    <div class="container">

      <div class="syllabus-intro-grid">

        <div class="syllabus-intro-card">
          <span class="syllabus-section-badge">
            <i class="bi bi-book-half"></i>
            Academic Syllabus
          </span>

          <h2>Structured Curriculum for Student Learning and Academic Progress.</h2>

          <p>
            The syllabus section provides course-wise and subject-wise academic information
            to help students understand the curriculum, study areas, examination requirements
            and learning outcomes.
          </p>

          <p>
            Students should verify the latest syllabus, subject combinations and examination
            pattern as per current university instructions and official college notices.
          </p>

          <div class="syllabus-points-grid">
            <div>
              <i class="bi bi-check2-circle"></i>
              Course-wise syllabus access
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              Subject-wise academic resources
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              University curriculum guidelines
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              Downloadable study documents
            </div>
          </div>
        </div>

        <div class="syllabus-note-card">
          <div class="syllabus-note-icon">
            <i class="bi bi-info-circle-fill"></i>
          </div>

          <h3>Important Instruction</h3>

          <p>
            Syllabus content may be updated from time to time as per university notifications.
            Always verify the latest applicable syllabus before examination preparation.
          </p>

          <a href="{{ route('frontend.notices.index') }}" class="syllabus-text-link">
            View Latest Notice
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>

      </div>

    </div>
  </section>
  <!-- INTRO END -->


  <!-- QUICK STATS START -->
  <section class="syllabus-stats-section">
    <div class="container">

      <div class="syllabus-section-title text-center">
        <span class="syllabus-section-badge">
          <i class="bi bi-bar-chart-fill"></i>
          Syllabus Overview
        </span>

        <h2>Academic Resource Highlights</h2>

        <p>
          Important academic resources available for students and departments.
        </p>
      </div>

      <div class="syllabus-stats-grid">

        <div class="syllabus-stat-card">
          <div class="syllabus-stat-icon">
            <i class="bi bi-mortarboard-fill"></i>
          </div>
          <h3>UG</h3>
          <p>Undergraduate</p>
        </div>

        <div class="syllabus-stat-card">
          <div class="syllabus-stat-icon">
            <i class="bi bi-award-fill"></i>
          </div>
          <h3>PG</h3>
          <p>Postgraduate</p>
        </div>

        <div class="syllabus-stat-card">
          <div class="syllabus-stat-icon">
            <i class="bi bi-diagram-3-fill"></i>
          </div>
          <h3>Subjects</h3>
          <p>Department Wise</p>
        </div>

        <div class="syllabus-stat-card">
          <div class="syllabus-stat-icon">
            <i class="bi bi-file-earmark-pdf-fill"></i>
          </div>
          <h3>PDF</h3>
          <p>Downloads</p>
        </div>

      </div>

    </div>
  </section>
  <!-- QUICK STATS END -->


  <!-- SYLLABUS DOWNLOADS START -->
 <section class="syllabus-download-section">
    <div class="container">

        <div class="syllabus-section-title text-center">

            <span class="syllabus-section-badge">
                <i class="bi bi-folder-fill"></i>
                Download Section
            </span>

            <h2>
                Course-wise Syllabus Downloads
            </h2>

            <p>
                Download syllabus documents according to programme,
                subject and academic session.
            </p>

        </div>

        <form method="GET"
              action="{{ route('frontend.syllabus.index') }}"
              class="syllabus-filter-box">

            <div class="syllabus-filter-field">

                <label for="session">
                    Academic Session
                </label>

                <select name="session"
                        id="session">

                    <option value="">
                        All Sessions
                    </option>

                    @foreach($academicSessions as $session)

                        <option value="{{ $session }}"
                            {{ $selectedSession === $session ? 'selected' : '' }}>

                            {{ $session }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="syllabus-filter-field">

                <label for="course">
                    Course
                </label>

                <select name="course"
                        id="course">

                    <option value="">
                        All Courses
                    </option>

                    @foreach($courses as $course)

                        <option value="{{ $course->id }}"
                            {{ (string) $selectedCourse === (string) $course->id ? 'selected' : '' }}>

                            {{ $course->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <button type="submit"
                    class="syllabus-filter-btn">

                <i class="bi bi-funnel-fill"></i>
                Filter
            </button>

            @if($selectedSession || $selectedCourse)

                <a href="{{ route('frontend.syllabus.index') }}"
                   class="syllabus-reset-btn">

                    Reset
                </a>

            @endif

        </form>

        @if($syllabusDocuments->isNotEmpty())

            <div class="syllabus-download-grid">

                @foreach($syllabusDocuments as $syllabus)

                    <div class="syllabus-download-card {{ $syllabus->is_featured ? 'featured' : '' }}">

                        @if($syllabus->is_featured)
                            <span class="syllabus-featured-label">
                                <i class="bi bi-star-fill"></i>
                                Featured
                            </span>
                        @endif

                        <div class="syllabus-download-icon">

                            @switch(optional($syllabus->course)->short_name)

                                @case('B.Sc.')
                                    <i class="bi bi-calculator-fill"></i>
                                    @break

                                @case('B.Com.')
                                    <i class="bi bi-briefcase-fill"></i>
                                    @break

                                @default
                                    <i class="bi bi-journal-richtext"></i>

                            @endswitch

                        </div>

                        <span>
                            {{ optional($syllabus->course)->level ?: 'Academic Programme' }}
                        </span>

                        <h3>
                            {{ $syllabus->title }}
                        </h3>

                        @if($syllabus->short_description)

                            <p>
                                {{ $syllabus->short_description }}
                            </p>

                        @endif

                        <div class="syllabus-card-meta">

                            <small>
                                <i class="bi bi-calendar3"></i>
                                {{ $syllabus->academic_session }}
                            </small>

                            @if($syllabus->semester)

                                <small>
                                    <i class="bi bi-layers-fill"></i>
                                    {{ $syllabus->semester }}
                                </small>

                            @endif

                            @if($syllabus->subject)

                                <small>
                                    <i class="bi bi-book-half"></i>
                                    {{ $syllabus->subject->name }}
                                </small>

                            @endif

                        </div>

                        <a href="{{ route('frontend.syllabus.show', $syllabus->slug) }}"
                           class="syllabus-card-link">

                            View Details

                            <i class="bi bi-arrow-right"></i>
                        </a>

                        @if(! $syllabus->download_url)

                            <span class="syllabus-card-link disabled">
                                Document Not Available
                            </span>

                        @endif

                    </div>

                @endforeach

            </div>

        @else

            <div class="syllabus-empty-state">

                <i class="bi bi-folder-x"></i>

                <h3>
                    No Syllabus Documents Found
                </h3>

                <p>
                    No syllabus document matches the selected filters.
                </p>

                <a href="{{ route('frontend.syllabus.index') }}">
                    View All Syllabus
                </a>

            </div>

        @endif

    </div>
</section>

<style>
    .syllabus-filter-box {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        max-width: 900px;
        padding: 16px;
        margin: 0 auto 35px;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
    }

    .syllabus-filter-field {
        flex: 1;
    }

    .syllabus-filter-field label {
        display: block;
        margin-bottom: 7px;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
    }

    .syllabus-filter-field select {
        width: 100%;
        min-height: 46px;
        padding: 0 12px;
        border: 1px solid #dbe2ea;
        border-radius: 11px;
        background: #f8fafc;
        color: #334155;
    }

    .syllabus-filter-btn,
    .syllabus-reset-btn {
        min-height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 17px;
        border-radius: 11px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }

    .syllabus-filter-btn {
        border: 0;
        background: #173f73;
        color: #ffffff;
    }

    .syllabus-reset-btn {
        border: 1px solid #dbe2ea;
        background: #ffffff;
        color: #475569;
    }

    .syllabus-download-card {
        position: relative;
    }

    .syllabus-download-card.featured {
        border-color: #f4b400;
    }

    .syllabus-featured-label {
        position: absolute;
        top: 15px;
        right: 15px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 999px;
        background: #fffbeb;
        color: #b45309;
        font-size: 10px;
        font-weight: 800;
    }

    .syllabus-card-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin: 14px 0;
    }

    .syllabus-card-meta small {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 8px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #475569;
        font-size: 10.5px;
        font-weight: 700;
    }

    .syllabus-card-link.disabled {
        cursor: not-allowed;
        opacity: .55;
    }

    .syllabus-empty-state {
        padding: 65px 20px;
        text-align: center;
    }

    .syllabus-empty-state > i {
        color: #94a3b8;
        font-size: 54px;
    }

    .syllabus-empty-state h3 {
        margin: 15px 0 7px;
        color: #1e293b;
    }

    .syllabus-empty-state p {
        color: #64748b;
    }

    .syllabus-empty-state a {
        display: inline-flex;
        margin-top: 12px;
        color: #173f73;
        font-weight: 700;
        text-decoration: none;
    }

    @media(max-width:768px) {
        .syllabus-filter-box {
            align-items: stretch;
            flex-direction: column;
        }

        .syllabus-filter-btn,
        .syllabus-reset-btn {
            width: 100%;
        }
    }
</style>
  <!-- SYLLABUS DOWNLOADS END -->


  <!-- SUBJECT WISE START -->
  <section class="syllabus-subject-section">
    <div class="container">

      <div class="syllabus-section-title text-center">
        <span class="syllabus-section-badge">
          <i class="bi bi-diagram-3-fill"></i>
          Subject-wise Resources
        </span>

        <h2>Academic Subject Areas</h2>

        <p>
          Students can access syllabus and learning resources according to subject category.
        </p>
      </div>

      <div class="syllabus-subject-grid">

        <div class="syllabus-subject-card">
          <i class="bi bi-translate"></i>
          <h4>Languages</h4>
          <p>Hindi, English, Urdu, Sanskrit and related language syllabus resources.</p>
        </div>

        <div class="syllabus-subject-card">
          <i class="bi bi-globe-central-south-asia"></i>
          <h4>Social Sciences</h4>
          <p>History, Political Science, Sociology, Psychology and related subjects.</p>
        </div>

        <div class="syllabus-subject-card">
          <i class="bi bi-graph-up-arrow"></i>
          <h4>Commerce</h4>
          <p>Accounting, business studies, economics and finance syllabus resources.</p>
        </div>

        <div class="syllabus-subject-card">
          <i class="bi bi-flower1"></i>
          <h4>Science</h4>
          <p>Science stream syllabus and practical learning related academic resources.</p>
        </div>

      </div>

    </div>
  </section>
  <!-- SUBJECT WISE END -->


  <!-- GUIDELINES START -->
  <section class="syllabus-guideline-section">
    <div class="container">

      <div class="syllabus-guideline-wrap">

        <div class="syllabus-guideline-content">
          <span class="syllabus-section-badge">
            <i class="bi bi-shield-check"></i>
            Guidelines
          </span>

          <h2>Important Syllabus Guidelines for Students</h2>

          <p>
            Students are advised to follow the syllabus prescribed by the university and
            consult their department for subject-specific clarification, internal assessment
            and examination preparation.
          </p>

          <a href="{{ route('frontend.academic-calendar.index') }}" class="syllabus-btn primary">
            <i class="bi bi-megaphone-fill"></i>
            View Academic Notices
          </a>
        </div>

        <div class="syllabus-guideline-list">

          <div class="syllabus-guideline-item">
            <span>01</span>
            <div>
              <h4>Verify Latest Syllabus</h4>
              <p>Use the latest syllabus document issued by the university or college.</p>
            </div>
          </div>

          <div class="syllabus-guideline-item">
            <span>02</span>
            <div>
              <h4>Follow Department Instructions</h4>
              <p>Subject teachers and departments may provide additional academic guidance.</p>
            </div>
          </div>

          <div class="syllabus-guideline-item">
            <span>03</span>
            <div>
              <h4>Check Examination Pattern</h4>
              <p>Understand exam format, internal assessment and practical requirements.</p>
            </div>
          </div>

          <div class="syllabus-guideline-item">
            <span>04</span>
            <div>
              <h4>Download Official Documents</h4>
              <p>Keep downloaded syllabus PDFs for study planning and examination reference.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>
  <!-- GUIDELINES END -->


  <!-- IMPORTANT LINKS START -->
  <section class="syllabus-links-section">
    <div class="container">

      <div class="syllabus-section-title text-center">
        <span class="syllabus-section-badge">
          <i class="bi bi-link-45deg"></i>
          Quick Access
        </span>

        <h2>Syllabus Related Links</h2>

        <p>
          Quick access to academic resources and student support pages.
        </p>
      </div>

      <div class="syllabus-links-grid">

        <a href="{{ route('frontend.courses') }}" class="syllabus-link-card">
          <i class="bi bi-journal-bookmark-fill"></i>
          <span>Courses Offered</span>
        </a>

        <a href="{{ route('frontend.academic-calendar.index') }}" class="syllabus-link-card">
          <i class="bi bi-calendar2-week-fill"></i>
          <span>Academic Calendar</span>
        </a>

        <a href="{{ route('frontend.examination') }}" class="syllabus-link-card">
          <i class="bi bi-pencil-square"></i>
          <span>Examination</span>
        </a>

        <a href="#" class="syllabus-link-card">
          <i class="bi bi-file-earmark-arrow-down-fill"></i>
          <span>Downloads</span>
        </a>

        <a href="{{ route('frontend.notices.index') }}" class="syllabus-link-card">
          <i class="bi bi-megaphone-fill"></i>
          <span>Latest Notices</span>
        </a>

        <a href="#" class="syllabus-link-card">
          <i class="bi bi-person-lines-fill"></i>
          <span>Student Corner</span>
        </a>

      </div>

    </div>
  </section>
  <!-- IMPORTANT LINKS END -->


  <!-- CTA START -->
  <section class="syllabus-cta-section">
    <div class="container">

      <div class="syllabus-cta-wrap">
        <div>
          <span>Academic Resources</span>
          <h2>Download syllabus, check academic notices and prepare with verified resources.</h2>
        </div>

        <div class="syllabus-cta-actions">
          <a href="#" class="syllabus-btn primary">
            <i class="bi bi-download"></i>
            Download Syllabus
          </a>

          <a href="{{ route('frontend.contact') }}" class="syllabus-btn light">
            <i class="bi bi-telephone-fill"></i>
            Contact Office
          </a>
        </div>
      </div>

    </div>
  </section>
  <!-- CTA END -->

</main>

<!-- ================= SYLLABUS PAGE END ================= -->






    @endsection

