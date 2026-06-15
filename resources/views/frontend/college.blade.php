@extends('frontend.master')
@section('title', 'College at a Glance')
@section('content')



<!-- ================= COLLEGE AT A GLANCE PAGE START ================= -->

<main class="college-glance-page">

  <!-- HERO START -->
  <section class="cg-hero">
    <div class="cg-hero-bg">
      <!-- <img src="assets/img/hero.png" alt="College Campus"> -->
    </div>

    <div class="container">
      <div class="cg-hero-content">
        <span class="cg-badge">
          <i class="bi bi-grid-1x2-fill"></i>
          College at a Glance
        </span>

        <h1>Ganga Devi Mahila Mahavidyalaya at a Glance</h1>

        <p>
          A quick overview of college identity, academic structure, institutional highlights,
          facilities, student support and quality initiatives.
        </p>

        <div class="cg-hero-actions">
          <a href="download.html" class="cg-btn primary">
            <i class="bi bi-download"></i>
            Download Prospectus
          </a>

          <a href="notices.html" class="cg-btn light">
            <i class="bi bi-megaphone-fill"></i>
            Latest Notices
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- HERO END -->


  <!-- OVERVIEW START -->
  <section class="cg-overview-section">
    <div class="container">

      <div class="cg-overview-grid">

        <div class="cg-overview-card">
          <div class="cg-logo-box">
            <img src="assets/img/logo.png" alt="Logo">
          </div>

          <div class="cg-overview-content">
            <span class="cg-section-badge">
              <i class="bi bi-building-fill"></i>
              Institutional Overview
            </span>

            <h2>NAAC Accredited Women’s College in Kankarbagh, Patna.</h2>

            <p>
              Ganga Devi Mahila Mahavidyalaya is committed to providing quality higher
              education with discipline, values, transparency and student-focused academic support.
            </p>

            <div class="cg-info-grid">
              <div class="cg-info-item">
                <span>College Name</span>
                <strong>Ganga Devi Mahila Mahavidyalaya</strong>
              </div>

              <div class="cg-info-item">
                <span>Location</span>
                <strong>Kankarbagh, Patna, Bihar</strong>
              </div>

              <div class="cg-info-item">
                <span>Institution Type</span>
                <strong>Women’s College</strong>
              </div>

              <div class="cg-info-item">
                <span>Academic Level</span>
                <strong>UG / PG Programmes</strong>
              </div>
            </div>
          </div>
        </div>

        <div class="cg-feature-card">
          <div class="cg-feature-icon">
            <i class="bi bi-award-fill"></i>
          </div>

          <h3>Committed to Academic Excellence</h3>

          <p>
            The college provides a structured academic environment with departments,
            syllabus, examination updates, notices and student support resources.
          </p>

          <a href="Academic-Calendar.html" class="cg-text-link">
            Explore Academics
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>

      </div>

    </div>
  </section>
  <!-- OVERVIEW END -->


  <!-- STATS START -->
  <section class="cg-stats-section">
    <div class="container">

      <div class="cg-section-title text-center">
        <span class="cg-section-badge">
          <i class="bi bi-bar-chart-fill"></i>
          Key Highlights
        </span>

        <h2>Important Facts & Figures</h2>

        <p>
          Quick institutional information for students, parents, stakeholders and visitors.
        </p>
      </div>

      <div class="cg-stats-grid">

        <div class="cg-stat-card">
          <div class="cg-stat-icon">
            <i class="bi bi-calendar-check-fill"></i>
          </div>
          <h3>1971</h3>
          <p>Established</p>
        </div>

        <div class="cg-stat-card">
          <div class="cg-stat-icon">
            <i class="bi bi-diagram-3-fill"></i>
          </div>
          <h3>19</h3>
          <p>Departments</p>
        </div>

        <div class="cg-stat-card">
          <div class="cg-stat-icon">
            <i class="bi bi-patch-check-fill"></i>
          </div>
          <h3>B</h3>
          <p>NAAC Grade</p>
        </div>

        <div class="cg-stat-card">
          <div class="cg-stat-icon">
            <i class="bi bi-mortarboard-fill"></i>
          </div>
          <h3>UG / PG</h3>
          <p>Programmes</p>
        </div>

      </div>

    </div>
  </section>
  <!-- STATS END -->


  <!-- ABOUT GLANCE START -->
  @if($collegeProfile)

    @php
        $activeAboutPoints = collect(
            $collegeProfile->about_points ?? []
        )->filter(function ($point) {
            return !empty($point['text'])
                && !empty($point['status']);
        });

        $collegeImage = $collegeProfile->profile_image;
    @endphp

    <section class="cg-about-section">
        <div class="container">

            <div class="cg-about-grid">

                {{-- ABOUT CONTENT --}}
                <div class="cg-about-content">

                    @if($collegeProfile->about_badge)
                        <span class="cg-section-badge">
                            {{-- Static icon --}}
                            <i class="bi bi-info-circle-fill"></i>

                            {{ $collegeProfile->about_badge }}
                        </span>
                    @endif

                    @if($collegeProfile->about_title)
                        <h2>
                            {{ $collegeProfile->about_title }}
                        </h2>
                    @endif

                    @if($collegeProfile->about_description_one)
                        <p>
                            {{ $collegeProfile->about_description_one }}
                        </p>
                    @endif

                    @if($collegeProfile->about_description_two)
                        <p>
                            {{ $collegeProfile->about_description_two }}
                        </p>
                    @endif

                    @if($activeAboutPoints->isNotEmpty())
                        <div class="cg-points-grid">

                            @foreach($activeAboutPoints as $point)
                                <div>
                                    {{-- Static icon --}}
                                    <i class="bi bi-check2-circle"></i>

                                    {{ $point['text'] }}
                                </div>
                            @endforeach

                        </div>
                    @endif

                </div>

                {{-- COLLEGE IMAGE --}}
                <div class="cg-about-image">

                    <img
                        src="{{ $collegeImage
                            ? $collegeImage['url']
                            : asset('assets/img/college-profile.jpeg') }}"
                        alt="{{ $collegeProfile->about_title ?: 'College Profile' }}"
                    >

                    @if(
                        $collegeProfile->image_badge_title ||
                        $collegeProfile->image_badge_subtitle
                    )
                        <div class="cg-image-caption">

                            @if($collegeProfile->image_badge_title)
                                <strong>
                                    {{ $collegeProfile->image_badge_title }}
                                </strong>
                            @endif

                            @if($collegeProfile->image_badge_subtitle)
                                <span>
                                    {{ $collegeProfile->image_badge_subtitle }}
                                </span>
                            @endif

                        </div>
                    @endif

                </div>

            </div>

        </div>
    </section>

