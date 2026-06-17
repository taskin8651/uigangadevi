@extends('frontend.master')
@section('title', 'Examination Updates, Notices and Student Guidelines')
@section('content')

    




<!-- ================= EXAMINATION PAGE START ================= -->

<main class="examination-page">

  <!-- HERO START -->
  <section class="exam-hero">
    <div class="exam-hero-bg">
      <img src="assets/img/hero.png" alt="Examination">
    </div>

    <div class="container">
      <div class="exam-hero-content">
        <span class="exam-badge">
          <i class="bi bi-pencil-square"></i>
          Examination
        </span>

        <h1>Examination Updates, Notices and Student Guidelines</h1>

        <p>
          Access examination schedules, form fill-up updates, admit card information,
          result notices, practical examination details and important student instructions.
        </p>

        <div class="exam-hero-actions">
          <a href="notices.html" class="exam-btn primary">
            <i class="bi bi-megaphone-fill"></i>
            Latest Exam Notices
          </a>

          <a href="download.html" class="exam-btn light">
            <i class="bi bi-download"></i>
            Download Schedule
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- HERO END -->


  <!-- INTRO START -->
  <section class="exam-intro-section">
    <div class="container">

      <div class="exam-intro-grid">

        <div class="exam-intro-card">
          <span class="exam-section-badge">
            <i class="bi bi-journal-check"></i>
            Examination Cell
          </span>

          <h2>Transparent Examination Information for Students.</h2>

          <p>
            The examination section provides important updates related to university
            examinations, internal assessments, practical examinations, form submission,
            admit card, result and other academic evaluation activities.
          </p>

          <p>
            Students are advised to regularly check official notices and follow college
            and university instructions for examination-related processes.
          </p>

          <div class="exam-points-grid">
            <div>
              <i class="bi bi-check2-circle"></i>
              Exam form fill-up updates
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              Admit card information
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              Practical / internal exam notices
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              Result and verification updates
            </div>
          </div>
        </div>

        <div class="exam-alert-card">
          <div class="exam-alert-icon">
            <i class="bi bi-bell-fill"></i>
          </div>

          <h3>Important Notice</h3>

          <p>
            Examination dates, forms, admit cards and result notices are subject to
            university notifications. Students must verify the latest updates.
          </p>

          <a href="notices.html" class="exam-text-link">
            View Latest Circular
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>

      </div>

    </div>
  </section>
  <!-- INTRO END -->


  <!-- QUICK STATS START -->
  <section class="exam-stats-section">
    <div class="container">

      <div class="exam-section-title text-center">
        <span class="exam-section-badge">
          <i class="bi bi-bar-chart-fill"></i>
          Exam Support
        </span>

        <h2>Examination Resource Highlights</h2>

        <p>
          Important examination-related resources for students and departments.
        </p>
      </div>

      <div class="exam-stats-grid">

        <div class="exam-stat-card">
          <div class="exam-stat-icon">
            <i class="bi bi-file-earmark-text-fill"></i>
          </div>
          <h3>Forms</h3>
          <p>Exam Form Updates</p>
        </div>

        <div class="exam-stat-card">
          <div class="exam-stat-icon">
            <i class="bi bi-person-vcard-fill"></i>
          </div>
          <h3>Admit</h3>
          <p>Card Information</p>
        </div>

        <div class="exam-stat-card">
          <div class="exam-stat-icon">
            <i class="bi bi-calendar-event-fill"></i>
          </div>
          <h3>Schedule</h3>
          <p>Exam Timetable</p>
        </div>

        <div class="exam-stat-card">
          <div class="exam-stat-icon">
            <i class="bi bi-award-fill"></i>
          </div>
          <h3>Result</h3>
          <p>Result Updates</p>
        </div>

      </div>

    </div>
  </section>
  <!-- QUICK STATS END -->


  <!-- EXAM SERVICES START -->
  <section class="exam-services-section">
    <div class="container">

      <div class="exam-section-title text-center">
        <span class="exam-section-badge">
          <i class="bi bi-grid-fill"></i>
          Examination Services
        </span>

        <h2>Important Examination Sections</h2>

        <p>
          Quick access to major examination activities and official resources.
        </p>
      </div>

      <div class="exam-services-grid">

        <div class="exam-service-card">
          <div class="exam-service-icon">
            <i class="bi bi-file-earmark-plus-fill"></i>
          </div>

          <span>Student Process</span>
          <h3>Exam Form Fill-up</h3>
          <p>
            Information related to examination form submission, fee payment,
            correction window and required documents.
          </p>

          <a href="notices.html" class="exam-card-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>

        <div class="exam-service-card">
          <div class="exam-service-icon">
            <i class="bi bi-person-vcard"></i>
          </div>

          <span>Student Access</span>
          <h3>Admit Card</h3>
          <p>
            Updates regarding admit card availability, download process,
            verification and examination centre instructions.
          </p>

          <a href="notices.html" class="exam-card-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>

        <div class="exam-service-card">
          <div class="exam-service-icon">
            <i class="bi bi-calendar2-week-fill"></i>
          </div>

          <span>Timetable</span>
          <h3>Exam Schedule</h3>
          <p>
            University examination timetable, internal assessment dates,
            practical schedule and important deadlines.
          </p>

          <a href="notices.html" class="exam-card-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>

        <div class="exam-service-card">
          <div class="exam-service-icon">
            <i class="bi bi-clipboard2-check-fill"></i>
          </div>

          <span>Result</span>
          <h3>Result & Verification</h3>
          <p>
            Result publication updates, marksheet verification, correction process
            and related student guidance.
          </p>

          <a href="notices.html" class="exam-card-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>

      </div>

    </div>
  </section>
  <!-- EXAM SERVICES END -->


  <!-- EXAM TIMELINE START -->
  <section class="exam-timeline-section">
    <div class="container">

      <div class="exam-section-title text-center">
        <span class="exam-section-badge">
          <i class="bi bi-list-check"></i>
          Exam Process
        </span>

        <h2>Student Examination Flow</h2>

        <p>
          Follow every step carefully as per college and university instructions.
        </p>
      </div>

      <div class="exam-timeline-grid">

        <div class="exam-timeline-card">
          <span>01</span>
          <h4>Check Notice</h4>
          <p>Read latest examination notice, form dates and university guidelines.</p>
        </div>

        <div class="exam-timeline-card">
          <span>02</span>
          <h4>Fill Exam Form</h4>
          <p>Complete form submission and fee payment within the notified deadline.</p>
        </div>

        <div class="exam-timeline-card">
          <span>03</span>
          <h4>Download Admit Card</h4>
          <p>Collect or download admit card and verify details before examination.</p>
        </div>

        <div class="exam-timeline-card">
          <span>04</span>
          <h4>Appear in Exam</h4>
          <p>Follow timetable, exam centre rules and required student instructions.</p>
        </div>

      </div>

    </div>
  </section>
  <!-- EXAM TIMELINE END -->


  <!-- GUIDELINES START -->
  <section class="exam-guideline-section">
    <div class="container">

      <div class="exam-guideline-wrap">

        <div class="exam-guideline-content">
          <span class="exam-section-badge">
            <i class="bi bi-shield-check"></i>
            Student Guidelines
          </span>

          <h2>Important Examination Instructions</h2>

          <p>
            Students must follow official examination rules, carry required documents,
            reach examination centre on time and verify all details printed on admit card.
          </p>

          <a href="examination.html" class="exam-btn primary">
            <i class="bi bi-file-earmark-text-fill"></i>
            Read Exam Guidelines
          </a>
        </div>

        <div class="exam-guideline-list">

          <div class="exam-guideline-item">
            <span>01</span>
            <div>
              <h4>Carry Admit Card</h4>
              <p>Admit card and valid college identity proof may be required during examination.</p>
            </div>
          </div>

          <div class="exam-guideline-item">
            <span>02</span>
            <div>
              <h4>Check Reporting Time</h4>
              <p>Students should reach the examination centre before the reporting time.</p>
            </div>
          </div>

          <div class="exam-guideline-item">
            <span>03</span>
            <div>
              <h4>Follow Exam Rules</h4>
              <p>Use of unfair means, prohibited items and rule violation may lead to action.</p>
            </div>
          </div>

          <div class="exam-guideline-item">
            <span>04</span>
            <div>
              <h4>Verify Details</h4>
              <p>Check subject, roll number, exam date and centre details carefully.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>
  <!-- GUIDELINES END -->


  <!-- DOWNLOADS START -->
  <section class="exam-download-section">
    <div class="container">

      <div class="exam-section-title text-center">
        <span class="exam-section-badge">
          <i class="bi bi-download"></i>
          Downloads
        </span>

        <h2>Examination Downloads</h2>

        <p>
          Download important exam-related forms, notices and academic documents.
        </p>
      </div>

      <div class="exam-download-grid">

        <a href="notices.html" class="exam-download-card">
          <i class="bi bi-file-earmark-pdf-fill"></i>
          <div>
            <h4>Exam Schedule</h4>
            <p>Download examination timetable and related updates.</p>
          </div>
        </a>

        <a href="notices.html" class="exam-download-card">
          <i class="bi bi-file-earmark-text-fill"></i>
          <div>
            <h4>Exam Form Notice</h4>
            <p>Download examination form fill-up notification.</p>
          </div>
        </a>

        <a href="notices.html" class="exam-download-card">
          <i class="bi bi-person-vcard-fill"></i>
          <div>
            <h4>Admit Card Notice</h4>
            <p>View admit card related instructions and availability.</p>
          </div>
        </a>

        <a href="notices.html" class="exam-download-card">
          <i class="bi bi-award-fill"></i>
          <div>
            <h4>Result Notice</h4>
            <p>Check result publication and verification updates.</p>
          </div>
        </a>

      </div>

    </div>
  </section>
  <!-- DOWNLOADS END -->


  <!-- QUICK LINKS START -->
  <section class="exam-links-section">
    <div class="container">

      <div class="exam-section-title text-center">
        <span class="exam-section-badge">
          <i class="bi bi-link-45deg"></i>
          Quick Access
        </span>

        <h2>Examination Related Links</h2>

        <p>
          Important links for students to access academic and examination resources.
        </p>
      </div>

      <div class="exam-links-grid">

        <a href="notices.html" class="exam-link-card">
          <i class="bi bi-megaphone-fill"></i>
          <span>Latest Notices</span>
        </a>

        <a href="Academic-Calendar.html" class="exam-link-card">
          <i class="bi bi-calendar2-week-fill"></i>
          <span>Academic Calendar</span>
        </a>

        <a href="syllabus.html" class="exam-link-card">
          <i class="bi bi-file-earmark-text-fill"></i>
          <span>Syllabus</span>
        </a>

        <a href="download.html" class="exam-link-card">
          <i class="bi bi-download"></i>
          <span>Downloads</span>
        </a>

        <a href="students-corner.html" class="exam-link-card">
          <i class="bi bi-person-lines-fill"></i>
          <span>Student Corner</span>
        </a>

        <a href="contact.html" class="exam-link-card">
          <i class="bi bi-telephone-fill"></i>
          <span>Contact Office</span>
        </a>

      </div>

    </div>
  </section>
  <!-- QUICK LINKS END -->


  <!-- CTA START -->
  <section class="exam-cta-section">
    <div class="container">

      <div class="exam-cta-wrap">
        <div>
          <span>Examination Updates</span>
          <h2>Check latest exam notices, timetable, admit card and result updates regularly.</h2>
        </div>

        <div class="exam-cta-actions">
          <a href="notices.html" class="exam-btn primary">
            <i class="bi bi-megaphone-fill"></i>
            Exam Notices
          </a>

          <a href="download.html" class="exam-btn light">
            <i class="bi bi-download"></i>
            Downloads
          </a>
        </div>
      </div>

    </div>
  </section>
  <!-- CTA END -->

</main>

<!-- ================= EXAMINATION PAGE END ================= -->




@endsection