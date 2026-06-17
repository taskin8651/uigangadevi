<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\SyllabusDocument;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    public function index(Request $request)
    {
        $selectedSession = $request->query(
            'session'
        );

        $selectedCourse = $request->query(
            'course'
        );

        $query = SyllabusDocument::query()
            ->with([
                'course',
                'subject',
            ])
            ->where('status', true);

        if ($selectedSession) {
            $query->where(
                'academic_session',
                $selectedSession
            );
        }

        if ($selectedCourse) {
            $query->where(
                'course_id',
                $selectedCourse
            );
        }

        $syllabusDocuments = $query
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $academicSessions = SyllabusDocument::query()
            ->where('status', true)
            ->whereNotNull('academic_session')
            ->distinct()
            ->orderByDesc('academic_session')
            ->pluck('academic_session');

        $courses = Course::query()
            ->where('status', true)
            ->whereHas('syllabusDocuments', function ($query) {
                $query->where('status', true);
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'frontend.syllabus',
            compact(
                'syllabusDocuments',
                'academicSessions',
                'courses',
                'selectedSession',
                'selectedCourse'
            )
        );
    }

    public function show(string $slug)
    {
        $syllabusDocument = SyllabusDocument::query()
            ->with([
                'course',
                'subject',
            ])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view(
            'frontend.syllabus-show',
            compact('syllabusDocument')
        );
    }
}