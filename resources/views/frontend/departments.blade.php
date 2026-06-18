<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Ganga Devi Mahila Mahavidyalaya | Official College Website</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<!-- TOP BAR START -->
<div class="topbar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span><i class="bi bi-geo-alt me-1"></i> Kankarbagh, Patna, Bihar</span>
                <span class="ms-3"><i class="bi bi-envelope me-1"></i> gangadevimahilacollege@gmail.com</span>
            </div>

            <div class="col-lg-6">
                <div class="top-links">
                    <a href="#"><i class="bi bi-file-earmark-text me-1"></i> RTI</a>
                    <a href="#"><i class="bi bi-shield-check me-1"></i> NAAC / IQAC</a>
                    <a href="#"><i class="bi bi-download me-1"></i> Admission</a>
                    <a href="#"><i class="bi bi-person-lock me-1"></i> Admin Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TOP BAR END -->




<!-- HEADER START -->
<header class="main-header">
  <nav class="navbar navbar-expand-lg">
    <div class="container">

      <a class="navbar-brand" href="#">
        <img src="assets/img/logo.png" alt="">
        <div class="brand-text">
          <h1>Ganga Devi Mahila Mahavidyalaya</h1>
          <span>Official College Website | gdmm.ac.in</span>
        </div>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto align-items-lg-center">

          <li class="nav-item">
            <a class="nav-link active" href="{{ route('frontend.index') }}">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="{{ route('frontend.about') }}" data-bs-toggle="dropdown">
              About Us
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('frontend.about') }}">College Profile</a></li>
              <li><a class="dropdown-item" href="{{ route('frontend.mission') }}">Vision & Mission</a></li>
              <li><a class="dropdown-item" href="{{ route('frontend.principal') }}">Principal's Message</a></li>
              <li><a class="dropdown-item" href="{{ route('frontend.college') }}">College at a Glance</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              Academics
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('frontend.courses') }}">Courses Offered</a></li>
              <li><a class="dropdown-item" href="{{ route('frontend.academic-calendar.index') }}">Academic Calendar</a></li>
              <li><a class="dropdown-item" href="{{ route('frontend.syllabus.index') }}">Syllabus</a></li>
              <li><a class="dropdown-item" href="{{ route('frontend.examination') }}">Examination</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('frontend.departments') }}">Departments</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('frontend.admissions.index') }}">Admissions</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('frontend.notices.index') }}">Notices</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('frontend.gallery') }}">Gallery</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              Students Corner
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="https://gdmm.tcspatna.in/" target="_blank" rel="noopener">Online-Admission</a></li>
              <li><a class="dropdown-item" href="https://gdmm.tcspatna.in/" target="_blank" rel="noopener">Online Fee</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('frontend.contact') }}">Contact</a>
          </li>

        </ul>
      </div>

    </div>
  </nav>
</header>
<!-- HEADER END -->
   



    
<!-- ================= DEPARTMENT-WISE SECTION START ================= -->

<section class="dept-wise-section">
  <div class="container">

    <div class="dept-wise-head text-center">
      <span class="dept-wise-badge">
        <i class="bi bi-diagram-3-fill"></i>
        Academic Departments
      </span>

      <h2>Department-wise Academic Information</h2>

      <p>
        Explore department-wise details, subject resources, syllabus, faculty guidance,
        academic notices and student support information.
      </p>
    </div>

    <div class="dept-wise-grid">
      @forelse($subjects as $subject)
        <a href="{{ route('frontend.departments.show', $subject->slug) }}" class="dept-wise-card">
          <div class="dept-wise-icon">
            <i class="bi bi-book-half"></i>
          </div>
          <h3>{{ $subject->name }}</h3>
          <p>{{ $subject->short_description ?: ($subject->department_name ?: 'Department academic information, syllabus and student resources.') }}</p>
          <span>View Department <i class="bi bi-arrow-right"></i></span>
        </a>
      @empty
        <div class="dept-wise-card">
          <div class="dept-wise-icon">
            <i class="bi bi-book-half"></i>
          </div>
          <h3>Departments will be updated soon.</h3>
          <p>Please check again for the latest department information.</p>
        </div>
      @endforelse
    </div>

  </div>
</section>

<!-- ================= DEPARTMENT-WISE SECTION END ================= -->

<!-- ================= FACULTY LIST SECTION START ================= -->

