@extends('frontend.master')
@section('content')



<!-- ================= PRINCIPAL MESSAGE PAGE START ================= -->

<main class="principal-message-page">

  <!-- PAGE HERO START -->
  <section class="pm-hero">
    <div class="pm-hero-bg">
        <!-- <img src="assets/img/hero-2.png" alt=""> -->
    </div>

    <div class="container">
      <div class="pm-hero-content">
        <span class="pm-badge">
          <i class="bi bi-person-badge-fill"></i>
          Principal's Message
        </span>

        <h1>Guiding Students Towards Knowledge, Values and Confidence</h1>

        <p>
          A message of academic dedication, discipline, women empowerment and continuous
          growth from the leadership of Ganga Devi Mahila Mahavidyalaya.
        </p>

        <div class="pm-hero-actions">
          <a href="{{ route('frontend.college') }}" class="pm-btn primary">
            <i class="bi bi-building-fill"></i>
            College Profile
          </a>
          <a href="{{ route('frontend.academic-calendar.index') }}" class="pm-btn light">
            <i class="bi bi-mortarboard-fill"></i>
            Academics
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- PAGE HERO END -->


  <!-- PRINCIPAL MESSAGE START -->
 @if($principalMessage)

    <section class="pm-message-section">
        <div class="container">

            <div class="pm-message-wrap">

                <div class="pm-principal-card">

                    <div class="pm-principal-img">
                        <img
                            src="{{ $principalMessage->image ?: asset('assets/img/principal.png') }}"
                            alt="Principal"
                        >
                    </div>

                    <div class="pm-principal-info">
                        <span>Principal</span>

                        <h3>
                            Ganga Devi Mahila Mahavidyalaya
                        </h3>

                        <p>
                            Kankarbagh, Patna, Bihar
                        </p>
                    </div>

                </div>

                <div class="pm-message-content">

                    <span class="pm-section-badge">
                        <i class="bi bi-chat-quote-fill"></i>
                        Message from the Principal
                    </span>

                    @if($principalMessage->title)
                        <h2>
                            {{ $principalMessage->title }}
                        </h2>
                    @endif

                    @if($principalMessage->description)
                        <div class="pm-message-description">
                            {!! $principalMessage->description !!}
                        </div>
                    @endif

                    <div class="pm-signature-box">
                        <div>
                            <strong>Principal</strong>

                            <span>
                                Ganga Devi Mahila Mahavidyalaya
                            </span>
                        </div>

                        <i class="bi bi-patch-check-fill"></i>
                    </div>

                </div>

            </div>

        </div>
    </section>

