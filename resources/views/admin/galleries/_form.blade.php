@csrf

<div class="admin-form-grid">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-images"></i></div>
            <div>
                <p class="form-card-title">Gallery Details</p>
                <p class="form-card-subtitle">Title, category and media type</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="title">Title <span class="req">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $gallery->title ?? '') }}" required class="field-input {{ $errors->has('title') ? 'error' : '' }}" placeholder="Annual function gallery">
                @error('title')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="category">Category</label>
                <input list="galleryCategories" type="text" name="category" id="category" value="{{ old('category', $gallery->category ?? '') }}" class="field-input {{ $errors->has('category') ? 'error' : '' }}" placeholder="Campus Events">
                <datalist id="galleryCategories">
                    @foreach($categories as $category)
                        <option value="{{ $category }}">
                    @endforeach
                </datalist>
                @error('category')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="type">Section Type <span class="req">*</span></label>
                <select name="type" id="type" required class="field-input {{ $errors->has('type') ? 'error' : '' }}">
                    @foreach(['image' => 'Image Gallery', 'video' => 'Video Gallery'] as $value => $label)
                        <option value="{{ $value }}" {{ old('type', $gallery->type ?? 'image') === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('type')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="description">Description</label>
                <textarea name="description" id="description" rows="7" class="field-input {{ $errors->has('description') ? 'error' : '' }}" placeholder="Short gallery description">{{ old('description', $gallery->description ?? '') }}</textarea>
                @error('description')<p class="field-error">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-photo-video"></i></div>
            <div>
                <p class="form-card-title">Media</p>
                <p class="form-card-subtitle">Upload image or paste video URL</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="image">Image</label>
                <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp" class="field-input {{ $errors->has('image') ? 'error' : '' }}">
                @error('image')<p class="field-error">{{ $message }}</p>@else
                    <p class="field-hint">JPG, PNG or WEBP. Maximum 5 MB.</p>
                @enderror

                @if(!empty($gallery?->image))
                    <div class="gallery-current-media">
                        <img src="{{ $gallery->image }}" alt="{{ $gallery->title }}">
                        <label><input type="checkbox" name="remove_image" value="1"> Remove image</label>
                    </div>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="video_url">Video URL</label>
                <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $gallery->video_url ?? '') }}" class="field-input {{ $errors->has('video_url') ? 'error' : '' }}" placeholder="https://www.youtube.com/watch?v=...">
                @error('video_url')<p class="field-error">{{ $message }}</p>@else
                    <p class="field-hint">YouTube watch/share/embed URL supported.</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-cog"></i></div>
            <div>
                <p class="form-card-title">Settings</p>
                <p class="form-card-subtitle">Ordering and frontend visibility</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $gallery->sort_order ?? 0) }}" min="0" class="field-input">
            </div>

            <div class="gallery-toggle-grid">
                <label class="gallery-status-box">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $gallery->is_featured ?? false) ? 'checked' : '' }}>
                    <div>
                        <strong>Featured</strong>
                        <p>Show near the top of gallery page.</p>
                    </div>
                </label>

                <label class="gallery-status-box">
                    <input type="checkbox" name="status" value="1" {{ old('status', $gallery->status ?? true) ? 'checked' : '' }}>
                    <div>
                        <strong>Active</strong>
                        <p>Active items appear on frontend.</p>
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>

<style>
    textarea.field-input {
        min-height: 150px;
        padding-top: 14px;
        resize: vertical;
    }

    .gallery-current-media {
        display: grid;
        gap: 10px;
        margin-top: 12px;
    }

    .gallery-current-media img {
        width: 180px;
        height: 110px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .gallery-toggle-grid {
        display: grid;
        gap: 12px;
    }

    .gallery-status-box {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px;
        margin: 0;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    .gallery-status-box input {
        width: 17px;
        height: 17px;
        margin-top: 3px;
    }

    .gallery-status-box strong {
        display: block;
        color: #1f2937;
        font-size: 14px;
    }

    .gallery-status-box p {
        margin: 3px 0 0;
        color: #64748b;
        font-size: 12px;
    }
</style>
