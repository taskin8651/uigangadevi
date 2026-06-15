@extends('frontend.master')
@section('title', 'About College')
@section('content')


<!-- ================= COLLEGE PROFILE PAGE START ================= -->

<main class="college-profile-page">

  <!-- HERO START -->
  <section class="cp-hero">
    <div class="cp-hero-bg">
      <img src="assets/img/hero.png" alt="Ganga Devi Mahila Mahavidyalaya">
    </div>

    <div class="container">
      <div class="cp-hero-content">
        <span class="cp-badge">
          <i class="bi bi-building-fill"></i>
          College Profile
        </span>

        <h1>Ganga Devi Mahila Mahavidyalaya</h1>

        <p>
          A premier women’s college in Kankarbagh, Patna committed to quality higher
          education, academic discipline, values, transparency and women empowerment.
        </p>

        <div class="cp-hero-actions">
          <a href="download.html" class="cp-btn primary">
            <i class="bi bi-download"></i>
            Download Prospectus
          </a>

          <a href="courses.html" class="cp-btn light">
            <i class="bi bi-mortarboard-fill"></i>
            Courses Offered
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- HERO END -->


  <!-- ABOUT OVERVIEW START -->
 @if($collegeProfile)

    @php
        $profileImage = $collegeProfile->getFirstMediaUrl(
            'college_profile_image'
        );

        $activeAboutPoints = collect(
            $collegeProfile->about_points ?? []
        )->filter(function ($point) {
            return !empty($point['text'])
                && !empty($point['status']);
        });
    @endphp

    <section class="cp-about-section">
        <div class="container">

            <div class="cp-about-grid">

                {{-- IMAGE SIDE --}}
                <div class="cp-about-image">

                    <img
                        src="{{ $profileImage ?: asset('assets/img/college-profile.jpeg') }}"
                        alt="{{ $collegeProfile->about_title ?: 'College Profile' }}"
                    >

                    @if(
                        $collegeProfile->image_badge_title ||
                        $collegeProfile->image_badge_subtitle
                    )
                        <div class="cp-image-badge">

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

                {{-- CONTENT SIDE --}}
                <div class="cp-about-content">

                    @if($collegeProfile->about_badge)
                        <span class="cp-section-badge">

                            {{-- Static icon --}}
                            <i class="bi bi-stars"></i>

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
                        <div class="cp-points-grid">

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

            </div>

        </div>
    </section>

@endif
  <!-- ABOUT OVERVIEW END -->


  <!-- FACTS START -->
  <section class="cp-facts-section">
    <div class="container">

      <div class="cp-section-title text-center">
        <span class="cp-section-badge">
          <i class="bi bi-info-circle-fill"></i>
          College at a Glance
        </span>

        <h2>Institutional Highlights</h2>

        <p>
          Key information about the college, academic structure and institutional identity.
        </p>
      </div>

      <div class="cp-facts-grid">

        <div class="cp-fact-card">
          <div class="cp-fact-icon">
            <i class="bi bi-calendar-check-fill"></i>
          </div>
          <h3>1971</h3>
          <p>Established</p>
        </div>

        <div class="cp-fact-card">
          <div class="cp-fact-icon">
            <i class="bi bi-diagram-3-fill"></i>
          </div>
          <h3>19</h3>
          <p>Departments</p>
        </div>

        <div class="cp-fact-card">
          <div class="cp-fact-icon">
            <i class="bi bi-award-fill"></i>
          </div>
          <h3>B</h3>
          <p>NAAC Grade</p>
        </div>

        <div class="cp-fact-card">
          <div class="cp-fact-icon">
            <i class="bi bi-journal-bookmark-fill"></i>
          </div>
          <h3>UG / PG</h3>
          <p>Programmes</p>
        </div>

      </div>

    </div>
  </section>
  <!-- FACTS END -->


  <!-- VISION MISSION START -->
  @if($collegeProfile)

    <section class="cp-vision-section">
        <div class="container">

            <div class="cp-vision-grid">

                {{-- VISION CARD --}}
                <div class="cp-vision-card">

                    <div class="cp-vision-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>

                    <h3>
                        {{ $collegeProfile->vision_title ?? 'Our Vision' }}
                    </h3>

                    <p>
                        {{ $collegeProfile->vision_description }}
                    </p>

                </div>

                {{-- MISSION CARD --}}
                <div class="cp-vision-card">

                    <div class="cp-vision-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>

                    <h3>
                        {{ $collegeProfile->mission_title ?? 'Our Mission' }}
                    </h3>

                    <p>
                        {{ $collegeProfile->mission_description }}
                    </p>

                </div>

                {{-- CORE VALUES CARD --}}
                <div class="cp-vision-card">

                    <div class="cp-vision-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>

                    <h3>
                        {{ $collegeProfile->core_value_title ?? 'Core Values' }}
                    </h3>

                    <p>
                        {{ $collegeProfile->core_value_description }}
                    </p>

                </div>

            </div>

        </div>
    </section>

