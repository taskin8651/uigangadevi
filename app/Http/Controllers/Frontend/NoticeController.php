<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::query()
            ->where('status', true)
            ->orderByDesc('is_latest')
            ->orderByDesc('notice_date')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $years = $notices
            ->pluck('notice_date')
            ->filter()
            ->map(function ($date) {
                return $date->format('Y');
            })
            ->unique()
            ->values();

        $categoryCounts = $notices
            ->groupBy(function ($notice) {
                return $notice->category ?: 'Other';
            })
            ->map
            ->count();

        $categories = $this->categories();

        return view(
            'frontend.notices',
            compact(
                'notices',
                'years',
                'categoryCounts',
                'categories'
            )
        );
    }

    private function categories(): array
    {
        return [
            'Admission' => [
                'icon' => 'bi-person-plus-fill',
                'class' => 'admission',
                'description' => 'Admission forms, eligibility, merit list, counselling and verification updates.',
            ],
            'Examination' => [
                'icon' => 'bi-pencil-square',
                'class' => 'examination',
                'description' => 'Exam form fill-up, timetable, admit card, practical and result notices.',
            ],
            'Scholarship' => [
                'icon' => 'bi-award-fill',
                'class' => 'scholarship',
                'description' => 'Scholarship application, document submission and student benefit updates.',
            ],
            'Tender' => [
                'icon' => 'bi-file-earmark-ruled-fill',
                'class' => 'tender',
                'description' => 'Tender, quotation, procurement and college office purchase information.',
            ],
            'Recruitment' => [
                'icon' => 'bi-people-fill',
                'class' => 'recruitment',
                'description' => 'Vacancy notices, interview schedules and recruitment-related announcements.',
            ],
            'Holiday' => [
                'icon' => 'bi-calendar-heart-fill',
                'class' => 'holiday',
                'description' => 'College holidays, vacation notices and special closure announcements.',
            ],
            'Government' => [
                'icon' => 'bi-building-fill-check',
                'class' => 'government',
                'description' => 'Government instructions, university orders and official public notifications.',
            ],
            'Circular' => [
                'icon' => 'bi-megaphone-fill',
                'class' => 'circular',
                'description' => 'General circulars, office orders, student instructions and internal updates.',
            ],
            'Academic' => [
                'icon' => 'bi-calendar2-week-fill',
                'class' => 'academic',
                'description' => 'Academic calendar, department updates and institutional programme details.',
            ],
            'Student' => [
                'icon' => 'bi-info-circle-fill',
                'class' => 'student',
                'description' => 'Student support, document verification and office information.',
            ],
        ];
    }
}
