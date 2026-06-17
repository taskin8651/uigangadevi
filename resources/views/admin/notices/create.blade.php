@extends('layouts.admin')

@section('page-title', 'Add Notice')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.notices.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>
        <h2 class="admin-page-title">Add Notice</h2>
        <p class="admin-page-subtitle">Create a notice, circular or downloadable PDF item</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST" action="{{ route('admin.notices.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-form-grid">
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-bullhorn"></i></div>
                <div>
                    <p class="form-card-title">Notice Information</p>
                    <p class="form-card-subtitle">Title, slug, category and date</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label" for="title">Notice Title <span class="req">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="Admission notice for upcoming academic session" class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                    </div>
                    @error('title')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="slug">Slug</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="admission-notice-2026" class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>
                    @error('slug')<p class="field-error">{{ $message }}</p>@else
                        <p class="field-hint">Leave blank to generate automatically.</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="category">Category</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-tags icon"></i>
                        <select name="category" id="category" class="field-input {{ $errors->has('category') ? 'error' : '' }}">
                            <option value="">Select category</option>
                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}" {{ old('category') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="notice_date">Notice Date</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-calendar-alt icon"></i>
                        <input type="date" name="notice_date" id="notice_date" value="{{ old('notice_date') }}" class="field-input {{ $errors->has('notice_date') ? 'error' : '' }}">
                    </div>
                    @error('notice_date')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-file-pdf"></i></div>
                <div>
                    <p class="form-card-title">PDF & Link</p>
                    <p class="form-card-subtitle">Upload notice PDF or add external URL</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label" for="notice_file">Notice PDF</label>
                    <input type="file" name="notice_file" id="notice_file" accept=".pdf,application/pdf" class="field-input {{ $errors->has('notice_file') ? 'error' : '' }}">
                    @error('notice_file')<p class="field-error">{{ $message }}</p>@else
                        <p class="field-hint">PDF only. Maximum 15 MB.</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="external_url">External URL</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-external-link-alt icon"></i>
                        <input type="url" name="external_url" id="external_url" value="{{ old('external_url') }}" placeholder="https://example.com/notice.pdf" class="field-input {{ $errors->has('external_url') ? 'error' : '' }}">
                    </div>
                    @error('external_url')<p class="field-error">{{ $message }}</p>@else
                        <p class="field-hint">Uploaded PDF gets priority over external URL.</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="button_text">Button Text</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-mouse-pointer icon"></i>
                        <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}" placeholder="Download Notice" class="field-input">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-align-left"></i></div>
                <div>
                    <p class="form-card-title">Description</p>
                    <p class="form-card-subtitle">Short text shown on frontend archive</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label" for="short_description">Short Description</label>
                    <textarea name="short_description" id="short_description" rows="8" placeholder="Enter notice summary" class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description') }}</textarea>
                    @error('short_description')<p class="field-error">{{ $message }}</p>@enderror
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
                    <div class="input-icon-wrap">
                        <i class="fas fa-sort-numeric-down icon"></i>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="field-input">
                    </div>
                </div>

                <div class="notice-toggle-grid">
                    <label class="notice-status-box">
                        <input type="checkbox" name="is_latest" value="1" {{ old('is_latest') ? 'checked' : '' }}>
                        <div>
                            <strong>Latest Notice</strong>
                            <p>Latest notices appear first.</p>
                        </div>
                    </label>

                    <label class="notice-status-box">
                        <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                        <div>
                            <strong>Active Notice</strong>
                            <p>Active notices appear on frontend.</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save Notice
        </button>
        <a href="{{ route('admin.notices.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>

<style>
    textarea.field-input {
        min-height: 150px;
        padding-top: 14px;
        resize: vertical;
    }

    .notice-toggle-grid {
        display: grid;
        gap: 12px;
    }

    .notice-status-box {
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

    .notice-status-box input {
        width: 17px;
        height: 17px;
        margin-top: 3px;
    }

    .notice-status-box strong {
        display: block;
        color: #1f2937;
        font-size: 14px;
    }

    .notice-status-box p {
        margin: 3px 0 0;
        color: #64748b;
        font-size: 12px;
    }
</style>

@endsection

@section('scripts')
@parent
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (titleInput && slugInput) {
        let slugManual = slugInput.value.trim() !== '';

        slugInput.addEventListener('input', function () {
            slugManual = this.value.trim() !== '';
        });

        titleInput.addEventListener('input', function () {
            if (slugManual) {
                return;
            }

            slugInput.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        });
    }

    document.getElementById('notice_file')?.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            return;
        }

        const validPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');

        if (!validPdf) {
            alert('Please select a valid PDF file.');
            this.value = '';
            return;
        }

        if (file.size > 15 * 1024 * 1024) {
            alert('Notice PDF must not exceed 15 MB.');
            this.value = '';
        }
    });
});
</script>
@endsection
