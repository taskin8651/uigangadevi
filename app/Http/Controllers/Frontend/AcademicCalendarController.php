<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        $academicCalendar = AcademicCalendar::query()
            ->where('status', true)
            ->with([
                'months' => function ($query) {
                    $query
                        ->where('status', true)
                        ->orderBy('sort_order')
                        ->orderBy('display_number');
                },
            ])
            ->orderByDesc('id')
            ->first();

        return view(
            'frontend.academic-calendar',
            compact('academicCalendar')
        );
    }
}