<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\StudentActivity;

class StudentActivityController extends Controller
{
    public function index()
    {
        $studentActivities = StudentActivity::query()
            ->where('status', true)
            ->orderByDesc('is_featured')
            ->orderByDesc('activity_date')
            ->orderBy('sort_order')
            ->get();

        $categories = $studentActivities
            ->pluck('category')
            ->filter()
            ->unique()
            ->values();

        return view(
            'frontend.activities.index',
            compact('studentActivities', 'categories')
        );
    }

    public function show(string $slug)
    {
        $studentActivity = StudentActivity::query()
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $relatedActivities = StudentActivity::query()
            ->where('status', true)
            ->where('id', '!=', $studentActivity->id)
            ->when(
                $studentActivity->category,
                function ($query) use ($studentActivity) {
                    $query->where(
                        'category',
                        $studentActivity->category
                    );
                }
            )
            ->orderByDesc('activity_date')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view(
            'frontend.activities.show',
            compact('studentActivity', 'relatedActivities')
        );
    }
}