@endif
  <!-- ABOUT GLANCE END -->


  <!-- ACADEMIC STRUCTURE START -->
  <section class="cg-academic-section">
    <div class="container">

      <div class="cg-section-title text-center">
        <span class="cg-section-badge">
          <i class="bi bi-journal-bookmark-fill"></i>
          Academic Structure
        </span>

        <h2>Academics, Departments and Student Resources</h2>

        <p>
          A quick view of important academic areas available through the official website.
        </p>
      </div>

      <div class="cg-academic-grid">

        <div class="cg-academic-card">
          <i class="bi bi-journal-text"></i>
          <h4>Courses Offered</h4>
          <p>Information about undergraduate and postgraduate academic programmes.</p>
        </div>

        <div class="cg-academic-card">
          <i class="bi bi-diagram-3"></i>
          <h4>Departments</h4>
          <p>Department-wise academic information, faculty and subject details.</p>
        </div>

        <div class="cg-academic-card">
          <i class="bi bi-calendar2-week"></i>
          <h4>Academic Calendar</h4>
          <p>Academic schedule, institutional activities and important dates.</p>
        </div>

        <div class="cg-academic-card">
          <i class="bi bi-file-earmark-text"></i>
          <h4>Syllabus</h4>
          <p>Access syllabus and academic resources in a structured format.</p>
        </div>

        <div class="cg-academic-card">
          <i class="bi bi-pencil-square"></i>
          <h4>Examination</h4>
          <p>Exam notices, schedules, updates and related academic information.</p>
        </div>

        <div class="cg-academic-card">
          <i class="bi bi-person-lines-fill"></i>
          <h4>Student Corner</h4>
          <p>Useful student information, support resources and important links.</p>
        </div>

      </div>

    </div>
  </section>
  <!-- ACADEMIC STRUCTURE END -->


  <!-- FACILITIES START -->
  <section class="cg-facilities-section">
    <div class="container">

      <div class="cg-section-title text-center">
        <span class="cg-section-badge">
          <i class="bi bi-buildings-fill"></i>
          Campus Facilities
        </span>

        <h2>Facilities and Support System</h2>

        <p>
          Essential academic and institutional facilities for a better learning experience.
        </p>
      </div>

      <div class="cg-facilities-grid">

        <div class="cg-facility-card">
          <i class="bi bi-book-half"></i>
          <span>Library</span>
        </div>

        <div class="cg-facility-card">
          <i class="bi bi-pc-display-horizontal"></i>
          <span>Computer Lab</span>
        </div>

        <div class="cg-facility-card">
          <i class="bi bi-building"></i>
          <span>Classrooms</span>
        </div>

        <div class="cg-facility-card">
          <i class="bi bi-shield-check"></i>
          <span>Safe Campus</span>
        </div>

        <div class="cg-facility-card">
          <i class="bi bi-megaphone-fill"></i>
          <span>Notices</span>
        </div>

        <div class="cg-facility-card">
          <i class="bi bi-images"></i>
          <span>Activities</span>
        </div>

      </div>

    </div>
  </section>
  <!-- FACILITIES END -->


  <!-- QUALITY START -->
  <section class="cg-quality-section">
    <div class="container">

      <div class="cg-quality-wrap">

        <div class="cg-quality-content">
          <span class="cg-section-badge">
            <i class="bi bi-patch-check-fill"></i>
            Quality & Transparency
          </span>

          <h2>Verified Information, Public Documents and Quality Assurance.</h2>

          <p>
            The official website provides access to important documents, notices, admission
            updates, NAAC / IQAC information, RTI related resources and institutional disclosures.
          </p>

          <a href="download.html" class="cg-btn primary">
            <i class="bi bi-folder-fill"></i>
            View Downloads
          </a>
        </div>

        <div class="cg-quality-list">

          <div class="cg-quality-item">
            <span>01</span>
            <div>
              <h4>NAAC / IQAC</h4>
              <p>Quality assurance reports, documents and institutional updates.</p>
            </div>
          </div>

          <div class="cg-quality-item">
            <span>02</span>
            <div>
              <h4>RTI & Disclosure</h4>
              <p>Public information, policies and statutory disclosure resources.</p>
            </div>
          </div>

          <div class="cg-quality-item">
            <span>03</span>
            <div>
              <h4>Notices & Circulars</h4>
              <p>Official notices, academic announcements and examination updates.</p>
            </div>
          </div>

          <div class="cg-quality-item">
            <span>04</span>
            <div>
              <h4>Downloads</h4>
              <p>Prospectus, forms, documents and important public files.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>
  <!-- QUALITY END -->


  <!-- QUICK LINKS START -->
  <section class="cg-links-section">
    <div class="container">

      <div class="cg-section-title text-center">
        <span class="cg-section-badge">
          <i class="bi bi-link-45deg"></i>
          Quick Access
        </span>

        <h2>Important Links</h2>

        <p>
          Quick access to frequently used sections of the official college website.
        </p>
      </div>

      <div class="cg-links-grid">

        <a href="notices.html" class="cg-link-card">
          <i class="bi bi-megaphone-fill"></i>
          <span>Latest Notices</span>
        </a>

        <a href="admissions.html" class="cg-link-card">
          <i class="bi bi-person-plus-fill"></i>
          <span>Admission Updates</span>
        </a>

        <a href="Academic-Calendar.html" class="cg-link-card">
          <i class="bi bi-calendar-event-fill"></i>
          <span>Academic Calendar</span>
        </a>

        <a href="download.html" class="cg-link-card">
          <i class="bi bi-file-earmark-arrow-down-fill"></i>
          <span>Downloads</span>
        </a>

        <a href="naac.html" class="cg-link-card">
          <i class="bi bi-award-fill"></i>
          <span>NAAC / IQAC</span>
        </a>

        <a href="contact.html" class="cg-link-card">
          <i class="bi bi-telephone-fill"></i>
          <span>Contact College</span>
        </a>

      </div>

    </div>
  </section>
  <!-- QUICK LINKS END -->


  <!-- CTA START -->
  <section class="cg-cta-section">
    <div class="container">
      <div class="cg-cta-wrap">
        <div>
          <span>Official College Website</span>
          <h2>Access notices, academics, admissions, downloads and student support resources.</h2>
        </div>

        <div class="cg-cta-actions">
          <a href="notices.html" class="cg-btn primary">
            <i class="bi bi-megaphone-fill"></i>
            Latest Notices
          </a>

          <a href="contact.html" class="cg-btn light">
            <i class="bi bi-telephone-fill"></i>
            Contact College
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- CTA END -->

</main>

<!-- ================= COLLEGE AT A GLANCE PAGE END ================= -->







@endsection