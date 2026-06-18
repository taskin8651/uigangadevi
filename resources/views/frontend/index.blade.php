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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

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
            <a href="#"><i class="bi bi-download me-1"></i> Downloads</a>
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





 <!-- ================= ADMISSION POPUP START ================= -->

  <div class="admission-popup" id="admissionPopup">
    <div class="admission-popup-overlay" id="admissionPopupOverlay"></div>

    <div class="admission-popup-box">
      <button type="button" class="admission-popup-close" id="admissionPopupClose" aria-label="Close Popup">
        <i class="bi bi-x-lg"></i>
      </button>

      <div class="admission-popup-image">
        <a href="https://gdmm.tcspatna.in/" target="_blank" rel="noopener">
          <img src="assets/img/admission-popup.jpeg" alt="Admission Open">
        </a>
      </div>
    </div>
  </div>

  <!-- ================= ADMISSION POPUP END ================= -->




<!-- HERO SLIDER START -->
<section class="hero-slider">

  <div class="hero-slide active">
    <img src="assets/img/hero.png" alt="">

    <div class="container">
      <div class="hero-content">
        <span class="hero-badge">
          <i class="bi bi-mortarboard-fill"></i>
          Women’s College in Kankarbagh, Patna
        </span>

        <h2>Empowering Women Through Quality Higher Education</h2>

        <p>
          Official website of Ganga Devi Mahila Mahavidyalaya with notices,
          admissions, academics, departments, NAAC / IQAC documents and student support.
        </p>

        <div class="hero-actions">
          <a href="{{ route('frontend.notices.index') }}" class="hero-btn primary">Latest Notices</a>
          <a href="{{ route('frontend.admissions.index') }}" class="hero-btn light">Admission Updates</a>
        </div>
      </div>
    </div>
  </div>

  <div class="hero-slide">
    <img src="assets/img/hero-1.png" alt="">

    <div class="container">
      <div class="hero-content">
        <span class="hero-badge">
          <i class="bi bi-award-fill"></i>
          NAAC Accredited Institution
        </span>

        <h2>Academic Excellence, Discipline and Student Development</h2>

        <p>
          Access verified academic resources, syllabus, timetable, examination updates
          and quality assurance information in a structured format.
        </p>

        <div class="hero-actions">
          <a href="{{ route('frontend.courses') }}" class="hero-btn primary">View Academics</a>
          <a href="#" class="hero-btn light">NAAC / IQAC</a>
        </div>
      </div>
    </div>
  </div>

  <div class="hero-slide">
    <img src="assets/img/hero-2.png" alt="">

    <div class="container">
      <div class="hero-content">
        <span class="hero-badge">
          <i class="bi bi-building-fill"></i>
          Since 1971
        </span>

        <h2>Official Documents, Downloads and Public Transparency</h2>

        <p>
          Quick access to RTI, statutory disclosures, policies, prospectus,
          notices, circulars and other important public documents.
        </p>

        <div class="hero-actions">
          <a href="#" class="hero-btn primary">Downloads</a>
          <a href="#" class="hero-btn light">RTI / Disclosure</a>
        </div>
      </div>
    </div>
  </div>

  <div class="hero-controls">
    <button class="active" type="button" aria-label="Slide 1"></button>
    <button type="button" aria-label="Slide 2"></button>
    <button type="button" aria-label="Slide 3"></button>
  </div>

