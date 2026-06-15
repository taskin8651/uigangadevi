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
            <a href="rti.html"><i class="bi bi-file-earmark-text me-1"></i> RTI</a>
            <a href="naac.html"><i class="bi bi-shield-check me-1"></i> NAAC / IQAC</a>
            <a href="download.html"><i class="bi bi-download me-1"></i> Downloads</a>
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
            <a class="nav-link active" href="/">Home</a>
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
            <a class="nav-link" href="departments.html">Departments</a>
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



@yield('content')




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
            <a href="/">Home</a>
            <a href="about.html">About College</a>
            <a href="Academic-Calendar.html">Academics</a>
            <a href="departments.html">Departments</a>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <h4>Students</h4>
          <div class="footer-links">
            <a href="admissions.html">Admissions</a>
            <a href="notices.html">Notices</a>
            <a href="download.html">Downloads</a>
            <a href="students-corner.html">Students Corner</a>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <h4>Disclosure</h4>
          <div class="footer-links">
            <a href="naac.html">NAAC / IQAC</a>
            <a href="rti.html">RTI</a>
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