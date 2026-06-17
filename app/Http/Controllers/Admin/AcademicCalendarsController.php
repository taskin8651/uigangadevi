<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AcademicCalendarsController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('academic_calendar_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $academicCalendars = AcademicCalendar::query()
            ->withCount('months')
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.academic-calendars.index',
            compact('academicCalendars')
        );
    }

    public function create()
    {
        abort_if(
            Gate::denies('academic_calendar_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $monthOptions = $this->monthOptions();

        return view(
            'admin.academic-calendars.create',
            compact('monthOptions')
        );
    }

    public function store(Request $request)
    {
        abort_if(
            Gate::denies('academic_calendar_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $this->validateCalendar($request);

        DB::transaction(function () use (
            $request,
            $validated
        ) {
            $academicCalendar = AcademicCalendar::create([
                'title' => $validated['title'],
                'academic_session' => $validated['academic_session'],
                'short_description' => $validated['short_description'] ?? null,
                'status' => $request->boolean('status'),
            ]);

            $this->saveMonths(
                $academicCalendar,
                $request->input('months', [])
            );

            if ($request->hasFile('calendar_document')) {
                $academicCalendar
                    ->addMediaFromRequest('calendar_document')
                    ->toMediaCollection(
                        'academic_calendar_document'
                    );
            }
        });

        return redirect()
            ->route('admin.academic-calendars.index')
            ->with(
                'success',
                'Academic calendar created successfully.'
            );
    }

    public function show(
        AcademicCalendar $academicCalendar
    ) {
        abort_if(
            Gate::denies('academic_calendar_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $academicCalendar->load([
            'months' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('display_number');
            },
        ]);

        return view(
            'admin.academic-calendars.show',
            compact('academicCalendar')
        );
    }

    public function edit(
        AcademicCalendar $academicCalendar
    ) {
        abort_if(
            Gate::denies('academic_calendar_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $academicCalendar->load([
            'months' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('display_number');
            },
        ]);

        $monthOptions = $this->monthOptions();

        return view(
            'admin.academic-calendars.edit',
            compact(
                'academicCalendar',
                'monthOptions'
            )
        );
    }

    public function update(
        Request $request,
        AcademicCalendar $academicCalendar
    ) {
        abort_if(
            Gate::denies('academic_calendar_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $this->validateCalendar(
            $request,
            $academicCalendar->id
        );

        DB::transaction(function () use (
            $request,
            $validated,
            $academicCalendar
        ) {
            $academicCalendar->update([
                'title' => $validated['title'],
                'academic_session' => $validated['academic_session'],
                'short_description' => $validated['short_description'] ?? null,
                'status' => $request->boolean('status'),
            ]);

            $academicCalendar->months()->delete();

            $this->saveMonths(
                $academicCalendar,
                $request->input('months', [])
            );

            if ($request->boolean('remove_calendar_document')) {
                $academicCalendar->clearMediaCollection(
                    'academic_calendar_document'
                );
            }

            if ($request->hasFile('calendar_document')) {
                $academicCalendar
                    ->addMediaFromRequest('calendar_document')
                    ->toMediaCollection(
                        'academic_calendar_document'
                    );
            }
        });

        return redirect()
            ->route('admin.academic-calendars.index')
            ->with(
                'success',
                'Academic calendar updated successfully.'
            );
    }

    public function destroy(
        AcademicCalendar $academicCalendar
    ) {
        abort_if(
            Gate::denies('academic_calendar_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $academicCalendar->clearMediaCollection(
            'academic_calendar_document'
        );

        $academicCalendar->delete();

        return back()->with(
            'success',
            'Academic calendar deleted successfully.'
        );
    }

    public function massDestroy(Request $request)
    {
        abort_if(
            Gate::denies('academic_calendar_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:academic_calendars,id',
        ]);

        $academicCalendars = AcademicCalendar::query()
            ->whereIn(
                'id',
                $request->input('ids', [])
            )
            ->get();

        foreach ($academicCalendars as $academicCalendar) {
            $academicCalendar->clearMediaCollection(
                'academic_calendar_document'
            );

            $academicCalendar->delete();
        }

        return response(
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    private function validateCalendar(
        Request $request,
        ?int $calendarId = null
    ): array {
        return $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'academic_session' => [
                'required',
                'string',
                'max:50',
                'unique:academic_calendars,academic_session,' . $calendarId,
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'calendar_document' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            'remove_calendar_document' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'months' => [
                'nullable',
                'array',
            ],

            'months.*.month_name' => [
                'required_with:months',
                'string',
                'max:50',
            ],

            'months.*.month_value' => [
                'required_with:months',
                'integer',
                'between:1,12',
            ],

            'months.*.display_number' => [
                'required_with:months',
                'integer',
                'min:1',
                'max:99',
            ],

            'months.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'months.*.status' => [
                'nullable',
            ],

            'months.*.activities' => [
                'nullable',
                'array',
            ],

            'months.*.activities.*.text' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'months.*.activities.*.status' => [
                'nullable',
            ],
        ]);
    }

    private function saveMonths(
        AcademicCalendar $academicCalendar,
        array $months
    ): void {
        foreach ($months as $month) {
            $monthName = trim(
                $month['month_name'] ?? ''
            );

            if ($monthName === '') {
                continue;
            }

            $activities = [];

            foreach (
                $month['activities'] ?? []
                as $activity
            ) {
                $text = trim(
                    $activity['text'] ?? ''
                );

                if ($text === '') {
                    continue;
                }

                $activities[] = [
                    'text' => $text,
                    'status' => isset(
                        $activity['status']
                    ) ? 1 : 0,
                ];
            }

            $academicCalendar->months()->create([
                'month_name' => $monthName,
                'month_value' => (int) (
                    $month['month_value'] ?? 1
                ),
                'display_number' => (int) (
                    $month['display_number'] ?? 1
                ),
                'activities' => $activities,
                'sort_order' => (int) (
                    $month['sort_order'] ?? 0
                ),
                'status' => isset(
                    $month['status']
                ) ? 1 : 0,
            ]);
        }
    }

    private function monthOptions(): array
    {
        return [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
    }
}