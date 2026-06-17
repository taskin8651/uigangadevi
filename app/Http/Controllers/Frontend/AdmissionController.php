<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notice;

class AdmissionController extends Controller
{
    public function index()
    {
        $frontendAdmissionNotices = Notice::query()
            ->where('status', true)
            ->where('category', 'Admission')
            ->orderByDesc('is_latest')
            ->orderByDesc('notice_date')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        return view(
            'frontend.admissions',
            compact('frontendAdmissionNotices')
        );
    }
}
