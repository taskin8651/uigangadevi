@extends('frontend.master')

@section('title', $studentActivity->title . ' - Student Activity')

@section('content')

@php
    $activeHighlights = collect($studentActivity->activity_highlights ?? [])
        ->filter(fn ($item) => is_array($item) && !empty($item['text']) && !empty($item['status']));

    $activeOutcomes = collect($studentActivity->learning_outcomes ?? [])
        ->filter(fn ($item) => is_array($item) && !empty($item['text']) && !empty($item['status']));

    $activeParticipants = collect($studentActivity->participants ?? [])
        ->filter(fn ($item) => is_array($item) && !empty($item['text']) && !empty($item['status']));
@endphp

<main class="courses-page">

    <section class="course-hero activity-detail-hero">
        <div class="course-hero-bg">
            <img
                src="{{ $studentActivity->image ?: asset('assets/img/activities.jpeg') }}"
                alt="{{ $studentActivity->title }}"
            >
        </div>

        <div class="container">
            <div class="course-hero-content">
                <span class="course-badge">
                    <i class="bi bi-stars"></i>
                    {{ $studentActivity->category ?: 'Student Activity' }}
                </span>

                <h1>{{ $studentActivity->title }}</h1>

                <p>
                    {{ $studentActivity->short_description
                        ?: 'Academic and co-curricular activity details of Ganga Devi Mahila Mahavidyalaya.' }}
                </p>

                <div class="course-hero-actions">
                    <a href="{{ route('frontend.departments') }}"
                       class="course-btn light">
                        <i class="bi bi-arrow-left"></i>
                        Back to Departments
                    </a>

                    @if($studentActivity->document)
                        <a href="{{ $studentActivity->document['url'] }}"
                           class="course-btn primary"
                           target="_blank"
                           rel="noopener">
                            <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            Download Document
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="course-intro-section">
        <div class="container">
            <div class="course-intro-grid">

                <div class="course-intro-card">
                    <span class="course-section-badge">
                        <i class="bi bi-journal-text"></i>
                        Activity Details
                    </span>

                    <h2>{{ $studentActivity->title }}</h2>

                    <div class="course-rich-content">
                        @if($studentActivity->description)
                            {!! $studentActivity->description !!}
                        @elseif($studentActivity->short_description)
                            <p>{{ $studentActivity->short_description }}</p>
                        @else
                            <p>Detailed activity information will be updated soon.</p>
                        @endif
                    </div>
                </div>

                <div class="course-admission-card">
                    <div class="course-admission-icon">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>

                    <h3>Activity Information</h3>

                    @if($studentActivity->activity_date)
                        <p>
                            <strong>Date:</strong>
                            {{ $studentActivity->activity_date->format('d M Y') }}
                        </p>
                    @endif

                    @if($studentActivity->venue)
                        <p>
                            <strong>Venue:</strong>
                            {{ $studentActivity->venue }}
                        </p>
                    @endif

                    @if($studentActivity->organizer)
                        <p>
                            <strong>Organizer:</strong>
                            {{ $studentActivity->organizer }}
                        </p>
                    @endif

                    @if($studentActivity->guest_name)
                        <p>
                            <strong>Guest/Speaker:</strong>
                            {{ $studentActivity->guest_name }}
                        </p>
                    @endif
                </div>

            </div>
        </div>
    </section>

    @php
        $groups = [
            [
                'title' => 'Activity Highlights',
                'badge' => 'Highlights',
                'icon' => 'bi-star-fill',
                'items' => $activeHighlights,
            ],
            [
                'title' => 'Learning Outcomes',
                'badge' => 'Outcomes',
                'icon' => 'bi-lightbulb-fill',
                'items' => $activeOutcomes,
            ],
            [
                'title' => 'Participants',
                'badge' => 'Participation',
                'icon' => 'bi-people-fill',
                'items' => $activeParticipants,
            ],
        ];
    @endphp

    @foreach($groups as $group)
        @if($group['items']->isNotEmpty())
            <section class="course-subject-section">
                <div class="container">
                    <div class="course-section-title text-center">
                        <span class="course-section-badge">
                            <i class="bi {{ $group['icon'] }}"></i>
                            {{ $group['badge'] }}
                        </span>

                        <h2>{{ $group['title'] }}</h2>
                    </div>

                    <div class="course-subject-grid">
                        @foreach($group['items'] as $item)
                            <div class="course-subject-card">
                                <i class="bi bi-check-circle-fill"></i>
                                <h4>{{ $item['text'] }}</h4>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    @if(!empty($studentActivity->gallery))
        <section class="activity-gallery-section">
            <div class="container">
                <div class="course-section-title text-center">
                    <span class="course-section-badge">
                        <i class="bi bi-images"></i>
                        Gallery
                    </span>

                    <h2>Activity Photos</h2>
                </div>

                <div class="activity-gallery-grid">
                    @foreach($studentActivity->gallery as $image)
                        <a href="{{ $image['url'] }}"
                           target="_blank"
                           rel="noopener"
                           class="activity-gallery-item">
                            <img src="{{ $image['url'] }}" alt="{{ $studentActivity->title }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($relatedActivities->isNotEmpty())
        <section class="activities-section">
            <div class="container">
                <div class="activities-head text-center">
                    <span class="activities-badge">
                        <i class="bi bi-stars"></i>
                        Related Activities
                    </span>

                    <h2>More Activities</h2>
                </div>

                <div class="activities-grid">
                    @foreach($relatedActivities as $relatedActivity)
                        <div class="activity-card {{ $relatedActivity->is_featured ? 'featured' : '' }}">
                            <div class="activity-image">
                                <img
                                    src="{{ $relatedActivity->image ?: asset('assets/img/activities.jpeg') }}"
                                    alt="{{ $relatedActivity->title }}"
                                >
                                <span>{{ $relatedActivity->category ?: 'Activity' }}</span>
                            </div>

                            <div class="activity-content">
                                <div class="activity-icon">
                                    <i class="bi bi-stars"></i>
                                </div>

                                <h3>{{ $relatedActivity->title }}</h3>

                                <p>
                                    {{ $relatedActivity->short_description
                                        ?: 'View activity details and gallery.' }}
                                </p>

                                <a href="{{ route('frontend.activities.show', $relatedActivity->slug) }}"
                                   class="activity-link">
                                    View Details <i class="bi bi-arrow-right"></i>
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
