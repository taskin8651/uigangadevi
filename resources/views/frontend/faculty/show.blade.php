@extends('frontend.master')

@section('title', $facultyMember->name . ' - Faculty Profile')

@section('content')

@php
    $departmentName = optional($facultyMember->subject)->department_name
        ?: optional($facultyMember->subject)->name
        ?: 'Faculty Member';

    $profileGroups = [
        [
            'title' => 'Qualifications',
            'icon' => 'bi-mortarboard-fill',
            'items' => $facultyMember->qualifications ?? [],
        ],
        [
            'title' => 'Specializations',
            'icon' => 'bi-stars',
            'items' => $facultyMember->specializations ?? [],
        ],
        [
            'title' => 'Subjects Taught',
            'icon' => 'bi-book-half',
            'items' => $facultyMember->subjects_taught ?? [],
        ],
        [
            'title' => 'Research Interests',
            'icon' => 'bi-search-heart',
            'items' => $facultyMember->research_interests ?? [],
        ],
        [
            'title' => 'Publications',
            'icon' => 'bi-journal-richtext',
            'items' => $facultyMember->publications ?? [],
        ],
        [
            'title' => 'Awards',
            'icon' => 'bi-trophy-fill',
            'items' => $facultyMember->awards ?? [],
        ],
        [
            'title' => 'Responsibilities',
            'icon' => 'bi-clipboard-check-fill',
            'items' => $facultyMember->responsibilities ?? [],
        ],
        [
            'title' => 'Memberships',
            'icon' => 'bi-people-fill',
            'items' => $facultyMember->memberships ?? [],
        ],
        [
            'title' => 'Seminars',
            'icon' => 'bi-easel2-fill',
            'items' => $facultyMember->seminars ?? [],
        ],
    ];

    $visibleGroups = collect($profileGroups)->map(function ($group) {
        $group['items'] = collect($group['items'] ?? [])->filter(function ($item) {
            if (is_array($item)) {
                return !empty($item['text']) && !empty($item['status']);
            }

            return !empty($item);
        });

        return $group;
    })->filter(function ($group) {
        return $group['items']->isNotEmpty();
    });
@endphp

