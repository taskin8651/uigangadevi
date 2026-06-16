@extends('frontend.master')
@section('title', 'Courses Offered - Ganga Devi Mahila Mahavidyalaya')
@section('content')





<!-- ================= COURSES OFFERED PAGE START ================= -->

<main class="courses-page">

  <!-- HERO START -->
  <section class="course-hero">
    <div class="course-hero-bg">
      <img src="assets/img/hero.png" alt="Courses Offered">
    </div>

    <div class="container">
      <div class="course-hero-content">
        <span class="course-badge">
          <i class="bi bi-journal-bookmark-fill"></i>
          Courses Offered
        </span>

        <h1>Academic Programmes Offered by the College</h1>

        <p>
          Explore undergraduate and postgraduate programmes, academic structure,
          subject groups and student-focused learning opportunities.
        </p>

        <div class="course-hero-actions">
          <a href="download.html" class="course-btn primary">
            <i class="bi bi-download"></i>
            Download Prospectus
          </a>

          <a href="admissions.html" class="course-btn light">
            <i class="bi bi-person-plus-fill"></i>
            Admission Updates
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- HERO END -->


  <!-- INTRO START -->
  <section class="course-intro-section">
    <div class="container">

      <div class="course-intro-grid">

        <div class="course-intro-card">
          <span class="course-section-badge">
            <i class="bi bi-mortarboard-fill"></i>
            Academic Programmes
          </span>

          <h2>Quality Higher Education for Women Students.</h2>

          <p>
            Ganga Devi Mahila Mahavidyalaya offers academic programmes designed to
            support higher education, knowledge development, discipline and career growth
            of women students.
          </p>

          <p>
            Students are advised to verify eligibility, admission rules, subject combinations,
            university guidelines and latest official notices before applying.
          </p>

          <div class="course-intro-points">
            <div>
              <i class="bi bi-check2-circle"></i>
              Undergraduate programmes
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              Postgraduate academic support
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              Subject-wise academic structure
            </div>

            <div>
              <i class="bi bi-check2-circle"></i>
              University guided curriculum
            </div>
          </div>
        </div>

        <div class="course-admission-card">
          <div class="course-admission-icon">
            <i class="bi bi-patch-check-fill"></i>
          </div>

          <h3>Admission Guidance</h3>

          <p>
            Admission to different courses is subject to university norms, eligibility
            criteria, seat availability and current admission notifications.
          </p>

          <a href="admissions.html" class="course-text-link">
            View Admission Details
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>

      </div>

    </div>
  </section>
  <!-- INTRO END -->


  <!-- PROGRAMMES START -->
  <section class="course-programmes-section">
    <div class="container">

      <div class="course-section-title text-center">
        <span class="course-section-badge">
          <i class="bi bi-book-half"></i>
          Programmes
        </span>

        <h2>Courses Offered</h2>

        <p>
          A structured view of academic programmes available for students.
        </p>
      </div>

      <div class="course-programmes-grid">
        @forelse($courses as $course)
          <div class="course-card">
            <div class="course-card-icon">
              <i class="bi bi-journal-richtext"></i>
            </div>

            <span class="course-level">{{ $course->level ?: 'Academic Programme' }}</span>
            <h3>{{ $course->name }}</h3>
            <p>{{ $course->short_description ?: 'Programme details are available as per the approved academic structure and university guidelines.' }}</p>

            <ul>
              @forelse(collect($course->highlights)->where('status', 1)->take(3) as $highlight)
                <li><i class="bi bi-check-circle"></i> {{ $highlight['text'] }}</li>
              @empty
                @foreach($course->subjects->take(3) as $subject)
                  <li><i class="bi bi-check-circle"></i> {{ $subject->name }}</li>
                @endforeach
              @endforelse
            </ul>

            <a href="{{ route('frontend.departments') }}" class="course-card-link">
              View Departments <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        @empty
          <div class="course-card">
            <h3>Courses will be updated soon.</h3>
            <p>Please check again for the latest academic programme information.</p>
          </div>
        @endforelse
      </div>

    </div>
  </section>
  <!-- PROGRAMMES END -->


  <!-- SUBJECT GROUPS START -->
  <section class="course-subject-section">
    <div class="container">

      <div class="course-section-title text-center">
        <span class="course-section-badge">
          <i class="bi bi-diagram-3-fill"></i>
          Subject Areas
        </span>

        <h2>Academic Subject Areas</h2>

        <p>
          Subject availability and combinations should be confirmed from the latest
          college admission notice and university guidelines.
        </p>
      </div>

      <div class="course-subject-grid">
        @forelse($subjects as $subject)
          <a href="{{ route('frontend.departments.show', $subject->slug) }}" class="course-subject-card">
            <i class="bi bi-book-half"></i>
            <h4>{{ $subject->name }}</h4>
            <p>{{ $subject->short_description ?: ($subject->department_name ?: 'Academic subject information and learning resources.') }}</p>
          </a>
        @empty
          <div class="course-subject-card">
            <i class="bi bi-book-half"></i>
            <h4>Subjects will be updated soon.</h4>
          </div>
        @endforelse
      </div>

    </div>
  </section>
  <!-- SUBJECT GROUPS END -->


  <!-- ELIGIBILITY START -->
  <section class="course-eligibility-section">
    <div class="container">

      <div class="course-eligibility-wrap">

        <div class="course-eligibility-content">
          <span class="course-section-badge">
            <i class="bi bi-person-check-fill"></i>
            Eligibility
          </span>

          <h2>Admission Eligibility and Important Instructions</h2>

          <p>
            Eligibility, selection process, required documents, reservation rules and
            admission procedure must follow current university and government guidelines.
          </p>

          <a href="admissions.html" class="course-btn primary">
            <i class="bi bi-file-earmark-text-fill"></i>
            Admission Guidelines
          </a>
        </div>

        <div class="course-eligibility-list">

          <div class="course-eligibility-item">
            <span>01</span>
            <div>
              <h4>Academic Qualification</h4>
              <p>Students must fulfill the minimum qualification required for the selected programme.</p>
            </div>
          </div>

          <div class="course-eligibility-item">
            <span>02</span>
            <div>
              <h4>Document Verification</h4>
              <p>Original certificates, mark sheets and category documents may be required during admission.</p>
            </div>
          </div>

          <div class="course-eligibility-item">
            <span>03</span>
            <div>
              <h4>University Rules</h4>
              <p>Admission and examination process will follow the applicable university rules.</p>
            </div>
          </div>

          <div class="course-eligibility-item">
            <span>04</span>
            <div>
              <h4>Latest Notice</h4>
              <p>Students should check the latest official notice before applying for any course.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>
  <!-- ELIGIBILITY END -->


  <!-- PROCESS START -->
  <section class="course-process-section">
    <div class="container">

      <div class="course-section-title text-center">
        <span class="course-section-badge">
          <i class="bi bi-list-check"></i>
          Admission Process
        </span>

        <h2>Simple Academic Admission Flow</h2>

        <p>
          Follow official instructions and complete every step as per the admission notice.
        </p>
      </div>

      <div class="course-process-grid">

        <div class="course-process-card">
          <span>01</span>
          <h4>Check Notice</h4>
          <p>Read latest admission notice, eligibility and important dates.</p>
        </div>

        <div class="course-process-card">
          <span>02</span>
          <h4>Select Course</h4>
          <p>Choose programme and subject group based on eligibility and availability.</p>
        </div>

        <div class="course-process-card">
          <span>03</span>
          <h4>Submit Form</h4>
          <p>Fill application form and submit required academic documents.</p>
        </div>

        <div class="course-process-card">
          <span>04</span>
          <h4>Admission Confirmation</h4>
          <p>Complete verification and fee process as per college instructions.</p>
        </div>

      </div>

    </div>
  </section>
  <!-- PROCESS END -->


  <!-- DOWNLOAD CTA START -->
  <section class="course-cta-section">
    <div class="container">

      <div class="course-cta-wrap">
        <div>
          <span>Academic Information</span>
          <h2>Download prospectus, check admission notices and verify course details.</h2>
        </div>

        <div class="course-cta-actions">
          <a href="download.html" class="course-btn primary">
            <i class="bi bi-download"></i>
            Prospectus
          </a>

          <a href="contact.html" class="course-btn light">
            <i class="bi bi-telephone-fill"></i>
            Contact Office
          </a>
        </div>
      </div>

    </div>
  </section>
  <!-- DOWNLOAD CTA END -->

</main>

<!-- ================= COURSES OFFERED PAGE END ================= -->



@endsection
