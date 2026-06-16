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
                    <a href="rti.html"><i class="bi bi-file-earmark-text me-1"></i> RTI</a>
                    <a href="naac.html"><i class="bi bi-shield-check me-1"></i> NAAC / IQAC</a>
                    <a href="download.html"><i class="bi bi-download me-1"></i> Admission</a>
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
            <a class="nav-link active" href="index.html">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="about.html" data-bs-toggle="dropdown">
              About Us
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="about.html">College Profile</a></li>
              <li><a class="dropdown-item" href="mission.html">Vision & Mission</a></li>
              <li><a class="dropdown-item" href="principal.html">Principal's Message</a></li>
              <li><a class="dropdown-item" href="college.html">College at a Glance</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              Academics
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="courses.html">Courses Offered</a></li>
              <li><a class="dropdown-item" href="Academic-Calendar.html">Academic Calendar</a></li>
              <li><a class="dropdown-item" href="syllabus.html">Syllabus</a></li>
              <li><a class="dropdown-item" href="examination.html">Examination</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/">Departments</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="admissions.html">Admissions</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="notices.html">Notices</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="students-corner.html" data-bs-toggle="dropdown">
              Students Corner
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="online-admission.html">Online-Admission</a></li>
              <li><a class="dropdown-item" href="online-fee.html">Online Fee</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
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

    <div class="activities-grid">

      <div class="activity-card featured">
        <div class="activity-image">
          <img src="assets/img/activities.jpeg" alt="Seminar and Workshop">
          <span>Academic</span>
        </div>

        <div class="activity-content">
          <div class="activity-icon">
            <i class="bi bi-easel2-fill"></i>
          </div>

          <h3>Seminars & Workshops</h3>

          <p>
            Department-wise seminars, lectures and workshops help students improve
            subject knowledge, presentation skills and academic confidence.
          </p>

          <a href="gallery.html" class="activity-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="activity-card">
        <div class="activity-image">
          <img src="assets/img/activities-1.jpeg" alt="Cultural Activities">
          <span>Cultural</span>
        </div>

        <div class="activity-content">
          <div class="activity-icon">
            <i class="bi bi-music-note-beamed"></i>
          </div>

          <h3>Cultural Programmes</h3>

          <p>
            Cultural activities promote creativity, confidence, teamwork and active
            participation among students.
          </p>

          <a href="gallery.html" class="activity-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="activity-card">
        <div class="activity-image">
          <img src="assets/img/activities-2.jpeg" alt="NSS Activities">
          <span>Social</span>
        </div>

        <div class="activity-content">
          <div class="activity-icon">
            <i class="bi bi-people-fill"></i>
          </div>

          <h3>NSS & Social Awareness</h3>

          <p>
            Social awareness drives and community activities develop responsibility,
            leadership and service values.
          </p>

          <a href="gallery.html" class="activity-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="activity-card">
        <div class="activity-image">
          <img src="assets/img/activities-3.jpeg" alt="Sports Activities">
          <span>Sports</span>
        </div>

        <div class="activity-content">
          <div class="activity-icon">
            <i class="bi bi-trophy-fill"></i>
          </div>

          <h3>Sports Activities</h3>

          <p>
            Sports activities support physical fitness, discipline, team spirit and
            healthy competition among students.
          </p>

          <a href="gallery.html" class="activity-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="activity-card">
        <div class="activity-image">
          <img src="assets/img/activities-4.jpeg" alt="Women Empowerment">
          <span>Empowerment</span>
        </div>

        <div class="activity-content">
          <div class="activity-icon">
            <i class="bi bi-heart-fill"></i>
          </div>

          <h3>Women Empowerment</h3>

          <p>
            Programmes focused on confidence, awareness, career guidance and social
            development of women students.
          </p>

          <a href="gallery.html" class="activity-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="activity-card">
        <div class="activity-image">
          <img src="assets/img/activities-5.jpeg" alt="Career Guidance">
          <span>Career</span>
        </div>

        <div class="activity-content">
          <div class="activity-icon">
            <i class="bi bi-briefcase-fill"></i>
          </div>

          <h3>Career Guidance</h3>

          <p>
            Career-oriented sessions help students understand opportunities, skills,
            higher education and professional preparation.
          </p>

          <a href="gallery.html" class="activity-link">
            View Details <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

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
      <a href="admissions.html">Admission</a>
      <a href="examination.html">Examination</a>
      <a href="Academic-Calendar.html">Academic</a>
      <a href="students-corner.html">Student</a>
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

        <a href="notices.html" class="notice-main-btn">
          View All Notices <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="notices-list">

        <a href="admissions.html" class="notice-item">
          <div class="notice-date">
            <strong>08</strong>
            <span>Jun</span>
          </div>

          <div class="notice-content">
            <div class="notice-top">
              <span class="notice-category admission">Admission</span>
              <small><i class="bi bi-clock-fill"></i> New</small>
            </div>

            <h4>Admission related important information for upcoming academic session</h4>

            <p>
              Students can check admission guidelines, required documents and latest instructions.
            </p>
          </div>

          <div class="notice-arrow">
            <i class="bi bi-arrow-right"></i>
          </div>
        </a>

        <a href="examination.html" class="notice-item">
          <div class="notice-date">
            <strong>05</strong>
            <span>Jun</span>
          </div>

          <div class="notice-content">
            <div class="notice-top">
              <span class="notice-category exam">Examination</span>
              <small><i class="bi bi-file-earmark-pdf-fill"></i> PDF</small>
            </div>

            <h4>Examination form fill-up and schedule related notification</h4>

            <p>
              Examination related dates, form submission process and official guidelines.
            </p>
          </div>

          <div class="notice-arrow">
            <i class="bi bi-arrow-right"></i>
          </div>
        </a>

        <a href="Academic-Calendar.html" class="notice-item">
          <div class="notice-date">
            <strong>02</strong>
            <span>Jun</span>
          </div>

          <div class="notice-content">
            <div class="notice-top">
              <span class="notice-category academic">Academic</span>
              <small><i class="bi bi-calendar2-week-fill"></i> Update</small>
            </div>

            <h4>Academic calendar and departmental activity schedule update</h4>

            <p>
              Department-wise academic activities, calendar updates and institutional schedule.
            </p>
          </div>

          <div class="notice-arrow">
            <i class="bi bi-arrow-right"></i>
          </div>
        </a>

        <a href="students-corner.html" class="notice-item">
          <div class="notice-date">
            <strong>28</strong>
            <span>May</span>
          </div>

          <div class="notice-content">
            <div class="notice-top">
              <span class="notice-category student">Student</span>
              <small><i class="bi bi-info-circle-fill"></i> Info</small>
            </div>

            <h4>Student support, document verification and office notice</h4>

            <p>
              Important information for students regarding college office and documents.
            </p>
          </div>

          <div class="notice-arrow">
            <i class="bi bi-arrow-right"></i>
          </div>
        </a>

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

        <a href="download.html" class="resources-main-btn">
          View All Downloads <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="resources-grid">

        <a href="download.html" class="resource-card">
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

        <a href="download.html" class="resource-card">
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

        <a href="download.html" class="resource-card">
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

        <a href="download.html" class="resource-card">
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

        <a href="download.html" class="resource-card">
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

        <a href="download.html" class="resource-card">
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
