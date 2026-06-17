@extends('frontend.master')
@section('content')




  <!-- ================= ACADEMIC CALENDAR PAGE START ================= -->

  <main class="academic-calendar-page">

    <!-- HERO START -->
    <section class="calendar-hero">
      <div class="calendar-hero-bg">
        <img src="assets/img/hero.png" alt="Academic Calendar">
      </div>

      <div class="container">
        <div class="calendar-hero-content">
          <span class="calendar-badge">
            <i class="bi bi-calendar2-week-fill"></i>
            Academic Calendar
          </span>

          <h1>Academic Calendar & Important Schedules</h1>

          <p>
            View academic sessions, admission timeline, examination schedule, holidays,
            institutional activities and important academic dates.
          </p>

          <div class="calendar-hero-actions">
            <a href="download.html" class="calendar-btn primary">
              <i class="bi bi-download"></i>
              Download Calendar
            </a>

            <a href="{{ route('frontend.notices.index') }}" class="calendar-btn light">
              <i class="bi bi-megaphone-fill"></i>
              Latest Notices
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- HERO END -->


    <!-- INTRO START -->
    <section class="calendar-intro-section">
      <div class="container">

        <div class="calendar-intro-grid">

          <div class="calendar-intro-card">
            <span class="calendar-section-badge">
              <i class="bi bi-journal-check"></i>
              Academic Planning
            </span>

            <h2>Structured Academic Planning for Students and Departments.</h2>

            <p>
              The academic calendar provides a broad schedule of teaching days, internal
              assessments, examination activities, holidays, college events and important
              academic timelines.
            </p>

            <p>
              Dates may be updated as per university instructions, government notifications
              and institutional requirements. Students should always check the latest notices.
            </p>

            <div class="calendar-points-grid">
              <div>
                <i class="bi bi-check2-circle"></i>
                Academic session timeline
              </div>

              <div>
                <i class="bi bi-check2-circle"></i>
                Examination activities
              </div>

              <div>
                <i class="bi bi-check2-circle"></i>
                Admission and registration dates
              </div>

              <div>
                <i class="bi bi-check2-circle"></i>
                Events, holidays and notices
              </div>
            </div>
          </div>

          <div class="calendar-notice-card">
            <div class="calendar-notice-icon">
              <i class="bi bi-bell-fill"></i>
            </div>

            <h3>Important Note</h3>

            <p>
              Academic calendar dates are indicative and may change as per university,
              government or college notifications.
            </p>

            <a href="{{ route('frontend.notices.index') }}" class="calendar-text-link">
              Check Latest Updates
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>

        </div>

      </div>
    </section>
    <!-- INTRO END -->


    <!-- QUICK STATS START -->
    <section class="calendar-stats-section">
      <div class="container">

        <div class="calendar-section-title text-center">
          <span class="calendar-section-badge">
            <i class="bi bi-bar-chart-fill"></i>
            Calendar Highlights
          </span>

          <h2>Academic Year Overview</h2>

          <p>
            Key academic components usually included in the college calendar.
          </p>
        </div>

        <div class="calendar-stats-grid">

          <div class="calendar-stat-card">
            <div class="calendar-stat-icon">
              <i class="bi bi-calendar-check-fill"></i>
            </div>
            <h3>Session</h3>
            <p>Academic Year</p>
          </div>

          <div class="calendar-stat-card">
            <div class="calendar-stat-icon">
              <i class="bi bi-pencil-square"></i>
            </div>
            <h3>Exams</h3>
            <p>Assessment Schedule</p>
          </div>

          <div class="calendar-stat-card">
            <div class="calendar-stat-icon">
              <i class="bi bi-megaphone-fill"></i>
            </div>
            <h3>Notices</h3>
            <p>Official Updates</p>
          </div>

          <div class="calendar-stat-card">
            <div class="calendar-stat-icon">
              <i class="bi bi-stars"></i>
            </div>
            <h3>Events</h3>
            <p>College Activities</p>
          </div>

        </div>

      </div>
    </section>
    <!-- QUICK STATS END -->


    <!-- MONTHLY CALENDAR START -->
    @if($academicCalendar)

    <section class="calendar-month-section">
        <div class="container">

            <div class="calendar-section-title text-center">

                <span class="calendar-section-badge">
                    <i class="bi bi-calendar3"></i>
                    Monthly Plan
                </span>

                <h2>
                    {{ $academicCalendar->title }}
                </h2>

                <span class="calendar-session-badge">
                    <i class="bi bi-mortarboard-fill"></i>
                    Academic Session:
                    {{ $academicCalendar->academic_session }}
                </span>

                @if($academicCalendar->short_description)
                    <p>
                        {{ $academicCalendar->short_description }}
                    </p>
                @endif

                @if($academicCalendar->document)
                    <a href="{{ $academicCalendar->document['url'] }}"
                       target="_blank"
                       rel="noopener"
                       class="calendar-download-btn">

                        <i class="bi bi-file-earmark-pdf-fill"></i>
                        Download Academic Calendar
                    </a>
                @endif

            </div>

            <div class="calendar-month-grid">

                @foreach($academicCalendar->months as $month)

                    @php
                        $activeActivities = collect(
                            $month->activities ?? []
                        )->filter(function ($activity) {
                            return is_array($activity)
                                && !empty($activity['text'])
                                && !empty($activity['status']);
                        });
                    @endphp

                    @if($activeActivities->isNotEmpty())

                        <div class="calendar-month-card">

                            <div class="calendar-month-head">

                                <span>
                                    {{ str_pad(
                                        $month->display_number,
                                        2,
                                        '0',
                                        STR_PAD_LEFT
                                    ) }}
                                </span>

                                <h3>
                                    {{ $month->month_name }}
                                </h3>

                            </div>

                            <ul>

                                @foreach($activeActivities as $activity)

                                    <li>
                                        <i class="bi bi-check-circle"></i>

                                        {{ $activity['text'] }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                @endforeach

            </div>

        </div>
    </section>

@else

    <section class="calendar-month-section">
        <div class="container">

            <div class="calendar-empty-state text-center">

                <i class="bi bi-calendar-x"></i>

                <h2>
                    Academic Calendar Not Available
                </h2>

                <p>
                    The latest academic calendar will be published soon.
                </p>

            </div>

        </div>
    </section>

@endif

<style>
    .calendar-session-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin: 10px 0 4px;
        padding: 8px 14px;
        border-radius: 999px;
        background: #eef2ff;
        color: #4338ca;
        font-size: 13px;
        font-weight: 700;
    }

    .calendar-download-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 14px;
        padding: 12px 20px;
        border-radius: 10px;
        background: #b51f2a;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: .25s ease;
    }

    .calendar-download-btn:hover {
        color: #fff;
        background: #8f1420;
        transform: translateY(-2px);
    }

    .calendar-empty-state {
        padding: 70px 20px;
    }

    .calendar-empty-state > i {
        color: #94a3b8;
        font-size: 54px;
    }

    .calendar-empty-state h2 {
        margin: 16px 0 8px;
    }
