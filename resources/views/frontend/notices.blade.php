@extends('frontend.master')
    
@section('content')



<!-- ================= SEARCHABLE NOTICE ARCHIVE SECTION START ================= -->

<section class="notice-archive-section">
  <div class="container">

    <div class="notice-archive-head text-center">
      <span class="notice-archive-badge">
        <i class="bi bi-search"></i>
        Notice Archive
      </span>

      <h2>Searchable Notice Archive</h2>

      <p>
        Search, filter and access previous notices, circulars, admission updates,
        examination notifications and student announcements.
      </p>
    </div>

    <div class="notice-archive-search-box">

      <div class="notice-search-field">
        <i class="bi bi-search"></i>
        <input type="text" id="noticeSearchInput" placeholder="Search notice by title, category or keyword...">
      </div>

      <select id="noticeCategoryFilter">
        <option value="all">All Categories</option>
        @foreach($categories as $category => $categoryData)
          <option value="{{ \Illuminate\Support\Str::slug($category) }}">
            {{ $category }}
          </option>
        @endforeach
      </select>

      <select id="noticeYearFilter">
        <option value="all">All Years</option>
        @foreach($years as $year)
          <option value="{{ $year }}">
            {{ $year }}
          </option>
        @endforeach
      </select>

    </div>

    <div class="notice-archive-wrapper">

      <div class="notice-archive-feature">
        <div class="notice-archive-icon">
          <i class="bi bi-folder2-open"></i>
        </div>

        <span>Archive Support</span>

        <h3>Find old notices quickly with search and filters.</h3>

        <p>
          This archive helps students access previous official notices, circulars,
          academic updates and important college announcements in an organized format.
        </p>

        <div class="notice-archive-points">
          <div>
            <i class="bi bi-check2-circle"></i>
            Category-wise notice filter
          </div>

          <div>
            <i class="bi bi-check2-circle"></i>
            Year-wise archive search
          </div>

          <div>
            <i class="bi bi-check2-circle"></i>
            Quick PDF download links
          </div>
        </div>
      </div>

      <div class="notice-archive-list" id="noticeArchiveList">

        @forelse($notices as $notice)
          @php
            $category = $notice->category ?: 'Other';
            $categoryKey = \Illuminate\Support\Str::slug($category);
            $noticeDate = $notice->notice_date;
            $noticeYear = $noticeDate ? $noticeDate->format('Y') : '';
            $noticeLink = $notice->download_url ?: '#';
          @endphp

          <a href="{{ $noticeLink }}"
             class="archive-notice-item {{ $notice->download_url ? '' : 'disabled' }}"
             data-title="{{ \Illuminate\Support\Str::lower($notice->title . ' ' . $category . ' ' . $notice->short_description) }}"
             data-category="{{ $categoryKey }}"
             data-year="{{ $noticeYear }}"
             @if($notice->download_url) target="_blank" rel="noopener" @endif>
            <div class="archive-date">
              <strong>{{ $noticeDate ? $noticeDate->format('d') : '--' }}</strong>
              <span>{{ $noticeDate ? $noticeDate->format('M') : 'Date' }}</span>
              <small>{{ $noticeDate ? $noticeDate->format('Y') : 'N/A' }}</small>
            </div>

            <div class="archive-content">
              <div class="archive-top">
                <span class="archive-category {{ $categoryKey }}">{{ $category }}</span>
                <small>
                  @if($notice->document)
                    <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                  @elseif($notice->external_url)
                    <i class="bi bi-box-arrow-up-right"></i> Link
                  @elseif($notice->is_latest)
                    <i class="bi bi-clock-fill"></i> Latest
                  @else
                    <i class="bi bi-file-earmark-text-fill"></i> Notice
                  @endif
                </small>
              </div>

              <h3>{{ $notice->title }}</h3>

              <p>
                {{ $notice->short_description ?: 'Official notice details and related information are available for students and visitors.' }}
              </p>
            </div>

            <div class="archive-action">
              <i class="bi {{ $notice->download_url ? 'bi-download' : 'bi-file-earmark-text' }}"></i>
            </div>
          </a>
        @empty
          <div class="notice-empty-state">
            <i class="bi bi-folder-x"></i>
            <h3>No notices available</h3>
            <p>Latest notices and circulars will appear here once published.</p>
          </div>
        @endforelse

      </div>

    </div>

    <div class="notice-no-result" id="noticeNoResult">
      <i class="bi bi-search"></i>
      <h4>No notice found</h4>
      <p>Please try another keyword, category or year filter.</p>
    </div>

  </div>
</section>

<!-- ================= SEARCHABLE NOTICE ARCHIVE SECTION END ================= -->