<main class="faculty-profile-page">

    <section class="faculty-profile-hero">
        <div class="container">
            <div class="faculty-profile-hero-grid">

                <div class="faculty-profile-photo">
                    <img
                        src="{{ $facultyMember->image ?: asset('assets/img/dep.jpeg') }}"
                        alt="{{ $facultyMember->name }}"
                    >
                </div>

                <div class="faculty-profile-intro">
                    <span class="faculty-list-badge">
                        <i class="bi bi-person-badge-fill"></i>
                        {{ $departmentName }}
                    </span>

                    <h1>{{ $facultyMember->name }}</h1>

                    <p class="faculty-profile-role">
                        {{ $facultyMember->designation ?: 'Faculty Member' }}
                    </p>

                    @if($facultyMember->short_description)
                        <p class="faculty-profile-summary">
                            {{ $facultyMember->short_description }}
                        </p>
                    @endif

                    <div class="faculty-profile-actions">
                        @if($facultyMember->cv)
                            <a href="{{ $facultyMember->cv['url'] }}"
                               class="course-btn primary"
                               target="_blank"
                               rel="noopener">
                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                Download CV
                            </a>
                        @endif

                        @if($facultyMember->subject)
                            <a href="{{ route('frontend.departments.show', $facultyMember->subject->slug) }}"
                               class="course-btn light">
                                <i class="bi bi-diagram-3-fill"></i>
                                View Department
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="faculty-profile-section">
        <div class="container">
            <div class="faculty-profile-layout">

                <aside class="faculty-profile-sidebar">
                    <div class="faculty-profile-side-card">
                        <h2>Profile Details</h2>

                        <div class="faculty-profile-facts">
                            @if($facultyMember->faculty_category)
                                <div>
                                    <i class="bi bi-person-vcard"></i>
                                    <span>Category</span>
                                    <strong>{{ $facultyMember->faculty_category }}</strong>
                                </div>
                            @endif

                            @if($facultyMember->employee_id)
                                <div>
                                    <i class="bi bi-hash"></i>
                                    <span>Employee ID</span>
                                    <strong>{{ $facultyMember->employee_id }}</strong>
                                </div>
                            @endif

                            @if($facultyMember->teaching_experience)
                                <div>
                                    <i class="bi bi-award"></i>
                                    <span>Teaching Experience</span>
                                    <strong>{{ $facultyMember->teaching_experience }}</strong>
                                </div>
                            @endif

                            @if($facultyMember->research_experience)
                                <div>
                                    <i class="bi bi-lightbulb-fill"></i>
                                    <span>Research Experience</span>
                                    <strong>{{ $facultyMember->research_experience }}</strong>
                                </div>
                            @endif

                            @if($facultyMember->joining_date)
                                <div>
                                    <i class="bi bi-calendar-check-fill"></i>
                                    <span>Joining Date</span>
                                    <strong>{{ $facultyMember->joining_date->format('d M Y') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($facultyMember->email || $facultyMember->phone)
                        <div class="faculty-profile-side-card">
                            <h2>Contact</h2>

                            <div class="faculty-contact-list">
                                @if($facultyMember->email)
                                    <a href="mailto:{{ $facultyMember->email }}">
                                        <i class="bi bi-envelope-fill"></i>
                                        {{ $facultyMember->email }}
                                    </a>
                                @endif

                                @if($facultyMember->phone)
                                    <a href="tel:{{ $facultyMember->phone }}">
                                        <i class="bi bi-telephone-fill"></i>
                                        {{ $facultyMember->phone }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </aside>

                <div class="faculty-profile-main">
                    <div class="faculty-profile-content-card">
                        <span class="course-section-badge">
                            <i class="bi bi-person-lines-fill"></i>
                            Faculty Introduction
                        </span>

                        <h2>About {{ $facultyMember->name }}</h2>

                        <div class="course-rich-content">
                            @if($facultyMember->biography)
                                {!! $facultyMember->biography !!}
                            @elseif($facultyMember->short_description)
                                <p>{{ $facultyMember->short_description }}</p>
                            @else
                                <p>Faculty profile details will be updated soon.</p>
                            @endif
                        </div>
                    </div>

                    @if($visibleGroups->isNotEmpty())
                        <div class="faculty-profile-group-grid">
                            @foreach($visibleGroups as $group)
                                <div class="faculty-profile-content-card">
                                    <span class="course-section-badge">
                                        <i class="bi {{ $group['icon'] }}"></i>
                                        {{ $group['title'] }}
                                    </span>

                                    <ul class="faculty-profile-list">
                                        @foreach($group['items'] as $item)
                                            <li>
                                                <i class="bi bi-check-circle-fill"></i>
                                                <span>{{ is_array($item) ? $item['text'] : $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    @if($relatedFaculty->isNotEmpty())
        <section class="faculty-list-section">
            <div class="container">
                <div class="faculty-list-head text-center">
                    <span class="faculty-list-badge">
                        <i class="bi bi-people-fill"></i>
                        Related Faculty
                    </span>

                    <h2>More From {{ $departmentName }}</h2>
                </div>

                <div class="faculty-list-grid">
                    @foreach($relatedFaculty as $related)
                        <div class="faculty-card">
                            <div class="faculty-photo">
                                <img
                                    src="{{ $related->image ?: asset('assets/img/dep.jpeg') }}"
                                    alt="{{ $related->name }}"
                                >
                            </div>

                            <div class="faculty-info">
                                <span class="faculty-dept">
                                    {{ optional($related->subject)->department_name ?: optional($related->subject)->name ?: 'Faculty' }}
                                </span>

                                <h3>{{ $related->name }}</h3>

                                @if($related->designation)
                                    <p>{{ $related->designation }}</p>
                                @endif

                                <a href="{{ route('frontend.faculty.show', $related->slug) }}"
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

</main>

@endsection