</section>
<!-- HERO SLIDER END -->



  <!-- COLLEGE IDENTITY START -->
  <section class="identity-section">
    <div class="container">
      <div class="identity-wrap">

        <div class="college-card">
          <img src="assets/img/logo.png" alt="">
          <div>
            <h3>Ganga Devi Mahila Mahavidyalaya</h3>
            <p>
              NAAC accredited women’s college located at Kankarbagh, Patna,
              focused on higher education, values and women empowerment.
            </p>
          </div>
        </div>

        <div class="stats-grid">
          <div class="stat-card">
            <strong>1971</strong>
            <span>Established</span>
          </div>

          <div class="stat-card">
            <strong>19</strong>
            <span>Departments</span>
          </div>

          <div class="stat-card">
            <strong>B</strong>
            <span>NAAC Grade</span>
          </div>

          <div class="stat-card">
            <strong>UG / PG</strong>
            <span>Programmes</span>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- COLLEGE IDENTITY END -->



  <!-- AFFILIATION START -->
  <section class="section-pad soft-section">
    <div class="container">

      <div class="section-head">
        <div>
          <span class="section-badge"><i class="bi bi-patch-check-fill"></i> University Affiliation / Recognition</span>
          <h2 class="section-title">Official Recognition & Institutional Affiliation</h2>
          <p class="section-text">
            Verified academic, affiliation, accreditation and statutory information
            for students, parents, faculty, university bodies and visitors.
          </p>
        </div>
      </div>

      <div class="card-grid-4">
        <div class="premium-card">
          <div class="icon-box"><i class="bi bi-bank2"></i></div>
          <h4>University Affiliation</h4>
          <p>Affiliation and academic approval information for official reference.</p>
        </div>

        <div class="premium-card">
          <div class="icon-box"><i class="bi bi-award-fill"></i></div>
          <h4>NAAC Accreditation</h4>
          <p>Accreditation status, reports, certificates and quality documents.</p>
        </div>

        <div class="premium-card">
          <div class="icon-box"><i class="bi bi-shield-check"></i></div>
          <h4>Government Recognition</h4>
          <p>Recognition details, public disclosures and mandatory information.</p>
        </div>

        <div class="premium-card">
          <div class="icon-box"><i class="bi bi-file-earmark-text-fill"></i></div>
          <h4>Mandatory Documents</h4>
          <p>Affiliation letters, policies, prospectus and statutory records.</p>
        </div>
      </div>

    </div>
  </section>
  <!-- AFFILIATION END -->




  <!-- PRINCIPAL + ABOUT START -->
  <section class="section-pad">
    <div class="container">
      <div class="about-wrap">

        <div class="principal-card">
          <div class="principal-img">
            <img src="assets/img/principal.png" alt="">
          </div>
          <div class="principal-body">
            <span class="section-badge"><i class="bi bi-chat-quote-fill"></i> Principal’s Message</span>
            <h3> Prof. Dr. Shyama Roy</h3>
            <p>
              Education is not only about academic excellence, but also about
              building confidence, discipline, responsibility and values.
            </p>
            <a href="{{ route('frontend.contact') }}" class="outline-btn">Read Full Message <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="about-card">
          <span class="section-badge"><i class="bi bi-building-fill"></i> About College</span>
          <h2 class="section-title">A Supportive Academic Environment for Women Students</h2>
          <p class="section-text">
            Ganga Devi Mahila Mahavidyalaya is committed to providing a structured
            and student-friendly learning environment where students grow with
            knowledge, dignity, confidence and values.
          </p>

          <div class="about-points">
            <div class="about-point"><i class="bi bi-check-circle-fill"></i> Women Empowerment</div>
            <div class="about-point"><i class="bi bi-check-circle-fill"></i> Academic Excellence</div>
            <div class="about-point"><i class="bi bi-check-circle-fill"></i> Inclusive Learning</div>
            <div class="about-point"><i class="bi bi-check-circle-fill"></i> Student Support</div>
            <div class="about-point"><i class="bi bi-check-circle-fill"></i> Quality Education</div>
            <div class="about-point"><i class="bi bi-check-circle-fill"></i> Institutional Values</div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- PRINCIPAL + ABOUT END -->




  <!-- NOTICES + ADMISSIONS START -->
  <section class="section-pad soft-section">
    <div class="container">

      <div class="notice-admission-wrap">

        <div class="notice-list-card">
          <div class="panel-head">
            <h3><i class="bi bi-megaphone-fill me-2"></i> Latest Notices & Circulars</h3>
            <a href="{{ route('frontend.notices.index') }}" class="outline-btn">View All</a>
          </div>

          @forelse($frontendLatestNotices as $notice)
            @php
              $noticeDate = $notice->notice_date;
              $noticeUrl = $notice->download_url ?: route('frontend.notices.index');
            @endphp

            <a href="{{ $noticeUrl }}"
               class="notice-item"
               @if($notice->download_url) target="_blank" rel="noopener" @endif>
              <div class="notice-date">
                <strong>{{ $noticeDate ? $noticeDate->format('d') : '--' }}</strong>
                <span>{{ $noticeDate ? $noticeDate->format('M') : 'New' }}</span>
              </div>
              <div>
                <h4>{{ $notice->title }}</h4>
                <p>{{ $notice->short_description ?: ($notice->category ?: 'Official college notice and circular.') }}</p>
              </div>
              <i class="bi bi-arrow-right"></i>
            </a>
          @empty
            <a href="{{ route('frontend.notices.index') }}" class="notice-item">
              <div class="notice-date"><strong>--</strong><span>New</span></div>
              <div>
                <h4>No notices published yet</h4>
                <p>Latest college notices and circulars will appear here after publication.</p>
              </div>
              <i class="bi bi-arrow-right"></i>
            </a>
          @endforelse
        </div>

        <div class="admission-card">
          <span class="hero-badge"><i class="bi bi-stars"></i> Admission Updates</span>
          <h3>Apply for New Academic Session</h3>
          <p>
            Admission related official updates, prospectus, eligibility,
            important dates and merit list will be published here after approval.
          </p>

          <div class="admission-list">
            <div><i class="bi bi-check-circle-fill"></i> Admission Notice</div>
            <div><i class="bi bi-check-circle-fill"></i> Eligibility Criteria</div>
            <div><i class="bi bi-check-circle-fill"></i> Merit List / Selection List</div>
            <div><i class="bi bi-check-circle-fill"></i> Prospectus Download</div>
          </div>

          <a href="https://gdmm.tcspatna.in/" target="_blank" rel="noopener" class="white-btn">Apply Online <i class="bi bi-arrow-right"></i></a>
        </div>

      </div>

    </div>
  </section>
  <!-- NOTICES + ADMISSIONS END -->




 <!-- IMPORTANT LINKS START -->