<!-- ================= NOTICE CATEGORIES SECTION START ================= -->

<section class="notice-categories-section">
  <div class="container">

    <div class="notice-categories-head text-center">
      <span class="notice-categories-badge">
        <i class="bi bi-grid-1x2-fill"></i>
        Notice Categories
      </span>

      <h2>Browse Notices by Category</h2>

      <p>
        Quickly access admission, examination, scholarship, tender, recruitment,
        holiday, government orders, circulars and other official college notices.
      </p>
    </div>

    <div class="notice-categories-wrapper">

      <div class="notice-categories-feature">
        <div class="notice-category-feature-icon">
          <i class="bi bi-folder2-open"></i>
        </div>

        <span>Organized Notice Center</span>

        <h3>Find every official update in the right category.</h3>

        <p>
          This section helps students, parents, faculty and visitors easily browse
          important college information through category-wise notice blocks.
        </p>

        <div class="notice-category-feature-points">
          <div>
            <i class="bi bi-check2-circle"></i>
            Category-wise notice browsing
          </div>

          <div>
            <i class="bi bi-check2-circle"></i>
            Student-friendly quick access
          </div>

          <div>
            <i class="bi bi-check2-circle"></i>
            Official circulars and updates
          </div>
        </div>

        <a href="#noticeArchiveList" class="notice-category-main-btn">
          View Notice Archive <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="notice-categories-grid">

        @foreach($categories as $category => $categoryData)
          @php
            $categoryKey = \Illuminate\Support\Str::slug($category);
            $count = $categoryCounts->get($category, 0);
          @endphp

          <a href="#noticeArchiveList"
             class="notice-category-card"
             data-category-link="{{ $categoryKey }}">
            <div class="notice-category-icon {{ $categoryData['class'] }}">
              <i class="bi {{ $categoryData['icon'] }}"></i>
            </div>

            <div class="notice-category-content">
              <span>{{ $category }}</span>
              <h3>{{ $category }} Notices</h3>
              <p>{{ $categoryData['description'] }}</p>
              <strong>{{ str_pad($count, 2, '0', STR_PAD_LEFT) }} Notices <i class="bi bi-arrow-right"></i></strong>
            </div>
          </a>
        @endforeach

      </div>

    </div>

  </div>
</section>

<!-- ================= NOTICE CATEGORIES SECTION END ================= -->

<style>
  .archive-notice-item.disabled {
    cursor: default;
  }

  .notice-empty-state {
    padding: 55px 20px;
    text-align: center;
  }

  .notice-empty-state > i {
    color: #94a3b8;
    font-size: 48px;
  }

  .notice-empty-state h3 {
    margin: 13px 0 6px;
    color: #1e293b;
    font-size: 22px;
    font-weight: 800;
  }

  .notice-empty-state p {
    margin: 0;
    color: #64748b;
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('noticeSearchInput');
  const categoryFilter = document.getElementById('noticeCategoryFilter');
  const yearFilter = document.getElementById('noticeYearFilter');
  const list = document.getElementById('noticeArchiveList');
  const noResult = document.getElementById('noticeNoResult');
  const categoryCards = document.querySelectorAll('[data-category-link]');

  if (!list) {
    return;
  }

  const items = Array.from(list.querySelectorAll('.archive-notice-item'));

  function filterNotices() {
    const keyword = (searchInput?.value || '').toLowerCase().trim();
    const selectedCategory = categoryFilter?.value || 'all';
    const selectedYear = yearFilter?.value || 'all';
    let visibleCount = 0;

    items.forEach(function (item) {
      const title = item.dataset.title || '';
      const category = item.dataset.category || '';
      const year = item.dataset.year || '';

      const matchesKeyword = keyword === '' || title.includes(keyword);
      const matchesCategory = selectedCategory === 'all' || category === selectedCategory;
      const matchesYear = selectedYear === 'all' || year === selectedYear;
      const isVisible = matchesKeyword && matchesCategory && matchesYear;

      item.style.display = isVisible ? '' : 'none';

      if (isVisible) {
        visibleCount++;
      }
    });

    if (noResult) {
      noResult.style.display = visibleCount === 0 && items.length > 0 ? 'block' : 'none';
    }
  }

  searchInput?.addEventListener('input', filterNotices);
  categoryFilter?.addEventListener('change', filterNotices);
  yearFilter?.addEventListener('change', filterNotices);

  categoryCards.forEach(function (card) {
    card.addEventListener('click', function () {
      if (!categoryFilter) {
        return;
      }

      categoryFilter.value = this.dataset.categoryLink || 'all';
      filterNotices();
    });
  });

  filterNotices();
});
</script>









@endsection
