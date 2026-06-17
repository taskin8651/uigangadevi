@extends('layouts.admin')

@section('page-title', 'Website Settings')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Website Settings</h2>
        <p class="admin-page-subtitle">Manage logo, favicon, contact details, map, social links, SEO and footer content</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST"
      action="{{ route('admin.website-settings.update') }}"
      enctype="multipart/form-data">
    @csrf

    <div class="admin-form-grid">
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-globe"></i></div>
                <div>
                    <p class="form-card-title">General Website</p>
                    <p class="form-card-subtitle">Site name, tagline and footer text</p>
                </div>
            </div>

            <div class="form-card-body">
                @foreach([
                    'site_name' => 'Site Name',
                    'site_tagline' => 'Site Tagline',
                    'site_url' => 'Site URL',
                    'copyright_text' => 'Copyright Text',
                ] as $field => $label)
                    <div class="field-group">
                        <label class="field-label" for="{{ $field }}">{{ $label }}</label>
                        <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $websiteSetting->$field) }}" class="field-input">
                    </div>
                @endforeach

                <div class="field-group">
                    <label class="field-label" for="footer_description">Footer Description</label>
                    <textarea name="footer_description" id="footer_description" rows="4" class="field-input">{{ old('footer_description', $websiteSetting->footer_description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-image"></i></div>
                <div>
                    <p class="form-card-title">Logo & Favicon</p>
                    <p class="form-card-subtitle">Brand assets for header and browser tab</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label" for="logo">Website Logo</label>
                    <input type="file" name="logo" id="logo" accept=".jpg,.jpeg,.png,.webp" class="field-input">
                    @if($websiteSetting->logo)
                        <div class="setting-image-preview">
                            <img src="{{ $websiteSetting->logo }}" alt="Logo">
                            <label><input type="checkbox" name="remove_logo" value="1"> Remove logo</label>
                        </div>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="favicon">Favicon</label>
                    <input type="file" name="favicon" id="favicon" accept=".ico,.png,.jpg,.jpeg,.webp" class="field-input">
                    @if($websiteSetting->favicon)
                        <div class="setting-image-preview small">
                            <img src="{{ $websiteSetting->favicon }}" alt="Favicon">
                            <label><input type="checkbox" name="remove_favicon" value="1"> Remove favicon</label>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-location-dot"></i></div>
                <div>
                    <p class="form-card-title">Address & Map</p>
                    <p class="form-card-subtitle">Campus location and Google map links</p>
                </div>
            </div>

            <div class="form-card-body">
                @foreach([
                    'address_line' => 'Address Line',
                    'city' => 'City',
                    'state' => 'State',
                    'country' => 'Country',
                    'postal_code' => 'Postal Code',
                    'map_link' => 'Google Map Link',
                ] as $field => $label)
                    <div class="field-group">
                        <label class="field-label" for="{{ $field }}">{{ $label }}</label>
                        <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $websiteSetting->$field) }}" class="field-input">
                    </div>
                @endforeach

                <div class="field-group">
                    <label class="field-label" for="map_embed_url">Google Map Embed URL / iframe src</label>
                    <textarea name="map_embed_url" id="map_embed_url" rows="3" class="field-input">{{ old('map_embed_url', $websiteSetting->map_embed_url) }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-address-book"></i></div>
                <div>
                    <p class="form-card-title">Contact Details</p>
                    <p class="form-card-subtitle">Emails, phone numbers and office timing</p>
                </div>
            </div>

            <div class="form-card-body">
                @foreach([
                    'primary_email' => 'Primary Email',
                    'admission_email' => 'Admission Email',
                    'exam_email' => 'Exam Email',
                    'documents_email' => 'Documents Email',
                    'primary_phone' => 'Primary Phone',
                    'admission_phone' => 'Admission Phone',
                    'exam_phone' => 'Exam Phone',
                    'documents_phone' => 'Documents Phone',
                    'office_days' => 'Office Days',
                    'office_time' => 'Office Time',
                    'calling_hours' => 'Calling Hours',
                    'closed_days' => 'Closed Days',
                ] as $field => $label)
                    <div class="field-group">
                        <label class="field-label" for="{{ $field }}">{{ $label }}</label>
                        <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $websiteSetting->$field) }}" class="field-input">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-share-nodes"></i></div>
                <div>
                    <p class="form-card-title">Social Links</p>
                    <p class="form-card-subtitle">Official social media profiles</p>
                </div>
            </div>

            <div class="form-card-body">
                @foreach([
                    'facebook_url' => 'Facebook URL',
                    'twitter_url' => 'Twitter / X URL',
                    'instagram_url' => 'Instagram URL',
                    'youtube_url' => 'YouTube URL',
                    'linkedin_url' => 'LinkedIn URL',
                ] as $field => $label)
                    <div class="field-group">
                        <label class="field-label" for="{{ $field }}">{{ $label }}</label>
                        <input type="url" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $websiteSetting->$field) }}" class="field-input">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-magnifying-glass-chart"></i></div>
                <div>
                    <p class="form-card-title">SEO</p>
                    <p class="form-card-subtitle">Default meta title, description and keywords</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label" for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $websiteSetting->meta_title) }}" class="field-input">
                </div>

                <div class="field-group">
                    <label class="field-label" for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="4" class="field-input">{{ old('meta_description', $websiteSetting->meta_description) }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label" for="meta_keywords">Meta Keywords</label>
                    <textarea name="meta_keywords" id="meta_keywords" rows="3" class="field-input">{{ old('meta_keywords', $websiteSetting->meta_keywords) }}</textarea>
                </div>

                <label class="setting-status-box">
                    <input type="checkbox" name="status" value="1" {{ old('status', $websiteSetting->status) ? 'checked' : '' }}>
                    <span>Website settings active</span>
                </label>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save Settings
        </button>
    </div>
</form>

<style>
    textarea.field-input {
        min-height: 110px;
        padding-top: 14px;
        resize: vertical;
    }

    .setting-image-preview {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-top: 12px;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f9fafb;
    }

    .setting-image-preview img {
        width: 150px;
        max-height: 80px;
        object-fit: contain;
    }

    .setting-image-preview.small img {
        width: 48px;
        height: 48px;
    }

    .setting-image-preview label,
    .setting-status-box {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .setting-status-box {
        padding: 14px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f9fafb;
    }
</style>

@endsection