<section class="section-pad">
  <div class="container">

    <div class="important-links-head">
      <div>
        <span class="important-links-badge">
          <i class="bi bi-link-45deg"></i>
          Important Links
        </span>

        <h2 class="section-title">Important Student & College Links</h2>

        <p class="section-text">
          Quick access to notices, admission, syllabus, downloads, NAAC / IQAC,
          examination updates and student support services.
        </p>
      </div>

      <a href="#" class="outline-btn">
        View All Links <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="card-grid-4">
      <a href="{{ route('frontend.notices.index') }}" class="premium-card">
        <div class="icon-box"><i class="bi bi-megaphone-fill"></i></div>
        <h4>Latest Notices</h4>
        <p>College notices, circulars and announcements.</p>
      </a>

      <a href="{{ route('frontend.admissions.index') }}" class="premium-card">
        <div class="icon-box"><i class="bi bi-person-check-fill"></i></div>
        <h4>Admissions</h4>
        <p>Admission notice, dates and merit list.</p>
      </a>

      <a href="{{ route('frontend.syllabus.index') }}" class="premium-card">
        <div class="icon-box"><i class="bi bi-journal-text"></i></div>
        <h4>Syllabus</h4>
        <p>Course-wise and subject-wise syllabus PDFs.</p>
      </a>

      <a href="#" class="premium-card">
        <div class="icon-box"><i class="bi bi-file-earmark-pdf-fill"></i></div>
        <h4>Downloads</h4>
        <p>Forms, documents, notices and prospectus.</p>
      </a>
    </div>

  </div>
</section>
<!-- IMPORTANT LINKS END -->




 <!-- ACADEMIC HIGHLIGHTS START -->
