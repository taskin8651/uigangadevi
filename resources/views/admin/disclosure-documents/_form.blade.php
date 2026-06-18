@csrf

<div class="admin-form-grid">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-file-alt"></i></div>
            <div>
                <p class="form-card-title">Document Details</p>
                <p class="form-card-subtitle">RTI or NAAC/IQAC public document</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="section">Section <span class="req">*</span></label>
                <select name="section" id="section" required class="field-input">
                    <option value="rti" {{ old('section', $disclosureDocument->section ?? 'rti') === 'rti' ? 'selected' : '' }}>RTI</option>
                    <option value="naac" {{ old('section', $disclosureDocument->section ?? '') === 'naac' ? 'selected' : '' }}>NAAC / IQAC</option>
                </select>
            </div>

            <div class="field-group">
                <label class="field-label" for="title">Title <span class="req">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $disclosureDocument->title ?? '') }}" required class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                @error('title')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="category">Category</label>
                <input type="text" name="category" id="category" value="{{ old('category', $disclosureDocument->category ?? '') }}" class="field-input" placeholder="Forms, Certificates, AQAR, SSR">
            </div>

            <div class="field-group">
                <label class="field-label" for="year">Year</label>
                <input type="text" name="year" id="year" value="{{ old('year', $disclosureDocument->year ?? '') }}" class="field-input" placeholder="2025-26">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-upload"></i></div>
            <div>
                <p class="form-card-title">File / Link</p>
                <p class="form-card-subtitle">Upload document or add external URL</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="document_file">Document File</label>
                <input type="file" name="document_file" id="document_file" class="field-input">
                @error('document_file')<p class="field-error">{{ $message }}</p>@else
                    <p class="field-hint">PDF, document, sheet or image. Maximum 15 MB.</p>
                @enderror

                @if(!empty($disclosureDocument?->document))
                    <p class="field-hint">
                        Current: <a href="{{ $disclosureDocument->document['url'] }}" target="_blank" rel="noopener">{{ $disclosureDocument->document['name'] }}</a>
                    </p>
                    <label class="field-hint"><input type="checkbox" name="remove_document" value="1"> Remove uploaded file</label>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="external_url">External URL</label>
                <input type="url" name="external_url" id="external_url" value="{{ old('external_url', $disclosureDocument->external_url ?? '') }}" class="field-input" placeholder="https://example.com/document.pdf">
                @error('external_url')<p class="field-error">{{ $message }}</p>@enderror
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
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $disclosureDocument->sort_order ?? 0) }}" min="0" class="field-input">
            </div>

            <label class="disclosure-status-box">
                <input type="checkbox" name="status" value="1" {{ old('status', $disclosureDocument->status ?? true) ? 'checked' : '' }}>
                <div>
                    <strong>Active</strong>
                    <p>Active documents appear on frontend.</p>
                </div>
            </label>
        </div>
    </div>
</div>

<style>
    .disclosure-status-box {
        display: flex;
        gap: 11px;
        padding: 15px;
        margin: 0;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    .disclosure-status-box input {
        width: 17px;
        height: 17px;
        margin-top: 3px;
    }

    .disclosure-status-box strong {
        display: block;
        color: #1f2937;
        font-size: 14px;
    }

    .disclosure-status-box p {
        margin: 3px 0 0;
        color: #64748b;
        font-size: 12px;
    }
</style>
