<section class="disclosure-section">
    <div class="container">
        <div class="disclosure-head text-center">
            <span class="disclosure-badge">
                <i class="bi {{ $badgeIcon }}"></i>
                {{ $pageTitle }}
            </span>
            <h2>{{ $pageTitle }} Documents</h2>
            <p>{{ $pageSubtitle }}</p>
        </div>

        @if($categories->isNotEmpty())
            <div class="disclosure-categories">
                <button type="button" class="active" data-disclosure-filter="all">All</button>
                @foreach($categories as $category)
                    <button type="button" data-disclosure-filter="{{ \Illuminate\Support\Str::slug($category) }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        @endif

        <div class="disclosure-card">
            <div class="disclosure-card-head">
                <div>
                    <span>{{ $sectionTitle }}</span>
                    <h3>Available Documents</h3>
                </div>
                <strong>{{ $documents->count() }} Items</strong>
            </div>

            <div class="disclosure-list">
                @forelse($documents as $document)
                    <div class="disclosure-item" data-disclosure-category="{{ \Illuminate\Support\Str::slug($document->category ?: 'general') }}">
                        <div class="disclosure-icon">
                            <i class="bi bi-file-earmark-arrow-down-fill"></i>
                        </div>
                        <div>
                            <span>{{ $document->category ?: 'General' }} @if($document->year) | {{ $document->year }} @endif</span>
                            <h4>{{ $document->title }}</h4>
                        </div>
                        @if($document->download_url)
                            <a href="{{ $document->download_url }}" target="_blank" rel="noopener">
                                Open <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        @else
                            <small>Not uploaded</small>
                        @endif
                    </div>
                @empty
                    <div class="disclosure-empty">
                        <i class="bi bi-folder2-open"></i>
                        <h3>No documents uploaded yet</h3>
                        <p>Approved documents will appear here.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<style>
    .disclosure-section {
        padding: 84px 0;
        background: #f8fafc;
    }

    .disclosure-head {
        max-width: 760px;
        margin: 0 auto 28px;
    }

    .disclosure-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: #e0f2fe;
        color: #0369a1;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .disclosure-head h2 {
        margin: 0 0 10px;
        color: #0f172a;
        font-size: 38px;
        font-weight: 900;
    }

    .disclosure-head p {
        margin: 0;
        color: #64748b;
        font-size: 16px;
        line-height: 1.7;
    }

    .disclosure-categories {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-bottom: 24px;
    }

    .disclosure-categories button {
        border: 1px solid #dbeafe;
        border-radius: 999px;
        padding: 9px 14px;
        background: #fff;
        color: #1d4ed8;
        font-weight: 800;
    }

    .disclosure-categories button.active {
        background: #1d4ed8;
        color: #fff;
    }

    .disclosure-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 18px 42px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .disclosure-card-head,
    .disclosure-item {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 18px;
        align-items: center;
        padding: 20px 24px;
    }

    .disclosure-card-head {
        border-bottom: 1px solid #e5e7eb;
        background: #f8fafc;
    }

    .disclosure-card-head span,
    .disclosure-item span {
        color: #2563eb;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .disclosure-card-head h3,
    .disclosure-item h4 {
        margin: 4px 0 0;
        color: #0f172a;
        font-weight: 900;
    }

    .disclosure-list {
        display: grid;
    }

    .disclosure-item {
        grid-template-columns: 52px 1fr auto;
        border-bottom: 1px solid #eef2f7;
    }

    .disclosure-item:last-child {
        border-bottom: 0;
    }

    .disclosure-icon {
        width: 44px;
        height: 44px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 20px;
    }

    .disclosure-item a {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 13px;
        border-radius: 999px;
        background: #16a34a;
        color: #fff;
        font-weight: 800;
    }

    .disclosure-empty {
        padding: 44px 20px;
        text-align: center;
        color: #64748b;
    }

    .disclosure-empty i {
        font-size: 42px;
    }

    .disclosure-empty h3 {
        margin: 12px 0 6px;
        color: #0f172a;
        font-weight: 900;
    }

    .disclosure-item.is-hidden {
        display: none;
    }

    @media (max-width: 700px) {
        .disclosure-card-head,
        .disclosure-item {
            grid-template-columns: 1fr;
        }

        .disclosure-item {
            gap: 12px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('[data-disclosure-filter]');
    const items = document.querySelectorAll('.disclosure-item');

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            const filter = button.dataset.disclosureFilter;

            buttons.forEach(function (item) {
                item.classList.remove('active');
            });

            button.classList.add('active');

            items.forEach(function (item) {
                item.classList.toggle(
                    'is-hidden',
                    filter !== 'all' && item.dataset.disclosureCategory !== filter
                );
            });
        });
    });
});
</script>