@if($facultyMembers->isNotEmpty())

    <section class="faculty-list-section">
        <div class="container">

            <div class="faculty-list-head text-center">
                <span class="faculty-list-badge">
                    <i class="bi bi-person-badge-fill"></i>
                    Faculty Members
                </span>

                <h2>
                    Department-wise Faculty List
                </h2>

                <p>
                    Meet the experienced faculty members of Ganga Devi Mahila Mahavidyalaya.
                </p>
            </div>

            <div class="faculty-list-grid">

                @foreach($facultyMembers as $facultyMember)

                    <div class="faculty-card">

                        <div class="faculty-photo">
                            <img
                                src="{{ $facultyMember->image ?: asset('assets/img/dep.jpeg') }}"
                                alt="{{ $facultyMember->name }}"
                            >
                        </div>

                        <div class="faculty-info">

                            <span class="faculty-dept">
                                {{ optional($facultyMember->subject)->department_name
                                    ?: optional($facultyMember->subject)->name
                                    ?: 'Faculty Member' }}
                            </span>

                            <h3>{{ $facultyMember->name }}</h3>

                            @if($facultyMember->designation)
                                <p>
                                    {{ $facultyMember->designation }}
                                </p>
                            @endif

                            <div class="faculty-meta">
                                @if($facultyMember->faculty_category)
                                    <span>
                                        <i class="bi bi-person-vcard"></i>
                                        {{ $facultyMember->faculty_category }}
                                    </span>
                                @endif

                                @if($facultyMember->email)
                                    <span>
                                        <i class="bi bi-envelope-fill"></i>
                                        {{ $facultyMember->email }}
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('frontend.faculty.show', $facultyMember->slug) }}"
                               class="faculty-link">

                                View Profile
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>

                @endforeach

            </div>

        </div>
    </section>

@endif

<!-- ================= FACULTY LIST SECTION END ================= -->



<!-- ================= ACTIVITIES SECTION START ================= -->

<section class="activities-section">
  <div class="container">

    <div class="activities-head text-center">
      <span class="activities-badge">
        <i class="bi bi-stars"></i>
        Student Activities
      </span>

      <h2>Academic & Co-curricular Activities</h2>

      <p>
        The college encourages students to participate in academic, cultural,
        social, awareness and personality development activities for overall growth.
      </p>
    </div>

    @php
      $activityIcons = [
        'Academic' => 'bi-easel2-fill',
        'Cultural' => 'bi-music-note-beamed',
        'Social' => 'bi-people-fill',
        'Sports' => 'bi-trophy-fill',
        'Empowerment' => 'bi-heart-fill',
        'Career' => 'bi-briefcase-fill',
        'NSS' => 'bi-people-fill',
        'NCC' => 'bi-shield-fill-check',
        'Awareness' => 'bi-megaphone-fill',
        'Workshop' => 'bi-tools',
        'Seminar' => 'bi-easel2-fill',
        'Administration' => 'bi-building-fill',
      ];
    @endphp

    <div class="activities-grid">

      @forelse($studentActivities as $studentActivity)

        <div class="activity-card {{ $studentActivity->is_featured ? 'featured' : '' }}">
          <div class="activity-image">
            <img
              src="{{ $studentActivity->image ?: asset('assets/img/activities.jpeg') }}"
              alt="{{ $studentActivity->title }}"
            >

            <span>{{ $studentActivity->category ?: 'Activity' }}</span>
          </div>

          <div class="activity-content">
            <div class="activity-icon">
              <i class="bi {{ $activityIcons[$studentActivity->category] ?? 'bi-stars' }}"></i>
            </div>

            <h3>{{ $studentActivity->title }}</h3>

            <p>
              {{ $studentActivity->short_description
                  ?: 'Activity details, highlights and student outcomes are available here.' }}
            </p>

            <a href="{{ route('frontend.activities.show', $studentActivity->slug) }}"
               class="activity-link">
              View Details <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

      @empty

        <div class="activity-card featured">
          <div class="activity-image">
            <img src="{{ asset('assets/img/activities.jpeg') }}" alt="Student Activities">
            <span>Activities</span>
          </div>

          <div class="activity-content">
            <div class="activity-icon">
              <i class="bi bi-stars"></i>
            </div>

            <h3>Activities will be updated soon</h3>

            <p>
              Academic and co-curricular activity information will appear here.
            </p>
          </div>
        </div>

      @endforelse

    </div>

  </div>
</section>

<!-- ================= ACTIVITIES SECTION END ================= -->




<!-- ================= NOTICES SECTION START ================= -->

