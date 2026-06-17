@extends('frontend.master')

@section('title', 'Student Activities - Ganga Devi Mahila Mahavidyalaya')

@section('content')

<main>
    <section class="activities-section">
        <div class="container">

            <div class="activities-head text-center">
                <span class="activities-badge">
                    <i class="bi bi-stars"></i>
                    Student Activities
                </span>

                <h2>Academic & Co-curricular Activities</h2>

                <p>
                    Explore academic, cultural, social, sports and development activities.
                </p>
            </div>

            @if($categories->isNotEmpty())
                <div class="faculty-filter-box">
                    <a href="#" class="active">All Activities</a>
                    @foreach($categories as $category)
                        <a href="#">{{ $category }}</a>
                    @endforeach
                </div>
            @endif

            <div class="activities-grid">
                @forelse($studentActivities as $studentActivity)
                    <div class="activity-card {{ $studentActivity->is_featured ? 'featured' : '' }}">
                        <div class="activity-image">
                            <img
                                src="{{ $studentActivity->image ?: asset('assets/img/activities.jpeg') }}"
                                alt="{{ $studentActivity->title }}"
                            >
                            <span>{{ $studentActivity->category ?: 'Activity' }}</span>
                        </div>

                        <div class="activity-content">
                            <div class="activity-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <h3>{{ $studentActivity->title }}</h3>

                            <p>
                                {{ $studentActivity->short_description
                                    ?: 'View activity details and gallery.' }}
                            </p>

                            <a href="{{ route('frontend.activities.show', $studentActivity->slug) }}"
                               class="activity-link">
                                View Details <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="activity-card featured">
                        <div class="activity-image">
                            <img src="{{ asset('assets/img/activities.jpeg') }}" alt="Student Activities">
                            <span>Activities</span>
                        </div>

                        <div class="activity-content">
                            <div class="activity-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <h3>Activities will be updated soon</h3>

                            <p>
                                Activity information will appear here after updates.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
</main>

@endsection
