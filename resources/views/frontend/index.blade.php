@extends('frontend.master')
@section('title', 'Home - Ganga Devi Mahila Mahavidyalaya')
@section('content')

@php
  $siteName = $websiteSetting->site_name ?: 'Ganga Devi Mahila Mahavidyalaya';
  $siteLogo = $websiteSetting->logo ?: asset('assets/img/logo.png');
  $siteAddress = $websiteSetting->full_address ?: 'Kankarbagh, Patna, Bihar';
  $siteEmail = $websiteSetting->primary_email ?: 'gangadevimahilacollege@gmail.com';
  $sitePhone = $websiteSetting->primary_phone ?: 'Official phone number will be updated';
  $officeTiming = trim(($websiteSetting->office_days ?: 'Monday to Saturday') . ' | ' . ($websiteSetting->office_time ?: '10:00 AM - 5:00 PM'), ' |');
  $aboutTitle = $collegeProfile->about_title ?? 'A Supportive Academic Environment for Women Students';
  $aboutText = $collegeProfile->about_description_one ?? 'Ganga Devi Mahila Mahavidyalaya is committed to providing a structured and student-friendly learning environment where students grow with knowledge, dignity, confidence and values.';
  $aboutPoints = collect($collegeProfile->about_points ?? [])->filter(fn ($item) => ($item['status'] ?? true) && filled($item['text'] ?? null))->pluck('text')->take(6);
  $aboutPoints = $aboutPoints->isNotEmpty() ? $aboutPoints : collect(['Women Empowerment', 'Academic Excellence', 'Inclusive Learning', 'Student Support', 'Quality Education', 'Institutional Values']);
  $principalName = $principalMessage->principal_name ?? 'Prof. Dr. Shyama Roy';
  $principalText = $principalMessage->description ?? 'Education is not only about academic excellence, but also about building confidence, discipline, responsibility and values.';
  $principalImage = $principalMessage->image ?? asset('assets/img/principal.png');
@endphp





 <!-- ================= ADMISSION POPUP START ================= -->

  @if(
    isset($admissionPopup)
    && $admissionPopup
    && $admissionPopup->image
)

    <div class="admission-popup"
         id="admissionPopup"
         aria-hidden="true">

        <div class="admission-popup-overlay"
             id="admissionPopupOverlay">
        </div>

        <div class="admission-popup-box"
             role="dialog"
             aria-modal="true"
             aria-label="{{ $admissionPopup->title ?: 'Admission Open' }}">

            <button type="button"
                    class="admission-popup-close"
                    id="admissionPopupClose"
                    aria-label="Close Popup">

                <i class="bi bi-x-lg"></i>
            </button>

            <div class="admission-popup-image">

                @if($admissionPopup->url)

                    <a href="{{ $admissionPopup->url }}"
                       target="_blank"
                       rel="noopener"
                       aria-label="{{ $admissionPopup->title ?: 'Admission Open' }}">

                        <img src="{{ $admissionPopup->image }}"
                             alt="{{ $admissionPopup->title ?: 'Admission Open' }}">

                    </a>

                @else

                    <img src="{{ $admissionPopup->image }}"
                         alt="{{ $admissionPopup->title ?: 'Admission Open' }}">

                @endif

            </div>

        </div>

    </div>

@endif

  <!-- ================= ADMISSION POPUP END ================= -->