<section class="notices-section">
  <div class="container">

    <div class="notices-head text-center">
      <span class="notices-badge">
        <i class="bi bi-megaphone-fill"></i>
        Latest Notices
      </span>

      <h2>Notices, Circulars & Announcements</h2>

      <p>
        Stay updated with admission notices, examination updates, academic circulars,
        student information and important college announcements.
      </p>
    </div>

    <div class="notices-filter-box">
      <a href="#" class="active">All Notices</a>
      <a href="{{ route('frontend.admissions.index') }}">Admission</a>
      <a href="{{ route('frontend.examination') }}">Examination</a>
      <a href="{{ route('frontend.academic-calendar.index') }}">Academic</a>
      <a href="#">Student</a>
      <a href="#">Tender</a>
    </div>

    <div class="notices-wrapper">

      <div class="notice-feature-card">
        <div class="notice-feature-icon">
          <i class="bi bi-pin-angle-fill"></i>
        </div>

        <span class="notice-label">Important Notice</span>

        <h3>Admission, Examination and Academic Updates</h3>

        <p>
          Students are advised to check the official notice section regularly for
          important college updates, examination schedules, admission information
          and academic announcements.
        </p>

        <a href="{{ route('frontend.notices.index') }}" class="notice-main-btn">
          View All Notices <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="notices-list">

        @forelse($frontendLatestNotices as $notice)
          @php
            $noticeDate = $notice->notice_date;
            $noticeUrl = $notice->download_url ?: route('frontend.notices.index');
            $categoryClass = \Illuminate\Support\Str::slug($notice->category ?: 'notice');
          @endphp

          <a href="{{ $noticeUrl }}"
             class="notice-item"
             @if($notice->download_url) target="_blank" rel="noopener" @endif>
            <div class="notice-date">
              <strong>{{ $noticeDate ? $noticeDate->format('d') : '--' }}</strong>
              <span>{{ $noticeDate ? $noticeDate->format('M') : 'New' }}</span>
            </div>

            <div class="notice-content">
              <div class="notice-top">
                <span class="notice-category {{ $categoryClass }}">{{ $notice->category ?: 'Notice' }}</span>
                <small>
                  @if($notice->document)
                    <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                  @elseif($notice->is_latest)
                    <i class="bi bi-clock-fill"></i> New
                  @else
                    <i class="bi bi-file-earmark-text-fill"></i> Notice
                  @endif
                </small>
              </div>

              <h4>{{ $notice->title }}</h4>

              <p>
                {{ $notice->short_description ?: 'Official college notice and circular information.' }}
              </p>
            </div>

            <div class="notice-arrow">
              <i class="bi bi-arrow-right"></i>
            </div>
          </a>
        @empty
          <a href="{{ route('frontend.notices.index') }}" class="notice-item">
            <div class="notice-date">
              <strong>--</strong>
              <span>New</span>
            </div>

            <div class="notice-content">
              <div class="notice-top">
                <span class="notice-category student">Notice</span>
                <small><i class="bi bi-info-circle-fill"></i> Info</small>
              </div>

              <h4>No notices published yet</h4>

              <p>
                Latest college notices and circulars will appear here after publication.
              </p>
            </div>

            <div class="notice-arrow">
              <i class="bi bi-arrow-right"></i>
            </div>
          </a>
        @endforelse

      </div>

    </div>

  </div>
</section>

<!-- ================= NOTICES SECTION END ================= -->




<!-- ================= RESOURCES / SYLLABUS SECTION START ================= -->

