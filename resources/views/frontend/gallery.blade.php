@extends('frontend.master')

@section('title', 'Gallery - Ganga Devi Mahila Mahavidyalaya')

@section('content')

<!-- ================= PHOTO GALLERY SECTION START ================= -->

<section class="photo-gallery-section">
  <div class="container">

    <div class="photo-gallery-head text-center">
      <span class="photo-gallery-badge">
        <i class="bi bi-images"></i>
        Photo Gallery
      </span>

      <h2>Campus Life & Institutional Gallery</h2>

      <p>
        Explore glimpses of academic activities, campus events, cultural programmes,
        seminars, workshops and institutional moments.
      </p>
    </div>

    <div class="photo-gallery-category-card">
      <div class="photo-gallery-category-head">
        <div>
          <span>Gallery Categories</span>
          <h3>Browse by Category</h3>
          <p>Images and videos are arranged category-wise for easy viewing.</p>
        </div>
      </div>

      <div class="photo-gallery-category-grid">
        <button type="button" class="photo-gallery-category-item active" data-gallery-filter="all">
          <i class="bi bi-grid-fill"></i>
          <h4>All</h4>
          <p>{{ $galleryItems->count() }} items</p>
        </button>

        @forelse($galleryCategories as $category)
          <button type="button" class="photo-gallery-category-item" data-gallery-filter="{{ \Illuminate\Support\Str::slug($category) }}">
            <i class="bi bi-folder-fill"></i>
            <h4>{{ $category }}</h4>
            <p>{{ $galleryItems->where('category', $category)->count() }} items</p>
          </button>
        @empty
          <div class="photo-gallery-category-item">
            <i class="bi bi-folder2-open"></i>
            <h4>No Categories</h4>
            <p>Categories will appear after uploads.</p>
          </div>
        @endforelse
      </div>
    </div>

    <div class="photo-gallery-album-row gallery-dynamic-grid">
      @forelse($imageGalleries as $gallery)
        <a href="{{ $gallery->image ?: '#' }}"
           target="{{ $gallery->image ? '_blank' : '_self' }}"
           rel="{{ $gallery->image ? 'noopener' : '' }}"
           class="photo-gallery-album-card gallery-filter-item"
           data-gallery-category="{{ \Illuminate\Support\Str::slug($gallery->category ?: 'uncategorized') }}">
          <div class="photo-gallery-album-img">
            @if($gallery->image)
              <img src="{{ $gallery->image }}" alt="{{ $gallery->title }}">
            @else
              <div class="gallery-empty-media">
                <i class="bi bi-image"></i>
              </div>
            @endif
          </div>

          <div class="photo-gallery-album-body">
            <span>{{ $gallery->category ?: 'Gallery' }}</span>
            <h3>{{ $gallery->title }}</h3>
            <p>{{ $gallery->description ?: 'View official college gallery image.' }}</p>
          </div>
        </a>
      @empty
        <div class="gallery-empty-state">
          <i class="bi bi-images"></i>
          <h3>No image gallery uploaded yet</h3>
          <p>Approved image gallery items will appear here.</p>
        </div>
      @endforelse
    </div>

  </div>
</section>

<!-- ================= PHOTO GALLERY SECTION END ================= -->



<!-- ================= VIDEO GALLERY SECTION START ================= -->

<section class="video-gallery-section">
  <div class="container">

    <div class="video-gallery-head">
      <div>
        <span class="photo-gallery-badge">
          <i class="bi bi-play-circle-fill"></i>
          Video Gallery
        </span>
        <h2>College Videos</h2>
        <p>Watch official videos from events, academic activities and college programmes.</p>
      </div>
    </div>

    <div class="video-gallery-grid gallery-video-dynamic-grid">
      @forelse($videoGalleries as $gallery)
        <div class="video-gallery-card gallery-filter-item" data-gallery-category="{{ \Illuminate\Support\Str::slug($gallery->category ?: 'uncategorized') }}">
          <div class="video-gallery-frame">
            @if($gallery->video_embed_url)
              <iframe src="{{ $gallery->video_embed_url }}"
                      title="{{ $gallery->title }}"
                      allowfullscreen
                      loading="lazy"
                      referrerpolicy="strict-origin-when-cross-origin"></iframe>
            @elseif($gallery->image)
              <img src="{{ $gallery->image }}" alt="{{ $gallery->title }}">
            @else
              <div class="gallery-empty-media">
                <i class="bi bi-play-circle"></i>
              </div>
            @endif
          </div>

          <div class="video-gallery-body">
            <span>{{ $gallery->category ?: 'Video' }}</span>
            <h3>{{ $gallery->title }}</h3>
            <p>{{ $gallery->description ?: 'Watch official college video.' }}</p>
            @if($gallery->video_url)
              <a href="{{ $gallery->video_url }}" target="_blank" rel="noopener">
                Open Video <i class="bi bi-box-arrow-up-right"></i>
              </a>
            @endif
          </div>
        </div>
      @empty
        <div class="gallery-empty-state">
          <i class="bi bi-play-circle-fill"></i>
          <h3>No video gallery uploaded yet</h3>
          <p>Approved video gallery items will appear here.</p>
        </div>
      @endforelse
    </div>

  </div>
</section>

<!-- ================= VIDEO GALLERY SECTION END ================= -->

<style>
  .photo-gallery-category-item {
    border: 0;
    text-align: left;
    cursor: pointer;
  }

  .gallery-dynamic-grid,
  .gallery-video-dynamic-grid {
    align-items: stretch;
  }

  .gallery-empty-media {
    width: 100%;
    height: 100%;
    min-height: 210px;
    display: grid;
    place-items: center;
    background: #f1f5f9;
    color: #64748b;
    font-size: 44px;
  }

  .gallery-empty-state {
    grid-column: 1 / -1;
    padding: 44px 22px;
    text-align: center;
    border-radius: 18px;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
  }

  .gallery-empty-state i {
    font-size: 42px;
    color: #64748b;
  }

  .gallery-empty-state h3 {
    margin: 14px 0 6px;
    color: #0f172a;
    font-size: 22px;
    font-weight: 800;
  }

  .gallery-empty-state p {
    margin: 0;
    color: #64748b;
  }

  .video-gallery-card {
    overflow: hidden;
    border-radius: 18px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
  }

  .video-gallery-frame {
    aspect-ratio: 16 / 9;
    background: #0f172a;
  }

  .video-gallery-frame iframe,
  .video-gallery-frame img {
    width: 100%;
    height: 100%;
    border: 0;
    object-fit: cover;
  }

  .video-gallery-body {
    padding: 18px;
  }

  .video-gallery-body span {
    color: var(--secondary);
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
  }

  .video-gallery-body h3 {
    margin: 7px 0;
    color: #0f172a;
    font-size: 19px;
    font-weight: 900;
  }

  .video-gallery-body p {
    margin: 0 0 12px;
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
  }

  .video-gallery-body a {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--primary);
    font-weight: 800;
  }

  .gallery-filter-item.is-hidden {
    display: none !important;
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('[data-gallery-filter]');
  const items = document.querySelectorAll('.gallery-filter-item');

  buttons.forEach(function (button) {
    button.addEventListener('click', function () {
      const filter = button.dataset.galleryFilter;

      buttons.forEach(function (item) {
        item.classList.remove('active');
      });

      button.classList.add('active');

      items.forEach(function (item) {
        item.classList.toggle(
          'is-hidden',
          filter !== 'all' && item.dataset.galleryCategory !== filter
        );
      });
    });
  });
});
</script>

@endsection