<section class="section-pad soft-section">
  <div class="container">

    <div class="academic-highlights-head">
      <div>
        <span class="academic-highlights-badge">
          <i class="bi bi-journal-bookmark-fill"></i>
          Academic Highlights
        </span>

        <h2 class="section-title">Academic Information & Highlights</h2>

        <p class="section-text">
          Explore courses, departments, syllabus, academic calendar, timetable,
          examination updates and important academic resources.
        </p>
      </div>

      <a href="{{ route('frontend.academic-calendar.index') }}" class="outline-btn">
        View Academics <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="card-grid-3">
      <div class="premium-card">
        <div class="icon-box"><i class="bi bi-mortarboard-fill"></i></div>
        <h4>Courses Offered</h4>
        <p>UG, PG and vocational programme details with eligibility.</p>
      </div>

      <div class="premium-card">
        <div class="icon-box"><i class="bi bi-building-fill"></i></div>
        <h4>Departments</h4>
        <p>Department-wise faculty, subjects, activities and resources.</p>
      </div>

      <div class="premium-card">
        <div class="icon-box"><i class="bi bi-calendar2-week-fill"></i></div>
        <h4>Academic Calendar</h4>
        <p>Session-wise academic calendar and important schedules.</p>
      </div>

      <div class="premium-card">
        <div class="icon-box"><i class="bi bi-clock-history"></i></div>
        <h4>Time Table</h4>
        <p>Class-wise and department-wise timetable updates.</p>
      </div>

      <div class="premium-card">
        <div class="icon-box"><i class="bi bi-clipboard-check-fill"></i></div>
        <h4>Examination</h4>
        <p>Exam notices, schedules, forms and result links.</p>
      </div>

      <div class="premium-card">
        <div class="icon-box"><i class="bi bi-people-fill"></i></div>
        <h4>Students Corner</h4>
        <p>Scholarship, grievance, anti-ragging and support links.</p>
      </div>
    </div>

  </div>
</section>
<!-- ACADEMIC HIGHLIGHTS END -->




<!-- GALLERY START -->
<section class="section-pad">
  <div class="container">

    <div class="gallery-section-head">
      <div>
        <span class="gallery-section-badge">
          <i class="bi bi-images"></i>
          Events & Gallery
        </span>

        <h2 class="section-title">Campus Events & Gallery Preview</h2>

        <p class="section-text">
          Explore campus photos, academic activities, seminars, cultural programmes,
          NSS / NCC activities, sports events and institutional moments.
        </p>
      </div>

      <a href="{{ route('frontend.gallery') }}" class="outline-btn">
        View Gallery <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="gallery-wrap">
      @php
        $homeGalleryFallbacks = collect([
          ['image' => asset('assets/img/gallery.png'), 'category' => 'Campus', 'title' => 'College Campus View'],
          ['image' => asset('assets/img/gallery-1.jpeg'), 'category' => 'Seminar', 'title' => 'Academic Activities'],
          ['image' => asset('assets/img/gallery-2.jpeg'), 'category' => 'Students', 'title' => 'Student Programmes'],
          ['image' => asset('assets/img/gallery-3.jpeg'), 'category' => 'Culture', 'title' => 'Cultural Events'],
          ['image' => asset('assets/img/gallery-4.jpeg'), 'category' => 'Workshop', 'title' => 'Workshops & Training'],
        ]);

        $homeGalleryItems = ($frontendGalleryItems ?? collect())->map(fn ($item) => [
          'image' => $item->image,
          'category' => $item->category ?: 'Gallery',
          'title' => $item->title,
        ])->filter(fn ($item) => filled($item['image']))->values();

        $homeGalleryItems = $homeGalleryItems->isNotEmpty()
          ? $homeGalleryItems
          : $homeGalleryFallbacks;
      @endphp

      <a href="{{ route('frontend.gallery') }}" class="gallery-large">
        <img src="{{ $homeGalleryItems->first()['image'] }}" alt="{{ $homeGalleryItems->first()['title'] }}">
        <div class="gallery-overlay"></div>
        <div class="gallery-content">
          <span>{{ $homeGalleryItems->first()['category'] }}</span>
          <h3>{{ $homeGalleryItems->first()['title'] }}</h3>
        </div>
      </a>

      <div class="gallery-small-grid">
        @foreach($homeGalleryItems->skip(1)->take(4) as $galleryItem)
          <a href="{{ route('frontend.gallery') }}" class="gallery-small">
            <img src="{{ $galleryItem['image'] }}" alt="{{ $galleryItem['title'] }}">
            <div class="gallery-overlay"></div>
            <div class="gallery-content">
              <span>{{ $galleryItem['category'] }}</span>
              <h4>{{ $galleryItem['title'] }}</h4>
            </div>
          </a>
        @endforeach
      </div>

    </div>

  </div>
</section>
<!-- GALLERY END -->