<section class="resources-syllabus-section">
  <div class="container">

    <div class="resources-head text-center">
      <span class="resources-badge">
        <i class="bi bi-journal-bookmark-fill"></i>
        Resources & Syllabus
      </span>

      <h2>Academic Resources & Syllabus Downloads</h2>

      <p>
        Access syllabus, study resources, academic documents, previous updates and
        department-wise learning support material in one place.
      </p>
    </div>

    <div class="resources-wrapper">

      <div class="resources-feature-card">
        <div class="resources-feature-icon">
          <i class="bi bi-file-earmark-text-fill"></i>
        </div>

        <span>Student Academic Support</span>

        <h3>Download verified syllabus and academic resources.</h3>

        <p>
          Students can use this section to access course-wise syllabus, academic calendar,
          examination resources, study documents and important department materials.
        </p>

        <a href="#" class="resources-main-btn">
          View All Downloads <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="resources-grid">

        <a href="#" class="resource-card">
          <div class="resource-icon">
            <i class="bi bi-journal-richtext"></i>
          </div>

          <div class="resource-content">
            <span class="resource-tag">Syllabus</span>
            <h3>Undergraduate Syllabus</h3>
            <p>
              Download UG syllabus for Arts, Science, Commerce and language subjects.
            </p>

            <div class="resource-meta">
              <span><i class="bi bi-file-earmark-pdf-fill"></i> PDF</span>
              <span><i class="bi bi-download"></i> Download</span>
            </div>
          </div>
        </a>

        <a href="#" class="resource-card">
          <div class="resource-icon">
            <i class="bi bi-mortarboard-fill"></i>
          </div>

          <div class="resource-content">
            <span class="resource-tag">PG</span>
            <h3>Postgraduate Syllabus</h3>
            <p>
              Access postgraduate syllabus and department-wise academic guidelines.
            </p>

            <div class="resource-meta">
              <span><i class="bi bi-file-earmark-pdf-fill"></i> PDF</span>
              <span><i class="bi bi-download"></i> Download</span>
            </div>
          </div>
        </a>

        <a href="#" class="resource-card">
          <div class="resource-icon">
            <i class="bi bi-calendar2-week-fill"></i>
          </div>

          <div class="resource-content">
            <span class="resource-tag">Calendar</span>
            <h3>Academic Calendar</h3>
            <p>
              View important academic dates, activities, holidays and exam timeline.
            </p>

            <div class="resource-meta">
              <span><i class="bi bi-calendar-check-fill"></i> Updated</span>
              <span><i class="bi bi-arrow-right"></i> View</span>
            </div>
          </div>
        </a>

        <a href="#" class="resource-card">
          <div class="resource-icon">
            <i class="bi bi-pencil-square"></i>
          </div>

          <div class="resource-content">
            <span class="resource-tag">Exam</span>
            <h3>Examination Resources</h3>
            <p>
              Check exam form notices, timetable, admit card and result-related documents.
            </p>

            <div class="resource-meta">
              <span><i class="bi bi-megaphone-fill"></i> Notice</span>
              <span><i class="bi bi-arrow-right"></i> View</span>
            </div>
          </div>
        </a>

        <a href="#" class="resource-card">
          <div class="resource-icon">
            <i class="bi bi-diagram-3-fill"></i>
          </div>

          <div class="resource-content">
            <span class="resource-tag">Department</span>
            <h3>Department Resources</h3>
            <p>
              Department-wise learning material, subject notices and student support files.
            </p>

            <div class="resource-meta">
              <span><i class="bi bi-folder-fill"></i> Files</span>
              <span><i class="bi bi-arrow-right"></i> Open</span>
            </div>
          </div>
        </a>

        <a href="#" class="resource-card">
          <div class="resource-icon">
            <i class="bi bi-file-earmark-arrow-down-fill"></i>
          </div>

          <div class="resource-content">
            <span class="resource-tag">Downloads</span>
            <h3>Forms & Documents</h3>
            <p>
              Download student forms, notices, certificates and important academic files.
            </p>

            <div class="resource-meta">
              <span><i class="bi bi-file-earmark-fill"></i> Docs</span>
              <span><i class="bi bi-download"></i> Download</span>
            </div>
          </div>
        </a>

      </div>

    </div>

  </div>
</section>

<!-- ================= RESOURCES / SYLLABUS SECTION END ================= -->






<footer class="footer">
    <div class="container">
      <div class="row g-4">
          <img src="assets/img/logo.png" alt="">
        <div class="col-lg-4">
          <h4>Ganga Devi Mahila Mahavidyalaya</h4>
          <p>
            Official college website for academic information, notices,
            admission updates, statutory disclosures and student support services.
          </p>
        </div>

        <div class="col-lg-2 col-md-4">
          <h4>Quick Links</h4>
          <div class="footer-links">
            <a href="#">Home</a>
            <a href="#">About College</a>
            <a href="#">Academics</a>
            <a href="#">Departments</a>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <h4>Students</h4>
          <div class="footer-links">
            <a href="#">Admissions</a>
            <a href="#">Notices</a>
            <a href="#">Downloads</a>
            <a href="#">Students Corner</a>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <h4>Disclosure</h4>
          <div class="footer-links">
            <a href="#">NAAC / IQAC</a>
            <a href="#">RTI</a>
            <a href="#">Statutory Disclosure</a>
            <a href="#">Policies</a>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <h4>Contact</h4>
          <div class="footer-links">
            <a href="#">Kankarbagh, Patna</a>
            <a href="#">Contact Office</a>
            <a href="#">Google Map</a>
            <a href="#">Admin Login</a>
          </div>
        </div>

      </div>

      <div class="footer-bottom">
        © 2026 Ganga Devi Mahila Mahavidyalaya. All Rights Reserved.
      </div>
    </div>
  </footer>
  <!-- FOOTER END -->

  <script src="assets/js/main.js"></script>


  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

 

</body>
</html>

