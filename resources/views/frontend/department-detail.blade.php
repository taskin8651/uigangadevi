@extends('frontend.master')

@section('title', $subject->name . ' Department - Ganga Devi Mahila Mahavidyalaya')

@section('content')

<main class="courses-page">

    {{-- DEPARTMENT HERO --}}
    <section class="course-hero">

        <div class="course-hero-bg">
            <img
                src="{{ $subject->image ?: asset('assets/img/hero.png') }}"
                alt="{{ $subject->name }} Department"
            >
        </div>

        <div class="container">
            <div class="course-hero-content">

                <span class="course-badge">
                    <i class="bi bi-diagram-3-fill"></i>

                    {{ $subject->department_name ?: 'Academic Department' }}
                </span>

                <h1>
                    {{ $subject->name }}
                </h1>

                <p>
                    {{ $subject->short_description ?: 'Explore department information, academic areas, courses, learning outcomes and student resources.' }}
                </p>

                <div class="course-hero-actions">

                    <a href="{{ route('frontend.departments') }}"
                       class="course-btn light">

                        <i class="bi bi-arrow-left"></i>
                        All Departments
                    </a>

                    @if(!empty($subject->syllabus))
                        <a href="{{ $subject->syllabus['url'] }}"
                           class="course-btn primary"
                           target="_blank"
                           rel="noopener">

                            <i class="bi bi-download"></i>
                            Download Syllabus
                        </a>
                    @endif

                </div>

            </div>
        </div>

    </section>

    {{-- DEPARTMENT OVERVIEW --}}
    <section class="course-intro-section">
        <div class="container">

            <div class="course-intro-grid">

                <div class="course-intro-card">

                    <span class="course-section-badge">
                        <i class="bi bi-book-half"></i>
                        Department Overview
                    </span>

                    <h2>
                        {{ $subject->name }} Department
                    </h2>

                    <div class="course-rich-content">
                        @if(!empty($subject->description))
                            {!! $subject->description !!}
                        @else
                            <p>
                                Detailed department information will be updated soon.
                            </p>
                        @endif
                    </div>

                </div>

                <div class="course-admission-card">

                    <div class="course-admission-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>

                    <h3>Available Courses</h3>

                    <p>
                        {{ $subject->courses->count() }} active programme(s)
                        are currently associated with this department.
                    </p>

                    <a href="{{ route('frontend.courses') }}"
                       class="course-text-link">

                        View All Courses
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>
    </section>

    {{-- ASSOCIATED COURSES --}}
    @if($subject->courses->isNotEmpty())

        <section class="course-programmes-section">
            <div class="container">

                <div class="course-section-title text-center">

                    <span class="course-section-badge">
                        <i class="bi bi-journal-richtext"></i>
                        Programmes
                    </span>

                    <h2>Courses Available</h2>

                    <p>
                        Academic programmes connected with the
                        {{ $subject->name }} department.
                    </p>

                </div>

                <div class="course-programmes-grid">

                    @foreach($subject->courses as $course)

                        <div class="course-card">

                            <div class="course-card-icon">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>

                            <span class="course-level">
                                {{ $course->level ?: 'Academic Programme' }}
                            </span>

                            <h3>
                                {{ $course->name }}
                            </h3>

                            <p>
                                {{ $course->short_description ?: 'Programme details are available as per university guidelines.' }}
                            </p>

                            <ul>

                                @if($course->short_name)
                                    <li>
                                        <i class="bi bi-check-circle"></i>
                                        Short Name: {{ $course->short_name }}
                                    </li>
                                @endif

                                @if($course->duration)
                                    <li>
                                        <i class="bi bi-check-circle"></i>
                                        Duration: {{ $course->duration }}
                                    </li>
                                @endif

                                @if($course->course_type)
                                    <li>
                                        <i class="bi bi-check-circle"></i>
                                        Type: {{ $course->course_type }}
                                    </li>
                                @endif

                            </ul>

                            <a href="{{ route('frontend.departments.show', $course->slug) }}"
                               class="course-card-link">

                                View Course
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>

                    @endforeach

                </div>

            </div>
        </section>

        {{-- EACH COURSE COMPLETE INFORMATION --}}
        @foreach($subject->courses as $course)

            @php
                $courseHighlights = collect(
                    $course->highlights ?? []
                )->filter(function ($highlight) {
                    return is_array($highlight)
                        && !empty($highlight['text'])
                        && !empty($highlight['status']);
                });
            @endphp

            <section class="course-intro-section">
                <div class="container">

                    <div class="course-section-title text-center">

                        <span class="course-section-badge">
                            <i class="bi bi-mortarboard-fill"></i>

                            {{ $course->level ?: 'Course Details' }}
                        </span>

                        <h2>
                            {{ $course->name }}
                        </h2>

                        @if($course->short_description)
                            <p>
                                {{ $course->short_description }}
                            </p>
                        @endif

                    </div>

                    @if($course->image)
                        <div class="text-center mb-4">

                            <img
                                src="{{ $course->image }}"
                                alt="{{ $course->name }}"
                                class="img-fluid rounded"
                                style="max-height:420px;width:100%;object-fit:cover;"
                            >

                        </div>
                    @endif

                    <div class="course-intro-grid">

                        <div class="course-intro-card">

                            <span class="course-section-badge">
                                <i class="bi bi-journal-text"></i>
                                Description
                            </span>

                            <h2>Course Description</h2>

                            <div class="course-rich-content">
                                @if($course->description)
                                    {!! $course->description !!}
                                @else
                                    <p>
                                        Detailed course description will be updated soon.
                                    </p>
                                @endif
                            </div>

                        </div>

                        <div class="course-admission-card">

                            <div class="course-admission-icon">
                                <i class="bi bi-info-circle-fill"></i>
                            </div>

                            <h3>Course Information</h3>

                            @if($course->short_name)
                                <p>
                                    <strong>Short Name:</strong>
                                    {{ $course->short_name }}
                                </p>
                            @endif

                            @if($course->level)
                                <p>
                                    <strong>Level:</strong>
                                    {{ $course->level }}
                                </p>
                            @endif

                            @if($course->duration)
                                <p>
                                    <strong>Duration:</strong>
                                    {{ $course->duration }}
                                </p>
                            @endif

                            @if($course->course_type)
                                <p>
                                    <strong>Course Type:</strong>
                                    {{ $course->course_type }}
                                </p>
                            @endif

                        </div>

                    </div>

                    <div class="course-intro-grid mt-4">

                        <div class="course-intro-card">

                            <span class="course-section-badge">
                                <i class="bi bi-person-check-fill"></i>
                                Eligibility
                            </span>

                            <h2>Admission Eligibility</h2>

                            <div class="course-rich-content">
                                @if($course->eligibility)
                                    {!! $course->eligibility !!}
                                @else
                                    <p>
                                        Eligibility information will be updated soon.
                                    </p>
                                @endif
                            </div>

                        </div>

                        <div class="course-intro-card">

                            <span class="course-section-badge">
                                <i class="bi bi-list-check"></i>
                                Admission Process
                            </span>

                            <h2>How to Apply</h2>

                            <div class="course-rich-content">
                                @if($course->admission_process)
                                    {!! $course->admission_process !!}
                                @else
                                    <p>
                                        Admission process information will be updated soon.
                                    </p>
                                @endif
                            </div>

                        </div>

                    </div>

                    @if($courseHighlights->isNotEmpty())

                        <div class="course-section-title text-center mt-5">

                            <span class="course-section-badge">
                                <i class="bi bi-stars"></i>
                                Course Highlights
                            </span>

                            <h2>Programme Highlights</h2>

                        </div>

                        <div class="course-subject-grid">

                            @foreach($courseHighlights as $highlight)

                                <div class="course-subject-card">
                                    <i class="bi bi-check-circle-fill"></i>

                                    <h4>
                                        {{ $highlight['text'] }}
                                    </h4>
                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>
            </section>

        @endforeach

    @endif

    {{-- DEPARTMENT FACULTY --}}
    @if($subject->facultyMembers->isNotEmpty())

        <section class="faculty-list-section">
            <div class="container">

                <div class="faculty-list-head text-center">
                    <span class="faculty-list-badge">
                        <i class="bi bi-person-badge-fill"></i>
                        Department Faculty
                    </span>

                    <h2>
                        Faculty Members of {{ $subject->name }}
                    </h2>

                    <p>
                        Meet the teaching faculty associated with this department.
                    </p>
                </div>

                <div class="faculty-list-grid">

                    @foreach($subject->facultyMembers as $facultyMember)

                        <div class="faculty-card">

                            <div class="faculty-photo">
                                <img
                                    src="{{ $facultyMember->image ?: asset('assets/img/dep.jpeg') }}"
                                    alt="{{ $facultyMember->name }}"
                                >
                            </div>

                            <div class="faculty-info">

                                <span class="faculty-dept">
                                    {{ $subject->department_name ?: $subject->name }}
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

                                    @if($facultyMember->teaching_experience)
                                        <span>
                                            <i class="bi bi-award"></i>
                                            {{ $facultyMember->teaching_experience }} Teaching Experience
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

    {{-- SUBJECT DETAIL GROUPS --}}
    @php
        $detailGroups = [
            [
                'title' => 'Academic Areas',
                'badge' => 'Areas of Study',
                'icon'  => 'bi-book-half',
                'items' => $subject->academic_areas ?? [],
            ],
            [
                'title' => 'Learning Outcomes',
                'badge' => 'Student Outcomes',
                'icon'  => 'bi-lightbulb-fill',
                'items' => $subject->learning_outcomes ?? [],
            ],
            [
                'title' => 'Career Opportunities',
                'badge' => 'Career Scope',
                'icon'  => 'bi-briefcase-fill',
                'items' => $subject->career_opportunities ?? [],
            ],
        ];
    @endphp

    @foreach($detailGroups as $group)

        @php
            $activeItems = collect(
                $group['items'] ?? []
            )->filter(function ($item) {
                return is_array($item)
                    && !empty($item['text'])
                    && !empty($item['status']);
            });
        @endphp

        @if($activeItems->isNotEmpty())

            <section class="course-subject-section">
                <div class="container">

                    <div class="course-section-title text-center">

                        <span class="course-section-badge">
                            <i class="bi {{ $group['icon'] }}"></i>
                            {{ $group['badge'] }}
                        </span>

                        <h2>
                            {{ $group['title'] }}
                        </h2>

                    </div>

                    <div class="course-subject-grid">

                        @foreach($activeItems as $item)

                            <div class="course-subject-card">
                                <i class="bi bi-check-circle-fill"></i>

                                <h4>
                                    {{ $item['text'] }}
                                </h4>
                            </div>

                        @endforeach

                    </div>

                </div>
            </section>

        @endif

    @endforeach

</main>

@endsection
