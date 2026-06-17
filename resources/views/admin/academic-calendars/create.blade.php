@extends('layouts.admin')

@section('page-title', 'Add Academic Calendar')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.academic-calendars.index') }}"
           class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Add Academic Calendar
        </h2>

        <p class="admin-page-subtitle">
            Create academic session, monthly plans and official calendar document
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
      action="{{ route('admin.academic-calendars.store') }}"
      enctype="multipart/form-data">

    @csrf

    <div class="admin-form-grid">

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
                        Academic session and main content
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
                               value="{{ old('title') }}"
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
                               value="{{ old('academic_session') }}"
                               required
                               placeholder="2026-2027"
                               class="field-input {{ $errors->has('academic_session') ? 'error' : '' }}">
                    </div>

                    @error('academic_session')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
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
                              placeholder="Month-wise schedule for academic activities..."
                              class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description') }}</textarea>

                    @error('short_description')
                        <p class="field-error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

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
                        Official PDF and frontend status
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
                            {{ $message }}
                        </p>
                    @else
                        <p class="field-hint">
                            <i class="fas fa-info-circle"></i>
                            PDF only. Maximum size 10 MB.
                        </p>
                    @enderror
                </div>

                <label class="calendar-status-box">

                    <input type="checkbox"
                           name="status"
                           value="1"
                           {{ old('status', 1) ? 'checked' : '' }}>

                    <div>
                        <strong>Active Academic Calendar</strong>

                        <p>
                            Active calendar will appear on the frontend website.
                        </p>
                    </div>

                </label>

            </div>
        </div>

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
                            Add months and monthly activity points
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
                    $months = old('months', [
                        [
                            'month_name' => 'July',
                            'month_value' => 7,
                            'display_number' => 1,
                            'sort_order' => 1,
                            'status' => 1,
                            'activities' => [
                                [
                                    'text' => '',
                                    'status' => 1,
                                ],
                            ],
                        ],
                    ]);
                @endphp

                <div id="calendarMonthsWrapper">

                    @foreach($months as $monthIndex => $month)

                        <div class="calendar-month-admin-card"
                             data-month-index="{{ $monthIndex }}">

                            <div class="calendar-month-admin-head">

                                <strong>
                                    Month Plan
                                </strong>

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

                                    <select name="months[{{ $monthIndex }}][month_value]"
                                            class="field-input monthValueSelect">

                                        @foreach($monthOptions as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ (string) ($month['month_value'] ?? '') === (string) $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <input type="hidden"
                                           name="months[{{ $monthIndex }}][month_name]"
                                           value="{{ $month['month_name'] ?? 'July' }}"
                                           class="monthNameInput">
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        Display Number
                                    </label>

                                    <input type="number"
                                           name="months[{{ $monthIndex }}][display_number]"
                                           value="{{ $month['display_number'] ?? 1 }}"
                                           min="1"
                                           class="field-input">
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        Sort Order
                                    </label>

                                    <input type="number"
                                           name="months[{{ $monthIndex }}][sort_order]"
                                           value="{{ $month['sort_order'] ?? 0 }}"
                                           min="0"
                                           class="field-input">
                                </div>

                                <label class="calendar-month-status">

                                    <input type="checkbox"
                                           name="months[{{ $monthIndex }}][status]"
                                           value="1"
                                           {{ !empty($month['status']) ? 'checked' : '' }}>

                                    <span>Active Month</span>
                                </label>

                            </div>

                            <div class="calendar-activities-head">

                                <strong>
                                    Monthly Activities
                                </strong>

                                <button type="button"
                                        class="btn-mini-primary addMonthActivityBtn"
                                        data-month-index="{{ $monthIndex }}">

                                    <i class="fas fa-plus"></i>
                                    Add Activity
                                </button>

                            </div>

                            <div class="calendar-activities-wrapper"
                                 id="monthActivities{{ $monthIndex }}">

                                @foreach(($month['activities'] ?? []) as $activityIndex => $activity)

                                    <div class="calendar-activity-row">

                                        <div class="field-group mb-0">

                                            <div class="input-icon-wrap">
                                                <i class="fas fa-check-circle icon"></i>

                                                <input type="text"
                                                       name="months[{{ $monthIndex }}][activities][{{ $activityIndex }}][text]"
                                                       value="{{ $activity['text'] ?? '' }}"
                                                       placeholder="Enter monthly activity"
                                                       class="field-input">
                                            </div>

                                        </div>

                                        <label class="calendar-activity-status">

                                            <input type="checkbox"
                                                   name="months[{{ $monthIndex }}][activities][{{ $activityIndex }}][status]"
                                                   value="1"
                                                   {{ !empty($activity['status']) ? 'checked' : '' }}>

                                            <span>Active</span>
                                        </label>

                                        <button type="button"
                                                class="calendar-remove-activity removeMonthActivityBtn">

                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>
        </div>

    </div>

    <div class="form-actions">

        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save Academic Calendar
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

    .calendar-status-box {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    .calendar-status-box input {
        width: 17px;
        height: 17px;
        margin-top: 3px;
    }

    .calendar-status-box strong {
        display: block;
        font-size: 14px;
    }

    .calendar-status-box p {
        margin: 4px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    .calendar-month-admin-card {
        padding: 18px;
        margin-bottom: 18px;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        background: #f8fafc;
    }

    .calendar-month-admin-head,
    .calendar-activities-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .calendar-month-admin-head {
        margin-bottom: 16px;
    }

    .calendar-month-fields {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 150px;
        gap: 12px;
        align-items: end;
    }

    .calendar-month-status,
    .calendar-activity-status {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 48px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        font-size: 13px;
        font-weight: 700;
    }

    .calendar-activities-head {
        padding-top: 16px;
        margin-top: 6px;
        margin-bottom: 12px;
        border-top: 1px solid #e5e7eb;
    }

    .calendar-activity-row {
        display: grid;
        grid-template-columns: 1fr 110px 48px;
        gap: 10px;
        align-items: center;
        margin-bottom: 10px;
    }

    .calendar-remove-month,
    .calendar-remove-activity {
        border: 0;
        border-radius: 10px;
        background: #fee2e2;
        color: #dc2626;
        cursor: pointer;
    }

    .calendar-remove-month {
        padding: 9px 12px;
        font-size: 12px;
        font-weight: 700;
    }

    .calendar-remove-activity {
        width: 48px;
        height: 48px;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    @media(max-width:991px) {
        .calendar-month-fields {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media(max-width:768px) {
        .calendar-full-card {
            grid-column: auto;
        }

        .calendar-month-fields,
        .calendar-activity-row {
            grid-template-columns: 1fr;
        }

        .calendar-remove-activity {
            width: 100%;
        }

        .calendar-month-admin-head,
        .calendar-activities-head {
            align-items: stretch;
            flex-direction: column;
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

    const monthOptions = @json($monthOptions);

    function getMonthIndex() {
        return Date.now() + Math.floor(Math.random() * 1000);
    }

    function monthOptionsHtml() {
        return Object.entries(monthOptions)
            .map(function ([value, label]) {
                return `<option value="${value}">${label}</option>`;
            })
            .join('');
    }

    document.getElementById('addMonthBtn')
        .addEventListener('click', function () {
            const index = getMonthIndex();

            const html = `
                <div class="calendar-month-admin-card"
                     data-month-index="${index}">

                    <div class="calendar-month-admin-head">
                        <strong>Month Plan</strong>

                        <button type="button"
                                class="calendar-remove-month removeMonthBtn">
                            <i class="fas fa-trash"></i>
                            Remove Month
                        </button>
                    </div>

                    <div class="calendar-month-fields">

                        <div class="field-group">
                            <label class="field-label">Month</label>

                            <select name="months[${index}][month_value]"
                                    class="field-input monthValueSelect">
                                ${monthOptionsHtml()}
                            </select>

                            <input type="hidden"
                                   name="months[${index}][month_name]"
                                   value="January"
                                   class="monthNameInput">
                        </div>

                        <div class="field-group">
                            <label class="field-label">
                                Display Number
                            </label>

                            <input type="number"
                                   name="months[${index}][display_number]"
                                   value="1"
                                   min="1"
                                   class="field-input">
                        </div>

                        <div class="field-group">
                            <label class="field-label">
                                Sort Order
                            </label>

                            <input type="number"
                                   name="months[${index}][sort_order]"
                                   value="0"
                                   min="0"
                                   class="field-input">
                        </div>

                        <label class="calendar-month-status">
                            <input type="checkbox"
                                   name="months[${index}][status]"
                                   value="1"
                                   checked>
                            <span>Active Month</span>
                        </label>

                    </div>

                    <div class="calendar-activities-head">
                        <strong>Monthly Activities</strong>

                        <button type="button"
                                class="btn-mini-primary addMonthActivityBtn"
                                data-month-index="${index}">
                            <i class="fas fa-plus"></i>
                            Add Activity
                        </button>
                    </div>

                    <div class="calendar-activities-wrapper"
                         id="monthActivities${index}">
                    </div>

                </div>
            `;

            monthsWrapper.insertAdjacentHTML(
                'beforeend',
                html
            );
        });

    document.addEventListener('change', function (event) {
        const select = event.target.closest(
            '.monthValueSelect'
        );

        if (!select) {
            return;
        }

        const card = select.closest(
            '.calendar-month-admin-card'
        );

        const input = card.querySelector(
            '.monthNameInput'
        );

        input.value = select.options[
            select.selectedIndex
        ].text;
    });

    document.addEventListener('click', function (event) {
        const removeMonth = event.target.closest(
            '.removeMonthBtn'
        );

        if (removeMonth) {
            removeMonth.closest(
                '.calendar-month-admin-card'
            ).remove();

            return;
        }

        const addActivity = event.target.closest(
            '.addMonthActivityBtn'
        );

        if (addActivity) {
            const monthIndex =
                addActivity.dataset.monthIndex;

            const wrapper = document.getElementById(
                'monthActivities' + monthIndex
            );

            const activityIndex =
                Date.now() +
                Math.floor(Math.random() * 1000);

            wrapper.insertAdjacentHTML('beforeend', `
                <div class="calendar-activity-row">

                    <div class="field-group mb-0">
                        <div class="input-icon-wrap">
                            <i class="fas fa-check-circle icon"></i>

                            <input type="text"
                                   name="months[${monthIndex}][activities][${activityIndex}][text]"
                                   placeholder="Enter monthly activity"
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
            `);

            return;
        }

        const removeActivity = event.target.closest(
            '.removeMonthActivityBtn'
        );

        if (removeActivity) {
            removeActivity.closest(
                '.calendar-activity-row'
            ).remove();
        }
    });
});
</script>

@endsection