<!-- HERO SLIDER START -->
<section class="hero-slider">

  @php
    $heroFallbackSlides = collect([
      [
        'image' => asset('assets/img/hero.png'),
        'badge_icon' => 'bi-mortarboard-fill',
        'badge_text' => 'Women College in Kankarbagh, Patna',
        'title' => 'Empowering Women Through Quality Higher Education',
        'description' => 'Official website of Ganga Devi Mahila Mahavidyalaya with notices, admissions, academics, departments, NAAC / IQAC documents and student support.',
        'primary_button_text' => 'Latest Notices',
        'primary_button_url' => route('frontend.notices.index'),
        'secondary_button_text' => 'Admission Updates',
        'secondary_button_url' => route('frontend.admissions.index'),
      ],
      [
        'image' => asset('assets/img/hero-1.png'),
        'badge_icon' => 'bi-award-fill',
        'badge_text' => 'NAAC Accredited Institution',
        'title' => 'Academic Excellence, Discipline and Student Development',
        'description' => 'Access verified academic resources, syllabus, timetable, examination updates and quality assurance information in a structured format.',
        'primary_button_text' => 'View Academics',
        'primary_button_url' => route('frontend.courses'),
        'secondary_button_text' => 'NAAC / IQAC',
        'secondary_button_url' => route('frontend.naac'),
      ],
      [
        'image' => asset('assets/img/hero-2.png'),
        'badge_icon' => 'bi-building-fill',
        'badge_text' => 'Since 1971',
        'title' => 'Official Documents, Downloads and Public Transparency',
        'description' => 'Quick access to RTI, statutory disclosures, policies, prospectus, notices, circulars and other important public documents.',
        'primary_button_text' => 'Downloads',
        'primary_button_url' => '#',
        'secondary_button_text' => 'RTI / Disclosure',
        'secondary_button_url' => route('frontend.rti'),
      ],
    ]);

    $heroSlides = ($frontendHeroSlides ?? collect())->map(fn ($slide) => [
      'image' => $slide->image ?: asset('assets/img/hero.png'),
      'badge_icon' => $slide->badge_icon ?: 'bi-stars',
      'badge_text' => $slide->badge_text,
      'title' => $slide->title,
      'description' => $slide->description,
      'primary_button_text' => $slide->primary_button_text,
      'primary_button_url' => $slide->primary_button_url,
      'secondary_button_text' => $slide->secondary_button_text,
      'secondary_button_url' => $slide->secondary_button_url,
    ]);

    $heroSlides = $heroSlides->isNotEmpty() ? $heroSlides : $heroFallbackSlides;
  @endphp

  @foreach($heroSlides as $heroSlide)
    <div class="hero-slide {{ $loop->first ? 'active' : '' }}">
      <img src="{{ $heroSlide['image'] }}" alt="{{ $heroSlide['title'] }}">

      <div class="container">
        <div class="hero-content">
          @if($heroSlide['badge_text'])
            <span class="hero-badge">
              <i class="bi {{ $heroSlide['badge_icon'] }}"></i>
              {{ $heroSlide['badge_text'] }}
            </span>
          @endif

          <h2>{{ $heroSlide['title'] }}</h2>

          @if($heroSlide['description'])
            <p>{{ $heroSlide['description'] }}</p>
          @endif

          @if($heroSlide['primary_button_text'] || $heroSlide['secondary_button_text'])
            <div class="hero-actions">
              @if($heroSlide['primary_button_text'])
                <a href="{{ $heroSlide['primary_button_url'] ?: '#' }}" class="hero-btn primary">{{ $heroSlide['primary_button_text'] }}</a>
              @endif
              @if($heroSlide['secondary_button_text'])
                <a href="{{ $heroSlide['secondary_button_url'] ?: '#' }}" class="hero-btn light">{{ $heroSlide['secondary_button_text'] }}</a>
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>
  @endforeach

  <div class="hero-controls">
    @foreach($heroSlides as $heroSlide)
      <button class="{{ $loop->first ? 'active' : '' }}" type="button" aria-label="Slide {{ $loop->iteration }}"></button>
    @endforeach
  </div>