@endif
  <!-- VISION MISSION END -->


  <!-- PRINCIPAL MESSAGE START -->
 @if($principalMessage)

    @php
        $principalImage = $principalMessage->getFirstMediaUrl(
            'principal_image'
        );
    @endphp

    <section class="cp-principal-section">
        <div class="container">

            <div class="cp-principal-wrap">

                {{-- PRINCIPAL IMAGE --}}
                <div class="cp-principal-photo">
                    <img
                        src="{{ $principalImage ?: asset('assets/img/principal.png') }}"
                        alt="{{ $principalMessage->principal_name ?: 'Principal' }}"
                    >
                </div>

                {{-- PRINCIPAL CONTENT --}}
                <div class="cp-principal-content">

                    {{-- Static badge and icon --}}
                    <span class="cp-section-badge">
                        <i class="bi bi-person-badge-fill"></i>
                        Principal's Message
                    </span>

                    @if($principalMessage->title)
                        <h2>
                            {{ $principalMessage->title }}
                        </h2>
                    @endif

                    @if($principalMessage->description)
                        <div class="cp-principal-description">
                            {!! $principalMessage->description !!}
                        </div>
                    @endif

                    @if(
                        $principalMessage->principal_name ||
                        $principalMessage->college_name
                    )
                        <div class="cp-principal-sign">

                            @if($principalMessage->principal_name)
                                <strong>
                                    {{ $principalMessage->principal_name }}
                                </strong>
                            @endif

                            @if($principalMessage->college_name)
                                <span>
                                    {{ $principalMessage->college_name }}
                                </span>
                            @endif

                        </div>
                    @endif

                </div>

            </div>

        </div>
    </section>

@endif
  <!-- PRINCIPAL MESSAGE END -->


  <!-- ACADEMIC ENVIRONMENT START -->
  <section class="cp-academic-section">
    <div class="container">

      <div class="cp-section-title text-center">
        <span class="cp-section-badge">
          <i class="bi bi-mortarboard-fill"></i>
          Academic Environment
        </span>

        <h2>Learning, Discipline and Development</h2>

        <p>
          The college provides academic support, transparent information and structured
          resources for students, teachers and stakeholders.
        </p>
      </div>

      <div class="cp-academic-grid">

        <div class="cp-academic-card">
          <i class="bi bi-journal-text"></i>
          <h4>Courses & Syllabus</h4>
          <p>Structured academic information including courses, syllabus and programme details.</p>
        </div>

        <div class="cp-academic-card">
          <i class="bi bi-calendar2-week"></i>
          <h4>Academic Calendar</h4>
          <p>Important academic dates, events, activities and examination schedules.</p>
        </div>

        <div class="cp-academic-card">
          <i class="bi bi-megaphone-fill"></i>
          <h4>Notices & Circulars</h4>
          <p>Official notices, announcements, admission updates and examination information.</p>
        </div>

        <div class="cp-academic-card">
          <i class="bi bi-people-fill"></i>
          <h4>Student Support</h4>
          <p>Guidance, information access, student corner and support services.</p>
        </div>

      </div>

    </div>
  </section>
  <!-- ACADEMIC ENVIRONMENT END -->


  <!-- FACILITIES START -->
  <section class="cp-facilities-section">
    <div class="container">

      <div class="cp-section-title text-center">
        <span class="cp-section-badge">
          <i class="bi bi-grid-fill"></i>
          Campus Facilities
        </span>

        <h2>Facilities for a Better Academic Experience</h2>
      </div>

      <div class="cp-facilities-grid">

        <div class="cp-facility-card">
          <i class="bi bi-book-half"></i>
          <span>Library</span>
        </div>

        <div class="cp-facility-card">
          <i class="bi bi-pc-display-horizontal"></i>
          <span>Computer Lab</span>
        </div>

        <div class="cp-facility-card">
          <i class="bi bi-building"></i>
          <span>Classrooms</span>
        </div>

        <div class="cp-facility-card">
          <i class="bi bi-shield-check"></i>
          <span>Safe Campus</span>
        </div>

        <div class="cp-facility-card">
          <i class="bi bi-person-lines-fill"></i>
          <span>Student Support</span>
        </div>

        <div class="cp-facility-card">
          <i class="bi bi-images"></i>
          <span>Activities</span>
        </div>

      </div>

    </div>
  </section>
  <!-- FACILITIES END -->


  <!-- CTA START -->
  <section class="cp-cta-section">
    <div class="container">

      <div class="cp-cta-wrap">
        <div>
          <span>Official College Website</span>
          <h2>Explore Admissions, Notices, Academics and Student Resources.</h2>
        </div>

        <div class="cp-cta-actions">
          <a href="notices.html" class="cp-btn primary">
            <i class="bi bi-megaphone-fill"></i>
            Latest Notices
          </a>

          <a href="contact.html" class="cp-btn light">
            <i class="bi bi-telephone-fill"></i>
            Contact College
          </a>
        </div>
      </div>

    </div>
  </section>
  <!-- CTA END -->

</main>
<!-- ================= COLLEGE PROFILE PAGE END ================= -->


@endsection