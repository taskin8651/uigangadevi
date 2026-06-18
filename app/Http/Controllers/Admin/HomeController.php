<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\Course;
use App\Models\DisclosureDocument;
use App\Models\FacultyMember;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Notice;
use App\Models\StudentActivity;
use App\Models\Subject;
use App\Models\SyllabusDocument;

class HomeController extends Controller
{
    public function index()
    {
        $moduleCards = collect([
            [
                'label' => 'Courses',
                'count' => Course::count(),
                'icon' => 'fa-graduation-cap',
                'color' => '#2563eb',
                'bg' => '#eff6ff',
                'route' => 'admin.courses.index',
                'permission' => 'course_access',
            ],
            [
                'label' => 'Subjects',
                'count' => Subject::count(),
                'icon' => 'fa-book-open',
                'color' => '#7c3aed',
                'bg' => '#f3e8ff',
                'route' => 'admin.subjects.index',
                'permission' => 'subject_access',
            ],
            [
                'label' => 'Faculty',
                'count' => FacultyMember::count(),
                'icon' => 'fa-chalkboard-user',
                'color' => '#0891b2',
                'bg' => '#ecfeff',
                'route' => 'admin.faculty-members.index',
                'permission' => 'faculty_member_access',
            ],
            [
                'label' => 'Activities',
                'count' => StudentActivity::count(),
                'icon' => 'fa-people-group',
                'color' => '#16a34a',
                'bg' => '#f0fdf4',
                'route' => 'admin.student-activities.index',
                'permission' => 'student_activity_access',
            ],
            [
                'label' => 'Academic Calendars',
                'count' => AcademicCalendar::count(),
                'icon' => 'fa-calendar-days',
                'color' => '#ea580c',
                'bg' => '#fff7ed',
                'route' => 'admin.academic-calendars.index',
                'permission' => 'academic_calendar_access',
            ],
            [
                'label' => 'Syllabus',
                'count' => SyllabusDocument::count(),
                'icon' => 'fa-file-lines',
                'color' => '#4f46e5',
                'bg' => '#eef2ff',
                'route' => 'admin.syllabus-documents.index',
                'permission' => 'syllabus_document_access',
            ],
            [
                'label' => 'Notices',
                'count' => Notice::count(),
                'icon' => 'fa-bullhorn',
                'color' => '#dc2626',
                'bg' => '#fef2f2',
                'route' => 'admin.notices.index',
                'permission' => 'notice_access',
            ],
            [
                'label' => 'Gallery',
                'count' => Gallery::count(),
                'icon' => 'fa-images',
                'color' => '#db2777',
                'bg' => '#fdf2f8',
                'route' => 'admin.galleries.index',
                'permission' => 'gallery_access',
            ],
            [
                'label' => 'Hero Slides',
                'count' => HeroSlide::count(),
                'icon' => 'fa-images',
                'color' => '#0f766e',
                'bg' => '#ccfbf1',
                'route' => 'admin.hero-slides.index',
                'permission' => 'hero_slide_access',
            ],
            [
                'label' => 'RTI / NAAC Docs',
                'count' => DisclosureDocument::count(),
                'icon' => 'fa-file-shield',
                'color' => '#9333ea',
                'bg' => '#faf5ff',
                'route' => 'admin.disclosure-documents.index',
                'permission' => 'disclosure_document_access',
            ],
        ]);

        $recentNotices = Notice::query()
            ->orderByDesc('notice_date')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $recentActivities = StudentActivity::query()
            ->orderByDesc('activity_date')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view(
            'home',
            compact('moduleCards', 'recentNotices', 'recentActivities')
        );
    }
}