@endif
  <!-- PRINCIPAL MESSAGE END -->


  <!-- LEADERSHIP VALUES START -->
  <section class="pm-values-section">
    <div class="container">

      <div class="pm-section-head text-center">
        <span class="pm-section-badge">
          <i class="bi bi-stars"></i>
          Leadership Focus
        </span>

        <h2>Committed to Academic Excellence and Student Development</h2>

        <p>
          The college leadership focuses on discipline, transparency, academic quality
          and holistic development of students.
        </p>
      </div>

      <div class="pm-values-grid">

        <div class="pm-value-card">
          <div class="pm-value-icon">
            <i class="bi bi-mortarboard-fill"></i>
          </div>
          <h4>Academic Growth</h4>
          <p>
            Encouraging students to pursue knowledge, regular study habits and higher academic standards.
          </p>
        </div>

        <div class="pm-value-card">
          <div class="pm-value-icon">
            <i class="bi bi-shield-check"></i>
          </div>
          <h4>Discipline & Values</h4>
          <p>
            Promoting punctuality, responsibility, respectful conduct and ethical behaviour.
          </p>
        </div>

        <div class="pm-value-card">
          <div class="pm-value-icon">
            <i class="bi bi-gender-female"></i>
          </div>
          <h4>Women Empowerment</h4>
          <p>
            Helping students build confidence, independence, leadership and social awareness.
          </p>
        </div>

        <div class="pm-value-card">
          <div class="pm-value-icon">
            <i class="bi bi-people-fill"></i>
          </div>
          <h4>Student Support</h4>
          <p>
            Providing a supportive environment for academic, personal and career-oriented growth.
          </p>
        </div>

      </div>

    </div>
  </section>
  <!-- LEADERSHIP VALUES END -->


  <!-- MESSAGE HIGHLIGHTS START -->
  <section class="pm-highlights-section">
    <div class="container">

      <div class="pm-highlights-wrap">

        <div class="pm-highlights-left">
          <span class="pm-section-badge">
            <i class="bi bi-lightbulb-fill"></i>
            Message Highlights
          </span>

          <h2>Education with Purpose, Discipline and Responsibility</h2>

          <p>
            The principal’s message reflects the institution’s commitment to providing
            a balanced educational environment where learning, values and empowerment
            go together.
          </p>

          <a href="{{ route('frontend.mission') }}" class="pm-btn primary">
            <i class="bi bi-arrow-right-circle-fill"></i>
            View Vision & Mission
          </a>
        </div>

        <div class="pm-highlights-list">

          <div class="pm-highlight-item">
            <span>01</span>
            <div>
              <h4>Quality Higher Education</h4>
              <p>Strengthening classroom learning, academic resources and transparent information access.</p>
            </div>
          </div>

          <div class="pm-highlight-item">
            <span>02</span>
            <div>
              <h4>Holistic Development</h4>
              <p>Encouraging personality development, communication skills and leadership abilities.</p>
            </div>
          </div>

          <div class="pm-highlight-item">
            <span>03</span>
            <div>
              <h4>Safe Academic Environment</h4>
              <p>Maintaining a supportive campus focused on dignity, discipline and confidence.</p>
            </div>
          </div>

          <div class="pm-highlight-item">
            <span>04</span>
            <div>
              <h4>Future Readiness</h4>
              <p>Preparing students for further studies, career opportunities and responsible citizenship.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>
  <!-- MESSAGE HIGHLIGHTS END -->


  <!-- INSTITUTIONAL COMMITMENT START -->
  <section class="pm-commitment-section">
    <div class="container">

      <div class="pm-section-head text-center">
        <span class="pm-section-badge">
          <i class="bi bi-patch-check-fill"></i>
          Institutional Commitment
        </span>

        <h2>Our Commitment to Students</h2>

        <p>
          The college continues to work for academic progress, student welfare and
          institutional quality improvement.
        </p>
      </div>

      <div class="pm-commitment-grid">

        <div class="pm-commitment-card">
          <i class="bi bi-journal-check"></i>
          <h3>Academic Planning</h3>
          <p>
            Structured teaching-learning process, academic calendar, syllabus support and examination updates.
          </p>
        </div>

        <div class="pm-commitment-card">
          <i class="bi bi-megaphone-fill"></i>
          <h3>Transparent Communication</h3>
          <p>
            Timely notices, circulars, admission updates, student information and official documents.
          </p>
        </div>

        <div class="pm-commitment-card">
          <i class="bi bi-heart-fill"></i>
          <h3>Student Welfare</h3>
          <p>
            Supportive environment for learning, discipline, confidence and personal development.
          </p>
        </div>

      </div>

    </div>
  </section>
  <!-- INSTITUTIONAL COMMITMENT END -->


  <!-- CTA START -->
  <section class="pm-cta-section">
    <div class="container">
      <div class="pm-cta-wrap">
        <div>
          <span>Ganga Devi Mahila Mahavidyalaya</span>
          <h2>Empowering Students Through Education, Discipline and Values.</h2>
        </div>

        <div class="pm-cta-actions">
          <a href="{{ route('frontend.notices.index') }}" class="pm-btn primary">
            <i class="bi bi-megaphone-fill"></i>
            Latest Notices
          </a>
          <a href="{{ route('frontend.contact') }}" class="pm-btn light">
            <i class="bi bi-telephone-fill"></i>
            Contact College
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- CTA END -->

</main>

<!-- ================= PRINCIPAL MESSAGE PAGE END ================= -->




@endsection

