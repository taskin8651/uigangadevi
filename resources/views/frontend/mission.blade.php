@extends('frontend.master')
@section('content')

<!-- ================= VISION & MISSION PAGE START ================= -->

<main class="vision-mission-page">

  <!-- PAGE HERO START -->
  <section class="vm-hero">
    <div class="vm-hero-bg">
        <!-- <img src="assets/img/hero.png" alt=""> -->
    </div>

    <div class="container">
      <div class="vm-hero-content">
        <span class="vm-badge">
          <i class="bi bi-bullseye"></i>
          Vision & Mission
        </span>

        <h1>Our Vision, Mission and Institutional Values</h1>

        <p>
          Ganga Devi Mahila Mahavidyalaya is committed to quality higher education,
          discipline, social responsibility and women empowerment through an inclusive
          and value-based academic environment.
        </p>

        <div class="vm-hero-actions">
          <a href="Academic-Calendar.html" class="vm-btn primary">
            <i class="bi bi-mortarboard-fill"></i>
            Explore Academics
          </a>
          <a href="college.html" class="vm-btn light">
            <i class="bi bi-building-fill"></i>
            College Profile
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- PAGE HERO END -->


  <!-- VISION MISSION INTRO START -->
  <section class="vm-intro-section">
    <div class="container">

      <div class="vm-intro-grid">

        <div class="vm-intro-content">
          <span class="vm-section-badge">
            <i class="bi bi-stars"></i>
            Institutional Purpose
          </span>

          <h2>Building Confidence, Knowledge and Character Through Education.</h2>

          <p>
            The college aims to provide an academic environment where students can
            develop knowledge, discipline, confidence, leadership qualities and social
            awareness. The institution believes in empowering women through education
            and preparing them for meaningful participation in society.
          </p>

          <p>
            Our focus is not only on classroom learning but also on personality
            development, moral values, creativity, critical thinking and responsible
            citizenship.
          </p>
        </div>

        <div class="vm-intro-card">
          <img src="assets/img/vision-mission.jpeg" alt="Vision and Mission">

          <div class="vm-intro-floating">
            <strong>Education</strong>
            <span>Values • Discipline • Empowerment</span>
          </div>
        </div>

      </div>

    </div>
  </section>
  <!-- VISION MISSION INTRO END -->


  <!-- MAIN VISION MISSION START -->
 @if($collegeProfile)

    @php
        $activeVisionPoints = collect(
            $collegeProfile->vision_points ?? []
        )->filter(function ($point) {
            return !empty($point['text'])
                && !empty($point['status']);
        });

        $activeMissionPoints = collect(
            $collegeProfile->mission_points ?? []
        )->filter(function ($point) {
            return !empty($point['text'])
                && !empty($point['status']);
        });
    @endphp

    <section class="vm-main-section">
        <div class="container">

            <div class="vm-section-head text-center">

                <span class="vm-section-badge">
                    <i class="bi bi-compass-fill"></i>
                    Our Direction
                </span>

                <h2>
                    Vision and Mission
                </h2>

                <p>
                    A clear academic direction to support student growth,
                    institutional excellence and women empowerment.
                </p>

            </div>

            <div class="vm-main-grid">

                {{-- VISION CARD --}}
                <div class="vm-card vm-card-blue">

                    <div class="vm-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>

                    <h3>
                        {{ $collegeProfile->vision_title ?: 'Our Vision' }}
                    </h3>

                    @if($collegeProfile->vision_description)
                        <p>
                            {{ $collegeProfile->vision_description }}
                        </p>
                    @endif

                    @if($activeVisionPoints->isNotEmpty())
                        <ul>
                            @foreach($activeVisionPoints as $point)
                                <li>
                                    <i class="bi bi-check2-circle"></i>

                                    <span>
                                        {{ $point['text'] }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>

                {{-- MISSION CARD --}}
                <div class="vm-card vm-card-red">

                    <div class="vm-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>

                    <h3>
                        {{ $collegeProfile->mission_title ?: 'Our Mission' }}
                    </h3>

                    @if($collegeProfile->mission_description)
                        <p>
                            {{ $collegeProfile->mission_description }}
                        </p>
                    @endif

                    @if($activeMissionPoints->isNotEmpty())
                        <ul>
                            @foreach($activeMissionPoints as $point)
                                <li>
                                    <i class="bi bi-check2-circle"></i>

                                    <span>
                                        {{ $point['text'] }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>

            </div>

        </div>
    </section>

@endif
  <!-- MAIN VISION MISSION END -->


  <!-- CORE VALUES START -->
  <section class="vm-values-section">
    <div class="container">

      <div class="vm-section-head text-center">
        <span class="vm-section-badge">
          <i class="bi bi-heart-fill"></i>
          Core Values
        </span>

        <h2>Values That Guide Our Institution</h2>

        <p>
          Our values help create a disciplined, respectful and progressive learning
          culture for students.
        </p>
      </div>

      <div class="vm-values-grid">

        <div class="vm-value-card">
          <div class="vm-value-icon">
            <i class="bi bi-award-fill"></i>
          </div>
          <h4>Academic Excellence</h4>
          <p>Encouraging quality learning, regular study habits and academic achievement.</p>
        </div>

        <div class="vm-value-card">
          <div class="vm-value-icon">
            <i class="bi bi-shield-check"></i>
          </div>
          <h4>Discipline</h4>
          <p>Promoting responsibility, punctuality, respect and ethical behaviour.</p>
        </div>

        <div class="vm-value-card">
          <div class="vm-value-icon">
            <i class="bi bi-gender-female"></i>
          </div>
          <h4>Women Empowerment</h4>
          <p>Supporting confidence, independence, leadership and social awareness.</p>
        </div>

        <div class="vm-value-card">
          <div class="vm-value-icon">
            <i class="bi bi-people-fill"></i>
          </div>
          <h4>Inclusiveness</h4>
          <p>Providing a supportive environment for students from different backgrounds.</p>
        </div>

        <div class="vm-value-card">
          <div class="vm-value-icon">
            <i class="bi bi-lightbulb-fill"></i>
          </div>
          <h4>Innovation</h4>
          <p>Encouraging creativity, critical thinking and modern learning practices.</p>
        </div>

        <div class="vm-value-card">
          <div class="vm-value-icon">
            <i class="bi bi-globe2"></i>
          </div>
          <h4>Social Responsibility</h4>
          <p>Developing responsible citizens committed to community and nation building.</p>
        </div>

      </div>

    </div>
  </section>
  <!-- CORE VALUES END -->


  <!-- OBJECTIVES START -->
  <section class="vm-objectives-section">
    <div class="container">

      <div class="vm-objectives-wrap">

        <div class="vm-objectives-left">
          <span class="vm-section-badge">
            <i class="bi bi-list-check"></i>
            Institutional Objectives
          </span>

          <h2>Our Educational Objectives</h2>

          <p>
            The college works with a clear objective to strengthen academic learning,
            provide student support and build confidence among young women.
          </p>

          <a href="Academic-Calendar.html" class="vm-btn primary">
            <i class="bi bi-arrow-right-circle-fill"></i>
            View Academic Programmes
          </a>
        </div>

        <div class="vm-objectives-list">

          <div class="vm-objective-item">
            <span>01</span>
            <div>
              <h4>Promote Quality Education</h4>
              <p>Provide structured academic learning with updated resources and support.</p>
            </div>
          </div>

          <div class="vm-objective-item">
            <span>02</span>
            <div>
              <h4>Develop Confidence</h4>
              <p>Encourage communication, leadership, discipline and self-development.</p>
            </div>
          </div>

          <div class="vm-objective-item">
            <span>03</span>
            <div>
              <h4>Support Holistic Growth</h4>
              <p>Promote academics, co-curricular activities, values and social awareness.</p>
            </div>
          </div>

          <div class="vm-objective-item">
            <span>04</span>
            <div>
              <h4>Ensure Transparency</h4>
              <p>Provide notices, documents, academic information and student resources clearly.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>
  <!-- OBJECTIVES END -->


  <!-- QUALITY COMMITMENT START -->
  <section class="vm-quality-section">
    <div class="container">

      <div class="vm-quality-grid">

        <div class="vm-quality-card">
          <i class="bi bi-journal-check"></i>
          <h3>Academic Commitment</h3>
          <p>
            Regular academic activities, syllabus-based learning, examination updates
            and transparent information access for students.
          </p>
        </div>

        <div class="vm-quality-card">
          <i class="bi bi-person-hearts"></i>
          <h3>Student Development</h3>
          <p>
            Focus on personality development, discipline, confidence, leadership and
            responsible participation in society.
          </p>
        </div>

        <div class="vm-quality-card">
          <i class="bi bi-patch-check-fill"></i>
          <h3>Quality Assurance</h3>
          <p>
            Continuous improvement through academic planning, institutional processes,
            NAAC / IQAC activities and stakeholder support.
          </p>
        </div>

      </div>

    </div>
  </section>
  <!-- QUALITY COMMITMENT END -->


  <!-- CTA START -->
  <section class="vm-cta-section">
    <div class="container">
      <div class="vm-cta-wrap">
        <div>
          <span>Ganga Devi Mahila Mahavidyalaya</span>
          <h2>Committed to Education, Discipline and Women Empowerment.</h2>
        </div>

        <div class="vm-cta-actions">
          <a href="{{ route('frontend.notices.index') }}" class="vm-btn primary">
            <i class="bi bi-megaphone-fill"></i>
            Latest Notices
          </a>
          <a href="contact.html" class="vm-btn light">
            <i class="bi bi-telephone-fill"></i>
            Contact College
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- CTA END -->

</main>

 <!-- ================= VISION & MISSION PAGE START  ================= -->

@endsection