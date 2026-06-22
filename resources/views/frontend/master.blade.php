<!DOCTYPE html>
<html lang="en">
@php
  $websiteSetting = $websiteSetting ?? \App\Models\WebsiteSetting::current();
  $siteName = $websiteSetting->site_name ?: 'Ganga Devi Mahila Mahavidyalaya';
  $siteTagline = $websiteSetting->site_tagline ?: 'Official College Website | gdmm.ac.in';
  $siteLogo = $websiteSetting->logo ?: asset('assets/img/logo.png');
  $siteFavicon = $websiteSetting->favicon;
  $siteAddress = $websiteSetting->full_address ?: 'Kankarbagh, Patna, Bihar';
  $siteLocation = trim(($websiteSetting->city ?: 'Patna') . ', ' . ($websiteSetting->state ?: 'Bihar'), ', ');
  $siteEmail = $websiteSetting->primary_email ?: 'gangadevimahilacollege@gmail.com';
  $sitePhone = $websiteSetting->primary_phone ?: '';
  $siteMapLink = $websiteSetting->map_link ?: route('frontend.contact');
  $footerDescription = $websiteSetting->footer_description ?: 'Official college website for academic information, notices, admission updates, statutory disclosures and student support services.';
  $copyrightText = $websiteSetting->copyright_text ?: 'Copyright ' . date('Y') . ' ' . $siteName . '. All Rights Reserved.';
  $socialLinks = collect([
      'facebook_url' => ['icon' => 'bi-facebook', 'label' => 'Facebook'],
      'twitter_url' => ['icon' => 'bi-twitter-x', 'label' => 'Twitter'],
      'instagram_url' => ['icon' => 'bi-instagram', 'label' => 'Instagram'],
      'youtube_url' => ['icon' => 'bi-youtube', 'label' => 'YouTube'],
      'linkedin_url' => ['icon' => 'bi-linkedin', 'label' => 'LinkedIn'],
  ])->filter(fn ($item, $field) => filled($websiteSetting->{$field}));
@endphp
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>@yield('title', $websiteSetting->meta_title ?: $siteName . ' | Official College Website')</title>
  <meta name="description" content="@yield('meta_description', $websiteSetting->meta_description ?: $footerDescription)">
  @if($websiteSetting->meta_keywords)
    <meta name="keywords" content="{{ $websiteSetting->meta_keywords }}">
  @endif
  @if($siteFavicon)
    <link rel="icon" href="{{ $siteFavicon }}">
  @endif

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- ICONS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>

  <!-- TOP BAR START -->
  <div class="topbar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <span><i class="bi bi-geo-alt me-1"></i> {{ $siteLocation }}</span>
          <span class="ms-3"><i class="bi bi-envelope me-1"></i> {{ $siteEmail }}</span>
        </div>

        <div class="col-lg-6">
          <div class="top-links">
            <a href="{{ route('frontend.rti') }}"><i class="bi bi-file-earmark-text me-1"></i> RTI</a>
            <a href="{{ route('frontend.naac') }}"><i class="bi bi-shield-check me-1"></i> NAAC / IQAC</a>
            <a href="https://gdmm.tcspatna.in/" target="_blank" rel="noopener" class="admission-open-blink"><i class="bi bi-mortarboard-fill me-1"></i> Admission Open</a>
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

      <a class="navbar-brand" href="{{ route('frontend.index') }}">
        <img src="{{ $siteLogo }}" alt="{{ $siteName }}">
        <div class="brand-text">
          <h1>{{ $siteName }}</h1>
          <span>{{ $siteTagline }}</span>
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
              <li><a class="dropdown-item" href="http://gdmmclc.tcspatna.in/" target="_blank" rel="noopener">CLC Apply</a></li>
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



@yield('content')




  <!-- FOOTER START -->
  <footer class="footer">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
          <img src="{{ $siteLogo }}" alt="{{ $siteName }}">
          <h4>{{ $siteName }}</h4>
          <p>
            {{ $footerDescription }}
          </p>
          @if($socialLinks->isNotEmpty())
            <div class="footer-social">
              @foreach($socialLinks as $field => $social)
                <a href="{{ $websiteSetting->{$field} }}" target="_blank" aria-label="{{ $social['label'] }}">
                  <i class="bi {{ $social['icon'] }}"></i>
                </a>
              @endforeach
            </div>
          @endif
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
            <a href="{{ route('frontend.naac') }}">NAAC / IQAC</a>
            <a href="{{ route('frontend.rti') }}">RTI</a>
            <a href="#">Statutory Disclosure</a>
            <a href="#">Policies</a>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <h4>Contact</h4>
          <div class="footer-links">
            <a href="{{ route('frontend.contact') }}">{{ $siteLocation }}</a>
            @if($sitePhone)
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', $sitePhone) }}">Contact Office</a>
            @else
              <a href="{{ route('frontend.contact') }}">Contact Office</a>
            @endif
            <a href="{{ $siteMapLink }}" target="_blank">Google Map</a>
            <a href="{{ url('/login') }}">Admin Login</a>
          </div>
        </div>

      </div>

      <div class="footer-bottom">
        {{ $copyrightText }}
      </div>
    </div>
  </footer>
  <!-- FOOTER END -->

  <script src="{{ asset('assets/js/main.js') }}"></script>


  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

 

</body>
</html>