<!-- NAAC IQAC START -->
<section class="section-pad soft-section">
  <div class="container">

    <div class="naac-iqac-head">
      <div>
        <span class="naac-iqac-badge">
          <i class="bi bi-award-fill"></i>
          NAAC / IQAC Quick Access
        </span>

        <h2 class="section-title">Quality Assurance & Accreditation</h2>

        <p class="section-text">
          Quick access to IQAC composition, NAAC documents, AQAR reports,
          meeting minutes, action taken reports and quality initiatives.
        </p>
      </div>

      <a href="#" class="outline-btn">
        View NAAC / IQAC <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="card-grid-3">
      <a href="#" class="premium-card">
        <div class="icon-box"><i class="bi bi-people-fill"></i></div>
        <h4>IQAC Composition</h4>
        <p>Members, coordinators and quality cell details.</p>
      </a>

      <a href="#" class="premium-card">
        <div class="icon-box"><i class="bi bi-file-earmark-pdf-fill"></i></div>
        <h4>AQAR Reports</h4>
        <p>Annual quality assurance reports and records.</p>
      </a>

      <a href="#" class="premium-card">
        <div class="icon-box"><i class="bi bi-award-fill"></i></div>
        <h4>NAAC Documents</h4>
        <p>SSR, DVV, certificates and accreditation files.</p>
      </a>
    </div>

  </div>
</section>
<!-- NAAC IQAC END -->




  <!-- DOWNLOADS + CONTACT START -->
  <section class="section-pad">
    <div class="container">

      <div class="download-contact-wrap">

        <div class="download-list">
          <span class="section-badge"><i class="bi bi-download"></i> Downloads</span>
          <h2 class="section-title">Important Downloads</h2>

          <a href="{{ route('frontend.college') }}" class="download-row">
            <i class="bi bi-file-earmark-pdf-fill"></i>
            <div>
              <strong>College Prospectus</strong>
              <span>Latest college prospectus PDF</span>
            </div>
          </a>

          <a href="{{ route('frontend.admissions.index') }}" class="download-row">
            <i class="bi bi-person-check-fill"></i>
            <div>
              <strong>Admission Form</strong>
              <span>Student admission application form</span>
            </div>
          </a>

          <a href="{{ route('frontend.syllabus.index') }}" class="download-row">
            <i class="bi bi-journal-text"></i>
            <div>
              <strong>Syllabus</strong>
              <span>Course-wise syllabus documents</span>
            </div>
          </a>

          <a href="#" class="download-row">
            <i class="bi bi-clock-history"></i>
            <div>
              <strong>Time Table</strong>
              <span>Class and department timetable</span>
            </div>
          </a>
        </div>

        <div class="contact-box">
          <span class="section-badge"><i class="bi bi-headset"></i> Contact Information</span>
          <h2 class="section-title">Get in Touch With College Office</h2>

          <div class="contact-row">
            <i class="bi bi-geo-alt-fill"></i>
            <div>
              <strong>College Address</strong>
              <span>Kankarbagh, Patna, Bihar</span>
            </div>
          </div>

          <div class="contact-row">
            <i class="bi bi-envelope-fill"></i>
            <div>
              <strong>Email Address</strong>
              <span>gangadevimahilacollege@gmail.com</span>
            </div>
          </div>

          <div class="contact-row">
            <i class="bi bi-telephone-fill"></i>
            <div>
              <strong>Office Contact</strong>
              <span>Official phone number will be updated</span>
            </div>
          </div>

          <div class="contact-row">
            <i class="bi bi-clock-fill"></i>
            <div>
              <strong>Office Timing</strong>
              <span>Monday to Saturday | 10:00 AM - 5:00 PM</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
  <!-- DOWNLOADS + CONTACT END -->




  <!-- FOOTER START -->
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
            <a href="{{ route('frontend.index') }}">Home</a>
            <a href="{{ route('frontend.about') }}">About College</a>
            <a href="{{ route('frontend.academic-calendar.index') }}">Academics</a>
            <a href="{{ route('frontend.departments') }}">Departments</a>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <h4>Students</h4>
          <div class="footer-links">
            <a href="{{ route('frontend.admissions.index') }}">Admissions</a>
            <a href="{{ route('frontend.notices.index') }}">Notices</a>
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