</style>
    <!-- MONTHLY CALENDAR END -->


    <!-- IMPORTANT DATES START -->
    <section class="calendar-dates-section">
      <div class="container">

        <div class="calendar-dates-wrap">

          <div class="calendar-dates-content">
            <span class="calendar-section-badge">
              <i class="bi bi-calendar-event-fill"></i>
              Important Dates
            </span>

            <h2>Key Academic Activities</h2>

            <p>
              Students should follow official college notices for exact dates related to
              admission, registration, examination, result and academic events.
            </p>

            <a href="{{ route('frontend.notices.index') }}" class="calendar-btn primary">
              <i class="bi bi-megaphone-fill"></i>
              View Notices
            </a>
          </div>

          <div class="calendar-dates-list">

            <div class="calendar-date-item">
              <span>01</span>
              <div>
                <h4>Admission & Registration</h4>
                <p>Admission dates, registration process and document verification schedule.</p>
              </div>
            </div>

            <div class="calendar-date-item">
              <span>02</span>
              <div>
                <h4>Teaching Schedule</h4>
                <p>Class commencement, departmental timetable and academic planning.</p>
              </div>
            </div>

            <div class="calendar-date-item">
              <span>03</span>
              <div>
                <h4>Internal Assessment</h4>
                <p>Class tests, assignments, seminars, practicals and internal examination.</p>
              </div>
            </div>

            <div class="calendar-date-item">
              <span>04</span>
              <div>
                <h4>University Examination</h4>
                <p>Examination form, admit card, exam timetable and result-related updates.</p>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section>
    <!-- IMPORTANT DATES END -->


    <!-- DOWNLOADS START -->
    <section class="calendar-download-section">
      <div class="container">

        <div class="calendar-section-title text-center">
          <span class="calendar-section-badge">
            <i class="bi bi-file-earmark-arrow-down-fill"></i>
            Downloads
          </span>

          <h2>Academic Calendar Downloads</h2>

          <p>
            Download academic calendar, holiday list, exam schedule and related documents.
          </p>
        </div>

        <div class="calendar-download-grid">

          <a href="Academic-Calendar.html" class="calendar-download-card">
            <i class="bi bi-file-earmark-pdf-fill"></i>
            <div>
              <h4>Academic Calendar PDF</h4>
              <p>Download official academic calendar document.</p>
            </div>
          </a>

          <a href="{{ route('frontend.notices.index') }}" class="calendar-download-card">
            <i class="bi bi-calendar-x-fill"></i>
            <div>
              <h4>Holiday List</h4>
              <p>View holidays and notified institutional closures.</p>
            </div>
          </a>

          <a href="examination.html" class="calendar-download-card">
            <i class="bi bi-pencil-square"></i>
            <div>
              <h4>Exam Schedule</h4>
              <p>Check examination related timetable and notices.</p>
            </div>
          </a>

          <a href="{{ route('frontend.notices.index') }}" class="calendar-download-card">
            <i class="bi bi-megaphone-fill"></i>
            <div>
              <h4>Latest Circulars</h4>
              <p>Access latest academic circulars and announcements.</p>
            </div>
          </a>

        </div>

      </div>
    </section>
    <!-- DOWNLOADS END -->


    <!-- CTA START -->
    <section class="calendar-cta-section">
      <div class="container">

        <div class="calendar-cta-wrap">
          <div>
            <span>Stay Updated</span>
            <h2>Check latest academic notices and calendar updates regularly.</h2>
          </div>

          <div class="calendar-cta-actions">
            <a href="{{ route('frontend.notices.index') }}" class="calendar-btn primary">
              <i class="bi bi-megaphone-fill"></i>
              Latest Notices
            </a>

            <a href="download.html" class="calendar-btn light">
              <i class="bi bi-download"></i>
              Downloads
            </a>
          </div>
        </div>

      </div>
    </section>
    <!-- CTA END -->

  </main>

  <!-- ================= ACADEMIC CALENDAR PAGE END ================= -->




@endsection