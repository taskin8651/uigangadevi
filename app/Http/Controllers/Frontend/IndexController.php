<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\CollegeProfile;
use App\Models\Course;
use App\Models\DisclosureDocument;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Notice;
use App\Models\PrincipalMessage;
use App\Models\Subject;
use App\Models\SyllabusDocument;
use App\Models\WebsiteSetting;

class IndexController extends Controller
{
    public function index()
    {
        $websiteSetting = WebsiteSetting::current();

        $frontendHeroSlides = HeroSlide::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $collegeProfile = CollegeProfile::query()
            ->where('status', true)
            ->latest()
            ->first();

        $principalMessage = PrincipalMessage::query()
            ->where('status', true)
            ->latest()
            ->first();

        $frontendStats = [
            'departments' => Subject::query()->where('status', true)->count(),
            'courses' => Course::query()->where('status', true)->count(),
            'notices' => Notice::query()->where('status', true)->count(),
            'gallery' => Gallery::query()->where('status', true)->count(),
        ];

        $frontendCourses = Course::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $frontendDepartments = Subject::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $frontendLatestNotices = Notice::query()
            ->where('status', true)
            ->orderByDesc('is_latest')
            ->orderByDesc('notice_date')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        $frontendGalleryItems = Gallery::query()
            ->where('status', true)
            ->where('type', 'image')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $frontendAcademicCalendar = AcademicCalendar::query()
            ->where('status', true)
            ->latest()
            ->first();

        $frontendSyllabusDocuments = SyllabusDocument::query()
            ->where('status', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $frontendNaacDocuments = DisclosureDocument::query()
            ->where('status', true)
            ->where('section', 'naac')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $frontendRtiDocuments = DisclosureDocument::query()
            ->where('status', true)
            ->where('section', 'rti')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(2)
            ->get();

        $frontendDownloadItems = collect()
            ->merge($frontendSyllabusDocuments)
            ->merge($frontendNaacDocuments)
            ->merge($frontendRtiDocuments)
            ->filter(fn ($item) => $item->download_url)
            ->take(4)
            ->values();

        return view(
            'frontend.index',
            compact(
                'websiteSetting',
                'frontendHeroSlides',
                'collegeProfile',
                'principalMessage',
                'frontendStats',
                'frontendCourses',
                'frontendDepartments',
                'frontendLatestNotices',
                'frontendGalleryItems',
                'frontendAcademicCalendar',
                'frontendSyllabusDocuments',
                'frontendNaacDocuments',
                'frontendRtiDocuments',
                'frontendDownloadItems'
            )
        );
    }
}
