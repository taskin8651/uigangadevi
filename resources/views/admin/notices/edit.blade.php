@extends('layouts.admin')

@section('page-title', 'Edit Notice')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.notices.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>
        <h2 class="admin-page-title">Edit Notice</h2>
        <p class="admin-page-subtitle">Update notice details, PDF and frontend visibility</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST" action="{{ route('admin.notices.update', $notice->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

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
                        <input type="text" name="title" id="title" value="{{ old('title', $notice->title) }}" required class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                    </div>
                    @error('title')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="slug">Slug</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $notice->slug) }}" class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>
                    @error('slug')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="category">Category</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-tags icon"></i>
                        <select name="category" id="category" class="field-input {{ $errors->has('category') ? 'error' : '' }}">
                            <option value="">Select category</option>
                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}" {{ old('category', $notice->category) === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="notice_date">Notice Date</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-calendar-alt icon"></i>
                        <input type="date" name="notice_date" id="notice_date" value="{{ old('notice_date', optional($notice->notice_date)->format('Y-m-d')) }}" class="field-input {{ $errors->has('notice_date') ? 'error' : '' }}">
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
                    <p class="form-card-subtitle">Replace PDF or update external URL</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label" for="notice_file">Notice PDF</label>
                    <input type="file" name="notice_file" id="notice_file" accept=".pdf,application/pdf" class="field-input {{ $errors->has('notice_file') ? 'error' : '' }}">
                    @error('notice_file')<p class="field-error">{{ $message }}</p>@else
                        <p class="field-hint">Upload only when replacing the current PDF. Maximum 15 MB.</p>
                    @enderror
                </div>

                @if($notice->document)
                    <div class="notice-current-document">
                        <div class="notice-current-main">
                            <div class="notice-current-icon"><i class="fas fa-file-pdf"></i></div>
                            <div class="notice-current-info">
                                <strong>Current Notice PDF</strong>
                                <a href="{{ $notice->document['url'] }}" target="_blank" rel="noopener">
                                    {{ $notice->document['name'] ?? 'View current PDF' }}
                                </a>
                                @if(!empty($notice->document['size']))
                                    <span>{{ number_format($notice->document['size'] / 1024, 1) }} KB</span>
                                @endif
                            </div>
                        </div>

                        <label class="notice-remove-file">
                            <input type="checkbox" name="remove_notice_file" value="1" {{ old('remove_notice_file') ? 'checked' : '' }}>
                            <span>Remove current PDF</span>
                        </label>
                    </div>
                @endif

                <div class="field-group">
                    <label class="field-label" for="external_url">External URL</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-external-link-alt icon"></i>
                        <input type="url" name="external_url" id="external_url" value="{{ old('external_url', $notice->external_url) }}" class="field-input {{ $errors->has('external_url') ? 'error' : '' }}">
                    </div>
                    @error('external_url')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="button_text">Button Text</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-mouse-pointer icon"></i>
                        <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $notice->button_text) }}" class="field-input">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-align-left"></i></div>
                <div>
                    <p class="form-card-title">Description</p>
                    <p class="form-card-subtitle">Short frontend archive summary</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label" for="short_description">Short Description</label>
                    <textarea name="short_description" id="short_description" rows="8" class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $notice->short_description) }}</textarea>
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
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $notice->sort_order ?? 0) }}" min="0" class="field-input">
                    </div>
                </div>

                <div class="notice-toggle-grid">
                    <label class="notice-status-box">
                        <input type="checkbox" name="is_latest" value="1" {{ old('is_latest', $notice->is_latest) ? 'checked' : '' }}>
                        <div>
                            <strong>Latest Notice</strong>
                            <p>Latest notices appear first.</p>
                        </div>
                    </label>

                    <label class="notice-status-box">
                        <input type="checkbox" name="status" value="1" {{ old('status', $notice->status) ? 'checked' : '' }}>
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
            Update Notice
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

    .notice-status-box strong,
    .notice-current-info strong {
        display: block;
        color: #1f2937;
        font-size: 14px;
    }

    .notice-status-box p {
        margin: 3px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    .notice-current-document {
        margin: 0 0 18px;
        padding: 14px;
        border: 1px solid #fecaca;
        border-radius: 14px;
        background: #fff7f7;
    }

    .notice-current-main {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .notice-current-icon {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #fee2e2;
        color: #dc2626;
        font-size: 21px;
    }

    .notice-current-info {
        min-width: 0;
        flex: 1;
    }

    .notice-current-info a {
        display: block;
        overflow: hidden;
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .notice-current-info span {
        display: block;
        margin-top: 3px;
        color: #64748b;
        font-size: 11px;
    }

    .notice-remove-file {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 12px;
        color: #dc2626;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }
</style>

@endsection
