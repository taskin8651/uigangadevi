<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Notice;

class IndexController extends Controller
{
    public function index()
    {
        $frontendHeroSlides = HeroSlide::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
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

        return view(
            'frontend.index',
            compact('frontendHeroSlides', 'frontendLatestNotices', 'frontendGalleryItems')
        );
    }
}
