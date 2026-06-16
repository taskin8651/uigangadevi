<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FacultyMember;
use App\Models\Subject;

class AcademicController extends Controller
{
    public function courses()
    {
        $courses = Course::query()
            ->with(['subjects' => function ($query) {
                $query->where('status', true)->orderBy('name');
            }])
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $subjects = Subject::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('frontend.courses', compact('courses', 'subjects'));
    }

    public function departments()
    {
        $subjects = Subject::query()
            ->withCount(['courses' => function ($query) {
                $query->where('status', true);
            }])
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $facultyMembers = FacultyMember::query()
            ->where('status', true)
            ->with('subject')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('frontend.departments', compact('subjects', 'facultyMembers'));
    }

    public function departmentDetail(Subject $subject)
    {
        abort_unless($subject->status, 404);

        $subject->load([
            'courses' => function ($query) {
                $query->where('status', true)
                    ->orderBy('sort_order')
                    ->orderBy('name');
            },
            'facultyMembers' => function ($query) {
                $query->where('status', true)
                    ->orderBy('sort_order')
                    ->orderBy('name');
            },
        ]);

        return view('frontend.department-detail', compact('subject'));
    }
}