</section>
<!-- HERO SLIDER END -->



  <!-- COLLEGE IDENTITY START -->
  <section class="identity-section">
    <div class="container">
      <div class="identity-wrap">

        <div class="college-card">
          <img src="{{ $siteLogo }}" alt="{{ $siteName }}">
          <div>
            <h3>{{ $siteName }}</h3>
            <p>
              {{ $websiteSetting->footer_description ?: 'NAAC accredited women college located at Kankarbagh, Patna, focused on higher education, values and women empowerment.' }}
            </p>
          </div>
        </div>

        <div class="stats-grid">
          <div class="stat-card">
            <strong>1971</strong>
            <span>Established</span>
          </div>

          <div class="stat-card">
            <strong>{{ $frontendStats['departments'] ?: 0 }}</strong>
            <span>Departments</span>
          </div>

          <div class="stat-card">
            <strong>B</strong>
            <span>NAAC Grade</span>
          </div>

          <div class="stat-card">
            <strong>{{ $frontendStats['courses'] ?: 0 }}</strong>
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
            <img src="{{ $principalImage }}" alt="{{ $principalName }}">
          </div>
          <div class="principal-body">
            <span class="section-badge"><i class="bi bi-chat-quote-fill"></i> Principal Message</span>
            <h3>{{ $principalName }}</h3>
            <p>{{ \Illuminate\Support\Str::limit(strip_tags($principalText), 150) }}</p>
            <a href="{{ route('frontend.principal') }}" class="outline-btn">Read Full Message <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="about-card">
          <span class="section-badge"><i class="bi bi-building-fill"></i> {{ $collegeProfile->about_badge ?? 'About College' }}</span>
          <h2 class="section-title">{{ $aboutTitle }}</h2>
          <p class="section-text">{{ \Illuminate\Support\Str::limit(strip_tags($aboutText), 260) }}</p>

          <div class="about-points">
            @foreach($aboutPoints as $point)
              <div class="about-point"><i class="bi bi-check-circle-fill"></i> {{ $point }}</div>
            @endforeach
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

      <a href="{{ route('frontend.courses') }}" class="outline-btn">
        View Academics <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="card-grid-3">
      <a href="{{ route('frontend.courses') }}" class="premium-card">
        <div class="icon-box"><i class="bi bi-mortarboard-fill"></i></div>
        <h4>Courses Offered</h4>
        <p>{{ $frontendCourses->count() }} active courses available.</p>
      </a>

      <a href="{{ route('frontend.departments') }}" class="premium-card">
        <div class="icon-box"><i class="bi bi-building-fill"></i></div>
        <h4>Departments</h4>
        <p>{{ $frontendDepartments->count() }} highlighted departments on website.</p>
      </a>

      <a href="{{ route('frontend.academic-calendar.index') }}" class="premium-card">
        <div class="icon-box"><i class="bi bi-calendar2-week-fill"></i></div>
        <h4>Academic Calendar</h4>
        <p>{{ $frontendAcademicCalendar ? $frontendAcademicCalendar->title : 'Session-wise academic calendar and schedules.' }}</p>
      </a>

      @foreach($frontendCourses->take(1) as $course)
        <a href="{{ route('frontend.courses') }}" class="premium-card">
          <div class="icon-box"><i class="bi bi-journal-bookmark-fill"></i></div>
          <h4>{{ $course->name }}</h4>
          <p>{{ $course->short_description ?: ($course->duration ?: 'View course details and eligibility.') }}</p>
        </a>
      @endforeach

      <a href="{{ route('frontend.examination') }}" class="premium-card">
        <div class="icon-box"><i class="bi bi-clipboard-check-fill"></i></div>
        <h4>Examination</h4>
        <p>Exam notices, schedules, forms and result links.</p>
      </a>

      <a href="{{ route('frontend.syllabus.index') }}" class="premium-card">
        <div class="icon-box"><i class="bi bi-file-earmark-text-fill"></i></div>
        <h4>Syllabus</h4>
        <p>{{ $frontendSyllabusDocuments->count() }} featured syllabus documents.</p>
      </a>
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

      <a href="{{ route('frontend.naac') }}" class="outline-btn">
        View NAAC / IQAC <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="card-grid-3">
      @forelse($frontendNaacDocuments as $document)
        <a href="{{ $document->download_url ?: route('frontend.naac') }}"
           class="premium-card"
           @if($document->download_url) target="_blank" rel="noopener" @endif>
          <div class="icon-box"><i class="bi bi-file-earmark-pdf-fill"></i></div>
          <h4>{{ $document->title }}</h4>
          <p>{{ $document->category ?: 'NAAC / IQAC document' }} @if($document->year) | {{ $document->year }} @endif</p>
        </a>
      @empty
        <a href="{{ route('frontend.naac') }}" class="premium-card">
          <div class="icon-box"><i class="bi bi-people-fill"></i></div>
          <h4>IQAC Composition</h4>
          <p>Members, coordinators and quality cell details.</p>
        </a>

        <a href="{{ route('frontend.naac') }}" class="premium-card">
          <div class="icon-box"><i class="bi bi-file-earmark-pdf-fill"></i></div>
          <h4>AQAR Reports</h4>
          <p>Annual quality assurance reports and records.</p>
        </a>

        <a href="{{ route('frontend.naac') }}" class="premium-card">
          <div class="icon-box"><i class="bi bi-award-fill"></i></div>
          <h4>NAAC Documents</h4>
          <p>SSR, DVV, certificates and accreditation files.</p>
        </a>
      @endforelse
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

          @forelse($frontendDownloadItems as $downloadItem)
            <a href="{{ $downloadItem->download_url }}" target="_blank" rel="noopener" class="download-row">
              <i class="bi bi-file-earmark-pdf-fill"></i>
              <div>
                <strong>{{ $downloadItem->title }}</strong>
                <span>{{ $downloadItem->category ?? $downloadItem->document_type ?? 'Official document' }}</span>
              </div>
            </a>
          @empty
            <a href="{{ route('frontend.syllabus.index') }}" class="download-row">
              <i class="bi bi-journal-text"></i>
              <div>
                <strong>Syllabus</strong>
                <span>Course-wise syllabus documents</span>
              </div>
            </a>

            <a href="{{ route('frontend.naac') }}" class="download-row">
              <i class="bi bi-award-fill"></i>
              <div>
                <strong>NAAC / IQAC</strong>
                <span>Quality assurance and accreditation documents</span>
              </div>
            </a>

            <a href="{{ route('frontend.rti') }}" class="download-row">
              <i class="bi bi-file-earmark-text-fill"></i>
              <div>
                <strong>RTI Documents</strong>
                <span>Public disclosure and RTI files</span>
              </div>
            </a>
          @endforelse
        </div>

        <div class="contact-box">
          <span class="section-badge"><i class="bi bi-headset"></i> Contact Information</span>
          <h2 class="section-title">Get in Touch With College Office</h2>

          <div class="contact-row">
            <i class="bi bi-geo-alt-fill"></i>
            <div>
              <strong>College Address</strong>
              <span>{{ $siteAddress }}</span>
            </div>
          </div>

          <div class="contact-row">
            <i class="bi bi-envelope-fill"></i>
            <div>
              <strong>Email Address</strong>
              <span>{{ $siteEmail }}</span>
            </div>
          </div>

          <div class="contact-row">
            <i class="bi bi-telephone-fill"></i>
            <div>
              <strong>Office Contact</strong>
              <span>{{ $sitePhone }}</span>
            </div>
          </div>

          <div class="contact-row">
            <i class="bi bi-clock-fill"></i>
            <div>
              <strong>Office Timing</strong>
              <span>{{ $officeTiming }}</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
  <!-- DOWNLOADS + CONTACT END -->



@endsection

