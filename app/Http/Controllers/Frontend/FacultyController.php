<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FacultyMember;

class FacultyController extends Controller
{
    public function index()
    {
        $facultyMembers = FacultyMember::query()
            ->where('status', true)
            ->with('subject')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $categories = $facultyMembers
            ->pluck('faculty_category')
            ->filter()
            ->unique()
            ->values();

        return view(
            'frontend.faculty.index',
            compact('facultyMembers', 'categories')
        );
    }

    public function show(string $slug)
    {
        $facultyMember = FacultyMember::query()
            ->where('slug', $slug)
            ->where('status', true)
            ->with('subject')
            ->firstOrFail();

        $relatedFaculty = FacultyMember::query()
            ->where('status', true)
            ->where('id', '!=', $facultyMember->id)
            ->when(
                $facultyMember->subject_id,
                function ($query) use ($facultyMember) {
                    $query->where(
                        'subject_id',
                        $facultyMember->subject_id
                    );
                }
            )
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        return view(
            'frontend.faculty.show',
            compact('facultyMember', 'relatedFaculty')
        );
    }
}