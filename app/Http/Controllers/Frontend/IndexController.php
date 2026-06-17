<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notice;

class IndexController extends Controller
{
    public function index()
    {
        $frontendLatestNotices = Notice::query()
            ->where('status', true)
            ->orderByDesc('is_latest')
            ->orderByDesc('notice_date')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        return view(
            'frontend.index',
            compact('frontendLatestNotices')
        );
    }
}
