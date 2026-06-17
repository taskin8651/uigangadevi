@extends('layouts.admin')

@section('page-title', 'Edit Academic Calendar')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.academic-calendars.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Academic Calendar
        </h2>

        <p class="admin-page-subtitle">
            Update academic session, monthly plans and official calendar document
        </p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST"
      action="{{ route('admin.academic-calendars.update', $academicCalendar->id) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="admin-form-grid">

        {{-- CALENDAR INFORMATION --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Calendar Information
                    </p>

                    <p class="form-card-subtitle">
                        Academic session and main calendar content
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="title">
                        Calendar Title <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $academicCalendar->title) }}"
                               required
                               placeholder="Academic Calendar Schedule"
                               class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                    </div>

                    @error('title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="academic_session">
                        Academic Session <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-graduation-cap icon"></i>

                        <input type="text"
                               name="academic_session"
                               id="academic_session"
                               value="{{ old('academic_session', $academicCalendar->academic_session) }}"
                               required
                               placeholder="2026-2027"
                               class="field-input {{ $errors->has('academic_session') ? 'error' : '' }}">
                    </div>

                    @error('academic_session')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Enter a unique academic session, for example 2026-2027.
                        </p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="short_description">
                        Short Description
                    </label>

                    <textarea name="short_description"
                              id="short_description"
                              rows="7"
                              placeholder="Month-wise schedule for academic activities, examinations and institutional updates."
                              class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $academicCalendar->short_description) }}</textarea>

                    @error('short_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- DOCUMENT AND VISIBILITY --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>

                <div>
                    <p class="form-card-title">
                        Document & Visibility
                    </p>

                    <p class="form-card-subtitle">
                        Official PDF document and frontend status
                    </p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="calendar_document">
                        Academic Calendar PDF
                    </label>

                    <input type="file"
                           name="calendar_document"
                           id="calendar_document"
                           accept=".pdf,application/pdf"
                           class="field-input {{ $errors->has('calendar_document') ? 'error' : '' }}">

                    @error('calendar_document')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            Upload a new PDF only when replacing the current document. Maximum 10 MB.
                        </p>
                    @enderror
                </div>

                @if($academicCalendar->document)
                    <div class="calendar-current-document">

                        <div class="calendar-document-main">
                            <div class="calendar-document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>

                            <div class="calendar-document-info">
                                <strong>
                                    Current Calendar Document
                                </strong>

                                <a href="{{ $academicCalendar->document['url'] }}"
                                   target="_blank"
                                   rel="noopener">
                                    {{ $academicCalendar->document['name'] ?? 'View Academic Calendar' }}
                                </a>

                                @if(!empty($academicCalendar->document['size']))
                                    <span>
                                        {{ number_format($academicCalendar->document['size'] / 1024, 1) }} KB
                                    </span>
                                @endif
                            </div>
                        </div>

                        <label class="calendar-remove-document">
                            <input type="checkbox"
                                   name="remove_calendar_document"
                                   value="1"
                                   {{ old('remove_calendar_document') ? 'checked' : '' }}>

                            <span>Remove current document</span>
                        </label>

                    </div>
                @endif

                <label class="calendar-status-box">

                    <input type="checkbox"
                           name="status"
                           value="1"
                           {{ old('status', $academicCalendar->status) ? 'checked' : '' }}>

                    <div>
                        <strong>Active Academic Calendar</strong>

                        <p>
                            Active calendar will appear on the frontend website.
                        </p>
                    </div>

                </label>

            </div>
        </div>

        {{-- MONTHLY PLANS --}}
        <div class="form-card calendar-full-card">

            <div class="form-card-header between">

                <div class="form-card-head-left">
                    <div class="form-card-icon">
                        <i class="fas fa-calendar-week"></i>
                    </div>

                    <div>
                        <p class="form-card-title">
                            Monthly Plans
                        </p>

                        <p class="form-card-subtitle">
                            Update months and monthly activity points
                        </p>
                    </div>
                </div>

                <div class="form-mini-actions">
                    <button type="button"
                            class="btn-mini-primary"
                            id="addMonthBtn">

                        <i class="fas fa-plus"></i>
                        Add Month
                    </button>
                </div>

            </div>

            <div class="form-card-body">

                @php
                    $months = old(
                        'months',
                        $academicCalendar->months
                            ->map(function ($month) {
                                return [
                                    'month_name'       => $month->month_name,
                                    'month_value'      => $month->month_value,
                                    'display_number'   => $month->display_number,
                                    'sort_order'       => $month->sort_order,
                                    'status'           => $month->status,
                                    'activities'       => $month->activities ?? [],
                                ];
                            })
                            ->values()
                            ->toArray()
                    );
                @endphp

                <div id="calendarMonthsWrapper">

                    @forelse($months as $monthIndex => $month)

                        <div class="calendar-month-admin-card"
                             data-month-index="{{ $monthIndex }}">

                            <div class="calendar-month-admin-head">

                                <div class="calendar-month-admin-title">
                                    <span class="calendar-month-number-preview">
                                        {{ str_pad(
                                            $month['display_number'] ?? ($monthIndex + 1),
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}
                                    </span>

                                    <div>
                                        <strong class="calendar-month-name-preview">
                                            {{ $month['month_name'] ?? 'Month' }}
                                        </strong>

                                        <small>
                                            Monthly academic plan
                                        </small>
                                    </div>
                                </div>

                                <button type="button"
                                        class="calendar-remove-month removeMonthBtn">

                                    <i class="fas fa-trash"></i>
                                    Remove Month
                                </button>

                            </div>

                            <div class="calendar-month-fields">

                                <div class="field-group">
                                    <label class="field-label">
                                        Month
                                    </label>

                                    <div class="input-icon-wrap">
                                        <i class="fas fa-calendar icon"></i>

                                        <select name="months[{{ $monthIndex }}][month_value]"
                                                class="field-input monthValueSelect">

                                            @foreach($monthOptions as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ (string) ($month['month_value'] ?? '') === (string) $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <input type="hidden"
                                           name="months[{{ $monthIndex }}][month_name]"
                                           value="{{ $month['month_name'] ?? '' }}"
                                           class="monthNameInput">

                                    @error("months.$monthIndex.month_value")
                                        <p class="field-error">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        Display Number
                                    </label>

                                    <div class="input-icon-wrap">
                                        <i class="fas fa-sort-numeric-down icon"></i>

                                        <input type="number"
                                               name="months[{{ $monthIndex }}][display_number]"
                                               value="{{ $month['display_number'] ?? ($monthIndex + 1) }}"
                                               min="1"
                                               max="99"
                                               class="field-input displayNumberInput">
                                    </div>

                                    @error("months.$monthIndex.display_number")
                                        <p class="field-error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        Sort Order
                                    </label>

                                    <div class="input-icon-wrap">
                                        <i class="fas fa-list-ol icon"></i>

                                        <input type="number"
                                               name="months[{{ $monthIndex }}][sort_order]"
                                               value="{{ $month['sort_order'] ?? ($monthIndex + 1) }}"
                                               min="0"
                                               class="field-input">
                                    </div>

                                    @error("months.$monthIndex.sort_order")
                                        <p class="field-error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <label class="calendar-month-status">

                                    <input type="checkbox"
                                           name="months[{{ $monthIndex }}][status]"
                                           value="1"
                                           {{ !empty($month['status']) ? 'checked' : '' }}>

                                    <div>
                                        <strong>Active Month</strong>
                                        <span>Show on frontend</span>
                                    </div>

                                </label>

                            </div>

                            <div class="calendar-activities-head">

                                <div>
                                    <strong>
                                        Monthly Activities
                                    </strong>

                                    <p>
                                        Add academic, examination and institutional updates
                                    </p>
                                </div>

                                <button type="button"
                                        class="btn-mini-primary addMonthActivityBtn"
                                        data-month-index="{{ $monthIndex }}">

                                    <i class="fas fa-plus"></i>
                                    Add Activity
                                </button>

                            </div>

                            <div class="calendar-activities-wrapper"
                                 id="monthActivities{{ $monthIndex }}">

                                @forelse(($month['activities'] ?? []) as $activityIndex => $activity)

                                    @php
                                        $activityText = is_array($activity)
                                            ? ($activity['text'] ?? '')
                                            : $activity;

                                        $activityStatus = is_array($activity)
                                            ? !empty($activity['status'])
                                            : true;
                                    @endphp

                                    <div class="calendar-activity-row">

                                        <div class="field-group mb-0">

                                            <label class="field-label">
                                                Activity
                                            </label>

                                            <div class="input-icon-wrap">
                                                <i class="fas fa-check-circle icon"></i>

                                                <input type="text"
                                                       name="months[{{ $monthIndex }}][activities][{{ $activityIndex }}][text]"
                                                       value="{{ $activityText }}"
                                                       placeholder="Enter monthly academic activity"
                                                       class="field-input">
                                            </div>

                                        </div>

                                        <label class="calendar-activity-status">

                                            <input type="checkbox"
                                                   name="months[{{ $monthIndex }}][activities][{{ $activityIndex }}][status]"
                                                   value="1"
                                                   {{ $activityStatus ? 'checked' : '' }}>

                                            <span>Active</span>
                                        </label>

                                        <button type="button"
                                                class="calendar-remove-activity removeMonthActivityBtn">

                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </div>

                                @empty

                                    <div class="calendar-activity-row">

                                        <div class="field-group mb-0">

                                            <label class="field-label">
                                                Activity
                                            </label>

                                            <div class="input-icon-wrap">
                                                <i class="fas fa-check-circle icon"></i>

                                                <input type="text"
                                                       name="months[{{ $monthIndex }}][activities][0][text]"
                                                       placeholder="Enter monthly academic activity"
                                                       class="field-input">
                                            </div>

                                        </div>

                                        <label class="calendar-activity-status">

                                            <input type="checkbox"
                                                   name="months[{{ $monthIndex }}][activities][0][status]"
                                                   value="1"
                                                   checked>

                                            <span>Active</span>
                                        </label>

                                        <button type="button"
                                                class="calendar-remove-activity removeMonthActivityBtn">

                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </div>

                                @endforelse

                            </div>

                        </div>

                    @empty

                        <div class="calendar-month-empty" id="calendarMonthEmpty">

                            <i class="fas fa-calendar-plus"></i>

                            <h3>No Monthly Plans Added</h3>

                            <p>
                                Click the Add Month button to create the first monthly plan.
                            </p>

                        </div>

                    @endforelse

                </div>

                @error('months')
                    <p class="field-error mt-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Only active months and active activity points will appear on the frontend academic calendar.
                    </p>
                </div>

            </div>
        </div>

    </div>

    <div class="form-actions">

        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Update Academic Calendar
        </button>

        <a href="{{ route('admin.academic-calendars.index') }}"
           class="btn-ghost">
            Cancel
        </a>

    </div>

</form>

<style>
    .calendar-full-card {
        grid-column: 1 / -1;
    }

    .calendar-current-document {
        margin-bottom: 18px;
        padding: 14px;
        border: 1px solid #fecaca;
        border-radius: 14px;
        background: #fff7f7;
    }

    .calendar-document-main {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .calendar-document-icon {
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

    .calendar-document-info {
        min-width: 0;
        flex: 1;
    }

    .calendar-document-info strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 13px;
    }

    .calendar-document-info a {
        display: block;
        overflow: hidden;
        color: #4f46e5;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .calendar-document-info span {
        display: block;
        margin-top: 3px;
        color: #64748b;
        font-size: 11px;
    }

    .calendar-remove-document {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 12px;
        color: #dc2626;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .calendar-remove-document input {
        width: 16px;
        height: 16px;
        accent-color: #dc2626;
    }

    .calendar-status-box {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px;
        margin: 0;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    .calendar-status-box > input {
        width: 17px;
        height: 17px;
        flex: 0 0 17px;
        margin-top: 3px;
        accent-color: var(--accent, #4f46e5);
    }

    .calendar-status-box strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 14px;
    }

    .calendar-status-box p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .calendar-month-admin-card {
        padding: 18px;
        margin-bottom: 18px;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        background: #f8fafc;
        box-shadow: 0 3px 10px rgba(15, 23, 42, .03);
    }

    .calendar-month-admin-head,
    .calendar-activities-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .calendar-month-admin-head {
        margin-bottom: 18px;
    }

    .calendar-month-admin-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .calendar-month-number-preview {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #4f46e5;
        color: #fff;
        font-size: 14px;
        font-weight: 800;
    }

    .calendar-month-admin-title strong {
        display: block;
        color: #1e293b;
        font-size: 15px;
    }

    .calendar-month-admin-title small {
        display: block;
        margin-top: 3px;
        color: #64748b;
        font-size: 11px;
    }

    .calendar-month-fields {
        display: grid;
        grid-template-columns: minmax(200px, 2fr) 1fr 1fr 165px;
        gap: 12px;
        align-items: end;
    }

    .calendar-month-status {
        min-height: 48px;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 10px 12px;
        margin: 0 0 20px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        cursor: pointer;
    }

    .calendar-month-status input {
        width: 16px;
        height: 16px;
        flex: 0 0 16px;
        accent-color: #4f46e5;
    }

    .calendar-month-status strong {
        display: block;
        color: #374151;
        font-size: 12.5px;
    }

    .calendar-month-status span {
        display: block;
        margin-top: 2px;
        color: #94a3b8;
        font-size: 10px;
    }

    .calendar-activities-head {
        padding-top: 16px;
        margin-top: 2px;
        margin-bottom: 13px;
        border-top: 1px solid #e2e8f0;
    }

    .calendar-activities-head strong {
        display: block;
        color: #334155;
        font-size: 13px;
    }

    .calendar-activities-head p {
        margin: 3px 0 0;
        color: #94a3b8;
        font-size: 11px;
    }

    .calendar-activity-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 110px 48px;
        gap: 10px;
        align-items: end;
        margin-bottom: 10px;
    }

    .calendar-activity-status {
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        margin: 0;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        color: #374151;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
    }

    .calendar-activity-status input {
        width: 15px;
        height: 15px;
        accent-color: #4f46e5;
    }

    .calendar-remove-month,
    .calendar-remove-activity {
        border: 0;
        background: #fee2e2;
        color: #dc2626;
        cursor: pointer;
        transition: .25s ease;
    }

    .calendar-remove-month {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 12px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
    }

    .calendar-remove-activity {
        width: 48px;
        height: 48px;
        border-radius: 12px;
    }

    .calendar-remove-month:hover,
    .calendar-remove-activity:hover {
        background: #dc2626;
        color: #fff;
    }

    .calendar-month-empty {
        padding: 45px 20px;
        border: 2px dashed #cbd5e1;
        border-radius: 18px;
        text-align: center;
        background: #f8fafc;
    }

    .calendar-month-empty i {
        color: #94a3b8;
        font-size: 38px;
    }

    .calendar-month-empty h3 {
        margin: 12px 0 6px;
        color: #334155;
        font-size: 16px;
    }

    .calendar-month-empty p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    .mt-2 {
        margin-top: 8px !important;
    }

    textarea.field-input {
        min-height: 140px;
        padding-top: 14px;
        resize: vertical;
    }

    @media (max-width: 1100px) {
        .calendar-month-fields {
            grid-template-columns: 1fr 1fr;
        }

        .calendar-month-status {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 768px) {
        .calendar-full-card {
            grid-column: auto;
        }

        .calendar-month-fields,
        .calendar-activity-row {
            grid-template-columns: 1fr;
        }

        .calendar-month-admin-head,
        .calendar-activities-head {
            align-items: stretch;
            flex-direction: column;
        }

        .calendar-remove-month,
        .calendar-remove-activity {
            width: 100%;
        }

        .calendar-month-status,
        .calendar-activity-status {
            justify-content: flex-start;
            padding: 0 14px;
        }
    }
</style>

@endsection

@section('scripts')
@parent

<script>
document.addEventListener('DOMContentLoaded', function () {

    const monthsWrapper = document.getElementById(
        'calendarMonthsWrapper'
    );

    const addMonthBtn = document.getElementById(
        'addMonthBtn'
    );

    const monthOptions = @json($monthOptions);

    function generateIndex() {
        return Date.now() + Math.floor(Math.random() * 10000);
    }

    function monthOptionsHtml(selectedValue = '') {
        return Object.entries(monthOptions)
            .map(function ([value, label]) {
                const selected =
                    String(value) === String(selectedValue)
                        ? 'selected'
                        : '';

                return `
                    <option value="${value}" ${selected}>
                        ${label}
                    </option>
                `;
            })
            .join('');
    }

    function removeEmptyState() {
        const emptyState = document.getElementById(
            'calendarMonthEmpty'
        );

        if (emptyState) {
            emptyState.remove();
        }
    }

    function updateMonthPreview(card) {
        if (!card) {
            return;
        }

        const select = card.querySelector(
            '.monthValueSelect'
        );

        const monthNameInput = card.querySelector(
            '.monthNameInput'
        );

        const monthNamePreview = card.querySelector(
            '.calendar-month-name-preview'
        );

        const displayNumberInput = card.querySelector(
            '.displayNumberInput'
        );

        const numberPreview = card.querySelector(
            '.calendar-month-number-preview'
        );

        if (select && monthNameInput) {
            const selectedText =
                select.options[select.selectedIndex]?.text
                || 'Month';

            monthNameInput.value = selectedText;

            if (monthNamePreview) {
                monthNamePreview.textContent =
                    selectedText;
            }
        }

        if (displayNumberInput && numberPreview) {
            const displayNumber =
                String(displayNumberInput.value || 1)
                    .padStart(2, '0');

            numberPreview.textContent = displayNumber;
        }
    }

    addMonthBtn?.addEventListener('click', function () {
        removeEmptyState();

        const monthIndex = generateIndex();

        const existingCount = monthsWrapper.querySelectorAll(
            '.calendar-month-admin-card'
        ).length;

        const displayNumber = existingCount + 1;

        const html = `
            <div class="calendar-month-admin-card"
                 data-month-index="${monthIndex}">

                <div class="calendar-month-admin-head">

                    <div class="calendar-month-admin-title">

                        <span class="calendar-month-number-preview">
                            ${String(displayNumber).padStart(2, '0')}
                        </span>

                        <div>
                            <strong class="calendar-month-name-preview">
                                January
                            </strong>

                            <small>
                                Monthly academic plan
                            </small>
                        </div>

                    </div>

                    <button type="button"
                            class="calendar-remove-month removeMonthBtn">

                        <i class="fas fa-trash"></i>
                        Remove Month
                    </button>

                </div>

                <div class="calendar-month-fields">

                    <div class="field-group">
                        <label class="field-label">
                            Month
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-calendar icon"></i>

                            <select name="months[${monthIndex}][month_value]"
                                    class="field-input monthValueSelect">

                                ${monthOptionsHtml(1)}
                            </select>
                        </div>

                        <input type="hidden"
                               name="months[${monthIndex}][month_name]"
                               value="January"
                               class="monthNameInput">
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            Display Number
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-sort-numeric-down icon"></i>

                            <input type="number"
                                   name="months[${monthIndex}][display_number]"
                                   value="${displayNumber}"
                                   min="1"
                                   max="99"
                                   class="field-input displayNumberInput">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            Sort Order
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-list-ol icon"></i>

                            <input type="number"
                                   name="months[${monthIndex}][sort_order]"
                                   value="${displayNumber}"
                                   min="0"
                                   class="field-input">
                        </div>
                    </div>

                    <label class="calendar-month-status">

                        <input type="checkbox"
                               name="months[${monthIndex}][status]"
                               value="1"
                               checked>

                        <div>
                            <strong>Active Month</strong>
                            <span>Show on frontend</span>
                        </div>

                    </label>

                </div>

                <div class="calendar-activities-head">

                    <div>
                        <strong>
                            Monthly Activities
                        </strong>

                        <p>
                            Add academic, examination and institutional updates
                        </p>
                    </div>

                    <button type="button"
                            class="btn-mini-primary addMonthActivityBtn"
                            data-month-index="${monthIndex}">

                        <i class="fas fa-plus"></i>
                        Add Activity
                    </button>

                </div>

                <div class="calendar-activities-wrapper"
                     id="monthActivities${monthIndex}">

                    <div class="calendar-activity-row">

                        <div class="field-group mb-0">

                            <label class="field-label">
                                Activity
                            </label>

                            <div class="input-icon-wrap">
                                <i class="fas fa-check-circle icon"></i>

                                <input type="text"
                                       name="months[${monthIndex}][activities][0][text]"
                                       placeholder="Enter monthly academic activity"
                                       class="field-input">
                            </div>

                        </div>

                        <label class="calendar-activity-status">

                            <input type="checkbox"
                                   name="months[${monthIndex}][activities][0][status]"
                                   value="1"
                                   checked>

                            <span>Active</span>
                        </label>

                        <button type="button"
                                class="calendar-remove-activity removeMonthActivityBtn">

                            <i class="fas fa-trash"></i>
                        </button>

                    </div>

                </div>

            </div>
        `;

        monthsWrapper.insertAdjacentHTML(
            'beforeend',
            html
        );
    });

    document.addEventListener('change', function (event) {

        if (event.target.matches('.monthValueSelect')) {
            updateMonthPreview(
                event.target.closest(
                    '.calendar-month-admin-card'
                )
            );
        }

    });

    document.addEventListener('input', function (event) {

        if (event.target.matches('.displayNumberInput')) {
            updateMonthPreview(
                event.target.closest(
                    '.calendar-month-admin-card'
                )
            );
        }

    });

    document.addEventListener('click', function (event) {

        const removeMonthButton = event.target.closest(
            '.removeMonthBtn'
        );

        if (removeMonthButton) {
            const monthCard = removeMonthButton.closest(
                '.calendar-month-admin-card'
            );

            if (
                confirm(
                    'Are you sure you want to remove this month and all its activities?'
                )
            ) {
                monthCard?.remove();
            }

            return;
        }

        const addActivityButton = event.target.closest(
            '.addMonthActivityBtn'
        );

        if (addActivityButton) {
            const monthIndex =
                addActivityButton.dataset.monthIndex;

            const activitiesWrapper =
                document.getElementById(
                    'monthActivities' + monthIndex
                );

            if (!activitiesWrapper) {
                return;
            }

            const activityIndex = generateIndex();

            activitiesWrapper.insertAdjacentHTML(
                'beforeend',
                `
                    <div class="calendar-activity-row">

                        <div class="field-group mb-0">

                            <label class="field-label">
                                Activity
                            </label>

                            <div class="input-icon-wrap">
                                <i class="fas fa-check-circle icon"></i>

                                <input type="text"
                                       name="months[${monthIndex}][activities][${activityIndex}][text]"
                                       placeholder="Enter monthly academic activity"
                                       class="field-input">
                            </div>

                        </div>

                        <label class="calendar-activity-status">

                            <input type="checkbox"
                                   name="months[${monthIndex}][activities][${activityIndex}][status]"
                                   value="1"
                                   checked>

                            <span>Active</span>
                        </label>

                        <button type="button"
                                class="calendar-remove-activity removeMonthActivityBtn">

                            <i class="fas fa-trash"></i>
                        </button>

                    </div>
                `
            );

            return;
        }

        const removeActivityButton = event.target.closest(
            '.removeMonthActivityBtn'
        );

        if (removeActivityButton) {
            removeActivityButton
                .closest('.calendar-activity-row')
                ?.remove();
        }

    });

    document.querySelectorAll(
        '.calendar-month-admin-card'
    ).forEach(function (card) {
        updateMonthPreview(card);
    });

    const documentInput = document.getElementById(
        'calendar_document'
    );

    documentInput?.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            return;
        }

        const isPdf =
            file.type === 'application/pdf'
            || file.name.toLowerCase().endsWith('.pdf');

        if (!isPdf) {
            alert('Please select a valid PDF document.');
            this.value = '';
            return;
        }

        if (file.size > 10 * 1024 * 1024) {
            alert(
                'Academic calendar PDF must not exceed 10 MB.'
            );

            this.value = '';
        }
    });

});
</script>

@endsection