@csrf

<div class="admin-form-grid">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-images"></i></div>
            <div>
                <p class="form-card-title">Hero Content</p>
                <p class="form-card-subtitle">Badge, title and description</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="badge_text">Badge Text</label>
                <input type="text" name="badge_text" id="badge_text" value="{{ old('badge_text', $heroSlide->badge_text ?? '') }}" class="field-input" placeholder="Women College in Kankarbagh, Patna">
            </div>

            <div class="field-group">
                <label class="field-label" for="badge_icon">Badge Icon</label>
                <input type="text" name="badge_icon" id="badge_icon" value="{{ old('badge_icon', $heroSlide->badge_icon ?? 'bi-mortarboard-fill') }}" class="field-input" placeholder="bi-mortarboard-fill">
                <p class="field-hint">Bootstrap icon class, example: bi-award-fill.</p>
            </div>

            <div class="field-group">
                <label class="field-label" for="title">Title <span class="req">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $heroSlide->title ?? '') }}" required class="field-input {{ $errors->has('title') ? 'error' : '' }}" placeholder="Empowering Women Through Quality Higher Education">
                @error('title')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="description">Description</label>
                <textarea name="description" id="description" rows="6" class="field-input {{ $errors->has('description') ? 'error' : '' }}" placeholder="Short hero description">{{ old('description', $heroSlide->description ?? '') }}</textarea>
                @error('description')<p class="field-error">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-image"></i></div>
            <div>
                <p class="form-card-title">Hero Image</p>
                <p class="form-card-subtitle">Large image for slide background</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="image">Slide Image</label>
                <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp" class="field-input {{ $errors->has('image') ? 'error' : '' }}">
                @error('image')<p class="field-error">{{ $message }}</p>@else
                    <p class="field-hint">JPG, PNG or WEBP. Maximum 5 MB.</p>
                @enderror

                @if(!empty($heroSlide?->image))
                    <div class="hero-current-image">
                        <img src="{{ $heroSlide->image }}" alt="{{ $heroSlide->title }}">
                        <label><input type="checkbox" name="remove_image" value="1"> Remove image</label>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-link"></i></div>
            <div>
                <p class="form-card-title">Hero Buttons</p>
                <p class="form-card-subtitle">Primary and secondary action links</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="primary_button_text">Primary Button Text</label>
                <input type="text" name="primary_button_text" id="primary_button_text" value="{{ old('primary_button_text', $heroSlide->primary_button_text ?? '') }}" class="field-input" placeholder="Latest Notices">
            </div>

            <div class="field-group">
                <label class="field-label" for="primary_button_url">Primary Button URL</label>
                <input type="text" name="primary_button_url" id="primary_button_url" value="{{ old('primary_button_url', $heroSlide->primary_button_url ?? '') }}" class="field-input" placeholder="/notices">
            </div>

            <div class="field-group">
                <label class="field-label" for="secondary_button_text">Secondary Button Text</label>
                <input type="text" name="secondary_button_text" id="secondary_button_text" value="{{ old('secondary_button_text', $heroSlide->secondary_button_text ?? '') }}" class="field-input" placeholder="Admission Updates">
            </div>

            <div class="field-group">
                <label class="field-label" for="secondary_button_url">Secondary Button URL</label>
                <input type="text" name="secondary_button_url" id="secondary_button_url" value="{{ old('secondary_button_url', $heroSlide->secondary_button_url ?? '') }}" class="field-input" placeholder="/admissions">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-cog"></i></div>
            <div>
                <p class="form-card-title">Settings</p>
                <p class="form-card-subtitle">Ordering and visibility</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $heroSlide->sort_order ?? 0) }}" min="0" class="field-input">
            </div>

            <label class="hero-status-box">
                <input type="checkbox" name="status" value="1" {{ old('status', $heroSlide->status ?? true) ? 'checked' : '' }}>
                <div>
                    <strong>Active Slide</strong>
                    <p>Active slides appear on home hero section.</p>
                </div>
            </label>
        </div>
    </div>
</div>

<style>
    textarea.field-input {
        min-height: 140px;
        padding-top: 14px;
        resize: vertical;
    }

    .hero-current-image {
        display: grid;
        gap: 10px;
        margin-top: 12px;
    }

    .hero-current-image img {
        width: 220px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .hero-status-box {
        display: flex;
        gap: 11px;
        padding: 15px;
        margin: 0;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    .hero-status-box input {
        width: 17px;
        height: 17px;
        margin-top: 3px;
    }

    .hero-status-box strong {
        display: block;
        color: #1f2937;
        font-size: 14px;
    }

    .hero-status-box p {
        margin: 3px 0 0;
        color: #64748b;
        font-size: 12px;
    }
</style>
